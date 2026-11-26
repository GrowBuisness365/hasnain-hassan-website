<?php
$pageKey = 'resources';
$section = isset($_GET['type']) ? trim((string) $_GET['type']) : '';
$crumbs = array(array('label' => 'Resources', 'file' => 'resources.php'));
require __DIR__ . '/bootstrap.php';

$resourceTypes = array(
    'seo-checklists' => array(
        'title' => 'SEO Checklists',
        'description' => 'Practical checklists for technical, on-page, and off-page SEO audits.',
        'items' => array(
            array('title' => 'Technical SEO Checklist', 'desc' => 'Crawlability, indexability, site speed, structured data, and Core Web Vitals.'),
            array('title' => 'On-Page SEO Checklist', 'desc' => 'Title tags, meta descriptions, headings, content quality, and internal links.'),
            array('title' => 'Off-Page SEO Checklist', 'desc' => 'Backlink quality, local citations, brand mentions, and review management.'),
            array('title' => 'Local SEO Checklist', 'desc' => 'Google Business Profile, NAP consistency, location pages, and local keywords.'),
        ),
    ),
    'web-development-guides' => array(
        'title' => 'Website Development Guides',
        'description' => 'Comprehensive guides for building modern, responsive websites.',
        'items' => array(
            array('title' => 'PHP Development Guide', 'desc' => 'Server-side development with modern PHP standards and practices.'),
            array('title' => 'WordPress Development Guide', 'desc' => 'Child themes, block themes, custom plugins, and WordPress best practices.'),
            array('title' => 'HTML & CSS Guide', 'desc' => 'Semantic HTML5 and modern CSS for accessible, well-structured pages.'),
            array('title' => 'Responsive Design Guide', 'desc' => 'Mobile-first layouts that work on every screen size.'),
        ),
    ),
    'wordpress-resources' => array(
        'title' => 'WordPress Resources',
        'description' => 'Theme development, plugin best practices, and WordPress optimization.',
        'items' => array(
            array('title' => 'Theme Development Best Practices', 'desc' => 'Clean, maintainable WordPress themes using template hierarchy and child themes.'),
            array('title' => 'Custom Plugin Development', 'desc' => 'Extending WordPress safely with hooks, admin settings, and security best practices.'),
            array('title' => 'Performance Optimization', 'desc' => 'Caching, image optimization, database cleanup, and lightweight theme choices.'),
            array('title' => 'Security Hardening', 'desc' => 'Protecting WordPress sites from common attacks and vulnerabilities.'),
        ),
    ),
    'php-code-examples' => array(
        'title' => 'PHP Code Examples',
        'description' => 'Practical PHP snippets and patterns for common development tasks.',
        'items' => array(
            array('title' => 'Database Connection', 'desc' => 'Secure PDO connection with prepared statements.'),
            array('title' => 'Form Handling', 'desc' => 'Validating and sanitizing user input with CSRF protection.'),
            array('title' => 'File Upload', 'desc' => 'Secure file upload with type validation and storage.'),
            array('title' => 'API Integration', 'desc' => 'Consuming REST APIs with cURL and error handling.'),
        ),
    ),
    'launch-checklist' => array(
        'title' => 'Website Launch Checklist',
        'description' => 'Everything you need before launching a new website.',
        'items' => array(
            array('title' => 'Pre-Launch', 'desc' => 'Testing, content review, analytics setup, and backup verification.'),
            array('title' => 'Launch Day', 'desc' => 'DNS configuration, SSL certificate, monitoring setup, and announcement.'),
            array('title' => 'Post-Launch', 'desc' => 'Search Console submission, sitemap upload, and performance monitoring.'),
        ),
    ),
    'technical-seo-checklist' => array(
        'title' => 'Technical SEO Checklist',
        'description' => 'A checklist for auditing and fixing technical SEO issues.',
        'items' => array(
            array('title' => 'Crawlability', 'desc' => 'Robots.txt, XML sitemap, crawl budget, and redirect chains.'),
            array('title' => 'Indexability', 'desc' => 'Canonical tags, noindex tags, and duplicate content.'),
            array('title' => 'Site Speed', 'desc' => 'Core Web Vitals, image optimization, and caching.'),
            array('title' => 'Mobile Usability', 'desc' => 'Responsive design, touch targets, and mobile page speed.'),
        ),
    ),
    'gsc-guides' => array(
        'title' => 'Google Search Console Guides',
        'description' => 'Using Google Search Console for monitoring and improving search visibility.',
        'items' => array(
            array('title' => 'Getting Started', 'desc' => 'Verifying ownership, submitting sitemaps, and understanding the dashboard.'),
            array('title' => 'Performance Report', 'desc' => 'Analyzing queries, pages, countries, and devices.'),
            array('title' => 'Coverage Issues', 'desc' => 'Fixing indexing errors, excluded pages, and valid pages.'),
            array('title' => 'Core Web Vitals', 'desc' => 'Monitoring LCP, INP, and CLS for better rankings.'),
        ),
    ),
    'performance-guides' => array(
        'title' => 'Website Performance Guides',
        'description' => 'Optimizing page load speed and Core Web Vitals.',
        'items' => array(
            array('title' => 'Image Optimization', 'desc' => 'Modern formats, lazy loading, and responsive images.'),
            array('title' => 'Caching Strategies', 'desc' => 'Browser caching, CDN, and server-side caching.'),
            array('title' => 'Core Web Vitals', 'desc' => 'LCP, INP, and CLS measurement and improvement.'),
            array('title' => 'Code Optimization', 'desc' => 'CSS/JS minification, code splitting, and critical CSS.'),
        ),
    ),
    'dev-tools' => array(
        'title' => 'Recommended Development Tools',
        'description' => 'Tools for coding, debugging, testing, and deployment.',
        'items' => array(
            array('title' => 'Code Editors', 'desc' => 'VS Code, PHPStorm, and lightweight editors for web development.'),
            array('title' => 'Version Control', 'desc' => 'Git repositories, branching strategies, and deployment workflows.'),
            array('title' => 'Browser DevTools', 'desc' => 'Inspecting elements, debugging JavaScript, and analyzing network requests.'),
            array('title' => 'Testing Tools', 'desc' => 'Unit testing, integration testing, and accessibility testing.'),
        ),
    ),
    'seo-tools' => array(
        'title' => 'Recommended SEO Tools',
        'description' => 'Tools for keyword research, audits, rank tracking, and performance monitoring.',
        'items' => array(
            array('title' => 'Keyword Research', 'desc' => 'Finding search terms with the right volume and intent.'),
            array('title' => 'Site Audits', 'desc' => 'Crawling websites to find technical SEO issues.'),
            array('title' => 'Rank Tracking', 'desc' => 'Monitoring keyword positions over time.'),
            array('title' => 'Analytics', 'desc' => 'Measuring traffic, conversions, and user behavior.'),
        ),
    ),
);

if ($section !== '' && isset($resourceTypes[$section])) {
    $typeData = $resourceTypes[$section];
    $pageTitle = $typeData['title'];
    $pageDesc = $typeData['description'];
    $canonical = SITE_URL . '/resources.php?type=' . $section;
} else {
    $section = '';
    $pageTitle = 'Resource Library';
    $pageDesc = 'Practical resources for developers, SEO practitioners, and website owners: checklists, guides, code examples, and tool recommendations.';
    $canonical = SITE_URL . '/resources.php';
}
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

  .he-type-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 24px;
  }

  .he-type-card {
    border: 1px solid #EAF5EF;
    border-radius: 8px;
    padding: 28px;
    background: #ffffff;
    transition: transform 0.2s ease, border-color 0.2s ease;
  }

  .he-type-card:hover {
    transform: translateY(-2px);
    border-color: #145C3D;
  }

  .he-type-card h3 {
    font-size: 19px;
    margin: 0 0 8px 0;
    color: #145C3D !important;
  }

  .he-type-card p {
    font-size: 15px;
    color: #0B3828 !important;
    line-height: 1.6;
    margin: 0 0 16px 0;
  }

  .he-type-card a {
    font-size: 14px;
    font-weight: 600;
  }

  .he-item-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
    gap: 20px;
    margin-top: 32px;
  }

  .he-item-card {
    border: 1px solid #EAF5EF;
    border-radius: 8px;
    padding: 20px;
    background: #ffffff;
  }

  .he-item-card h3 {
    font-size: 17px;
    margin: 0 0 8px 0;
    color: #145C3D !important;
  }

  .he-item-card p {
    font-size: 14px;
    color: #6B8E79 !important;
    margin: 0;
  }
</style>

<main class="he-page-theme">
	<?php if ($section === ''): ?>
	<!-- Hub page -->
	<section class="he-service-catalog" aria-labelledby="resources-hub-title">
		<div class="auto-container">
			<div class="he-catalog-heading">
				<div>
					<p class="he-overline">RESOURCE LIBRARY</p>
					<h2 id="resources-hub-title">Practical <span class="he-h2-accent">tools and</span> guides.</h2>
				</div>
				<p>SEO checklists, web development guides, WordPress resources, PHP code examples, and more for developers and website owners.</p>
			</div>
			<div class="he-type-grid">
				<?php foreach ($resourceTypes as $key => $data): ?>
				<article class="he-type-card">
					<h3><?php echo htmlspecialchars($data['title'], ENT_QUOTES, 'UTF-8'); ?></h3>
					<p><?php echo htmlspecialchars($data['description'], ENT_QUOTES, 'UTF-8'); ?></p>
					<a class="he-green-link" href="resources.php?type=<?php echo htmlspecialchars($key, ENT_QUOTES, 'UTF-8'); ?>">Browse <span aria-hidden="true">&#8594;</span></a>
				</article>
				<?php endforeach; ?>
			</div>
		</div>
	</section>
	<?php else: ?>
	<!-- Subpage -->
	<section class="he-about-intro">
		<div class="auto-container">
			<p class="he-overline"><?php echo htmlspecialchars($typeData['title'], ENT_QUOTES, 'UTF-8'); ?></p>
			<h1><?php echo htmlspecialchars($typeData['title'], ENT_QUOTES, 'UTF-8'); ?></h1>
			<p><?php echo htmlspecialchars($typeData['description'], ENT_QUOTES, 'UTF-8'); ?></p>

			<div class="he-item-grid">
				<?php foreach ($typeData['items'] as $item): ?>
				<article class="he-item-card">
					<h3><?php echo htmlspecialchars($item['title'], ENT_QUOTES, 'UTF-8'); ?></h3>
					<p><?php echo htmlspecialchars($item['desc'], ENT_QUOTES, 'UTF-8'); ?></p>
				</article>
				<?php endforeach; ?>
			</div>

			<a class="he-pill-button" href="resources.php">
				<span>Back to resource library</span>
				<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
					<line x1="5" y1="12" x2="19" y2="12"></line>
					<polyline points="12 5 19 12 12 19"></polyline>
				</svg>
			</a>
		</div>
	</section>
	<?php endif; ?>
</main>
<?php require __DIR__ . '/page-footer.php'; ?>
