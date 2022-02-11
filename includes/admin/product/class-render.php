<?php

namespace WC_Product_Subtitle\Admin\Product;

defined( 'ABSPATH' ) || exit;

use VSP\Base;

/**
 * Class Admin
 *
 * @package WC_Product_Subtitle\Admin
 * @author Varun Sridharan <varunsridharan23@gmail.com>
 * @since {NEWVERSION}
 */
class Render extends Base {
	/**
	 * On Class Init.
	 */
	public function __construct() {
		$callback = array( &$this, 'render_subtitle' );

		if ( false !== wc_ps_option( 'admin_column' ) ) {
			wponion_admin_columns( 'product', __( 'Subtitle', 'wc-product-subtitle' ), $callback );
		}

		if ( false !== wc_ps_option( 'admin_below_product_title' ) ) {
			wponion_admin_columns( 'product', array(
				'title'     => __( 'Name', 'wc-product-subtitle' ),
				'render'    => $callback,
				'force_add' => true,
			) );
		}

	}

	/**
	 * Renders Product Subtitle In Admin Column.
	 *
	 * @param $post_id
	 * @param $column
	 */
	public function render_subtitle( $post_id, $column ) {
		switch ( $column ) {
			case 'subtitle':
				echo wp_kses_post( wcps_get_subtitle( $post_id ) );
				break;
			case 'name':
				echo '<br/><span style="margin-top:4px;display: inline-block;"><i>' . wp_kses_post( wcps_get_subtitle( $post_id ) ) . '</i></span>';
				break;
		}
	}
}
