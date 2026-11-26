<?php
/**
 * Blog content.
 *
 * All article, author and topic data lives here so the site can be re-populated
 * without touching page templates.
 */

/**
 * Articles. Fields:
 *   slug, title, excerpt, category, author, date, read, image, featured, tags
 */
$posts = array(
    array(
        'slug'     => 'wordpress-theme-development-best-practices',
        'title'    => 'WordPress Theme Development Best Practices',
        'excerpt'  => 'How to build clean, maintainable WordPress themes using template hierarchy, child themes, and the block editor without bloating the frontend.',
        'category' => 'WordPress',
        'author'   => 'Hassan Raza',
        'date'     => '2026-10-15',
        'read'     => '10 min read',
        'image'    => 'assets/images/hero/code.svg',
        'featured' => true,
        'tags'     => array('WordPress', 'Theme Development', 'PHP'),
    ),
    array(
        'slug'     => 'technical-seo-audit-checklist-2026',
        'title'    => 'Technical SEO Audit Checklist for 2026',
        'excerpt'  => 'Crawlability, indexability, page speed, structured data, and Core Web Vitals: a practical checklist for auditing any website.',
        'category' => 'SEO',
        'author'   => 'Ayesha Khan',
        'date'     => '2026-10-08',
        'read'     => '12 min read',
        'image'    => 'assets/images/hero/database.svg',
        'featured' => true,
        'tags'     => array('Technical SEO', 'Audit', 'Core Web Vitals'),
    ),
    array(
        'slug'     => 'custom-wordpress-plugin-development',
        'title'    => 'Custom WordPress Plugin Development',
        'excerpt'  => 'Extending WordPress safely with custom plugins: hooks, admin settings, database tables, and security best practices.',
        'category' => 'WordPress',
        'author'   => 'Bilal Ahmed',
        'date'     => '2026-09-28',
        'read'     => '11 min read',
        'image'    => 'assets/images/hero/code.svg',
        'featured' => true,
        'tags'     => array('WordPress', 'Plugins', 'Security'),
    ),
    array(
        'slug'     => 'on-page-seo-content-optimization',
        'title'    => 'On-Page SEO Content Optimization',
        'excerpt'  => 'Aligning page titles, headings, metadata, and internal links with search intent so your content ranks and converts.',
        'category' => 'SEO',
        'author'   => 'Hassan Raza',
        'date'     => '2026-09-20',
        'read'     => '9 min read',
        'image'    => 'assets/images/hero/architecture.svg',
        'featured' => false,
        'tags'     => array('On-Page SEO', 'Content', 'Metadata'),
    ),
    array(
        'slug'     => 'wordpress-performance-optimization',
        'title'    => 'WordPress Performance Optimization',
        'excerpt'  => 'Speeding up WordPress sites with caching, image optimization, database cleanup, and lightweight theme choices.',
        'category' => 'WordPress',
        'author'   => 'Ayesha Khan',
        'date'     => '2026-09-12',
        'read'     => '10 min read',
        'image'    => 'assets/images/hero/pipeline.svg',
        'featured' => false,
        'tags'     => array('WordPress', 'Performance', 'Speed'),
    ),
    array(
        'slug'     => 'local-seo-for-small-business',
        'title'    => 'Local SEO for Small Business Websites',
        'excerpt'  => 'Google Business Profile, local citations, location pages, and review strategies that help nearby customers find you.',
        'category' => 'SEO',
        'author'   => 'Bilal Ahmed',
        'date'     => '2026-09-04',
        'read'     => '10 min read',
        'image'    => 'assets/images/hero/database.svg',
        'featured' => false,
        'tags'     => array('Local SEO', 'Small Business', 'Citations'),
    ),
    array(
        'slug'     => 'semantic-html-for-better-seo',
        'title'    => 'Semantic HTML for Better SEO',
        'excerpt'  => 'Using landmark elements, headings, and structured markup so search engines and assistive technology understand your pages.',
        'category' => 'Web Development',
        'author'   => 'Hassan Raza',
        'date'     => '2026-08-27',
        'read'     => '8 min read',
        'image'    => 'assets/images/hero/code.svg',
        'featured' => false,
        'tags'     => array('Semantic HTML', 'SEO', 'Accessibility'),
    ),
    array(
        'slug'     => 'wordpress-security-hardening',
        'title'    => 'WordPress Security Hardening',
        'excerpt'  => 'Protecting WordPress sites from common attacks: login hardening, file permissions, updates, and malware scanning.',
        'category' => 'WordPress',
        'author'   => 'Bilal Ahmed',
        'date'     => '2026-08-19',
        'read'     => '9 min read',
        'image'    => 'assets/images/hero/security.svg',
        'featured' => false,
        'tags'     => array('WordPress', 'Security', 'Hardening'),
    ),
    array(
        'slug'     => 'seo-friendly-url-structure',
        'title'    => 'SEO-Friendly URL Structure',
        'excerpt'  => 'Designing readable, keyword-rich URLs with proper canonical tags, redirects, and parameter handling.',
        'category' => 'SEO',
        'author'   => 'Ayesha Khan',
        'date'     => '2026-08-11',
        'read'     => '7 min read',
        'image'    => 'assets/images/hero/architecture.svg',
        'featured' => false,
        'tags'     => array('URL Structure', 'Canonical', 'Redirects'),
    ),
    array(
        'slug'     => 'responsive-web-design-wordpress',
        'title'    => 'Responsive Web Design in WordPress',
        'excerpt'  => 'Building mobile-first WordPress themes that adapt cleanly to every screen size without sacrificing performance.',
        'category' => 'Web Development',
        'author'   => 'Hassan Raza',
        'date'     => '2026-08-03',
        'read'     => '9 min read',
        'image'    => 'assets/images/hero/code.svg',
        'featured' => false,
        'tags'     => array('Responsive Design', 'WordPress', 'CSS'),
    ),
    array(
        'slug'     => 'core-web-vitals-wordpress',
        'title'    => 'Core Web Vitals for WordPress',
        'excerpt'  => 'Improving Largest Contentful Paint, Interaction to Next Paint, and Cumulative Layout Shift on WordPress sites.',
        'category' => 'SEO',
        'author'   => 'Ayesha Khan',
        'date'     => '2026-07-26',
        'read'     => '11 min read',
        'image'    => 'assets/images/hero/pipeline.svg',
        'featured' => false,
        'tags'     => array('Core Web Vitals', 'WordPress', 'Performance'),
    ),
    array(
        'slug'     => 'wordpress-block-theme-development',
        'title'    => 'WordPress Block Theme Development',
        'excerpt'  => 'Moving to block-based themes with theme.json, block patterns, and the site editor for modern WordPress development.',
        'category' => 'WordPress',
        'author'   => 'Hassan Raza',
        'date'     => '2026-07-18',
        'read'     => '10 min read',
        'image'    => 'assets/images/hero/code.svg',
        'featured' => false,
        'tags'     => array('WordPress', 'Block Themes', 'Full Site Editing'),
    ),
    array(
        'slug'     => 'my-first-blog-post',
        'title'    => 'My First Blog Post',
        'excerpt'  => 'A short summary of what this article is about.',
        'category' => 'Web Development',
        'author'   => 'Hassan Raza',
        'date'     => '2026-11-20',
        'read'     => '8 min read',
        'image'    => 'assets/images/hero/code.svg',
        'featured' => false,
        'tags'     => array('Web Development', 'Tutorial'),
        'body'     => array(
            'First paragraph of your article goes here.',
            'Second paragraph with more details.',
        ),
    ),
);

/** Canonical article URL used by listings, related links, and the sitemap. */
function post_url($post)
{
    return 'blog-detail?slug=' . rawurlencode($post['slug']);
}

/** Stable project path used by project cards, canonical tags and the sitemap. */
function project_slug($project)
{
    return trim(strtolower(preg_replace('/[^a-z0-9]+/i', '-', (string) $project['title'])), '-');
}

function project_url($project)
{
    return 'property-detail?project=' . rawurlencode(project_slug($project));
}

/** Topic archive shown in blog sidebars. */
$categories = array(
    array('name' => 'Architecture', 'count' => 3, 'file' => 'blog.php'),
    array('name' => 'Databases',    'count' => 2, 'file' => 'blog.php'),
    array('name' => 'Frontend',     'count' => 1, 'file' => 'blog.php'),
    array('name' => 'DevOps',       'count' => 2, 'file' => 'blog.php'),
    array('name' => 'Security',     'count' => 1, 'file' => 'blog.php'),
    array('name' => 'Testing',      'count' => 1,  'file' => 'blog.php'),
    array('name' => 'Career',       'count' => 1,  'file' => 'blog.php'),
    array('name' => 'Programming',  'count' => 1,  'file' => 'blog.php'),
);

/** Contributors. */
$team = array(
    array(
        'name'     => 'Hassan Raza',
        'role'     => 'Founder & Backend Engineer',
        'image'    => 'assets/images/resource/author-1.jpg',
        'bio'      => 'Writes about APIs, data models and the parts of backend work that only show up under load.',
        'email'    => CONTACT_EMAIL,
        'location' => 'Remote',
    ),
    array(
        'name'     => 'Ayesha Khan',
        'role'     => 'Database & Reliability Engineer',
        'image'    => 'assets/images/resource/author-2.optimized.jpg',
        'bio'      => 'Covers Postgres, migrations and the observability practices that make outages diagnosable.',
        'email'    => CONTACT_EMAIL,
        'location' => 'Remote',
    ),
    array(
        'name'     => 'Bilal Ahmed',
        'role'     => 'Platform & Security Engineer',
        'image'    => 'assets/images/resource/author-3.jpg',
        'bio'      => 'Writes about authentication, pipelines and the security decisions that survive a code review.',
        'email'    => CONTACT_EMAIL,
        'location' => 'Remote',
    ),
);

/** Services / topic areas offered as articles. */
$services = array(
    array(
        'slug'     => 'website-development',
        'title'    => 'Website Development',
        'category' => 'Frontend',
        'text'     => 'Custom websites with PHP, HTML, CSS, Bootstrap, Tailwind CSS, React, and Next.js. Responsive, fast, and built around your audience.',
        'image'    => 'assets/images/hero/code.svg',
        'icon'     => 'flaticon-settings',
    ),
    array(
        'slug'     => 'wordpress-development',
        'title'    => 'WordPress Development',
        'category' => 'Frontend',
        'text'     => 'Flexible, manageable WordPress websites designed around your services and customers. Child themes, block themes, and custom plugins.',
        'image'    => 'assets/images/hero/code.svg',
        'icon'     => 'flaticon-settings',
    ),
    array(
        'slug'     => 'php-development',
        'title'    => 'PHP Development',
        'category' => 'Frontend',
        'text'     => 'Custom PHP development for dynamic, server-side web applications. Clean code, database integration, and secure architecture.',
        'image'    => 'assets/images/hero/code.svg',
        'icon'     => 'flaticon-cog',
    ),
    array(
        'slug'     => 'seo',
        'title'    => 'Search Engine Optimization',
        'category' => 'SEO',
        'text'     => 'Complete SEO support from technical foundations to content strategy. Help your website rank and convert.',
        'image'    => 'assets/images/hero/architecture.svg',
        'icon'     => 'flaticon-idea',
    ),
    array(
        'slug'     => 'technical-seo',
        'title'    => 'Technical SEO',
        'category' => 'SEO',
        'text'     => 'Review crawlability, indexability, site structure, page speed, canonical URLs, and structured data.',
        'image'    => 'assets/images/hero/pipeline.svg',
        'icon'     => 'flaticon-database',
    ),
    array(
        'slug'     => 'on-page-seo',
        'title'    => 'On-Page SEO',
        'category' => 'SEO',
        'text'     => 'Align page titles, descriptions, headings, internal links, and content with search intent.',
        'image'    => 'assets/images/hero/code.svg',
        'icon'     => 'flaticon-settings',
    ),
    array(
        'slug'     => 'off-page-seo',
        'title'    => 'Off-Page SEO',
        'category' => 'SEO',
        'text'     => 'Build relevant off-page visibility, sound search practices, and trust signals for long-term results.',
        'image'    => 'assets/images/hero/pipeline.svg',
        'icon'     => 'flaticon-cog',
    ),
    array(
        'slug'     => 'website-speed-optimization',
        'title'    => 'Website Speed Optimization',
        'category' => 'Performance',
        'text'     => 'Improve page load performance, Core Web Vitals, and overall site responsiveness.',
        'image'    => 'assets/images/hero/pipeline.svg',
        'icon'     => 'flaticon-settings',
    ),
);

/** Canonical service URL used by listings and detail links. */
function service_url($service)
{
    return 'service-detail?slug=' . rawurlencode((string) $service['slug']);
}

/**
 * Projects showcased on the project pages. Fields:
 *   title, stack, text, image, badge, status, updated, articles
 */
$projects = array(
    array(
        'title'    => 'Query Planner',
        'stack'    => 'PHP, PostgreSQL, Redis',
        'text'     => 'A tool that captures slow queries from production traffic and explains which index or rewrite would remove the cost.',
        'image'    => 'assets/images/hero/database.svg',
        'badge'    => 'Featured',
        'status'   => 'In production',
        'updated'  => 'Sep 2026',
        'articles' => 9,
        'tags'     => array('Performance', 'Databases', 'Tooling'),
        'featured' => true,
    ),
    array(
        'title'    => 'Deploy Ledger',
        'stack'    => 'Python, Docker, PostgreSQL',
        'text'     => 'Tracks every deployment across services with a searchable history, rollback targets and an approval trail.',
        'image'    => 'assets/images/hero/pipeline.svg',
        'badge'    => 'Featured',
        'status'   => 'In production',
        'updated'  => 'Aug 2026',
        'articles' => 7,
        'tags'     => array('DevOps', 'Deployments', 'Docker'),
        'featured' => true,
    ),
    array(
        'title'    => 'Schema Diff',
        'stack'    => 'TypeScript, PostgreSQL',
        'text'     => 'Compares two database schemas and generates reviewable migrations, flagging destructive changes before they run.',
        'image'    => 'assets/images/hero/database.svg',
        'badge'    => 'Featured',
        'status'   => 'In production',
        'updated'  => 'Jul 2026',
        'articles' => 6,
        'tags'     => array('Migrations', 'Postgres', 'Review'),
        'featured' => true,
    ),
    array(
        'title'    => 'Trace Viewer',
        'stack'    => 'Go, OpenTelemetry',
        'text'     => 'Ingests distributed traces and renders slow request paths across services with per-span timing.',
        'image'    => 'assets/images/hero/projects.svg',
        'badge'    => '',
        'status'   => 'Active build',
        'updated'  => 'Jul 2026',
        'articles' => 4,
        'tags'     => array('Tracing', 'OpenTelemetry', 'Go'),
        'featured' => false,
    ),
    array(
        'title'    => 'Fixture Kit',
        'stack'    => 'PHP, PHPUnit',
        'text'     => 'Generates deterministic test fixtures from a schema so integration tests stop depending on shared state.',
        'image'    => 'assets/images/hero/code.svg',
        'badge'    => '',
        'status'   => 'Active build',
        'updated'  => 'Jun 2026',
        'articles' => 5,
        'tags'     => array('Testing', 'Fixtures', 'PHPUnit'),
        'featured' => false,
    ),
    array(
        'title'    => 'Budget Guard',
        'stack'    => 'Python, Prometheus',
        'text'     => 'Watches infrastructure cost metrics and raises an alert when a service drifts above its monthly budget.',
        'image'    => 'assets/images/hero/pipeline.svg',
        'badge'    => '',
        'status'   => 'Archived',
        'updated'  => 'May 2026',
        'articles' => 3,
        'tags'     => array('Cost', 'Prometheus', 'Alerting'),
        'featured' => false,
    ),
);

/**
 * Topics shown in the "Explore Topics" band. Fields: name, articles, text, image
 */
$topics = array(
    array(
        'name'     => 'Architecture',
        'articles' => 3,
        'text'     => 'Service boundaries, data flow, caching and the failure modes nobody writes down until they page you.',
        'image'    => 'assets/images/hero/architecture.svg',
        'file'     => 'blog.php',
    ),
    array(
        'name'     => 'Databases',
        'articles' => 2,
        'text'     => 'Schema design, indexing, migrations and query plans read straight from production incidents.',
        'image'    => 'assets/images/hero/database.svg',
        'file'     => 'blog.php',
    ),
    array(
        'name'     => 'DevOps',
        'articles' => 2,
        'text'     => 'Pipelines, deployment strategy, observability and incident response for small platform teams.',
        'image'    => 'assets/images/hero/pipeline.svg',
        'file'     => 'blog.php',
    ),
    array(
        'name'     => 'Security',
        'articles' => 1,
        'text'     => 'Authentication, session handling, secret storage and the review comments that keep you up at night.',
        'image'    => 'assets/images/hero/security.svg',
        'file'     => 'blog.php',
    ),
);

/** Reader testimonials. Fields: text, name, role, image */
$testimonials = array(
    array(
        'text'  => 'The database articles paid for the subscription on the first afternoon. Every index decision in our codebase came straight from one of the write-ups.',
        'name'  => 'Imran Sheikh',
        'role'  => 'Backend Engineer',
        'image' => 'assets/images/resource/author-1.jpg',
    ),
    array(
        'text'  => 'What sets it apart is the honesty. Trade-offs are named, failed approaches are published, and nothing is presented as a silver bullet.',
        'name'  => 'Sana Iqbal',
        'role'  => 'Platform Lead',
        'image' => 'assets/images/resource/author-2.optimized.jpg',
    ),
    array(
        'text'  => 'I used the migration write-ups to plan our zero-downtime cutover. The expand-contract breakdown is the clearest explanation I have read anywhere.',
        'name'  => 'Omar Farooq',
        'role'  => 'Engineering Manager',
        'image' => 'assets/images/resource/author-3.jpg',
    ),
    array(
        'text'  => 'The testing articles changed how our team works. We deleted a third of our suite because the arguments for each test finally made sense.',
        'name'  => 'Hina Kamal',
        'role'  => 'QA & Reliability Engineer',
        'image' => 'assets/images/resource/author-4.png',
    ),
);

/** FAQ entries, also rendered as FAQPage structured data. */
$faqs = array(
      array(
          'q' => 'What does HassanEngine cover?',
          'a' => 'HassanEngine covers software engineering topics such as web development, systems design, databases, DevOps, security, testing and engineering careers. Articles focus on practical explanations, implementation choices and technical trade-offs.',
      ),
      array(
          'q' => 'How often are new articles published on HassanEngine?',
          'a' => 'There is no fixed publishing schedule. Check the article archive for the latest writing; it lists published articles by date.',
      ),
      array(
          'q' => 'Can I republish or quote a HassanEngine article?',
          'a' => 'Articles may be quoted with clear attribution and a link to the original. Full republication requires written permission from the author.',
      ),
      array(
          'q' => 'How do I report an error in an article?',
          'a' => 'Use the contact page and include the article title and the section containing the mistake. Corrections are made as soon as they are confirmed, and the change is noted at the top of the article.',
      ),
      array(
          'q' => 'Does HassanEngine accept guest posts?',
          'a' => 'Guest posts are considered when the topic is genuinely useful and the writing reflects first-hand experience. Send a proposal through the contact page with an outline and your background.',
      ),
      array(
          'q' => 'Is the code in the articles open source?',
          'a' => 'Code samples are provided for reading and experimentation. Where a full project exists it is linked from the relevant article, along with setup instructions.',
      ),
      array(
          'q' => 'How do I subscribe to HassanEngine updates?',
          'a' => 'Use the email form in the footer to subscribe to HassanEngine updates. The site will confirm whether your subscription was saved or emailed.',
      ),
      array(
          'q' => 'What topics are best for beginners on HassanEngine?',
          'a' => 'Start with the web development and systems design series, which explain concepts with diagrams and runnable examples before diving into advanced material.',
      ),
  );
