<?php
if(!defined('ABSPATH')) exit;

function atlaswp_index_shortcode($atts){
    $atts = shortcode_atts(array(
        'order'=>'date',
        'sort'=>'DESC',
    ), $atts, 'atlaswp_index');

    ob_start(); ?>
    <div class="atlaswp-index-wrapper">
        <form id="atlaswp-search-form" class="atlaswp-search-form">
            <input type="text" id="atlaswp-search-query" placeholder="Search articles..." />
            <button type="submit"><?php esc_html_e('Search','atlaswp'); ?></button>
        </form>

        <div class="atlaswp-filters">
            <h4><?php esc_html_e('Filter by Category:','atlaswp'); ?></h4>
            <div class="filter-list categories"><?php wp_list_categories('title_li=&show_count=1&echo=1'); ?></div>

            <h4><?php esc_html_e('Filter by Tag:','atlaswp'); ?></h4>
            <div class="filter-list tags"><?php wp_tag_cloud('smallest=8&largest=22&unit=px&echo=1'); ?></div>
        </div>

        <div id="atlaswp-article-list">
            <?php
            $query = new WP_Query(array(
                'post_type'=>'post',
                'posts_per_page'=>10,
                'orderby'=>sanitize_text_field($atts['order']),
                'order'=>sanitize_text_field($atts['sort'])
            ));

            if($query->have_posts()){
                while($query->have_posts()){
                    $query->the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class('article-item'); ?>>
                        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                        <div class="entry-meta">
                            <span class="entry-date"><?php echo get_the_date(); ?></span>
                            <span class="entry-categories"><?php the_category(', '); ?></span>
                        </div>
                        <div class="entry-summary"><?php the_excerpt(); ?></div>
                    </article>
                <?php }
            }else{
                echo '<p>'.esc_html__('No articles found.','atlaswp').'</p>';
            }
            wp_reset_postdata();
            ?>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('atlaswp_index','atlaswp_index_shortcode');
