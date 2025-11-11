<?php
/**
 * Index Template - Main Blog Listing
 * 
 * Fallback template for blog posts listing
 */

get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

        <?php if ( have_posts() ) : ?>

            <header class="page-header blog-header">
                <h1 class="page-title">
                    <?php 
                    if ( is_home() && ! is_front_page() ) :
                        single_post_title();
                    else :
                        _e( 'Latest Recipes', 'foodica-child' );
                    endif;
                    ?>
                </h1>
            </header>

            <div class="recipe-archive-grid">
                <?php
                while ( have_posts() ) :
                    the_post();
                    
                    // Get recipe meta
                    $prep_time = get_post_meta( get_the_ID(), 'recipe_prep_time', true );
                    $cook_time = get_post_meta( get_the_ID(), 'recipe_cook_time', true );
                    $total_time = get_post_meta( get_the_ID(), 'recipe_total_time', true );
                    $servings = get_post_meta( get_the_ID(), 'recipe_servings', true );
                    $calories = get_post_meta( get_the_ID(), 'recipe_calories', true );
                    ?>

                    <article id="post-<?php the_ID(); ?>" <?php post_class('recipe-card'); ?>>
                        
                        <?php if ( has_post_thumbnail() ) : ?>
                            <div class="recipe-card-image">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail( 'medium_large', array( 'alt' => get_the_title() ) ); ?>
                                </a>
                            </div>
                        <?php endif; ?>

                        <div class="recipe-card-content">
                            
                            <header class="recipe-card-header">
                                <?php the_category( ', ' ); ?>
                                
                                <h2 class="recipe-card-title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h2>
                            </header>

                            <?php if ( $prep_time || $cook_time || $total_time || $servings || $calories ) : ?>
                                <div class="recipe-card-meta">
                                    <?php if ( $total_time ) : ?>
                                        <span class="recipe-card-time">
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
                                                <path d="M8 0a8 8 0 100 16A8 8 0 008 0zm0 14A6 6 0 118 2a6 6 0 010 12zm1-6V4H7v5l4 2.4.8-1.3-2.8-1.7z"/>
                                            </svg>
                                            <?php echo esc_html( $total_time ); ?>
                                        </span>
                                    <?php endif; ?>
                                    
                                    <?php if ( $servings ) : ?>
                                        <span class="recipe-card-servings">
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
                                                <path d="M8 2a1 1 0 011 1v4h4a1 1 0 110 2H9v4a1 1 0 11-2 0V9H3a1 1 0 110-2h4V3a1 1 0 011-1z"/>
                                            </svg>
                                            <?php echo esc_html( $servings ); ?>
                                        </span>
                                    <?php endif; ?>
                                    
                                    <?php if ( $calories ) : ?>
                                        <span class="recipe-card-calories">
                                            <?php echo esc_html( $calories ); ?>
                                        </span>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>

                            <div class="recipe-card-excerpt">
                                <?php 
                                $intro = get_post_meta( get_the_ID(), 'recipe_introduction', true );
                                if ( $intro ) {
                                    echo wp_trim_words( $intro, 20, '...' );
                                } else {
                                    the_excerpt();
                                }
                                ?>
                            </div>

                            <a href="<?php the_permalink(); ?>" class="recipe-card-link">
                                View Recipe →
                            </a>

                        </div>
                    </article>

                <?php endwhile; ?>
            </div>

            <?php
            // Pagination
            the_posts_pagination( array(
                'mid_size'  => 2,
                'prev_text' => __( '← Previous', 'foodica-child' ),
                'next_text' => __( '→ Next', 'foodica-child' ),
            ) );
            ?>

        <?php else : ?>

            <div class="no-results">
                <h1><?php _e( 'Nothing Found', 'foodica-child' ); ?></h1>
                <p><?php _e( 'It seems we can\'t find what you\'re looking for. Perhaps searching can help.', 'foodica-child' ); ?></p>
                <?php get_search_form(); ?>
            </div>

        <?php endif; ?>

    </main>
</div>

<?php
get_sidebar();
get_footer();
