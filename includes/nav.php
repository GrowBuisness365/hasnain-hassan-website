<?php
/**
 * Primary navigation with dropdown menus for Services, Web Development, SEO and Resources.
 * Shared by desktop and mobile headers.
 */
$current = isset($current) ? $current : basename($_SERVER['PHP_SELF'], '.php');

// Determine the active section for highlighting parent items when a child page is active.
$activeSections = array(
    'index' => 'index',
    'about' => 'about',
    'services' => 'services',
    'service-detail' => 'services',
    'web-development' => 'web-development',
    'seo' => 'seo',
    'blog' => 'blog',
    'blog-detail' => 'blog',
    'resources' => 'resources',
    'contact' => 'contact',
    'privacy-policy' => 'resources',
    'terms-and-conditions' => 'resources',
    'disclaimer' => 'resources',
    'sitemap' => 'resources',
    'faq' => 'resources',
);
$activeSection = $activeSections[$current] ?? $current;

$navItems = array(
    array(
        'label' => 'Home',
        'file' => 'index.php',
        'key' => 'index',
    ),
    array(
        'label' => 'About',
        'file' => 'about.php',
        'key' => 'about',
    ),
    array(
        'label' => 'Services',
        'file' => 'services.php',
        'key' => 'services',
        'dropdown' => array(
            array('label' => 'Website Development', 'file' => 'services.php?service=website-development'),
            array('label' => 'WordPress Development', 'file' => 'services.php?service=wordpress-development'),
            array('label' => 'PHP Development', 'file' => 'services.php?service=php-development'),
            array('label' => 'Search Engine Optimization', 'file' => 'services.php?service=seo'),
            array('label' => 'Technical SEO', 'file' => 'services.php?service=technical-seo'),
            array('label' => 'On-Page SEO', 'file' => 'services.php?service=on-page-seo'),
            array('label' => 'Off-Page SEO', 'file' => 'services.php?service=off-page-seo'),
            array('label' => 'Website Speed Optimization', 'file' => 'services.php?service=website-speed-optimization'),
        ),
    ),
    array(
        'label' => 'Web Development',
        'file' => 'web-development.php',
        'key' => 'web-development',
        'dropdown' => array(
            array('label' => 'PHP Development', 'file' => 'web-development.php?section=php'),
            array('label' => 'WordPress Development', 'file' => 'web-development.php?section=wordpress'),
            array('label' => 'HTML & CSS', 'file' => 'web-development.php?section=html-css'),
            array('label' => 'JavaScript Development', 'file' => 'web-development.php?section=javascript'),
            array('label' => 'Frontend Development', 'file' => 'web-development.php?section=frontend'),
            array('label' => 'Responsive Web Design', 'file' => 'web-development.php?section=responsive-design'),
            array('label' => 'Website Security', 'file' => 'web-development.php?section=website-security'),
            array('label' => 'Website Performance', 'file' => 'web-development.php?section=performance'),
        ),
    ),
    array(
        'label' => 'SEO',
        'file' => 'seo.php',
        'key' => 'seo',
        'dropdown' => array(
            array('label' => 'SEO Fundamentals', 'file' => 'seo.php?section=seo-fundamentals'),
            array('label' => 'Keyword Research', 'file' => 'seo.php?section=keyword-research'),
            array('label' => 'On-Page SEO', 'file' => 'seo.php?section=on-page-seo'),
            array('label' => 'Off-Page SEO', 'file' => 'seo.php?section=off-page-seo'),
            array('label' => 'Technical SEO', 'file' => 'seo.php?section=technical-seo'),
            array('label' => 'Local SEO', 'file' => 'seo.php?section=local-seo'),
            array('label' => 'Content SEO', 'file' => 'seo.php?section=content-seo'),
            array('label' => 'Link Building', 'file' => 'seo.php?section=link-building'),
            array('label' => 'Google Search Console', 'file' => 'seo.php?section=google-search-console'),
            array('label' => 'Website Audits', 'file' => 'seo.php?section=website-audit'),
            array('label' => 'SEO Tools', 'file' => 'seo.php?section=seo-tools'),
            array('label' => 'Google Indexing', 'file' => 'seo.php?section=google-indexing'),
        ),
    ),
    array(
        'label' => 'Blog',
        'file' => 'blog.php',
        'key' => 'blog',
    ),
    array(
        'label' => 'Resources',
        'file' => 'resources.php',
        'key' => 'resources',
        'dropdown' => array(
            array('label' => 'SEO Checklists', 'file' => 'resources.php?type=seo-checklists'),
            array('label' => 'Website Development Guides', 'file' => 'resources.php?type=web-development-guides'),
            array('label' => 'WordPress Resources', 'file' => 'resources.php?type=wordpress-resources'),
            array('label' => 'PHP Code Examples', 'file' => 'resources.php?type=php-code-examples'),
            array('label' => 'Website Launch Checklist', 'file' => 'resources.php?type=launch-checklist'),
            array('label' => 'Technical SEO Checklist', 'file' => 'resources.php?type=technical-seo-checklist'),
            array('label' => 'Google Search Console Guides', 'file' => 'resources.php?type=gsc-guides'),
            array('label' => 'Website Performance Guides', 'file' => 'resources.php?type=performance-guides'),
            array('label' => 'Recommended Development Tools', 'file' => 'resources.php?type=dev-tools'),
            array('label' => 'Recommended SEO Tools', 'file' => 'resources.php?type=seo-tools'),
        ),
    ),
    array(
        'label' => 'Contact',
        'file' => 'contact.php',
        'key' => 'contact',
    ),
);
?>
<ul class="hassan-nav_list">
    <?php foreach ($navItems as $item): 
        $isActive = in_array($current, isset($item['pages']) ? $item['pages'] : array($item['key']), true);
        $isSectionActive = isset($item['key']) && $item['key'] === $activeSection;
        $hasDropdown = !empty($item['dropdown']);
    ?>
    <li class="<?php echo ($isActive || $isSectionActive) ? 'is-active' : ''; ?><?php echo $hasDropdown ? ' has-dropdown' : ''; ?>">
        <a<?php echo ($isActive || $isSectionActive) ? ' aria-current="page"' : ''; ?> href="<?php echo htmlspecialchars($item['file'], ENT_QUOTES, 'UTF-8'); ?>"<?php echo $hasDropdown ? ' aria-haspopup="true"' : ''; ?>><?php echo htmlspecialchars($item['label'], ENT_QUOTES, 'UTF-8'); ?></a>
        <?php if ($hasDropdown): ?>
        <ul class="hassan-nav_dropdown">
            <?php foreach ($item['dropdown'] as $child): 
                $childActive = ($current === basename(parse_url($child['file'], PHP_URL_PATH))) || strpos($current, $child['file']) !== false;
            ?>
            <li<?php echo $childActive ? ' class="is-active"' : ''; ?>><a<?php echo $childActive ? ' aria-current="page"' : ''; ?> href="<?php echo htmlspecialchars($child['file'], ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars($child['label'], ENT_QUOTES, 'UTF-8'); ?></a></li>
            <?php endforeach; ?>
        </ul>
        <?php endif; ?>
    </li>
    <?php endforeach; ?>
</ul>
