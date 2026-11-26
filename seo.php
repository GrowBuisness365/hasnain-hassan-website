<?php
$pageKey = 'seo';
$section = isset($_GET['section']) ? trim((string) $_GET['section']) : '';
$crumbs = array(array('label' => 'SEO', 'file' => 'seo.php'));

$seoSections = array(
    'seo-fundamentals' => array(
        'title' => 'SEO Fundamentals',
        'intro' => 'The core principles of search engine optimization: how search engines work, what they look for, and how to build a foundation.',
        'problems' => 'Many websites ignore the basics—crawlability, indexability, and clear site structure—which makes every other SEO effort harder.',
        'details' => 'SEO starts with making sure search engines can find, crawl, and index your pages. That means clean URLs, proper HTML structure, fast load times, and content that matches what people search for. From there, you build authority through quality content and relevant links.',
        'process' => 'Audit current state → Fix technical foundations → Optimize on-page elements → Create quality content → Build authority → Monitor and refine',
        'benefits' => 'Better visibility in search results, more qualified traffic, and a sustainable foundation for growth.',
        'related' => array('technical-seo-audit-checklist-2026', 'on-page-seo-content-optimization'),
    ),
    'keyword-research' => array(
        'title' => 'Keyword Research',
        'intro' => 'Finding the search terms your audience uses to discover services like yours, and prioritizing them by intent and opportunity.',
        'problems' => 'Targeting keywords that are too competitive, too broad, or irrelevant to your business wastes time and brings the wrong visitors.',
        'details' => 'Start with seed keywords related to your services, then expand using research tools. Look at search volume, keyword difficulty, and search intent (informational, navigational, commercial, transactional). Group keywords into topics and map them to specific pages.',
        'process' => 'Brainstorm seed keywords → Expand with tools → Analyze intent and difficulty → Group by topic → Map to pages → Prioritize',
        'benefits' => 'Content that matches real search queries, higher click-through rates, and traffic that converts.',
        'related' => array('seo-friendly-url-structure', 'content-seo'),
    ),
    'on-page-seo' => array(
        'title' => 'On-Page SEO',
        'intro' => 'Aligning page titles, descriptions, headings, internal links, and content with search intent so your pages rank and convert.',
        'problems' => 'Missing or duplicate titles, thin content, poor heading structure, and missing internal links prevent pages from ranking.',
        'details' => 'Each page needs a unique title tag and meta description, a clear H1, proper heading hierarchy (H2, H3), descriptive alt text for images, and internal links to related content. Content should thoroughly answer the searcher\'s question.',
        'process' => 'Keyword mapping → Title and meta description → Heading structure → Content creation → Internal linking → Image optimization',
        'benefits' => 'Clearer page topics for search engines, better user experience, and higher rankings for targeted queries.',
        'related' => array('on-page-seo-content-optimization', 'semantic-html-for-better-seo'),
    ),
    'off-page-seo' => array(
        'title' => 'Off-Page SEO',
        'intro' => 'Building relevant off-page visibility, sound search practices, and trust signals for long-term results.',
        'problems' => 'Buying links, participating in link schemes, or ignoring off-page signals entirely limits how well your site can rank.',
        'details' => 'Off-page SEO focuses on signals outside your website: backlinks from relevant sites, brand mentions, local citations, and social signals. Quality matters more than quantity—a few links from authoritative, relevant sites are worth more than many from low-quality directories.',
        'process' => 'Audit existing backlinks → Identify link opportunities → Outreach and relationship building → Create link-worthy content → Monitor referring domains',
        'benefits' => 'Increased domain authority, more referral traffic, and stronger competitive positioning.',
        'related' => array(),
    ),
    'technical-seo' => array(
        'title' => 'Technical SEO',
        'intro' => 'Review crawlability, indexability, site structure, page speed, canonical URLs, and structured data.',
        'problems' => 'Slow pages, broken links, duplicate content, missing XML sitemaps, and incorrect robots directives prevent search engines from properly indexing your site.',
        'details' => 'Technical SEO ensures search engines can efficiently crawl and index your site. This includes XML sitemaps, robots.txt, canonical tags, structured data (schema.org), page speed optimization, mobile-friendliness, HTTPS, and fixing crawl errors.',
        'process' => 'Technical audit → Fix crawl errors → Optimize site speed → Implement structured data → Validate mobile usability → Monitor Search Console',
        'benefits' => 'Efficient crawling, faster indexing, rich results in search, and better overall site health.',
        'related' => array('technical-seo-audit-checklist-2026', 'core-web-vitals-wordpress'),
    ),
    'local-seo' => array(
        'title' => 'Local SEO',
        'intro' => 'Helping nearby customers find your business through local search results and maps.',
        'problems' => 'Missing or inconsistent business information across directories, no Google Business Profile, and no local content make it hard for nearby customers to find you.',
        'details' => 'Local SEO focuses on geographic visibility: Google Business Profile optimization, local citations, location pages, review management, and location-specific keywords. Consistency of name, address, and phone (NAP) across the web is critical.',
        'process' => 'Claim and optimize Google Business Profile → Build local citations → Create location pages → Encourage reviews → Target local keywords',
        'benefits' => 'Visibility in local search results and maps, more foot traffic and phone calls from nearby customers.',
        'related' => array('local-seo-for-small-business'),
    ),
    'content-seo' => array(
        'title' => 'Content SEO',
        'intro' => 'Creating content that ranks and converts with clear structure, purpose, and search intent alignment.',
        'problems' => 'Thin content, keyword stuffing, and content that doesn\'t match search intent fails to rank or convert visitors.',
        'details' => 'Content SEO means creating comprehensive, original content that thoroughly addresses the searcher\'s need. Use proper heading structure, include related keywords naturally, add internal links, and keep content updated. Format for readability with short paragraphs, bullet points, and clear takeaways.',
        'process' => 'Topic research → Outline creation → Content writing → On-page optimization → Internal linking → Publishing → Updates',
        'benefits' => 'Authority in your niche, engaged readers, and content that continues to attract traffic over time.',
        'related' => array('on-page-seo-content-optimization', 'semantic-html-for-better-seo'),
    ),
    'link-building' => array(
        'title' => 'Link Building',
        'intro' => 'Earning quality backlinks from relevant websites to build authority and trust.',
        'problems' => 'Buying links, using link farms, or getting links from irrelevant sites can trigger search engine penalties and harm rankings.',
        'details' => 'Sustainable link building means creating content worth linking to and promoting it to the right people. Guest posts on relevant sites, resource page link building, digital PR, and original research all earn links naturally. Focus on relevance and authority over quantity.',
        'process' => 'Link-worthy content creation → Prospect research → Outreach → Follow-up → Monitor new links → Disavow toxic links',
        'benefits' => 'Higher domain authority, more referral traffic, and stronger search visibility.',
        'related' => array(),
    ),
    'google-search-console' => array(
        'title' => 'Google Search Console',
        'intro' => 'Using Google Search Console to monitor search performance, fix indexing issues, and understand how Google sees your site.',
        'problems' => 'Not verifying your site in Search Console means missing critical data about search visibility, indexing errors, and manual actions.',
        'details' => 'Search Console shows which queries bring traffic, which pages appear in search, click-through rates, average positions, indexing errors, mobile usability issues, and security problems. Submit your sitemap, request indexing for new pages, and fix errors promptly.',
        'process' => 'Verify site ownership → Submit XML sitemap → Review performance report → Fix coverage errors → Monitor mobile usability → Track Core Web Vitals',
        'benefits' => 'Direct insight from Google, faster indexing, and early warning of technical issues.',
        'related' => array(),
    ),
    'website-audit' => array(
        'title' => 'Website Audits',
        'intro' => 'A comprehensive review of technical, on-page, and off-page SEO to identify issues and opportunities.',
        'problems' => 'Without regular audits, SEO issues accumulate—broken links, slow pages, outdated content, and missed opportunities go unnoticed.',
        'details' => 'An SEO audit examines crawlability, indexability, site architecture, page speed, content quality, backlink profile, and mobile usability. The output is a prioritized action plan with specific fixes and timelines.',
        'process' => 'Crawl the site → Analyze technical SEO → Review on-page elements → Evaluate content quality → Analyze backlinks → Create action plan',
        'benefits' => 'Clear priorities for improvement, fixed technical issues, and a roadmap for better search performance.',
        'related' => array('technical-seo-audit-checklist-2026'),
    ),
    'seo-tools' => array(
        'title' => 'SEO Tools',
        'intro' => 'Recommended tools for keyword research, technical audits, rank tracking, and performance monitoring.',
        'problems' => 'Using too many tools or the wrong ones creates confusion and wastes budget without improving results.',
        'details' => 'Essential SEO tools include Google Search Console (free), Google Analytics (free), keyword research tools, site audit crawlers, rank trackers, and page speed testing tools. Start with free tools and add paid options as your needs grow.',
        'process' => 'Identify needs → Select core tools → Set up tracking → Establish reporting → Review regularly → Adjust toolset',
        'benefits' => 'Data-driven decisions, measurable progress, and efficient use of time and budget.',
        'related' => array(),
    ),
    'google-indexing' => array(
        'title' => 'Google Indexing',
        'intro' => 'Understanding how Google discovers, crawls, and indexes your pages—and how to get new content indexed faster.',
        'problems' => 'New pages taking weeks to appear in search, important pages not indexed, or outdated content still showing in results.',
        'details' => 'Google discovers pages through links, sitemaps, and manual submission. You can speed up indexing by submitting your XML sitemap, using URL Inspection in Search Console, internal linking to new pages, and keeping your site technically healthy.',
        'process' => 'Submit sitemap → Use URL Inspection for new pages → Internal link to new content → Monitor Coverage report → Fix indexing errors',
        'benefits' => 'Faster appearance in search results, control over which pages are indexed, and quicker visibility for new content.',
        'related' => array('technical-seo-audit-checklist-2026'),
    ),
);

require __DIR__ . '/bootstrap.php';

if ($section !== '' && isset($seoSections[$section])) {
    $sectionData = $seoSections[$section];
    $pageTitle = $sectionData['title'];
    $pageDesc = $sectionData['intro'];
    $canonical = SITE_URL . '/seo/' . $section;
} else {
    $section = '';
    $pageTitle = 'SEO Knowledge Hub';
    $pageDesc = 'Learn search engine optimization with HassanEngine: SEO fundamentals, keyword research, on-page SEO, off-page SEO, technical SEO, local SEO, content SEO, link building, Google Search Console, website audits, SEO tools, and Google indexing.';
    $canonical = SITE_URL . '/seo';
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
    color: #0B3828 !important;
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
	<section class="he-service-catalog" aria-labelledby="seo-hub-title">
		<div class="auto-container">
			<div class="he-catalog-heading">
				<div>
					<p class="he-overline">SEO KNOWLEDGE HUB</p>
					<h2 id="seo-hub-title">Master <span class="he-h2-accent">search engine</span> optimization.</h2>
				</div>
				<p>In-depth guides on SEO fundamentals, keyword research, technical SEO, on-page optimization, local SEO, and more.</p>
			</div>
			<div class="he-section-grid">
				<?php foreach ($seoSections as $key => $data): ?>
				<article class="he-section-card">
					<h3><?php echo htmlspecialchars($data['title'], ENT_QUOTES, 'UTF-8'); ?></h3>
					<p><?php echo htmlspecialchars($data['intro'], ENT_QUOTES, 'UTF-8'); ?></p>
					<a class="he-green-link" href="seo.php?section=<?php echo htmlspecialchars($key, ENT_QUOTES, 'UTF-8'); ?>">Read guide <span aria-hidden="true">&#8594;</span></a>
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
				<span>Discuss your SEO needs</span>
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
