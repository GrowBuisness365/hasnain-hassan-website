<?php
$pageKey = 'services';
$crumbs = array(array('label' => 'Services'));
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
  .he-page-theme .he-green-link,
  .he-page-theme .he-catalog-card a {
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

  .he-page-theme .he-text-button,
  .he-page-theme .he-green-link,
  .he-page-theme .he-ribbon-link,
  .he-page-theme .he-catalog-card a {
    transition: color 0.25s ease !important;
  }

  .he-page-theme .he-text-button:hover,
  .he-page-theme .he-green-link:hover,
  .he-page-theme .he-ribbon-link:hover,
  .he-page-theme .he-catalog-card a:hover {
    color: #0B3828 !important;
  }

  .he-service-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 24px;
  }

  .he-service-card {
    border: 1px solid #EAF5EF;
    border-radius: 8px;
    padding: 28px;
    background: #ffffff;
    transition: transform 0.2s ease, border-color 0.2s ease;
  }

  .he-service-card:hover {
    transform: translateY(-2px);
    border-color: #145C3D;
  }

  .he-service-card .he-step {
    font-size: 12px;
    font-weight: 600;
    letter-spacing: .12em;
    text-transform: uppercase;
    color: #1C7650 !important;
    margin: 0 0 8px 0;
  }

  .he-service-card h3 {
    font-size: 19px;
    margin: 0 0 10px 0;
    color: #145C3D !important;
  }

  .he-service-card p {
    font-size: 15px;
    color: #0B3828 !important;
    line-height: 1.6;
    margin: 0 0 16px 0;
  }

  .he-service-card a {
    font-size: 14px;
    font-weight: 600;
  }

  .he-process-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 20px;
    margin-top: 24px;
  }

  .he-process-card {
    text-align: center;
    padding: 24px;
    border: 1px solid #EAF5EF;
    border-radius: 8px;
    background: #ffffff;
  }

  .he-process-step {
    font-size: 14px;
    font-weight: 600;
    color: #1C7650 !important;
    margin: 0 0 8px 0;
  }

  .he-process-card h3 {
    font-size: 17px;
    margin: 0 0 8px 0;
    color: #145C3D !important;
  }

  .he-process-card p {
    font-size: 14px;
    color: #6B8E79 !important;
    margin: 0;
  }
</style>

<main class="he-page-theme">
	<section class="he-service-catalog" aria-labelledby="services-title">
		<div class="auto-container">
			<div class="he-catalog-heading">
				<div>
					<p class="he-overline">OUR SERVICES</p>
					<h2 id="services-title">Web development and <span class="he-h2-accent">SEO services</span> for your business.</h2>
				</div>
				<p>Choose the development or search support that fits your next step. Each service can stand alone or work as part of a broader website plan.</p>
			</div>
			<div class="he-service-grid">
				<article class="he-service-card">
					<p class="he-step">01 / WEBSITE DEVELOPMENT</p>
					<h3>Website Development</h3>
					<p>Custom websites with PHP, HTML, CSS, Bootstrap, Tailwind CSS, React, and Next.js. Responsive, fast, and built around your audience.</p>
					<a href="services.php?service=website-development">Learn more <span aria-hidden="true">&#8594;</span></a>
				</article>
				<article class="he-service-card">
					<p class="he-step">02 / WORDPRESS DEVELOPMENT</p>
					<h3>WordPress Development</h3>
					<p>Flexible, manageable WordPress websites designed around your services and customers. Child themes, block themes, and custom plugins.</p>
					<a href="services.php?service=wordpress-development">Learn more <span aria-hidden="true">&#8594;</span></a>
				</article>
				<article class="he-service-card">
					<p class="he-step">03 / PHP DEVELOPMENT</p>
					<h3>PHP Development</h3>
					<p>Custom PHP development for dynamic, server-side web applications. Clean code, database integration, and secure architecture.</p>
					<a href="services.php?service=php-development">Learn more <span aria-hidden="true">&#8594;</span></a>
				</article>
				<article class="he-service-card">
					<p class="he-step">04 / SEARCH ENGINE OPTIMIZATION</p>
					<h3>Search Engine Optimization</h3>
					<p>Complete SEO support from technical foundations to content strategy. Help your website rank and convert.</p>
					<a href="services.php?service=seo">Learn more <span aria-hidden="true">&#8594;</span></a>
				</article>
				<article class="he-service-card">
					<p class="he-step">05 / TECHNICAL SEO</p>
					<h3>Technical SEO</h3>
					<p>Review crawlability, indexability, site structure, page speed, canonical URLs, and structured data.</p>
					<a href="services.php?service=technical-seo">Learn more <span aria-hidden="true">&#8594;</span></a>
				</article>
				<article class="he-service-card">
					<p class="he-step">06 / ON-PAGE SEO</p>
					<h3>On-Page SEO</h3>
					<p>Align page titles, descriptions, headings, internal links, and content with search intent.</p>
					<a href="services.php?service=on-page-seo">Learn more <span aria-hidden="true">&#8594;</span></a>
				</article>
				<article class="he-service-card">
					<p class="he-step">07 / OFF-PAGE SEO</p>
					<h3>Off-Page SEO</h3>
					<p>Build relevant off-page visibility, sound search practices, and trust signals for long-term results.</p>
					<a href="services.php?service=off-page-seo">Learn more <span aria-hidden="true">&#8594;</span></a>
				</article>
				<article class="he-service-card">
					<p class="he-step">08 / WEBSITE SPEED OPTIMIZATION</p>
					<h3>Website Speed Optimization</h3>
					<p>Improve page load performance, Core Web Vitals, and overall site responsiveness.</p>
					<a href="services.php?service=website-speed-optimization">Learn more <span aria-hidden="true">&#8594;</span></a>
				</article>
			</div>
		</div>
	</section>

	<?php include __DIR__ . '/components/technology-slider.php'; ?>

	<section class="he-about-intro">
		<div class="auto-container he-about-intro_grid">
			<div class="he-about-copy">
				<p class="he-overline">HOW SERVICES WORK</p>
				<h2>From first question <span class="he-h2-accent">to a live</span> website.</h2>
				<div class="he-process-grid">
					<article class="he-process-card">
						<p class="he-process-step">Step 1</p>
						<h3>Understand the goal</h3>
						<p>Start with your audience, services, requirements, and what the website needs to do.</p>
					</article>
					<article class="he-process-card">
						<p class="he-process-step">Step 2</p>
						<h3>Plan the structure</h3>
						<p>Map useful pages, clear navigation, semantic headings, and content relationships.</p>
					</article>
					<article class="he-process-card">
						<p class="he-process-step">Step 3</p>
						<h3>Build with care</h3>
						<p>Choose the development approach and tools that fit your project.</p>
					</article>
					<article class="he-process-card">
						<p class="he-process-step">Step 4</p>
						<h3>Review and improve</h3>
						<p>Check technical details and refine the site based on your priorities.</p>
					</article>
				</div>
			</div>
		</div>
	</section>

	<?php include __DIR__ . '/components/technology-slider.php'; ?>

	<section class="he-final-cta">
		<div class="auto-container">
			<p class="he-overline">READY TO START?</p>
			<h2>Tell me <span class="he-h2-accent">what your</span> website needs.</h2>
			<p>We can talk through the goals and find the right development or SEO service.</p>
			<a class="he-pill-button" href="contact.php">
				<span>Contact me</span>
				<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
					<line x1="5" y1="12" x2="19" y2="12"></line>
					<polyline points="12 5 19 12 12 19"></polyline>
				</svg>
			</a>
		</div>
	</section>
</main>
<?php require __DIR__ . '/page-footer.php'; ?>
