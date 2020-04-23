<?php

namespace WC_Product_Subtitle\Installer;

defined( 'ABSPATH' ) || exit;

if ( ! class_exists( '\WC_Product_Subtitle\Installer\Version_4' ) ) {
	/**
	 * WC Product Subtitle V4.0 Installer.
	 *
	 * @package WC_Product_Subtitle\Installer
	 * @author Varun Sridharan <varunsridharan23@gmail.com>
	 * @since 4.0
	 */
	class Version_4 {
		/**
		 * Checks if is enabled before.
		 *
		 * @param $data
		 *
		 * @static
		 * @return bool
		 */
		private static function is_before_enabled( $data ) {
			return ( ! empty( $data ) && 'before' === $data );
		}

		/**
		 * Runs When V4.0 Upgrade is required.
		 *
		 * @static
		 * @return bool
		 */
		public static function run() {
			$general         = get_option( 'wc_ps_general', array() );
			$cart_page       = get_option( 'wc_ps_cart_page', array() );
			$checkout_page   = get_option( 'wc_ps_checkout_page', array() );
			$order_view_page = get_option( 'wc_ps_order_view_page', array() );
			$shop_page       = get_option( 'wc_ps_shop_page', array() );
			$single_product  = get_option( 'wc_ps_single_product', array() );

			$settings = array(
				'admin_column'    => ( isset( $general['wc_ps_admin_product_column'] ) && 'on' === $general['wc_ps_admin_product_column'] ) ? true : false,
				'cart_page'       => array(
					'position'  => ( isset( $cart_page['wc_ps_cart_page_pos'] ) ) ? $cart_page['wc_ps_cart_page_pos'] : '',
					'placement' => self::is_before_enabled( ( isset( $cart_page['wc_ps_cart_page_where'] ) ) ? $cart_page['wc_ps_cart_page_where'] : '' ),
					'element'   => ( isset( $cart_page['wc_ps_cart_page_tag'] ) ) ? str_replace( '_tag', '', $cart_page['wc_ps_cart_page_tag'] ) : 'p',
				),
				'checkout_page'   => array(
					'position'  => ( isset( $checkout_page['wc_ps_checkout_page_pos'] ) ) ? $checkout_page['wc_ps_checkout_page_pos'] : '',
					'placement' => self::is_before_enabled( ( isset( $checkout_page['wc_ps_checkout_page_where'] ) ) ? $checkout_page['wc_ps_checkout_page_where'] : '' ),
					'element'   => ( isset( $checkout_page['wc_ps_checkout_page_tag'] ) ) ? str_replace( '_tag', '', $checkout_page['wc_ps_checkout_page_tag'] ) : 'p',
				),
				'order_view_page' => array(
					'position'  => ( isset( $order_view_page['wc_ps_order_view_page_pos'] ) ) ? $order_view_page['wc_ps_order_view_page_pos'] : '',
					'placement' => self::is_before_enabled( ( isset( $order_view_page['wc_ps_order_view_page_where'] ) ) ? $order_view_page['wc_ps_order_view_page_where'] : '' ),
					'element'   => ( isset( $order_view_page['wc_ps_order_view_page_tag'] ) ) ? str_replace( '_tag', '', $order_view_page['wc_ps_order_view_page_tag'] ) : 'p',
				),
				'shop_page'       => array(
					'position'  => ( isset( $shop_page['wc_ps_shop_page_pos'] ) ) ? $shop_page['wc_ps_shop_page_pos'] : '',
					'placement' => self::is_before_enabled( ( isset( $shop_page['wc_ps_shop_page_where'] ) ) ? $shop_page['wc_ps_shop_page_where'] : '' ),
					'element'   => ( isset( $shop_page['wc_ps_shop_page_tag'] ) ) ? str_replace( '_tag', '', $shop_page['wc_ps_shop_page_tag'] ) : 'p',
				),
				'single_product'  => array(
					'position'  => ( isset( $single_product['wc_ps_single_product_pos'] ) ) ? $single_product['wc_ps_single_product_pos'] : '',
					'placement' => self::is_before_enabled( ( isset( $single_product['wc_ps_single_product_where'] ) ) ? $single_product['wc_ps_single_product_where'] : '' ),
					'element'   => ( isset( $single_product['wc_ps_single_product_tag'] ) ) ? str_replace( '_tag', '', $single_product['wc_ps_single_product_tag'] ) : 'p',
				),
			);

			delete_option( 'wc_ps_general' );
			delete_option( 'wc_ps_cart_page' );
			delete_option( 'wc_ps_checkout_page' );
			delete_option( 'wc_ps_order_view_page' );
			delete_option( 'wc_ps_shop_page' );
			delete_option( 'wc_ps_single_product' );
			/**
			 * Updates New Options.
			 */
			update_option( '_wc_product_subtitle', $settings );
			return true;
		}
	}
}
