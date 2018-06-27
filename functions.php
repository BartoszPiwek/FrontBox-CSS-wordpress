<!--=======================================================================
|| FILE: functions.php
===========================================================================
|| The functions file behaves like a WordPress Plugin, adding features and 
|| functionality to a WordPress site. You can use it to call functions, 
|| both PHP and built-in WordPress, and to define your own functions. You 
|| can produce the same results by adding code to a WordPress Plugin or 
|| through the WordPress Theme functions file.
===========================================================================

<?php

/*==================================================
// Switch prod/dev wordpress version
==================================================*/

global $version;
$version = get_option('version');

/*==================================================
// Include files
==================================================*/

$frontbox_required = array(
	'shortcodes/svg',
	'shortcodes/list-we-do',
	'post_types',
	'posts/upload_media_javascript',
	'posts/meta_description',
	'posts/meta_keywords',
	'posts/meta_subtitle',
	'posts/meta_title',
	'posts/page_button',
	'posts/what-we-did',
	'posts/class',
	'posts/contact',
	'posts/post',
	'user_profile',
	'widgets',
	'walkers',
	// Settings
	'settings/theme',
	'settings/functions',
);

function frontbox_required_rewrite($string) {
	return 'inc/' . $string . '.php';
};
$frontbox_required = array_map('frontbox_required_rewrite', $frontbox_required);

foreach ($frontbox_required as $value) {
	require_once($value);
}

/*==================================================
// Include scripts/style in wordpress theme 
- https://developer.wordpress.org/reference/functions/wp_enqueue_script/
- https://developer.wordpress.org/reference/functions/wp_enqueue_style/

wp_enqueue_script( 'name', get_theme_file_uri( 'assets/js/name.js' ), array('jquery'), '1.0', true );
wp_enqueue_style( 'style', get_stylesheet_uri() );
==================================================*/

function init_scripts() {
	global $version;

	$frontbox_scripts = file_get_contents( get_theme_file_uri( 'settings/js_libs.json' ) );
	$frontbox_scripts = json_decode($frontbox_scripts, true);

	/**
	 * Development version
	 */
	if ( !$version ) {

		/* Style */
		wp_enqueue_style( 'style', get_theme_file_uri( 'style.css' ) );

		/* Scripts */
		wp_enqueue_script('livereload', 'http://localhost:35729/livereload.js?snipver=1', null, false, false);

		$count = count($frontbox_scripts['js_libs']);
		for ($i=0; $i < $count; $i++) { 
			wp_enqueue_script( "frontbox-script-lib-" . $i, get_theme_file_uri( "src" . $frontbox_scripts['js_libs'][$i] ), null, false, true );
		}

		wp_enqueue_script( "main", get_theme_file_uri( "assets/js/frontbox.js" ), null, false, true );

	/**
	 * Productive version
	 */
	} else { 

		/* Style */
		wp_enqueue_style( 'style', get_theme_file_uri( 'style.prod.css' ) );

		/* Scripts */
		wp_enqueue_script( "main", get_theme_file_uri( "assets/js/scripts.js" ), null, false, true );

	}

	/**
	 * Pass ajax path to JS object
	 */
	wp_localize_script( 'main', 'ajax_object', array( 'ajaxurl' => admin_url( 'admin-ajax.php')));

}
add_action( 'wp_enqueue_scripts', 'init_scripts' );

/*==================================================
// Images/SVG/Thumbnail
==================================================*/

/**
 * Thumbnail images main
 * add_image_size( 'og-image', 600, 315, array( 'center', 'center'));
 * - name { string }
 * - width { number }
 * - height { number }
 * - position crop { array 
 */

add_image_size( 'og-image', 600, 315, array( 'center', 'center'));
add_image_size( 'box-game', 1030, 580, array( 'center', 'center'));

/**
 * Thumbnail images responsive
 * for function responsive_image()
 */
add_image_size( '{name}-mobile', 251, 191, array( 'center', 'center'), true);
add_image_size( '{name}-ptablet', 334, 254, array( 'center', 'center'), true);
add_image_size( '{name}-desktop', 383, 289, array( 'center', 'center'), true);

/**
 * Return responsive tag img
 */
function responsive_image($name) {

	global $post;
	$thumbnailID = get_post_thumbnail_id($post->ID);

	$title = get_the_title($post->ID);
	$post_ID = $post->ID;

	$size = array(
		'mobile' => wp_get_attachment_image_src($thumbnailID, $name . '-mobile'),
		'ptablet' => wp_get_attachment_image_src($thumbnailID, $name . '-ptablet'),
		'desktop' => wp_get_attachment_image_src($thumbnailID, $name . '-desktop'),
	);

	return '
		<img src="' . $size['mobile'][0] . '"
     		 srcset="' . $size['desktop'][0] .' 1200w, ' . $size['ptablet'][0] .' 768w, ' . $size['mobile'][0] . ' 480w"
     		 sizes="100vw"
			 alt="' . get_the_title($post->ID) .'" 
			 width="' . $size['desktop'][1] .'"
			 height="' . $size['desktop'][2] . '"
		/>
	';
}

/**
 * Return cockpit menu icon
 */
function frontbox_admin_menu_icon($name) {
	return get_theme_file_uri( "inc/icons/" . $name . ".png");
}

/**
 * Return svg icon with class
 */
function svg($icon, $class = '') {

	$icon = file_get_contents( get_template_directory() . '/assets/images/svg/' . $icon . '.svg');
	$icon = str_replace("<svg","<svg class='icon " . $class ."'",$icon);

	return $icon;
};


//==================================================
// Register menu

register_nav_menus( array(
	'main-menu'    => __( 'Main Menu', 'blik' ),
) );

/*==================================================
// WYSIWYG
==================================================*/

// Replace text in get_content();
function after_the_content($content) {
	$stringToReplace = '';
	$replaceTo = '';
	$content = str_replace($stringToReplace,$replaceTo,$content);
    return $content;
}
add_filter('the_content',  'after_the_content');

// Add to WYSIWYG { required TinyMCE Advanced }
function frontbox_wysiwyg_add($init) {
	// Colors
	$customColors = '
        "e60012", "Red",
	';
	
    $init['textcolor_map'] = '['.$custom_colors.']';
	$init['textcolor_rows'] = 1;
    return $init;
}
add_filter('tiny_mce_before_init', 'frontbox_wysiwyg_add');

/*==================================================
// Remove from default wordpress flow
==================================================*/

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

/* Remove text wrap in <p> tag */
// remove_filter( 'the_content', 'wpautop' );

/* Remove default post */
function remove_default_post_type() {
    remove_menu_page('edit.php');
}
add_action('admin_menu','remove_default_post_type');

/* Remove admin bar */
// function remove_admin_bar() {
//   show_admin_bar(false);
// }
// add_action('after_setup_theme', 'remove_admin_bar');

/* Remove comments on html file */
if ($version) {
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

/*==================================================
// Change/Add wordpress behaviors
==================================================*/

/* 
	Allow insert tags in widget title
	change <> to [] 
*/
function html_widget_title( $var) {
	$var = (str_replace( '[', '<', $var ));
	$var = (str_replace( ']', '>', $var ));
	return $var ;
}
add_filter( 'widget_title', 'html_widget_title' );

/* Add admin style */
function frontbox_admin_css() {
	echo '<style>' . file_get_contents( get_template_directory_uri() . '/assets/css/css_admin.css') . '</style>';
}
add_action('admin_head', 'frontbox_admin_css');

/*==================================================
// Add theme support
==================================================*/

/* Allow insert page logo */
add_theme_support( 'custom-logo', array(
	'height'      => 53,
	'width'       => 113,
	'flex-height' => true,
	'flex-width'  => true,
	'header-text' => array( 'site-title', 'site-header', 'site-description' ),
) );

/* Allow add post thumbnails */
add_theme_support( 'post-thumbnails' );

/*==================================================
// Addon functions
==================================================*/

/**
 * Return user avatar url
 */
function get_wp_user_avatar_url($user_ID) {
	$string = get_wp_user_avatar($user_ID);
    $pattern = '/src=[\'"]?([^\'" >]+)[\'" >]/';
    preg_match($pattern, $string, $link);
    $link = $link[1];
    $link = urldecode($link);
    return $link;
}

?>
