<?php
$pageKey = 'disclaimer';
$crumbs = array(array('label' => 'Disclaimer', 'file' => 'disclaimer.php'));
require __DIR__ . '/bootstrap.php';
?>
<style>
  .he-page-theme h1,
  .he-page-theme h2,
  .he-page-theme h3,
  .he-page-theme h4,
  .he-page-theme h5,
  .he-page-theme h6 {
    color: #145C3D !important;
    font-weight: 600 !important;
  }

  .he-page-theme h2 .he-h2-accent,
  .he-page-theme .he-green-link {
    color: #0B3828 !important;
    font-weight: 600 !important;
  }

  .he-page-theme .he-pill-button {
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    gap: 8px !important;
    padding: 13px 26px !important;
    border: 1px solid #1C7650 !important;
    border-radius: 999px !important;
    background-color: #1C7650 !important;
    background-image: none !important;
    color: #ffffff !important;
    font-size: 15px !important;
    font-weight: 600 !important;
    line-height: 1.2 !important;
    white-space: nowrap !important;
    text-decoration: none !important;
    transition: background-color 0.25s ease, border-color 0.25s ease !important;
  }

  .he-page-theme .he-pill-button:hover {
    background-color: #0B3828 !important;
    border-color: #0B3828 !important;
    color: #ffffff !important;
  }

  .he-page-theme .he-green-link {
    transition: color 0.25s ease !important;
  }

  .he-page-theme .he-green-link:hover {
    color: #0B3828 !important;
  }

  .he-legal-content {
    max-width: 800px;
    margin: 0 auto;
    line-height: 1.7;
  }

  .he-legal-content h2 {
    font-size: 22px;
    color: #145C3D !important;
    margin-top: 24px;
  }

  .he-legal-content h3 {
    font-size: 18px;
    color: #0B3828 !important;
    margin-top: 20px;
  }

  .he-legal-content p {
    font-size: 15px;
    color: #0B3828 !important;
    margin: 0 0 16px 0;
  }

  .he-legal-content ul {
    margin: 0 0 16px 0;
    padding-left: 20px;
    color: #0B3828 !important;
  }

  .he-legal-content li {
    margin-bottom: 8px;
  }
</style>

<main class="he-page-theme">
	<section class="he-about-intro">
		<div class="auto-container he-legal-content">
			<p class="he-overline">DISCLAIMER</p>
			<h1>Disclaimer</h1>
			<p>The information provided on HassanEngine is for general educational and informational purposes only.</p>

			<h2>Professional Advice</h2>
			<p>Articles and guides on web development and SEO are based on general knowledge and experience. They do not constitute professional advice. For specific projects, consult with a qualified professional.</p>

			<h2>Accuracy</h2>
			<p>We strive to keep information accurate and up to date, but technology and search engine practices change frequently. We make no representations or warranties about the completeness, accuracy, or suitability of the information.</p>

			<h2>Third-Party Links</h2>
			<p>This website may contain links to third-party websites or services. We are not responsible for the content or practices of those sites.</p>

			<h2>No Guarantees of Results</h2>
			<p>SEO and development results vary based on many factors outside our control. We do not guarantee specific rankings, traffic, or business outcomes.</p>

			<h2>Changes</h2>
			<p>We may update or modify content on this website at any time without notice.</p>

			<a class="he-green-link" href="contact.php">Contact us <span aria-hidden="true">&#8594;</span></a>
		</div>
	</section>
</main>
<?php require __DIR__ . '/page-footer.php'; ?>
