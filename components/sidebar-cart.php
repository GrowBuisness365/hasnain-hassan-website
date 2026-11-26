<?php
/**
 * Sidebar suggestions, driven by the article data.
 */
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/data/content.php';

$sidebar_posts = array_slice($posts, 0, 3);
?>
<!-- Sidebar Cart Item -->
<div class="xs-sidebar-group info-group">
	<div class="xs-overlay xs-bg-black"></div>
	<div class="xs-sidebar-widget">
		<div class="sidebar-widget-container">
			<div class="close-button">
				<span class="fa-solid fa-xmark fa-fw"></span>
			</div>
			<div class="sidebar-textwidget">

				<!-- Sidebar Info Content -->
				<div class="sidebar-info-contents">
					<div class="content-inner">

						<!-- Title Box -->
						<div class="title-box">
							<h5>Popular <span>Articles</span></h5>
							<div class="price">Updated every week</div>
						</div>

						<!-- Lower Box -->
						<div class="lower-box">
							<h5>Recent <span>Posts</span></h5>

							<?php foreach ($sidebar_posts as $post): ?>
							<!-- Post Block -->
							<div class="post-block">
								<div class="inner-box">
									<div class="image">
									<img loading="lazy" decoding="async" src="<?php echo SITE_URL; ?>/<?php echo htmlspecialchars($post['image'], ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($post['title'], ENT_QUOTES, 'UTF-8'); ?>" />
									</div>
<h6><a href="<?php echo htmlspecialchars(post_url($post), ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars($post['title'], ENT_QUOTES, 'UTF-8'); ?></a></h6>
									<div class="rating">
										<span class="fa fa-star" aria-hidden="true"></span>
										<span class="fa fa-star" aria-hidden="true"></span>
										<span class="fa fa-star" aria-hidden="true"></span>
										<span class="fa fa-star" aria-hidden="true"></span>
										<span class="fa fa-star" aria-hidden="true"></span>
									</div>
									<div class="price-box"><?php echo htmlspecialchars($post['category'], ENT_QUOTES, 'UTF-8'); ?></div>
<a class="theme-btn bag-btn" href="<?php echo htmlspecialchars(post_url($post), ENT_QUOTES, 'UTF-8'); ?>">Read More</a>
								</div>
							</div>
							<?php endforeach; ?>

						</div>

					</div>
				</div>

			</div>
		</div>
	</div>
</div>
