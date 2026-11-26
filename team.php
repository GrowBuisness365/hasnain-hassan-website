<?php
/** Contributor directory for the HassanEngine journal. */
$pageKey = 'team';
$crumbs = array(array('label' => 'Contributors'));
require __DIR__ . '/bootstrap.php';
?>
<?php include __DIR__ . '/components/page-title.php'; ?>
<main class="hassan-contributors">
	<div class="auto-container">
		<div class="row clearfix">
			<?php foreach ($team as $member): ?>
			<article class="team-block_one col-xl-4 col-lg-6 col-md-6 col-sm-12">
				<div class="team-block_one-inner">
					<div class="team-block_one-image_outer"><div class="team-block_one-image">
						<img src="<?php echo SITE_URL; ?>/<?php echo htmlspecialchars($member['image'], ENT_QUOTES, 'UTF-8'); ?>" width="400" height="400" loading="lazy" decoding="async" alt="Portrait of <?php echo htmlspecialchars($member['name'], ENT_QUOTES, 'UTF-8'); ?>">
					</div></div>
					<div class="team-block_one-content">
						<h2 class="team-block_one-heading"><a href="team-detail.php?author=<?php echo rawurlencode($member['name']); ?>"><?php echo htmlspecialchars($member['name'], ENT_QUOTES, 'UTF-8'); ?></a></h2>
						<p class="team-block_one-designation"><?php echo htmlspecialchars($member['role'], ENT_QUOTES, 'UTF-8'); ?></p>
						<p><?php echo htmlspecialchars($member['bio'], ENT_QUOTES, 'UTF-8'); ?></p>
					</div>
				</div>
			</article>
			<?php endforeach; ?>
		</div>
	</div>
	<?php include __DIR__ . '/components/technology-slider.php'; ?>
</main>
<?php require __DIR__ . '/page-footer.php'; ?>
