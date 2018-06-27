<?php

function map($atts, $content = null) {
    
    function init_maps() {
        ?>
            <script src="https://maps.googleapis.com/maps/api/js?key=<?php echo get_option('key_map'); ?>"> </script>
        <?php
    }
    add_action( 'wp_footer', 'init_maps' );

    return '<div id="js_map" class="box-map sm_full-size"><div class="animation-boucing-dots absolute-center"><span></span><span></span><span></span></div></div>';
}
add_shortcode('map', 'map');

?>