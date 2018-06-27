<?php

function row($atts, $content = null) {

    $a = shortcode_atts( array(
        'class' => 'class',
    ), $atts );

    $content = do_shortcode($content);
    $content = wpautop($content, false);
    $content = do_shortcode($content);

    return '<div class="' . $a['class'] . '">'. $content . '</div>';
}
add_shortcode('row', 'row');

function col($atts, $content = null) {

    $a = shortcode_atts( array(
        'class' => 'class',
    ), $atts );

    $content = do_shortcode($content);
    $content = wpautop($content, false);
    $content = do_shortcode($content);


    return '<div class="' . $a['class'] . '">'. $content . '</div>';
}
add_shortcode('col', 'col');

?>