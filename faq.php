<?php
$pageKey = 'faq';
$crumbs = array(array('label' => 'FAQ'));
require __DIR__ . '/bootstrap.php';
?>
<?php include __DIR__ . '/components/page-title.php'; ?>
	
<!-- Faq Two -->
<section class="faq-two">
<div class="auto-container">
<div class="row clearfix">

<!-- Title Column -->
<div class="faq-two_title-column col-lg-5 col-md-12 col-sm-12">
<div class="faq-two_title-outer">
<!-- Sec Title -->
<div class="sec-title">
<div class="sec-title_title">FAQ</div>
<h2 class="sec-title_heading">Frequently Asked Questions</h2>
<div class="sec-title_text">What the blog covers, how the articles are written, and how to reach the team.</div>
</div>
<!-- Button Box -->
<div class="faq-two_button">
<a href="contact.php" class="theme-btn btn-style-one">
<span class="btn-wrap">
<span class="text-one">Contact us</span>
<span class="text-two">Contact us</span>
</span>
</a>
</div>
</div>
</div>

<!-- Accordion Column -->
<div class="faq-two_accordion-column col-lg-7 col-md-12 col-sm-12">
<div class="faq-two_accordion-outer">
<!-- Accordion Box -->
<div class="hassan-faq-list">
<?php foreach ($faqs as $i => $entry): ?>
<details class="hassan-faq-item"<?php echo $i === 0 ? ' open' : ''; ?>>
<summary><?php echo htmlspecialchars($entry['q'], ENT_QUOTES, 'UTF-8'); ?><span aria-hidden="true">+</span></summary>
<p><?php echo htmlspecialchars($entry['a'], ENT_QUOTES, 'UTF-8'); ?></p>
</details>
<?php endforeach; ?>
</div>
</div>
</div>

</div>
</div>
</section>
<!-- End Faq Two -->
<?php include __DIR__ . '/components/technology-slider.php'; ?>
<?php require __DIR__ . '/page-footer.php'; ?>
