<?php
$pageKey = 'web-development';
$section = isset($_GET['section']) ? trim((string) $_GET['section']) : '';
$crumbs = array(array('label' => 'Web Development', 'file' => 'web-development.php'));

$webDevSections = array(
    'php' => array(
        'title' => 'PHP Development',
        'intro' => 'Server-side development with PHP for dynamic, database-driven web applications.',
        'problems' => 'Many websites rely on outdated PHP versions, insecure coding practices, and monolithic codebases that are hard to maintain.',
        'details' => 'PHP remains one of the most widely used server-side languages. Modern PHP (8.x) offers typed properties, match expressions, JIT compilation, and strong typing. I build applications using current PHP standards with Composer dependency management, PSR autoloading, and secure coding practices.',
        'process' => 'Requirements gathering → Architecture design → Development with modern PHP standards → Testing → Deployment → Maintenance',
        'benefits' => 'Fast execution, extensive ecosystem, affordable hosting, and a large talent pool make PHP a practical choice for many web projects.',
        'related' => array('custom-wordpress-plugin-development', 'wordpress-security-hardening', 'wordpress-performance-optimization'),
    ),
    'wordpress' => array(
        'title' => 'WordPress Development',
        'intro' => 'Flexible WordPress websites built around your business needs using child themes, block themes, and custom plugins.',
        'problems' => 'WordPress sites often suffer from bloated themes, too many plugins, poor performance, and security vulnerabilities from outdated components.',
        'details' => 'I build WordPress sites using child themes and the block editor (Gutenberg) for maintainability. Custom plugins extend functionality safely using WordPress hooks, admin settings, and database tables. Security and performance are considered from the start.',
        'process' => 'Discovery → Theme selection or custom theme → Plugin evaluation → Content migration → Testing → Launch → Training',
        'benefits' => 'Easy content management, thousands of themes and plugins, large community, and straightforward hosting make WordPress accessible for businesses of all sizes.',
        'related' => array('wordpress-theme-development-best-practices', 'custom-wordpress-plugin-development', 'wordpress-block-theme-development'),
    ),
    'html-css' => array(
        'title' => 'HTML & CSS',
        'intro' => 'Semantic HTML and modern CSS for accessible, well-structured web pages.',
        'problems' => 'Poorly structured HTML and unmaintainable CSS lead to accessibility issues, slow rendering, and difficult updates.',
        'details' => 'Semantic HTML5 elements (article, section, nav, main, aside) help search engines and assistive technology understand your content. Modern CSS with custom properties, flexbox, and grid creates responsive layouts without heavy frameworks.',
        'process' => 'Content structure → Semantic markup → CSS architecture → Responsive breakpoints → Accessibility audit → Performance check',
        'benefits' => 'Fast-loading pages, better accessibility, easier maintenance, and solid foundations for any frontend framework.',
        'related' => array('semantic-html-for-better-seo', 'responsive-web-design-wordpress'),
    ),
    'javascript' => array(
        'title' => 'JavaScript Development',
        'intro' => 'Interactive web experiences with modern JavaScript, from vanilla JS to frameworks.',
        'problems' => 'Over-reliance on JavaScript for basic content, poorly optimized bundles, and accessibility gaps in interactive components.',
        'details' => 'Progressive enhancement means core content works without JavaScript. Interactive features use modern JavaScript (ES6+) with module-based organization. Frameworks like React and Next.js are used when they add real value.',
        'process' => 'Feature planning → Vanilla JS prototype → Framework selection (if needed) → Component development → Testing → Optimization',
        'benefits' => 'Interactive user experiences, dynamic content updates, and modern development tooling when appropriate.',
        'related' => array(),
    ),
    'frontend' => array(
        'title' => 'Frontend Development',
        'intro' => 'HTML, CSS, Bootstrap, Tailwind CSS, React, and Next.js for responsive, modern interfaces.',
        'problems' => 'Frontend code that works on desktop but breaks on mobile, slow first paint, and inaccessible interactive components.',
        'details' => 'Mobile-first responsive design with Bootstrap or Tailwind CSS. React and Next.js for applications that need client-side interactivity or server-side rendering. Component-based architecture for maintainability.',
        'process' => 'Design review → Component architecture → Responsive implementation → Cross-browser testing → Performance audit → Deployment',
        'benefits' => 'Consistent interfaces across devices, faster development with component libraries, and modern tooling for scalable frontend code.',
        'related' => array('responsive-web-design-wordpress', 'frontend-development'),
    ),
    'responsive-design' => array(
        'title' => 'Responsive Web Design',
        'intro' => 'Websites that adapt cleanly to every screen size without sacrificing performance.',
        'problems' => 'Fixed-width layouts, unoptimized images, and touch targets that are too small on mobile devices.',
        'details' => 'Fluid grids, flexible images, and CSS media queries create layouts that work on phones, tablets, and desktops. Touch-friendly navigation, readable typography at all sizes, and performance-conscious asset delivery.',
        'process' => 'Mobile-first design → Breakpoint planning → Fluid layouts → Touch optimization → Device testing → Performance validation',
        'benefits' => 'Better mobile user experience, improved search rankings (mobile-first indexing), and a single codebase for all devices.',
        'related' => array('responsive-web-design-wordpress'),
    ),
    'website-security' => array(
        'title' => 'Website Security',
        'intro' => 'Protect your website from common threats with hardening and best practices.',
        'problems' => 'Outdated software, weak passwords, missing HTTPS, and unvalidated user input expose websites to attacks.',
        'details' => 'Security headers, input validation, prepared statements for database queries, file permission reviews, and regular updates. For WordPress, login hardening, file permission checks, and malware scanning.',
        'process' => 'Security audit → Vulnerability remediation → Hardening → Monitoring → Regular updates → Incident response planning',
        'benefits' => 'Reduced risk of data breaches, protected user information, and maintained site availability.',
        'related' => array('wordpress-security-hardening'),
    ),
    'performance' => array(
        'title' => 'Website Performance',
        'intro' => 'Optimize load speed, Core Web Vitals, and overall site responsiveness.',
        'problems' => 'Large unoptimized images, render-blocking resources, slow server response, and unused CSS/JavaScript.',
        'details' => 'Image optimization with modern formats (WebP, AVIF), lazy loading, CSS and JavaScript minification, caching strategies, and Core Web Vitals monitoring (LCP, INP, CLS).',
        'process' => 'Performance audit → Identify bottlenecks → Optimize assets → Implement caching → Monitor Core Web Vitals → Ongoing optimization',
        'benefits' => 'Better search rankings, improved user experience, lower bounce rates, and higher conversion rates.',
        'related' => array('core-web-vitals-wordpress', 'wordpress-performance-optimization'),
    ),
);

require __DIR__ . '/bootstrap.php';

// If a section is requested, render the subpage; otherwise render the hub.
if ($section !== '' && isset($webDevSections[$section])) {
    $sectionData = $webDevSections[$section];
    $pageTitle = $sectionData['title'];
    $pageDesc = $sectionData['intro'];
    $canonical = SITE_URL . '/web-development/' . $section;
} else {
    $section = '';
    $pageTitle = 'Web Development';
    $pageDesc = 'Learn web development with HassanEngine: PHP, WordPress, HTML & CSS, JavaScript, frontend development, responsive design, website security, and performance optimization.';
    $canonical = SITE_URL . '/web-development';
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

  .he-section-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 24px;
  }

  .he-section-card {
    border: 1px solid #EAF5EF;
    border-radius: 8px;
    padding: 28px;
    background: #ffffff;
    transition: transform 0.2s ease, border-color 0.2s ease;
  }

  .he-section-card:hover {
    transform: translateY(-2px);
    border-color: #145C3D;
  }

  .he-section-card h3 {
    font-size: 19px;
    margin: 0 0 10px 0;
    color: #145C3D !important;
  }

  .he-section-card p {
    font-size: 15px;
    color: #1f2937 !important;
    line-height: 1.6;
    margin: 0 0 16px 0;
  }

  .he-section-card a {
    font-size: 14px;
    font-weight: 600;
  }

  .he-subpage-content {
    max-width: 800px;
    margin: 0 auto;
  }

  .he-subpage-content h2 {
    font-size: 24px;
    margin-top: 0;
    color: #145C3D !important;
  }

  .he-subpage-content h3 {
    font-size: 20px;
    color: #145C3D !important;
  }

  .he-subpage-content p {
    font-size: 16px;
    line-height: 1.7;
    color: #0B3828 !important;
    margin: 0 0 16px 0;
  }

  .he-subpage-content ul {
    margin: 0 0 16px 0;
    padding-left: 20px;
    color: #0B3828 !important;
  }

  .he-subpage-content li {
    margin-bottom: 8px;
  }

  .he-related-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
    gap: 20px;
    margin-top: 32px;
  }

  .he-related-card {
    border: 1px solid #EAF5EF;
    border-radius: 8px;
    padding: 20px;
    background: #ffffff;
  }

  .he-related-card h3 {
    font-size: 17px;
    margin: 0 0 8px 0;
    color: #145C3D !important;
  }

  .he-related-card p {
    font-size: 14px;
    color: #6B8E79 !important;
    margin: 0 0 12px 0;
  }
</style>

<main class="he-page-theme">
	<?php if ($section === ''): ?>
	<!-- Hub page -->
	<section class="he-service-catalog" aria-labelledby="webdev-hub-title">
		<div class="auto-container">
			<div class="he-catalog-heading">
				<div>
					<p class="he-overline">WEB DEVELOPMENT</p>
					<h2 id="webdev-hub-title">Learn <span class="he-h2-accent">web development</span> with HassanEngine.</h2>
				</div>
				<p>Practical guides and tutorials across the full web development stack, from server-side PHP to frontend performance.</p>
			</div>
			<div class="he-section-grid">
				<?php foreach ($webDevSections as $key => $data): ?>
				<article class="he-section-card">
					<h3><?php echo htmlspecialchars($data['title'], ENT_QUOTES, 'UTF-8'); ?></h3>
					<p><?php echo htmlspecialchars($data['intro'], ENT_QUOTES, 'UTF-8'); ?></p>
					<a class="he-green-link" href="web-development.php?section=<?php echo htmlspecialchars($key, ENT_QUOTES, 'UTF-8'); ?>">Read guide <span aria-hidden="true">&#8594;</span></a>
				</article>
				<?php endforeach; ?>
			</div>
		</div>
	</section>
	<?php else: ?>
	<!-- Subpage -->
	<section class="he-about-intro">
		<div class="auto-container he-subpage-content">
			<p class="he-overline"><?php echo htmlspecialchars($sectionData['title'], ENT_QUOTES, 'UTF-8'); ?></p>
			<h1><?php echo htmlspecialchars($sectionData['title'], ENT_QUOTES, 'UTF-8'); ?></h1>
			<p><?php echo htmlspecialchars($sectionData['intro'], ENT_QUOTES, 'UTF-8'); ?></p>

			<h3>Problems this addresses</h3>
			<p><?php echo htmlspecialchars($sectionData['problems'], ENT_QUOTES, 'UTF-8'); ?></p>

			<h3>What it covers</h3>
			<p><?php echo htmlspecialchars($sectionData['details'], ENT_QUOTES, 'UTF-8'); ?></p>

			<h3>Process</h3>
			<ul>
				<?php foreach (explode(' → ', $sectionData['process']) as $step): ?>
				<li><?php echo htmlspecialchars(trim($step), ENT_QUOTES, 'UTF-8'); ?></li>
				<?php endforeach; ?>
			</ul>

			<h3>Benefits</h3>
			<p><?php echo htmlspecialchars($sectionData['benefits'], ENT_QUOTES, 'UTF-8'); ?></p>

			<?php if (!empty($sectionData['related'])): ?>
			<h3>Related articles</h3>
			<div class="he-related-grid">
				<?php foreach ($sectionData['related'] as $relatedSlug): 
					$relatedPost = null;
					foreach ($posts as $post) {
						if ($post['slug'] === $relatedSlug) {
							$relatedPost = $post;
							break;
						}
					}
					if ($relatedPost === null) continue;
				?>
				<article class="he-related-card">
					<h3><?php echo htmlspecialchars($relatedPost['title'], ENT_QUOTES, 'UTF-8'); ?></h3>
					<p><?php echo htmlspecialchars($relatedPost['excerpt'], ENT_QUOTES, 'UTF-8'); ?></p>
					<a class="he-green-link" href="<?php echo htmlspecialchars(post_url($relatedPost), ENT_QUOTES, 'UTF-8'); ?>">Read article <span aria-hidden="true">&#8594;</span></a>
				</article>
				<?php endforeach; ?>
			</div>
			<?php endif; ?>

			<a class="he-pill-button" href="contact.php">
				<span>Discuss your project</span>
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
