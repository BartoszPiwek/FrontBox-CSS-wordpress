<?php

function custom_create_post_types() {

    
	// $labels = array(
	// 	'name' => _x('NAME', 'post type general name'),
	// 	'singular_name' => _x('NAME', 'post type singular name'),
	// 	'add_new' => _x('Dodaj nowy', 'SLUG'),
	// 	'add_new_item' => __('Dodaj nową pozycję'),
	// 	'edit_item' => __('Edytuj pozycję'),
	// 	'new_item' => __('Nowa pozycja'),
	// 	'all_items' => __('Wszystkie pozycje'),
	// 	'view_item' => __('Zobacz pozycję'),
	// 	'search_items' => __('Szukaj pozycji'),
	// 	'not_found' =>  __('Nie znaleziono'),
	// 	'not_found_in_trash' => __('Nie znaleziono w koszu'),
	// 	'parent_item_colon' => '',
	// 	'menu_name' => __('NAME')
	// );
	// $args = array(
	// 	'labels' => $labels,
	// 	'public' => true,
	// 	'publicly_queryable' => true,
	// 	'show_ui' => true,
	// 	'show_in_menu' => true,
	// 	'query_var' => true,
	// 	'rewrite' => array(
	// 		'slug' => 'SLUG'
	// 	),
	// 	'capability_type' => 'post',
	// 	'has_archive' => true,
	// 	'hierarchical' => false,
	// 	'menu_position' => 5,
	// 	'supports' => array( 'title', 'editor', 'thumbnail', 'custom-fields' )
	// );
    // register_post_type('SLUG', $args);

}

add_action( 'init', 'custom_create_post_types' );

?>