<!--=======================================================================
|| FILE: functions.php
===========================================================================
|| The functions file behaves like a WordPress Plugin, adding features and functionality to a WordPress site. You can use it to call functions, 
|| both PHP and built-in WordPress, and to define your own functions. You can produce the same results by adding code to a WordPress Plugin or through the WordPress 
|| Theme functions file.
===========================================================================

<?php

/*=========================================================================
|| Access to global variables "DEV_ENV" to switch assets version (prod/dev)
=========================================================================*/
global $wp;

//==================================================
// Include scripts/style in wordpress theme

function init_scripts() {
	wp_enqueue_style( 'style', get_stylesheet_uri() ); // Theme stylesheet
	if ( DEV_ENV ) { // DEV version scripts
		wp_enqueue_script( 'jquery-script', get_theme_file_uri( 'assets/js/libs/jquery.js' ), '1.0', true );
		wp_enqueue_script( 'frontbox', get_theme_file_uri( 'assets/js/frontbox.js' ), array( 'jquery-script' ), '1.0', true );
	} else { // PROD version scripts
		wp_enqueue_script( 'main', get_theme_file_uri( 'assets/js/script.js' ), '1.0', true );
	}
}
add_action( 'wp_enqueue_scripts', 'init_scripts' );

//==================================================
// Include files

// Shortcodes
require_once('inc/shortcodes/icons.php');
require_once('inc/shortcodes/template-parts.php');

// Post types
require_once('inc/post_types.php');

// WYSIWYG addons
require_once('inc/custom_wysiwyg.php');

// Widgets
require_once('inc/custom_widgets.php'); // Base
// require_once('inc/widgets/custom-widget.php'); 

// Walkers
require_once('inc/walkers/walker_nav_menu.php');

//==================================================
// Register menu

register_nav_menus( array(
	'main-menu'    => __( 'Main Menu', 'blik' ),
) );

//==================================================
// Remove from default wordpress flow

// Disable emoji's
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );
function disable_emojis_tinymce( $plugins ) {
	if ( is_array( $plugins ) ) {
		return array_diff( $plugins, array( 'wpemoji' ) );
	} else {
		return array();
	}
}
function disable_emojis_remove_dns_prefetch( $urls, $relation_type ) {
	if ( 'dns-prefetch' == $relation_type ) {
		$emoji_svg_url = apply_filters( 'emoji_svg_url', 'https://s.w.org/images/core/emoji/2/svg/' );
		$urls = array_diff( $urls, array( $emoji_svg_url ) );
	}
	return $urls;
}

// Remove WISIWYG text wrap
remove_filter( 'the_content', 'wpautop' );

// Remove default post
function remove_default_post_type() {
    remove_menu_page('edit.php');
}
add_action('admin_menu','remove_default_post_type');

// Remove admin bar
add_action('after_setup_theme', 'remove_admin_bar');
function remove_admin_bar() {
  show_admin_bar(false);
}

// Remove comments on html file
if (!DEV_ENV) {
	function callback($buffer) {
		$buffer = preg_replace('/<!--(.|s)*?-->/', '', $buffer);
		return $buffer;
	}
	function buffer_start() {
		ob_start("callback");
	}
	function buffer_end() {
		ob_end_flush();
	}
	add_action('get_header', 'buffer_start');
	add_action('wp_footer', 'buffer_end');
}

// Remove meta wordpress version
remove_action('wp_head', 'wp_generator');

//==================================================
// Change wordpress behawiors

// Allow insert tags in widget title
// Change <> to []
function html_widget_title( $var) {
	$var = (str_replace( '[', '<', $var ));
	$var = (str_replace( ']', '>', $var ));
	return $var ;
}
add_filter( 'widget_title', 'html_widget_title' );

// Allow insert page logo 
add_theme_support( 'custom-logo', array(
	'height'      => 53,
	'width'       => 113,
	'flex-height' => true,
	'flex-width'  => true,
	'header-text' => array( 'site-title', 'site-header', 'site-description' ),
) );
add_theme_support( 'post-thumbnails' );

?>
