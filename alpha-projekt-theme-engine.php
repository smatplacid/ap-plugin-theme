<?php
define( 'ALPHA_PROJEKT_USAGE', 'theme' ); // theme or plugin

if ( ! defined( 'ALPHA_PROJEKT_THEME_ENGINE' ) ) {
	define( 'ALPHA_PROJEKT_THEME_ENGINE', trailingslashit( dirname( __FILE__ ) ) );
}

if ( ! defined( 'ALPHA_PROJEKT_THEME_ENGINE_PATH' ) ) {
	define( 'ALPHA_PROJEKT_THEME_ENGINE_PATH', trailingslashit( dirname( __FILE__ ) ) . '/alpha-projekt-theme-engine' );
}

if ( ! defined( 'ALPHA_PROJEKT_THEME_ENGINE_URI' ) ) {

	if ( ALPHA_PROJEKT_USAGE == 'plugin' ) {
		define( 'ALPHA_PROJEKT_THEME_ENGINE_URI', plugin_dir_url( __FILE__ ) . '/alpha-projekt-theme-engine' );
	} elseif ( ALPHA_PROJEKT_USAGE == 'theme' ) {
		define( 'ALPHA_PROJEKT_THEME_ENGINE_URI', get_stylesheet_directory_uri() . '/alpha-projekt-theme-engine' );
	}

}

function ap_device() {
	require_once( ALPHA_PROJEKT_THEME_ENGINE_PATH . '/libs/MobileDetect.php' );
	if ( ! isset( $ap_device ) ) {
		$ap_device = new Mobile_Detect;
	}
	if ( $ap_device->isMobile() ) {
		return "Mobile";
	}
}

require_once( ALPHA_PROJEKT_THEME_ENGINE_PATH . '/ap-enqueue.php' );

require_once( ALPHA_PROJEKT_THEME_ENGINE_PATH . '/ap-core.php' );


/* ---------------------------------------------------------------------------
 * HOOKS
 * --------------------------------------------------------------------------- */
//add_filter( 'body_class', function( $classes ) {
//	return array_merge( $classes, array( 'class-name' ) );
//} );

//add_action( 'wp_head', 'ap_header_hook' );
//function ap_header_hook() {
//	echo '<meta name="viewport" content="width=device-width, initial-scale=1">';
//}

/* ---------------------------------------------------------------------------
 * IMAGE SIZE
 * --------------------------------------------------------------------------- */
add_action( 'after_setup_theme', 'baw_theme_setup' );
function baw_theme_setup() {
	add_image_size( 'projekt-single-image', 1015, 350, true ); // (cropped)
	add_image_size( 'projekt-float-image-klein', 160, 160, true ); // (cropped)
	add_image_size( 'projekt-float-image-mittel', 135, 100, true ); // (cropped)
	add_image_size( 'projekt-float-image-gross', 160, 160, true ); // (cropped)
	add_image_size( 'person', 500, 400, true ); // (cropped)
//	add_image_size( 'menu-image', 280, 200, true ); // (cropped)
}
