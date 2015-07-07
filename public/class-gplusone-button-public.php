<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    GPlusOne_Button
 * @subpackage GPlusOne_Button/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    GPlusOne_Button
 * @subpackage GPlusOne_Button/public
 * @author     Brianna Deleasa <me@briannadeleasa.com>
 */
class GPlusOne_Button_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}


    /**
     * Enqueues our custom JS script that activates the button
     *
     * @since 1.2.0
     */
    public function enqueue_scripts() {

        wp_enqueue_script( 'gplusone-button', plugins_url( 'js/gplusone-button.js', __FILE__ ), array('jquery'), null, true );

    }

	/**
	 * Registers all shortcodes
	 */
	public function init_shortcodes() {

		add_shortcode( 'gplusone-button', array($this, 'shortcode_gplusone_button') );

	}


	/**
	 * Creates a shortcode [gplusone-button]
	 */
	public function shortcode_gplusone_button( $atts, $content = NULL ) {

      ob_start();

		$attributes = shortcode_atts( array(
			'href' => gplusone_button_get_option('href'),
			'size' => gplusone_button_get_option('size'),
			'annotation' => gplusone_button_get_option('annotation'),
			'callback' => gplusone_button_get_option('callback')
		), $atts );

		include plugin_dir_path( dirname( __FILE__ ) ) . 'public/display/shortcode-gplusone-button.php';

		$contents = ob_get_contents();

		ob_end_clean();

		return $contents;

	}

}
