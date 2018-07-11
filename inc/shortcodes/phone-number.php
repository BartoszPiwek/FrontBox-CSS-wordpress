<?php

function frontbox_shortcode_phone_number($atts, $content = null) {

    $a = shortcode_atts( array(
        'type' => 'type',
    ), $atts );

    $phone_num = get_option('phone-number');

    if ($a['type'] == 'inline' ) {
        $phone_num = trim($phone_num);
   }
   return $phone_num; 
    
}
add_shortcode('phone', 'frontbox_shortcode_phone_number');

?>