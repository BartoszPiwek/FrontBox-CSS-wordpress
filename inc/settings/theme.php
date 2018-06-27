<?php

function frontbox_settings() {
	/* https://developer.wordpress.org/reference/functions/add_menu_page/ */
	add_menu_page('FrontBox Menu', 'FrontBox Menu', 'administrator', 'frontbox_menu', 'frontbox_menu_settings', frontbox_admin_menu_icon("frontbox"));
	/* https://developer.wordpress.org/reference/functions/add_submenu_page/ */
	add_submenu_page('frontbox_menu', 'Form', 'Form', 'administrator', 'frontbox_menu_form', 'frontbox_menu_form' );

	add_action( 'admin_init', 'frontbox_register_settings' );
}
add_action('admin_menu', 'frontbox_settings');

/**
 * Refister settings variable
 */
function frontbox_register_settings() {

    $frontbox_register_settings = array(
        'version',
	    'admin-bar',
	    'contact-email',
	    'contact-email-message-success',
	    'contact-email-message-failed',
    );

    foreach ($frontbox_required as $value) {
        register_setting( 'frontbox_settings', $value );
    }

}

/**
 * Content for 'FrontBox Menu'
 */
function frontbox_menu_settings() { 
	?>

	<div class="wrap frontbox">

		<h2 class="title">MAIN</h2>

		<form method="post" class="frontbox-form" action="options.php">
			<?php settings_fields( 'frontbox_settings' ); ?>
			<?php do_settings_sections( 'frontbox_settings' ); ?>

			<table class="form-table">

				<tr>
					<th scope="row">Main wordpress behavior switch</th>
					<td>
						<fieldset>

							<label for="version">
								<input type="checkbox" id="version" name="version" value="true" <?php if(get_option('version') == "true") { echo "checked"; } ?> />
									Turn on productive version
							</label>

							<br>

							<label for="admin-bar">
								<input type="checkbox" id="admin-bar" name="admin-bar" value="true" <?php if(get_option('admin-bar') == "true") { echo "checked"; } ?> />
									Show admin bar
							</label>

						</fieldset>
					</td>
				</tr>

			</table>

			
			<?php submit_button(); ?>

		</form>
	</div>

<?php }

/**
 * Content for 'Form'
 */
function frontbox_menu_form() { ?>

	<div class="wrap frontbox">

		<h2 class="title">FORMS</h2>

		<form method="post" class="frontbox-form" action="options.php">
			<?php settings_fields( 'frontbox_settings' ); ?>
			<?php do_settings_sections( 'frontbox_settings' ); ?>

			<table class="form-table">

				<tr>
					<th scope="row">Global</th>
					<td>
						<fieldset>

							<label for="contact-email">
								Send filled forms to adress email:
							</label>
							<input type="email" class="large-text code" id="contact-email" name="contact-email" value="<?php if(get_option('contact-email')) { echo get_option('contact-email'); } ?>" />

							<br>

							<label for="contact-email-message-success">
								Success send message
							</label>
							<input type="text" class="large-text code" id="contact-email-message-success" name="contact-email-message-success" value="<?php if(get_option('contact-email-message-success')) { echo get_option('contact-email-message-success'); } ?>" />

							<br>

							<label for="contact-email-message-failed">
								Failed send message
							</label>
							<input type="text" class="large-text code" id="contact-email-message-failed" name="contact-email-message-failed" value="<?php if(get_option('contact-email-message-failed')) { echo get_option('contact-email-message-failed'); } ?>" />

						</fieldset>
					</td>
				</tr>

			</table>

			
			<?php submit_button(); ?>

		</form>
	</div>

<?php } ?>