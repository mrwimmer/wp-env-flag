<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://matthewwimmer.com
 * @since      1.0.0
 *
 * @package    Wp_Env_Flag
 * @subpackage Wp_Env_Flag/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Wp_Env_Flag
 * @subpackage Wp_Env_Flag/admin
 * @author     Matthew Wimmer <hello@matthewwimmer.com>
 */
class Wp_Env_Flag_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wp_Env_Flag_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wp_Env_Flag_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wp-env-flag-admin.css', array( 'wp-color-picker' ), $this->version, 'all' );
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wp_Env_Flag_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wp_Env_Flag_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wp-env-flag-admin.js', array( 'jquery', 'wp-color-picker' ), $this->version, false );
	}

	/**
	 * Register the administration menu for this plugin into the WordPress Dashboard menu.
	 *
	 * @since    1.0.0
	 */

	public function add_plugin_admin_menu() {

	    /*
	     * Add a settings page for this plugin to the Settings menu.
	     *
	     */
	    add_options_page( 'WP Environment Flag', 'Environment', 'manage_options', $this->plugin_name, array($this, 'display_plugin_setup_page')
	    );
	}

	/**
	 * Add settings action link to the plugins page.
	 *
	 * @since    1.0.0
	 */
 
	public function add_action_links( $links ) {
	   /*
	    *  Documentation : https://codex.wordpress.org/Plugin_API/Filter_Reference/plugin_action_links_(plugin_file_name)
	    */
	   $settings_link = array(
	    '<a href="' . admin_url( 'options-general.php?page=' . $this->plugin_name ) . '">' . __('Settings', $this->plugin_name) . '</a>',
	   );
	   return array_merge(  $settings_link, $links );

	}

	/**
	 * Render the settings page for this plugin.
	 *
	 * @since    1.0.0
	 */
	 
	public function display_plugin_setup_page() {
	    include_once( 'partials/wp-env-flag-admin-display.php' );
	}

	/**
	 * Register the settings for this page in the database.
	 *
	 * @since    1.0.0
	 */

	public function options_update() {
		register_setting($this->plugin_name, $this->plugin_name, array($this, 'validate'));
	}

	/**
	 * Sanitize the contents of the text inputs.
	 *
	 * @since    1.0.0
	 */

	public function validate($input) {
		// All hostname inputs
		$valid = array();

		// Sanitize
		$valid['dev'] = str_rot13(sanitize_text_field( $input['dev'] ));
		$valid['staging'] = str_rot13(sanitize_text_field( $input['staging'] ));
		$valid['live'] = str_rot13(sanitize_text_field( $input['live'] ));

		$valid['dev_color'] = (isset($input['dev_color']) && !empty($input['dev_color'])) ? sanitize_text_field($input['dev_color']) : '';

		if ( !empty($valid['dev_color']) && !preg_match( '/^#[a-f0-9]{6}$/i', $valid['dev_color']  ) ) {
			// if user inserts a HEX color with #
			add_settings_error(
				'dev_color', // Setting title
				'dev_color_texterror', // Error ID
				'Please enter a valid hex value color', // Error message
				'error' // Type of message
			);
		}

		$valid['staging_color'] = (isset($input['staging_color']) && !empty($input['staging_color'])) ? sanitize_text_field($input['staging_color']) : '';

		if ( !empty($valid['staging_color']) && !preg_match( '/^#[a-f0-9]{6}$/i', $valid['staging_color']  ) ) {
			// if user inserts a HEX color with #
			add_settings_error(
				'staging_color', // Setting title
				'staging_color_texterror', // Error ID
				'Please enter a valid hex value color', // Error message
				'error' // Type of message
			);
		}

		$valid['live_color'] = (isset($input['live_color']) && !empty($input['live_color'])) ? sanitize_text_field($input['live_color']) : '';

		if ( !empty($valid['live_color']) && !preg_match( '/^#[a-f0-9]{6}$/i', $valid['live_color']  ) ) {
			// if user inserts a HEX color with #
			add_settings_error(
				'live_color', // Setting title
				'live_color_texterror', // Error ID
				'Please enter a valid hex value color', // Error message
				'error' // Type of message
			);
		}

		return $valid;
	}

	/**
	 * Place the signal in the top right toolbar and apply chosen colors
	 *
	 * @since    1.0.0
	 */

	public function toolbar_flag( $wp_admin_bar ) {

		// Grab all options
		$options = get_option( $this->plugin_name );
		$host = $_SERVER['HTTP_HOST'];

		// Hostname options
		$dev = str_rot13($options['dev']);
		$dev_color = $options['dev_color'];

		$staging = str_rot13($options['staging']);
		$staging_color = $options['staging_color'];

		$live = str_rot13($options['live']);
		$live_color = $options['live_color'];

		switch ($host) {
			case $dev:
			$title = $dev;
			$color = $dev_color;
			break;
			case $staging:
			$title = $staging;
			$color = $staging_color;
			break;
			case $live:
			$title = $live;
			$color = $live_color;
			break;
		}

		$args = array(
			'id'    => 'wp_env_flag_toolbar',
			'title' => '<span class="ab-icon"></span><span class="ab-label">' . $title . '</span>',
			'parent' => 'top-secondary',
			'meta' => array( 
				'class' => 'wp-env-flag-toolbar',
				'html' => '<style>.wp-env-flag-toolbar { background-color: ' . $color . ' !important; }</style>'
			),
		);
		$wp_admin_bar->add_node( $args );
	}
}
