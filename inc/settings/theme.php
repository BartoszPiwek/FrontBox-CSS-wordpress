<?php

function frontbox_settings_main_content() { ?>

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

<?php } ?>