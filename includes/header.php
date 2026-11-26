<?php
/** Shared, responsive HassanEngine navigation with sticky header and dropdown menus. */
$current = isset($current) ? $current : $pageKey;
?>
<header class="hassan-site-header he-service-header" id="site-header">
	<div class="he-topbar"><div class="auto-container he-topbar_inner"><p>Web development &amp; SEO services</p><a href="mailto:<?php echo htmlspecialchars(CONTACT_EMAIL, ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars(CONTACT_EMAIL, ENT_QUOTES, 'UTF-8'); ?></a><span>Thoughtful digital work for growing businesses</span></div></div>
	<div class="auto-container hassan-site-header_inner">
		<a class="hassan-site-brand" href="index.php" aria-label="HassanEngine home">
			<img src="<?php echo SITE_URL; ?>/assets/images/<?php echo htmlspecialchars(LOGO_LIGHT, ENT_QUOTES, 'UTF-8'); ?>?v=green-1" width="224" height="60" alt="HassanEngine">
		</a>
		<nav class="hassan-primary-nav" aria-label="Main navigation">
			<?php include __DIR__ . '/nav.php'; ?>
		</nav>
		<a class="hassan-header-cta" href="contact.php">Get a quote <span aria-hidden="true">&#8599;</span></a>
		<details class="hassan-mobile-nav">
			<summary aria-label="Open navigation menu"><span></span><span></span><span></span></summary>
			<nav class="hassan-mobile-nav_panel" aria-label="Mobile navigation">
				<?php include __DIR__ . '/nav.php'; ?>
			</nav>
		</details>
	</div>
</header>
