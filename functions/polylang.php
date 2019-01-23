<?php
/**
 * Polylang
 */

if ( is_plugin_active('polylang/polylang.php') ) {

    /* Duplicate post content from original across translation */
    function polylang_copy_content( $content ) {    
        if ( isset( $_GET['from_post'] ) ) {
            $my_post = get_post( $_GET['from_post'] );
            if ( $my_post )
                return $my_post->post_content;
        }
        return $content;
    }
    add_filter( 'default_content', 'polylang_copy_content' );

    /* Duplicate post title from original across translation */
    function polylang_editor_title( $title ) {    
        if ( isset( $_GET['from_post'] ) ) {
            $my_post = get_post( $_GET['from_post'] );
            if ( $my_post )
                return $my_post->post_title;
        }
        return $title;
    }
    add_filter( 'default_title', 'polylang_editor_title' );
    
}

?>