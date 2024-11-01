<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://codeless.co
 * @since      1.0.0
 *
 * @package    Shop_The_Posts
 * @subpackage Shop_The_Posts/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Shop_The_Posts
 * @subpackage Shop_The_Posts/public
 * @author     Codeless <codeless.sol@gmail.com>
 */
class Shop_The_Posts_Public {

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

	private $stp_post;

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
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/shop-the-posts-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/shop-the-posts-public.js', array( 'jquery' ), $this->version, false );
	

	}


	/**
	 * Show Shop The Posts on Bottom Posts List
	 *
	 * @since    1.0.0
	 */
	public function modify_the_content( $content ) {

		// Activate only on Posts
		if( get_post_type() != 'post' )
			return $content;

		$this->stp_post = new Shop_The_Posts_Single( get_the_ID() );
		if( empty( $this->stp_post->get_type_form() ) )
			return $content;

		$position = 'bottom';

		// For Not Single Blog Posts
		if( !is_single() ){
			return $this->load_template_list_content( $content, $position );
		}
		
		// For Single Blog Posts
		if( is_single() ){
			return $this->load_template_single_content( $content, $position );
		}
	}

	/**
	 * Load Template for List Content
	 *
	 * @since    1.0.0
	 */
	public function load_template_list_content( $content, $position = 'bottom' ){
		ob_start();
		include( plugin_dir_path( dirname( __FILE__ ) ) . '/public/partials/list-content.php' );

		if( $position == 'bottom' )
			return $content . ob_get_clean();
		else if( $position == 'top' )
			return ob_get_clean() . $content;
	}


	/**
	 * Load Template for Single Content
	 *
	 * @since    1.0.0
	 */
	public function load_template_single_content( $content, $position = 'bottom' ){
		ob_start();
		include( plugin_dir_path( dirname( __FILE__ ) ) . '/public/partials/single-content.php' );

		if( $position == 'bottom' )
			return $content . ob_get_clean();
		else if( $position == 'top' )
			return ob_get_clean() . $content;
	}


	public static function shortcode_output( $atts, $content = "" ){
		
	}

}
