<?php

/**
 * Include files 
 */
$frontbox_required = array(
	'settings/functions',
	'settings/main',
	'settings/forms',
);
frontbox_required($frontbox_required);

/**
 * Register settings
 */
function frontbox_settings_register() {
	register_setting( 'frontbox_settings', 'version' );
	register_setting( 'frontbox_settings', 'admin-bar' );

	register_setting( 'frontbox_settings_forms', 'contact-email' );
	register_setting( 'frontbox_settings_forms', 'contact-email-message-success' );
    register_setting( 'frontbox_settings_forms', 'contact-email-message-failed' );
    
	register_setting( 'frontbox_settings_base', 'phone-number' );
}

/**
 * Append FrontBox settings menu
 */
function frontbox_settings_main() {
	add_action( 'admin_init', 'frontbox_settings_register' );
    add_menu_page('FrontBox Menu', 'FrontBox Menu', 'administrator', 'frontbox_menu', 'frontbox_settings_main_content', frontbox_admin_menu_icon("frontbox"));
	add_submenu_page( 'frontbox_menu', 'Forms', 'Forms', 'administrator', 'frontbox_settings_forms_content', 'frontbox_settings_forms_content');
	add_submenu_page( 'frontbox_menu', 'Base', 'Base', 'administrator', 'frontbox_settings_base_content', 'frontbox_settings_base_content');
}
add_action('admin_menu', 'frontbox_settings_main');

?>