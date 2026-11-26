<?php
$pageKey = 'index';
require __DIR__ . '/bootstrap.php';
$homePosts = array_slice($posts, 0, 3);
?>
<style>
  .he-site-home,
  .he-site-home h1,
  .he-site-home h2,
  .he-site-home h3,
  .he-site-home h4,
  .he-site-home h5,
  .he-site-home h6,
  .he-site-home p,
  .he-site-home a,
  .he-site-home span,
  .he-site-home strong,
  .he-site-home summary {
    font-family: inherit !important;
    font-weight: 600 !important;
  }

  .he-site-home .he-overline {
    font-size: 12px !important;
    letter-spacing: .12em !important;
    text-transform: uppercase !important;
  }

  .he-site-home h1,
  .he-site-home h2,
  .he-site-home h3,
  .he-site-home h4,
  .he-site-home h5,
  .he-site-home h6 {
    color: #145C3D !important;
  }

  .he-site-home h1 .he-h2-accent,
  .he-site-home h2 .he-h2-accent,
  .he-site-home .he-card-step,
  .he-site-home .he-about-photo span,
  .he-site-home .he-green-link,
  .he-site-home .he-ribbon-link,
  .he-site-home .he-catalog-card a {
    color: #0B3828 !important;
  }

  .he-site-home .he-business-hero h1,
  .he-site-home .he-contact-ribbon h2 {
    color: #ffffff !important;
  }

  .he-site-home .he-business-hero h1 .he-h2-accent,
  .he-site-home .he-contact-ribbon h2 .he-h2-accent {
    color: #38A169 !important;
  }

  .he-site-home .he-business-hero .he-overline,
  .he-site-home .he-contact-ribbon .he-overline {
    color: #38A169 !important;
  }

  .he-site-home .he-contact-ribbon p:not(.he-overline),
  .he-site-home .he-contact-ribbon .he-ribbon-link {
    color: #718078 !important;
  }

  .he-site-home .he-image-statement_overlay {
    background: linear-gradient(90deg, rgba(11, 56, 40, 0.86) 0%, rgba(11, 56, 40, 0.62) 55%, rgba(11, 56, 40, 0.28) 100%) !important;
  }

  .he-site-home .he-image-statement .he-overline {
    color: #38A169 !important;
  }

  .he-site-home .he-image-statement h2 {
    color: #ffffff !important;
  }

  .he-site-home .he-image-statement h2 .he-h2-accent {
    color: #A9E86F !important;
  }

  .he-site-home .he-image-statement p:not(.he-overline) {
    color: #718078 !important;
  }

  .he-site-home .he-home-faq details summary {
    color: #0B3828 !important;
  }

  .he-site-home .he-home-faq details p {
    color: #6B8E79 !important;
  }

  .he-site-home .he-pill-button {
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

  .he-site-home .he-pill-button::before,
  .he-site-home .he-pill-button::after {
    content: none !important;
    display: none !important;
  }

  .he-site-home .he-pill-button:hover {
    background-color: #0B3828 !important;
    border-color: #0B3828 !important;
    color: #ffffff !important;
  }

  .he-site-home .he-pill-button svg {
    width: 15px !important;
    height: 15px !important;
    flex-shrink: 0 !important;
  }

  .he-site-home .he-text-button,
  .he-site-home .he-green-link,
  .he-site-home .he-ribbon-link,
  .he-site-home .he-catalog-card a {
    transition: color 0.25s ease !important;
  }

  .he-site-home .he-text-button:hover,
  .he-site-home .he-green-link:hover,
  .he-site-home .he-ribbon-link:hover,
  .he-site-home .he-catalog-card a:hover {
    color: #0B3828 !important;
  }

  /* Category grid */
  .he-category-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
    gap: 20px;
  }

  .he-category-card {
    border: 1px solid #e5e7eb;
    border-radius: 8px;
    padding: 24px;
    background: #ffffff;
    transition: transform 0.2s ease, border-color 0.2s ease;
  }

  .he-category-card:hover {
    transform: translateY(-2px);
    border-color: #145C3D;
  }

  .he-category-card h3 {
    font-size: 18px;
    margin: 0 0 8px 0;
    color: #145C3D !important;
  }

  .he-category-card p {
    font-size: 14px;
    color: #1f2937 !important;
    margin: 0;
  }

  /* Why choose section */
  .he-why-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 24px;
  }

  .he-why-card {
    text-align: center;
    padding: 24px;
  }

  .he-why-card h3 {
    font-size: 18px;
    margin: 12px 0 0 0;
    color: #145C3D !important;
  }

  .he-why-card p {
    font-size: 14px;
    color: #1f2937 !important;
    margin: 0;
  }

  /* Resources section */
  .he-resources-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
    gap: 20px;
  }

  .he-resource-card {
    border: 1px solid #e5e7eb;
    border-radius: 8px;
    padding: 20px;
    background: #ffffff;
  }

  .he-resource-card h3 {
    font-size: 17px;
    margin: 0 0 8px 0;
    color: #145C3D !important;
  }

  .he-resource-card p {
    font-size: 14px;
    color: #1f2937 !important;
    margin: 0;
  }

  /* SEO categories split layout */
  .he-image-statement_copy.he-seo-split {
    max-width: none !important;
    padding: 56px 0 !important;
    display: grid !important;
    grid-template-columns: 35% 65% !important;
    gap: 40px !important;
    align-items: start !important;
    width: 100% !important;
  }
  .he-image-statement_copy.he-seo-split > .he-seo-text {
    grid-column: 1 !important;
    max-width: none !important;
    margin-top: 40px !important;
  }
  .he-image-statement_copy.he-seo-split > .he-seo-text p {
    margin-top: 16px !important;
    margin-bottom: 0 !important;
  }
  .he-image-statement_copy.he-seo-split > .he-category-grid {
    grid-column: 2 !important;
    max-width: none !important;
    grid-template-columns: repeat(2, 1fr) !important;
    gap: 20px !important;
    justify-self: end !important;
    margin-top: 0 !important;
  }
  .he-image-statement_copy.he-seo-split .he-category-card {
    border: 1px solid rgba(255, 255, 255, 0.35);
    border-radius: 8px;
    padding: 20px;
    background: rgba(255, 255, 255, 0.92);
    color: #0f172a;
    transition: transform 0.2s ease, border-color 0.2s ease, box-shadow 0.2s ease;
    height: 100%;
    display: flex;
    flex-direction: column;
  }
  .he-image-statement_copy.he-seo-split .he-category-card:hover {
    transform: translateY(-3px);
    border-color: #38A169;
    box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
  }
  .he-image-statement_copy.he-seo-split .he-category-card h3 {
    color: #145C3D !important;
    font-size: 17px;
    margin: 0 0 8px 0;
  }
  .he-image-statement_copy.he-seo-split .he-category-card p {
    color: #334155 !important;
    font-size: 14px;
    margin: 0 0 14px 0;
    flex: 1;
  }
  .he-image-statement_copy.he-seo-split .he-category-card a {
    color: #145C3D !important;
    font-size: 13px;
    font-weight: 600;
    text-decoration: none;
    margin-top: auto;
  }
  .he-image-statement_copy.he-seo-split .he-category-card a:hover {
    color: #0B3828 !important;
  }
  .he-image-statement_copy.he-seo-split .he-seo-text h2 {
    margin-top: 0 !important;
  }

  @media (max-width: 1024px) {
    .he-image-statement_copy.he-seo-split {
      grid-template-columns: 1fr !important;
      gap: 30px !important;
      padding-right: 0 !important;
    }
    .he-image-statement_copy.he-seo-split > .he-category-grid {
      grid-template-columns: repeat(2, 1fr) !important;
    }
  }

  @media (max-width: 768px) {
    .he-image-statement_copy.he-seo-split > .he-category-grid {
      grid-template-columns: 1fr !important;
    }
  }

  /* Latest Resources card layout fix */
  .he-benefits .he-benefit-list {
    grid-template-columns: repeat(2, minmax(380px, 1fr)) !important;
    gap: 24px !important;
  }

  .he-benefits .he-benefit-list article {
    display: flex !important;
    flex-direction: column !important;
    justify-content: space-between !important;
    align-items: flex-start !important;
    height: 230px !important;
    min-height: 230px !important;
    padding: 30px !important;
    border-radius: 16px !important;
    border: 1px solid #e7ece8 !important;
    background: #fff !important;
    box-sizing: border-box !important;
    transition: border-color 0.2s ease, box-shadow 0.2s ease !important;
  }

  .he-benefits .he-benefit-list article:hover {
    border-color: #38A169 !important;
    box-shadow: 0 6px 18px -6px rgba(0, 0, 0, 0.08) !important;
  }

  .he-benefits .he-benefit-list article h3 {
    width: 100% !important;
    min-width: 0 !important;
    font-size: 22px !important;
    font-weight: 600 !important;
    color: #145C3D !important;
    margin: 0 0 12px 0 !important;
    line-height: 1.3 !important;
    overflow-wrap: normal !important;
  }

  .he-benefits .he-benefit-list article p {
    width: 100% !important;
    min-width: 0 !important;
    font-size: 16px !important;
    font-weight: 400 !important;
    color: #334155 !important;
    line-height: 1.6 !important;
    margin: 0 !important;
  }

  .he-benefits .he-benefit-list article a {
    width: 100% !important;
    min-width: 0 !important;
    font-size: 15px !important;
    font-weight: 600 !important;
    color: #145C3D !important;
    text-decoration: none !important;
    margin-top: auto !important;
    align-self: flex-start !important;
  }

  .he-benefits .he-benefit-list article a:hover {
    color: #0B3828 !important;
  }

  @media (max-width: 1024px) {
    .he-benefits .he-benefit-list {
      grid-template-columns: repeat(2, minmax(280px, 1fr)) !important;
    }
  }

  @media (max-width: 768px) {
    .he-benefits .he-benefit-list {
      grid-template-columns: 1fr !important;
    }
    .he-benefits .he-benefit-list article {
      height: auto !important;
      min-height: auto !important;
    }
  }

  /* Why Choose HassanEngine section layout */
  .he-why-layout {
    display: grid !important;
    grid-template-columns: 40% 60% !important;
    gap: 40px !important;
    align-items: start !important;
    width: 100% !important;
    padding-top: 20px !important;
  }

  .he-why-intro p {
    font-size: 16px !important;
    color: #334155 !important;
    line-height: 1.7 !important;
    margin: 16px 0 0 0 !important;
    max-width: 100% !important;
  }

  .he-why-cards {
    display: grid !important;
    grid-template-columns: repeat(2, 1fr) !important;
    gap: 20px !important;
  }

  .he-why-card {
    background: #fff !important;
    border: 1px solid #e7ece8 !important;
    border-radius: 16px !important;
    padding: 30px !important;
    display: flex !important;
    flex-direction: column !important;
    height: 100% !important;
    transition: border-color 0.2s ease, box-shadow 0.2s ease !important;
  }

  .he-why-card:hover {
    border-color: #38A169 !important;
    box-shadow: 0 6px 18px -6px rgba(0, 0, 0, 0.08) !important;
  }

  .he-why-card h3 {
    font-size: 21px !important;
    font-weight: 600 !important;
    color: #145C3D !important;
    margin: 0 0 10px 0 !important;
    line-height: 1.3 !important;
  }

  .he-why-card p {
    font-size: 16px !important;
    font-weight: 400 !important;
    color: #334155 !important;
    line-height: 1.6 !important;
    margin: 0 !important;
  }

  @media (max-width: 1024px) {
    .he-why-layout {
      grid-template-columns: 45% 55% !important;
      gap: 30px !important;
    }
  }

  @media (max-width: 768px) {
    .he-why-layout {
      grid-template-columns: 1fr !important;
      gap: 24px !important;
    }
    .he-why-cards {
      grid-template-columns: 1fr !important;
    }
  }
  .he-image-statement_copy.he-seo-split > .he-seo-text {
    grid-column: 1 !important;
    max-width: none !important;
    margin-top: 40px !important;
  }
  .he-image-statement_copy.he-seo-split > .he-seo-text p {
    margin-top: 16px !important;
    margin-bottom: 0 !important;
  }
  .he-image-statement_copy.he-seo-split > .he-category-grid {
    grid-column: 2 !important;
    max-width: none !important;
    grid-template-columns: repeat(2, 1fr) !important;
    gap: 20px !important;
    justify-self: end !important;
    margin-top: 0 !important;
  }
  .he-image-statement_copy.he-seo-split .he-category-card {
    border: 1px solid rgba(255, 255, 255, 0.35);
    border-radius: 8px;
    padding: 20px;
    background: rgba(255, 255, 255, 0.92);
    color: #0f172a;
    transition: transform 0.2s ease, border-color 0.2s ease, box-shadow 0.2s ease;
    height: 100%;
    display: flex;
    flex-direction: column;
  }
  .he-image-statement_copy.he-seo-split .he-category-card:hover {
    transform: translateY(-3px);
    border-color: #38A169;
    box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
  }
  .he-image-statement_copy.he-seo-split .he-category-card h3 {
    color: #145C3D !important;
    font-size: 17px;
    margin: 0 0 8px 0;
  }
  .he-image-statement_copy.he-seo-split .he-category-card p {
    color: #334155 !important;
    font-size: 14px;
    margin: 0 0 14px 0;
    flex: 1;
  }
  .he-image-statement_copy.he-seo-split .he-category-card a {
    color: #145C3D !important;
    font-size: 13px;
    font-weight: 600;
    text-decoration: none;
    margin-top: auto;
  }
  .he-image-statement_copy.he-seo-split .he-category-card a:hover {
    color: #0B3828 !important;
  }
  .he-image-statement_copy.he-seo-split .he-seo-text h2 {
    margin-top: 0 !important;
  }

  @media (max-width: 1024px) {
    .he-image-statement_copy.he-seo-split {
      grid-template-columns: 1fr !important;
      gap: 30px !important;
      padding-right: 0 !important;
    }
    .he-image-statement_copy.he-seo-split > .he-category-grid {
      grid-template-columns: repeat(2, 1fr) !important;
    }
  }

  @media (max-width: 768px) {
    .he-image-statement_copy.he-seo-split > .he-category-grid {
      grid-template-columns: 1fr !important;
    }
  }
</style>

<main class="he-site-home">
	<section class="he-business-hero" aria-labelledby="home-title">
		<div class="he-business-hero_photo">
			<img src="<?php echo SITE_URL; ?>/assets/images/resource/story-2.optimized.jpg" width="523" height="392" alt="Professionals working together on a business project" fetchpriority="high" decoding="async">
		</div>
		<div class="auto-container he-business-hero_inner">
			<div class="he-business-hero_copy">
				<p class="he-overline">WEB DEVELOPMENT <span aria-hidden="true">&middot;</span> SEO</p>
				<h1 id="home-title">Web Development &amp; SEO That Help Websites <span class="he-h2-accent">Grow</span></h1>
				<p class="he-lead">I build fast, considered websites and practical search strategies for businesses ready to grow their online presence. From WordPress and custom PHP to technical, on-page, and local SEO.</p>
				<div class="he-business-hero_actions">
					<a class="he-pill-button" href="services.php">
						<span>Explore Services</span>
						<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
							<line x1="5" y1="12" x2="19" y2="12"></line>
							<polyline points="12 5 19 12 12 19"></polyline>
						</svg>
					</a>
					<a class="he-text-button" href="blog.php">Explore Blog <span aria-hidden="true">&#8594;</span></a>
				</div>
				<div class="he-hero-tags" aria-label="Services">
					<span>WordPress</span>
					<span>PHP</span>
					<span>React &amp; Next.js</span>
					<span>Technical SEO</span>
				</div>
			</div>
		</div>
	</section>

	<section class="he-about-intro" aria-labelledby="intro-title">
		<div class="auto-container he-about-intro_grid">
			<div class="he-about-photo">
				<img src="<?php echo SITE_URL; ?>/assets/images/resource/story-3.optimized.jpg" width="294" height="392" alt="Professional planning a project" loading="lazy" decoding="async">
				<span>Web development<br>with search in mind</span>
			</div>
			<div class="he-about-copy">
				<p class="he-overline">A PRACTICAL APPROACH</p>
				<h2 id="intro-title">Good websites bring <span class="he-h2-accent">clarity to your</span> business.</h2>
				<p>HassanEngine is a web development and SEO platform that helps businesses build fast, search-friendly websites. I combine development expertise with practical SEO strategy so your site is clear to use, technically sound, and structured to help people find you.</p>
				<p>From WordPress builds to custom PHP, React, and Next.js projects, every site starts with your goals and your audience's needs.</p>
				<a class="he-green-link" href="about.php">More about my approach <span aria-hidden="true">&#8594;</span></a>
				<div class="he-capability-note">
					<strong>Development + SEO</strong>
					<span>One thoughtful foundation for your website.</span>
				</div>
			</div>
		</div>
	</section>

	<?php include __DIR__ . '/components/technology-slider.php'; ?>

	<section class="he-service-catalog" id="home-services" aria-labelledby="home-services-title">
		<div class="auto-container">
			<div class="he-catalog-heading">
				<div>
					<p class="he-overline">SERVICES OVERVIEW</p>
					<h2 id="home-services-title">Development and <span class="he-h2-accent">SEO services</span> for your business.</h2>
				</div>
				<p>Choose the development or search support that fits your next step. Each service can stand alone or work as part of a broader website plan.</p>
			</div>
			<div class="he-catalog-grid">
				<article class="he-catalog-card">
					<span class="he-catalog_icon fa fa-code" aria-hidden="true"></span>
					<p class="he-card-step">01 / BUILD</p>
					<h3>Website Development</h3>
					<p>Custom websites with PHP, HTML, CSS, Bootstrap, Tailwind CSS, React, and Next.js.</p>
					<a href="services.php?service=website-development">Explore service <span aria-hidden="true">&#8594;</span></a>
				</article>
				<article class="he-catalog-card">
					<span class="he-catalog_icon fa fa-wordpress" aria-hidden="true"></span>
					<p class="he-card-step">02 / BUILD</p>
					<h3>WordPress Development</h3>
					<p>Flexible, manageable WordPress websites designed around your services and customers.</p>
					<a href="services.php?service=wordpress-development">Explore service <span aria-hidden="true">&#8594;</span></a>
				</article>
				<article class="he-catalog-card">
					<span class="he-catalog_icon fa fa-terminal" aria-hidden="true"></span>
					<p class="he-card-step">03 / ENGINEER</p>
					<h3>PHP Development</h3>
					<p>Custom PHP development for dynamic, server-side web applications.</p>
					<a href="services.php?service=php-development">Explore service <span aria-hidden="true">&#8594;</span></a>
				</article>
				<article class="he-catalog-card">
					<span class="he-catalog_icon fa fa-tachometer" aria-hidden="true"></span>
					<p class="he-card-step">04 / TECHNICAL</p>
					<h3>Technical SEO</h3>
					<p>Review crawlability, indexability, site structure, page speed, and structured data.</p>
					<a href="services.php?service=technical-seo">Explore service <span aria-hidden="true">&#8594;</span></a>
				</article>
				<article class="he-catalog-card">
					<span class="he-catalog_icon fa fa-file-text-o" aria-hidden="true"></span>
					<p class="he-card-step">05 / ON-PAGE</p>
					<h3>On-Page SEO</h3>
					<p>Align page titles, descriptions, headings, and internal links with search intent.</p>
					<a href="services.php?service=on-page-seo">Explore service <span aria-hidden="true">&#8594;</span></a>
				</article>
				<article class="he-catalog-card">
					<span class="he-catalog_icon fa fa-map-marker" aria-hidden="true"></span>
					<p class="he-card-step">06 / LOCAL</p>
					<h3>Off-Page SEO</h3>
					<p>Build relevant off-page visibility and sound search practices for long-term results.</p>
					<a href="services.php?service=off-page-seo">Explore service <span aria-hidden="true">&#8594;</span></a>
				</article>
				<article class="he-catalog-card">
					<span class="he-catalog_icon fa fa-share-alt" aria-hidden="true"></span>
					<p class="he-card-step">07 / OPTIMIZE</p>
					<h3>Website Speed Optimization</h3>
					<p>Improve page load performance, Core Web Vitals, and overall site responsiveness.</p>
					<a href="services.php?service=website-speed-optimization">Explore service <span aria-hidden="true">&#8594;</span></a>
				</article>
			</div>
		</div>
	</section>

	<section class="he-image-statement" aria-labelledby="web-dev-categories-title">
		<img src="<?php echo SITE_URL; ?>/assets/images/resource/contact.optimized.jpg" width="564" height="423" alt="Business professionals reviewing information together" loading="lazy" decoding="async">
		<div class="he-image-statement_overlay"></div>
		<div class="auto-container">
			<div class="he-image-statement_copy">
				<p class="he-overline">WEB DEVELOPMENT CATEGORIES</p>
				<h2 id="web-dev-categories-title">Explore <span class="he-h2-accent">development</span> topics.</h2>
				<p>Practical guides and tutorials across the full web development stack.</p>
				<div class="he-category-grid">
					<article class="he-category-card">
						<h3>PHP Development</h3>
						<p>Server-side development with PHP for dynamic web applications.</p>
						<a class="he-green-link" href="web-development.php?section=php">Learn more <span aria-hidden="true">&#8594;</span></a>
					</article>
					<article class="he-category-card">
						<h3>WordPress Development</h3>
						<p>Flexible WordPress websites built around your business needs.</p>
						<a class="he-green-link" href="web-development.php?section=wordpress">Learn more <span aria-hidden="true">&#8594;</span></a>
					</article>
					<article class="he-category-card">
						<h3>Frontend Development</h3>
						<p>HTML, CSS, Bootstrap, Tailwind CSS, React, and Next.js for responsive interfaces.</p>
						<a class="he-green-link" href="web-development.php?section=frontend">Learn more <span aria-hidden="true">&#8594;</span></a>
					</article>
					<article class="he-category-card">
						<h3>Responsive Design</h3>
						<p>Websites that adapt cleanly to every screen size without sacrificing performance.</p>
						<a class="he-green-link" href="web-development.php?section=responsive-design">Learn more <span aria-hidden="true">&#8594;</span></a>
					</article>
					<article class="he-category-card">
						<h3>Website Security</h3>
						<p>Protect your website from common threats with hardening and best practices.</p>
						<a class="he-green-link" href="web-development.php?section=website-security">Learn more <span aria-hidden="true">&#8594;</span></a>
					</article>
					<article class="he-category-card">
						<h3>Website Performance</h3>
						<p>Optimize load speed, Core Web Vitals, and overall responsiveness.</p>
						<a class="he-green-link" href="web-development.php?section=performance">Learn more <span aria-hidden="true">&#8594;</span></a>
					</article>
				</div>
			</div>
		</div>
	</section>

	<?php include __DIR__ . '/components/technology-slider.php'; ?>

	<section class="he-image-statement" aria-labelledby="seo-categories-title" style="margin-top: 0;">
		<img src="<?php echo SITE_URL; ?>/assets/images/resource/story-2.optimized.jpg" width="523" height="392" alt="SEO strategy and planning" loading="lazy" decoding="async">
		<div class="he-image-statement_overlay"></div>
		<div class="auto-container">
			<div class="he-image-statement_copy he-seo-split">
				<div class="he-seo-text">
					<p class="he-overline">SEO CATEGORIES</p>
					<h2 id="seo-categories-title">Master <span class="he-h2-accent">search</span> optimization.</h2>
					<p>From technical foundations to content strategy, learn SEO that works.</p>
				</div>
				<div class="he-category-grid">
					<article class="he-category-card">
						<h3>Technical SEO</h3>
						<p>Crawlability, indexability, site structure, and page speed.</p>
						<a class="he-green-link" href="seo.php?section=technical-seo">Learn more <span aria-hidden="true">&#8594;</span></a>
					</article>
					<article class="he-category-card">
						<h3>On-Page SEO</h3>
						<p>Titles, descriptions, headings, and content aligned with search intent.</p>
						<a class="he-green-link" href="seo.php?section=on-page-seo">Learn more <span aria-hidden="true">&#8594;</span></a>
					</article>
					<article class="he-category-card">
						<h3>Off-Page SEO</h3>
						<p>Relevant visibility, references, and trust signals for your website.</p>
						<a class="he-green-link" href="seo.php?section=off-page-seo">Learn more <span aria-hidden="true">&#8594;</span></a>
					</article>
					<article class="he-category-card">
						<h3>Local SEO</h3>
						<p>Help nearby customers find your business through local search.</p>
						<a class="he-green-link" href="seo.php?section=local-seo">Learn more <span aria-hidden="true">&#8594;</span></a>
					</article>
					<article class="he-category-card">
						<h3>Keyword Research</h3>
						<p>Find the search terms your audience uses to discover services like yours.</p>
						<a class="he-green-link" href="seo.php?section=keyword-research">Learn more <span aria-hidden="true">&#8594;</span></a>
					</article>
					<article class="he-category-card">
						<h3>Content Optimization</h3>
						<p>Create content that ranks and converts with clear structure and purpose.</p>
						<a class="he-green-link" href="seo.php?section=content-seo">Learn more <span aria-hidden="true">&#8594;</span></a>
					</article>
				</div>
			</div>
		</div>
	</section>

	<?php include __DIR__ . '/components/technology-slider.php'; ?>

	<section class="he-journal-preview" aria-labelledby="journal-title">
		<div class="auto-container">
			<div class="he-catalog-heading">
				<div>
					<p class="he-overline">FROM THE JOURNAL</p>
					<h2 id="journal-title">Featured <span class="he-h2-accent">articles</span> and tutorials.</h2>
				</div>
				<a class="he-green-link" href="blog.php">Read all articles <span aria-hidden="true">&#8594;</span></a>
			</div>
			<div class="he-journal-grid">
				<?php foreach ($homePosts as $post): ?>
					<article>
						<a class="he-journal-image" href="<?php echo htmlspecialchars(post_url($post), ENT_QUOTES, 'UTF-8'); ?>">
							<img src="<?php echo SITE_URL; ?>/<?php echo htmlspecialchars($post['image'], ENT_QUOTES, 'UTF-8'); ?>" width="480" height="360" alt="<?php echo htmlspecialchars($post['title'], ENT_QUOTES, 'UTF-8'); ?>" loading="lazy" decoding="async">
							<span><?php echo htmlspecialchars($post['category'], ENT_QUOTES, 'UTF-8'); ?></span>
						</a>
						<div class="he-journal-content">
							<p class="he-journal-meta"><?php echo htmlspecialchars($post['read'], ENT_QUOTES, 'UTF-8'); ?></p>
							<h3><a href="<?php echo htmlspecialchars(post_url($post), ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars($post['title'], ENT_QUOTES, 'UTF-8'); ?></a></h3>
							<p><?php echo htmlspecialchars($post['excerpt'], ENT_QUOTES, 'UTF-8'); ?></p>
							<a class="he-green-link" href="<?php echo htmlspecialchars(post_url($post), ENT_QUOTES, 'UTF-8'); ?>">Read article <span aria-hidden="true">&#8594;</span></a>
						</div>
					</article>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<?php include __DIR__ . '/components/technology-slider.php'; ?>

	<section class="he-about-intro" aria-labelledby="why-title" style="background: #F6F8F6;">
		<div class="auto-container he-why-layout">
			<div class="he-why-intro">
				<p class="he-overline">WHY CHOOSE HASSANENGINE</p>
				<h2 id="why-title">Practical <span class="he-h2-accent">guidance you can</span> use.</h2>
				<p>Step-by-step tutorials, clear explanations, and current practices you can apply immediately to your own projects.</p>
			</div>
			<div class="he-why-cards">
				<article class="he-why-card">
					<h3>Practical tutorials</h3>
					<p>Step-by-step guides with real examples you can apply immediately.</p>
				</article>
				<article class="he-why-card">
					<h3>Easy-to-understand guides</h3>
					<p>Complex development and SEO concepts explained in clear, accessible language.</p>
				</article>
				<article class="he-why-card">
					<h3>Updated knowledge</h3>
					<p>Current development practices and SEO strategies that reflect today's web.</p>
				</article>
				<article class="he-why-card">
					<h3>Actionable SEO strategies</h3>
					<p>Technical, on-page, and local SEO tactics that deliver measurable results.</p>
				</article>
			</div>
		</div>
	</section>

	<section class="he-benefits" aria-labelledby="resources-title">
		<div class="auto-container he-benefits_grid">
			<div class="he-benefits_intro">
				<p class="he-overline">LATEST RESOURCES</p>
				<h2 id="resources-title">Useful <span class="he-h2-accent">tools and</span> guides.</h2>
				<p>Practical resources for developers, SEO practitioners, and website owners.</p>
				<a class="he-green-link" href="resources.php">Browse all resources <span aria-hidden="true">&#8594;</span></a>
			</div>
			<div class="he-benefit-list">
				<article class="he-resource-card">
					<h3>SEO Checklists</h3>
					<p>Technical, on-page, and off-page SEO checklists for auditing your site.</p>
					<a class="he-green-link" href="resources.php?type=seo-checklists">View <span aria-hidden="true">&#8594;</span></a>
				</article>
				<article class="he-resource-card">
					<h3>Web Development Guides</h3>
					<p>Comprehensive guides for building modern, responsive websites.</p>
					<a class="he-green-link" href="resources.php?type=web-development-guides">View <span aria-hidden="true">&#8594;</span></a>
				</article>
				<article class="he-resource-card">
					<h3>WordPress Resources</h3>
					<p>Theme development, plugin best practices, and WordPress optimization.</p>
					<a class="he-green-link" href="resources.php?type=wordpress-resources">View <span aria-hidden="true">&#8594;</span></a>
				</article>
				<article class="he-resource-card">
					<h3>PHP Code Examples</h3>
					<p>Practical PHP snippets and patterns for common development tasks.</p>
					<a class="he-green-link" href="resources.php?type=php-code-examples">View <span aria-hidden="true">&#8594;</span></a>
				</article>
			</div>
		</div>
	</section>

	<?php include __DIR__ . '/components/technology-slider.php'; ?>

	<section class="he-contact-ribbon" aria-labelledby="ribbon-title">
		<div class="auto-container he-contact-ribbon_inner">
			<div>
				<p class="he-overline">HAVE A PROJECT IN MIND?</p>
				<h2 id="ribbon-title">Let's make your <span class="he-h2-accent">next website</span> move count.</h2>
				<p>Tell me what you're building and where you want to improve.</p>
				<a class="he-ribbon-link" href="contact.php">Talk about your project <span aria-hidden="true">&#8594;</span></a>
			</div>
			<img src="<?php echo SITE_URL; ?>/assets/images/resource/story-2.optimized.jpg" width="523" height="392" alt="Business professionals collaborating" loading="lazy" decoding="async">
		</div>
	</section>

	<section class="he-final-cta" aria-labelledby="final-cta-title">
		<div class="auto-container">
			<p class="he-overline">YOUR NEXT STEP STARTS HERE</p>
			<h2 id="final-cta-title">Ready to <span class="he-h2-accent">improve your</span> website?</h2>
			<p>Share your goals and I'll help you identify a practical place to begin.</p>
			<a class="he-pill-button" href="contact.php">
				<span>Contact me</span>
				<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
					<line x1="5" y1="12" x2="19" y2="12"></line>
					<polyline points="12 5 19 12 12 19"></polyline>
				</svg>
			</a>
		</div>
	</section>

	<?php include __DIR__ . '/components/technology-slider.php'; ?>
</main>
<?php require __DIR__ . '/page-footer.php'; ?>
