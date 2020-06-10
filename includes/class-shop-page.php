<?php

namespace WC_Product_Subtitle;

defined( 'ABSPATH' ) || exit;

/**
 * Class Shop_Page
 *
 * @package WC_Product_Subtitle
 * @author Varun Sridharan <varunsridharan23@gmail.com>
 */
class Shop_Page extends Display_Handler {
	/**
	 * Shop_Page constructor.
	 */
	public function __construct() {
		parent::__construct( 'shop_page' );

		if ( ! empty( $this->get_position() ) ) {
			$key = false;
			$p   = 10;
			switch ( $this->get_position() ) {
				case 'title':
					$key = 'woocommerce_shop_loop_item_title';
					$p   = ( $this->is_before() ) ? 9 : 11;
					break;
				case 'rating':
					$p   = ( $this->is_before() ) ? 4 : 6;
					$key = 'woocommerce_after_shop_loop_item_title';
					break;
				case 'price':
					$p   = ( $this->is_before() ) ? 9 : 11;
					$key = 'woocommerce_after_shop_loop_item_title';
					break;
			}

			/**
			 * Hook: woocommerce_shop_loop_item_title.
			 *
			 * @hooked woocommerce_template_loop_product_title - 10
			 *
			 * Hook: woocommerce_after_shop_loop_item_title.
			 *
			 * @hooked woocommerce_template_loop_rating - 5
			 * @hooked woocommerce_template_loop_price - 10
			 * @uses the_subtitle
			 */
			add_action( $key, array( $this, 'the_subtitle' ), $p );
		}
	}
}
