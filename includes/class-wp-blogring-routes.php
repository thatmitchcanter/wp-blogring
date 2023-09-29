<?php 
/**
 * Register all actions and filters for the plugin.
 *
 * @package    Wp_Blogring
 * @subpackage Wp_Blogring/includes
 * @author     Mitch Canter <mitch@mitchcanter.me>
 */
class Wp_Blogring_Routes {

    /**
     * Init
     */
    public function __construct() {
        add_action('rest_api_init', array($this, 'register_random_link_api_route'));
    }

    /**
     * Callback function to handle the Random Link API request.
     *
     * @since    1.0.0
     */
    public function random_link_redirect_callback($request) {
        global $wpdb;

        // Query the wp_links table to get a random link
        $random_link = $wpdb->get_var("SELECT link_url FROM {$wpdb->links} ORDER BY RAND() LIMIT 1");

        if ($random_link) {
            // Perform the redirection
            wp_redirect($random_link);
            exit;
        } else {
            return new WP_Error('no_random_link', 'No random link found', array('status' => 404));
        }
    }

    /**
     * Callback function to handle the Random Category Link API request.
     *
     * @since    1.0.0
     */
    public function random_link_redirect_category_callback($request) {
        global $wpdb;

        // Get the category ID from the request
        $category_id = $request->get_param('category_id');

        // Query the wp_links table to get a random link from the specified category
        $random_link = $wpdb->get_var(
            $wpdb->prepare(
                "SELECT links.*
                FROM wp_links AS links
                JOIN wp_term_relationships AS term_rel ON links.link_id = term_rel.object_id
                JOIN wp_term_taxonomy AS term_tax ON term_rel.term_taxonomy_id = term_tax.term_taxonomy_id
                WHERE term_tax.taxonomy = 'link_category'
                AND term_tax.term_id = '%d'
                ",
                $category_id
            )
        );

        if ($random_link) {
            // Perform the redirection
            wp_redirect($random_link);
            exit;
        } else {
            return new WP_Error('no_random_link', 'No random link found in the specified category', array('status' => 404));
        }
    }    

    /**
     * Register the REST API routes.
     *
     * @since    1.0.0
     */
    public function register_random_link_api_route() {
        register_rest_route('wp-blogroll/v1', '/random', array(
            'methods' => 'GET',
            'callback' => array($this, 'random_link_redirect_callback'),
        ));
        register_rest_route('wp-blogroll/v1', '/category/random/(?P<category_id>\d+)', array(
            'methods' => 'GET',
            'callback' => array($this, 'random_link_redirect_category_callback'),
            'args' => array(
                'id' => array(
                  'validate_callback' => function($param, $request, $key) {
                    return is_numeric( $param );
                  }
                ),
              ),
        ));   
    }
}

/**
 * Instantiate the plugin class
 *
 * @since    1.0.0
 */
$random_link_redirect_plugin = new Wp_Blogring_Routes();