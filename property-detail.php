<?php
/**
 * Project detail page. Content comes from $projects in includes/data/content.php.
 */

require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/data/content.php';
require_once __DIR__ . '/includes/content-store.php';
content_store_apply();

/** Resolve the selected project; keep the base URL mapped to the first entry. */
$requestedProject = isset($_GET['project']) ? trim((string) $_GET['project']) : '';
$project = null;
foreach ($projects as $candidate) {
    if ($requestedProject === '' && $project === null) {
        $project = $candidate;
    } elseif ($requestedProject !== '' && project_slug($candidate) === $requestedProject) {
        $project = $candidate;
        break;
    }
}
if ($project === null) {
    http_response_code(404);
    require __DIR__ . '/not-found.php';
    exit;
}

$pageKey  = 'property-detail';
$pageTitle = $project['title'];
$pageDesc = $project['text'];
$canonical = SITE_URL . '/' . project_url($project);
$schema_image = $project['image'];
$crumbs = array(
	array('label' => 'Projects', 'file' => 'property.php'),
	array('label' => $project['title']),
);

require __DIR__ . '/bootstrap.php';

$facts = array(
    array('icon' => 'fa-solid fa-file-lines', 'title' => 'Articles', 'text' => $project['articles'] . ' write-ups'),
    array('icon' => 'fa-solid fa-tags', 'title' => 'Topics', 'text' => count($project['tags']) . ' covered'),
    array('icon' => 'fa-solid fa-signal', 'title' => 'Status', 'text' => $project['status']),
);
$amenities = $project['tags'];
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
<!-- Project Detail -->
<div class="property-detail">
<div class="property-detail_inner">
<div class="property-detail_content">
<ul class="property-detail_meta d-flex align-items-center flex-wrap">
<?php if ($project['badge'] !== ''): ?><i><?php echo htmlspecialchars($project['badge'], ENT_QUOTES, 'UTF-8'); ?></i><?php endif; ?>
<li><span class="icon fa-regular fa-user fa-fw"></span><?php echo htmlspecialchars($team[0]['name'], ENT_QUOTES, 'UTF-8'); ?></li>
<li><span class="icon fa-regular fa-comment-dots fa-fw"></span><?php echo $project['articles']; ?> Articles</li>
</ul>
<h3 class="property-detail_heading"><?php echo htmlspecialchars($project['title'], ENT_QUOTES, 'UTF-8'); ?></h3>
<p class="hassan-project-card_stack">Technology stack: <?php echo htmlspecialchars($project['stack'], ENT_QUOTES, 'UTF-8'); ?></p>
<p><?php echo htmlspecialchars($project['text'], ENT_QUOTES, 'UTF-8'); ?></p>
<p><?php echo htmlspecialchars(SITE_DESCRIPTION, ENT_QUOTES, 'UTF-8'); ?></p>

<h4 class="property-detail_subheading">Project Details</h4>
<div class="propert-info">
<div class="row clearfix">
<!-- Column -->
<div class="column col-lg-6 col-md-12 col-sm-12">
<ul class="propert-info_list">
<li>Status<span><?php echo htmlspecialchars($project['status'], ENT_QUOTES, 'UTF-8'); ?></span></li>
<li>Stack<span><?php echo htmlspecialchars($project['stack'], ENT_QUOTES, 'UTF-8'); ?></span></li>
<li>Topics<span><?php echo count($project['tags']); ?></span></li>
<li>Articles<span><?php echo $project['articles']; ?></span></li>
<li>Last Updated<span><?php echo htmlspecialchars($project['updated'], ENT_QUOTES, 'UTF-8'); ?></span></li>
</ul>
</div>
<!-- Column -->
<div class="column col-lg-6 col-md-12 col-sm-12">
<ul class="propert-info_list">
<li>Contributor<span><?php echo htmlspecialchars($team[0]['name'], ENT_QUOTES, 'UTF-8'); ?></span></li>
<li>Topics<span><?php echo htmlspecialchars(implode(', ', $project['tags']), ENT_QUOTES, 'UTF-8'); ?></span></li>
<li>Featured<span><?php echo $project['featured'] ? 'Yes' : 'No'; ?></span></li>
</ul>
</div>
</div>
</div>

<h4 class="property-detail_subheading">Project Facts</h4>
<div class="row clearfix">
<?php foreach ($facts as $fact): ?>
<!-- Property Block Two -->
<div class="property-block_two col-lg-4 col-md-4 col-sm-6">
<div class="property-block_two-inner">
<div class="property-block_two-icon <?php echo htmlspecialchars($fact['icon'], ENT_QUOTES, 'UTF-8'); ?>"></div>
<h6 class="property-block_two-title"><?php echo htmlspecialchars($fact['title'], ENT_QUOTES, 'UTF-8'); ?></h6>
<div class="property-block_two-text"><?php echo htmlspecialchars($fact['text'], ENT_QUOTES, 'UTF-8'); ?></div>
</div>
</div>
<?php endforeach; ?>
</div>

<h4 class="property-detail_subheading">Project Stack</h4>
<p><?php echo htmlspecialchars($project['text'], ENT_QUOTES, 'UTF-8'); ?> The write-ups cover the decisions that shaped it and the problems that only appeared once it was running under real traffic.</p>
<div class="property-detail_checks">
<div class="row clearfix">
<?php $chunk = array_chunk($amenities, 3); ?>
<?php foreach ($chunk as $group): ?>
<!-- Column -->
<div class="column col-lg-4 col-md-4 col-sm-6">
<ul class="property-detail_checklist">
<?php foreach ($group as $tag): ?>
<li><i class="flaticon-checked" aria-hidden="true"></i><?php echo htmlspecialchars($tag, ENT_QUOTES, 'UTF-8'); ?></li>
<?php endforeach; ?>
</ul>
</div>
<?php endforeach; ?>
</div>
</div>

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
