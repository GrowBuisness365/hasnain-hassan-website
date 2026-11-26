<?php
http_response_code(404);
$pageKey = 'not-found';
$crumbs = array(array('label' => 'Page not found'));

// Internal rewrites and ErrorDocument both land here; make sure the
// response status is a real 404 and never a soft 200.
if (!headers_sent()) {
	header('HTTP/1.1 404 Not Found', true, 404);
	header('Status: 404 Not Found');
}

require __DIR__ . '/bootstrap.php';
?>
	
<!-- Page Title -->
	<?php include __DIR__ . '/components/page-title.php'; ?>
    <!-- End Page Title -->
	
	<!-- Error One -->
	<section class="error-one">
		<div class="auto-container">
			<h2>404</h2>
			<h2>Oops! that page can't <br> be found.</h2>
			<div class="text">We're really sorry but we can't seem to find the page you <br> were looking for.</div>
			<!-- Button Box -->
			<div class="button-box text-center">
				<a href="index.php" class="template-btn btn-style-one">
					<span class="btn-wrap">
						<span class="text-one">Go back home now</span>
						<span class="text-two">Go back home now</span>
					</span>
				</a>
			</div>
		</div>
	</section>
	<!-- End Error One -->
<?php include __DIR__ . '/components/technology-slider.php'; ?>
<?php require __DIR__ . '/page-footer.php'; ?>
