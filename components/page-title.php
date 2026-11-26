<?php
/** Shared engineering themed hero and breadcrumb for interior pages. */
$crumbs = isset($crumbs) && is_array($crumbs) ? $crumbs : array();
$lastCrumb = count($crumbs) - 1;
$heroLabels = array(
    'about' => 'About HassanEngine', 'blog' => 'Development insights',
    'blog-classic' => 'Development insights', 'blog-sidebar' => 'Development insights',
    'blog-detail' => 'Engineering notes', 'contact' => 'Project enquiries',
    'disclaimer' => 'HassanEngine disclaimer', 'faq' => 'Common questions',
    'privacy-policy' => 'Privacy policy', 'property' => 'Project notes',
    'property-detail' => 'Project notes', 'resources' => 'Resource library',
    'seo' => 'SEO knowledge hub', 'service-detail' => 'Topic guide',
    'services' => 'Web development and SEO', 'sitemap' => 'Site map',
    'team' => 'Contributors', 'team-detail' => 'Author profile',
    'terms-and-conditions' => 'Terms and conditions', 'web-development' => 'Web development hub',
    'not-found' => 'HassanEngine journal',
);
$heroImages = array(
    'about' => 'story-3.optimized.jpg',
    'blog' => 'story-2.optimized.jpg',
    'blog-classic' => 'story-2.optimized.jpg',
    'blog-sidebar' => 'story-2.optimized.jpg',
    'blog-detail' => 'story-2.optimized.jpg',
    'contact' => 'contact.optimized.jpg',
    'disclaimer' => 'story-2.optimized.jpg',
    'faq' => 'faq.optimized.jpg',
    'privacy-policy' => 'story-2.optimized.jpg',
    'property' => 'story-2.optimized.jpg',
    'property-detail' => 'story-2.optimized.jpg',
    'resources' => 'news-1.optimized.jpg',
    'seo' => 'database.svg',
    'service-detail' => 'code.svg',
    'services' => 'services.optimized.jpg',
    'sitemap' => 'story-2.optimized.jpg',
    'team' => 'story-2.optimized.jpg',
    'team-detail' => 'story-2.optimized.jpg',
    'terms-and-conditions' => 'story-2.optimized.jpg',
    'web-development' => 'code.svg',
    'not-found' => 'story-2.optimized.jpg',
);
$heroImage = isset($heroImages[$pageKey]) ? $heroImages[$pageKey] : 'story-2.optimized.jpg';
$heroLabel = isset($heroLabels[$pageKey]) ? $heroLabels[$pageKey] : 'HassanEngine journal';
$heroDescription = isset($pageDesc) && is_string($pageDesc) ? $pageDesc : '';
if ($pageKey === 'blog-detail' && isset($post['excerpt'])) {
    $heroDescription = $post['excerpt'];
}
if ($pageKey === 'property-detail' && isset($project['text'])) {
    $heroDescription = $project['text'];
}
if (function_exists('content_section')) {
    $heroDescription = content_section('hero.' . $pageKey . '.description', $heroDescription);
}
$heroImageUrl = SITE_URL . '/assets/images/resource/' . $heroImage;
$heroBgStyle = in_array(pathinfo($heroImage, PATHINFO_EXTENSION), array('svg')) ? 'contain' : 'cover';
?>
<section class="page-title hassan-page-hero" aria-labelledby="page-hero-title" style="background-image: url('<?php echo htmlspecialchars($heroImageUrl, ENT_QUOTES, 'UTF-8'); ?>'); background-size: <?php echo $heroBgStyle; ?>; background-position: center; background-repeat: no-repeat;">
	<div class="auto-container hassan-page-hero_inner">
		<div class="hassan-page-hero_copy">
			<p class="hassan-hero_eyebrow"><span></span><?php echo htmlspecialchars($heroLabel, ENT_QUOTES, 'UTF-8'); ?></p>
			<h1 id="page-hero-title"><?php echo htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8'); ?></h1>
			<?php if ($heroDescription !== ''): ?><p class="hassan-page-hero_summary"><?php echo htmlspecialchars($heroDescription, ENT_QUOTES, 'UTF-8'); ?></p><?php endif; ?>
			<nav aria-label="Breadcrumb">
				<ol class="bread-crumb clearfix">
					<li><a href="index.php">Home</a></li>
					<?php foreach ($crumbs as $i => $crumb): ?>
					<li>
						<?php if ($i === $lastCrumb || empty($crumb['file'])): ?>
							<span aria-current="page"><?php echo htmlspecialchars($crumb['label'], ENT_QUOTES, 'UTF-8'); ?></span>
						<?php else: ?>
							<a href="<?php echo htmlspecialchars($crumb['file'], ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars($crumb['label'], ENT_QUOTES, 'UTF-8'); ?></a>
						<?php endif; ?>
					</li>
					<?php endforeach; ?>
				</ol>
			</nav>
		</div>
	</div>
</section>
