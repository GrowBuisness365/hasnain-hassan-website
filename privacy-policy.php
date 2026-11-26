<?php
$pageKey = 'privacy-policy';
$crumbs = array(array('label' => 'Privacy Policy', 'file' => 'privacy-policy.php'));
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
			<p class="he-overline">PRIVACY POLICY</p>
			<h1>Privacy Policy</h1>
			<p>This privacy policy explains how HassanEngine collects, uses, and protects information when you visit our website or contact us.</p>

			<h2>Information We Collect</h2>
			<p>We may collect personal information such as your name and email address when you submit our contact form or subscribe to our newsletter. We do not collect personal information through passive means such as cookies unless you explicitly provide it.</p>

			<h2>How We Use Your Information</h2>
			<p>We use your information to respond to your inquiries, send newsletter updates (if you subscribe), and improve our website and services. We do not sell or rent your personal information to third parties.</p>

			<h2>Contact Form</h2>
			<p>Messages submitted through our contact form are sent via email to the site owner. We retain messages only as long as needed to respond to your inquiry.</p>

			<h2>Email Subscriptions</h2>
			<p>If you subscribe to our newsletter, your email address is stored to send you occasional updates about web development and SEO content. You can unsubscribe at any time using the link in each email.</p>

			<h2>Third-Party Services</h2>
			<p>We use Google Analytics to analyze website traffic. Google Analytics collects anonymized data such as pages visited and time on site. We do not use advertising or remarketing cookies.</p>

			<h2>Your Rights</h2>
			<p>You may request access to, correction of, or deletion of your personal information by contacting us at <?php echo htmlspecialchars(CONTACT_EMAIL, ENT_QUOTES, 'UTF-8'); ?>.</p>

			<h2>Changes to This Policy</h2>
			<p>We may update this privacy policy from time to time. Changes will be posted on this page with an updated date.</p>

			<a class="he-green-link" href="contact.php">Contact us <span aria-hidden="true">&#8594;</span></a>
		</div>
	</section>
</main>
<?php require __DIR__ . '/page-footer.php'; ?>
