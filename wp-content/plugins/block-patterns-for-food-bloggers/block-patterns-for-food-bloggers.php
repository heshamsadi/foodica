<?php
/**
 * Plugin Name:       Block Patterns for Food Bloggers
 * Plugin URI:        https://www.wpzoom.com/plugins/block-patterns/
 * Description:       A beautiful collection of block patterns for food bloggers
 * Version:           1.0.4
 * Requires at least: 6.1
 * Requires PHP:      7.4
 * Author:            WPZOOM
 * Author URI:        https://www.wpzoom.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       block-patterns-for-food-bloggers
 * Domain Path:       /languages
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

define( 'WPZOOM_FB_PATTERNS_VER', get_file_data( __FILE__, [ 'Version' ] )[0] ); // phpcs:ignore

define( 'WPZOOM_FB_PATTERNS__FILE__', __FILE__ );
define( 'WPZOOM_FB_PATTERNS_ABSPATH', dirname( __FILE__ ) . '/' );
define( 'WPZOOM_FB_PATTERNS_PLUGIN_BASE', plugin_basename( WPZOOM_FB_PATTERNS__FILE__ ) );
define( 'WPZOOM_FB_PATTERNS_PLUGIN_DIR', dirname( WPZOOM_FB_PATTERNS_PLUGIN_BASE ) );

define( 'WPZOOM_FB_PATTERNS_PATH', plugin_dir_path( WPZOOM_FB_PATTERNS__FILE__ ) );
define( 'WPZOOM_FB_PATTERNS_URL', plugin_dir_url( WPZOOM_FB_PATTERNS__FILE__ ) );

// Instance the plugin
WPZOOM_Food_Blog_Patterns::instance();

/**
 * Main WPZOOM_Food_Blog_Patterns Class
 *
 * The main class that initiates and runs the plugin.
 *
 * @since 1.0.0
 */
class WPZOOM_Food_Blog_Patterns {

	/**
	 * Instance
	 *
	 * @var WPZOOM_Food_Blog_Patterns The single instance of the class.
	 * @since 1.0.0
	 * @access private
	 * @static
	 */
	private static $_instance = null;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 * @access public
	 * @static
	 * @return WPZOOM_Food_Blog_Patterns An instance of the class.
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * Constructor
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function __construct() {

		add_action( 'init', array( $this, 'i18n' ) );

		self::includes();

		add_action( 'wp_enqueue_scripts', array( $this, 'register_scripts' ) );
		add_action( 'enqueue_block_editor_assets', array( $this, 'editor_scripts' ) );

		add_editor_style( array( WPZOOM_FB_PATTERNS_PATH . 'assets/css/style.css' ) );

		add_filter( 'render_block_core/group', array( $this, 'group_inner' ), 10, 2 );
		
		remove_filter( 'admin_head', 'wp_check_widget_editor_deps' );

	}

	/**
	 * Load Textdomain
	 *
	 * Load plugin localization files.
	 *
	 * Fired by `init` action hook.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function i18n() {
		load_plugin_textdomain( 'block-patterns-for-food-bloggers', false, WPZOOM_FB_PATTERNS_PLUGIN_DIR . '/languages' );
	}

	/**
	 * Includes files
	 * @method includes
	 *
	 * @return void
	 */
	public function includes() {

		require_once 'register-patterns.php';

	}

	/**
	 * register scripts
	 * @method includes
	 *
	 * @return void
	 */
	public function register_scripts() {

		wp_enqueue_script(
			'wpzfbp_utils',  
			WPZOOM_FB_PATTERNS_URL . 'assets/js/utils.js',
			array( 'jquery' ), 
			WPZOOM_FB_PATTERNS_VER, 
			true 
		);
		
		wp_enqueue_style( 
			'style',
			WPZOOM_FB_PATTERNS_URL . 'assets/css/style.css'
		);

	}

	/**
	 * Enqueue block JavaScript and CSS for the editor
	 */
	function editor_scripts() {

		// Enqueue block editor JS
		wp_enqueue_script(
			'wpzfbp-editor-js',
			plugins_url( '/assets/js/editor.js', __FILE__ ),
			array( 'wp-blocks', 'wp-i18n', 'wp-element', 'wp-components' ),
			WPZOOM_FB_PATTERNS_VER,
			true
		);

		// Enqueue block editor styles
		wp_enqueue_style(
			'wpzfbp-editor-css',
			plugins_url( '/assets/css/style.css', __FILE__ ),
			array( 'wp-edit-blocks' ),
			WPZOOM_FB_PATTERNS_VER
		);

		// Scripts.
		$script_asset = $this->get_asset_file( 'build/block-patterns-for-food-bloggers-editor' );

		wp_enqueue_script(
			'block-patterns-for-food-bloggers-editor-scripts',
			WPZOOM_FB_PATTERNS_URL . 'build/block-patterns-for-food-bloggers-editor.js',
			array_merge( $script_asset['dependencies'], array( 'wp-api' ) ),
			$script_asset['version'],
			true
		);

		// Styles.
		$style_asset = $this->get_asset_file( 'build/block-patterns-for-food-bloggers-editor-styles' );

		wp_enqueue_style(
			'block-patterns-for-food-bloggers-editor-styles',
			WPZOOM_FB_PATTERNS_URL . 'build/style-block-patterns-for-food-bloggers-editor-styles.css',
			array(),
			$style_asset['version']
		);


	}

	/**
	 * Add group block inner container.
	 * The inner container has been removed in WordPress 5.8 if a theme.json
	 * is available in the theme.
	 *
	 * @param   string  $block_content The block content
	 * @return  string The updated block content
	 */
	function group_inner( $block_content, $block ) {
		libxml_use_internal_errors( true );
		$dom = new DOMDocument();
		
		$dom->loadHTML(
			mb_convert_encoding(
                '<html>' . $block_content . '</html>',
                'HTML-ENTITIES',
                'UTF-8'
            ),
			LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD
		);

		if( !isset( $block['attrs']['className'] ) ) {
			return $block_content;
		} elseif( !str_contains( $block['attrs']['className'], 'wpz_pattern' ) ) {
			return $block_content;
		}

		foreach ( $dom->getElementsByTagName( 'div' ) as $div ) {
			// check for desired class name
			if (
				strpos( $div->getAttribute( 'class' ), 'wp-block-group' ) === false
				|| strpos( $div->getAttribute( 'class' ), 'wp-block-group__inner-container' ) !== false
			) {
				continue;
			}

			// check if we already processed this div
			foreach ( $div->childNodes as $childNode ) {
				if (
					method_exists( $childNode, 'getAttribute' )
					&& strpos( $childNode->getAttribute( 'class' ), 'wp-block-group__inner-container' ) !== false
				) {
					continue 2;
				}
			}

			// create the inner container element
			$inner_container = $dom->createElement( 'div' );
			$inner_container->setAttribute( 'class', 'wp-block-group__inner-container' );
			// get all children of the current group
			$children = iterator_to_array( $div->childNodes );

			// append all children to the inner container
			foreach ( $children as $child ) {
				$inner_container->appendChild( $child );
			}

			// append new inner container to the group block
			$div->appendChild( $inner_container );
		}

		return str_replace( [ '<html>', '</html>' ], '', $dom->saveHTML( $dom->documentElement ) );
	}

	/**
	 * Loads the asset file for the given script or style.
	 * Returns a default if the asset file is not found.
	 *
	 * @since 0.1.0
	 *
	 * @param string $filepath The name of the file without the extension.
	 * @return array           The asset file contents.
	 */
	function get_asset_file( $filepath ) {
		$asset_path = WPZOOM_FB_PATTERNS_ABSPATH . $filepath . '.asset.php';

		return file_exists( $asset_path )
			? require_once $asset_path
			: array(
				'dependencies' => array(),
				'version'      => WPZOOM_FB_PATTERNS_ABSPATH,
			);
	}

}