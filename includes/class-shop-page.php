<?php

namespace WC_Product_Subtitle;

if ( ! class_exists( '\WC_Product_Subtitle\Shop_Page' ) ) {
	class Shop_Page extends Display_Handler {
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
				 */
				add_action( $key, array( $this, 'the_subtitle' ), $p );
			}
		}
	}
}