<?php

/**
 * Fired during plugin deactivation
 *
 * @link       https://mitchcanter.me
 * @since      1.0.0
 *
 * @package    Wp_Blogring
 * @subpackage Wp_Blogring/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Wp_Blogring
 * @subpackage Wp_Blogring/includes
 * @author     Mitch Canter <mitch@mitchcanter.me>
 */
class Wp_Blogring_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {
		// global $wpdb; // WordPress database object
	
		// // Define the SQL query to remove the custom column from wp_links table
		// $sql = "
		// 	ALTER TABLE {$wpdb->prefix}links
		// 	DROP COLUMN link_category;
		// ";
	
		// // Run the SQL query
		// $wpdb->query($sql);
	}

}
