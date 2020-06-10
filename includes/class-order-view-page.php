<?php

namespace WC_Product_Subtitle;

defined( 'ABSPATH' ) || exit;

/**
 * Class Order_View_Page
 *
 * @package WC_Product_Subtitle
 * @author Varun Sridharan <varunsridharan23@gmail.com>
 */
class Order_View_Page extends Display_Handler {
	/**
	 * Order_View_Page constructor.
	 */
	public function __construct() {
		parent::__construct( 'order_view_page' );

		if ( ! empty( $this->get_position() ) ) {
			$key = ( 'title' === $this->get_position() ) ? 'woocommerce_order_item_name' : 'woocommerce_order_item_quantity_html';
			/* @uses order_page_subtitle */
			add_filter( $key, array( $this, 'order_page_subtitle' ), 10, 2 );
		}
	}

	/**
	 * Renders Order Page Subtitle.
	 *
	 * @param string $title
	 * @param array  $cart_item
	 *
	 * @return string
	 */
	public function order_page_subtitle( $title = '', $cart_item = array() ) {
		if ( ! isset( $cart_item['product_id'] ) ) {
			return $title;
		}

		$subtitle = $this->render_subtitle( $cart_item['product_id'] );
		return ( $this->is_before() ) ? $subtitle . ' ' . $title : $title . ' ' . $subtitle;
	}
}
