<?php
/**
 * JSON-LD structured data.
 *
 * Emits WebSite on every page, then a page-specific graph node
 * (Article, FAQPage, ContactPage, CollectionPage, ProfilePage, ...).
 */

/**
 * Makes the site data arrays from includes/data/content.php visible inside
 * these functions, since they are declared at global scope by the bootstrap.
 */
function schema_data()
{
    global $social, $posts, $categories, $team, $services, $projects, $faqs;

    return array(
        'social'     => isset($social) ? $social : array(),
        'posts'      => isset($posts) ? $posts : array(),
        'categories' => isset($categories) ? $categories : array(),
        'team'       => isset($team) ? $team : array(),
        'services'   => isset($services) ? $services : array(),
        'projects'   => isset($projects) ? $projects : array(),
        'faqs'       => isset($faqs) ? $faqs : array(),
    );
}

/** Emits the site-wide WebSite graph. */
function schema_site_graph()
{
    global $social;

    $organization = array(
        '@type'           => 'Organization',
        '@id'             => SITE_URL . '/#organization',
        'name'            => SITE_NAME,
        'url'             => SITE_URL . '/',
        'logo'            => SITE_URL . '/assets/images/' . LOGO_LIGHT,
        'description'     => SITE_DESCRIPTION,
        'email'           => CONTACT_EMAIL,
        'telephone'       => CONTACT_PHONE,
        'address'         => array(
            '@type'       => 'PostalAddress',
            'streetAddress' => '1426 StreetBend, 7702',
            'addressLocality' => 'California',
            'addressCountry' => 'USA',
        ),
        'sameAs'          => array_values(array_filter((array) $social)),
    );

    $website = array(
        '@type'           => 'WebSite',
        '@id'             => SITE_URL . '/#website',
        'url'             => SITE_URL . '/',
        'name'            => SITE_NAME,
        'description'     => SITE_DESCRIPTION,
        'inLanguage'      => SITE_LANG,
        'publisher'       => array('@id' => SITE_URL . '/#organization'),
        'potentialAction' => array(
            '@type'       => 'SearchAction',
            'target'      => SITE_URL . '/blog.php?q={search_term}',
            'query-input' => 'required name=search_term',
        ),
    );

    return array($organization, $website);
}

/** Emits the breadcrumb trail as a BreadcrumbList. */
function schema_breadcrumb($crumbs)
{
    if (empty($crumbs)) {
        return null;
    }

    $items = array(
        array(
            '@type'    => 'ListItem',
            'position' => 1,
            'name'     => 'Home',
            'item'     => SITE_URL . '/',
        ),
    );

    $position = 2;
    foreach ($crumbs as $crumb) {
        $item = array(
            '@type'    => 'ListItem',
            'position' => $position,
            'name'     => $crumb['label'],
        );
        if (!empty($crumb['file'])) {
            $item['item'] = SITE_URL . '/' . preg_replace('/\.php$/', '', $crumb['file']);
        }
        $items[] = $item;
        $position++;
    }

    return array(
        '@type'           => 'BreadcrumbList',
        '@id'             => SITE_URL . '/#breadcrumb',
        'itemListElement' => $items,
    );
}

/** Emits the page-specific graph node for a page key. */
function schema_for_page($key, $meta)
{
    $url = isset($meta['canonical']) ? $meta['canonical'] : SITE_URL . '/' . $key;
    $base = SITE_URL . '/';

    switch ($key) {
        case 'blog-detail':
            $article = array(
                '@type'            => 'BlogPosting',
                '@id'              => $url . '#article',
                'headline'         => $meta['schema_headline'] ?? $meta['pageTitle'],
                'description'      => $meta['pageDesc'],
                'image'            => SITE_URL . '/' . ($meta['schema_image'] ?? OG_IMAGE),
                'datePublished'    => $meta['schema_date'],
                'author'           => array(
                    '@type' => 'Person',
                    'name'  => $meta['schema_author'] ?? 'Hassan Raza',
                ),
                'mainEntityOfPage' => $url,
                'keywords'         => $meta['pageKeywords'],
                'inLanguage'       => SITE_LANG,
            );
            return $article;

        case 'blog':
        case 'blog-classic':
        case 'blog-sidebar':
            return array(
                '@type'       => 'Blog',
                '@id'         => $url . '#blog',
                'name'        => $meta['pageTitle'] . ' | ' . SITE_NAME,
                'description' => $meta['pageDesc'],
                'url'         => $url,
                'inLanguage'  => SITE_LANG,
            );

        case 'faq':
            $entities = array();
            foreach (schema_data()['faqs'] as $faq) {
                    $entities[] = array(
                        '@type'          => 'Question',
                        'name'           => $faq['q'],
                        'acceptedAnswer' => array(
                            '@type' => 'Answer',
                            'text'  => $faq['a'],
                        ),
                    );
            }
            return array(
                '@type'      => 'FAQPage',
                '@id'        => $url . '#faq',
                'url'        => $url,
                'mainEntity' => $entities,
            );

        case 'contact':
            return array(
                '@type'       => 'ContactPage',
                '@id'         => $url . '#contact',
                'url'         => $url,
                'name'        => 'Contact ' . SITE_NAME,
                'description' => $meta['pageDesc'],
                'mainEntity'  => array(
                    '@type' => 'WebSite',
                    '@id'   => $base . '#website',
                ),
            );

        case 'about':
            return array(
                '@type'       => 'AboutPage',
                '@id'         => $url . '#about',
                'url'         => $url,
                'name'        => 'About ' . SITE_NAME,
                'description' => $meta['pageDesc'],
                'mainEntity'  => array('@type' => 'WebSite', '@id' => $base . '#website'),
            );

        case 'team':
            $people = array();
            foreach (schema_data()['team'] as $member) {
                $people[] = array(
                    '@type'    => 'Person',
                    'name'     => $member['name'],
                    'jobTitle' => $member['role'],
                    'image'    => SITE_URL . '/' . $member['image'],
                );
            }
            return array(
                '@type'      => 'ItemList',
                '@id'        => $url . '#contributors',
                'url'        => $url,
                'name'       => $meta['pageTitle'] . ' | ' . SITE_NAME,
                'description' => $meta['pageDesc'],
                'itemListElement' => array_map(function ($p, $i) use ($url) {
                    return array(
                        '@type'    => 'ListItem',
                        'position' => $i + 1,
                        'url'      => $url,
                        'item'     => $p,
                    );
                }, $people, array_keys($people)),
            );

        case 'team-detail':
            $member = null;
            foreach (schema_data()['team'] as $candidate) {
                if ($candidate['name'] === $meta['pageTitle']) {
                    $member = $candidate;
                    break;
                }
            }
            if ($member === null) {
                return null;
            }
            return array(
                '@type' => 'ProfilePage',
                '@id' => $url . '#profile',
                'url' => $url,
                'name' => $meta['pageTitle'] . ' | ' . SITE_NAME,
                'description' => $meta['pageDesc'],
                'mainEntity' => array(
                    '@type' => 'Person',
                    'name' => $member['name'],
                    'jobTitle' => $member['role'],
                    'description' => $member['bio'],
                    'image' => SITE_URL . '/' . $member['image'],
                    'email' => $member['email'],
                ),
                'isPartOf' => array('@id' => $base . '#website'),
            );

        case 'property':
            $items = array();
            foreach (schema_data()['projects'] as $i => $project) {
                $items[] = array(
                    '@type'    => 'ListItem',
                    'position' => $i + 1,
                    'url'      => SITE_URL . '/' . project_url($project),
                    'item'     => array(
                        '@type'       => 'SoftwareSourceCode',
                        'name'        => $project['title'],
                        'description' => $project['text'],
                        'image'       => SITE_URL . '/' . $project['image'],
                        'programmingLanguage' => $project['stack'],
                    ),
                );
            }
            return array(
                '@type'           => 'CollectionPage',
                '@id'             => $url . '#projects',
                'url'             => $url,
                'name'            => $meta['pageTitle'] . ' | ' . SITE_NAME,
                'description'     => $meta['pageDesc'],
                'mainEntity'      => array(
                    '@type'           => 'ItemList',
                    'itemListElement' => $items,
                ),
            );

        case 'property-detail':
            $project = null;
            foreach (schema_data()['projects'] as $candidate) {
                if ($candidate['title'] === $meta['pageTitle']) {
                    $project = $candidate;
                    break;
                }
            }
            if ($project === null) {
                return null;
            }
            return array(
                '@type' => 'WebPage',
                '@id' => $url . '#project',
                'url' => $url,
                'name' => $project['title'],
                'description' => $project['text'],
                'mainEntity' => array(
                    '@type' => 'SoftwareSourceCode',
                    'name' => $project['title'],
                    'description' => $project['text'],
                    'image' => SITE_URL . '/' . $project['image'],
                    'programmingLanguage' => $project['stack'],
                ),
                'isPartOf' => array('@id' => $base . '#website'),
            );

        case 'services':
        case 'service-detail':
            return array(
                '@type'      => 'WebPage',
                '@id'        => $url . '#webpage',
                'url'        => $url,
                'name'       => $meta['pageTitle'] . ' | ' . SITE_NAME,
                'description' => $meta['pageDesc'],
                'isPartOf'   => array('@id' => $base . '#website'),
                'inLanguage' => SITE_LANG,
            );

        case 'not-found':
            return null;

        default:
            return array(
                '@type'      => 'WebPage',
                '@id'        => $url . '#webpage',
                'url'        => $url,
                'name'       => $meta['pageTitle'] . ' | ' . SITE_NAME,
                'description' => $meta['pageDesc'],
                'isPartOf'   => array('@id' => $base . '#website'),
                'inLanguage' => SITE_LANG,
            );
    }
}

/** Renders the whole JSON-LD graph for a page. */
function render_schema($key, $meta, $crumbs)
{
    $graph = schema_site_graph();

    $page = schema_for_page($key, $meta);
    if ($page) {
        $graph[] = $page;
    }

    $breadcrumb = schema_breadcrumb($crumbs);
    if ($breadcrumb) {
        $graph[] = $breadcrumb;
    }

    $data = array(
        '@context' => 'https://schema.org',
        '@graph'   => $graph,
    );

    $json = json_encode($data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    if ($json === false) {
        return '';
    }

    // Prevent premature </script> termination.
    $json = str_replace('</', '<\/', $json);

    return '<script type="application/ld+json">' . "\n" . $json . "\n" . '</script>';
}
