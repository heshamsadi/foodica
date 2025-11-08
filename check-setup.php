<?php
/**
 * Quick Setup Verification Script
 * Copy this URL and paste in browser: http://food1.local/check-setup.php
 */

define('WP_USE_THEMES', false);
require_once('wp-load.php');

header('Content-Type: text/plain; charset=utf-8');

echo "=== FOODICA CHILD THEME SETUP CHECK ===\n\n";

// Check active theme
$theme = wp_get_theme();
echo "Active Theme: " . $theme->get('Name') . "\n";
echo "Theme Status: " . ($theme->get_stylesheet() === 'foodica-child' ? '✓ Child Theme Active' : '✗ Wrong Theme') . "\n\n";

// Check setup flag
$setup_complete = get_option('foodica_child_setup_complete', false);
echo "Auto-Setup Ran: " . ($setup_complete ? '✓ YES' : '✗ NO') . "\n\n";

// Check pages
echo "=== PAGES ===\n";
$pages = get_pages();
echo "Total Pages: " . count($pages) . "\n";
foreach ($pages as $page) {
    echo "  - " . $page->post_title . " (ID: " . $page->ID . ")\n";
}
echo "\n";

// Check menus
echo "=== MENUS ===\n";
$menus = wp_get_nav_menus();
echo "Total Menus: " . count($menus) . "\n";
foreach ($menus as $menu) {
    echo "  - " . $menu->name . " (ID: " . $menu->term_id . ")\n";
    $items = wp_get_nav_menu_items($menu->term_id);
    if ($items) {
        foreach ($items as $item) {
            echo "    → " . $item->title . "\n";
        }
    }
}
echo "\n";

// Check menu locations
echo "=== MENU LOCATIONS ===\n";
$locations = get_nav_menu_locations();
echo "Assigned Locations: " . count($locations) . "\n";
foreach ($locations as $location => $menu_id) {
    $menu = wp_get_nav_menu_object($menu_id);
    echo "  - " . $location . ": " . ($menu ? $menu->name : 'Not Set') . "\n";
}
echo "\n";

// Check if function exists
echo "=== FUNCTION CHECK ===\n";
echo "Auto-setup function exists: " . (function_exists('foodica_child_auto_setup') ? '✓ YES' : '✗ NO') . "\n";

// Manual trigger option
if (!$setup_complete) {
    echo "\n=== TRIGGERING SETUP NOW ===\n";
    if (function_exists('foodica_child_auto_setup')) {
        foodica_child_auto_setup();
        echo "✓ Setup function executed!\n";
        echo "Refresh this page to see results.\n";
    } else {
        echo "✗ Setup function not found!\n";
    }
}

echo "\n=== END ===\n";
