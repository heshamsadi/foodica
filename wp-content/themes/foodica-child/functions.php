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
    
    // Register navigation menus
    register_nav_menus( array(
        'primary' => __( 'Primary Menu', 'foodica-child' ),
        'footer'  => __( 'Footer Menu', 'foodica-child' ),
    ) );
}
add_action( 'after_setup_theme', 'foodica_child_theme_setup' );

/**
 * ========================================================================
 * AUTO-CREATE ESSENTIAL PAGES & MENU ON ACTIVATION
 * ========================================================================
 */

function foodica_child_auto_setup() {
    // Only run once
    if ( get_option( 'foodica_child_setup_complete' ) ) {
        return;
    }
    
    // 1. Create essential pages
    $pages = array(
        'about' => array(
            'title' => 'About',
            'content' => '<h2>Welcome to Our Kitchen</h2>
<p>Hi! I\'m passionate about creating delicious, easy-to-follow recipes that bring joy to your table. Every recipe on this blog is tested in my own kitchen and perfected for home cooks like you.</p>

<h3>What You\'ll Find Here</h3>
<ul>
<li>Quick weeknight dinners (30 minutes or less)</li>
<li>Comfort food classics with a modern twist</li>
<li>Seasonal dishes and holiday favorites</li>
<li>Kitchen tips and ingredient guides</li>
</ul>

<h3>Our Mission</h3>
<p>To make home cooking accessible, fun, and delicious for everyone. We believe that great meals don\'t require fancy ingredients or complicated techniques—just love, creativity, and a good recipe.</p>',
            'template' => '',
        ),
        'contact' => array(
            'title' => 'Contact',
            'content' => '<h2>Get in Touch</h2>
<p>Have a question about a recipe? Want to collaborate? I\'d love to hear from you!</p>

<h3>Email Me</h3>
<p>Send your message to: <strong>' . get_bloginfo( 'admin_email' ) . '</strong></p>

<h3>Response Time</h3>
<p>I typically respond within 24-48 hours on weekdays.</p>

<h3>Follow Along</h3>
<p>Connect with me on social media for daily cooking inspiration, behind-the-scenes content, and recipe updates!</p>

<p><em>Note: To add a contact form, install the "Contact Form 7" plugin and replace this text with the form shortcode.</em></p>',
            'template' => '',
        ),
        'privacy-policy' => array(
            'title' => 'Privacy Policy',
            'content' => '<h2>Privacy Policy</h2>
<p><strong>Last updated: ' . date( 'F j, Y' ) . '</strong></p>

<h3>Information We Collect</h3>
<p>We collect information you provide directly to us, such as when you subscribe to our newsletter, leave a comment, or contact us via email.</p>

<h3>Cookies</h3>
<p>We use cookies to enhance your browsing experience and analyze site traffic. You can control cookie settings in your browser.</p>

<h3>Third-Party Services</h3>
<p>We may use third-party services like Google Analytics to understand how visitors use our site. These services may collect information about your visit.</p>

<h3>Advertising</h3>
<p>We may display advertisements on our site. Ad partners may use cookies to serve ads based on your interests.</p>

<h3>Your Rights</h3>
<p>You have the right to access, correct, or delete your personal information. Contact us at ' . get_bloginfo( 'admin_email' ) . ' for data requests.</p>

<h3>Changes to This Policy</h3>
<p>We may update this policy from time to time. We will notify you of any changes by posting the new policy on this page.</p>',
            'template' => '',
        ),
        'disclaimer' => array(
            'title' => 'Disclaimer',
            'content' => '<h2>Disclaimer</h2>
<p><strong>Last updated: ' . date( 'F j, Y' ) . '</strong></p>

<h3>Recipe Information</h3>
<p>All recipes on this website are created and tested by us. However, individual results may vary based on ingredients, equipment, and cooking techniques. We cannot guarantee specific outcomes.</p>

<h3>Nutritional Information</h3>
<p>Nutritional information provided is an estimate and may vary based on specific ingredients and portion sizes. Please consult with a healthcare professional for dietary advice.</p>

<h3>Affiliate Links</h3>
<p>This website may contain affiliate links. If you purchase products through these links, we may earn a small commission at no additional cost to you.</p>

<h3>External Links</h3>
<p>Our website may contain links to external sites. We are not responsible for the content or practices of these third-party websites.</p>

<h3>Liability</h3>
<p>The information on this website is provided "as is" without warranties of any kind. We are not liable for any damages arising from your use of this website.</p>',
            'template' => '',
        ),
    );
    
    $page_ids = array();
    foreach ( $pages as $slug => $page_data ) {
        // Check if page already exists
        $existing_page = get_page_by_path( $slug );
        if ( $existing_page ) {
            $page_ids[ $slug ] = $existing_page->ID;
            continue;
        }
        
        // Create page
        $page_id = wp_insert_post( array(
            'post_title'   => $page_data['title'],
            'post_content' => $page_data['content'],
            'post_status'  => 'publish',
            'post_type'    => 'page',
            'post_name'    => $slug,
        ) );
        
        if ( $page_id && ! is_wp_error( $page_id ) ) {
            $page_ids[ $slug ] = $page_id;
            
            // Set privacy policy page
            if ( $slug === 'privacy-policy' ) {
                update_option( 'wp_page_for_privacy_policy', $page_id );
            }
        }
    }
    
    // 2. Create primary navigation menu
    $menu_name = 'Primary Menu';
    $menu_exists = wp_get_nav_menu_object( $menu_name );
    
    if ( ! $menu_exists ) {
        $menu_id = wp_create_nav_menu( $menu_name );
        
        // Add menu items
        $menu_items = array(
            array( 'title' => 'Home', 'url' => home_url( '/' ) ),
            array( 'title' => 'About', 'page_id' => isset( $page_ids['about'] ) ? $page_ids['about'] : 0 ),
            array( 'title' => 'Recipes', 'url' => home_url( '/recipes/' ) ),
            array( 'title' => 'Contact', 'page_id' => isset( $page_ids['contact'] ) ? $page_ids['contact'] : 0 ),
        );
        
        $menu_order = 0;
        foreach ( $menu_items as $item ) {
            $menu_order++;
            
            if ( isset( $item['page_id'] ) && $item['page_id'] ) {
                wp_update_nav_menu_item( $menu_id, 0, array(
                    'menu-item-title'     => $item['title'],
                    'menu-item-object-id' => $item['page_id'],
                    'menu-item-object'    => 'page',
                    'menu-item-type'      => 'post_type',
                    'menu-item-status'    => 'publish',
                    'menu-item-position'  => $menu_order,
                ) );
            } else {
                wp_update_nav_menu_item( $menu_id, 0, array(
                    'menu-item-title'    => $item['title'],
                    'menu-item-url'      => $item['url'],
                    'menu-item-type'     => 'custom',
                    'menu-item-status'   => 'publish',
                    'menu-item-position' => $menu_order,
                ) );
            }
        }
        
        // Assign menu to primary location
        $locations = get_theme_mod( 'nav_menu_locations' );
        $locations['primary'] = $menu_id;
        set_theme_mod( 'nav_menu_locations', $locations );
    }
    
    // 3. Create footer menu
    $footer_menu_name = 'Footer Menu';
    $footer_menu_exists = wp_get_nav_menu_object( $footer_menu_name );
    
    if ( ! $footer_menu_exists ) {
        $footer_menu_id = wp_create_nav_menu( $footer_menu_name );
        
        $footer_items = array(
            array( 'title' => 'About', 'page_id' => isset( $page_ids['about'] ) ? $page_ids['about'] : 0 ),
            array( 'title' => 'Contact', 'page_id' => isset( $page_ids['contact'] ) ? $page_ids['contact'] : 0 ),
            array( 'title' => 'Privacy Policy', 'page_id' => isset( $page_ids['privacy-policy'] ) ? $page_ids['privacy-policy'] : 0 ),
            array( 'title' => 'Disclaimer', 'page_id' => isset( $page_ids['disclaimer'] ) ? $page_ids['disclaimer'] : 0 ),
        );
        
        $footer_order = 0;
        foreach ( $footer_items as $item ) {
            $footer_order++;
            
            if ( isset( $item['page_id'] ) && $item['page_id'] ) {
                wp_update_nav_menu_item( $footer_menu_id, 0, array(
                    'menu-item-title'     => $item['title'],
                    'menu-item-object-id' => $item['page_id'],
                    'menu-item-object'    => 'page',
                    'menu-item-type'      => 'post_type',
                    'menu-item-status'    => 'publish',
                    'menu-item-position'  => $footer_order,
                ) );
            }
        }
        
        // Assign footer menu
        $locations = get_theme_mod( 'nav_menu_locations' );
        $locations['footer'] = $footer_menu_id;
        set_theme_mod( 'nav_menu_locations', $locations );
    }
    
    // Mark setup as complete
    update_option( 'foodica_child_setup_complete', true );
}
add_action( 'after_switch_theme', 'foodica_child_auto_setup' );


// ===================================================================
// RECIPE POST TEMPLATE - MANUAL CREATION SYSTEM
// ===================================================================

/**
 * Add Recipe Meta Box to Post Editor
 * This creates the easy interface for manual recipe creation
 */
function foodica_recipe_add_meta_boxes() {
    add_meta_box(
        'foodica_recipe_details',
        '📋 Recipe Details',
        'foodica_recipe_meta_box_callback',
        'post',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'foodica_recipe_add_meta_boxes' );

/**
 * Recipe Meta Box HTML
 * Creates the form fields in the post editor
 */
function foodica_recipe_meta_box_callback( $post ) {
    // Nonce for security
    wp_nonce_field( 'foodica_recipe_meta_box', 'foodica_recipe_meta_box_nonce' );
    
    // Get existing values
    $intro = get_post_meta( $post->ID, 'recipe_introduction', true );
    $ingredients = get_post_meta( $post->ID, 'recipe_ingredients', true );
    $directions = get_post_meta( $post->ID, 'recipe_directions', true );
    $tips = get_post_meta( $post->ID, 'recipe_tips', true );
    $prep_time = get_post_meta( $post->ID, 'recipe_prep_time', true );
    $cook_time = get_post_meta( $post->ID, 'recipe_cook_time', true );
    $total_time = get_post_meta( $post->ID, 'recipe_total_time', true );
    $servings = get_post_meta( $post->ID, 'recipe_servings', true );
    $calories = get_post_meta( $post->ID, 'recipe_calories', true );
    
    ?>
    <style>
        .recipe-meta-box { padding: 15px 0; }
        .recipe-meta-box .form-section { margin-bottom: 25px; border-bottom: 1px solid #ddd; padding-bottom: 20px; }
        .recipe-meta-box .form-section:last-child { border-bottom: none; }
        .recipe-meta-box label { display: block; font-weight: 600; margin-bottom: 8px; font-size: 14px; color: #23282d; }
        .recipe-meta-box textarea { width: 100%; min-height: 120px; padding: 10px; border: 1px solid #ddd; border-radius: 4px; font-family: inherit; font-size: 14px; }
        .recipe-meta-box input[type="text"] { width: 100%; padding: 8px 10px; border: 1px solid #ddd; border-radius: 4px; }
        .recipe-meta-box .time-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 15px; }
        .recipe-meta-box .nutrition-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 15px; }
        .recipe-meta-box .help-text { font-size: 12px; color: #666; margin-top: 5px; font-style: italic; }
        .recipe-meta-box .section-title { font-size: 16px; font-weight: 700; color: #e05454; margin-bottom: 15px; display: block; }
    </style>
    
    <div class="recipe-meta-box">
        
        <!-- Introduction -->
        <div class="form-section">
            <span class="section-title">📝 Introduction</span>
            <label for="recipe_introduction">Recipe Introduction (2-3 paragraphs)</label>
            <textarea name="recipe_introduction" id="recipe_introduction" rows="4"><?php echo esc_textarea( $intro ); ?></textarea>
            <p class="help-text">Write a compelling introduction that describes the dish, its flavors, and why people will love it.</p>
        </div>
        
        <!-- Timing & Servings -->
        <div class="form-section">
            <span class="section-title">⏱️ Timing & Servings</span>
            <div class="time-grid">
                <div>
                    <label for="recipe_prep_time">Prep Time</label>
                    <input type="text" name="recipe_prep_time" id="recipe_prep_time" value="<?php echo esc_attr( $prep_time ); ?>" placeholder="e.g. 15 minutes" />
                </div>
                <div>
                    <label for="recipe_cook_time">Cook Time</label>
                    <input type="text" name="recipe_cook_time" id="recipe_cook_time" value="<?php echo esc_attr( $cook_time ); ?>" placeholder="e.g. 30 minutes" />
                </div>
                <div>
                    <label for="recipe_total_time">Total Time</label>
                    <input type="text" name="recipe_total_time" id="recipe_total_time" value="<?php echo esc_attr( $total_time ); ?>" placeholder="e.g. 45 minutes" />
                </div>
            </div>
        </div>
        
        <!-- Nutrition -->
        <div class="form-section">
            <span class="section-title">🍽️ Nutrition Information</span>
            <div class="nutrition-grid">
                <div>
                    <label for="recipe_servings">Servings</label>
                    <input type="text" name="recipe_servings" id="recipe_servings" value="<?php echo esc_attr( $servings ); ?>" placeholder="e.g. 4 servings" />
                </div>
                <div>
                    <label for="recipe_calories">Calories per Serving</label>
                    <input type="text" name="recipe_calories" id="recipe_calories" value="<?php echo esc_attr( $calories ); ?>" placeholder="e.g. 350 kcal" />
                </div>
            </div>
        </div>
        
        <!-- Ingredients -->
        <div class="form-section">
            <span class="section-title">🥕 Ingredients</span>
            <label for="recipe_ingredients">Ingredients List</label>
            <textarea name="recipe_ingredients" id="recipe_ingredients" rows="8"><?php echo esc_textarea( $ingredients ); ?></textarea>
            <p class="help-text">Enter each ingredient on a new line. Use bullet points or numbers. Example:<br>
            • 2 cups all-purpose flour<br>
            • 1 cup granulated sugar<br>
            • 1/2 cup butter, softened</p>
        </div>
        
        <!-- Directions -->
        <div class="form-section">
            <span class="section-title">👨‍🍳 Directions</span>
            <label for="recipe_directions">Step-by-Step Directions</label>
            <textarea name="recipe_directions" id="recipe_directions" rows="10"><?php echo esc_textarea( $directions ); ?></textarea>
            <p class="help-text">Write clear, numbered steps. Example:<br>
            1. Preheat oven to 350°F (175°C).<br>
            2. In a large bowl, cream together butter and sugar.<br>
            3. Add eggs one at a time, mixing well after each addition.</p>
        </div>
        
        <!-- Tips -->
        <div class="form-section">
            <span class="section-title">💡 Tips & Notes</span>
            <label for="recipe_tips">Recipe Tips (Optional)</label>
            <textarea name="recipe_tips" id="recipe_tips" rows="5"><?php echo esc_textarea( $tips ); ?></textarea>
            <p class="help-text">Share helpful tips, substitutions, storage advice, or variations. Each tip on a new line.</p>
        </div>
        
    </div>
    <?php
}

/**
 * Save Recipe Meta Box Data
 */
function foodica_recipe_save_meta_box( $post_id ) {
    // Check nonce
    if ( ! isset( $_POST['foodica_recipe_meta_box_nonce'] ) ) {
        return;
    }
    if ( ! wp_verify_nonce( $_POST['foodica_recipe_meta_box_nonce'], 'foodica_recipe_meta_box' ) ) {
        return;
    }
    
    // Check autosave
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    
    // Check permissions
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }
    
    // Save fields
    $fields = array(
        'recipe_introduction',
        'recipe_ingredients',
        'recipe_directions',
        'recipe_tips',
        'recipe_prep_time',
        'recipe_cook_time',
        'recipe_total_time',
        'recipe_servings',
        'recipe_calories'
    );
    
    foreach ( $fields as $field ) {
        if ( isset( $_POST[ $field ] ) ) {
            update_post_meta( $post_id, $field, sanitize_textarea_field( $_POST[ $field ] ) );
        }
    }
}
add_action( 'save_post', 'foodica_recipe_save_meta_box' );
