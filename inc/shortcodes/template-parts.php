<?php
function wordpress_shortcode_template($atts, $content = null) {
  $atts = shortcode_atts( array(
            'name' => 'name',
          ), $atts );
  $output = "";

  switch ($atts["name"]) {
    case 'agents':

      $output .= '<div class="wysiwyg wysiwyg-agents">' . $content  . '</div>';

      break;
  }

  return $output;
}

add_shortcode('template-parts', 'wordpress_shortcode_template');
?>
