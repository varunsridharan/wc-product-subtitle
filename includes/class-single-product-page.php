<?php

namespace WC_Product_Subtitle;

defined( 'ABSPATH' ) || exit;

/**
 * Class Single_Product_Page
 *
 * @package WC_Product_Subtitle
 * @author Varun Sridharan <varunsridharan23@gmail.com>
 */
class Single_Product_Page extends Display_Handler {
	/**
	 * Single_Product_Page constructor.
	 */
	public function __construct() {
		parent::__construct( 'single_product' );

		$position = $this->get_position();
		$p        = 10;
		switch ( $position ) {
			case 'title':
				$p = ( $this->is_before() ) ? 4 : 6;
				break;
			case 'rating':
			case 'price':
				$p = ( $this->is_before() ) ? 9 : 11;
				break;
			case 'excerpt':
				$p = ( $this->is_before() ) ? 19 : 21;
				break;
			case 'add_to_cart':
				$p = ( $this->is_before() ) ? 29 : 31;
				break;
			case 'meta':
				$p = ( $this->is_before() ) ? 39 : 41;
				break;
		}

		if ( ! empty( $position ) ) {
			/**
			 * @hooked woocommerce_template_single_title - 5
			 * @hooked woocommerce_template_single_rating - 10
			 * @hooked woocommerce_template_single_price - 10
			 * @hooked woocommerce_template_single_excerpt - 20
			 * @hooked woocommerce_template_single_add_to_cart - 30
			 * @hooked woocommerce_template_single_meta - 40
			 * @hooked woocommerce_template_single_sharing - 50
			 * @hooked WC_Structured_Data::generate_product_data() - 60
			 * @uses the_subtitle
			 */
			add_action( 'woocommerce_single_product_summary', array( $this, 'the_subtitle' ), $p );
		}
	}
}