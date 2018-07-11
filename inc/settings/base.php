<?php

function frontbox_settings_base_content() { ?>

<div class="wrap frontbox">

	<h2 class="title">BASE</h2>

	<form method="post" class="frontbox-form" action="options.php">
		<?php settings_fields( 'frontbox_settings_base' ); ?>
		<?php do_settings_sections( 'frontbox_settings_base' ); ?>

		<table class="form-table">

			<tr>
				<th scope="row">Phone number</th>
				<td>
					<fieldset>

						<input type="email" class="large-text code" id="phone-number" name="phone-number" value="<?php if(get_option('phone-number')) { echo get_option('phone-number'); } ?>" />

					</fieldset>
				</td>
			</tr>

		</table>

		
		<?php submit_button(); ?>

	</form>
</div>

<?php } ?>