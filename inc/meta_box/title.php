<?php

function frontbox_add_meta_title() {

    $screens = get_post_types();

    add_meta_box(
        'meta_title', // $id
        'Meta Title', // $title 
        'meta_title_callback', // $callback
         $screens,
        'side',
        'high'
    );
}
add_action( 'add_meta_boxes', 'frontbox_add_meta_title' );


function meta_title_callback( $post ) {

    echo '<p>Define a title for your HTML document.<br><strong>If empty</strong>: show post name</p>';

    wp_nonce_field( 'meta_title_nonce', 'meta_title_nonce' );  
    $value = get_post_meta( $post->ID, 'meta_title', true );
    echo '<textarea style="width:100%;" id="meta_title" name="meta_title">' . esc_attr( $value ) . '</textarea>';
}

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id
 */
function savemeta_title_meta_box_data( $post_id ) {

    // Check if our nonce is set.
    if ( ! isset( $_POST['meta_title_nonce'] ) ) {
        return;
    }

    // Verify that the nonce is valid.
    if ( ! wp_verify_nonce( $_POST['meta_title_nonce'], 'meta_title_nonce' ) ) {
        return;
    }

    // If this is an autosave, our form has not been submitted, so we don't want to do anything.
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    // Check the user's permissions.
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

    /* OK, it's safe for us to save the data now. */

    // Make sure that it is set.
    if ( ! isset( $_POST['meta_title'] ) ) {
        return;
    }

    // Sanitize user input.
    $my_data = sanitize_text_field( $_POST['meta_title'] );

    // Update the meta field in the database.
    update_post_meta( $post_id, 'meta_title', $my_data );
}

add_action( 'save_post', 'savemeta_title_meta_box_data' );

?>