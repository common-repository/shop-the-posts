<?php

class Shop_The_Posts_Single {

	private $post_id;
	private $type_form;
	private $title;
	private $link;
	private $button_text;
	private $image;

	public function __construct( $post_id ){
		$this->post_id = $post_id;

		$this->init();
	}

	public function init(){
		$this->type_form = get_post_meta( $this->post_id, '_codeless_stp_type_from' );
		if( is_array( $this->type_form ) )
			$this->type_form = end( $this->type_form );

		if( $this->type_form == 'external' )
			$this->init_external_product();
		else if( $this->type_form == 'woocommerce' && class_exists( 'Woocommerce' ) )
			$this->init_woocommerce_product();
	}

	public function get_title(){
		return $this->title;
	}

	public function get_type_form(){
		return $this->type_form;
	}

	public function get_permalink(){
		return $this->link;
	}

	public function get_button_text(){
		return $this->button_text;
	}

	public function get_image(){
		return $this->image;
	}

	private function init_external_product(){
		$this->title = get_post_meta( $this->post_id, '_codeless_stp_external_title', true);
		$this->link = get_post_meta( $this->post_id, '_codeless_stp_external_link', true);
		$this->button_text = get_post_meta( $this->post_id, '_codeless_stp_external_button_text', true);
		$this->image = get_post_meta( $this->post_id, '_codeless_stp_external_image', true);
	}

	private function init_woocommerce_product(){
		$woocommerce_product = get_post_meta( $this->post_id, '_codeless_stp_woocommerce_post', true);
		

		if( empty( $woocommerce_product ) )
			return;

		$product = wc_get_product( $woocommerce_product );
		if( is_object( $product ) ){
			$this->title = $product->get_title();
			$this->link = get_permalink( $product->get_ID() );
			$this->button_text = get_post_meta( $this->post_id, '_codeless_stp_woocommerce_button_text', true);
			$this->image = get_post_thumbnail_id( $product->get_ID() );
		}

	}


}