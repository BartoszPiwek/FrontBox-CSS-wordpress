<?php

function frontbox_add_meta_seo() {

    global $post;

    /* Show only for viewable posts */
    if( is_post_type_viewable($post->post_type) ) {
        $screens = get_post_types();
    
        add_meta_box(
            'meta_seo', // $id
            'Meta SEO', // $title 
            'meta_seo_callback', // $callback
            $screens,
            'side',
            'high'
        );
    }

}
add_action( 'add_meta_boxes', 'frontbox_add_meta_seo' );


function meta_seo_callback( $post ) {

    wp_nonce_field( 'meta_seo_nonce', 'meta_seo_nonce' );  

    $seoTitle = get_post_meta( $post->ID, 'seoTitle', true );
    ?>
        <label for="seoTitle">
            <h3>Title Tag</h3>
            Define a title for your HTML document.
            <strong>If empty: show post name</strong>
        </label>
        <p><i><?php echo htmlspecialchars("<title>Example Title</title>")?></i></p>
        <textarea style="width:100%;" id="seoTitle" name="seoTitle"><?php echo esc_attr( $seoTitle ) ?></textarea>
    <?php

    $seoDescription = get_post_meta( $post->ID, 'seoDescription', true );
    ?>
        <label for="seoDescription">
            <h3>Description Tag</h3>
            Define a description of your web page.
            <strong>If empty: show post excerpt</strong>
        </label>
        <p><i><?php echo htmlspecialchars("<meta name='description' content='Example Description'>")?></i></p>
        <textarea style="width:100%;" id="seoDescription" name="seoDescription"><?php echo esc_attr( $seoDescription ) ?></textarea>
    <?php

    $seoKeywords = get_post_meta( $post->ID, 'seoKeywords', true );
    ?>
        <label for="seoKeywords">
            <h3>Keywords Tag</h3>
            Define keywords for search engines.
        </label>
        <p><i><?php echo htmlspecialchars("<meta name='keywords' content='example, tag'>")?></i></p>
        <textarea style="width:100%;" id="seoKeywords" name="seoKeywords"><?php echo esc_attr( $seoKeywords ) ?></textarea>
    <?php
}

/**
 * When the post is saved, saves our custom data.
 */
function savemeta_seo_meta_box_data( $post_id ) {

    // Check if our nonce is set.
    if ( ! isset( $_POST['meta_seo_nonce'] ) ) {
        return;
    }
    // Verify that the nonce is valid.
    if ( ! wp_verify_nonce( $_POST['meta_seo_nonce'], 'meta_seo_nonce' ) ) {
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
    update_post_meta( $post_id, 'seoTitle', sanitize_text_field( $_POST['seoTitle']) );
    update_post_meta( $post_id, 'seoDescription', sanitize_text_field( $_POST['seoDescription']) );
    update_post_meta( $post_id, 'seoKeywords', sanitize_text_field( $_POST['seoKeywords']) );
}

add_action( 'save_post', 'savemeta_seo_meta_box_data' );

?>