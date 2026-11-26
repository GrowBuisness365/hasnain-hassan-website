<?php
/**
 * Project showcase. Lists every project from $projects.
 */

$pageKey = 'property';
$crumbs = array(
	array('label' => 'Projects'),
);
require __DIR__ . '/bootstrap.php';
?>
	
	<!-- Page Title -->
	<?php include __DIR__ . '/components/page-title.php'; ?>
    <!-- End Page Title -->
	
	<!-- Property One -->
	<section class="property-three">
		<div class="auto-container">
			<div class="row clearfix">
				<?php
				foreach ($projects as $project): ?>
				<?php card_project_stats($project, project_url($project), 'style-three col-lg-4 col-md-6 col-sm-12'); ?>
				<?php endforeach; ?>
			</div>

		</div>
	</section>
	<?php include __DIR__ . '/components/technology-slider.php'; ?>
	<!-- End Property Three -->
<?php require __DIR__ . '/page-footer.php'; ?>
