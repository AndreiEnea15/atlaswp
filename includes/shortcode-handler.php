<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Renders the article index shortcode.
 *
 * @param array $atts Shortcode attributes.
 * @return string HTML output.
 */
function ispi_index_shortcode( $atts ) {
    ob_start();
    ?>
    <div class="informaticasite-index-wrapper">
        <div class="informaticasite-filters-section">
            <h4 class="filter-title"><?php esc_html_e( 'Filter by Category:', 'informaticasite-pro-index' ); ?></h4>
            <div class="filter-list" id="category-filters">
                <ul class="filter-ul">
                    <li class="active" data-filter="all"><?php esc_html_e( 'All', 'informaticasite-pro-index' ); ?></li>
                    <?php
                    $categories = get_categories( array(
                        'orderby'    => 'name',
                        'order'      => 'ASC',
                        'hide_empty' => false,
                    ) );
                    foreach ( $categories as $category ) {
                        echo '<li data-filter="category-' . esc_attr( $category->slug ) . '">' . esc_html( $category->name ) . ' (' . esc_html( $category->count ) . ')</li>';
                    }
                    ?>
                </ul>
            </div>

            <h4 class="filter-title"><?php esc_html_e( 'Filter by Tag:', 'informaticasite-pro-index' ); ?></h4>
            <div class="filter-list" id="tag-filters">
                <ul class="filter-ul">
                    <li class="active" data-filter="all"><?php esc_html_e( 'All', 'informaticasite-pro-index' ); ?></li>
                    <?php
                    $tags = get_tags( array(
                        'orderby'    => 'count',
                        'order'      => 'DESC',
                        'hide_empty' => false,
                    ) );
                    foreach ( $tags as $tag ) {
                        echo '<li data-filter="tag-' . esc_attr( $tag->slug ) . '">' . esc_html( $tag->name ) . ' (' . esc_html( $tag->count ) . ')</li>';
                    }
                    ?>
                </ul>
            </div>
        </div>

        <div id="informaticasite-article-list" class="article-list-container">
            <?php
            $args = array(
                'post_type'      => 'post',
                'posts_per_page' => -1, // Get all posts
                'orderby'        => 'date',
                'order'          => 'DESC',
            );
            $query = new WP_Query( $args );

            if ( $query->have_posts() ) {
                while ( $query->have_posts() ) {
                    $query->the_post();
                    $post_classes = '';
                    
                    // Add category slugs as classes
                    $post_cats = get_the_category();
                    if ( ! empty( $post_cats ) ) {
                        foreach ( $post_cats as $cat ) {
                            $post_classes .= ' category-' . esc_attr( $cat->slug );
                        }
                    }

                    // Add tag slugs as classes
                    $post_tags = get_the_tags();
                    if ( ! empty( $post_tags ) ) {
                        foreach ( $post_tags as $tag ) {
                            $post_classes .= ' tag-' . esc_attr( $tag->slug );
                        }
                    }
                    ?>
                    <article id="post-<?php the_ID(); ?>" class="article-item<?php echo esc_attr( $post_classes ); ?>">
                        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                        <div class="entry-meta">
                            <span class="entry-date"><?php echo get_the_date(); ?></span>
                            <span class="entry-categories"><?php the_category( ', ' ); ?></span>
                        </div>
                        <div class="entry-summary">
                            <?php the_excerpt(); ?>
                        </div>
                    </article>
                    <?php
                }
            } else {
                echo '<p>' . esc_html__( 'No articles found.', 'informaticasite-pro-index' ) . '</p>';
            }
            wp_reset_postdata();
            ?>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode( 'informaticasite_index', 'ispi_index_shortcode' );