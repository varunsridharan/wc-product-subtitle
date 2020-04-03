<?php

namespace WC_Product_Subtitle;

if ( ! class_exists( '\WC_Product_Subtitle\Cart_Page' ) ) {
	/**
	 * Class Cart_Page
	 *
	 * @package WC_Product_Subtitle
	 * @author Varun Sridharan <varunsridharan23@gmail.com>
	 * @since 1.0
	 */
	class Cart_Page extends Display_Handler {
		/**
		 * Cart_Page constructor.
		 */
		public function __construct() {
			parent::__construct( 'cart_page' );

			if ( ! empty( $this->get_position() ) ) {
				/* @uses cart_subtitle */
				add_filter( 'woocommerce_cart_item_name', array( $this, 'cart_subtitle' ), 10, 2 );
			}
		}

		/**
		 * @param $title
		 * @param $cart_item
		 *
		 * @return string
		 */
		public function cart_subtitle( $title, $cart_item ) {
			if ( ! is_cart() ) {
				return $title;
			}
			if ( ! isset( $cart_item['product_id'] ) ) {
				return $title;
			}

			$subtitle = $this->render_subtitle( $cart_item['product_id'] );
			return ( $this->is_before() ) ? $subtitle . ' ' . $title : $title . ' ' . $subtitle;
		}
	}

}
