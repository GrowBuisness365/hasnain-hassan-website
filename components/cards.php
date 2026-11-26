<?php
/**
 * Reusable card components.
 *
 * Each function prints the original template markup so the design is preserved
 * exactly; only the values come from includes/data/content.php.
 */

/**
 * Renders the configured social icons, shared by the team card variants.
 */
function render_social_links()
{
    global $social, $social_icons;

    foreach ((array) $social as $key => $url) {
        if (!$url || !isset($social_icons[$key])) {
            continue;
        }
        echo '<a class="fa-brands ' . htmlspecialchars($social_icons[$key], ENT_QUOTES, 'UTF-8') . ' fa-fw" href="'
            . htmlspecialchars($url, ENT_QUOTES, 'UTF-8') . '" aria-label="'
            . htmlspecialchars(ucfirst($key), ENT_QUOTES, 'UTF-8') . '"></a>';
    }
}

/**
 * Blog article card.
 *
 * $post    array   one entry from $posts
 * $link    string  target URL
 * $wrapper string  optional extra classes for the outer element
 */
function card_post($post, $link = 'blog-detail.php', $wrapper = '')
{
    $link = post_url($post);
    $classes = trim('news-block_one ' . $wrapper);
    ?>
    <!-- News Block One -->
    <div class="<?php echo htmlspecialchars($classes, ENT_QUOTES, 'UTF-8'); ?>">
        <div class="news-block_one-inner">
            <div class="news-block_one-image">
                <a href="<?php echo $link; ?>"><img loading="lazy" decoding="async" src="<?php echo SITE_URL; ?>/<?php echo htmlspecialchars($post['image'], ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($post['title'], ENT_QUOTES, 'UTF-8'); ?>"></a>
            </div>
            <div class="news-block_one-content">
                <ul class="news-block_one-meta">
                    <li><?php echo htmlspecialchars($post['author'], ENT_QUOTES, 'UTF-8'); ?></li>
                    <li><?php echo htmlspecialchars($post['read'], ENT_QUOTES, 'UTF-8'); ?></li>
                </ul>
                <h4 class="news-block_one-title"><a href="<?php echo $link; ?>"><?php echo htmlspecialchars($post['title'], ENT_QUOTES, 'UTF-8'); ?></a></h4>
                <a class="news-block_one-more" href="<?php echo $link; ?>" aria-label="Read more about <?php echo htmlspecialchars($post["title"], ENT_QUOTES, "UTF-8"); ?>">Read More <i class="flaticon-next-1" aria-hidden="true"></i></a>
            </div>
        </div>
    </div>
    <?php
}

/** Project card used by the property-block_one layout. */
function card_project($project, $link = 'property-detail.php')
{
    ?>
    <!-- Property Block One -->
    <div class="property-block_one">
        <div class="property-block_one-inner">
            <div class="property-block_one-image">
                <?php if (!empty($project['featured'])): ?>
                <div class="property-block_one-title">Featured</div>
                <?php endif; ?>
                <a href="<?php echo $link; ?>"><img loading="lazy" decoding="async" src="<?php echo SITE_URL; ?>/<?php echo htmlspecialchars($project['image'], ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($project['title'], ENT_QUOTES, 'UTF-8'); ?>"></a>
            </div>
            <div class="property-block_one-content">
                <div class="property-block_one-location"><i class="flaticon-maps-and-flags" aria-hidden="true"></i><?php echo htmlspecialchars($project['stack'], ENT_QUOTES, 'UTF-8'); ?></div>
                <h4 class="property-block_one-heading"><a href="<?php echo $link; ?>"><?php echo htmlspecialchars($project['title'], ENT_QUOTES, 'UTF-8'); ?></a></h4>
                <p class="property-block_one-text"><?php echo htmlspecialchars($project['text'], ENT_QUOTES, 'UTF-8'); ?></p>
                <div class="d-flex justify-content-between align-items-center flex-wrap">
                    <a class="property-block_one-more" href="<?php echo $link; ?>">View Project <i class="flaticon-next-1" aria-hidden="true"></i></a>
                    <a class="property-block_one-heart" href="<?php echo $link; ?>" aria-label="View <?php echo htmlspecialchars($project['title'], ENT_QUOTES, 'UTF-8'); ?>"><img src="<?php echo SITE_URL; ?>/assets/images/icons/heart.svg" alt=""></a>
                </div>
            </div>
        </div>
    </div>
    <?php
}

/**
 * Project card with the stat strip, used by the property-block_one variants
 * that render the icons row and the price line.
 *
 * $project   array   one entry from $projects
 * $link      string  target URL
 * $wrapClass string  extra classes for the outer element, e.g. 'style-two'
 * $innerClass string extra classes for the inner animated element
 */
function card_project_stats($project, $link = 'property-detail.php', $wrapClass = '', $innerClass = '')
{
    $location = isset($project['stack']) ? $project['stack'] : '';
    $status   = isset($project['status']) ? $project['status'] : '';
    $updated  = isset($project['updated']) ? $project['updated'] : '';
    $articles = isset($project['articles']) ? (int) $project['articles'] : 0;
    $badge    = isset($project['badge']) ? $project['badge'] : '';
    ?>
    <!-- Property Block One -->
    <div class="property-block_one <?php echo htmlspecialchars($wrapClass, ENT_QUOTES, 'UTF-8'); ?>">
        <div class="property-block_one-inner <?php echo htmlspecialchars($innerClass, ENT_QUOTES, 'UTF-8'); ?>">
            <div class="property-block_one-image">
                <?php if ($badge !== ''): ?>
                <div class="property-block_one-title"><?php echo htmlspecialchars($badge, ENT_QUOTES, 'UTF-8'); ?></div>
                <?php endif; ?>
                <a href="<?php echo htmlspecialchars($link, ENT_QUOTES, 'UTF-8'); ?>"><img loading="lazy" decoding="async" width="480" height="360" src="<?php echo SITE_URL; ?>/<?php echo htmlspecialchars($project['image'], ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($project['title'], ENT_QUOTES, 'UTF-8'); ?> illustration"></a>
            </div>
            <div class="property-block_one-content">
                <p class="hassan-project-card_stack"><?php echo htmlspecialchars($location, ENT_QUOTES, 'UTF-8'); ?></p>
                <h2 class="property-block_one-heading"><a href="<?php echo htmlspecialchars($link, ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars($project['title'], ENT_QUOTES, 'UTF-8'); ?></a></h2>
                <p class="hassan-project-card_summary"><?php echo htmlspecialchars($project['text'], ENT_QUOTES, 'UTF-8'); ?></p>
                <ul class="hassan-project-card_meta"><li><span>Status</span><?php echo htmlspecialchars($status, ENT_QUOTES, 'UTF-8'); ?></li><li><span>Articles</span><?php echo $articles; ?></li><li><span>Updated</span><?php echo htmlspecialchars($updated, ENT_QUOTES, 'UTF-8'); ?></li></ul>
            </div>
        </div>
    </div>
    <?php
}

/**
 * Project card for the style-two layout, where the price line sits over the
 * image and the content ends with a "View Details" button.
 */
function card_project_two($project, $link = 'property-detail.php')
{
    $stack    = isset($project['stack']) ? $project['stack'] : '';
    $status   = isset($project['status']) ? $project['status'] : '';
    $updated  = isset($project['updated']) ? $project['updated'] : '';
    $articles = isset($project['articles']) ? (int) $project['articles'] : 0;
    $badge    = isset($project['badge']) ? $project['badge'] : '';
    ?>
    <!-- Property Block One / Style Two -->
    <div class="property-block_one style-two">
        <div class="property-block_one-inner">
            <div class="property-block_one-image">
                <?php if ($badge !== ''): ?>
                <div class="property-block_one-title"><?php echo htmlspecialchars($badge, ENT_QUOTES, 'UTF-8'); ?></div>
                <?php endif; ?>
                <a href="<?php echo $link; ?>"><img loading="lazy" decoding="async" src="<?php echo SITE_URL; ?>/<?php echo htmlspecialchars($project['image'], ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($project['title'], ENT_QUOTES, 'UTF-8'); ?>"></a>
                <div class="property-block_one-image-content">
                    <div class="d-flex justify-content-between align-items-center flex-wrap">
                        <div class="property-block_one-price"><?php echo htmlspecialchars($status, ENT_QUOTES, 'UTF-8'); ?><span><?php echo htmlspecialchars($updated, ENT_QUOTES, 'UTF-8'); ?></span></div>
                        <a class="property-block_one-heart" href="<?php echo $link; ?>" aria-label="View <?php echo htmlspecialchars($project['title'], ENT_QUOTES, 'UTF-8'); ?>"><i class="flaticon-heart" aria-hidden="true"></i></a>
                    </div>
                </div>
            </div>
            <div class="property-block_one-content">
                <div class="property-block_one-location"><i class="flaticon-maps-and-flags" aria-hidden="true"></i><?php echo htmlspecialchars($stack, ENT_QUOTES, 'UTF-8'); ?></div>
                <h4 class="property-block_one-heading"><a href="<?php echo $link; ?>"><?php echo htmlspecialchars($project['title'], ENT_QUOTES, 'UTF-8'); ?></a></h4>
                <ul class="property-block_one-info">
                    <li><span><img src="<?php echo SITE_URL; ?>/assets/images/icons/bed.svg" alt=""></span><?php echo $articles; ?> Articles</li>
                    <li><span><img src="<?php echo SITE_URL; ?>/assets/images/icons/bath.svg" alt=""></span><?php echo count($project['tags']); ?> Topics</li>
                    <li><span><img src="<?php echo SITE_URL; ?>/assets/images/icons/square.svg" alt=""></span><?php echo htmlspecialchars($stack, ENT_QUOTES, 'UTF-8'); ?></li>
                </ul>
                <div class="property-block_one-btn">
                    <a href="<?php echo $link; ?>" class="theme-btn">View Details</a>
                </div>
            </div>
        </div>
    </div>
    <?php
}

/** Topic card used by the city-block_one layout. */
function card_topic($topic)
{
    $link = isset($topic['file']) ? $topic['file'] : 'blog.php';
    ?>
    <!-- City Block One -->
    <div class="city-block_one">
        <div class="city-block_one-inner">
            <div class="city-block_one-image">
<img loading="lazy" decoding="async" src="<?php echo SITE_URL; ?>/<?php echo htmlspecialchars($topic['image'], ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($topic['name'], ENT_QUOTES, 'UTF-8'); ?>">
                <div class="city-block_one-overlay">
                    <div class="city-block_one-content">
                        <div class="city-block_one-title"><?php echo (int) $topic['articles']; ?> Articles</div>
                        <h4 class="city-block_one-heading"><a href="<?php echo $link; ?>"><?php echo htmlspecialchars($topic['name'], ENT_QUOTES, 'UTF-8'); ?></a></h4>
                        <div class="city-block_one-text"><?php echo htmlspecialchars($topic['text'], ENT_QUOTES, 'UTF-8'); ?></div>
                        <a class="city-block_one-more" href="<?php echo $link; ?>">explore all <i class="flaticon-next-1" aria-hidden="true"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
}

/**
 * Team member card for the swiper slides, where the grid columns on
 * card_member() are replaced by the slide wrapper.
 */
function card_member_slide($member, $link = 'team-detail.php')
{
    ?>
    <!-- Team Block One -->
    <div class="team-block_one">
        <div class="team-block_one-inner">
            <div class="team-block_one-image_outer">
                <div class="team-block_one-image">
                <img loading="lazy" decoding="async" src="<?php echo SITE_URL; ?>/<?php echo htmlspecialchars($member['image'], ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($member['name'], ENT_QUOTES, 'UTF-8'); ?>">
                    <!-- Socials -->
                    <div class="team-block_one-socials">
                        <div class="team-block_one-socials-inner">
                            <?php render_social_links(); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="team-block_one-content">
                <div class="d-flex justify-content-between align-items-center flex-wrap">
                    <div class="content">
                        <h6 class="team-block_one-heading"><a href="<?php echo $link; ?>"><?php echo htmlspecialchars($member['name'], ENT_QUOTES, 'UTF-8'); ?></a></h6>
                        <div class="team-block_one-designation"><?php echo htmlspecialchars($member['role'], ENT_QUOTES, 'UTF-8'); ?></div>
                    </div>
                    <div class="team-block_one-icon"><img src="<?php echo SITE_URL; ?>/assets/images/icons/chat.svg" alt=""></div>
                </div>
            </div>
        </div>
    </div>
    <?php
}

/** Reader testimonial used by the testimonial-block_two layout. */
function card_testimonial_two($entry)
{
    ?>
    <!-- Testimonial Block Two -->
    <div class="testimonial-block_two">
        <div class="testimonial-block_two-inner">
            <div class="testimonial-block_two-content">
                <div class="testimonial-block_two-image">
                <img loading="lazy" decoding="async" src="<?php echo SITE_URL; ?>/<?php echo htmlspecialchars($entry['image'], ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($entry['name'], ENT_QUOTES, 'UTF-8'); ?>">
                </div>
                <div class="testimonial-block_two-rating">
                    <span class="fa fa-star" aria-hidden="true"></span>
                    <span class="fa fa-star" aria-hidden="true"></span>
                    <span class="fa fa-star" aria-hidden="true"></span>
                    <span class="fa fa-star" aria-hidden="true"></span>
                    <span class="fa fa-star" aria-hidden="true"></span>
                </div>
                <div class="testimonial-block_two-text"><?php echo htmlspecialchars($entry['text'], ENT_QUOTES, 'UTF-8'); ?></div>
                <h4 class="testimonial-block_two-name"><?php echo htmlspecialchars($entry['name'], ENT_QUOTES, 'UTF-8'); ?><span><?php echo htmlspecialchars($entry['role'], ENT_QUOTES, 'UTF-8'); ?></span></h4>
            </div>
        </div>
    </div>
    <?php
}

/** Reader testimonial used by the testimonial-block_one video layout. */
function card_testimonial_video($entry)
{
    ?>
    <!-- Testimonial Block One -->
    <div class="testimonial-block_one">
        <div class="testimonial-block_one-inner">
            <div class="row clearfix">
                <div class="testimonial-block_one-image_column col-lg-6 col-md-12 col-sm-12">
                    <div class="testimonial-block_one-image">
                <img loading="lazy" decoding="async" src="<?php echo SITE_URL; ?>/<?php echo htmlspecialchars($entry['image'], ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($entry['name'], ENT_QUOTES, 'UTF-8'); ?>">
                        <div class="testimonial-block_one-content">
                            <a href="blog.php" class="lightbox-video testimonial-block_one-play"><span class="flaticon-play-1"><i class="ripple" aria-hidden="true"></i></span></a>
                            <h4 class="testimonial-block_one-name"><?php echo htmlspecialchars($entry['name'], ENT_QUOTES, 'UTF-8'); ?> <span><?php echo htmlspecialchars($entry['role'], ENT_QUOTES, 'UTF-8'); ?></span></h4>
                        </div>
                    </div>
                </div>
                <div class="testimonial-block_one-content_column col-lg-6 col-md-12 col-sm-12">
                    <div class="testimonial-block_one-contents">
                        <div class="testimonial-block_one-quote">
                            <img src="<?php echo SITE_URL; ?>/assets/images/icons/quote.svg" alt="">
                        </div>
                        <div class="testimonial-block_one-rating">
                            <span class="fa fa-star" aria-hidden="true"></span>
                            <span class="fa fa-star" aria-hidden="true"></span>
                            <span class="fa fa-star" aria-hidden="true"></span>
                            <span class="fa fa-star" aria-hidden="true"></span>
                            <span class="fa fa-star" aria-hidden="true"></span>
                        </div>
                        <div class="testimonial-block_one-text"><?php echo htmlspecialchars($entry['text'], ENT_QUOTES, 'UTF-8'); ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
}

/** Team member card used by the team-block_one layout. */
function card_member($member, $link = 'team-detail.php')
{
    ?>
    <!-- Team Block One -->
    <div class="team-block_one col-xl-3 col-lg-6 col-md-6 col-sm-6">
        <div class="team-block_one-inner">
            <div class="team-block_one-image_outer">
                <div class="team-block_one-image">
                <img loading="lazy" decoding="async" src="<?php echo SITE_URL; ?>/<?php echo htmlspecialchars($member['image'], ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($member['name'], ENT_QUOTES, 'UTF-8'); ?>">
                    <!-- Socials -->
                    <div class="team-block_one-socials">
                        <div class="team-block_one-socials-inner">
                            <?php render_social_links(); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="team-block_one-content">
                <div class="d-flex justify-content-between align-items-center flex-wrap">
                    <div class="content">
                        <h6 class="team-block_one-heading"><a href="<?php echo $link; ?>"><?php echo htmlspecialchars($member['name'], ENT_QUOTES, 'UTF-8'); ?></a></h6>
                        <div class="team-block_one-designation"><?php echo htmlspecialchars($member['role'], ENT_QUOTES, 'UTF-8'); ?></div>
                    </div>
                    <div class="team-block_one-icon"><img src="<?php echo SITE_URL; ?>/assets/images/icons/chat.svg" alt=""></div>
                </div>
            </div>
        </div>
    </div>
    <?php
}

/** Testimonial card used by the testimonial-block_three layout. */
function card_testimonial($text, $author, $role, $image)
{
    ?>
    <!-- Testimonial Block Two -->
    <div class="testimonial-block_three">
        <div class="testimonial-block_three-inner">
            <div class="testimonial-block_three-rating">
                <span class="fa fa-star" aria-hidden="true"></span>
                <span class="fa fa-star" aria-hidden="true"></span>
                <span class="fa fa-star" aria-hidden="true"></span>
                <span class="fa fa-star" aria-hidden="true"></span>
                <span class="fa fa-star" aria-hidden="true"></span>
            </div>
            <div class="testimonial-block_three-text"><?php echo htmlspecialchars($text, ENT_QUOTES, 'UTF-8'); ?></div>
            <div class="testimonial-block_three-author">
                <span><img loading="lazy" decoding="async" src="<?php echo SITE_URL; ?>/<?php echo htmlspecialchars($image, ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($author, ENT_QUOTES, 'UTF-8'); ?>"></span>
                <strong><?php echo htmlspecialchars($author, ENT_QUOTES, 'UTF-8'); ?></strong>
                <?php echo htmlspecialchars($role, ENT_QUOTES, 'UTF-8'); ?>
            </div>
            <div class="testimonial-block_three-quote"><img src="<?php echo SITE_URL; ?>/assets/images/icons/quote-1.svg" alt=""></div>
        </div>
    </div>
    <?php
}

/** Service card used by the service-block layout. */
function card_service($service, $link = 'service-detail.php')
{
    ?>
    <!-- Service Block -->
    <div class="service-block_one">
        <div class="service-block_one-inner">
            <div class="service-block_one-image">
            <img loading="lazy" decoding="async" src="<?php echo SITE_URL; ?>/<?php echo htmlspecialchars($service['image'], ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($service['title'], ENT_QUOTES, 'UTF-8'); ?>">
            </div>
            <div class="service-block_one-content">
                <div class="service-block_one-icon"><i class="<?php echo htmlspecialchars($service['icon'], ENT_QUOTES, 'UTF-8'); ?>" aria-hidden="true"></i></div>
                <h4 class="service-block_one-heading"><a href="<?php echo $link; ?>"><?php echo htmlspecialchars($service['title'], ENT_QUOTES, 'UTF-8'); ?></a></h4>
                <div class="text"><?php echo htmlspecialchars($service['text'], ENT_QUOTES, 'UTF-8'); ?></div>
                <a class="service-block_one-more" href="<?php echo $link; ?>" aria-label="Read more about <?php echo htmlspecialchars($service["title"], ENT_QUOTES, "UTF-8"); ?>">Read More <i class="flaticon-next-1" aria-hidden="true"></i></a>
            </div>
        </div>
    </div>
    <?php
}
