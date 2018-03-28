<?php

function frontbox_meta_keywords() {
    $screens = get_post_types();
    add_meta_box(
        'meta_keywords', // $id
        'Meta Keywords', // $title 
        'meta_keywords_callback', // $callback
        $screens,
        'side'
    );
}
add_action( 'add_meta_boxes', 'frontbox_meta_keywords' );

// Insert frontend tags function
function meta_keywords_callback( $post ) {
    wp_nonce_field( 'meta_keywords', 'meta_keywords' );
    $data = get_post_meta( $post->ID, 'meta_keywords', true );
    echo '<textarea class="block-full" id="meta_keywords" name="meta_keywords">' . esc_attr( $data ) . '</textarea>';
}

// Save function
function frontbox_meta_keywords_save( $post_id ) {

    // Protect save meta
    if ( ! isset( $_POST['meta_keywords'] ) ) {
        return;
    }
    if ( ! wp_verify_nonce( $_POST['meta_keywords'], 'meta_keywords' ) ) {
        return;
    }
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {
        if ( ! current_user_can( 'edit_page', $post_id ) ) {
            return;
        }
    }
    else {
        if ( ! current_user_can( 'edit_post', $post_id ) ) {
            return;
        }
    }
    if ( ! isset( $_POST['meta_keywords'] ) ) {
        return;
    }

    // Save meta
    $data = sanitize_text_field( $_POST['meta_keywords'] );
    update_post_meta( $post_id, 'meta_keywords', $my_data );
}

add_action( 'save_post', 'frontbox_meta_keywords_save' );

?>