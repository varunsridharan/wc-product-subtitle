<?php

namespace WC_Product_Subtitle;

use VSP\Base;

if ( ! defined( 'ABSPATH' ) ) {
	die;
}

if ( ! class_exists( '\WC_Product_Subtitle\Integrations' ) ) {
	/**
	 * Class Integrations
	 *
	 * @package WC_Product_Subtitle
	 * @author Varun Sridharan <varunsridharan23@gmail.com>
	 * @since 1.0
	 */
	final class Integrations extends Base {
		/**
		 * Class Constructor.
		 */
		public function __construct() {
			/**
			 * @uses subtitle_wcpdf
			 */
			if ( false !== wc_ps_option( 'wcpdfinvoiceandpackingslip' ) ) {
				add_action( 'wpo_wcpdf_after_item_meta', array( &$this, 'subtitle_wcpdf' ), 10, 3 );
			}
		}

		/**
		 * Integrations With https://wordpress.org/plugin/woocommerce-pdf-invoices-packing-slips/
		 *
		 * @param                      $template_type
		 * @param \WC_Order_Item|array $item
		 * @param \WC_Order            $order
		 */
		public function subtitle_wcpdf( $template_type, $item, $order ) {
			if ( empty( $item['product'] ) ) {
				return;
			}

			if ( $item['product']->is_type( 'variation' ) ) {
				$item['product'] = wc_get_product( $item['product']->get_parent_id() );
			}

			$subtitle = get_product_subtitle( $item['product']->get_id() );
			if ( ! empty( $subtitle ) ) {
				echo '<div class="product-subtitle"><small>' . __( 'Subtitle :', 'wc-product-subtitle' ) . ' ' . $subtitle . '</small></div>';
			}
		}
	}
}
