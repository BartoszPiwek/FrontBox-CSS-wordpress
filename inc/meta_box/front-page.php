<?php

function frontbox_add_front_page() {

    global $post;

    if ( !empty( $post ) ) {

        $isFrontpage = false;
        $post_ID = $post->ID;

        /* Polylang Fix - check all frontpage pages */
        if ( is_plugin_active('polylang/polylang.php') ) {
            $langs = $GLOBALS["polylang"]->model->get_languages_list();

            foreach ($langs as $key => $value) {
                $name = $value->flag_code;
                $checkPostFrontpageID = pll_get_post(  get_option( 'page_on_front' ), $name );
    
                if ( $post_ID == $checkPostFrontpageID ) {
                    $isFrontpage = true;
                    break;
                }
            }
        }
        /* Default check fronpage */
        else {
            $front_page_ID = get_option( 'page_on_front' );

            if ( $post_ID == $front_page_ID ) {
                $isFrontpage = true;
            }
        }

        if ($isFrontpage) {
            add_meta_box(
                'front_page', // $id
                'Settings', // $title 
                'front_page_callback', // $callback
                'page',
                'normal',
                'high'
            );
        }
    }
}
add_action( 'add_meta_boxes', 'frontbox_add_front_page' );

/**
 * Insert frontend tags function 
 * @param int $post_id
 */
function front_page_callback( $post ) {

    // Add a nonce field so we can check for it later.
    wp_nonce_field( 'front_page_nonce', 'front_page_nonce' );


}

/**
 * When the post is saved, saves our custom data.
 * @param int $post_id
 */
function save_front_page_meta_box_data( $post_id ) {

}

add_action( 'save_post', 'save_front_page_meta_box_data' );

?>