<?php

/**
 * Include files 
 */
$frontbox_required = array(
	'functions',
	'advance',
	'base',
	'theme',
	'forms',
	'keys',
	'utm_switcher',
);
frontbox_required($frontbox_required, 'inc/settings');

/**
 * Register settings
 */
function frontbox_settings_register() {

	/* Advanced */
	register_setting( 'frontbox_settings_advanced', 'version' );
	register_setting( 'frontbox_settings_advanced', 'comments' );
	register_setting( 'frontbox_settings_advanced', 'admin-bar' );
	register_setting( 'frontbox_settings_advanced', 'debugger' );

	/* Forms */
	register_setting( 'frontbox_settings_forms', 'contact-email' );
	register_setting( 'frontbox_settings_forms', 'contact-email-message-success' );
    register_setting( 'frontbox_settings_forms', 'contact-email-message-failed' );
	
	/* Base */
	register_setting( 'frontbox_settings_base', 'phone-number' );

	/* Keys */
	register_setting( 'frontbox_settings_keys', 'google-maps' );
	register_setting( 'frontbox_settings_keys', 'google-tag-manager' );

	/* UTM Switcher */
	register_setting( 
		'frontbox_settings_utm_switcher',
		'frontbox_settings_utm_switcher_phone',
		array(
			'type' => 'string',
			'sanitize_callback' => 'frontbox_settings_utm_switcher_update',
		)
	);

}

/**
 * Append FrontBox settings menu
 */
function frontbox_settings_main() {
	add_action( 'admin_init', 'frontbox_settings_register' );
    add_menu_page('FrontBox Menu', 'FrontBox Menu', 'administrator', 'frontbox_menu', 'frontbox_settings_main_content', frontbox_admin_menu_icon("frontbox"));
	add_submenu_page( 'frontbox_menu', 'Forms', 'Forms', 'administrator', 'frontbox_settings_forms_content', 'frontbox_settings_forms_content');
	add_submenu_page( 'frontbox_menu', 'Keys', 'Keys', 'administrator', 'frontbox_settings_keys_content', 'frontbox_settings_keys_content');
	add_submenu_page( 'frontbox_menu', 'Base', 'Base', 'administrator', 'frontbox_settings_base_content', 'frontbox_settings_base_content');
	add_submenu_page( 'frontbox_menu', 'UTM Switcher', 'UTM Switcher', 'administrator', 'frontbox_settings_utm_switcher_content', 'frontbox_settings_utm_switcher_content');
	add_submenu_page( 'frontbox_menu', 'Advanced', 'Advanced', 'administrator', 'frontbox_settings_advanced_content', 'frontbox_settings_advanced_content');
}
add_action('admin_menu', 'frontbox_settings_main');

?>