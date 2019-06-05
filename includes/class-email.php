<?php

namespace WC_Product_Subtitle;

if ( ! class_exists( '\WC_Product_Subtitle\Email' ) ) {
	/**
	 * Class Email
	 *
	 * @package WC_Product_Subtitle
	 * @author Varun Sridharan <varunsridharan23@gmail.com>
	 * @since 1.0
	 */
	class Email extends Display_Handler {
		/**
		 * Email constructor.
		 */
		public function __construct() {
			parent::__construct( 'email' );

			if ( ! empty( $this->get_position() ) ) {
				if ( $this->is_before() ) {
					add_action( 'woocommerce_order_item_meta_start', array( &$this, 'email_subtitle' ), 10, 2 );
				} else {
					add_action( 'woocommerce_order_item_meta_end', array( &$this, 'email_subtitle' ), 10, 2 );
				}
			}
		}

		/**
		 * @param bool|int                       $order_id
		 * @param boolean|\WC_Order_Item_Product $item
		 * @param boolean|\WC_Order              $order
		 * @param bool|boolean                   $plain_text
		 */
		public function email_subtitle( $order_id = false, $item = false, $order = false, $plain_text = false ) {
			$option = ( true === $plain_text ) ? 'plain' : 'html';
			$option = wp_parse_args( $this->option( $option, array() ), array(
				'before_subtitle' => false,
				'after_subtitle'  => false,
			) );

			$subtitle = $option['before_subtitle'] . $this->render_subtitle( $item->get_product_id() ) . $option['after_subtitle'];
			if ( $plain_text ) {
				echo strip_tags( $subtitle );
			} else {
				echo $subtitle;
			}
		}
	}
}

