<?php
/**
 * Emits crawler files from the public page and article data.
 */

require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/data/content.php';

$crawlerFile = isset($_SERVER['SEO_CRAWLER_FILE']) ? $_SERVER['SEO_CRAWLER_FILE'] : 'sitemap.xml';

if ($crawlerFile === 'robots.txt') {
    header('Content-Type: text/plain; charset=UTF-8');
    echo "User-agent: *\nAllow: /\n\n# Block admin and private areas\nDisallow: /admin/\nDisallow: /api/\nDisallow: /includes/\nDisallow: /storage/\n\n# Allow CSS, JS, images for rendering\nAllow: /assets/css/\nAllow: /assets/js/\nAllow: /assets/images/\n\nSitemap: " . SITE_URL . "/sitemap.xml\n";
    return;
}

header('Content-Type: application/xml; charset=UTF-8');
echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
<?php
// Static pages with SEO metadata from config.
$sitemapPages = array(
    'about'              => array('priority' => '0.8', 'changefreq' => 'monthly', 'lastmod' => '2026-11-25'),
    'blog'               => array('priority' => '0.9', 'changefreq' => 'weekly',  'lastmod' => '2026-11-25'),
    'contact'            => array('priority' => '0.7', 'changefreq' => 'monthly', 'lastmod' => '2026-11-25'),
    'disclaimer'         => array('priority' => '0.3', 'changefreq' => 'yearly',  'lastmod' => '2026-11-25'),
    'faq'                => array('priority' => '0.6', 'changefreq' => 'monthly', 'lastmod' => '2026-11-25'),
    'privacy-policy'     => array('priority' => '0.3', 'changefreq' => 'yearly',  'lastmod' => '2026-11-25'),
    'property'           => array('priority' => '0.8', 'changefreq' => 'weekly',  'lastmod' => '2026-11-25'),
    'resources'          => array('priority' => '0.7', 'changefreq' => 'monthly', 'lastmod' => '2026-11-25'),
    'services'           => array('priority' => '0.8', 'changefreq' => 'monthly', 'lastmod' => '2026-11-25'),
    'sitemap'            => array('priority' => '0.4', 'changefreq' => 'monthly', 'lastmod' => '2026-11-25'),
    'terms-and-conditions' => array('priority' => '0.3', 'changefreq' => 'yearly',  'lastmod' => '2026-11-25'),
    'web-development'    => array('priority' => '0.8', 'changefreq' => 'monthly', 'lastmod' => '2026-11-25'),
    'seo'                => array('priority' => '0.8', 'changefreq' => 'monthly', 'lastmod' => '2026-11-25'),
);

// Homepage.
?>
    <url>
        <loc><?php echo htmlspecialchars(SITE_URL . '/', ENT_XML1, 'UTF-8'); ?></loc>
        <lastmod>2026-11-25</lastmod>
        <changefreq>weekly</changefreq>
        <priority>1.0</priority>
    </url>
<?php
foreach ($sitemapPages as $page => $meta):
?>
    <url>
        <loc><?php echo htmlspecialchars(SITE_URL . '/' . $page, ENT_XML1, 'UTF-8'); ?></loc>
        <lastmod><?php echo htmlspecialchars($meta['lastmod'], ENT_XML1, 'UTF-8'); ?></lastmod>
        <changefreq><?php echo htmlspecialchars($meta['changefreq'], ENT_XML1, 'UTF-8'); ?></changefreq>
        <priority><?php echo htmlspecialchars($meta['priority'], ENT_XML1, 'UTF-8'); ?></priority>
    </url>
<?php endforeach;

// Blog articles.
foreach ($posts as $post):
?>
    <url>
        <loc><?php echo htmlspecialchars(SITE_URL . '/' . post_url($post), ENT_XML1, 'UTF-8'); ?></loc>
        <lastmod><?php echo htmlspecialchars($post['date'], ENT_XML1, 'UTF-8'); ?></lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
<?php endforeach;

// Projects.
foreach ($projects as $project):
?>
    <url>
        <loc><?php echo htmlspecialchars(SITE_URL . '/' . project_url($project), ENT_XML1, 'UTF-8'); ?></loc>
        <lastmod><?php echo htmlspecialchars($project['updated'], ENT_XML1, 'UTF-8'); ?></lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.7</priority>
    </url>
<?php endforeach;

// Team members.
foreach ($team as $member):
?>
    <url>
        <loc><?php echo htmlspecialchars(SITE_URL . '/team-detail?author=' . rawurlencode($member['name']), ENT_XML1, 'UTF-8'); ?></loc>
        <lastmod>2026-11-25</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.6</priority>
    </url>
<?php endforeach; ?>
</urlset>
