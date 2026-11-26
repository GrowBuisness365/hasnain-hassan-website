<?php
$pageKey = 'terms-and-conditions';
$crumbs = array(array('label' => 'Terms and Conditions', 'file' => 'terms-and-conditions.php'));
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
			<p class="he-overline">TERMS AND CONDITIONS</p>
			<h1>Terms and Conditions</h1>
			<p>These terms and conditions govern your use of the HassanEngine website. By accessing or using this site, you agree to these terms.</p>

			<h2>Use of the Website</h2>
			<p>You may use this website for lawful purposes only. You may not use the site to post or transmit any unlawful, harmful, or objectionable content.</p>

			<h2>Content and Intellectual Property</h2>
			<p>All content on this website, including articles, code examples, and design elements, is owned by HassanEngine or its contributors. You may view and print content for personal, non-commercial use. You may not reproduce or distribute content without permission.</p>

			<h2>Code Examples</h2>
			<p>Code examples provided on this site are for reading and experimentation. Where a full project exists, it is linked from the relevant article with setup instructions. Use code examples at your own risk.</p>

			<h2>No Warranty</h2>
			<p>The information on this website is provided "as is" without warranty of any kind, either express or implied. We do not guarantee that the website will be error-free or uninterrupted.</p>

			<h2>Limitation of Liability</h2>
			<p>HassanEngine is not liable for any damages arising from your use of this website or reliance on its content.</p>

			<h2>Governing Law</h2>
			<p>These terms are governed by the laws of the jurisdiction in which HassanEngine operates.</p>

			<h2>Contact</h2>
			<p>Questions about these terms may be sent to <?php echo htmlspecialchars(CONTACT_EMAIL, ENT_QUOTES, 'UTF-8'); ?>.</p>

			<a class="he-green-link" href="contact.php">Contact us <span aria-hidden="true">&#8594;</span></a>
		</div>
	</section>
</main>
<?php require __DIR__ . '/page-footer.php'; ?>
