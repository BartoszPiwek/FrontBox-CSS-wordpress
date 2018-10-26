<?php

function frontbox_settings_utm_switcher_update() {
	$prefix = 'phone';
	$arr_store_me = array();

	if( isset( $_POST ) ) {

		foreach ( $_POST as $key => $value ) {
			// Check if have prefix
			if ( substr( $key, 0, strlen($prefix) ) == $prefix && !endsWith($key, '_value') ) {
				// Check type & if exist
				$type = substr( $value, 0, strlen($prefix) );
				if ($type) {
					$arr_store_me[$value] = $_POST[$key . '_value'];
				}
			}
		}

		return $arr_store_me;
	}
}

function frontbox_settings_utm_switcher_content() { ?>

<div class="wrap frontbox">

	<h2 class="title">UTM SWITCHER</h2>

	<form method="post" class="frontbox-form" action="options.php">

		<?php 
			settings_fields( 'frontbox_settings_utm_switcher' );
			do_settings_sections( 'frontbox_settings_utm_switcher' );
		?>

		<table class="form-table">

			<tr>
				<th scope="row">Phone number</th>
				<td>
					<fieldset>

						<?php 
							$prefix = 'phone';
                            $settings = get_option('frontbox_settings_utm_switcher_' . $prefix); 
                            if (!$settings) {
                                $settings['default'] = "";
                            }
							if ($GLOBALS['debugger']) {
								var_dump($settings);
							}
						?>
						
						<?php
							
							function templateMain($key, $settings) {
								$output = "";
								$output .= '<label for="' . $prefix . '_' . $key . '_name">Name:&nbsp;</label>';
								$output .= '<input type="text" class="code" id="phone_' . $key . '" name="phone_' . $key . '" value="' . array_search($settings[$key], $settings) . '" />';
								$output .= '<label for="' . $prefix . '_' . $key . '">&nbsp;Value:&nbsp;</label>';
								$output .= '<input type="text" class="code" id="phone_' . $key . '_value" name="phone_' . $key . '_value" value="' . $settings[$key] . '" />';
								$output .= "<br>";
								return $output;
							}

							foreach ($settings as $key => $value) {
								echo templateMain($key, $settings);
							}
						?>
						<p><a href="#" class="button button-primary frontbox-add-new-input" value="Add field">Add next</a></p>

						
						

					</fieldset>
				</td>
			</tr>

		</table>

		
		<?php submit_button(); ?>

	</form>
</div>

<script>
    var 
    count = 0,
    prefix = '<?php echo $prefix; ?>',
    $button = jQuery(".frontbox-add-new-input");

    var createTeamplte = function( name ) {
        output = "";
        output += '<label for="' + prefix + '_' + name + '_name">Name:&nbsp;</label>';
        output += '<input type="text" class="code" id="phone_' + name + '" name="phone_' + name + '"/>';
        output += '<label for="' + prefix + '_' + name + '">&nbsp;Value:&nbsp;</label>';
        output += '<input type="text" class="code" id="phone_' + name + '_value" name="phone_' + name + '_value"/>';
        output += "<br><br>";
        return output;
    };

    $button.on("click", function(){
        var $this = jQuery(this);
        count++;

        $this.before( createTeamplte( count ) );
    });
</script>

<?php 

}