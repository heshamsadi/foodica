<?php
/**
 * Foodica Child Theme - Activation Script
 * Run this file to activate the theme programmatically
 * 
 * Usage: php activate-theme.php
 */

// Load WordPress
define( 'WP_USE_THEMES', false );
require_once( dirname( __FILE__ ) . '/../../../wp-load.php' );

echo "🚀 Activating Foodica Child Theme...\n\n";

// Activate the theme
$theme = wp_get_theme( 'foodica-child' );

if ( ! $theme->exists() ) {
    die( "❌ Error: Foodica Child theme not found!\n" );
}

// Switch to the theme (this triggers after_switch_theme hook)
switch_theme( 'foodica-child' );

echo "✅ Theme activated: " . $theme->get( 'Name' ) . "\n";
echo "   Version: " . $theme->get( 'Version' ) . "\n";
echo "   Parent: " . $theme->get( 'Template' ) . "\n\n";

// Wait a moment for hooks to complete
sleep( 1 );

// Check if setup ran
$setup_complete = get_option( 'foodica_child_setup_complete' );

if ( $setup_complete ) {
    echo "🤖 Automated setup completed successfully!\n\n";
    
    // List created pages
    echo "📄 Pages created:\n";
    $pages = get_pages( array( 'sort_column' => 'post_date', 'sort_order' => 'desc' ) );
    foreach ( $pages as $page ) {
        echo "   ✓ " . $page->post_title . " (" . get_permalink( $page->ID ) . ")\n";
    }
    
    echo "\n";
    
    // List menus
    echo "🔗 Navigation menus created:\n";
    $menus = wp_get_nav_menus();
    foreach ( $menus as $menu ) {
        $locations = get_nav_menu_locations();
        $location = '';
        foreach ( $locations as $loc_name => $menu_id ) {
            if ( $menu_id == $menu->term_id ) {
                $location = " [Assigned to: $loc_name]";
                break;
            }
        }
        echo "   ✓ " . $menu->name . $location . "\n";
        
        // Show menu items
        $menu_items = wp_get_nav_menu_items( $menu->term_id );
        if ( $menu_items ) {
            foreach ( $menu_items as $item ) {
                echo "      - " . $item->title . "\n";
            }
        }
    }
    
    echo "\n";
    
    // Privacy policy page
    $privacy_page_id = get_option( 'wp_page_for_privacy_policy' );
    if ( $privacy_page_id ) {
        $privacy_page = get_post( $privacy_page_id );
        echo "🔒 Privacy Policy page set: " . $privacy_page->post_title . "\n\n";
    }
    
} else {
    echo "⚠️  Warning: Automated setup did not run.\n";
    echo "   This might happen if:\n";
    echo "   - Pages/menus already exist\n";
    echo "   - Theme was previously activated\n\n";
    echo "   To force re-run setup:\n";
    echo "   1. Delete option: wp option delete foodica_child_setup_complete\n";
    echo "   2. Reactivate theme\n\n";
}

echo "🎉 All done! Visit your site:\n";
echo "   Homepage: " . home_url() . "\n";
echo "   About: " . home_url( '/about/' ) . "\n";
echo "   Contact: " . home_url( '/contact/' ) . "\n";
echo "   Privacy: " . home_url( '/privacy-policy/' ) . "\n\n";

echo "📝 Next steps:\n";
echo "   1. Publish 20-30 recipe posts\n";
echo "   2. Add featured images to posts\n";
echo "   3. Create 'Featured' category for slider\n";
echo "   4. Install essential plugins (Yoast SEO, Contact Form 7)\n";
echo "   5. Buy a real domain (AdSense requirement)\n";
echo "   6. Apply for Google AdSense\n\n";

echo "✅ Activation complete!\n";
