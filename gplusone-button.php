<?php

/**
 * @link              https://github.com/bdeleasa/gplusone-button
 * @since             1.1.0
 * @package           GPlusOne_Button
 *
 * @wordpress-plugin
 * Plugin Name:       Google Plus Button
 * Plugin URI:        https://github.com/bdeleasa/gplusone-button
 * Description:       Enables a shortcode for outputting a Google +1 button.
 * Version:           1.2.0
 * Author:            Brianna Deleasa
 * Author URI:        http://briannadeleasa.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       gplusone-button
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-gplusone-button-activator.php
 */
function activate_gplusone_button() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-gplusone-button-activator.php';
	GPlusOne_Button_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-gplusone-button-deactivator.php
 */
function deactivate_gplusone_button() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-gplusone-button-deactivator.php';
	GPlusOne_Button_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_gplusone_button' );
register_deactivation_hook( __FILE__, 'deactivate_gplusone_button' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-gplusone-button.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_GPlusOne_Button() {

	$plugin = new GPlusOne_Button();
	$plugin->run();

}
run_GPlusOne_Button();
