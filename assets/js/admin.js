jQuery(document).ready(function ($) {

    // Uploading files
    var file_frame;

    jQuery.fn.upload_listing_image = function (button) {

        // If the media frame already exists, reopen it.
        if (file_frame) {
            file_frame.open();
            return;
        }

        // Create the media frame.
        file_frame = wp.media.frames.file_frame = wp.media({
            title: jQuery(this).data('uploader_title'),
            button: {
                text: jQuery(this).data('uploader_button_text'),
            },
            multiple: false
        });

        // When an image is selected, run a callback.
        file_frame.on('select', function () {
            var attachment = file_frame.state().get('selection').first().toJSON(),
                $this = jQuery(button),
                output,
                $container = $this.parent(),
                $url = $container.find(".js_upload_image_src"),
                $img = $container.find(".js_upload_image_image");

            $img.attr('src', attachment.url).show();
            output = attachment.url.replace(/^.*\/\/[^\/]+/, '');
            $url.val(output);
        });

        // Finally, open the modal
        file_frame.open();
    };

    jQuery('.js_upload_image_container').on('click', function (event) {
        event.preventDefault();
        jQuery.fn.upload_listing_image(jQuery(this));
    });

    jQuery('.js_upload_image_remove').on('click', function (event) {
        event.preventDefault();
        var $this = jQuery(this),
            $container = $this.parent(),
            $url = $container.find(".js_upload_image_src");
        $img = $container.find(".js_upload_image_image");

        $img.hide();
        $url.val('');
    });

});