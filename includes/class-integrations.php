<?php

namespace WC_Product_Subtitle;

defined( 'ABSPATH' ) || exit;

use VSP\Base;

/**
 * Class Integrations
 *
 * @package WC_Product_Subtitle
 * @author Varun Sridharan <varunsridharan23@gmail.com>
 */
final class Integrations extends Base {
	/**
	 * Class Constructor.
	 */
	public function __construct() {
		if ( false !== wc_ps_option( 'wcpdfinvoiceandpackingslip' ) ) {
			/* @uses subtitle_wcpdf */
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

		$subtitle = wcps_get_subtitle( $item['product']->get_id() );
		if ( ! empty( $subtitle ) ) {
			echo '<div class="product-subtitle"><small>' . __( 'Subtitle :', 'wc-product-subtitle' ) . ' ' . wp_kses_post( $subtitle ) . '</small></div>';
		}
	}
}
