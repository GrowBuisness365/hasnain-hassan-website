<?php
/**
 * Serverless front controller.
 *
 * Every request is routed here, and this file maps it onto the matching page
 * in the project root. Both /contact and /contact.php serve contact.php, so
 * the pretty URLs used in the sitemap and the canonical tags keep working.
 *
 * Nested paths are supported:
 *   /web-development          -> web-development.php
 *   /web-development/php      -> web-development.php?section=php
 *   /seo/technical-seo        -> seo.php?section=technical-seo
 *   /services/website-development -> service-detail.php?slug=website-development
 *   /resources                -> resources.php
 */

// Buffer the output so the session cookie and the redirect headers below can
// still be sent, whatever the page prints first.
@ob_start();

$root = dirname(__DIR__);
$path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);
$path = rawurldecode(trim((string) $path, '/'));

if ($path === '') {
    $path = 'index.php';
}

// The crawler files share a PHP endpoint so Vercel returns the right content
// type and body for each URL.
if ($path === 'sitemap.xml' || $path === 'robots.txt') {
    $_SERVER['SEO_CRAWLER_FILE'] = $path;
    require $root . '/xml-sitemap.php';
    exit;
}

// Admin directory route.
if ($path === 'admin') {
    $file = 'admin/index.php';
    require $root . '/' . $file;
    exit;
}

// Split the path into segments for nested routing.
$segments = explode('/', $path);
$firstSegment = $segments[0] ?? '';
$rest = array_slice($segments, 1);

// Map known nested patterns to their target files with query parameters.
$targetFile = null;
$queryParams = array();

if ($firstSegment === 'services' && !empty($rest[0])) {
    // /services/<slug> -> service-detail.php?slug=<slug>
    $targetFile = 'service-detail.php';
    $queryParams['slug'] = $rest[0];
} elseif ($firstSegment === 'web-development' && !empty($rest[0])) {
    // /web-development/<topic> -> web-development.php?section=<topic>
    $targetFile = 'web-development.php';
    $queryParams['section'] = $rest[0];
} elseif ($firstSegment === 'seo' && !empty($rest[0])) {
    // /seo/<topic> -> seo.php?section=<topic>
    $targetFile = 'seo.php';
    $queryParams['section'] = $rest[0];
} elseif (preg_match('/^[a-zA-Z0-9_-]+(\.php)?$/', $firstSegment)) {
    // Single segment: /about -> about.php, /contact.php -> contact.php
    $targetFile = (substr($firstSegment, -4) === '.php') ? $firstSegment : $firstSegment . '.php';
} else {
    http_response_code(404);
    require $root . '/not-found.php';
    exit;
}

if ($targetFile === null || !is_file($root . '/' . $targetFile)) {
    http_response_code(404);
    require $root . '/not-found.php';
    exit;
}

// Append query parameters for nested routes.
if (!empty($queryParams)) {
    $_GET = array_merge($_GET, $queryParams);
    $_SERVER['QUERY_STRING'] = http_build_query($queryParams);
}

require $root . '/' . $targetFile;
