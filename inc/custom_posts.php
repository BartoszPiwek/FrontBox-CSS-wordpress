<!--=======================================================================
|| FILE: custom_posts.php
===========================================================================
|| WordPress can hold and display many different types of content. A single item of such a content is generally called a post, although post is also a specific post type.
|| Internally, all the post types are stored in the same place, in the wp_posts database table, but are differentiated by a column called post_type.
===========================================================================
|| Item template:
||
$labels = array(
	'name' => _x('{Post name}', 'post type general name'),
	'singular_name' => _x('{Post name}', 'post type singular name'),
	'add_new' => _x('Dodaj nowy', '{Post slug}'),
	'add_new_item' => __('Dodaj nową pozycję'),
	'edit_item' => __('Edytuj pozycję'),
	'new_item' => __('Nowa pozycja'),
	'all_items' => __('Wszystkie pozycje'),
	'view_item' => __('Zobacz pozycję'),
	'search_items' => __('Szukaj pozycji'),
	'not_found' =>  __('Nie znaleziono'),
	'not_found_in_trash' => __('Nie znaleziono w koszu'),
	'parent_item_colon' => '',
	'menu_name' => __('{Post name}')
);
$args = array(
	'labels' => $labels,
	// Show url in post edit
	'public' => true,
	'publicly_queryable' => true,
	'show_ui' => true,
	'show_in_menu' => true,
	// Path to your icon { Best: 12x12 }
	'menu_icon'           => '/wp-content/uploads/icons/icon.png',
	'query_var' => true,
	'rewrite' => array(
		'slug' => '{Post slug}'
	),
	'capability_type' => 'post',
	'has_archive' => true,
	'hierarchical' => false,
	// Best for many posts
	'menu_position' => 35,
	'supports' => array( 'title', 'editor', 'thumbnail', 'custom-fields' )
);
register_post_type('{Post slug}', $args);
||
||
===========================================================================
|| Explains
||
supports - feature to add
	'title'
	'editor' (content)
	'author'
	'thumbnail' (featured image) (current theme must also support Post Thumbnails)
	'excerpt'
	'trackbacks'
	'custom-fields'
	'comments' (also will see comment count balloon on edit screen)
	'revisions' (will store revisions)
	'page-attributes' (menu order) (hierarchical must be true) (the page template selector is only available for the page post type)
	'post-formats' add post formats, see Post Formats
||
||
menu_position - positions for Core Menu Items
	2 Dashboard
	4 Separator
	5 Posts
	10 Media
	15 Links
	20 Pages
	25 Comments
	59 Separator
	60 Appearance
	65 Plugins
	70 Users
	75 Tools
	80 Settings
	99 Separator
||
||
==========================================================================->

<?php

function create_custom_posts() {

	// Add here

}

add_action( 'init', 'create_custom_posts' );

?>