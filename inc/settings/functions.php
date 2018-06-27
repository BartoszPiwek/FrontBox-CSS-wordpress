<?php 

/**
 * Remove admin bar
 */
$showAdminBar = get_option('admin-bar');
if (!$showAdminBar) {
	add_action('after_setup_theme', 'remove_admin_bar');
	function remove_admin_bar() {
	  show_admin_bar(false);
	}
}

?>