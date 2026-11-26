<?php
/**
 * Service detail page. Content comes from $services in includes/data/content.php.
 */

require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/data/content.php';
require_once __DIR__ . '/includes/content-store.php';
content_store_apply();

/** Resolve the requested service while keeping the base URL usable. */
$requestedSlug = isset($_GET['slug']) ? trim((string) $_GET['slug']) : '';
$service = null;
foreach ($services as $candidate) {
    if ($requestedSlug === '' && $service === null) {
        $service = $candidate;
    } elseif ($requestedSlug !== '' && $candidate['slug'] === $requestedSlug) {
        $service = $candidate;
        break;
    }
}
if ($service === null) {
    http_response_code(404);
    require __DIR__ . '/not-found.php';
    exit;
}

$pageKey   = 'service-detail';
$pageTitle = $service['title'];
$pageDesc  = $service['text'];
$canonical = SITE_URL . '/' . service_url($service);
$schema_image = $service['image'];
$crumbs = array(
    array('label' => 'Services', 'file' => 'services.php'),
    array('label' => $service['title']),
);

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
<!-- Service Detail -->
<div class="service-detail">
<div class="service-detail_inner">
<div class="service-detail_image">
<img fetchpriority="high" decoding="async" src="<?php echo SITE_URL; ?>/<?php echo htmlspecialchars($service['image'], ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($service['title'], ENT_QUOTES, 'UTF-8'); ?>">
</div>
<div class="service-detail_content">
<ul class="service-detail_meta d-flex align-items-center flex-wrap">
<li><span class="icon fa-regular fa-folder fa-fw"></span><?php echo htmlspecialchars($service['category'], ENT_QUOTES, 'UTF-8'); ?></li>
</ul>
<h3 class="service-detail_heading"><?php echo htmlspecialchars($service['title'], ENT_QUOTES, 'UTF-8'); ?></h3>
<p><?php echo htmlspecialchars($service['text'], ENT_QUOTES, 'UTF-8'); ?></p>

<h4 class="service-detail_subheading">What it covers</h4>
<div class="service-detail_checks">
<div class="row clearfix">
<!-- Column -->
<div class="column col-lg-6 col-md-12 col-sm-12">
<ul class="service-detail_checklist">
<li><i class="flaticon-checked" aria-hidden="true"></i>Hands-on implementation guidance.</li>
<li><i class="flaticon-checked" aria-hidden="true"></i>Trade-offs and failure modes named up front.</li>
<li><i class="flaticon-checked" aria-hidden="true"></i>Examples drawn from production work.</li>
</ul>
</div>
<!-- Column -->
<div class="column col-lg-6 col-md-12 col-sm-12">
<ul class="service-detail_checklist">
<li><i class="flaticon-checked" aria-hidden="true"></i>Stack-agnostic principles that transfer.</li>
<li><i class="flaticon-checked" aria-hidden="true"></i>Linked articles for deeper dives.</li>
<li><i class="flaticon-checked" aria-hidden="true"></i>A clear starting point for your project.</li>
</ul>
</div>
</div>
</div>

<p><a href="services.php">Browse all services</a></p>

<!-- Comment Form -->
<div class="comment-form_outer">
<div class="group-title">
<h3>LEAVE A COMMENT</h3>
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
