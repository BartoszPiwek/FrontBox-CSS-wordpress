<?php

function frontbox_settings() {
	add_submenu_page('themes.php', 'Frontbox settings', 'Frontbox settings', 'administrator', __FILE__, 'frontbox_content_settings' , plugins_url('/images/icon.png', __FILE__) );
	add_action( 'admin_init', 'frontbox_register_settings' );
}
add_action('admin_menu', 'frontbox_settings');

function frontbox_register_settings() {
	//register settings
	register_setting( 'frontbox_settings', 'version' );
}

function frontbox_content_settings() { ?>

	<div class="wrap">
		<h1>FRONTBOX SETTINGS</h1>

		<form method="post" action="options.php">
			<?php settings_fields( 'frontbox_settings' ); ?>
			<?php do_settings_sections( 'frontbox_settings' ); ?>

			<h3>Main settings</h3>
			<label for="version">Turn productive version</label>
			<input type="checkbox" name="version" value="true" <?php if(get_option('version') == "true") { echo "checked"; } ?> />
			
			<?php submit_button(); ?>

		</form>
	</div>

<?php } ?>