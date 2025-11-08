<?php
/**
 * Template Name: Front Page
 * Description: Custom homepage for Foodica with AdSense optimization and strategic ad placement
 * 
 * This template maintains 100% compatibility with Foodica's design system while
 * integrating 3 strategic AdSense units for optimal monetization.
 * 
 * @package Foodica Child
 * @version 1.0.0
 */

get_header(); ?>

<main id="main" class="site-main" role="main">

    <div class="inner-wrap">

        <?php
        /**
         * ========================================================================
         * SECTION 1: FEATURED SLIDER
         * Uses Foodica's native slider with 3 featured posts
         * ========================================================================
         */
        
        // Display Foodica's native slider if on front page
        if ( is_front_page() && function_exists( 'foodica_get_featured_content' ) ) {
            get_template_part( 'wpzoom-slider' );
        } elseif ( is_front_page() ) {
            // Fallback slider using custom function
            $slider_posts = foodica_child_get_slider_posts( 3 );
            
            if ( $slider_posts && $slider_posts->have_posts() ) : ?>
                <div id="slider" class="style-1">
                    <ul class="slides clearfix">
                        <?php while ( $slider_posts->have_posts() ) : $slider_posts->the_post(); 
                            $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'foodica-loop-sticky' );
                            $style = $large_image_url ? ' style="background-image:url(\'' . esc_url( $large_image_url[0] ) . '\')"' : '';
                        ?>
                            <li class="slide">
                                <div class="slide-overlay">
                                    <div class="slide-header">
                                        <?php printf( '<span class="cat-links">%s</span>', get_the_category_list( ', ' ) ); ?>
                                        <?php the_title( sprintf( '<h3><a href="%s">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>
                                        
                                        <div class="entry-meta">
                                            <?php printf( '<span class="entry-date"><time class="entry-date" datetime="%1$s">%2$s</time></span>', 
                                                esc_attr( get_the_date( 'c' ) ), 
                                                esc_html( get_the_date() ) 
                                            ); ?>
                                            <span class="comments-link">
                                                <?php comments_popup_link( 
                                                    __( '0 comments', 'foodica' ), 
                                                    __( '1 comment', 'foodica' ), 
                                                    __( '% comments', 'foodica' ), 
                                                    '', 
                                                    __( 'Comments are Disabled', 'foodica' ) 
                                                ); ?>
                                            </span>
                                        </div>
                                        
                                        <div class="slide_button">
                                            <a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'foodica' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
                                                <?php esc_html_e( 'Read More', 'foodica' ); ?>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="slide-background" <?php echo $style; ?>></div>
                            </li>
                        <?php endwhile; ?>
                    </ul>
                </div>
                <?php wp_reset_postdata(); ?>
            <?php endif;
        }
        ?>

        <?php
        /**
         * ========================================================================
         * SECTION 2: AD UNIT #1 - BELOW SLIDER
         * Strategic placement for immediate visibility (728x90 or responsive)
         * ========================================================================
         */
        
        if ( is_active_sidebar( 'home-ad-slot-1' ) ) {
            dynamic_sidebar( 'home-ad-slot-1' );
        } else {
            // Placeholder for AdSense code - replace with your actual code
            ?>
            <div class="ad-slot-home-1">
                <!-- AdSense Code Placeholder - Ad Slot 1 -->
                <!-- Replace this with your AdSense code:
                <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-XXXXXXXXXXXXXXXX"
                     crossorigin="anonymous"></script>
                <ins class="adsbygoogle"
                     style="display:block"
                     data-ad-client="ca-pub-XXXXXXXXXXXXXXXX"
                     data-ad-slot="YYYYYYYYYY"
                     data-ad-format="auto"
                     data-full-width-responsive="true"></ins>
                -->
                <div style="background:#f0f0f0;padding:20px;text-align:center;color:#666;">
                    <p><?php esc_html_e( 'Ad Slot 1: Add your AdSense code here', 'foodica-child' ); ?></p>
                    <small><?php esc_html_e( 'Go to Appearance → Widgets → Homepage Ad Slot 1', 'foodica-child' ); ?></small>
                </div>
            </div>
            <?php
        }
        ?>

        <?php
        /**
         * ========================================================================
         * SECTION 3: WELCOME TEXT WITH NATIVE FOODICA STYLING
         * ========================================================================
         */
        ?>
        <div class="welcome-section">
            <h1><?php printf( __( 'Welcome to %s', 'foodica-child' ), get_bloginfo( 'name' ) ); ?></h1>
            
            <p>
                <?php 
                // Get site description or use default text
                $description = get_bloginfo( 'description' );
                if ( $description ) {
                    echo esc_html( $description );
                } else {
                    esc_html_e( 'Discover quick, delicious recipes that bring joy to your kitchen. From hearty breakfasts to decadent desserts, we share easy-to-follow recipes that use simple ingredients you already have at home.', 'foodica-child' );
                }
                ?>
            </p>
            
            <p>
                <?php esc_html_e( 'Whether you\'re cooking for your family, hosting friends, or meal prepping for the week, you\'ll find inspiration for every occasion. Join our community of home cooks and food lovers who believe that great food doesn\'t have to be complicated!', 'foodica-child' ); ?>
            </p>
        </div>

        <?php
        /**
         * ========================================================================
         * SECTION 4: LATEST RECIPES GRID
         * Shows 6 latest recipe posts in Foodica's native grid layout
         * ========================================================================
         */
        ?>
        <section class="latest-recipes-section">
            <h2 class="section-title-home"><?php esc_html_e( 'Latest Recipes', 'foodica' ); ?></h2>
            
            <?php
            $recipe_args = array(
                'post_type'      => 'post',
                'posts_per_page' => 6,
                'post_status'    => 'publish',
                'orderby'        => 'date',
                'order'          => 'DESC',
            );
            
            $recipe_query = new WP_Query( $recipe_args );
            
            if ( $recipe_query->have_posts() ) : ?>
                <div class="latest-recipes-grid">
                    <?php 
                    $post_count = 0;
                    while ( $recipe_query->have_posts() ) : $recipe_query->the_post(); 
                        $post_count++;
                    ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class( 'recipe-card-home' ); ?>>
                            
                            <?php if ( has_post_thumbnail() ) : ?>
                                <div class="post-thumb">
                                    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                        <?php the_post_thumbnail( 'foodica-loop-portrait' ); ?>
                                    </a>
                                </div>
                            <?php endif; ?>
                            
                            <div class="entry-body">
                                <span class="cat-links"><?php echo get_the_category_list( ', ' ); ?></span>
                                
                                <?php the_title( sprintf( '<h3 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>
                                
                                <div class="entry-meta">
                                    <?php printf( 
                                        '<span class="entry-date"><time class="entry-date" datetime="%1$s">%2$s</time></span>', 
                                        esc_attr( get_the_date( 'c' ) ), 
                                        esc_html( get_the_date() ) 
                                    ); ?>
                                    
                                    <?php printf( 
                                        '<span class="entry-author">%s ', 
                                        __( 'by', 'foodica' ) 
                                    ); 
                                    the_author_posts_link(); 
                                    echo '</span>'; 
                                    ?>
                                    
                                    <?php if ( ! post_password_required() && ( comments_open() || 0 != get_comments_number() ) ) : ?>
                                        <span class="comments-link">
                                            <?php comments_popup_link( 
                                                __( '0 comments', 'foodica' ), 
                                                __( '1 comment', 'foodica' ), 
                                                __( '% comments', 'foodica' ), 
                                                '', 
                                                __( 'Comments are Disabled', 'foodica' ) 
                                            ); ?>
                                        </span>
                                    <?php endif; ?>
                                </div>
                                
                                <div class="entry-excerpt">
                                    <?php echo wp_trim_words( get_the_excerpt(), 20, '...' ); ?>
                                </div>
                            </div>
                            
                        </article>
                        
                        <?php
                        /**
                         * ========================================================================
                         * SECTION 5: AD UNIT #2 - BETWEEN RECIPE CARDS
                         * Inserted after 3rd recipe card (970x250 or responsive)
                         * ========================================================================
                         */
                        
                        if ( $post_count === 3 ) :
                            if ( is_active_sidebar( 'home-ad-slot-2' ) ) {
                                echo '<div class="ad-break" style="grid-column: 1 / -1;">';
                                dynamic_sidebar( 'home-ad-slot-2' );
                                echo '</div>';
                            } else {
                                ?>
                                <div class="ad-break" style="grid-column: 1 / -1;">
                                    <div class="ad-slot-home-2">
                                        <!-- AdSense Code Placeholder - Ad Slot 2 -->
                                        <!-- Replace this with your AdSense code:
                                        <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-XXXXXXXXXXXXXXXX"
                                             crossorigin="anonymous"></script>
                                        <ins class="adsbygoogle"
                                             style="display:block"
                                             data-ad-client="ca-pub-XXXXXXXXXXXXXXXX"
                                             data-ad-slot="YYYYYYYYYY"
                                             data-ad-format="auto"
                                             data-full-width-responsive="true"></ins>
                                        -->
                                        <div style="background:#f0f0f0;padding:20px;text-align:center;color:#666;">
                                            <p><?php esc_html_e( 'Ad Slot 2: Add your AdSense code here', 'foodica-child' ); ?></p>
                                            <small><?php esc_html_e( 'Go to Appearance → Widgets → Homepage Ad Slot 2', 'foodica-child' ); ?></small>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                        endif;
                        ?>
                        
                    <?php endwhile; ?>
                </div><!-- .latest-recipes-grid -->
                
                <?php wp_reset_postdata(); ?>
                
            <?php else : ?>
                <p><?php esc_html_e( 'No recipes found. Start creating your first post!', 'foodica-child' ); ?></p>
            <?php endif; ?>
        </section>

        <?php
        /**
         * ========================================================================
         * SECTION 6: NEWSLETTER SIGNUP
         * Styled to match Foodica's widget design
         * ========================================================================
         */
        ?>
        <div class="newsletter-home">
            <h2><?php esc_html_e( 'Subscribe to Our Newsletter', 'foodica-child' ); ?></h2>
            <p><?php esc_html_e( 'Get the latest recipes delivered straight to your inbox. Join our community of food lovers!', 'foodica-child' ); ?></p>
            
            <?php
            // Check if newsletter widget area exists
            if ( is_active_sidebar( 'newsletter-sidebar' ) ) {
                dynamic_sidebar( 'newsletter-sidebar' );
            } else {
                // Placeholder for newsletter form
                ?>
                <form action="#" method="post" class="newsletter-form">
                    <input type="email" name="email" placeholder="<?php esc_attr_e( 'Enter your email address', 'foodica-child' ); ?>" required>
                    <button type="submit"><?php esc_html_e( 'Subscribe', 'foodica-child' ); ?></button>
                </form>
                <p style="font-size:0.85rem;margin-top:10px;color:#999;">
                    <?php esc_html_e( 'Add your Mailchimp or newsletter form code here via Appearance → Widgets', 'foodica-child' ); ?>
                </p>
                <?php
            }
            ?>
        </div>

        <?php
        /**
         * ========================================================================
         * SECTION 7: CATEGORY GRID
         * Display 4 main recipe categories with featured images
         * ========================================================================
         */
        
        $categories = foodica_child_get_recipe_categories( 4 );
        
        if ( ! empty( $categories ) ) : ?>
            <section class="category-section">
                <h2 class="section-title-home"><?php esc_html_e( 'Browse by Category', 'foodica-child' ); ?></h2>
                
                <div class="category-grid">
                    <?php 
                    // Define default category slugs to display
                    $priority_categories = array( 'breakfast', 'lunch', 'dinner', 'desserts' );
                    $displayed_cats = array();
                    
                    // First, try to display priority categories
                    foreach ( $priority_categories as $cat_slug ) {
                        $category = get_category_by_slug( $cat_slug );
                        if ( $category && ! in_array( $category->term_id, $displayed_cats ) ) {
                            $displayed_cats[] = $category->term_id;
                            foodica_child_display_category_block( $category );
                        }
                    }
                    
                    // Fill remaining slots with other categories
                    $remaining_slots = 4 - count( $displayed_cats );
                    if ( $remaining_slots > 0 ) {
                        foreach ( $categories as $category ) {
                            if ( ! in_array( $category->term_id, $displayed_cats ) && $remaining_slots > 0 ) {
                                $displayed_cats[] = $category->term_id;
                                foodica_child_display_category_block( $category );
                                $remaining_slots--;
                            }
                        }
                    }
                    ?>
                </div>
            </section>
        <?php endif; ?>

        <?php
        /**
         * ========================================================================
         * SECTION 8: AD UNIT #3 - ABOVE FOOTER
         * Final ad placement before footer (970x90 or responsive)
         * ========================================================================
         */
        
        if ( is_active_sidebar( 'home-ad-slot-3' ) ) {
            dynamic_sidebar( 'home-ad-slot-3' );
        } else {
            // Placeholder for AdSense code
            ?>
            <div class="ad-slot-home-3">
                <!-- AdSense Code Placeholder - Ad Slot 3 -->
                <!-- Replace this with your AdSense code:
                <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-XXXXXXXXXXXXXXXX"
                     crossorigin="anonymous"></script>
                <ins class="adsbygoogle"
                     style="display:block"
                     data-ad-client="ca-pub-XXXXXXXXXXXXXXXX"
                     data-ad-slot="YYYYYYYYYY"
                     data-ad-format="auto"
                     data-full-width-responsive="true"></ins>
                -->
                <div style="background:#f0f0f0;padding:20px;text-align:center;color:#666;">
                    <p><?php esc_html_e( 'Ad Slot 3: Add your AdSense code here', 'foodica-child' ); ?></p>
                    <small><?php esc_html_e( 'Go to Appearance → Widgets → Homepage Ad Slot 3', 'foodica-child' ); ?></small>
                </div>
            </div>
            <?php
        }
        ?>

        <?php
        /**
         * ========================================================================
         * SECTION 9: INSTAGRAM FEED
         * Display Instagram feed using WPZOOM widget or shortcode
         * ========================================================================
         */
        
        if ( is_active_sidebar( 'instagram-sidebar' ) ) : ?>
            <section class="instagram-section">
                <h2><?php esc_html_e( 'Follow Us on Instagram', 'foodica-child' ); ?></h2>
                <?php dynamic_sidebar( 'instagram-sidebar' ); ?>
            </section>
        <?php elseif ( shortcode_exists( 'instagram-feed' ) ) : ?>
            <section class="instagram-section">
                <h2><?php esc_html_e( 'Follow Us on Instagram', 'foodica-child' ); ?></h2>
                <?php echo do_shortcode( '[instagram-feed]' ); ?>
            </section>
        <?php endif; ?>

    </div><!-- .inner-wrap -->

</main><!-- #main -->

<?php
/**
 * ========================================================================
 * HELPER FUNCTION: DISPLAY CATEGORY BLOCK
 * ========================================================================
 */

function foodica_child_display_category_block( $category ) {
    if ( ! $category ) {
        return;
    }
    
    // Get category link and name
    $cat_link = get_category_link( $category->term_id );
    $cat_name = $category->name;
    
    // Try to get category thumbnail (if using a plugin like Categories Images)
    $thumbnail_id = get_term_meta( $category->term_id, 'thumbnail_id', true );
    $image_url = '';
    
    if ( $thumbnail_id ) {
        $image = wp_get_attachment_image_src( $thumbnail_id, 'medium' );
        if ( $image ) {
            $image_url = $image[0];
        }
    }
    
    // Fallback: Get featured image from latest post in category
    if ( ! $image_url ) {
        $cat_posts = get_posts( array(
            'category'       => $category->term_id,
            'posts_per_page' => 1,
            'meta_key'       => '_thumbnail_id',
        ) );
        
        if ( ! empty( $cat_posts ) && has_post_thumbnail( $cat_posts[0]->ID ) ) {
            $image_url = get_the_post_thumbnail_url( $cat_posts[0]->ID, 'medium' );
        }
    }
    
    // Default placeholder if no image found
    if ( ! $image_url ) {
        $image_url = get_template_directory_uri() . '/screenshot.png';
    }
    
    ?>
    <div class="category-block">
        <a href="<?php echo esc_url( $cat_link ); ?>" title="<?php echo esc_attr( sprintf( __( 'View all posts in %s', 'foodica-child' ), $cat_name ) ); ?>">
            <img src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr( $cat_name ); ?>">
            <div class="category-overlay">
                <span class="category-name"><?php echo esc_html( $cat_name ); ?></span>
            </div>
        </a>
    </div>
    <?php
}
?>

<?php get_footer(); ?>
