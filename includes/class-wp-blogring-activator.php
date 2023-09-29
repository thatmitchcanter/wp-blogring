<?php

/**
 * Fired during plugin activation
 *
 * @link       https://mitchcanter.me
 * @since      1.0.0
 *
 * @package    Wp_Blogring
 * @subpackage Wp_Blogring/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Wp_Blogring
 * @subpackage Wp_Blogring/includes
 * @author     Mitch Canter <mitch@mitchcanter.me>
 */
class Wp_Blogring_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		global $wpdb; // WordPress database object

		// Define the SQL query to add custom columns to wp_links table
		$sql = "
			ALTER TABLE {$wpdb->prefix}links
			ADD COLUMN link_category VARCHAR(255);
		";
	
		// Run the SQL query
		$wpdb->query($sql);
	}

}
