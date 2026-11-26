<?php
$pageKey = 'about';
$crumbs = array(array('label' => 'About'));
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
    border: 1px solid #298D47 !important;
    border-radius: 999px !important;
    background-color: #298D47 !important;
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

  .he-author-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
    gap: 24px;
    margin-top: 24px;
  }

  .he-author-card {
    border: 1px solid #EAF5EF;
    border-radius: 8px;
    padding: 24px;
    background: #ffffff;
    text-align: center;
  }

  .he-author-card img {
    width: 96px;
    height: 96px;
    border-radius: 50%;
    object-fit: cover;
    margin: 0 auto 16px auto;
    display: block;
  }

  .he-author-card h3 {
    font-size: 18px;
    margin: 0 0 4px 0;
    color: #0B3828 !important;
  }

  .he-author-card p {
    font-size: 14px;
    color: #6B8E79 !important;
    margin: 4px 0 0 0;
  }

  .he-two-col {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 32px;
    align-items: start;
  }

  .he-mission-card,
  .he-vision-card {
    padding: 24px;
    border-radius: 8px;
    background: #EAF5EF;
    border: 1px solid #EAF5EF;
  }

  .he-mission-card h3,
  .he-vision-card h3 {
    font-size: 18px;
    margin: 0 0 12px 0;
    color: #145C3D !important;
  }

  .he-mission-card p,
  .he-vision-card p {
    font-size: 15px;
    color: #0B3828 !important;
    line-height: 1.6;
    margin: 0;
  }
</style>

<main class="he-page-theme">
	<section class="he-about-intro">
		<div class="auto-container he-about-intro_grid">
			<div class="he-about-photo">
				<img src="<?php echo SITE_URL; ?>/assets/images/resource/story-3.optimized.jpg" width="294" height="392" alt="Professional planning a project" fetchpriority="high" decoding="async">
				<span>Code with purpose.<br>Optimize for people.</span>
			</div>
			<div class="he-about-copy">
				<p class="he-overline">ABOUT HASSANENGINE</p>
				<h2>About HassanEngine <span class="he-h2-accent">from day one.</span></h2>
				<p>HassanEngine is a web development and SEO platform built to help businesses create fast, search-friendly websites. The site shares practical development knowledge and SEO strategies drawn from real project work.</p>
				<p>My work spans WordPress, custom PHP, HTML, CSS, Bootstrap, Tailwind CSS, React, and Next.js, alongside technical, on-page, off-page, local, traditional, and semantic SEO.</p>
				<a class="he-green-link" href="contact.php">Discuss your project <span aria-hidden="true">&#8594;</span></a>
			</div>
		</div>
	</section>

	<?php include __DIR__ . '/components/technology-slider.php'; ?>

	<section class="he-about-intro">
		<div class="auto-container he-about-intro_grid">
			<div class="he-about-copy">
				<p class="he-overline">OUR MISSION</p>
				<h2>Helping websites <span class="he-h2-accent">grow through</span> thoughtful development.</h2>
				<div class="he-two-col">
					<div class="he-mission-card">
						<h3>Mission</h3>
						<p>To provide clear, practical web development and SEO guidance that helps businesses build websites people can find and use.</p>
					</div>
					<div class="he-vision-card">
						<h3>Vision</h3>
						<p>A web where every site is fast, well-structured, and easy to discover—regardless of the team or budget behind it.</p>
					</div>
				</div>
			</div>
		</div>
	</section>

	<?php include __DIR__ . '/components/technology-slider.php'; ?>

	<section class="he-service-catalog">
		<div class="auto-container">
			<div class="he-catalog-heading">
				<div>
					<p class="he-overline">WHAT THE PLATFORM COVERS</p>
					<h2>Development and <span class="he-h2-accent">SEO knowledge</span> in one place.</h2>
				</div>
				<p>HassanEngine covers web development, search engine optimization, and the practical intersection of both.</p>
			</div>
			<div class="he-catalog-grid">
				<article class="he-catalog-card">
					<span class="he-catalog_icon fa fa-code" aria-hidden="true"></span>
					<p class="he-card-step">01</p>
					<h3>Web Development</h3>
					<p>PHP, WordPress, HTML, CSS, Bootstrap, Tailwind CSS, React, and Next.js development for responsive websites.</p>
					<a href="web-development.php">Explore <span aria-hidden="true">&#8594;</span></a>
				</article>
				<article class="he-catalog-card">
					<span class="he-catalog_icon fa fa-search" aria-hidden="true"></span>
					<p class="he-card-step">02</p>
					<h3>Search Engine Optimization</h3>
					<p>Technical, on-page, off-page, local, and semantic SEO for better search visibility.</p>
					<a href="seo.php">Explore <span aria-hidden="true">&#8594;</span></a>
				</article>
				<article class="he-catalog-card">
					<span class="he-catalog_icon fa fa-book" aria-hidden="true"></span>
					<p class="he-card-step">03</p>
					<h3>Blog and Tutorials</h3>
					<p>Practical articles on software development, architecture, testing, and developer workflows.</p>
					<a href="blog.php">Explore <span aria-hidden="true">&#8594;</span></a>
				</article>
				<article class="he-catalog-card">
					<span class="he-catalog_icon fa fa-list" aria-hidden="true"></span>
					<p class="he-card-step">04</p>
					<h3>Resources</h3>
					<p>Checklists, guides, and code examples for developers and SEO practitioners.</p>
					<a href="resources.php">Explore <span aria-hidden="true">&#8594;</span></a>
				</article>
			</div>
		</div>
	</section>

	<?php include __DIR__ . '/components/technology-slider.php'; ?>

	<section class="he-about-intro">
		<div class="auto-container he-about-intro_grid">
			<div class="he-about-copy">
				<p class="he-overline">LEARNING APPROACH</p>
				<h2>Development and <span class="he-h2-accent">SEO taught</span> practically.</h2>
				<div class="he-two-col">
					<div class="he-mission-card">
						<h3>Web development approach</h3>
						<p>Guides cover PHP, WordPress, frontend development, responsive design, security, and performance—written from production experience rather than theory alone.</p>
					</div>
					<div class="he-vision-card">
						<h3>SEO knowledge</h3>
						<p>Technical audits, on-page optimization, off-page strategy, local SEO, and content SEO explained with implementation choices and trade-offs named up front.</p>
					</div>
				</div>
			</div>
		</div>
	</section>

	<?php include __DIR__ . '/components/technology-slider.php'; ?>

	<section class="he-home-faq" aria-labelledby="author-title">
		<div class="auto-container he-home-faq_grid">
			<div>
				<p class="he-overline">AUTHOR INTRODUCTION</p>
				<h2 id="author-title">Meet <span class="he-h2-accent">the person</span> behind HassanEngine.</h2>
			</div>
			<div class="he-author-grid">
				<?php foreach ($team as $member): ?>
				<article class="he-author-card">
					<img src="<?php echo SITE_URL; ?>/<?php echo htmlspecialchars($member['image'], ENT_QUOTES, 'UTF-8'); ?>" alt="Portrait of <?php echo htmlspecialchars($member['name'], ENT_QUOTES, 'UTF-8'); ?>" loading="lazy" decoding="async">
					<h3><?php echo htmlspecialchars($member['name'], ENT_QUOTES, 'UTF-8'); ?></h3>
					<p><?php echo htmlspecialchars($member['role'], ENT_QUOTES, 'UTF-8'); ?></p>
					<p style="font-size: 13px; margin-top: 8px;"><?php echo htmlspecialchars($member['bio'], ENT_QUOTES, 'UTF-8'); ?></p>
				</article>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<section class="he-final-cta">
		<div class="auto-container">
			<p class="he-overline">LET'S WORK TOGETHER</p>
			<h2>Have a website or <span class="he-h2-accent">SEO project</span> in mind?</h2>
			<p>Send a note with a little about your goals.</p>
			<a class="he-pill-button" href="contact.php">
				<span>Get in touch</span>
				<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
					<line x1="5" y1="12" x2="19" y2="12"></line>
					<polyline points="12 5 19 12 12 19"></polyline>
				</svg>
			</a>
		</div>
	</section>
</main>
<?php require __DIR__ . '/page-footer.php'; ?>
