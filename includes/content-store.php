<?php
/**
 * Optional Supabase-backed content override for Vercel.
 *
 * Content remains available from includes/data/content.php when the database
 * is not configured or a temporary network failure occurs.
 */

function content_store_configured()
{
    return (bool) (getenv('SUPABASE_URL') && getenv('SUPABASE_SECRET_KEY') && function_exists('curl_init'));
}

function content_store_request($method, $query = '', $payload = null)
{
    if (!content_store_configured()) {
        return false;
    }

    $baseUrl = rtrim((string) getenv('SUPABASE_URL'), '/');
    if (strpos($baseUrl, 'https://') !== 0) {
        return false;
    }

    $url = $baseUrl . '/rest/v1/site_content' . $query;
    $headers = array(
        'apikey: ' . getenv('SUPABASE_SECRET_KEY'),
        'Authorization: Bearer ' . getenv('SUPABASE_SECRET_KEY'),
        'Content-Type: application/json',
        'Accept: application/json',
    );
    if ($method === 'POST') {
        $headers[] = 'Prefer: resolution=merge-duplicates,return=representation';
    }

    $curl = curl_init($url);
    curl_setopt_array($curl, array(
        CURLOPT_CUSTOMREQUEST  => $method,
        CURLOPT_HTTPHEADER     => $headers,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CONNECTTIMEOUT_MS => 350,
        CURLOPT_TIMEOUT_MS        => 1200,
        CURLOPT_SSL_VERIFYPEER => true,
        CURLOPT_SSL_VERIFYHOST => 2,
    ));
    if ($payload !== null) {
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($payload, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
    }

    $body = curl_exec($curl);
    $status = (int) curl_getinfo($curl, CURLINFO_HTTP_CODE);
    $failed = $body === false || $status < 200 || $status >= 300;
    if ($failed) {
        error_log('HassanEngine content store request failed (HTTP ' . $status . ').');
        return false;
    }

    if ($body === '' || $body === null) {
        return array();
    }

    $decoded = json_decode($body, true);
    return is_array($decoded) ? $decoded : false;
}

/** Path to the local content storage file (used when Supabase is not configured). */
function content_store_local_path()
{
    return __DIR__ . '/../storage/content.json';
}

/** Reads all content groups from the local storage file. */
function content_store_local_read()
{
    $path = content_store_local_path();
    if (!is_file($path) || !is_readable($path)) {
        return false;
    }
    $data = json_decode((string) @file_get_contents($path), true);
    return is_array($data) ? $data : false;
}

/** Writes all content groups to the local storage file. */
function content_store_local_write($content)
{
    if (!is_array($content)) {
        return false;
    }
    $dir = dirname(content_store_local_path());
    if (!is_dir($dir) && !@mkdir($dir, 0755, true)) {
        return false;
    }
    $payload = json_encode($content, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    if ($payload === false) {
        return false;
    }
    return (bool) @file_put_contents(content_store_local_path(), $payload, LOCK_EX);
}
function content_store_cache_path()
{
    $identity = (string) getenv('SUPABASE_URL');
    return rtrim(sys_get_temp_dir(), DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR
        . 'hassanengine-content-' . substr(hash('sha256', $identity), 0, 20) . '.json';
}

function content_store_cache_read($allowStale = false)
{
    $path = content_store_cache_path();
    if (!is_file($path) || !is_readable($path)) {
        return false;
    }

    $cache = json_decode((string) @file_get_contents($path), true);
    if (!is_array($cache) || !isset($cache['expires'], $cache['saved'], $cache['content']) || !is_array($cache['content'])) {
        return false;
    }
    if ((int) $cache['expires'] < time() && (!$allowStale || time() - (int) $cache['saved'] > 300)) {
        return false;
    }

    return $cache['content'];
}

function content_store_cache_write($content, $ttl = 15)
{
    if (!is_array($content)) {
        return;
    }
    $payload = json_encode(array(
        'expires' => time() + max(1, (int) $ttl),
        'saved'   => time(),
        'content' => $content,
    ), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    if ($payload !== false) {
        @file_put_contents(content_store_cache_path(), $payload, LOCK_EX);
    }
}

function content_store_groups()
{
    return array('posts', 'categories', 'team', 'services', 'projects', 'topics', 'testimonials', 'faqs', 'seo_pages', 'sections', 'footer_links');
}

function content_store_load_all($force = false)
{
    static $loaded = false;
    static $content = array();
    if ($loaded && !$force) {
        return $content;
    }
    $loaded = true;

    if (content_store_configured()) {
        $cached = content_store_cache_read();
        if (is_array($cached)) {
            $content = $cached;
            return $content;
        }

        $rows = content_store_request('GET', '?select=section_key,payload&order=section_key.asc');
        if (!is_array($rows)) {
            $stale = content_store_cache_read(true);
            if (is_array($stale)) {
                $content = $stale;
                content_store_cache_write($content, 15);
            } else {
                content_store_cache_write(array(), 10);
            }
            return $content;
        }

        foreach ($rows as $row) {
            if (isset($row['section_key'], $row['payload']) && in_array($row['section_key'], content_store_groups(), true) && is_array($row['payload'])) {
                $content[$row['section_key']] = $row['payload'];
            }
        }
        content_store_cache_write($content, 15);
        return $content;
    }

    // Fall back to local file storage when Supabase is not configured.
    $local = content_store_local_read();
    if (is_array($local)) {
        $content = $local;
        return $content;
    }

    return array();
}

function content_store_defaults()
{
    global $posts, $categories, $team, $services, $projects, $topics, $testimonials, $faqs, $seo_pages, $footer_company_links;
    return array(
        'posts'        => $posts,
        'categories'   => $categories,
        'team'         => $team,
        'services'     => $services,
        'projects'     => $projects,
        'topics'       => $topics,
        'testimonials' => $testimonials,
        'faqs'         => $faqs,
        'seo_pages'    => $seo_pages,
        'sections'     => array(),
        'footer_links' => $footer_company_links,
    );
}

function content_store_apply()
{
    global $seo_pages, $managed_sections;
    $defaults = content_store_defaults();
    $managed = content_store_load_all();

    foreach (content_store_groups() as $group) {
        if (!isset($managed[$group]) || !is_array($managed[$group])) {
            continue;
        }
        if ($group === 'seo_pages') {
            foreach ($managed[$group] as $key => $meta) {
                if (isset($seo_pages[$key]) && is_array($meta)) {
                    $seo_pages[$key] = array_merge($seo_pages[$key], $meta);
                }
            }
        } elseif ($group === 'sections') {
            $managed_sections = $managed[$group];
        } elseif ($group === 'footer_links') {
            $GLOBALS['footer_company_links'] = $managed[$group];
        } elseif (isset($defaults[$group]) && is_array($managed[$group])) {
            $GLOBALS[$group] = $managed[$group];
        }
    }
}

function content_store_save_group($group, $payload)
{
    if (!in_array($group, content_store_groups(), true) || !is_array($payload)) {
        return false;
    }

    if (content_store_configured()) {
        $result = content_store_request('POST', '?on_conflict=section_key', array(
            'section_key' => $group,
            'payload'     => $payload,
        ));
        if (is_array($result)) {
            $cached = content_store_cache_read(true);
            if (!is_array($cached)) {
                $cached = array();
            }
            $cached[$group] = $payload;
            content_store_cache_write($cached, 15);
        }
        return is_array($result);
    }

    // Fall back to local file storage when Supabase is not configured.
    $content = content_store_local_read();
    if (!is_array($content)) {
        $content = array();
    }
    $content[$group] = $payload;
    return content_store_local_write($content);
}

/** Reads an optional editable section string, with a safe template fallback. */
function content_section($key, $fallback)
{
    global $managed_sections;
    return isset($managed_sections[$key]) && is_string($managed_sections[$key])
        ? $managed_sections[$key]
        : $fallback;
}
