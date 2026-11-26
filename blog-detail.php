<?php
/**
 * Article detail page. Content comes from $posts in includes/data/content.php.
 */

require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/data/content.php';
require_once __DIR__ . '/includes/content-store.php';
content_store_apply();

/** Resolve the requested article while keeping the original detail URL usable. */
$requestedSlug = isset($_GET['slug']) ? trim((string) $_GET['slug']) : '';
$postIndex = 0;
$post = null;
foreach ($posts as $index => $candidate) {
    if ($requestedSlug === '' && $index === 0 || $requestedSlug === $candidate['slug']) {
        $post = $candidate;
        $postIndex = $index;
        break;
    }
}
if ($post === null) {
    http_response_code(404);
    require __DIR__ . '/not-found.php';
    exit;
}
$prev_index = ($postIndex + count($posts) - 1) % count($posts);
$next_index = ($postIndex + 1) % count($posts);

$author = $post['author'];
$author_row = null;
foreach ($team as $member) {
    if ($member['name'] === $author) {
        $author_row = $member;
        break;
    }
}
if ($author_row === null) {
    $author_row = $team[0];
}

// Related articles: share tags or category with current post.
$relatedPosts = array();
foreach ($posts as $candidate) {
    if ($candidate['slug'] === $post['slug']) {
        continue;
    }
    $sharedTags = array_intersect($post['tags'], $candidate['tags']);
    if (count($sharedTags) > 0 || strcasecmp($candidate['category'], $post['category']) === 0) {
        $relatedPosts[] = $candidate;
    }
    if (count($relatedPosts) >= 3) {
        break;
    }
}

$pageKey   = 'blog-detail';
$pageTitle = $post['title'];
$pageDesc  = $post['excerpt'];
$crumbs = array(
    array('label' => 'Blog', 'file' => 'blog.php'),
    array('label' => $post['category'], 'file' => 'blog.php'),
    array('label' => $post['title']),
);

$schema_headline = $post['title'];
$schema_date     = $post['date'];
$schema_author   = $post['author'];
$schema_image    = $post['image'];
$canonical = SITE_URL . '/blog-detail?slug=' . rawurlencode($post['slug']);
$updatedDate = isset($post['updated']) ? $post['updated'] : $post['date'];

require __DIR__ . '/bootstrap.php';
?>
	
<!-- Page Title -->
	<?php include __DIR__ . '/components/page-title.php'; ?>
    <!-- End Page Title -->
	
<!-- Sidebar Page Container -->
<div class="sidebar-page-container">
<div class="auto-container">
<div class="row clearfix">

<!-- Content Side -->
<div class="content-side col-lg-8 col-md-12 col-sm-12">
<div class="blog-detail">
<div class="blog-detail_inner">
<div class="blog-detail_image">
<img fetchpriority="high" decoding="async" src="<?php echo SITE_URL; ?>/<?php echo htmlspecialchars($post['image'], ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($post['title'], ENT_QUOTES, 'UTF-8'); ?>">
</div>
<div class="blog-detail_content">
<div class="blog-detail_author-outer d-flex align-items-center flex-wrap">
<div class="blog-detail-author d-flex align-items-center flex-wrap">
<div class="blog-detail-author-image">
<img src="<?php echo SITE_URL; ?>/<?php echo htmlspecialchars($author_row['image'], ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($author_row['name'], ENT_QUOTES, 'UTF-8'); ?>">
</div>
 By <?php echo htmlspecialchars($post['author'], ENT_QUOTES, 'UTF-8'); ?>
</div>
<ul class="blog-detail-meta d-flex align-items-center flex-wrap">
<li><span class="icon fa-regular fa-calendar fa-fw"></span>Published <?php echo date('j M, Y', strtotime($post['date'])); ?></li>
<?php if ($updatedDate !== $post['date']): ?><li><span class="icon fa-regular fa-pen fa-fw"></span>Updated <?php echo date('j M, Y', strtotime($updatedDate)); ?></li><?php endif; ?>
<li><span class="icon fa-regular fa-comment-dots fa-fw"></span><?php echo htmlspecialchars($post['read'], ENT_QUOTES, 'UTF-8'); ?></li>
</ul>
</div>
<h1 class="blog-detail_heading"><?php echo htmlspecialchars($post['title'], ENT_QUOTES, 'UTF-8'); ?></h1>
<p><?php echo htmlspecialchars($post['excerpt'], ENT_QUOTES, 'UTF-8'); ?></p>
<p><?php echo htmlspecialchars($post['category'], ENT_QUOTES, 'UTF-8'); ?> · <?php echo htmlspecialchars($post['read'], ENT_QUOTES, 'UTF-8'); ?></p>

<?php if (!empty($post['body']) && is_array($post['body'])): ?>
<?php
// Build table of contents from body headings.
$tocItems = array();
$headingCount = 0;
foreach ($post['body'] as $paragraph):
    if (is_string($paragraph) && trim($paragraph) !== ''):
        // Check for markdown-style headings.
        if (preg_match('/^(#{2,3})\s+(.+)$/', $paragraph, $matches)) {
            $level = strlen($matches[1]);
            $text = trim($matches[2]);
            $anchor = 'heading-' . (++$headingCount);
            $tocItems[] = array('level' => $level, 'text' => $text, 'anchor' => $anchor);
            echo '<h' . $level . ' id="' . htmlspecialchars($anchor, ENT_QUOTES, 'UTF-8') . '">' . htmlspecialchars($text, ENT_QUOTES, 'UTF-8') . '</h' . $level . '>';
        } else {
            echo '<p>' . nl2br(htmlspecialchars($paragraph, ENT_QUOTES, 'UTF-8')) . '</p>';
        }
    endif;
endforeach;
?>
<?php if (!empty($tocItems)): ?>
<div class="he-toc" style="margin-top: 32px; padding: 20px; background: #EAF5EF; border-radius: 8px; border: 1px solid #EAF5EF;">
    <h3 style="font-size: 18px; color: #145C3D !important; margin-top: 0;">Table of Contents</h3>
    <ul style="margin: 0; padding-left: 20px; color: #0B3828 !important;">
        <?php foreach ($tocItems as $item): ?>
        <li style="margin-bottom: 6px; font-size: 14px;"><a href="#<?php echo htmlspecialchars($item['anchor'], ENT_QUOTES, 'UTF-8'); ?>" style="color: #0B3828 !important; text-decoration: none;"><?php echo htmlspecialchars($item['text'], ENT_QUOTES, 'UTF-8'); ?></a></li>
        <?php endforeach; ?>
    </ul>
</div>
<?php endif; ?>
<?php endif; ?>

<ul class="blog-detail_list">
<?php foreach ($post['tags'] as $tag): ?>
<li><i class="fa-solid fa-check fa-fw" aria-hidden="true"></i><?php echo htmlspecialchars($tag, ENT_QUOTES, 'UTF-8'); ?></li>
<?php endforeach; ?>
</ul>

<!-- Post Share Options-->
<div class="post-share-options">
<div class="post-share-inner d-flex justify-content-between flex-wrap">
<div class="post-tags">
<?php foreach ($post['tags'] as $tag): ?>
<a href="<?php echo htmlspecialchars(SEARCH_ACTION, ENT_QUOTES, 'UTF-8'); ?>?q=<?php echo rawurlencode($tag); ?>"><?php echo htmlspecialchars($tag, ENT_QUOTES, 'UTF-8'); ?></a>
<?php endforeach; ?>
</div>
<ul class="social-links">
<?php foreach ($social as $key => $url): if (!$url || !isset($social_icons[$key])) continue; ?>
<li><a href="<?php echo htmlspecialchars($url, ENT_QUOTES, 'UTF-8'); ?>" class="fa-brands <?php echo htmlspecialchars($social_icons[$key], ENT_QUOTES, 'UTF-8'); ?> fa-fw" aria-label="Share on <?php echo htmlspecialchars(ucfirst($key), ENT_QUOTES, 'UTF-8'); ?>"></a></li>
<?php endforeach; ?>
</ul>
</div>
</div>

<!-- Related Articles -->
<?php if (!empty($relatedPosts)): ?>
<div class="he-related-articles" style="margin-top: 40px;">
    <h3 style="font-size: 18px; color: #145C3D !important; margin-bottom: 16px;">Related Articles</h3>
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 20px;">
        <?php foreach ($relatedPosts as $related): ?>
        <div style="border: 1px solid #EAF5EF; border-radius: 8px; padding: 20px; background: #ffffff;">
            <h4 style="font-size: 16px; color: #145C3D !important; margin: 0 0 8px 0;"><?php echo htmlspecialchars($related['title'], ENT_QUOTES, 'UTF-8'); ?></h4>
            <p style="font-size: 14px; color: #6B8E79 !important; margin: 0 0 12px 0;"><?php echo htmlspecialchars($related['excerpt'], ENT_QUOTES, 'UTF-8'); ?></p>
            <a href="<?php echo htmlspecialchars(post_url($related), ENT_QUOTES, 'UTF-8'); ?>" style="font-size: 14px; font-weight: 600; color: #0B3828 !important; text-decoration: none;">Read article <span aria-hidden="true">&#8594;</span></a>
        </div>
        <?php endforeach; ?>
    </div>
</div>
<?php endif; ?>

<!-- Blog More Posts -->
<div class="blog-more_posts">
<div class="blog-more_posts-inner d-flex justify-content-between flex-wrap">
<a href="<?php echo htmlspecialchars(post_url($posts[$prev_index]), ENT_QUOTES, 'UTF-8'); ?>" class="prev-post">
<i class="flaticon-left-arrow" aria-hidden="true"></i>
 Previous post
<span><?php echo htmlspecialchars($posts[$prev_index]['title'], ENT_QUOTES, 'UTF-8'); ?></span>
</a>
<a href="<?php echo htmlspecialchars(post_url($posts[$next_index]), ENT_QUOTES, 'UTF-8'); ?>" class="next-post">
<i class="flaticon-next-1"></i>
 Next Post
<span><?php echo htmlspecialchars($posts[$next_index]['title'], ENT_QUOTES, 'UTF-8'); ?></span>
</a>
</div>
</div>
<!-- End Blog More Posts -->

<!-- Author Box -->
<div class="blog-author_box">
<div class="blog-author-box_inner">
<div class="blog-author-box_content">
<div class="blog-author-box_image">
<img src="<?php echo SITE_URL; ?>/<?php echo htmlspecialchars($author_row['image'], ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($author_row['name'], ENT_QUOTES, 'UTF-8'); ?>">
</div>
<h5><?php echo htmlspecialchars($author_row['name'], ENT_QUOTES, 'UTF-8'); ?></h5>
<div class="blog-author_box-designation"><?php echo htmlspecialchars($author_row['role'], ENT_QUOTES, 'UTF-8'); ?></div>
<div class="blog-author_box-text"><?php echo htmlspecialchars($author_row['bio'], ENT_QUOTES, 'UTF-8'); ?></div>
<ul class="blog-author_socials">
<?php foreach ($social as $key => $url): if (!$url || !isset($social_icons[$key])) continue; ?>
<li><a href="<?php echo htmlspecialchars($url, ENT_QUOTES, 'UTF-8'); ?>" class="fa-brands <?php echo htmlspecialchars($social_icons[$key], ENT_QUOTES, 'UTF-8'); ?> fa-fw" aria-label="<?php echo htmlspecialchars(ucfirst($key), ENT_QUOTES, 'UTF-8'); ?>"></a></li>
<?php endforeach; ?>
</ul>
</div>
</div>
</div>

<!-- Comment Form -->
<div class="comment-form_outer">
<div class="group-title">
<h3>Leave a comment</h3>
</div>
<!-- Comment Form -->
<div class="comment-form">
<?php include __DIR__ . '/components/comment-form.php'; ?>
<!-- End Comment Form -->
</div>
<!--End Comment Form -->

</div>
</div>
</div>
</div>
</div>

<!-- Sidebar Side -->
<div class="sidebar-side col-lg-4 col-md-12 col-sm-12">
<aside class="sidebar">
<div class="sidebar-inner">
<?php include __DIR__ . '/components/sidebar-widgets.php'; ?>
</div>
</aside>
</div>

</div>
</div>
</div>
<?php include __DIR__ . '/components/technology-slider.php'; ?>
<?php require __DIR__ . '/page-footer.php'; ?>
