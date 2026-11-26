<?php
/** Contributor profile selected from the CMS-backed contributor list. */
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/data/content.php';
require_once __DIR__ . '/includes/content-store.php';
content_store_apply();

$authorName = isset($_GET['author']) ? trim((string) $_GET['author']) : '';
$member = null;
foreach ($team as $candidate) {
    if ($candidate['name'] === $authorName || ($authorName === '' && $member === null)) {
        $member = $candidate;
        if ($authorName !== '') {
            break;
        }
    }
}

$pageKey = 'team-detail';
$crumbs = array(array('label' => 'Contributors', 'file' => 'team.php'));
if ($member === null) {
    http_response_code(404);
    $pageKey = 'not-found';
    $pageTitle = 'Contributor not found';
    $pageDesc = 'This contributor profile could not be found. Browse the HassanEngine contributor list.';
    $canonical = SITE_URL . '/team-detail';
    $crumbs[] = array('label' => 'Not found');
} else {
    $pageTitle = $member['name'];
    $pageDesc = $member['bio'];
    $canonical = SITE_URL . '/team-detail?author=' . rawurlencode($member['name']);
    $schema_image = $member['image'];
    $crumbs[] = array('label' => $member['name']);
}
require __DIR__ . '/bootstrap.php';
?>
<?php include __DIR__ . '/components/page-title.php'; ?>
<?php if ($member !== null): ?>
<main class="team-detail hassan-contributor-profile">
	<div class="auto-container">
		<div class="row clearfix">
			<div class="team-detail_image-column col-lg-5 col-md-12">
				<div class="team-detail_image"><img src="<?php echo SITE_URL; ?>/<?php echo htmlspecialchars($member['image'], ENT_QUOTES, 'UTF-8'); ?>" width="400" height="400" alt="Portrait of <?php echo htmlspecialchars($member['name'], ENT_QUOTES, 'UTF-8'); ?>" fetchpriority="high"></div>
			</div>
			<div class="team-detail_content-column col-lg-7 col-md-12">
				<div class="team-detail_content-outer">
					<h2 class="team-detail_title"><?php echo htmlspecialchars($member['name'], ENT_QUOTES, 'UTF-8'); ?></h2>
					<p class="team-detail_subtitle"><?php echo htmlspecialchars($member['role'], ENT_QUOTES, 'UTF-8'); ?></p>
					<p class="team-detail_text"><?php echo htmlspecialchars($member['bio'], ENT_QUOTES, 'UTF-8'); ?></p>
					<p><a href="mailto:<?php echo htmlspecialchars($member['email'], ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars($member['email'], ENT_QUOTES, 'UTF-8'); ?></a></p>
					<a class="template-btn btn-style-one" href="blog.php"><span class="btn-wrap"><span class="text-one">Read the articles</span><span class="text-two">Read the articles</span></span></a>
				</div>
			</div>
		</div>
	</div>
	<?php include __DIR__ . '/components/technology-slider.php'; ?>
</main>
<?php endif; ?>
<?php require __DIR__ . '/page-footer.php'; ?>
