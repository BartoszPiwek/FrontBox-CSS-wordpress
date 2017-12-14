<?php
/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */

// Add theme support for selective refresh for widgets.
add_theme_support( 'customize-selective-refresh-widgets' );

function wordpress_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Lewa strona', 'blik' ),
		'id'            => 'footer__left',
		'before_widget' => '<div class="widget">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="footer__title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Portale społecznościowe', 'blik' ),
		'id'            => 'footer__social',
		'before_widget' => '<div class="widget">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="footer__title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Prawa strona', 'blik' ),
		'id'            => 'footer__right',
		'before_widget' => '<div class="widget">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="footer__title">',
		'after_title'   => '</h2>',
	) );
}
?>
