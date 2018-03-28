<?php

function frontbox_meta_description() {
    $screens = get_post_types();
    add_meta_box(
        'meta_description', // $id
        'Meta Description', // $title 
        'meta_description_callback', // $callback
         $screens
    );
}
add_action( 'add_meta_boxes', 'frontbox_meta_description' );

// Insert frontend tags function
function meta_description_callback( $post ) {
    wp_nonce_field( 'meta_description', 'meta_description' );
    $data = get_post_meta( $post->ID, 'meta_description', true );
    echo '<textarea class="block-full" id="meta_description" name="meta_description">' . esc_attr( $data ) . '</textarea>';
}

// Save function
function frontbox_meta_description_save( $post_id ) {

    // Protect save meta
    if ( ! isset( $_POST['meta_description'] ) ) {
        return;
    }
    if ( ! wp_verify_nonce( $_POST['meta_description'], 'meta_description' ) ) {
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
    if ( ! isset( $_POST['meta_description'] ) ) {
        return;
    }

    // Save meta
    $data = sanitize_text_field( $_POST['meta_description'] );
    update_post_meta( $post_id, 'meta_description', $my_data );
}

add_action( 'save_post', 'frontbox_meta_description_save' );

?>