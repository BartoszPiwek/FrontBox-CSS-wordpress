<?php

function frontbox_settings_main_content() { ?>

	<div class="wrap frontbox">

		<h2 class="title">MAIN</h2>

		<form method="post" class="frontbox-form" action="options.php">

			<table class="form-table">

				<tr>
					<th scope="row">Take homepage screenshot</th>
					<td>
						<fieldset>
	
							<a class="button button-primary" id="take-screenshot">Take</a>

							<script>
								jQuery("#take-screenshot").click(function() {							
									jQuery.post( '<?php echo admin_url( 'admin-ajax.php') ?>' , {
										action: 'frontbox_screnshot',
									}, function(msg) {
										window.setTimeout(function() {
											alert(msg);
										}, 1000);
									});
								});
							</script>

						</fieldset>
					</td>
				</tr>

			</table>

		</form>
	</div>

<?php } ?>