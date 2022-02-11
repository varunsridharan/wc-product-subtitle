<?php

namespace WC_Product_Subtitle\Admin;

defined( 'ABSPATH' ) || exit;

use VSP\Base;
use VSP\WC_Compatibility;

/**
 * Class Admin
 *
 * @package WC_Product_Subtitle\Admin
 * @author Varun Sridharan <varunsridharan23@gmail.com>
 * @since {NEWVERSION}
 */
class Order_Render extends Base {
	/**
	 * On Class Init.
	 */
	public function __construct() {
		add_action( 'woocommerce_after_order_itemmeta', array( $this, 'render_subtitle' ), 15, 3 );
	}

	/**
	 * Renders Product Subtitle In Admin Column.
	 *
	 * @param $post_id
	 * @param $column
	 */
	public function render_subtitle( $item_id, $item, $product ) {
		$product_id = WC_Compatibility::get_product_id( $product );
		if ( ! empty( $product_id ) ) {
			$title    = __( 'Subtitle:', 'wc-product-subtitle' );
			$subtitle = wp_kses_post( wcps_get_subtitle( $product_id ) );
			if ( ! empty( $subtitle ) ) {
				echo "<div class=\"wc-product-subtitle\" style='color:#888; font-style: italic;font-size: .92em !important;'> <strong>${title}</strong> ${subtitle} </div>";
			}
		}
	}
}
