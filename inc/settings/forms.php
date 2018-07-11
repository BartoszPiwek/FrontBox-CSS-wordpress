<?php

function frontbox_settings_forms_content() { ?>

<div class="wrap frontbox">

	<h2 class="title">FORMS</h2>

	<form method="post" class="frontbox-form" action="options.php">
		<?php settings_fields( 'frontbox_settings_forms' ); ?>
		<?php do_settings_sections( 'frontbox_settings_forms' ); ?>

		<table class="form-table">

			<tr>
				<th scope="row">Mailing</th>
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