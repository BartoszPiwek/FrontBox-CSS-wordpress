<?php
/*=========================================================================
|| FILE: _custom_wysiwyg.php
===========================================================================
|| The Quicktags API allows you to include additional buttons in the Text 
|| (HTML) mode of the WordPress editor.
===========================================================================
|| Item template:
||
QTags.addButton( id, display, arg1, arg2, access_key, title, priority, instance );
||
||
|| Example:
||
QTags.addButton( 'eg_paragraph', 'p', '<p>', '</p>', 'p', 'Paragraph tag', 1 );
// Output
// <input type="button" id="qt_content_eg_paragraph" accesskey="p" class="ed_button" title="Paragraph tag" value="p">
||
||
==========================================================================*/

function frontbox_add_quicktags() {
    if (wp_script_is('quicktags')){ 
        ?>
		<script type="text/javascript">

        // Add here
        

        </script>
        <?php 
    }
}

add_action( 'admin_print_footer_scripts', 'frontbox_add_quicktags' );

?>