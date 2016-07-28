<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://matthewwimmer.com
 * @since      1.0.0
 *
 * @package    Wp_Env_Flag
 * @subpackage Wp_Env_Flag/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

<div class="wrap">
    <h2><?php echo esc_html(get_admin_page_title()); ?></h2>
	<form method="post" name="wp_env_flag_options" action="options.php">
		<?php

			// Grab all options
			$options = get_option( $this->plugin_name );

			// Hostname options
			$dev = str_rot13($options['dev']);
			$dev_color = $options['dev_color'];

			$staging = str_rot13($options['staging']);
			$staging_color = $options['staging_color'];

			$live = str_rot13($options['live']);
			$live_color = $options['live_color'];

			// Create hidden fields and save options
			settings_fields($this->plugin_name);
			do_settings_sections($this->plugin_name);

			?>
		<script>
			// Allow hostname input to be populated with current server
			function setEnv(field) {
	 			var current = document.getElementById(field);
	 			current.value = window.location.hostname;
	 		}
		</script>
		<fieldset>
			<legend class="screen-reader-text">
				<span>Provide server hostname for development environment</span>
			</legend>
			<label for="<?php echo $this->plugin_name; ?>-dev">
				<h4><?php esc_attr_e('Development Environment', $this->plugin_name); ?></h4>
				<input class="regular-text" type="text"
					id="<?php echo $this->plugin_name; ?>-dev"
					name="<?php echo $this->plugin_name; ?>[dev]"
					value="<?php if (!empty($dev)) echo $dev; ?>"/>
				<br>
				<a href="#" onclick="setEnv('<?php echo $this->plugin_name . "-dev"; ?>')">Set to current host</a>
			</label>
			<br><br>
			<legend class="screen-reader-text">
				<span><?php _e('Development environment color', $this->plugin_name);?></span>
			</legend>
			<label for="<?php echo $this->plugin_name;?>-dev_color">
				<input type="text" class="<?php echo $this->plugin_name;?>-color-picker"
					id="<?php echo $this->plugin_name;?>-dev_color"
					name="<?php echo $this->plugin_name;?>[dev_color]"
					value="<?php echo $dev_color; ?>"/>
			</label>
		</fieldset>

		<fieldset>
			<legend class="screen-reader-text">
				<span>Provide server hostname for staging environment</span>
			</legend>
			<label for="<?php echo $this->plugin_name; ?>-staging">
				<h4><?php esc_attr_e('Staging Environment', $this->plugin_name); ?></h4>
				<input class="regular-text" type="text"
					id="<?php echo $this->plugin_name; ?>-staging"
					name="<?php echo $this->plugin_name; ?>[staging]"
					value="<?php if (!empty($staging)) echo $staging; ?>"/>
				<br>
				<a href="#" onclick="setEnv('<?php echo $this->plugin_name . "-staging"; ?>')">Set to current host</a>
			</label>
			<br><br>
			<legend class="screen-reader-text">
				<span><?php _e('Staging environment color', $this->plugin_name);?></span>
			</legend>
			<label for="<?php echo $this->plugin_name;?>-staging_color">
				<input type="text" class="<?php echo $this->plugin_name;?>-color-picker"
					id="<?php echo $this->plugin_name;?>-staging_color"
					name="<?php echo $this->plugin_name;?>[staging_color]"
					value="<?php echo $staging_color; ?>"/>
			</label>
		</fieldset>
		<fieldset>
			<legend class="screen-reader-text">
				<span>Provide server hostname for live environment</span>
			</legend>
			<label for="<?php echo $this->plugin_name; ?>-live">
				<h4><?php esc_attr_e('Live Environment', $this->plugin_name); ?></h4>
				<input class="regular-text" type="text"
					id="<?php echo $this->plugin_name; ?>-live"
					name="<?php echo $this->plugin_name; ?>[live]"
					value="<?php if (!empty($live)) echo $live; ?>"/>
				<br>
				<a href="#" onclick="setEnv('<?php echo $this->plugin_name . "-live"; ?>')">Set to current host</a>
			</label>
			<br><br>
			<legend class="screen-reader-text">
				<span><?php _e('Live environment color', $this->plugin_name);?></span>
			</legend>
			<label for="<?php echo $this->plugin_name;?>-live_color">
				<input type="text" class="<?php echo $this->plugin_name;?>-color-picker"
					id="<?php echo $this->plugin_name;?>-live_color"
					name="<?php echo $this->plugin_name;?>[live_color]"
					value="<?php echo $live_color; ?>"/>
			</label>
		</fieldset>
		<?php submit_button( "Save Environment Settings" ); ?>
	</form>
</div>