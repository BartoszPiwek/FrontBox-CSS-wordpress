<?php
/*=======================================================================
|| FILE: shortcodes-readme.php
===========================================================================
|| The Shortcode API is a simple set of functions for creating WordPress shortcodes for use in posts and pages. 
|| For instance, the following shortcode (in the body of a post or page) would add a photo gallery of images attached to that post or page: [gallery]
===========================================================================
|| Item template:
||
function map_func( $atts, $content ) {
    $item = shortcode_atts( array(
		// Object[] property => value (same name)
		'lat' => 50.064041,
		'lng' => 19.929767
	), $atts );
	ob_start();
	?>
	
	

	<?php
	return ob_get_clean();
}
add_shortcode('map', 'map_func');
||
||
==========================================================================*/