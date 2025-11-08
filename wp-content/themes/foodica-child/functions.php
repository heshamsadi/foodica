<?php
/**
 * Foodica Child Theme - Professional Homepage
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
    // Get parent and child theme versions for cache busting
    $parent_version = wp_get_theme( 'foodica' )->get( 'Version' );
    $child_version = wp_get_theme()->get( 'Version' );
    
    // Enqueue parent stylesheet
    wp_enqueue_style( 
        'foodica-parent-style', 
        get_template_directory_uri() . '/style.css',
        array(),
        $parent_version
    );
    
    // Enqueue child stylesheet
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
 * REGISTER WIDGET AREAS FOR HOMEPAGE
 * ========================================================================
 */

function foodica_child_register_widget_areas() {
    $widget_areas = array(
        'home-welcome' => array(
            'name' => __( 'Homepage Welcome Section', 'foodica-child' ),
            'description' => __( 'Widgets in the welcome hero section', 'foodica-child' ),
        ),
        'home-featured-slider' => array(
            'name' => __( 'Homepage Featured Slider', 'foodica-child' ),
            'description' => __( 'Above the featured slider', 'foodica-child' ),
        ),
        'home-recipes-grid' => array(
            'name' => __( 'Homepage Recipe Grid Ads', 'foodica-child' ),
            'description' => __( 'Ad slots between recipe cards', 'foodica-child' ),
        ),
        'home-categories' => array(
            'name' => __( 'Homepage Categories Section', 'foodica-child' ),
            'description' => __( 'Below category grid', 'foodica-child' ),
        ),
        'home-newsletter' => array(
            'name' => __( 'Homepage Newsletter', 'foodica-child' ),
            'description' => __( 'Newsletter form area', 'foodica-child' ),
        ),
        'home-instagram' => array(
            'name' => __( 'Homepage Instagram Feed', 'foodica-child' ),
            'description' => __( 'Instagram widget area', 'foodica-child' ),
        ),
    );
    
    foreach ( $widget_areas as $id => $area ) {
        register_sidebar( array(
            'name'          => $area['name'],
            'id'            => $id,
            'description'   => $area['description'],
            'before_widget' => '<div class="widget-area">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
        ) );
    }
}
add_action( 'widgets_init', 'foodica_child_register_widget_areas' );

/**
 * ========================================================================
 * CUSTOM SLIDER POSTS QUERY
 * ========================================================================
 */

function foodica_child_slider_posts( $count = 5 ) {
    $args = array(
        'post_type'      => 'post',
        'posts_per_page' => $count,
        'category_name'  => 'featured',
        'meta_key'       => '_thumbnail_id',
        'orderby'        => 'modified',
        'order'          => 'DESC',
        'no_found_rows'  => true,
        'post_status'    => 'publish',
    );
    
    $query = new WP_Query( $args );
    
    // Fallback: if no 'featured' category, get latest posts with thumbnails
    if ( ! $query->have_posts() ) {
        $args['category_name'] = '';
        $query = new WP_Query( $args );
    }
    
    return $query;
}

/**
 * ========================================================================
 * CALCULATE READ TIME
 * ========================================================================
 */

function foodica_child_read_time( $post_id = null ) {
    if ( ! $post_id ) {
        $post_id = get_the_ID();
    }
    
    $content = get_post_field( 'post_content', $post_id );
    $word_count = str_word_count( strip_tags( $content ) );
    $read_time = ceil( $word_count / 200 ); // 200 words per minute
    
    return max( 1, $read_time ); // Minimum 1 minute
}

/**
 * ========================================================================
 * GET CATEGORY BACKGROUND IMAGE
 * ========================================================================
 */

function foodica_child_category_bg( $category_id ) {
    // Try to get first post with thumbnail from this category
    $args = array(
        'category'       => $category_id,
        'posts_per_page' => 1,
        'meta_key'       => '_thumbnail_id',
        'orderby'        => 'date',
        'order'          => 'DESC',
        'no_found_rows'  => true,
    );
    
    $posts = get_posts( $args );
    
    if ( $posts && has_post_thumbnail( $posts[0]->ID ) ) {
        return get_the_post_thumbnail_url( $posts[0]->ID, 'large' );
    }
    
    // Fallback to placeholder
    return get_template_directory_uri() . '/screenshot.png';
}

/**
 * ========================================================================
 * CUSTOM EXCERPT LENGTH FOR HOMEPAGE
 * ========================================================================
 */

function foodica_child_custom_excerpt_length( $length ) {
    if ( is_front_page() ) {
        return 20;
    }
    return $length;
}
add_filter( 'excerpt_length', 'foodica_child_custom_excerpt_length', 999 );

/**
 * ========================================================================
 * CUSTOM EXCERPT MORE TEXT
 * ========================================================================
 */

function foodica_child_excerpt_more( $more ) {
    return '...';
}
add_filter( 'excerpt_more', 'foodica_child_excerpt_more' );

/**
 * ========================================================================
 * ADD THEME SUPPORT
 * ========================================================================
 */

function foodica_child_theme_setup() {
    // Add support for responsive embeds
    add_theme_support( 'responsive-embeds' );
    
    // Add support for custom line height
    add_theme_support( 'custom-line-height' );
    
    // Add support for custom spacing
    add_theme_support( 'custom-spacing' );
}
add_action( 'after_setup_theme', 'foodica_child_theme_setup' );
add_action( 'after_setup_theme', 'foodica_child_theme_setup' );
