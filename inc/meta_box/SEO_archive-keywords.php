<?php

function frontbox_meta_seo_archive_keywords() {
    $screens = get_post_types();
    add_meta_box(
        'meta_seo_archive_keywords', // $id
        'Meta Keywords', // $title 
        'meta_seo_archive_keywords_callback', // $callback
        array (
            'seo-archive',
        ),
		'side',
        'high'
    );
}
add_action( 'add_meta_boxes', 'frontbox_meta_seo_archive_keywords' );

// Insert frontend tags function
function meta_seo_archive_keywords_callback( $post ) {

    wp_nonce_field( 'seo_archive_keywords_once', 'seo_archive_keywords_once' );

    $seo_archive_keywords = get_post_meta( $post->ID, 'seo_archive_keywords', true );
    echo '<input type="text" class="large-text code" id="seo_archive_keywords" name="seo_archive_keywords" value="' .  esc_attr( $seo_archive_keywords ) . '">';
}

/**
 * When the post is saved, saves our custom data.
 */
function savemeta_seo_meta_seo_archive_keywords_match( $post_id ) {

    // Check if our nonce is set.
    if ( ! isset( $_POST['seo_archive_keywords_once'] ) ) {
        return;
    }
    // Verify that the nonce is valid.
    if ( ! wp_verify_nonce( $_POST['seo_archive_keywords_once'], 'seo_archive_keywords_once' ) ) {
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

    // Update the meta field in the database.
    update_post_meta( $post_id, 'seo_archive_keywords', sanitize_text_field( $_POST['seo_archive_keywords']) );
}

add_action( 'save_post', 'savemeta_seo_meta_seo_archive_keywords_match' );

?>