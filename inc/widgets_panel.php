<!--=======================================================================
|| FILE: widgets.php
===========================================================================
|| WordPress Widgets add content and features to your Sidebars. Examples are the default widgets that come 
|| with WordPress; for Categories, Tag cloud, Search, etc. Plugins will often add their own widgets.
===========================================================================
|| Item template:
||
register_sidebar( array(
		'name'          => __( '{Widget name}', '{Theme slug}' ),
		// ID should be lowercase
		'id'            => '',
		'class'         => '',
		// Shown on widget management screen
		'description'   => '',
		'before_widget' => '<side id="%1$s" class="widget %2$s">',
		'after_widget'  => '</side>',
		'before_title'  => '<h2 class="widget__title %2$s__title">',
		'after_title'   => '</h2>',
	) );
||
||
=========================================================================->

<?php

add_theme_support( 'customize-selective-refresh-widgets' );

function wordpress_widgets_init() {

	// Add here

}

add_action( 'widgets_init', 'wordpress_widgets_init' );

?>
