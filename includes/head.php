
<?php
/**
 * Shared <head> block.
 *
 * Every page sets these before including this file:
 *   $pageKey       string  the key used in $seo_pages, e.g. 'about'
 *   $crumbs        array   breadcrumb trail of ['label' => ..., 'file' => ...]
 *   $bodyClass     string  optional extra class on <body>
 *   $schema_*      string  optional overrides for structured data
 */

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/form-security.php';
require_once __DIR__ . '/schema.php';

$pageKey = isset($pageKey) ? $pageKey : 'index';

$seo = isset($seo_pages[$pageKey]) ? $seo_pages[$pageKey] : $seo_pages['index'];

$pageTitle    = isset($pageTitle) ? $pageTitle : $seo['title'];
$pageDesc     = isset($pageDesc) ? $pageDesc : $seo['description'];
$pageKeywords = $seo['keywords'];
$bodyClass    = isset($bodyClass) ? $bodyClass : '';
$crumbs       = isset($crumbs) ? $crumbs : array();

// Matches the extensionless URLs the .htaccess serves and the sitemap lists.
$canonical = isset($canonical) ? $canonical : (($pageKey === 'index')
    ? SITE_URL . '/'
    : SITE_URL . '/' . $pageKey);

// Duplicate homepage layout and the 404 page must stay out of the index.
$isFilteredBlog = ($pageKey === 'blog' && !empty($_SERVER['QUERY_STRING']));
$robotsMeta = (in_array($pageKey, array('index04b9', 'index-2', 'index-3', 'not-found', 'blog-classic', 'blog-sidebar'), true) || $isFilteredBlog)
  ? 'noindex, follow'
  : 'index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1';

// Article-specific Open Graph data for blog posts.
$articleOg = array();
if ($pageKey === 'blog-detail') {
    $articleOg['article:published_time'] = isset($meta['schema_date']) ? $meta['schema_date'] . 'T00:00:00+00:00' : '';
    $articleOg['article:author'] = isset($meta['schema_author']) ? $meta['schema_author'] : SITE_NAME;
    $articleOg['article:publisher'] = SITE_URL;
    $articleOg['article:section'] = isset($_GET['category']) ? htmlspecialchars($_GET['category'], ENT_QUOTES, 'UTF-8') : '';
}

// GA4 measurement ID. Set GA4_ID in the environment to override the fallback.
$ga4Id = getenv('GA4_ID');

if ($ga4Id === false || $ga4Id === '') {
    $ga4Id = 'G-8V5W7TFY7N';
}

$meta = array(
    'pageTitle'    => $pageTitle,
    'pageDesc'     => $pageDesc,
    'pageKeywords' => $pageKeywords,
    'canonical'    => $canonical,
);

// Structured data overrides supplied by the page.
foreach (array('schema_headline', 'schema_image', 'schema_date', 'schema_author') as $k) {
    if (isset($$k)) {
        $meta[$k] = $$k;
    }
}
if (!isset($meta['schema_image'])) {
    $seoImages = array(
        'about' => 'assets/images/hero/architecture.svg',
        'blog' => 'assets/images/hero/articles.svg',
        'blog-classic' => 'assets/images/hero/articles.svg',
        'blog-sidebar' => 'assets/images/hero/articles.svg',
        'contact' => 'assets/images/hero/contact.svg',
        'faq' => 'assets/images/hero/faq.svg',
        'property' => 'assets/images/hero/projects.svg',
        'services' => 'assets/images/hero/code.svg',
        'team' => 'assets/images/hero/community.svg',
        'team-detail' => 'assets/images/hero/community.svg',
    );
    $meta['schema_image'] = isset($seoImages[$pageKey]) ? $seoImages[$pageKey] : OG_IMAGE;
}
?>
<!DOCTYPE html>
<html lang="<?php echo SITE_LANG; ?>">

<head>
<meta charset="utf-8">

<!-- Google Analytics (GA4) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo htmlspecialchars($ga4Id, ENT_QUOTES, 'UTF-8'); ?>"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', '<?php echo htmlspecialchars($ga4Id, ENT_QUOTES, 'UTF-8'); ?>');
</script>
<!-- End Google Analytics (GA4) -->

<!-- Vercel Web Analytics -->
<script>
window.va = window.va || function () { (window.vaq = window.vaq || []).push(arguments); };
</script>
<script defer src="/_vercel/insights/script.js"></script>
<!-- End Vercel Web Analytics -->

<!-- Google Search Console Verification -->
<meta name="google-site-verification" content="L2Ye5enWqkF_Tr6CNRHkQOXp9fYI7Anxj1hyfql4p38" />

<title><?php echo htmlspecialchars($pageTitle . ' | ' . SITE_NAME, ENT_QUOTES, 'UTF-8'); ?></title>

<meta name="description" content="<?php echo htmlspecialchars($pageDesc, ENT_QUOTES, 'UTF-8'); ?>">
<meta name="keywords" content="<?php echo htmlspecialchars($pageKeywords, ENT_QUOTES, 'UTF-8'); ?>">
<meta name="author" content="<?php echo htmlspecialchars(SITE_NAME, ENT_QUOTES, 'UTF-8'); ?>">
<meta name="robots" content="<?php echo htmlspecialchars($robotsMeta, ENT_QUOTES, 'UTF-8'); ?>">
<meta name="theme-color" content="#EB2027">

<link rel="canonical" href="<?php echo htmlspecialchars($canonical, ENT_QUOTES, 'UTF-8'); ?>">

<!-- Open Graph -->
<meta property="og:type" content="<?php echo ($pageKey === 'blog-detail') ? 'article' : 'website'; ?>">
<meta property="og:site_name" content="<?php echo htmlspecialchars(SITE_NAME, ENT_QUOTES, 'UTF-8'); ?>">
<meta property="og:locale" content="<?php echo SITE_LOCALE; ?>">
<meta property="og:title" content="<?php echo htmlspecialchars($pageTitle . ' | ' . SITE_NAME, ENT_QUOTES, 'UTF-8'); ?>">
<meta property="og:description" content="<?php echo htmlspecialchars($pageDesc, ENT_QUOTES, 'UTF-8'); ?>">
<meta property="og:url" content="<?php echo htmlspecialchars($canonical, ENT_QUOTES, 'UTF-8'); ?>">
<meta property="og:image" content="<?php echo SITE_URL; ?>/<?php echo htmlspecialchars($meta['schema_image'], ENT_QUOTES, 'UTF-8'); ?>">
<meta property="og:image:alt" content="<?php echo htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8'); ?>">

<?php foreach ($articleOg as $prop => $val): if ($val !== ''): ?>
<meta property="<?php echo htmlspecialchars($prop, ENT_QUOTES, 'UTF-8'); ?>" content="<?php echo htmlspecialchars($val, ENT_QUOTES, 'UTF-8'); ?>">
<?php endif; endforeach; ?>

<!-- Twitter -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="<?php echo htmlspecialchars($pageTitle . ' | ' . SITE_NAME, ENT_QUOTES, 'UTF-8'); ?>">
<meta name="twitter:description" content="<?php echo htmlspecialchars($pageDesc, ENT_QUOTES, 'UTF-8'); ?>">
<meta name="twitter:creator" content="@<?php echo htmlspecialchars(SITE_NAME, ENT_QUOTES, 'UTF-8'); ?>">
<meta name="twitter:image" content="<?php echo SITE_URL; ?>/<?php echo htmlspecialchars($meta['schema_image'], ENT_QUOTES, 'UTF-8'); ?>">

<!-- Structured data -->
<?php echo render_schema($pageKey, $meta, $crumbs); ?>

<!-- Load the stylesheets directly to avoid the theme's serial @import chain. -->
<link href="<?php echo SITE_URL; ?>/assets/css/bootstrap.css" rel="stylesheet">
<link href="<?php echo SITE_URL; ?>/assets/css/global.css" rel="stylesheet">
<link href="<?php echo SITE_URL; ?>/assets/css/header.css" rel="stylesheet">
<link href="<?php echo SITE_URL; ?>/assets/css/footer.css" rel="stylesheet">
<link href="<?php echo SITE_URL; ?>/assets/css/font-awesome.css" rel="stylesheet">
<link href="<?php echo SITE_URL; ?>/assets/css/flaticon_palace-icons.css" rel="stylesheet">
<link href="<?php echo SITE_URL; ?>/assets/css/style.css?v=20261119-finco-style-7" rel="stylesheet">
<link href="<?php echo SITE_URL; ?>/assets/css/responsive.css" rel="stylesheet">

<!-- Favicons -->
<link rel="icon" href="<?php echo SITE_URL; ?>/assets/images/<?php echo FAVICON; ?>?v=green-1" type="image/svg+xml">

<!-- Responsive -->
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body<?php echo $bodyClass !== '' ? ' class="' . htmlspecialchars($bodyClass, ENT_QUOTES, 'UTF-8') . '"' : ''; ?>>

<div class="page-wrapper">
