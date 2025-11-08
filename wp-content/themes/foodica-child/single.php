<?php
/**
 * Single Post Template - Recipe Posts
 * 
 * Displays individual blog posts with recipe meta box data
 * Automatically applied to all single posts
 */

get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

        <?php
        while ( have_posts() ) :
            the_post();
            ?>

            <article id="post-<?php the_ID(); ?>" <?php post_class('recipe-post'); ?>>
                
                <!-- Recipe Header -->
                <header class="entry-header recipe-header">
                    <h1 class="entry-title recipe-title"><?php the_title(); ?></h1>
                    
                    <div class="entry-meta recipe-meta">
                        <?php
                        // Get custom fields
                        $prep_time = get_post_meta( get_the_ID(), 'recipe_prep_time', true );
                        $cook_time = get_post_meta( get_the_ID(), 'recipe_cook_time', true );
                        $total_time = get_post_meta( get_the_ID(), 'recipe_total_time', true );
                        $servings = get_post_meta( get_the_ID(), 'recipe_servings', true );
                        $calories = get_post_meta( get_the_ID(), 'recipe_calories', true );
                        ?>
                        
                        <?php if ( $prep_time ) : ?>
                            <span class="recipe-time prep-time">
                                <strong>Prep:</strong> <?php echo esc_html( $prep_time ); ?>
                            </span>
                        <?php endif; ?>
                        
                        <?php if ( $cook_time ) : ?>
                            <span class="recipe-time cook-time">
                                <strong>Cook:</strong> <?php echo esc_html( $cook_time ); ?>
                            </span>
                        <?php endif; ?>
                        
                        <?php if ( $total_time ) : ?>
                            <span class="recipe-time total-time">
                                <strong>Total:</strong> <?php echo esc_html( $total_time ); ?>
                            </span>
                        <?php endif; ?>
                        
                        <?php if ( $servings ) : ?>
                            <span class="recipe-servings">
                                <strong>Servings:</strong> <?php echo esc_html( $servings ); ?>
                            </span>
                        <?php endif; ?>
                        
                        <?php if ( $calories ) : ?>
                            <span class="recipe-calories">
                                <strong>Calories:</strong> <?php echo esc_html( $calories ); ?>
                            </span>
                        <?php endif; ?>
                    </div>
                    
                    <?php the_category(', '); ?>
                    <div class="entry-date"><?php echo get_the_date(); ?></div>
                </header>

                <!-- Featured Image -->
                <?php if ( has_post_thumbnail() ) : ?>
                    <div class="recipe-featured-image">
                        <?php the_post_thumbnail( 'large', array( 'class' => 'recipe-main-image' ) ); ?>
                    </div>
                <?php endif; ?>

                <!-- Recipe Introduction -->
                <div class="recipe-introduction">
                    <?php
                    $intro = get_post_meta( get_the_ID(), 'recipe_introduction', true );
                    if ( $intro ) {
                        echo wp_kses_post( wpautop( $intro ) );
                    }
                    ?>
                </div>

                <!-- Recipe Content -->
                <div class="entry-content recipe-content">
                    
                    <!-- Ingredients -->
                    <?php
                    $ingredients = get_post_meta( get_the_ID(), 'recipe_ingredients', true );
                    if ( $ingredients ) :
                    ?>
                        <div class="recipe-section recipe-ingredients">
                            <h2 class="recipe-section-title">Ingredients</h2>
                            <div class="recipe-ingredients-list">
                                <?php echo wp_kses_post( wpautop( $ingredients ) ); ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- Directions -->
                    <?php
                    $directions = get_post_meta( get_the_ID(), 'recipe_directions', true );
                    if ( $directions ) :
                    ?>
                        <div class="recipe-section recipe-directions">
                            <h2 class="recipe-section-title">Directions</h2>
                            <div class="recipe-directions-list">
                                <?php echo wp_kses_post( wpautop( $directions ) ); ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- Tips -->
                    <?php
                    $tips = get_post_meta( get_the_ID(), 'recipe_tips', true );
                    if ( $tips ) :
                    ?>
                        <div class="recipe-section recipe-tips">
                            <h2 class="recipe-section-title">Tips</h2>
                            <div class="recipe-tips-list">
                                <?php echo wp_kses_post( wpautop( $tips ) ); ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- Additional Content (from main editor) -->
                    <?php the_content(); ?>

                </div>

                <!-- Recipe Footer -->
                <footer class="entry-footer recipe-footer">
                    <?php
                    // Tags
                    the_tags( '<div class="recipe-tags"><strong>Tags:</strong> ', ', ', '</div>' );
                    ?>
                </footer>

            </article>

            <?php
            // Comments
            if ( comments_open() || get_comments_number() ) :
                comments_template();
            endif;

        endwhile;
        ?>

    </main>
</div>

<?php
get_sidebar();
get_footer();
