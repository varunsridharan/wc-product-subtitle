<?php

namespace WC_Product_Subtitle;

defined( 'ABSPATH' ) || exit;

/**
 * Class Checkout_Page
 *
 * @package WC_Product_Subtitle
 * @author Varun Sridharan <varunsridharan23@gmail.com>
 */
class Checkout_Page extends Display_Handler {
	/**
	 * Checkout_Page constructor.
	 */
	public function __construct() {
		parent::__construct( 'checkout_page' );

		if ( ! empty( $this->get_position() ) ) {
			/* @uses checkout_subtitle */
			add_filter( 'woocommerce_cart_item_name', array( $this, 'checkout_subtitle' ), 10, 3 );
		}
	}

	/**
	 * Renders Checkout Subtitle.
	 *
	 * @param $title
	 * @param $cart_item
	 *
	 * @return string
	 */
	public function checkout_subtitle( $title, $cart_item ) {
		if ( ! is_checkout() ) {
			return $title;
		}
		if ( ! isset( $cart_item['product_id'] ) ) {
			return $title;
		}

		$subtitle = $this->render_subtitle( $cart_item['product_id'] );
		return ( $this->is_before() ) ? $subtitle . ' ' . $title : $title . ' ' . $subtitle;
	}
}
