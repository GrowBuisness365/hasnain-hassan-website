<?php
/** Shared HassanEngine footer. */
require_once __DIR__ . '/newsletter.php';
?>
<footer class="main-footer hassan-footer">
	<div class="widgets-section">
		<div class="auto-container">
			<div class="hassan-footer_grid">
				<div class="hassan-footer_brand">
					<a class="footer-logo" href="index.php" aria-label="HassanEngine home">
						<img src="<?php echo SITE_URL; ?>/assets/images/<?php echo LOGO_FOOTER; ?>?v=green-1" alt="<?php echo htmlspecialchars(SITE_NAME, ENT_QUOTES, 'UTF-8'); ?>">
					</a>
					<p class="footer-text"><?php echo htmlspecialchars(content_section('footer.about', $footer_about), ENT_QUOTES, 'UTF-8'); ?></p>
					<a class="hassan-footer_email" href="mailto:<?php echo htmlspecialchars(CONTACT_EMAIL, ENT_QUOTES, 'UTF-8'); ?>" aria-label="Email HassanEngine">
						<img src="<?php echo SITE_URL; ?>/assets/images/icons/email.svg" width="22" height="22" alt="">
						<?php echo htmlspecialchars(CONTACT_EMAIL, ENT_QUOTES, 'UTF-8'); ?>
					</a>
				</div>

				<nav class="hassan-footer_nav" aria-label="Footer">
					<h2 class="footer-title">Explore</h2>
					<ul class="footer-list">
						<?php foreach ($footer_company_links as $label => $href): ?>
						<li><a href="<?php echo htmlspecialchars($href, ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars($label, ENT_QUOTES, 'UTF-8'); ?></a></li>
						<?php endforeach; ?>
					</ul>
				</nav>

				<nav class="hassan-footer_latest" aria-label="Latest articles">
					<h2 class="footer-title"><?php echo htmlspecialchars(content_section('footer.articles_title', 'Latest articles'), ENT_QUOTES, 'UTF-8'); ?></h2>
					<ul class="footer-list">
						<?php foreach (array_slice($posts, 0, 4) as $post): ?>
						<li><a href="<?php echo htmlspecialchars(post_url($post), ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars($post['title'], ENT_QUOTES, 'UTF-8'); ?></a></li>
						<?php endforeach; ?>
					</ul>
				</nav>

				<div class="hassan-footer_newsletter">
					<h2 class="footer-title"><?php echo htmlspecialchars(content_section('footer.newsletter_title', 'Get new articles'), ENT_QUOTES, 'UTF-8'); ?></h2>
					<p class="hassan-footer_note"><?php echo htmlspecialchars(content_section('footer.newsletter_note', 'Occasional web development and SEO notes, delivered by email.'), ENT_QUOTES, 'UTF-8'); ?></p>
					<div class="newsletter-box" id="newsletter">
						<?php render_newsletter_status(); ?>
						<form method="post" action="subscribe.php">
							<?php render_newsletter_fields('footer-website'); ?>
							<div class="form-group">
								<label class="sr-only" for="footer-email">Email address</label>
								<input id="footer-email" type="email" name="email" value="" placeholder="Email address" autocomplete="email" required>
								<button type="submit" aria-label="Subscribe to email updates"><i class="flaticon-paper-plane"></i></button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="footer-bottom hassan-footer_bottom">
		<div class="auto-container">
			<div class="hassan-footer_copyright">
				<span>© <?php echo (int) $footer_start_year; ?>-<?php echo date('Y'); ?> <?php echo htmlspecialchars($copyright_name, ENT_QUOTES, 'UTF-8'); ?></span>
					<span>Web development &amp; SEO, made practical.</span>
			</div>
		</div>
	</div>
</footer>
