<?php
/**
 * Blog sidebar widgets, shared by the article, project and archive pages.
 *
 * Expects $posts, $categories, $team and $social to be available (they are
 * loaded by bootstrap.php).
 */

$popular_posts = array_slice($posts, 1, 3);
$about_author = $team[0];

// Most-used tags across every article.
$tag_counts = array();
foreach ($posts as $p) {
    foreach ($p['tags'] as $tag) {
        $tag_counts[$tag] = isset($tag_counts[$tag]) ? $tag_counts[$tag] + 1 : 1;
    }
}
arsort($tag_counts);
$popular_tags = array_slice(array_keys($tag_counts), 0, 10);
?>
<!-- Search Widget -->
<div class="sidebar-widget search-box">
	<div class="widget-content">
		<h5 class="sidebar-widget_title">Search Articles</h5>
		<form method="get" action="<?php echo htmlspecialchars(SEARCH_ACTION, ENT_QUOTES, 'UTF-8'); ?>">
			<div class="form-group">
				<input type="search" name="q" value="<?php echo htmlspecialchars(isset($_GET['q']) ? $_GET['q'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="Search...">
				<button type="submit" aria-label="Search"><span class="icon fa fa-search"></span></button>
			</div>
		</form>
	</div>
</div>

<!-- About Widget -->
<div class="sidebar-widget about-widget">
	<div class="widget-content">
		<div class="author-image">
			<img src="<?php echo SITE_URL; ?>/<?php echo htmlspecialchars($about_author['image'], ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($about_author['name'], ENT_QUOTES, 'UTF-8'); ?>">
		</div>
		<h5><?php echo htmlspecialchars($about_author['name'], ENT_QUOTES, 'UTF-8'); ?></h5>
		<div class="designation"><?php echo htmlspecialchars($about_author['role'], ENT_QUOTES, 'UTF-8'); ?></div>
		<div class="text"><?php echo htmlspecialchars($about_author['bio'], ENT_QUOTES, 'UTF-8'); ?></div>
		<!-- Social Box -->
		<div class="social-box">
			<?php render_social_links(); ?>
		</div>
	</div>
</div>

<!-- Message Widget -->
<div class="sidebar-widget message-widget">
	<div class="widget-content">
		<h5 class="sidebar-widget_title">Message for Corrections</h5>
		<div class="message-form">
			<form method="get" action="contact.php">

				<!-- Form Group -->
				<div class="form-group">
					<input type="text" name="name" value="" placeholder="Name*" required>
				</div>

				<!--Form Group-->
				<div class="form-group">
					<input type="email" name="email" value="" placeholder="Email*" required>
				</div>

				<div class="form-group">
					<textarea class="" name="message" placeholder="Message"></textarea>
				</div>

				<div class="form-group">
					<button type="submit" class="template-btn btn-style-one">
						<span class="btn-wrap">
							<span class="text-one">submit now</span>
							<span class="text-two">submit now</span>
						</span>
					</button>
				</div>

			</form>
		</div>
	</div>
</div>

<!-- Post Widget -->
<div class="sidebar-widget post-widget">
	<div class="widget-content">
		<h5 class="sidebar-widget_title">Popular Posts</h5>
		<?php foreach ($popular_posts as $p): ?>
		<div class="post">
<div class="thumb"><a href="<?php echo htmlspecialchars(post_url($p), ENT_QUOTES, 'UTF-8'); ?>"><img loading="lazy" decoding="async" src="<?php echo SITE_URL; ?>/<?php echo htmlspecialchars($p['image'], ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($p['title'], ENT_QUOTES, 'UTF-8'); ?>"></a></div>
<h6><a href="<?php echo htmlspecialchars(post_url($p), ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars($p['title'], ENT_QUOTES, 'UTF-8'); ?></a></h6>
			<div class="post-date"><i><img src="<?php echo SITE_URL; ?>/assets/images/icons/calendar.svg" alt="" /></i> <?php echo date('M j, Y', strtotime($p['date'])); ?></div>
		</div>
		<?php endforeach; ?>
	</div>
</div>

<!-- Category Widget -->
<div class="sidebar-widget category-widget">
	<div class="widget-content">
		<h5 class="sidebar-widget_title">Categories</h5>
		<ul class="service-list">
			<?php foreach ($categories as $cat): ?>
			<li><a href="<?php echo htmlspecialchars($cat['file'], ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars($cat['name'], ENT_QUOTES, 'UTF-8'); ?><span>(<?php echo str_pad((int) $cat['count'], 2, '0', STR_PAD_LEFT); ?>)</span></a></li>
			<?php endforeach; ?>
		</ul>
	</div>
</div>

<!-- Popular Tags -->
<div class="sidebar-widget popular-tags">
	<div class="widget-content">
		<h5 class="sidebar-widget_title">Popular Tags</h5>
		<?php foreach ($popular_tags as $tag): ?>
		<a href="<?php echo htmlspecialchars(SEARCH_ACTION, ENT_QUOTES, 'UTF-8'); ?>?q=<?php echo rawurlencode($tag); ?>"><?php echo htmlspecialchars($tag, ENT_QUOTES, 'UTF-8'); ?></a>
		<?php endforeach; ?>
	</div>
</div>
