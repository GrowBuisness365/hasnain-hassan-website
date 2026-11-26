<?php
$pageKey = 'sitemap';
$crumbs = array(array('label' => 'Sitemap', 'file' => 'sitemap.php'));
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

  .he-sitemap-content {
    max-width: 800px;
    margin: 0 auto;
  }

  .he-sitemap-section {
    margin-bottom: 32px;
  }

  .he-sitemap-section h2 {
    font-size: 20px;
    color: #145C3D !important;
    margin: 0 0 12px 0;
    border-bottom: 1px solid #EAF5EF;
    padding-bottom: 8px;
  }

  .he-sitemap-section ul {
    list-style: none;
    margin: 0;
    padding: 0;
    color: #0B3828 !important;
  }

  .he-sitemap-section li {
    margin-bottom: 6px;
    font-size: 15px;
  }

  .he-sitemap-section li a {
    color: #0B3828 !important;
    text-decoration: none;
    font-weight: 500;
  }

  .he-sitemap-section li a:hover {
    color: #145C3D !important;
    text-decoration: underline;
  }

  .he-sub-list {
    margin-left: 20px;
    margin-top: 8px;
  }

  .he-sub-list li {
    font-size: 14px;
    color: #6B8E79 !important;
  }

  .he-sub-list li a {
    color: #6B8E79 !important;
    font-weight: 400;
  }

  .he-sub-list li a:hover {
    color: #145C3D !important;
  }
</style>

<main class="he-page-theme">
	<section class="he-about-intro">
		<div class="auto-container he-sitemap-content">
			<p class="he-override">SITEMAP</p>
			<h1>Sitemap</h1>
			<p>A complete overview of all pages on HassanEngine.</p>

			<div class="he-sitemap-section">
				<h2>Main Pages</h2>
				<ul>
					<li><a href="index.php">Home</a></li>
					<li><a href="about.php">About</a></li>
					<li><a href="services.php">Services</a></li>
					<li><a href="web-development.php">Web Development</a></li>
					<li><a href="seo.php">SEO</a></li>
					<li><a href="blog.php">Blog</a></li>
					<li><a href="resources.php">Resources</a></li>
					<li><a href="contact.php">Contact</a></li>
					<li><a href="faq.php">FAQ</a></li>
				</ul>
			</div>

			<div class="he-sitemap-section">
				<h2>Services</h2>
				<ul>
					<li><a href="services.php?service=website-development">Website Development</a></li>
					<li><a href="services.php?service=wordpress-development">WordPress Development</a></li>
					<li><a href="services.php?service=php-development">PHP Development</a></li>
					<li><a href="services.php?service=seo">Search Engine Optimization</a></li>
					<li><a href="services.php?service=technical-seo">Technical SEO</a></li>
					<li><a href="services.php?service=on-page-seo">On-Page SEO</a></li>
					<li><a href="services.php?service=off-page-seo">Off-Page SEO</a></li>
					<li><a href="services.php?service=website-speed-optimization">Website Speed Optimization</a></li>
				</ul>
			</div>

			<div class="he-sitemap-section">
				<h2>Web Development Topics</h2>
				<ul>
					<li><a href="web-development.php?section=php">PHP Development</a></li>
					<li><a href="web-development.php?section=wordpress">WordPress Development</a></li>
					<li><a href="web-development.php?section=html-css">HTML & CSS</a></li>
					<li><a href="web-development.php?section=javascript">JavaScript Development</a></li>
					<li><a href="web-development.php?section=frontend">Frontend Development</a></li>
					<li><a href="web-development.php?section=responsive-design">Responsive Web Design</a></li>
					<li><a href="web-development.php?section=website-security">Website Security</a></li>
					<li><a href="web-development.php?section=performance">Website Performance</a></li>
				</ul>
			</div>

			<div class="he-sitemap-section">
				<h2>SEO Topics</h2>
				<ul>
					<li><a href="seo.php?section=seo-fundamentals">SEO Fundamentals</a></li>
					<li><a href="seo.php?section=keyword-research">Keyword Research</a></li>
					<li><a href="seo.php?section=on-page-seo">On-Page SEO</a></li>
					<li><a href="seo.php?section=off-page-seo">Off-Page SEO</a></li>
					<li><a href="seo.php?section=technical-seo">Technical SEO</a></li>
					<li><a href="seo.php?section=local-seo">Local SEO</a></li>
					<li><a href="seo.php?section=content-seo">Content SEO</a></li>
					<li><a href="seo.php?section=link-building">Link Building</a></li>
					<li><a href="seo.php?section=google-search-console">Google Search Console</a></li>
					<li><a href="seo.php?section=website-audit">Website Audits</a></li>
					<li><a href="seo.php?section=seo-tools">SEO Tools</a></li>
					<li><a href="seo.php?section=google-indexing">Google Indexing</a></li>
				</ul>
			</div>

			<div class="he-sitemap-section">
				<h2>Resources</h2>
				<ul>
					<li><a href="resources.php?type=seo-checklists">SEO Checklists</a></li>
					<li><a href="resources.php?type=web-development-guides">Website Development Guides</a></li>
					<li><a href="resources.php?type=wordpress-resources">WordPress Resources</a></li>
					<li><a href="resources.php?type=php-code-examples">PHP Code Examples</a></li>
					<li><a href="resources.php?type=launch-checklist">Website Launch Checklist</a></li>
					<li><a href="resources.php?type=technical-seo-checklist">Technical SEO Checklist</a></li>
					<li><a href="resources.php?type=gsc-guides">Google Search Console Guides</a></li>
					<li><a href="resources.php?type=performance-guides">Website Performance Guides</a></li>
					<li><a href="resources.php?type=dev-tools">Recommended Development Tools</a></li>
					<li><a href="resources.php?type=seo-tools">Recommended SEO Tools</a></li>
				</ul>
			</div>

			<div class="he-sitemap-section">
				<h2>Legal</h2>
				<ul>
					<li><a href="privacy-policy.php">Privacy Policy</a></li>
					<li><a href="terms-and-conditions.php">Terms and Conditions</a></li>
					<li><a href="disclaimer.php">Disclaimer</a></li>
				</ul>
			</div>

			<div class="he-sitemap-section">
				<h2>Articles</h2>
				<ul>
					<?php foreach ($posts as $post): ?>
					<li><a href="<?php echo htmlspecialchars(post_url($post), ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars($post['title'], ENT_QUOTES, 'UTF-8'); ?></a></li>
					<?php endforeach; ?>
				</ul>
			</div>

			<div class="he-sitemap-section">
				<h2>Projects</h2>
				<ul>
					<?php foreach ($projects as $project): ?>
					<li><a href="<?php echo htmlspecialchars(SITE_URL . '/' . project_url($project), ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars($project['title'], ENT_QUOTES, 'UTF-8'); ?></a></li>
					<?php endforeach; ?>
				</ul>
			</div>

			<div class="he-sitemap-section">
				<h2>Contributors</h2>
				<ul>
					<?php foreach ($team as $member): ?>
					<li><a href="<?php echo htmlspecialchars(SITE_URL . '/team-detail?author=' . rawurlencode($member['name']), ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars($member['name'], ENT_QUOTES, 'UTF-8'); ?></a></li>
					<?php endforeach; ?>
				</ul>
			</div>
		</div>
	</section>
</main>
<?php require __DIR__ . '/page-footer.php'; ?>
