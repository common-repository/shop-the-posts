<?php

/**
 * The file that defines the core plugin class
 *
 * Class responsible for creating neccessary metaboxes for the plugin
 *
 * @link       https://codeless.co
 * @since      1.0.0
 *
 * @package    Shop_The_Posts
 * @subpackage Shop_The_Posts/includes
 */

/**
 * The Metaboxes Class
 *
 *
 *
 * @since      1.0.0
 * @package    Shop_The_Posts
 * @subpackage Shop_The_Posts/includes
 * @author     Codeless <codeless.sol@gmail.com>
 */
class Shop_The_Posts_Metaboxes {
	/**
     * Constructor.
     */
    public function __construct() {
        $this->init_metabox();
    }
 
    /**
     * Meta box initialization.
     */
    public function init_metabox() {
        add_action( 'add_meta_boxes', array( $this, 'add_metabox'  )        );
        add_action( 'save_post',      array( $this, 'save_metabox' ), 10, 2 );
    }
 
    /**
     * Adds the meta box.
     */
    public function add_metabox() {
        add_meta_box(
            'shop-the-posts-metabox',
            __( 'Shop The Post', 'shop-the-posts' ),
            array( $this, 'render_metabox' ),
            'post',
            'advanced',
            'default'
        );
 
    }
 
    /**
     * Renders the meta box.
     */
    public function render_metabox( $post ) {
        $_codeless_stp_type_from = get_post_meta($post->ID, '_codeless_stp_type_from', true);
        ?>
        <div class="codeless_stp_metabox_field">
            <div class="codeless_stp_metabox_field_label">
	            <label for="codeless_stp_type_form">Get product from:</label>
            </div>
            <div class="codeless_stp_metabox_field_input">
    	        <select name="codeless_stp_type_form" id="codeless_stp_type_form">
    	        	<option value=""><?php esc_attr_e( 'Select one option', 'shop-the-posts' ) ?></option>
    	            <option value="external" <?php selected($_codeless_stp_type_from, 'external'); ?>><?php esc_attr_e( 'External', 'shop-the-posts' ) ?></option>
    	            <option value="woocommerce" <?php selected($_codeless_stp_type_from, 'woocommerce'); ?>><?php esc_attr_e( 'WooCommerce', 'shop-the-posts' ) ?></option>
    	        </select>
            </div>
	    </div>
        <?php


        // External Fields
        $_codeless_stp_external_title = get_post_meta($post->ID, '_codeless_stp_external_title', true);
        ?>
        <div class="codeless_stp_metabox_field" data-required="codeless_stp_type_form:external">
            <div class="codeless_stp_metabox_field_label">
	           <label for="codeless_stp_external_title">External Product Title:</label>
            </div>

            <div class="codeless_stp_metabox_field_input">
	           <input type="text" name="codeless_stp_external_title" value="<?php echo esc_attr( $_codeless_stp_external_title ) ?>" id="codeless_stp_external_title" />
            </div>
	    </div>
        <?php

        $_codeless_stp_external_link = get_post_meta($post->ID, '_codeless_stp_external_link', true);
        ?>
        <div class="codeless_stp_metabox_field" data-required="codeless_stp_type_form:external">
            <div class="codeless_stp_metabox_field_label">
	           <label for="codeless_stp_external_link">External Product Link:</label>
            </div>

            <div class="codeless_stp_metabox_field_input">
	           <input type="text" name="codeless_stp_external_link" value="<?php echo esc_attr( $_codeless_stp_external_link ) ?>" id="codeless_stp_external_link" />
            </div>
	    </div>
        <?php

        $_codeless_stp_external_button_text = get_post_meta($post->ID, '_codeless_stp_external_button_text', true);
        ?>
        <div class="codeless_stp_metabox_field" data-required="codeless_stp_type_form:external">
	        <div class="codeless_stp_metabox_field_label">
                <label for="codeless_stp_external_button_text">External Product Button Text:</label>
            </div>

            <div class="codeless_stp_metabox_field_input">
	           <input type="text" name="codeless_stp_external_button_text" value="<?php echo esc_attr( $_codeless_stp_external_button_text ) ?>" id="codeless_stp_external_button_text" />
            </div>
	    </div>
        <?php

        $_codeless_stp_external_image = get_post_meta($post->ID, '_codeless_stp_external_image', true);
        ?>
        <div class="codeless_stp_metabox_field" id="codeless_stp_metabox_field_external_image" data-required="codeless_stp_type_form:external">
            <div class="codeless_stp_metabox_field_label">
                <label for="codeless_stp_external_image">External Product Image:</label>
            </div>
            
            <div class="codeless_stp_metabox_field_input">
                <input id="codeless_stp_external_image" type="hidden" size="36" name="codeless_stp_external_image" value="<?php echo esc_attr( $_codeless_stp_external_image ) ?>" />
                <div class="custom-img-container">
                    <?php echo wp_get_attachment_image( $_codeless_stp_external_image, array('300', '300'), "", array( "class" => "img-responsive" ) ) ?>
                </div>
                <a href="" class="upload-custom-img">Upload</a>
                <a href="" class="delete-custom-img">Delete</a>
            </div>
        </div>
        <?php




        // WooCommerce

        if( class_exists( 'WooCommerce' ) ){

            $_codeless_stp_woocommerce_post = get_post_meta($post->ID, '_codeless_stp_woocommerce_post', true);
            ?>
            <div class="codeless_stp_metabox_field" data-required="codeless_stp_type_form:woocommerce">
                <div class="codeless_stp_metabox_field_label">
                    <label for="codeless_stp_woocommerce_post">WooCommerce Product:</label>
                </div>

                <div class="codeless_stp_metabox_field_input">
                    <select name="codeless_stp_woocommerce_post" id="codeless_stp_woocommerce_post">
                        <option value=""><?php esc_attr_e( 'Select one product', 'shop-the-posts' ) ?></option>
                        <?php 

                            $products = wc_get_products(); 
                         
                            if( $products ){
                                foreach($products as $product){
                                    ?>
                                    <option value="<?php echo esc_attr( $product->get_id() ) ?>" <?php selected($_codeless_stp_woocommerce_post, $product->get_id() ); ?>><?php echo esc_html( $product->get_title() ) ?></option>
                                    <?php
                                }
                            }

                        ?>
                    </select>
                </div>
            </div>
            <?php

            $_codeless_stp_woocommerce_button_text = get_post_meta($post->ID, '_codeless_stp_woocommerce_button_text', true);
            ?>
            <div class="codeless_stp_metabox_field" data-required="codeless_stp_type_form:woocommerce">
                <div class="codeless_stp_metabox_field_label">
                    <label for="codeless_stp_woocommerce_button_text">External Product Button Text:</label>
                </div>

                <div class="codeless_stp_metabox_field_input">
                    <input type="text" name="codeless_stp_woocommerce_button_text" value="<?php echo esc_attr( $_codeless_stp_woocommerce_button_text ) ?>" id="codeless_stp_woocommerce_button_text" />
                </div>
            </div>
            <?php

        }else{
            ?>
            <div class="codeless_stp_metabox_field" data-required="codeless_stp_type_form:woocommerce">
                <p><?php esc_html_e( 'Please install & active WooCommerce before.', 'shop-the-posts' ) ?></p>
            </div>
            <?php
        }
    }
 
    /**
     * Handles saving the meta box.
     *
     * @param int     $post_id Post ID.
     * @param WP_Post $post    Post object.
     * @return null
     */
    public function save_metabox( $post_id, $post ) {
        if (array_key_exists('codeless_stp_type_form', $_POST)) {
            update_post_meta(
                $post_id,
                '_codeless_stp_type_from',
                $_POST['codeless_stp_type_form']
            );
        }

        if (array_key_exists('codeless_stp_external_title', $_POST)) {
            update_post_meta(
                $post_id,
                '_codeless_stp_external_title',
                $_POST['codeless_stp_external_title']
            );
        }

        if (array_key_exists('codeless_stp_external_button_text', $_POST)) {
            update_post_meta(
                $post_id,
                '_codeless_stp_external_button_text',
                $_POST['codeless_stp_external_button_text']
            );
        }

        if (array_key_exists('codeless_stp_external_link', $_POST)) {
            update_post_meta(
                $post_id,
                '_codeless_stp_external_link',
                $_POST['codeless_stp_external_link']
            );
        }

        if (array_key_exists('codeless_stp_external_image', $_POST)) {
            update_post_meta(
                $post_id,
                '_codeless_stp_external_image',
                $_POST['codeless_stp_external_image']
            );
        }

        if (array_key_exists('codeless_stp_woocommerce_post', $_POST)) {
            update_post_meta(
                $post_id,
                '_codeless_stp_woocommerce_post',
                $_POST['codeless_stp_woocommerce_post']
            );
        }

        if (array_key_exists('codeless_stp_woocommerce_button_text', $_POST)) {
            update_post_meta(
                $post_id,
                '_codeless_stp_woocommerce_button_text',
                $_POST['codeless_stp_woocommerce_button_text']
            );
        }
    }
}