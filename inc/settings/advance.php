<?php

function frontbox_settings_advanced_content() { ?>

	<div class="wrap frontbox">

		<h2 class="title">Advanced</h2>

		<form method="post" class="frontbox-form" action="options.php">
		
			<?php settings_fields( 'frontbox_settings_advanced' ); ?>
			<?php do_settings_sections( 'frontbox_settings_advanced' ); ?>

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

							<label for="debugger">
								<input type="checkbox" id="debugger" name="debugger" value="true" <?php if(get_option('debugger') == "true") { echo "checked"; } ?> />
									Debugger
							</label>

							<br>

							<label for="admin-bar">
								<input type="checkbox" id="admin-bar" name="admin-bar" value="true" <?php if(get_option('admin-bar') == "true") { echo "checked"; } ?> />
									Show admin bar
							</label>

							<br>

							<label for="comments">
								<input type="checkbox" id="comments" name="comments" value="true" <?php if(get_option('comments') == "true") { echo "checked"; } ?> />
									Remove comments
							</label>

						</fieldset>
					</td>
				</tr>

				<tr>
					<th scope="row">Take homepage screenshot</th>
					<td>
						<fieldset>
	
							<a class="button button-primary" id="take-screenshot">Take</a>

							<script>				
								jQuery("#take-screenshot").click(function() {							
									jQuery.post( '<?php echo admin_url( 'admin-ajax.php') ?>' , {
										action: 'frontbox_screnshot',
									}, function(output, status) {
										alert(status);
									});
								});
							</script>

						</fieldset>
					</td>
				</tr>

			</table>
			
			<?php submit_button(); ?>

		</form>
	</div>

<?php } ?>