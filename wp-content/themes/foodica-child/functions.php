<?php
/**
 * Foodica Child Theme Functions
 * 
 * @package Foodica Child
 * @version 1.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * ========================================================================
 * ENQUEUE PARENT AND CHILD THEME STYLES
 * ========================================================================
 */

function foodica_child_enqueue_styles() {
    // Get parent and child theme versions
    $parent_version = wp_get_theme( 'foodica' )->get( 'Version' );
    $child_version = wp_get_theme()->get( 'Version' );
    
    // Enqueue parent stylesheet
    wp_enqueue_style( 
        'foodica-parent-style', 
        get_template_directory_uri() . '/style.css',
        array(),
        $parent_version
    );
    
    // Enqueue child stylesheet (will override parent styles)
    wp_enqueue_style( 
        'foodica-child-style', 
        get_stylesheet_uri(),
        array( 'foodica-parent-style' ),
        $child_version
    );
}
add_action( 'wp_enqueue_scripts', 'foodica_child_enqueue_styles', 15 );

/**
 * ========================================================================
 * REGISTER CUSTOM WIDGET AREAS FOR HOMEPAGE ADS
 * ========================================================================
 */

function foodica_child_homepage_widgets() {
    // Homepage Ad Slot 1 - Below Slider
    register_sidebar( array(
        'name'          => __( 'Homepage Ad Slot 1', 'foodica-child' ),
        'id'            => 'home-ad-slot-1',
        'description'   => __( 'Ad slot displayed below the featured slider (728x90 or responsive)', 'foodica-child' ),
        'before_widget' => '<div class="ad-slot-home-1">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title" style="display:none;">',
        'after_title'   => '</h3>',
    ) );
    
    // Homepage Ad Slot 2 - Between Recipe Cards
    register_sidebar( array(
        'name'          => __( 'Homepage Ad Slot 2', 'foodica-child' ),
        'id'            => 'home-ad-slot-2',
        'description'   => __( 'Ad slot displayed between recipe cards (970x250 or responsive)', 'foodica-child' ),
        'before_widget' => '<div class="ad-slot-home-2">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title" style="display:none;">',
        'after_title'   => '</h3>',
    ) );
    
    // Homepage Ad Slot 3 - Above Footer
    register_sidebar( array(
        'name'          => __( 'Homepage Ad Slot 3', 'foodica-child' ),
        'id'            => 'home-ad-slot-3',
        'description'   => __( 'Ad slot displayed above footer (970x90 or responsive)', 'foodica-child' ),
        'before_widget' => '<div class="ad-slot-home-3">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title" style="display:none;">',
        'after_title'   => '</h3>',
    ) );
}
add_action( 'widgets_init', 'foodica_child_homepage_widgets' );

/**
 * ========================================================================
 * PRECONNECT TO ADSENSE DOMAINS FOR FASTER LOADING
 * ========================================================================
 */

function foodica_child_adsense_preconnect() {
    // Only on homepage
    if ( ! is_front_page() ) {
        return;
    }
    
    echo "\n<!-- AdSense DNS Prefetch & Preconnect -->\n";
    echo '<link rel="preconnect" href="https://pagead2.googlesyndication.com" crossorigin>' . "\n";
    echo '<link rel="preconnect" href="https://googleads.g.doubleclick.net" crossorigin>' . "\n";
    echo '<link rel="preconnect" href="https://adservice.google.com" crossorigin>' . "\n";
    echo '<link rel="dns-prefetch" href="https://pagead2.googlesyndication.com">' . "\n";
    echo '<link rel="dns-prefetch" href="https://googleads.g.doubleclick.net">' . "\n";
    echo "<!-- End AdSense Preconnect -->\n\n";
}
add_action( 'wp_head', 'foodica_child_adsense_preconnect', 1 );

/**
 * ========================================================================
 * LAZY LOAD ADSENSE ADS WITH INTERSECTION OBSERVER
 * ========================================================================
 */

function foodica_child_lazy_adsense_script() {
    // Only on homepage
    if ( ! is_front_page() ) {
        return;
    }
    ?>
    <script>
    /**
     * Lazy Load AdSense Ads
     * Improves Core Web Vitals (LCP, FID, CLS)
     */
    document.addEventListener('DOMContentLoaded', function() {
        // Check if IntersectionObserver is supported
        if ('IntersectionObserver' in window) {
            const adSlots = document.querySelectorAll('.ad-slot-home-1, .ad-slot-home-2, .ad-slot-home-3');
            
            // Observer configuration - load ads 200px before entering viewport
            const observerOptions = {
                root: null,
                rootMargin: '200px',
                threshold: 0.01
            };
            
            const adObserver = new IntersectionObserver(function(entries, observer) {
                entries.forEach(function(entry) {
                    if (entry.isIntersecting) {
                        const adSlot = entry.target;
                        const adScript = adSlot.querySelector('ins.adsbygoogle');
                        
                        if (adScript && !adScript.dataset.adsbygoogleStatus) {
                            try {
                                (adsbygoogle = window.adsbygoogle || []).push({});
                            } catch (e) {
                                console.error('AdSense loading error:', e);
                            }
                        }
                        
                        // Stop observing this ad slot
                        observer.unobserve(adSlot);
                    }
                });
            }, observerOptions);
            
            // Start observing each ad slot
            adSlots.forEach(function(slot) {
                adObserver.observe(slot);
            });
        } else {
            // Fallback for browsers without IntersectionObserver
            // Load ads immediately
            if (typeof adsbygoogle !== 'undefined') {
                const adScripts = document.querySelectorAll('ins.adsbygoogle');
                adScripts.forEach(function() {
                    try {
                        (adsbygoogle = window.adsbygoogle || []).push({});
                    } catch (e) {
                        console.error('AdSense loading error:', e);
                    }
                });
            }
        }
    });
    </script>
    <?php
}
add_action( 'wp_footer', 'foodica_child_lazy_adsense_script', 99 );

/**
 * ========================================================================
 * CUSTOM EXCERPT LENGTH FOR HOMEPAGE RECIPE CARDS
 * ========================================================================
 */

function foodica_child_custom_excerpt_length( $length ) {
    if ( is_front_page() ) {
        return 20; // 20 words for homepage recipe cards
    }
    return $length;
}
add_filter( 'excerpt_length', 'foodica_child_custom_excerpt_length', 999 );

/**
 * ========================================================================
 * ADD ELLIPSIS TO EXCERPTS
 * ========================================================================
 */

function foodica_child_excerpt_more( $more ) {
    if ( is_front_page() ) {
        return '...';
    }
    return $more;
}
add_filter( 'excerpt_more', 'foodica_child_excerpt_more' );

/**
 * ========================================================================
 * HELPER FUNCTION: GET FEATURED POSTS FOR SLIDER
 * ========================================================================
 */

function foodica_child_get_slider_posts( $count = 3 ) {
    // Check if parent theme has featured content function
    if ( function_exists( 'foodica_get_featured_content' ) ) {
        $posts = foodica_get_featured_content();
        return array_slice( $posts, 0, $count );
    }
    
    // Fallback: Get posts from 'featured-recipes' category
    $args = array(
        'post_type'      => 'post',
        'posts_per_page' => $count,
        'category_name'  => 'featured-recipes',
        'post_status'    => 'publish',
        'orderby'        => 'date',
        'order'          => 'DESC',
    );
    
    // If no 'featured-recipes' category, get latest posts with thumbnails
    $featured_posts = new WP_Query( $args );
    
    if ( ! $featured_posts->have_posts() ) {
        $args = array(
            'post_type'      => 'post',
            'posts_per_page' => $count,
            'post_status'    => 'publish',
            'meta_key'       => '_thumbnail_id',
            'orderby'        => 'date',
            'order'          => 'DESC',
        );
        $featured_posts = new WP_Query( $args );
    }
    
    return $featured_posts;
}

/**
 * ========================================================================
 * HELPER FUNCTION: GET RECIPE CATEGORIES WITH THUMBNAILS
 * ========================================================================
 */

function foodica_child_get_recipe_categories( $count = 4 ) {
    $categories = get_categories( array(
        'orderby'    => 'count',
        'order'      => 'DESC',
        'number'     => $count,
        'hide_empty' => true,
    ) );
    
    return $categories;
}

/**
 * ========================================================================
 * OPTIMIZE PERFORMANCE: DISABLE EMOJIS
 * ========================================================================
 */

function foodica_child_disable_emojis() {
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_action( 'admin_print_styles', 'print_emoji_styles' );
    remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
    remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
    remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
}
add_action( 'init', 'foodica_child_disable_emojis' );

/**
 * ========================================================================
 * ADD ASYNC/DEFER TO SCRIPTS FOR BETTER PERFORMANCE
 * ========================================================================
 */

function foodica_child_async_scripts( $tag, $handle, $src ) {
    // Scripts to defer
    $defer_scripts = array(
        'jquery-migrate',
    );
    
    // Scripts to make async
    $async_scripts = array();
    
    if ( in_array( $handle, $defer_scripts ) ) {
        return str_replace( ' src', ' defer src', $tag );
    }
    
    if ( in_array( $handle, $async_scripts ) ) {
        return str_replace( ' src', ' async src', $tag );
    }
    
    return $tag;
}
add_filter( 'script_loader_tag', 'foodica_child_async_scripts', 10, 3 );

/**
 * ========================================================================
 * SECURITY: REMOVE WORDPRESS VERSION NUMBER
 * ========================================================================
 */

function foodica_child_remove_version() {
    return '';
}
add_filter( 'the_generator', 'foodica_child_remove_version' );

/**
 * ========================================================================
 * ADD SUPPORT FOR ADDITIONAL FEATURES
 * ========================================================================
 */

function foodica_child_theme_setup() {
    // Add support for responsive embeds
    add_theme_support( 'responsive-embeds' );
    
    // Add support for editor color palette (match Foodica colors)
    add_theme_support( 'editor-color-palette', array(
        array(
            'name'  => __( 'Primary Red', 'foodica-child' ),
            'slug'  => 'primary-red',
            'color' => '#e05454',
        ),
        array(
            'name'  => __( 'Dark Text', 'foodica-child' ),
            'slug'  => 'dark-text',
            'color' => '#333333',
        ),
        array(
            'name'  => __( 'Light Gray', 'foodica-child' ),
            'slug'  => 'light-gray',
            'color' => '#f9f9f9',
        ),
        array(
            'name'  => __( 'White', 'foodica-child' ),
            'slug'  => 'white',
            'color' => '#ffffff',
        ),
    ) );
}
add_action( 'after_setup_theme', 'foodica_child_theme_setup' );
