<?php
/**
 * HassanEngine - Global site configuration.
 *
 * Every business detail, SEO string and navigation label used across the site
 * is defined here once, so the site can be re-branded by editing this file.
 */

/* ---------------------------------------------------------------- Branding */

define('SITE_NAME', 'HassanEngine');
define('SITE_TAGLINE', 'Web Development & SEO Services');

define('SITE_DESCRIPTION', 'HassanEngine provides custom web development and practical SEO services, including WordPress, PHP, React, Next.js, technical SEO, local SEO and on-page optimization.');

if (getenv('VERCEL')) {
    define('SITE_URL', 'https://hasnain-hassan.vercel.app');
} else {
    define('SITE_URL', 'http://localhost/hasnainHassan');
}

define('SITE_LOCALE', 'en_US');

define('SITE_LANG', 'en');

/* Logo files, relative to assets/images/ */
define('LOGO_LIGHT', 'hassanengine-logo.svg');
define('LOGO_DARK', 'hassanengine-logo-light.svg');
define('LOGO_FOOTER', 'hassanengine-logo-light.svg');
define('FAVICON', 'favicon.svg');

/* Social preview image */
define('OG_IMAGE', 'assets/images/resource/story-2.optimized.jpg');

/* ---------------------------------------------------------------- Contact */

define('CONTACT_EMAIL', 'husnaingrowbiz365@gmail.com');
define('CONTACT_EMAIL_TO', 'husnaingrowbiz365@gmail.com');
define('CONTACT_PHONE', '+815-804-8928');
define('CONTACT_PHONE_HREF', '+8158048928');
define('CONTACT_ADDRESS', '1426 StreetBend,7702, <br> California, USA');
define('CONTACT_ADDRESS_PLAIN', '1426 StreetBend, 7702, California, USA');
define('CONTACT_MAP_QUERY', '636 5th Ave, New York');

/* ------------------------------------------------------------- Mail delivery */

/**
 * Mail is sent over SMTP so messages really land in the inbox.
 *
 * Google requires an App Password for SMTP logins: open
 * https://myaccount.google.com/apppasswords with 2-Step Verification turned on,
 * generate a 16-character password and paste it into MAIL_SMTP_PASS below
 * (or set the MAIL_SMTP_PASS environment variable, which wins over this file).
 */
define('MAIL_TRANSPORT', 'smtp'); // 'smtp' or 'mail' (PHP mail()).
define('MAIL_FROM_NAME', SITE_NAME);
define('MAIL_FROM_ADDRESS', 'husnaingrowbiz365@gmail.com');
define('MAIL_TO_ADDRESS', 'husnaingrowbiz365@gmail.com');

define('MAIL_SMTP_HOST', 'smtp.gmail.com');
define('MAIL_SMTP_PORT', 465); // 465 = SSL, 587 = STARTTLS.
define('MAIL_SMTP_SECURE', 'ssl'); // 'ssl', 'tls' or ''.
define('MAIL_SMTP_USER', 'husnaingrowbiz365@gmail.com');
define('MAIL_SMTP_PASS', ''); // Google App Password (or see includes/.mail-pass).
define('MAIL_SMTP_AUTH', true);

/**
 * Checks the mail server certificate. Turn this off only when the host has no
 * CA certificate bundle installed and cannot reach the mail server otherwise.
 */
define('MAIL_SMTP_VERIFY_PEER', true);

/* ------------------------------------------------------------------- SEO */

/**
 * Per-page SEO metadata. Keyed by the page filename.
 * title       <title> suffix; the site name is prepended automatically.
 * description meta description, 120-160 characters.
 * keywords    comma separated.
 * priority    sitemap priority, 1.0 is highest.
 * changefreq  sitemap change frequency.
 */
$seo_pages = array(
    'index' => array(
        'title'       => 'Web Development & SEO Services',
        'description' => 'Custom WordPress, PHP, React and Next.js development with technical, on-page, off-page, local and semantic SEO services.',
        'keywords'    => 'web development services, SEO services, WordPress development, PHP development, technical SEO, local SEO, HassanEngine',
        'priority'    => '1.0',
        'changefreq'  => 'weekly',
    ),
    'about' => array(
        'title'       => 'About HassanEngine – Web Development & SEO',
        'description' => 'Learn about HassanEngine web development and SEO services, from WordPress and custom PHP to technical, local and on-page SEO.',
        'keywords'    => 'about HassanEngine, web developer, SEO services, WordPress development, technical SEO',
        'priority'    => '0.8',
        'changefreq'  => 'monthly',
    ),
    'services' => array(
        'title'       => 'Web Development and SEO Services',
        'description' => 'Explore WordPress, custom PHP, React and Next.js development, technical SEO, on-page SEO, local SEO and off-page SEO services.',
        'keywords'    => 'web development services, WordPress, PHP, React, Next.js, technical SEO, local SEO, semantic SEO',
        'priority'    => '0.8',
        'changefreq'  => 'monthly',
    ),
    'service-detail' => array(
        'title'       => 'Service Detail – HassanEngine',
        'description' => 'Read a HassanEngine guide to software engineering concepts and practical development topics.',
        'keywords'    => 'service detail, web development, software development, programming',
        'priority'    => '0.7',
        'changefreq'  => 'monthly',
    ),
    'blog' => array(
        'title'       => 'Software Engineering Articles and Tutorials',
        'description' => 'Read practical articles on software development, architecture, databases, testing, security, and developer workflows.',
        'keywords'    => 'engineering blog posts, software development articles, developer blog, tech articles, coding tutorials',
        'priority'    => '0.9',
        'changefreq'  => 'weekly',
    ),
    'blog-detail' => array(
        'title'       => 'Article',
        'description' => 'A full HassanEngine article: the problem, the approach, the code, the trade-offs and what we learned building it.',
        'keywords'    => 'engineering article, technical write-up, code walkthrough, engineering case study',
        'priority'    => '0.8',
        'changefreq'  => 'weekly',
    ),
    'team' => array(
        'title'       => 'Contributors',
        'description' => 'Meet the writers and contributors behind HassanEngine, an engineering blog built by practitioners writing from experience.',
        'keywords'    => 'engineering blog team, technical writers, software engineer authors, contributors',
        'priority'    => '0.6',
        'changefreq'  => 'monthly',
    ),
    'team-detail' => array(
        'title'       => 'Contributor Profile',
        'description' => 'Author profile and background for a HassanEngine contributor, including areas of specialisation and recent articles.',
        'keywords'    => 'author profile, engineer background, contributor bio, technical writer profile',
        'priority'    => '0.6',
        'changefreq'  => 'monthly',
    ),
    'property' => array(
        'title'       => 'Software Project Notes',
        'description' => 'Browse software project notes with technology stacks, engineering topics, and implementation trade-offs.',
        'keywords'    => 'engineering projects, software project showcase, project case studies, build logs',
        'priority'    => '0.8',
        'changefreq'  => 'weekly',
    ),
    'property-detail' => array(
        'title'       => 'Software Project Details',
        'description' => 'Explore the technologies, design notes, and engineering topics associated with this software project.',
        'keywords'    => 'project case study, software architecture, technical write-up, engineering results',
        'priority'    => '0.7',
        'changefreq'  => 'weekly',
    ),
    'contact' => array(
        'title'       => 'Contact the Engineering Editors',
        'description' => 'Contact HassanEngine about an article correction, a technical question, or a software engineering topic suggestion.',
        'keywords'    => 'contact HassanEngine, engineering blog enquiries, sponsorship, article corrections',
        'priority'    => '0.7',
        'changefreq'  => 'monthly',
    ),
    'faq' => array(
        'title'       => 'Frequently Asked Questions – HassanEngine',
        'description' => 'Find answers about HassanEngine topics, publishing, article permissions, corrections, guest posts, and email updates.',
        'keywords'    => 'HassanEngine FAQ, engineering blog questions, frequently asked questions',
        'priority'    => '0.6',
        'changefreq'  => 'monthly',
    ),
    'web-development' => array(
        'title'       => 'Web Development Hub – HassanEngine',
        'description' => 'Learn web development with HassanEngine: PHP, WordPress, HTML & CSS, JavaScript, frontend development, responsive design, website security, and performance optimization.',
        'keywords'    => 'web development, PHP development, WordPress development, frontend development, responsive design, website security, website performance',
        'priority'    => '0.8',
        'changefreq'  => 'monthly',
    ),
    'seo' => array(
        'title'       => 'SEO Knowledge Hub – HassanEngine',
        'description' => 'Learn search engine optimization with HassanEngine: SEO fundamentals, keyword research, on-page SEO, off-page SEO, technical SEO, local SEO, content SEO, link building, Google Search Console, website audits, SEO tools, and Google indexing.',
        'keywords'    => 'SEO fundamentals, keyword research, on-page SEO, off-page SEO, technical SEO, local SEO, content SEO, link building, Google Search Console, SEO tools',
        'priority'    => '0.8',
        'changefreq'  => 'monthly',
    ),
    'resources' => array(
        'title'       => 'Resource Library – HassanEngine',
        'description' => 'Practical resources for developers, SEO practitioners, and website owners: checklists, guides, code examples, and tool recommendations.',
        'keywords'    => 'SEO checklists, web development guides, WordPress resources, PHP code examples, website launch checklist, SEO tools',
        'priority'    => '0.7',
        'changefreq'  => 'monthly',
    ),
    'privacy-policy' => array(
        'title'       => 'Privacy Policy – HassanEngine',
        'description' => 'HassanEngine privacy policy: how we collect, use, and protect your information.',
        'keywords'    => 'privacy policy, HassanEngine, data protection',
        'priority'    => '0.3',
        'changefreq'  => 'yearly',
    ),
    'terms-and-conditions' => array(
        'title'       => 'Terms and Conditions – HassanEngine',
        'description' => 'HassanEngine terms and conditions governing use of the website.',
        'keywords'    => 'terms and conditions, HassanEngine, website terms',
        'priority'    => '0.3',
        'changefreq'  => 'yearly',
    ),
    'disclaimer' => array(
        'title'       => 'Disclaimer – HassanEngine',
        'description' => 'HassanEngine disclaimer: information provided for general educational and informational purposes.',
        'keywords'    => 'disclaimer, HassanEngine, informational purposes',
        'priority'    => '0.3',
        'changefreq'  => 'yearly',
    ),
    'sitemap' => array(
        'title'       => 'Sitemap – HassanEngine',
        'description' => 'Complete sitemap of all pages on HassanEngine.',
        'keywords'    => 'sitemap, HassanEngine, site overview',
        'priority'    => '0.4',
        'changefreq'  => 'monthly',
    ),
    'not-found' => array(
        'title'       => 'Page Not Found',
        'description' => 'The page you are looking for could not be found. Browse the HassanEngine article archive or search the blog instead.',
        'keywords'    => 'page not found, 404, HassanEngine',
        'priority'    => '0.1',
        'changefreq'  => 'yearly',
    ),
);

/* --------------------------------------------------------- Social profiles */

/** Page summaries are written for the current engineering journal templates. */
/** Set a value to null or an empty string to hide that icon. */
$social = array(
    'facebook'  => 'https://facebook.com/',
    'twitter'   => 'https://twitter.com/',
    'youtube'   => 'https://youtube.com/',
    'instagram' => 'https://instagram.com/',
);

$social_icons = array(
    'facebook'  => 'fa-facebook-f',
    'twitter'   => 'fa-twitter',
    'youtube'   => 'fa-youtube',
    'instagram' => 'fa-instagram',
);

/* ------------------------------------------------------------ Footer links */

$footer_company_links = array(
    'Home'     => 'index.php',
    'Services' => 'services.php',
    'About'    => 'about.php',
    'Articles' => 'blog.php',
    'Projects' => 'property.php',
    'FAQ'      => 'faq.php',
    'Contact'  => 'contact.php',
);

$footer_bottom_links = array(
    'Term & Condition' => '#',
    'Policy & Privacy' => '#',
);

/** Archive list shown in the footer. */
$footer_explore = array(
    array('label' => 'Web Development', 'file' => 'blog.php'),
    array('label' => 'Systems Design',  'file' => 'blog.php'),
    array('label' => 'Databases',       'file' => 'blog.php'),
    array('label' => 'DevOps',          'file' => 'blog.php'),
    array('label' => 'Security',        'file' => 'blog.php'),
    array('label' => 'Testing',         'file' => 'blog.php'),
    array('label' => 'Career',          'file' => 'blog.php'),
);

$footer_about = 'HassanEngine provides custom web development and practical SEO services, from WordPress and PHP builds to technical, local, and on-page search optimization.';

$copyright_name = 'HassanEngine';
$footer_start_year = '2024';

/** Where the header/site search submits to. */
define('SEARCH_ACTION', 'blog.php');

/* ------------------------------------------------------------ Page routing */

/**
 * Header style per page: '' (default), header-style-two, header-style-three
 * or header-style-four. Also which logo variant the page uses.
 */
$header_styles = array(
    'index'      => array('style' => '',                  'logo' => LOGO_LIGHT, 'search' => 'search.svg',         'top' => false),
    'index-2'    => array('style' => 'header-style-two',   'logo' => LOGO_DARK,  'search' => 'search-light.svg',   'top' => false),
    'index-3'    => array('style' => 'header-style-three', 'logo' => LOGO_LIGHT, 'search' => 'search.svg',         'top' => true),
    'about'      => array('style' => 'header-style-four',  'logo' => LOGO_LIGHT, 'search' => 'search.svg',         'top' => false),
    'faq'        => array('style' => 'header-style-four',  'logo' => LOGO_LIGHT, 'search' => 'search.svg',         'top' => false),
    'team'       => array('style' => 'header-style-four',  'logo' => LOGO_LIGHT, 'search' => 'search.svg',         'top' => false),
    'team-detail' => array('style' => 'header-style-four', 'logo' => LOGO_LIGHT, 'search' => 'search.svg',         'top' => false),
    'services'   => array('style' => 'header-style-four',  'logo' => LOGO_LIGHT, 'search' => 'search.svg',         'top' => false),
    'service-detail' => array('style' => 'header-style-four', 'logo' => LOGO_LIGHT, 'search' => 'search.svg',        'top' => false),
    'property'   => array('style' => 'header-style-four',  'logo' => LOGO_LIGHT, 'search' => 'search.svg',         'top' => false),
    'property-detail' => array('style' => 'header-style-four', 'logo' => LOGO_LIGHT, 'search' => 'search.svg',   'top' => false),
    'blog'       => array('style' => 'header-style-four',  'logo' => LOGO_LIGHT, 'search' => 'search.svg',         'top' => false),
    'blog-classic' => array('style' => 'header-style-four', 'logo' => LOGO_LIGHT,  'search' => 'search.svg',         'top' => false),
    'blog-sidebar' => array('style' => 'header-style-four', 'logo' => LOGO_LIGHT,  'search' => 'search.svg',         'top' => false),
    'blog-detail' => array('style' => 'header-style-four', 'logo' => LOGO_LIGHT,   'search' => 'search.svg',         'top' => false),
    'contact'    => array('style' => 'header-style-four',  'logo' => LOGO_LIGHT, 'search' => 'search.svg',         'top' => false),
    'not-found'  => array('style' => 'header-style-four',  'logo' => LOGO_LIGHT, 'search' => 'search.svg',         'top' => false),
);

/**
 * Footer layout per page: 'default', 'two' or 'three'.
 */
$footer_styles = array(
    'index-2' => 'two',
    'index-3' => 'three',
);


