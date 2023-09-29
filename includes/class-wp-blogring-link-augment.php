<?php
/**
 * Augments the functionality of the WP Links table to accept a custom category slug that prevents collision in the term relationships table.
 *
 *
 * @package    Wp_Blogring
 * @subpackage Wp_Blogring/includes
 * @author     Mitch Canter <mitch@mitchcanter.me>
 */
class Wp_Blogring_Custom_Link_Category_Handler {
    public function __construct() {
        // Hook into the link_updated action to update the custom column
        add_action('link_updated', array($this, 'update_custom_link_category_column'), 10, 2);
    }

    // Function to save link categories to the custom column
    public function save_link_categories_to_custom_column($link_id, $categories) {
        global $wpdb;

        // Ensure the $categories parameter is an array
        if (is_array($categories)) {
            // Sanitize and serialize the array to store it as a string
            $serialized_categories = serialize($categories);

            // Update the custom column in the wp_links table
            $wpdb->update(
                $wpdb->prefix . 'links',
                array('link_category' => $serialized_categories),
                array('link_id' => $link_id),
                array('%s'), // Format for the link_category column
                array('%d')  // Format for the link_id column
            );
        }
    }

    // Function to update the custom column when a link is updated
    public function update_custom_link_category_column($link_id, $link_data) {
        // Get the associated link categories for the link
        $link_categories = wp_get_object_terms($link_id, 'link_category');

        // Extract category names from the term objects
        $category_names = array();
        foreach ($link_categories as $category) {
            $category_names[] = $category->name;
        }

        // Save the categories to the custom column
        $this->save_link_categories_to_custom_column($link_id, $category_names);
    }
}

// Instantiate the custom class
$Wp_Blogring_Custom_Link_Category_Handler = new Wp_Blogring_Custom_Link_Category_Handler();