<?php

// Add Admin CSS
function ap_custom_admin_css() {
	echo '<link rel="stylesheet" href="' . get_stylesheet_directory_uri() . '/alpha-projekt/alpha-admin.css" type="text/css" media="all" />';
}
add_action( 'admin_head', 'ap_custom_admin_css' );

// AquaResizer
require_once(ALPHA_PROJEKT_THEME_ENGINE_PATH . '/libs/AquaResizer.php');

function ap_footer_enqueue() {
	wp_enqueue_style( 'ap-static', ALPHA_PROJEKT_THEME_ENGINE_URI . '/css/static.css' );
	wp_enqueue_style( 'sdl-style', ALPHA_PROJEKT_THEME_ENGINE_URI . '/css/style.css' );
//	wp_enqueue_script( 'ap-nicescroll', ALPHA_PROJEKT_THEME_ENGINE_URI . '/js/jquery.mCustomScrollbar.min.js', '', '', true );
////	wp_enqueue_script( 'ap-bpopup', ALPHA_PROJEKT_THEME_ENGINE_URI . '/js/jquery.bpopup.min.js', '', '', true );
//
//	wp_enqueue_script( 'ap-ofi', ALPHA_PROJEKT_THEME_ENGINE_URI . '/js/ofi.min.js', '', '', true );
//	wp_enqueue_script( 'ap-slick', ALPHA_PROJEKT_THEME_ENGINE_URI . '/js/slick.min.js', '', '', true );
//
//
//	wp_enqueue_script( 'ap-slideout', ALPHA_PROJEKT_THEME_ENGINE_URI . '/js/slideout.min.js', '', '', true );
//
//
	wp_enqueue_script( 'alpha-projekt-general', ALPHA_PROJEKT_THEME_ENGINE_URI . '/js/alpha-projekt-general.js', '', '', true );
//
	if ( ap_device() == 'Mobile' ) {
//		wp_enqueue_script( 'alpha-projekt-mobile', ALPHA_PROJEKT_THEME_ENGINE_URI . '/js/alpha-projekt-mobile.js', '', '', true );
	} else {
//		wp_enqueue_script( 'ap-jarallax', ALPHA_PROJEKT_THEME_ENGINE_URI . '/js/jarallax.min.js', '', '', true );
		wp_enqueue_script( 'alpha-projekt-desktop', ALPHA_PROJEKT_THEME_ENGINE_URI . '/js/alpha-projekt-desktop.js', '', '', true );
	}

}
add_action( 'wp_footer', 'ap_footer_enqueue' );

function ap_header_enqueue() {
//	wp_enqueue_style( 'style-name', get_stylesheet_uri() );
//	wp_enqueue_script( 'ap-popupoverlay', ALPHA_PROJEKT_THEME_ENGINE_URI . '/js/jquery.popupoverlay.min.js', '', '', false );
//	wp_enqueue_script( 'ap-svg-js', ALPHA_PROJEKT_THEME_ENGINE_URI . '/js/svg.js', '', '', false );
//	wp_enqueue_script( 'ap-modernizr', ALPHA_PROJEKT_THEME_ENGINE_URI . '/js/modernizr.js', '', '', false );
//	wp_enqueue_script( 'ap-carousel', ALPHA_PROJEKT_THEME_ENGINE_URI . '/js/jquery.carousel.min.js', '', '', false );

//	wp_dequeue_style('aquapro-main');
}
//add_action( 'wp_enqueue_scripts', 'ap_header_enqueue' );
//add_action( 'init', 'ap_header_enqueue' );
//add_action( 'wp_print_styles', 'ap_header_enqueue', 100 );

// https://wordpress.stackexchange.com/questions/231815/remove-wp-add-inline-style
add_action( 'wp_print_styles', function()
{
	// Remove previous inline style
	wp_styles()->add_data( 'aquapro-main', 'after', '' );

} );