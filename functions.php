<?php
/**
 * AiNext functions and definitions
 * @package AiNext
 */


/**
 * Shorthand contents for theme assets url
 */
define('AINEXT_VERSION', time());
define('AINEXT_THEME_URI', get_template_directory_uri());
define('AINEXT_THEME_DIR', get_template_directory());
define('AINEXT_IMG',AINEXT_THEME_URI . '/assets/img');
define('AINEXT_CSS',AINEXT_THEME_URI . '/assets/css');
define('AINEXT_JS',AINEXT_THEME_URI . '/assets/js');
if( !defined('AINEXT_FRAMEWORK_VAR') ) define('AINEXT_FRAMEWORK_VAR', 'ainext_opt');

/**
 * Sets up theme defaults and registers support for various WordPress features.
*/
if ( ! function_exists( 'ainext_setup' ) ) :

	function ainext_setup() {

		// Make theme available for translation.
		load_theme_textdomain( 'ainext', AINEXT_THEME_DIR. '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		// Let WordPress manage the document title.
		add_theme_support( 'title-tag' );

		// Enable support for Post Thumbnails on posts and pages.
		add_theme_support( 'post-thumbnails' );

		// AiNext custom image size
		add_image_size( 'ainext_standard_card', 550, 550, true );

		// Switch default core markup for search form, comment form, and comments
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		remove_theme_support( 'widgets-block-editor' );
	}
endif;
add_action( 'after_setup_theme', 'ainext_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
*/
function ainext_content_width() {
	// This variable is intended to be overruled from themes.
	$GLOBALS['content_width'] = apply_filters( 'ainext_content_width', 640 );
}
add_action( 'after_setup_theme', 'ainext_content_width', 0 );

/**
 * Enqueue scripts and styles.
 */
require AINEXT_THEME_DIR . '/inc/enqueue.php';

if ( ! function_exists( 'ainext_fonts' ) ) {
	function ainext_fonts() {
		wp_enqueue_style( 'ainext-fonts', "//fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,200;1,300;1,400;1,500;1,600;1,700;1,800&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,900&display=swap", '', '1.0.0', 'screen' );
	}
}
add_action( 'wp_enqueue_scripts', 'ainext_fonts' );

// Load WooCommerce compatibility file.
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}

/**
 * Custom template tags for this theme.
 */
require AINEXT_THEME_DIR. '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require AINEXT_THEME_DIR. '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require AINEXT_THEME_DIR. '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require AINEXT_THEME_DIR. '/inc/jetpack.php';
}

/**
 * Load bootstrap navwalker 
 */
require AINEXT_THEME_DIR. '/inc/bootstrap-navwalker.php';

/**
 * Load theme widgets
 */
require AINEXT_THEME_DIR. '/inc/widget.php';

/**
 * Custom style
 */
require AINEXT_THEME_DIR. '/inc/custom-style.php';

/**
 * Social link
*/
require AINEXT_THEME_DIR. '/inc/social-link.php';

/**
 * Recommended plugin
*/
require AINEXT_THEME_DIR. '/lib/recommended-plugin.php';

/**
 * Theme's filters and actions
*/
require AINEXT_THEME_DIR . '/inc/filter_actions.php';