<?php
/**
 * Page template bootstrap.
 *
 * Every page starts with this include. It loads the shared config, content
 * data and helper components, then renders <head> and the header.
 *
 *   $pageKey  string  required: key in $seo_pages, e.g. 'about'
 */

$inc = __DIR__ . '/includes';

require_once $inc . '/config.php';
require_once $inc . '/form-security.php';
require_once $inc . '/data/content.php';
require_once $inc . '/content-store.php';
content_store_apply();
require_once $inc . '/schema.php';
require_once $inc . '/comment-handler.php';
require_once __DIR__ . '/components/cards.php';

// Comments are handled before any output so validation messages survive a reload.
handle_comment_submission();

if (!isset($pageKey)) {
    $pageKey = 'index';
}

if (!isset($crumbs)) {
    $crumbs = array();
}

/**
 * Default breadcrumb: just this page. The homepage has no page-title band, so
 * it gets no trail. A page can override $crumbs before requiring this file.
 */
if (!isset($crumbsSetByPage)) {
    $crumbs = ($pageKey === 'index')
        ? array()
        : array(array('label' => $seo_pages[$pageKey]['title'], 'file' => $pageKey . '.php'));
}

$current = $pageKey;

include $inc . '/head.php';
?>
<!-- Main Header -->
<?php include $inc . '/header.php'; ?>
<!-- End Main Header -->
