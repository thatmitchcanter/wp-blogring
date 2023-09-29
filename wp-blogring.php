<?php

/**
 *
 * @link              https://mitchcanter.me
 * @since             1.0.0
 * @package           Wp_Blogring
 *
 * @wordpress-plugin
 * Plugin Name:       WP BlogRing
 * Plugin URI:        https://mitchcanter.me/wp-blogring
 * Description:       A plugin to bring back the BlogRings of yore. Let's make the web weird again!
 * Version:           1.0.0
 * Author:            Mitch Canter
 * Author URI:        https://mitchcanter.me/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wp-blogring
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'WP_BLOGRING_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wp-blogring-activator.php
 */
function activate_wp_blogring() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-blogring-activator.php';
	Wp_Blogring_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wp-blogring-deactivator.php
 */
function deactivate_wp_blogring() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-blogring-deactivator.php';
	Wp_Blogring_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_wp_blogring' );
register_deactivation_hook( __FILE__, 'deactivate_wp_blogring' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wp-blogring.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_wp_blogring() {

	$plugin = new Wp_Blogring();
	$plugin->run();

}
run_wp_blogring();
