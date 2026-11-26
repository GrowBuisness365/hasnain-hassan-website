<?php
/**
 * HassanEngine Admin Panel & CMS.
 *
 * Dashboard, blog post management, contact message management, and settings.
 * Posts are stored via content_store.php (Supabase with local JSON fallback).
 * Contact messages are stored in storage/messages.json with Supabase fallback.
 */

ini_set('session.cookie_httponly', '1');
ini_set('session.cookie_samesite', 'Lax');
if (getenv('VERCEL')) {
    ini_set('session.cookie_secure', '1');
}

require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/form-security.php';
require_once __DIR__ . '/../includes/data/content.php';
require_once __DIR__ . '/../includes/content-store.php';
content_store_apply();

header('X-Robots-Tag: noindex, nofollow');
header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: DENY');

$adminUrl    = rtrim(SITE_URL, '/') . '/admin';
$storageDir  = __DIR__ . '/../storage';
$postsPath   = $storageDir . '/content.json';
$messagesPath = $storageDir . '/messages.json';
$auditPath   = $storageDir . '/audit.json';
$message     = '';
$error       = '';
$page        = isset($_GET['page']) ? (string) $_GET['page'] : 'dashboard';
$perPage     = 10;

/* ------------------------------------------------------------------ helpers */

function cms_rate_limit_key()
{
    return isset($_SERVER['REMOTE_ADDR']) ? (string) $_SERVER['REMOTE_ADDR'] : 'unknown';
}

function cms_login_attempts()
{
    $key = 'cms_login_failures_' . cms_rate_limit_key();
    if (session_status() === PHP_SESSION_NONE) {
        @session_start();
    }
    return (int) ($_SESSION[$key] ?? 0);
}

function cms_record_login_failure()
{
    $key = 'cms_login_failures_' . cms_rate_limit_key();
    if (session_status() === PHP_SESSION_NONE) {
        @session_start();
    }
    $_SESSION[$key] = (int) ($_SESSION[$key] ?? 0) + 1;
}

function cms_clear_login_failures()
{
    $key = 'cms_login_failures_' . cms_rate_limit_key();
    if (session_status() === PHP_SESSION_NONE) {
        @session_start();
    }
    unset($_SESSION[$key]);
}

function cms_login_locked()
{
    return cms_login_attempts() >= 5;
}

function cms_posts_read()
{
    $all = content_store_load_all();
    $posts = isset($all['posts']) && is_array($all['posts']) ? $all['posts'] : array();
    if (empty($posts)) {
        global $posts;
        $posts = $posts;
    }
    return $posts;
}

function cms_posts_write(array $posts)
{
    $all = content_store_load_all();
    $all['posts'] = $posts;
    return content_store_save_group('posts', $all['posts']);
}

function cms_messages_read()
{
    global $messagesPath;
    if (content_store_configured()) {
        $rows = content_store_request('GET', '?select=*&order=created_at.desc', null);
        if (is_array($rows)) {
            return $rows;
        }
    }
    if (!is_file($messagesPath)) {
        return array();
    }
    $data = json_decode((string) @file_get_contents($messagesPath), true);
    return is_array($data) ? $data : array();
}

function cms_messages_write(array $messages)
{
    global $messagesPath;
    if (content_store_configured()) {
        return true;
    }
    $dir = dirname($messagesPath);
    if (!is_dir($dir) && !@mkdir($dir, 0755, true)) {
        return false;
    }
    return (bool) @file_put_contents($messagesPath, json_encode($messages, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT), LOCK_EX);
}

function cms_audit_log(string $action, string $targetType, ?string $targetId = null, array $details = array())
{
    if (session_status() === PHP_SESSION_NONE) {
        @session_start();
    }
    $adminId = $_SESSION['cms_admin_id'] ?? null;
    $entry = array(
        'id'         => bin2hex(random_bytes(8)),
        'admin_id'   => $adminId,
        'action'     => $action,
        'target_type' => $targetType,
        'target_id'  => $targetId,
        'details'    => $details,
        'created_at' => gmdate('Y-m-d H:i:s'),
    );
    $logs = array();
    if (is_file($auditPath)) {
        $existing = json_decode((string) @file_get_contents($auditPath), true);
        if (is_array($existing)) {
            $logs = $existing;
        }
    }
    $logs[] = $entry;
    $logs = array_slice($logs, -500);
    $dir = dirname($auditPath);
    if (!is_dir($dir) && !@mkdir($dir, 0755, true)) {
        return;
    }
    @file_put_contents($auditPath, json_encode($logs, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT), LOCK_EX);
}

function cms_paginate(array $items, int $page, int $perPage): array
{
    $total = count($items);
    $totalPages = (int) ceil($total / $perPage);
    $page = max(1, min($page, max(1, $totalPages)));
    $offset = ($page - 1) * $perPage;
    return array(
        'items'      => array_slice($items, $offset, $perPage),
        'page'       => $page,
        'perPage'    => $perPage,
        'total'      => $total,
        'totalPages' => $totalPages,
    );
}

function cms_url(string $page, array $params = array()): string
{
    $query = http_build_query(array_merge(array('page' => $page), $params));
    return $adminUrl . '?' . $query;
}

/* ------------------------------------------------------------------ auth */

$loggedIn = !empty($_SESSION['cms_admin']);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'login') {
    if (!csrf_verify()) {
        $error = 'Session expired. Reload and try again.';
    } elseif (cms_login_locked()) {
        $error = 'Too many failed attempts. Please try again later.';
    } else {
        $password = isset($_POST['password']) ? (string) $_POST['password'] : '';
        $hash = getenv('CMS_ADMIN_PASSWORD_HASH');
        if ($hash !== false && $hash !== '' && password_verify($password, $hash)) {
            session_regenerate_id(true);
            $_SESSION['cms_admin'] = true;
            $_SESSION['cms_admin_id'] = 'admin';
            $_SESSION['cms_admin_email'] = 'admin@hassanengine.local';
            cms_clear_login_failures();
            cms_audit_log('login', 'admin', 'admin', array('ip' => cms_rate_limit_key()));
            header('Location: ' . $adminUrl, true, 303);
            exit;
        } else {
            cms_record_login_failure();
            $error = 'Invalid password.';
        }
    }
}

if (isset($_GET['logout'])) {
    if (!empty($_SESSION['cms_admin_id'])) {
        cms_audit_log('logout', 'admin', $_SESSION['cms_admin_id']);
    }
    unset($_SESSION['cms_admin'], $_SESSION['cms_admin_id'], $_SESSION['cms_admin_email']);
    header('Location: ' . $adminUrl, true, 303);
    exit;
}

if (!$loggedIn) {
    $page = 'login';
}

/* ------------------------------------------------------------------ post actions */

if ($loggedIn && $_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $action = (string) $_POST['action'];

    if ($action === 'add_post' && !csrf_verify()) {
        $error = 'Session expired.';
    } elseif ($action === 'update_post' && !csrf_verify()) {
        $error = 'Session expired.';
    } elseif ($action === 'add_post') {
        $slug     = trim((string) ($_POST['slug'] ?? ''));
        $title    = trim((string) ($_POST['title'] ?? ''));
        $excerpt  = trim((string) ($_POST['excerpt'] ?? ''));
        $category = trim((string) ($_POST['category'] ?? ''));
        $author   = trim((string) ($_POST['author'] ?? 'Hassan Raza'));
        $date     = trim((string) ($_POST['date'] ?? date('Y-m-d')));
        $read     = trim((string) ($_POST['read'] ?? '5 min read'));
        $image    = trim((string) ($_POST['image'] ?? 'assets/images/hero/code.svg'));
        $featured = !empty($_POST['featured']);
        $tagsRaw  = trim((string) ($_POST['tags'] ?? ''));
        $tags     = $tagsRaw !== '' ? array_map('trim', explode(',', $tagsRaw)) : array();
        $bodyRaw  = isset($_POST['body']) ? (string) $_POST['body'] : '';
        $body     = array_filter(explode("\n", $bodyRaw), function ($b) { return trim($b) !== ''; });

        if ($slug === '' || $title === '') {
            $error = 'Slug and title are required.';
        } elseif (!preg_match('/^[a-z0-9]+(?:-[a-z0-9]+)*$/', $slug)) {
            $error = 'Slug must be lowercase letters, numbers, and hyphens only.';
        } else {
            $allPosts = cms_posts_read();
            foreach ($allPosts as $p) {
                if (isset($p['slug']) && $p['slug'] === $slug) {
                    $error = 'Slug already exists.';
                    break;
                }
            }
            if ($error === '') {
                $newPost = array(
                    'slug'     => $slug,
                    'title'    => $title,
                    'excerpt'  => $excerpt,
                    'category' => $category,
                    'author'   => $author,
                    'date'     => $date,
                    'read'     => $read,
                    'image'    => $image,
                    'featured' => $featured,
                    'tags'     => $tags,
                    'body'     => $body,
                    'created_at' => gmdate('Y-m-d H:i:s'),
                );
                $allPosts[] = $newPost;
                if (cms_posts_write($allPosts)) {
                    cms_audit_log('create_post', 'post', $slug, array('title' => $title));
                    $message = 'Post saved successfully.';
                } else {
                    $error = 'Failed to save post.';
                }
            }
        }
    } elseif ($action === 'update_post') {
        $slug     = trim((string) ($_POST['slug'] ?? ''));
        $title    = trim((string) ($_POST['title'] ?? ''));
        $excerpt  = trim((string) ($_POST['excerpt'] ?? ''));
        $category = trim((string) ($_POST['category'] ?? ''));
        $author   = trim((string) ($_POST['author'] ?? 'Hassan Raza'));
        $date     = trim((string) ($_POST['date'] ?? date('Y-m-d')));
        $read     = trim((string) ($_POST['read'] ?? '5 min read'));
        $image    = trim((string) ($_POST['image'] ?? 'assets/images/hero/code.svg'));
        $featured = !empty($_POST['featured']);
        $tagsRaw  = trim((string) ($_POST['tags'] ?? ''));
        $tags     = $tagsRaw !== '' ? array_map('trim', explode(',', $tagsRaw)) : array();
        $bodyRaw  = isset($_POST['body']) ? (string) $_POST['body'] : '';
        $body     = array_filter(explode("\n", $bodyRaw), function ($b) { return trim($b) !== ''; });

        if ($slug === '' || $title === '') {
            $error = 'Slug and title are required.';
        } elseif (!preg_match('/^[a-z0-9]+(?:-[a-z0-9]+)*$/', $slug)) {
            $error = 'Slug must be lowercase letters, numbers, and hyphens only.';
        } else {
            $allPosts = cms_posts_read();
            $found = false;
            foreach ($allPosts as $i => $p) {
                if (isset($p['slug']) && $p['slug'] === $slug) {
                    $allPosts[$i] = array_merge($p, array(
                        'title'    => $title,
                        'excerpt'  => $excerpt,
                        'category' => $category,
                        'author'   => $author,
                        'date'     => $date,
                        'read'     => $read,
                        'image'    => $image,
                        'featured' => $featured,
                        'tags'     => $tags,
                        'body'     => $body,
                        'updated_at' => gmdate('Y-m-d H:i:s'),
                    ));
                    $found = true;
                    break;
                }
            }
            if (!$found) {
                $error = 'Post not found.';
            } elseif (cms_posts_write($allPosts)) {
                cms_audit_log('update_post', 'post', $slug, array('title' => $title));
                $message = 'Post updated successfully.';
            } else {
                $error = 'Failed to update post.';
            }
        }
    } elseif ($action === 'toggle_featured') {
        if (!csrf_verify()) {
            $error = 'Session expired.';
        } else {
            $targetSlug = trim((string) ($_POST['slug'] ?? ''));
            $featured   = !empty($_POST['featured']);
            $allPosts = cms_posts_read();
            $found = false;
            foreach ($allPosts as $i => $p) {
                if (isset($p['slug']) && $p['slug'] === $targetSlug) {
                    $allPosts[$i]['featured'] = $featured;
                    $allPosts[$i]['updated_at'] = gmdate('Y-m-d H:i:s');
                    $found = true;
                    break;
                }
            }
            if (!$found) {
                $error = 'Post not found.';
            } elseif (cms_posts_write($allPosts)) {
                cms_audit_log('toggle_featured', 'post', $targetSlug, array('featured' => $featured));
                $message = 'Featured status updated.';
            } else {
                $error = 'Failed to update post.';
            }
        }
    } elseif ($action === 'delete_post') {
        if (!csrf_verify()) {
            $error = 'Session expired.';
        } else {
            $deleteSlug = trim((string) ($_POST['slug'] ?? ''));
            $allPosts = cms_posts_read();
            $filtered = array();
            $found = false;
            foreach ($allPosts as $p) {
                if (isset($p['slug']) && $p['slug'] === $deleteSlug) {
                    $found = true;
                    continue;
                }
                $filtered[] = $p;
            }
            if (!$found) {
                $error = 'Post not found.';
            } elseif (cms_posts_write($filtered)) {
                cms_audit_log('delete_post', 'post', $deleteSlug);
                $message = 'Post deleted.';
            } else {
                $error = 'Failed to delete post.';
            }
        }
    } elseif ($action === 'mark_message') {
        if (!csrf_verify()) {
            $error = 'Session expired.';
        } else {
            $msgId    = trim((string) ($_POST['message_id'] ?? ''));
            $newStatus = trim((string) ($_POST['status'] ?? 'read'));
            $messages = cms_messages_read();
            $found = false;
            foreach ($messages as $i => $m) {
                if (isset($m['id']) && $m['id'] === $msgId) {
                    $messages[$i]['status'] = $newStatus;
                    if ($newStatus === 'read' && empty($m['read_at'])) {
                        $messages[$i]['read_at'] = gmdate('Y-m-d H:i:s');
                    }
                    if ($newStatus === 'replied' && empty($m['replied_at'])) {
                        $messages[$i]['replied_at'] = gmdate('Y-m-d H:i:s');
                    }
                    $found = true;
                    break;
                }
            }
            if (!$found) {
                $error = 'Message not found.';
            } elseif (cms_messages_write($messages)) {
                cms_audit_log('update_message', 'message', $msgId, array('status' => $newStatus));
                $message = 'Message status updated.';
            } else {
                $error = 'Failed to update message.';
            }
        }
    } elseif ($action === 'delete_message') {
        if (!csrf_verify()) {
            $error = 'Session expired.';
        } else {
            $msgId = trim((string) ($_POST['message_id'] ?? ''));
            $messages = cms_messages_read();
            $filtered = array();
            $found = false;
            foreach ($messages as $m) {
                if (isset($m['id']) && $m['id'] === $msgId) {
                    $found = true;
                    continue;
                }
                $filtered[] = $m;
            }
            if (!$found) {
                $error = 'Message not found.';
            } elseif (cms_messages_write($filtered)) {
                cms_audit_log('delete_message', 'message', $msgId);
                $message = 'Message deleted.';
            } else {
                $error = 'Failed to delete message.';
            }
        }
    }
}

/* ------------------------------------------------------------------ GET actions */

if ($loggedIn && isset($_GET['delete_post'])) {
    $deleteSlug = (string) $_GET['delete_post'];
    $confirm    = isset($_GET['confirm']) && $_GET['confirm'] === '1';
    if (!$confirm) {
        $error = 'Are you sure you want to delete this post? <a href="' . $adminUrl . '?page=posts&delete_post=' . rawurlencode($deleteSlug) . '&confirm=1" class="a-btn-danger">Yes, delete</a> <a href="' . $adminUrl . '?page=posts" class="a-btn-ghost">Cancel</a>';
    } else {
        if (!csrf_verify()) {
            $error = 'Session expired.';
        } else {
            $allPosts = cms_posts_read();
            $filtered = array();
            $found = false;
            foreach ($allPosts as $p) {
                if (isset($p['slug']) && $p['slug'] === $deleteSlug) {
                    $found = true;
                    continue;
                }
                $filtered[] = $p;
            }
            if (!$found) {
                $error = 'Post not found.';
            } elseif (cms_posts_write($filtered)) {
                cms_audit_log('delete_post', 'post', $deleteSlug);
                $message = 'Post deleted.';
                $page = 'posts';
            } else {
                $error = 'Failed to delete post.';
            }
        }
    }
}

if ($loggedIn && isset($_GET['delete_message'])) {
    $msgId = (string) $_GET['delete_message'];
    $confirm = isset($_GET['confirm']) && $_GET['confirm'] === '1';
    if (!$confirm) {
        $error = 'Are you sure you want to delete this message? <a href="' . $adminUrl . '?page=messages&delete_message=' . rawurlencode($msgId) . '&confirm=1" class="a-btn-danger">Yes, delete</a> <a href="' . $adminUrl . '?page=messages" class="a-btn-ghost">Cancel</a>';
    } else {
        if (!csrf_verify()) {
            $error = 'Session expired.';
        } else {
            $messages = cms_messages_read();
            $filtered = array();
            $found = false;
            foreach ($messages as $m) {
                if (isset($m['id']) && $m['id'] === $msgId) {
                    $found = true;
                    continue;
                }
                $filtered[] = $m;
            }
            if (!$found) {
                $error = 'Message not found.';
            } elseif (cms_messages_write($filtered)) {
                cms_audit_log('delete_message', 'message', $msgId);
                $message = 'Message deleted.';
                $page = 'messages';
            } else {
                $error = 'Failed to delete message.';
            }
        }
    }
}

/* ------------------------------------------------------------------ data loading */

$allPosts = cms_posts_read();
usort($allPosts, function ($a, $b) {
    return strcmp((string) ($b['date'] ?? ''), (string) ($a['date'] ?? ''));
});

$allMessages = cms_messages_read();
usort($allMessages, function ($a, $b) {
    return strcmp((string) ($b['created_at'] ?? ''), (string) ($a['created_at'] ?? ''));
});

$postCount   = count($allPosts);
$featuredCount = count(array_filter($allPosts, function ($p) { return !empty($p['featured']); }));
$messageCount = count($allMessages);
$unreadCount  = count(array_filter($allMessages, function ($m) { return ($m['status'] ?? '') === 'new'; }));

/* ------------------------------------------------------------------ pagination for posts list */

if ($page === 'posts') {
    $search = isset($_GET['search']) ? trim((string) $_GET['search']) : '';
    $filtered = $allPosts;
    if ($search !== '') {
        $searchLower = mb_strtolower($search);
        $filtered = array_values(array_filter($filtered, function ($p) use ($searchLower) {
            return mb_strpos(mb_strtolower((string) ($p['title'] ?? '')), $searchLower) !== false
                || mb_strpos(mb_strtolower((string) ($p['slug'] ?? '')), $searchLower) !== false
                || mb_strpos(mb_strtolower((string) ($p['category'] ?? '')), $searchLower) !== false;
        }));
    }
    $currentPage = isset($_GET['p']) ? (int) $_GET['p'] : 1;
    if ($currentPage < 1) {
        $currentPage = 1;
    }
    $paged = cms_paginate($filtered, $currentPage, $perPage);
}

/* ------------------------------------------------------------------ edit post data */

$editPost = null;
if ($loggedIn && $page === 'posts' && isset($_GET['edit'])) {
    $editSlug = (string) $_GET['edit'];
    foreach ($allPosts as $p) {
        if (isset($p['slug']) && $p['slug'] === $editSlug) {
            $editPost = $p;
            break;
        }
    }
}

?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="robots" content="noindex,nofollow">
<title>HassanEngine Admin</title>
<style>
* { box-sizing: border-box; }
body { font-family: system-ui, -apple-system, Segoe UI, sans-serif; background: #f8fafc; color: #0f172a; margin: 0; font-size: 14px; }
.a-wrap { max-width: 1200px; margin: 0 auto; padding: 0 24px; }
.a-top { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; flex-wrap: wrap; gap: 12px; }
.a-top h1 { font-size: 22px; margin: 0; color: #0f172a; }
.a-nav { display: flex; gap: 8px; }
.a-nav a { padding: 8px 14px; border-radius: 6px; border: 1px solid #cbd5e1; color: #475569; text-decoration: none; font-size: 13px; font-weight: 500; }
.a-nav a:hover { background: #f1f5f9; border-color: #94a3b8; }
.a-nav a.active { background: #2563eb; color: #fff; border-color: #2563eb; }
.a-stats { display: flex; gap: 12px; margin-bottom: 20px; flex-wrap: wrap; }
.a-stat { background: #fff; padding: 14px 18px; border-radius: 8px; border: 1px solid #e2e8f0; min-width: 130px; flex: 1; }
.a-stat .n { font-size: 26px; font-weight: 600; color: #2563eb; }
.a-stat .l { font-size: 12px; color: #64748b; margin-top: 4px; }
.a-card { background: #fff; border: 1px solid #e2e8f0; border-radius: 8px; padding: 20px; margin-bottom: 16px; }
.a-card h2 { font-size: 16px; margin: 0 0 14px; color: #334155; }
.a-btn { background: #2563eb; color: #fff; border: none; padding: 8px 14px; border-radius: 6px; cursor: pointer; font-size: 13px; font-weight: 500; }
.a-btn:hover { background: #1d4ed8; }
.a-btn-ghost { background: transparent; color: #475569; border: 1px solid #cbd5e1; padding: 8px 14px; border-radius: 6px; cursor: pointer; font-size: 13px; }
.a-btn-ghost:hover { background: #f1f5f9; border-color: #94a3b8; }
.a-btn-danger { background: #ef4444; color: #fff; border: none; padding: 6px 12px; border-radius: 4px; cursor: pointer; font-size: 12px; }
.a-btn-danger:hover { background: #dc2626; }
table { width: 100%; border-collapse: collapse; }
th, td { text-align: left; padding: 10px 12px; border-bottom: 1px solid #e2e8f0; font-size: 13px; }
th { background: #f8fafc; font-weight: 600; color: #475569; }
tr:hover { background: #f8fafc; }
.slug { font-family: ui-monospace, SFMono-Regular, monospace; font-size: 12px; color: #64748b; }
label { display: block; font-size: 12px; font-weight: 600; margin-bottom: 6px; color: #334155; }
input[type="text"], input[type="email"], input[type="password"], input[type="date"], textarea, select { width: 100%; padding: 8px 10px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 13px; background: #fff; }
input[type="text"]:focus, input[type="email"]:focus, input[type="password"]:focus, input[type="date"]:focus, textarea:focus, select:focus { outline: none; border-color: #2563eb; box-shadow: 0 0 0 2px rgba(37,99,235,0.2); }
textarea { min-height: 150px; resize: vertical; }
.row { display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 14px; margin-bottom: 14px; }
.msg { padding: 10px 14px; border-radius: 6px; margin-bottom: 14px; font-size: 13px; }
.msg.ok { background: #dcfce7; color: #166534; border: 1px solid #86efac; }
.msg.err { background: #fee2e2; color: #991b1b; border: 1px solid #fca5a5; }
.a-login { max-width: 400px; margin: 60px auto; background: #fff; border: 1px solid #e2e8f0; border-radius: 10px; padding: 32px 28px; }
.a-login h2 { margin-top: 0; font-size: 20px; text-align: center; color: #0f172a; }
.a-logout { margin-left: 14px; color: #64748b; text-decoration: none; font-size: 13px; }
.a-logout:hover { color: #0f172a; }
.a-actions { display: flex; gap: 8px; align-items: center; margin-top: 10px; }
.toggle-switch { position: relative; display: inline-block; width: 44px; height: 24px; }
.toggle-switch input { opacity: 0; width: 0; height: 0; }
.toggle-slider { position: absolute; cursor: pointer; top: 0; left: 0; right: 0; bottom: 0; background: #cbd5e1; transition: .2s; border-radius: 24px; }
.toggle-slider:before { position: absolute; content: ""; height: 18px; width: 18px; left: 3px; bottom: 3px; background: #fff; transition: .2s; border-radius: 50%; }
input:checked + .toggle-slider { background: #2563eb; }
input:checked + .toggle-slider:before { transform: translateX(20px); }
.pagination { display: flex; gap: 6px; justify-content: center; margin-top: 14px; }
.pagination a, .pagination span { padding: 6px 10px; border: 1px solid #cbd5e1; border-radius: 4px; text-decoration: none; color: #475569; font-size: 12px; }
.pagination a:hover { background: #f1f5f9; border-color: #94a3b8; }
.pagination .current { background: #2563eb; color: #fff; border-color: #2563eb; }
.status-badge { display: inline-block; padding: 2px 8px; border-radius: 10px; font-size: 11px; font-weight: 600; text-transform: uppercase; }
.status-new { background: #fef3c7; color: #92400e; }
.status-read { background: #dbeafe; color: #1e40af; }
.status-replied { background: #d1fae5; color: #065f46; }
.status-archived { background: #e2e8f0; color: #475569; }
.featured-badge { background: #fbbf24; color: #713f12; padding: 2px 8px; border-radius: 10px; font-size: 11px; font-weight: 600; margin-left: 6px; }
.search-bar { display: flex; gap: 8px; margin-bottom: 14px; }
.search-bar input[type="text"] { flex: 1; }
.tag-list { display: flex; flex-wrap: wrap; gap: 6px; margin-top: 6px; }
.tag-list span { background: #e2e8f0; color: #334155; padding: 2px 8px; border-radius: 4px; font-size: 12px; }
</style>
</head>
<body>
<div class="a-wrap">

<?php if ($page === 'login'): ?>
<div class="a-login">
<h2>Admin Sign In</h2>
<?php if ($error): ?><div class="msg err"><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></div><?php endif; ?>
<?php if (cms_login_locked()): ?><div class="msg err">Too many failed login attempts. Please try again later.</div><?php endif; ?>
<form method="post">
<input type="hidden" name="action" value="login"><?php csrf_field(); ?>
<label>Password</label>
<input type="password" name="password" required>
<button class="a-btn" type="submit">Sign In</button>
</form>
<p style="text-align:center;margin-top:16px;font-size:13px;color:#6b7280;">
Set <code>CMS_ADMIN_PASSWORD_HASH</code> environment variable to enable login.
</p>
</div>

<?php else: ?>
<div class="a-top">
<div>
<h1>HassanEngine Admin</h1>
<a class="a-logout" href="<?php echo $adminUrl; ?>?logout">Sign Out</a>
</div>
<div class="a-nav">
<a href="<?php echo $adminUrl; ?>?page=dashboard" class="<?php echo $page === 'dashboard' ? 'active' : ''; ?>">Dashboard</a>
<a href="<?php echo $adminUrl; ?>?page=posts" class="<?php echo $page === 'posts' ? 'active' : ''; ?>">Posts</a>
<a href="<?php echo $adminUrl; ?>?page=messages" class="<?php echo $page === 'messages' ? 'active' : ''; ?>">Messages</a>
<a href="<?php echo $adminUrl; ?>?page=settings" class="<?php echo $page === 'settings' ? 'active' : ''; ?>">Settings</a>
</div>
</div>

<?php if ($message): ?><div class="msg ok"><?php echo htmlspecialchars($message, ENT_QUOTES, 'UTF-8'); ?></div><?php endif; ?>
<?php if ($error): ?><div class="msg err"><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></div><?php endif; ?>

<?php if ($page === 'dashboard'): ?>
<div class="a-stats">
<div class="a-stat"><div class="n"><?php echo $postCount; ?></div><div class="l">Total Posts</div></div>
<div class="a-stat"><div class="n"><?php echo $featuredCount; ?></div><div class="l">Featured</div></div>
<div class="a-stat"><div class="n"><?php echo $messageCount; ?></div><div class="l">Contact Messages</div></div>
<div class="a-stat"><div class="n"><?php echo $unreadCount; ?></div><div class="l">Unread</div></div>
</div>

<div class="a-card">
<h2>Recent Posts</h2>
<table>
<thead><tr><th>Title</th><th style="width:16%">Category</th><th style="width:14%">Date</th><th style="width:12%">Featured</th><th style="width:14%">Actions</th></tr></thead>
<tbody>
<?php foreach (array_slice($allPosts, 0, 10) as $p): ?>
<tr>
<td><?php echo htmlspecialchars($p['title'] ?? '', ENT_QUOTES, 'UTF-8'); ?></td>
<td><?php echo htmlspecialchars($p['category'] ?? '', ENT_QUOTES, 'UTF-8'); ?></td>
<td><?php echo htmlspecialchars($p['date'] ?? '', ENT_QUOTES, 'UTF-8'); ?></td>
<td><?php echo !empty($p['featured']) ? '<span class="featured-badge">Featured</span>' : '-'; ?></td>
<td>
<a href="<?php echo $adminUrl; ?>?page=posts&edit=<?php echo rawurlencode($p['slug'] ?? ''); ?>" class="a-btn-ghost">Edit</a>
</td>
</tr>
<?php endforeach; ?>
<?php if (count($allPosts) === 0): ?>
<tr><td colspan="5" style="text-align:center;color:#6b7280;">No posts yet.</td></tr>
<?php endif; ?>
</tbody>
</table>
</div>

<div class="a-card">
<h2>Recent Messages</h2>
<table>
<thead><tr><th style="width:20%">Name</th><th style="width:24%">Email</th><th style="width:16%">Topic</th><th style="width:14%">Status</th><th style="width:14%">Date</th><th style="width:12%">Actions</th></tr></thead>
<tbody>
<?php foreach (array_slice($allMessages, 0, 10) as $m): ?>
<tr>
<td><?php echo htmlspecialchars($m['name'] ?? '', ENT_QUOTES, 'UTF-8'); ?></td>
<td><?php echo htmlspecialchars($m['email'] ?? '', ENT_QUOTES, 'UTF-8'); ?></td>
<td><?php echo htmlspecialchars($m['topic'] ?? '', ENT_QUOTES, 'UTF-8'); ?></td>
<td><span class="status-badge status-<?php echo htmlspecialchars($m['status'] ?? 'new', ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars(ucfirst($m['status'] ?? 'new'), ENT_QUOTES, 'UTF-8'); ?></span></td>
<td><?php echo htmlspecialchars($m['created_at'] ?? '', ENT_QUOTES, 'UTF-8'); ?></td>
<td>
<a href="<?php echo $adminUrl; ?>?page=messages" class="a-btn-ghost">View</a>
</td>
</tr>
<?php endforeach; ?>
<?php if (count($allMessages) === 0): ?>
<tr><td colspan="6" style="text-align:center;color:#6b7280;">No messages yet.</td></tr>
<?php endif; ?>
</tbody>
</table>
</div>

<?php elseif ($page === 'posts'): ?>
<div class="a-card">
<div class="a-top" style="margin-bottom:0;">
<h2 style="margin:0;">All Posts</h2>
<div class="a-actions" style="margin-left:auto;">
<button class="a-btn" onclick="document.getElementById('addForm').style.display='block'">+ Add New Post</button>
</div>
</div>
<div class="search-bar">
<form method="get" style="margin:0;display:flex;gap:8px;">
<input type="hidden" name="page" value="posts">
<input type="text" name="search" placeholder="Search title, slug, category..." value="<?php echo htmlspecialchars($search ?? '', ENT_QUOTES, 'UTF-8'); ?>">
<button class="a-btn" type="submit">Search</button>
<?php if ($search !== ''): ?>
<a href="<?php echo $adminUrl; ?>?page=posts" class="a-btn-ghost" style="margin-left:8px;">Clear</a>
<?php endif; ?>
</form>
</div>
<table>
<thead><tr><th style="width:6%">#</th><th>Title</th><th style="width:18%">Slug</th><th style="width:14%">Category</th><th style="width:14%">Date</th><th style="width:10%">Featured</th><th style="width:14%">Actions</th></tr></thead>
<tbody>
<?php foreach ($paged['items'] as $i => $p): ?>
<tr>
<td><?php echo (($paged['page'] - 1) * $paged['perPage']) + $i + 1; ?></td>
<td><?php echo htmlspecialchars($p['title'] ?? '', ENT_QUOTES, 'UTF-8'); ?></td>
<td class="slug"><?php echo htmlspecialchars($p['slug'] ?? '', ENT_QUOTES, 'UTF-8'); ?></td>
<td><?php echo htmlspecialchars($p['category'] ?? '', ENT_QUOTES, 'UTF-8'); ?></td>
<td><?php echo htmlspecialchars($p['date'] ?? '', ENT_QUOTES, 'UTF-8'); ?></td>
<td>
<form method="post" style="display:inline;" onsubmit="return confirm('Toggle featured status?');">
<input type="hidden" name="action" value="toggle_featured">
<input type="hidden" name="slug" value="<?php echo htmlspecialchars($p['slug'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
<?php csrf_field(); ?>
<label class="toggle-switch" style="margin:0;">
<input type="checkbox" name="featured" value="1" <?php echo !empty($p['featured']) ? 'checked' : ''; ?>>
<span class="toggle-slider"></span>
</label>
</form>
</td>
<td>
<a href="<?php echo $adminUrl; ?>?page=posts&edit=<?php echo rawurlencode($p['slug'] ?? ''); ?>" class="a-btn-ghost">Edit</a>
<a href="<?php echo $adminUrl; ?>?page=posts&delete_post=<?php echo rawurlencode($p['slug'] ?? ''); ?>" class="a-btn-danger" style="float:none;">Delete</a>
</td>
</tr>
<?php endforeach; ?>
<?php if (count($paged['items']) === 0): ?>
<tr><td colspan="7" style="text-align:center;color:#6b7280;">No posts found.</td></tr>
<?php endif; ?>
</tbody>
</table>
<div class="pagination">
<?php for ($pg = 1; $pg <= $paged['totalPages']; $pg++): ?>
<?php if ($pg === $paged['page']): ?>
<span class="current"><?php echo $pg; ?></span>
<?php else: ?>
<a href="<?php echo cms_url('posts', array('p' => $pg, 'search' => $search)); ?>"><?php echo $pg; ?></a>
<?php endif; ?>
<?php endfor; ?>
</div>
<p style="font-size:12px;color:#64748b;">Showing <?php echo count($paged['items']); ?> of <?php echo $paged['total']; ?> posts</p>
</div>

<div id="addForm" class="a-card" style="display:none;">
<h2>Add New Post</h2>
<?php if ($error): ?><div class="msg err"><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></div><?php endif; ?>
<form method="post">
<input type="hidden" name="action" value="add_post"><?php csrf_field(); ?>
<div class="row">
<div>
<label>Slug</label>
<input type="text" name="slug" placeholder="my-blog-post" required>
</div>
<div>
<label>Title</label>
<input type="text" name="title" placeholder="Post title" required>
</div>
<div>
<label>Category</label>
<input type="text" name="category" placeholder="Web Development">
</div>
<div>
<label>Author</label>
<input type="text" name="author" value="Hassan Raza">
</div>
<div>
<label>Date</label>
<input type="date" name="date" value="<?php echo date('Y-m-d'); ?>">
</div>
<div>
<label>Read Time</label>
<input type="text" name="read" value="5 min read">
</div>
<div>
<label>Image Path</label>
<input type="text" name="image" value="assets/images/hero/code.svg">
</div>
<div style="align-self:end;">
<label style="margin-bottom:2px;display:block;cursor:pointer;">
<input type="checkbox" name="featured" value="1"> Featured
</label>
</div>
</div>
<label>Tags (comma-separated)</label>
<input type="text" name="tags" placeholder="WordPress, SEO, Tutorial">
<label>Excerpt</label>
<textarea name="excerpt" placeholder="Short summary of the post..."></textarea>
<label>Body (one paragraph per line)</label>
<textarea name="body" placeholder="First paragraph...
Second paragraph..."></textarea>
<div class="a-actions">
<button class="a-btn" type="submit">Save Post</button>
<a class="a-btn-ghost" href="#" onclick="document.getElementById('addForm').style.display='none';return false;">Cancel</a>
</div>
</form>
</div>

<?php if ($editPost): ?>
<div class="a-card" style="margin-top:16px;">
<h2>Edit Post</h2>
<?php if ($error): ?><div class="msg err"><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></div><?php endif; ?>
<form method="post">
<input type="hidden" name="action" value="update_post">
<input type="hidden" name="slug" value="<?php echo htmlspecialchars($editPost['slug'], ENT_QUOTES, 'UTF-8'); ?>">
<?php csrf_field(); ?>
<div class="row">
<div>
<label>Title</label>
<input type="text" name="title" value="<?php echo htmlspecialchars($editPost['title'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" required>
</div>
<div>
<label>Category</label>
<input type="text" name="category" value="<?php echo htmlspecialchars($editPost['category'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
</div>
<div>
<label>Author</label>
<input type="text" name="author" value="<?php echo htmlspecialchars($editPost['author'] ?? 'Hassan Raza', ENT_QUOTES, 'UTF-8'); ?>">
</div>
<div>
<label>Date</label>
<input type="date" name="date" value="<?php echo htmlspecialchars($editPost['date'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
</div>
<div>
<label>Read Time</label>
<input type="text" name="read" value="<?php echo htmlspecialchars($editPost['read'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
</div>
<div>
<label>Image Path</label>
<input type="text" name="image" value="<?php echo htmlspecialchars($editPost['image'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
</div>
<div style="align-self:end;">
<label style="margin-bottom:2px;display:block;cursor:pointer;">
<input type="checkbox" name="featured" value="1" <?php echo !empty($editPost['featured']) ? 'checked' : ''; ?>> Featured
</label>
</div>
</div>
<label>Tags (comma-separated)</label>
<input type="text" name="tags" value="<?php echo htmlspecialchars(implode(', ', $editPost['tags'] ?? array()), ENT_QUOTES, 'UTF-8'); ?>" placeholder="WordPress, SEO, Tutorial">
<label>Excerpt</label>
<textarea name="excerpt"><?php echo htmlspecialchars($editPost['excerpt'] ?? '', ENT_QUOTES, 'UTF-8'); ?></textarea>
<label>Body (one paragraph per line)</label>
<textarea name="body"><?php echo htmlspecialchars(implode("\n", $editPost['body'] ?? array()), ENT_QUOTES, 'UTF-8'); ?></textarea>
<div class="a-actions">
<button class="a-btn" type="submit">Update Post</button>
<a class="a-btn-ghost" href="<?php echo $adminUrl; ?>?page=posts">Cancel</a>
</div>
</form>
</div>
<?php endif; ?>

<?php elseif ($page === 'messages'): ?>
<div class="a-card">
<h2>Contact Messages</h2>
<div class="a-actions" style="margin-bottom:14px;">
<span style="font-size:12px;color:#64748b;"><?php echo $messageCount; ?> total &bull; <?php echo $unreadCount; ?> unread</span>
</div>
<table>
<thead><tr><th style="width:20%">Name</th><th style="width:24%">Email</th><th style="width:14%">Phone</th><th style="width:16%">Topic</th><th style="width:14%">Status</th><th style="width:14%">Date</th><th style="width:12%">Actions</th></tr></thead>
<tbody>
<?php foreach ($allMessages as $m): ?>
<tr>
<td><?php echo htmlspecialchars($m['name'] ?? '', ENT_QUOTES, 'UTF-8'); ?></td>
<td><?php echo htmlspecialchars($m['email'] ?? '', ENT_QUOTES, 'UTF-8'); ?></td>
<td><?php echo htmlspecialchars($m['phone'] ?? '', ENT_QUOTES, 'UTF-8'); ?></td>
<td><?php echo htmlspecialchars($m['topic'] ?? '', ENT_QUOTES, 'UTF-8'); ?></td>
<td>
<form method="post" style="display:inline;" onsubmit="return confirm('Change status?');">
<input type="hidden" name="action" value="mark_message">
<input type="hidden" name="message_id" value="<?php echo htmlspecialchars($m['id'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
<?php csrf_field(); ?>
<select name="status" onchange="this.form.submit();" style="padding:4px;border-radius:4px;border:1px solid #cbd5e1;font-size:12px;">
<option value="new" <?php echo ($m['status'] ?? '') === 'new' ? 'selected' : ''; ?>>New</option>
<option value="read" <?php echo ($m['status'] ?? '') === 'read' ? 'selected' : ''; ?>>Read</option>
<option value="replied" <?php echo ($m['status'] ?? '') === 'replied' ? 'selected' : ''; ?>>Replied</option>
<option value="archived" <?php echo ($m['status'] ?? '') === 'archived' ? 'selected' : ''; ?>>Archived</option>
</select>
</form>
</td>
<td><?php echo htmlspecialchars($m['created_at'] ?? '', ENT_QUOTES, 'UTF-8'); ?></td>
<td>
<a href="mailto:<?php echo htmlspecialchars($m['email'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" class="a-btn-ghost" style="padding:4px 8px;">Reply</a>
<a href="<?php echo $adminUrl; ?>?page=messages&delete_message=<?php echo rawurlencode($m['id'] ?? ''); ?>" class="a-btn-danger" style="float:none;padding:4px 8px;">Delete</a>
</td>
</tr>
<?php endforeach; ?>
<?php if (count($allMessages) === 0): ?>
<tr><td colspan="7" style="text-align:center;color:#6b7280;">No messages yet.</td></tr>
<?php endif; ?>
</tbody>
</table>
</div>

<?php elseif ($page === 'settings'): ?>
<div class="a-card">
<h2>Settings</h2>
<p style="font-size:13px;color:#64748b;margin-bottom:16px;">Configure the admin panel and site connection.</p>
<div class="row">
<div style="min-width:260px;">
<label>Site URL</label>
<input type="text" value="<?php echo htmlspecialchars(SITE_URL, ENT_QUOTES, 'UTF-8'); ?>" disabled>
<p style="font-size:11px;color:#64748b;margin-top:4px;">Set via VERCEL environment or config.php</p>
</div>
<div style="min-width:260px;">
<label>Admin Password Hash</label>
<input type="text" value="<?php $h = getenv('CMS_ADMIN_PASSWORD_HASH'); echo $h ? substr($h, 0, 20) . '...' : 'not set'; ?>" disabled>
<p style="font-size:11px;color:#64748b;margin-top:4px;">Set CMS_ADMIN_PASSWORD_HASH environment variable</p>
</div>
<div style="min-width:260px;">
<label>Supabase URL</label>
<input type="text" value="<?php $u = getenv('SUPABASE_URL'); echo $u ? substr($u, 0, 30) . '...' : 'not set'; ?>" disabled>
<p style="font-size:11px;color:#64748b;margin-top:4px;">Posts use Supabase when configured, otherwise local JSON storage</p>
</div>
</div>
<div class="a-actions" style="margin-top:16px;">
<a href="https://hasnain-hassan.vercel.app" class="a-btn" target="_blank">Visit Live Site</a>
<a href="<?php echo $adminUrl; ?>?page=posts" class="a-btn-ghost">Back to Posts</a>
</div>
</div>
<?php endif; ?>

<?php endif; ?>
</div>
</body>
</html>
