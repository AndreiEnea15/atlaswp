<?php
if (!defined('ABSPATH')) exit;

// AJAX actions
add_action('wp_ajax_atlasis_search', 'atlasis_search_callback');
add_action('wp_ajax_nopriv_atlasis_search', 'atlasis_search_callback');

/**
 * AJAX search callback
 */
function atlasis_search_callback() {
    check_ajax_referer('atlasis-search-nonce', 'nonce');

    $query_string = isset($_POST['query']) ? sanitize_text_field(wp_unslash($_POST['query'])) : '';
    $posts = atlasis_smart_search_posts($query_string);

    ob_start();

    if ($posts->have_posts()) {
        while ($posts->have_posts()) {
            $posts->the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class('article-item'); ?>>
                <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                <div class="entry-meta">
                    <span class="entry-date"><?php echo get_the_date(); ?></span>
                    <span class="entry-categories"><?php the_category(', '); ?></span>
                </div>
                <div class="entry-summary"><?php the_excerpt(); ?></div>
            </article>
        <?php
        } // end while
    } else {
        echo '<p>' . esc_html__('No articles found for your search query.', 'atlasis') . '</p>';
    }

    wp_reset_postdata();

    wp_send_json_success(array('html' => ob_get_clean()));
} // end function
