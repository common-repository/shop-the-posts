<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://codeless.co
 * @since      1.0.0
 *
 * @package    Shop_The_Posts
 * @subpackage Shop_The_Posts/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Shop_The_Posts
 * @subpackage Shop_The_Posts/admin
 * @author     Codeless <codeless.sol@gmail.com>
 */
class Shop_The_Posts_Admin {

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
		 * defined in Shop_The_Posts_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Shop_The_Posts_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/shop-the-posts-admin.css', array(), $this->version, 'all' );

		// get current admin screen, or null
	    $screen = get_current_screen();
	    // verify admin screen object
	    if (is_object($screen)) {
	        // enqueue only for specific post types
	        if (in_array($screen->post_type, ['post'])) {
	        	wp_enqueue_style('thickbox');
	            // enqueue script
	            wp_enqueue_style('shop-the-posts-metaboxes', plugin_dir_url( __FILE__ ) . 'css/shop-the-posts-metaboxes.css', array(), $this->version, 'all');
	        }
	    }

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
		 * defined in Shop_The_Posts_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Shop_The_Posts_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/shop-the-posts-admin.js', array( 'jquery' ), $this->version, false );

		// get current admin screen, or null
	    $screen = get_current_screen();
	    // verify admin screen object
	    if (is_object($screen)) {
	        // enqueue only for specific post types
	        if (in_array($screen->post_type, ['post'])) {

	        	wp_enqueue_script('media-upload');
    			wp_enqueue_script('thickbox');
	            // enqueue script
	            wp_enqueue_script('shop-the-posts-metaboxes', plugin_dir_url( __FILE__ ) . 'js/shop-the-posts-metaboxes.js', array('jquery','media-upload','thickbox'), $this->version, false);
	        }
	    }

	}


	/**
	 * Register meta boxes
	 *
	 * @since    1.0.0
	 */
	public function init_metaboxes() {

		$metaboxes = new Shop_The_Posts_Metaboxes();
    	
	}

}
