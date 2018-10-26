<?php

function frontbox_settings_keys_content() { ?>

<div class="wrap frontbox">

	<h2 class="title">KEYS</h2>

	<form method="post" class="frontbox-form" action="options.php">
		<?php settings_fields( 'frontbox_settings_keys' ); ?>
		<?php do_settings_sections( 'frontbox_settings_keys' ); ?>

		<table class="form-table">

			<tr>
				<th scope="row">Google Maps</th>
				<td>
					<fieldset>

						<input type="text" class="large-text code" id="google-maps" name="google-maps" value="<?php if(get_option('google-maps')) { echo get_option('google-maps'); } ?>" />

					</fieldset>
				</td>
			</tr>

			<tr>
				<th scope="row">Google Tag Manager</th>
				<td>
					<fieldset>

						<input type="text" class="large-text code" id="google-tag-manager" name="google-tag-manager" value="<?php if(get_option('google-tag-manager')) { echo get_option('google-tag-manager'); } ?>" />

					</fieldset>
				</td>
			</tr>

		</table>

		
		<?php submit_button(); ?>

	</form>
</div>

<?php } ?>