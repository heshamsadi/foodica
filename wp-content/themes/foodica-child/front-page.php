<?php
/**
 * Template Name: Professional Homepage
 * Description: Professional homepage template matching Foodica's design system
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
         * Uses Foodica's exact slider markup with 5 posts
         * ========================================================================
         */
        
        if ( is_front_page() && function_exists( 'foodica_get_featured_content' ) ) {
            // Use parent theme's native slider
            get_template_part( 'wpzoom-slider' );
        } elseif ( is_front_page() ) {
            // Fallback: Custom slider with exact Foodica markup
            $slider_posts = foodica_child_slider_posts( 5 );
            
            if ( $slider_posts && $slider_posts->have_posts() ) : ?>
                <section class="hero-slider-section">
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
                                                <?php printf( 
                                                    '<span class="entry-date"><time class="entry-date" datetime="%1$s">%2$s</time></span>', 
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
                </section>
                <?php wp_reset_postdata(); ?>
            <?php endif;
        }
        ?>

        <?php
        /**
         * ========================================================================
         * SECTION 2: WELCOME HERO
         * Centered welcome message with site branding
         * ========================================================================
         */
        ?>
        <section class="welcome-hero">
            <div class="welcome-content">
                <h1><?php printf( __( 'Welcome to %s', 'foodica-child' ), get_bloginfo( 'name' ) ); ?></h1>
                
                <?php if ( get_bloginfo( 'description' ) ) : ?>
                    <p class="tagline"><?php echo esc_html( get_bloginfo( 'description' ) ); ?></p>
                <?php else : ?>
                    <p class="tagline"><?php esc_html_e( 'Discover quick, delicious recipes that bring joy to your kitchen. From hearty breakfasts to decadent desserts, every dish is tested and loved.', 'foodica-child' ); ?></p>
                <?php endif; ?>
                
                <p class="welcome-paragraph">
                    <?php esc_html_e( 'Whether you\'re cooking for family, hosting friends, or meal prepping for the week, you\'ll find inspiration for every occasion. Join our community of home cooks who believe great food doesn\'t have to be complicated.', 'foodica-child' ); ?>
                </p>
                
                <?php if ( is_active_sidebar( 'home-welcome' ) ) : ?>
                    <div class="welcome-widgets">
                        <?php dynamic_sidebar( 'home-welcome' ); ?>
                    </div>
                <?php endif; ?>
            </div>
        </section>

        <?php
        /**
         * ========================================================================
         * SECTION 3: LATEST RECIPES GRID
         * 9 latest posts in 3-column grid (Foodica's exact markup)
         * ========================================================================
         */
        ?>
        <section class="latest-recipes">
            <h2 class="section-title"><?php esc_html_e( 'Latest Kitchen Creations', 'foodica-child' ); ?></h2>
            
            <?php
            $recipes_query = new WP_Query( array(
                'post_type'      => 'post',
                'posts_per_page' => 9,
                'post_status'    => 'publish',
                'orderby'        => 'date',
                'order'          => 'DESC',
                'no_found_rows'  => true,
            ) );
            ?>
            
            <?php if ( $recipes_query->have_posts() ) : ?>
                <div class="recipes-grid">
                    <?php
                    $post_counter = 0;
                    while ( $recipes_query->have_posts() ) : $recipes_query->the_post();
                        $post_counter++;
                    ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class( 'recipe-card regular-post' ); ?>>
                            
                            <?php if ( has_post_thumbnail() ) : ?>
                                <div class="card-image post-thumb">
                                    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                        <?php the_post_thumbnail( 'foodica-loop-portrait', array( 'loading' => 'lazy' ) ); ?>
                                    </a>
                                </div>
                            <?php endif; ?>
                            
                            <section class="card-content entry-body">
                                <span class="card-cats cat-links"><?php echo get_the_category_list( ', ' ); ?></span>
                                
                                <?php the_title( sprintf( '<h3 class="card-title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>
                                
                                <div class="card-meta entry-meta">
                                    <?php printf( 
                                        '<span class="card-date entry-date"><time class="entry-date" datetime="%1$s">%2$s</time></span>', 
                                        esc_attr( get_the_date( 'c' ) ), 
                                        esc_html( get_the_date( 'M j, Y' ) ) 
                                    ); ?>
                                    
                                    <?php printf( 
                                        '<span class="card-author entry-author">%s ', 
                                        __( 'by', 'foodica' ) 
                                    ); 
                                    the_author_posts_link(); 
                                    echo '</span>'; 
                                    ?>
                                    
                                    <span class="card-read-time">
                                        <?php echo foodica_child_read_time(); ?> <?php esc_html_e( 'min read', 'foodica-child' ); ?>
                                    </span>
                                </div>
                                
                                <?php if ( ! post_password_required() && ( comments_open() || 0 != get_comments_number() ) ) : ?>
                                    <div class="card-comments comments-link">
                                        <?php comments_popup_link( 
                                            __( '0 comments', 'foodica' ), 
                                            __( '1 comment', 'foodica' ), 
                                            __( '% comments', 'foodica' ), 
                                            '', 
                                            __( 'Comments are Disabled', 'foodica' ) 
                                        ); ?>
                                    </div>
                                <?php endif; ?>
                                
                                <div class="card-excerpt entry-content">
                                    <?php echo wp_trim_words( get_the_excerpt(), 20, '...' ); ?>
                                </div>
                            </section>
                            
                        </article>
                        
                        <?php
                        // Insert ad slots after 3rd and 6th post
                        if ( $post_counter === 3 || $post_counter === 6 ) :
                            if ( is_active_sidebar( 'home-recipes-grid' ) ) : ?>
                                <div class="grid-ad-slot">
                                    <?php dynamic_sidebar( 'home-recipes-grid' ); ?>
                                </div>
                            <?php endif;
                        endif;
                        ?>
                        
                    <?php endwhile; ?>
                </div><!-- .recipes-grid -->
                
                <?php wp_reset_postdata(); ?>
                
            <?php else : ?>
                <p><?php esc_html_e( 'No recipes found. Start publishing your first recipe!', 'foodica-child' ); ?></p>
            <?php endif; ?>
        </section>

        <?php
        /**
         * ========================================================================
         * SECTION 4: RECIPE CATEGORIES
         * 4 main categories with featured images
         * ========================================================================
         */
        
        $categories = get_categories( array(
            'orderby'    => 'count',
            'order'      => 'DESC',
            'number'     => 4,
            'hide_empty' => true,
        ) );
        
        if ( ! empty( $categories ) ) : ?>
            <section class="recipe-categories">
                <h2 class="section-title"><?php esc_html_e( 'Browse by Category', 'foodica-child' ); ?></h2>
                
                <div class="categories-grid">
                    <?php foreach ( $categories as $category ) : ?>
                        <div class="category-block">
                            <a href="<?php echo esc_url( get_category_link( $category->term_id ) ); ?>" title="<?php echo esc_attr( sprintf( __( 'View all posts in %s', 'foodica-child' ), $category->name ) ); ?>">
                                <div class="category-bg" style="background-image: url('<?php echo esc_url( foodica_child_category_bg( $category->term_id ) ); ?>');"></div>
                                <div class="category-overlay">
                                    <h3 class="category-title"><?php echo esc_html( $category->name ); ?></h3>
                                    <span class="category-count"><?php printf( _n( '%s Recipe', '%s Recipes', $category->count, 'foodica-child' ), number_format_i18n( $category->count ) ); ?></span>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
                
                <?php if ( is_active_sidebar( 'home-categories' ) ) : ?>
                    <div class="categories-widgets">
                        <?php dynamic_sidebar( 'home-categories' ); ?>
                    </div>
                <?php endif; ?>
            </section>
        <?php endif; ?>

        <?php
        /**
         * ========================================================================
         * SECTION 5: NEWSLETTER SIGNUP
         * Centered newsletter box with Foodica widget styling
         * ========================================================================
         */
        ?>
        <section class="newsletter-section">
            <div class="newsletter-box">
                <h2><?php esc_html_e( 'Get Recipes in Your Inbox', 'foodica-child' ); ?></h2>
                <p><?php esc_html_e( 'Join our community and never miss a delicious recipe! Subscribe to get weekly updates, exclusive content, and cooking tips.', 'foodica-child' ); ?></p>
                
                <?php if ( is_active_sidebar( 'home-newsletter' ) ) : ?>
                    <?php dynamic_sidebar( 'home-newsletter' ); ?>
                <?php else : ?>
                    <form class="newsletter-form" action="#" method="post">
                        <input type="email" name="email" placeholder="<?php esc_attr_e( 'Enter your email address', 'foodica-child' ); ?>" required>
                        <button type="submit"><?php esc_html_e( 'Subscribe', 'foodica-child' ); ?></button>
                    </form>
                    <p style="font-size: 0.85rem; color: #999; margin-top: 15px;">
                        <?php esc_html_e( 'Add your newsletter form via Appearance → Widgets → Homepage Newsletter', 'foodica-child' ); ?>
                    </p>
                <?php endif; ?>
            </div>
        </section>

        <?php
        /**
         * ========================================================================
         * SECTION 6: INSTAGRAM FEED
         * Display Instagram feed using WPZOOM widget
         * ========================================================================
         */
        
        if ( is_active_sidebar( 'home-instagram' ) ) : ?>
            <section class="instagram-section">
                <h2><?php esc_html_e( 'Follow on Instagram', 'foodica-child' ); ?></h2>
                <?php dynamic_sidebar( 'home-instagram' ); ?>
            </section>
        <?php elseif ( shortcode_exists( 'instagram-feed' ) ) : ?>
            <section class="instagram-section">
                <h2><?php esc_html_e( 'Follow on Instagram', 'foodica-child' ); ?></h2>
                <?php echo do_shortcode( '[instagram-feed]' ); ?>
            </section>
        <?php endif; ?>

    </div><!-- .inner-wrap -->
</main><!-- #main -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
