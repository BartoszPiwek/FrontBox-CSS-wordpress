<?php

function frontbox_shortcode_icon($atts, $content = null) {

  $a = shortcode_atts( array(
      'src' => 'src',
  ), $atts );

  $icon = file_get_contents( get_template_directory() . '/assets/images/svg/' . $atts['src'] . '.svg');
  $icon = str_replace("<svg","<svg class='icon " . $atts['class'] ."'",$icon);

  return $icon;
}
add_shortcode('svg', 'frontbox_shortcode_icon');

?>