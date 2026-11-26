<?php
$pageKey = 'blog';
$requestedTopic = isset($_GET['topic']) ? trim((string) $_GET['topic']) : '';
$searchQuery = isset($_GET['q']) ? trim((string) $_GET['q']) : '';
$validTopics = array('Architecture', 'Databases', 'Frontend', 'DevOps', 'Security', 'Testing', 'Career', 'Programming', 'WordPress', 'SEO', 'Web Development', 'HTML & CSS', 'JavaScript', 'Website Design', 'Website Security', 'Website Performance', 'Digital Marketing');
$topic = '';
foreach ($validTopics as $candidateTopic) {
    if ($requestedTopic !== '' && strcasecmp($requestedTopic, $candidateTopic) === 0) {
        $topic = $candidateTopic;
        break;
    }
}

// Filter posts by topic and/or search.
$filteredPosts = $posts;
if ($topic !== '') {
    $filteredPosts = array_values(array_filter($filteredPosts, function ($post) use ($topic) {
        return strcasecmp($post['category'], $topic) === 0;
    }));
}
if ($searchQuery !== '') {
    $filteredPosts = array_values(array_filter($filteredPosts, function ($post) use ($searchQuery) {
        $haystack = $post['title'] . ' ' . $post['excerpt'] . ' ' . implode(' ', $post['tags']);
        return stripos($haystack, $searchQuery) !== false;
    }));
}

// Pagination.
$postsPerPage = 6;
$totalPages = max(1, ceil(count($filteredPosts) / $postsPerPage));
$currentPage = isset($_GET['page']) ? max(1, (int) $_GET['page']) : 1;
if ($currentPage > $totalPages) {
    $currentPage = $totalPages;
}
$offset = ($currentPage - 1) * $postsPerPage;
$pagePosts = array_slice($filteredPosts, $offset, $postsPerPage);

if ($topic !== '') {
    $pageTitle = $topic . ' Articles';
    $pageDesc = 'Browse ' . $topic . ' articles on HassanEngine, with practical software engineering notes and implementation trade-offs.';
    $canonical = SITE_URL . '/blog?topic=' . rawurlencode($topic);
    $crumbs = array(array('label' => 'Blog', 'file' => 'blog.php'), array('label' => $topic));
} elseif ($searchQuery !== '') {
    $pageTitle = 'Search Results';
    $pageDesc = 'Search results for "' . htmlspecialchars($searchQuery, ENT_QUOTES, 'UTF-8') . '" on HassanEngine.';
    $canonical = SITE_URL . '/blog?q=' . rawurlencode($searchQuery);
    $crumbs = array(array('label' => 'Blog', 'file' => 'blog.php'), array('label' => 'Search'));
} else {
    $pageTitle = 'Software Engineering Articles and Tutorials';
    $pageDesc = 'Read practical articles on software development, architecture, databases, testing, security, and developer workflows.';
    $canonical = SITE_URL . '/blog';
    $crumbs = array(array('label' => 'Articles'));
}
require __DIR__ . '/bootstrap.php';
$archiveLead = !empty($pagePosts) ? $pagePosts[0] : null;
$archiveRemainder = array_slice($pagePosts, 1);
?>
<?php include __DIR__ . '/components/page-title.php'; ?>
<style>
  .page-title h1,
  .page-title h2,
  .page-title h3,
  .page-title p,
  .he-page-title h1,
  .he-page-title h2,
  .he-page-title h3,
  .he-page-title p,
  .he-blog-page h1,
  .he-blog-page h2,
  .he-blog-page h3,
  .he-blog-page h4,
  .he-blog-page h5,
  .he-blog-page h6,
  .he-blog-page p {
    font-family: inherit !important;
    font-weight: 600 !important;
  }

  .page-title h1,
  .he-page-title h1 {
    font-size: clamp(40px, 45vw, 45px) !important;
    line-height: 1.08 !important;
    margin-bottom: 16px !important;
  }

  .page-title p:not(.he-overline),
  .he-page-title p:not(.he-overline),
  .he-blog-page p:not(.he-overline) {
    font-size: 17px !important;
    line-height: 1.75 !important;
  }

  .page-title p:not(.he-overline),
  .he-page-title p:not(.he-overline) {
    margin-top: 16px !important;
    max-width: 560px;
  }

  .he-overline {
    font-size: 12px !important;
    font-weight: 600 !important;
    letter-spacing: .12em !important;
    text-transform: uppercase !important;
  }

  /* Search bar */
  .he-blog-search {
    margin-bottom: 24px;
    display: flex;
    gap: 8px;
    max-width: 500px;
  }

  .he-blog-search input[type="search"] {
    flex: 1;
    padding: 10px 16px;
    border: 1px solid #EAF5EF;
    border-radius: 6px;
    font-size: 15px;
    font-family: inherit;
  }

  .he-blog-search button {
    padding: 10px 20px;
    border: 1px solid #145C3D;
    border-radius: 6px;
    background: #145C3D;
    color: #ffffff;
    font-size: 15px;
    font-weight: 600;
    cursor: pointer;
    font-family: inherit;
  }

  .he-blog-search button:hover {
    background: #0B3828;
    border-color: #0B3828;
  }

  /* Pagination */
  .he-blog-pagination {
    display: flex;
    justify-content: center;
    gap: 8px;
    margin-top: 32px;
  }

  .he-blog-pagination a,
  .he-blog-pagination span {
    padding: 8px 16px;
    border: 1px solid #EAF5EF;
    border-radius: 6px;
    font-size: 14px;
    font-weight: 500;
    color: #0B3828;
    text-decoration: none;
  }

  .he-blog-pagination a:hover {
    border-color: #145C3D;
    color: #145C3D;
  }

  .he-blog-pagination span.current {
    background: #145C3D;
    border-color: #145C3D;
    color: #ffffff;
  }
</style>

<!-- Search -->
<?php if ($topic === ''): ?>
<form class="he-blog-search" action="blog.php" method="get" aria-label="Search articles">
    <input type="search" name="q" value="<?php echo htmlspecialchars($searchQuery, ENT_QUOTES, 'UTF-8'); ?>" placeholder="Search articles...">
    <button type="submit">Search</button>
</form>
<?php endif; ?>

<main class="he-blog-page"><section class="he-blog-archive"><div class="auto-container">
	<nav class="he-blog-topics" aria-label="Filter articles by topic"><a class="<?php echo $topic === '' ? 'is-active' : ''; ?>" href="blog.php">All writing</a><?php foreach ($validTopics as $blogTopic): ?><a class="<?php echo strcasecmp($topic, $blogTopic) === 0 ? 'is-active' : ''; ?>" href="blog.php?topic=<?php echo rawurlencode($blogTopic); ?>"><?php echo htmlspecialchars($blogTopic, ENT_QUOTES, 'UTF-8'); ?></a><?php endforeach; ?></nav>
	<header class="he-blog-heading"><p class="he-overline"><?php echo $topic !== '' ? htmlspecialchars($topic, ENT_QUOTES, 'UTF-8') . ' NOTES' : ($searchQuery !== '' ? 'SEARCH RESULTS' : 'IDEAS FOR BETTER SOFTWARE'); ?></p><h2><?php echo $topic !== '' ? 'Writing on ' . htmlspecialchars($topic, ENT_QUOTES, 'UTF-8') : ($searchQuery !== '' ? 'Results for "' . htmlspecialchars($searchQuery, ENT_QUOTES, 'UTF-8') . '"' : 'Practical ideas for building on the web.'); ?></h2><p>Explore clear explanations of software decisions, implementation details, and the trade-offs behind a system.</p></header>
	<?php if (empty($pagePosts)): ?><p class="he-blog-empty">There are no articles matching your criteria. <a href="blog.php">Browse all writing</a>.</p><?php else: ?>
	<article class="he-blog-lead"><div><p class="he-blog-meta"><?php echo htmlspecialchars($archiveLead['category'], ENT_QUOTES, 'UTF-8'); ?> <span aria-hidden="true">·</span> <?php echo htmlspecialchars($archiveLead['read'], ENT_QUOTES, 'UTF-8'); ?></p><h3><a href="<?php echo htmlspecialchars(post_url($archiveLead), ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars($archiveLead['title'], ENT_QUOTES, 'UTF-8'); ?></a></h3><p><?php echo htmlspecialchars($archiveLead['excerpt'], ENT_QUOTES, 'UTF-8'); ?></p><a class="he-pill-button" href="<?php echo htmlspecialchars(post_url($archiveLead), ENT_QUOTES, 'UTF-8'); ?>">Read the article <span aria-hidden="true">&#8594;</span></a></div><span class="he-blog-lead_mark" aria-hidden="true">H.</span></article>
	<?php if (!empty($archiveRemainder)): ?><div class="he-blog-list" aria-label="More articles"><?php foreach ($archiveRemainder as $index => $post): ?><article><span class="he-blog-list_num"><?php echo str_pad((string) ($index + 2), 2, '0', STR_PAD_LEFT); ?></span><div><p class="he-blog-meta"><?php echo htmlspecialchars($post['category'], ENT_QUOTES, 'UTF-8'); ?> <span aria-hidden="true">·</span> <?php echo htmlspecialchars($post['read'], ENT_QUOTES, 'UTF-8'); ?></p><h3><a href="<?php echo htmlspecialchars(post_url($post), ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars($post['title'], ENT_QUOTES, 'UTF-8'); ?></a></h3><p><?php echo htmlspecialchars($post['excerpt'], ENT_QUOTES, 'UTF-8'); ?></p></div><a class="he-blog-arrow" href="<?php echo htmlspecialchars(post_url($post), ENT_QUOTES, 'UTF-8'); ?>" aria-label="Read <?php echo htmlspecialchars($post['title'], ENT_QUOTES, 'UTF-8'); ?>">&#8599;</a></article><?php endforeach; ?></div><?php endif; ?>
	<?php endif; ?>
	<?php if ($totalPages > 1): ?>
	<nav class="he-blog-pagination" aria-label="Pagination">
		<?php if ($currentPage > 1): ?><a href="blog.php<?php echo $topic !== '' ? '?topic=' . rawurlencode($topic) : ''; ?><?php echo $searchQuery !== '' ? ($topic !== '' ? '&' : '?') . 'q=' . rawurlencode($searchQuery) : ''; ?>&page=<?php echo $currentPage - 1; ?>">Previous</a><?php endif; ?>
		<?php for ($p = 1; $p <= $totalPages; $p++): if ($p === $currentPage): ?><span class="current"><?php echo $p; ?></span><?php else: ?><a href="blog.php<?php echo $topic !== '' ? '?topic=' . rawurlencode($topic) : ''; ?><?php echo $searchQuery !== '' ? ($topic !== '' ? '&' : '?') . 'q=' . rawurlencode($searchQuery) : ''; ?>&page=<?php echo $p; ?>"><?php echo $p; ?></a><?php endif; endfor; ?>
		<?php if ($currentPage < $totalPages): ?><a href="blog.php<?php echo $topic !== '' ? '?topic=' . rawurlencode($topic) : ''; ?><?php echo $searchQuery !== '' ? ($topic !== '' ? '&' : '?') . 'q=' . rawurlencode($searchQuery) : ''; ?>&page=<?php echo $currentPage + 1; ?>">Next</a><?php endif; ?>
	</nav>
	<?php endif; ?>
</div></section></main>
<?php include __DIR__ . '/components/technology-slider.php'; ?>
<?php require __DIR__ . '/page-footer.php'; ?>
