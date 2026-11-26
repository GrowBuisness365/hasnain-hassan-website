<?php
require_once __DIR__ . '/includes/form-security.php';
require_once __DIR__ . '/includes/contact-handler.php';
$pageKey = 'contact';
$crumbs = array(array('label' => 'Contact'));
require __DIR__ . '/bootstrap.php';
?>
<style>
  /* Inherit the exact homepage font-family from body */
  .page-title h1,
  .page-title h2,
  .page-title h3,
  .page-title p,
  .he-page-title h1,
  .he-page-title h2,
  .he-page-title h3,
  .he-page-title p,
  .he-blog-page h1,
  .he-blog-page h2,
  .he-blog-page h3,
  .he-blog-page h4,
  .he-blog-page h5,
  .he-blog-page h6,
  .he-blog-page p {
    font-family: inherit !important;
    font-weight: 600 !important;
  }

  /* Hero title scale matching .he-business-hero h1 */
  .page-title h1,
  .he-page-title h1 {
    font-size: clamp(40px, 45vw, 45px) !important;
    line-height: 1.08 !important;
    margin-bottom: 16px !important;
  }

  /* Hero & page paragraphs matching .he-business-hero_copy > p */
  .page-title p:not(.he-overline),
  .he-page-title p:not(.he-overline),
  .he-blog-page p:not(.he-overline) {
    font-size: 17px !important;
    line-height: 1.75 !important;
  }

  .page-title p:not(.he-overline),
  .he-page-title p:not(.he-overline) {
    margin-top: 16px !important;
    max-width: 560px;
  }

  /* Keep overline labels crisp and uppercase like homepage */
  .he-overline {
    font-size: 12px !important;
    font-weight: 600 !important;
    letter-spacing: .12em !important;
    text-transform: uppercase !important;
  }
</style>
	<!-- End Main Header -->
	
	<!-- Page Title -->
<?php include __DIR__ . '/components/page-title.php'; ?>
	<!-- End Page Title -->

	<!-- Contact Form -->
	<?php include __DIR__ . '/components/contact-form.php'; ?>
	<!-- End Contact Form -->

<?php require __DIR__ . '/page-footer.php'; ?>
