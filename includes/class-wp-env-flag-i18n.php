<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       http://matthewwimmer.com
 * @since      1.0.0
 *
 * @package    Wp_Env_Flag
 * @subpackage Wp_Env_Flag/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Wp_Env_Flag
 * @subpackage Wp_Env_Flag/includes
 * @author     Matthew Wimmer <hello@matthewwimmer.com>
 */
class Wp_Env_Flag_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'wp-env-flag',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
