<?php

namespace WC_Product_Subtitle;

defined( 'ABSPATH' ) || exit;

/**
 * Class Email
 *
 * @package WC_Product_Subtitle
 * @author Varun Sridharan <varunsridharan23@gmail.com>
 */
class Email extends Display_Handler {
	/**
	 * Email constructor.
	 */
	public function __construct() {
		parent::__construct( 'email' );

		if ( ! empty( $this->get_position() ) ) {
			add_action( 'woocommerce_email_before_order_table', array( $this, 'init_hook' ) );
		}
	}

	public function init_hook() {
		$hook = ( $this->is_before() ) ? 'woocommerce_order_item_meta_start' : 'woocommerce_order_item_meta_end';
		/* @uses email_subtitle */
		add_action( $hook, array( &$this, 'email_subtitle' ), 10, 2 );
	}

	/**
	 * Renders Email Subtitle.
	 *
	 * @param bool|int                       $order_id
	 * @param boolean|\WC_Order_Item_Product $item
	 * @param boolean|\WC_Order              $order
	 * @param bool                           $plain_text
	 */
	public function email_subtitle( $order_id = false, $item = false, $order = false, $plain_text = false ) {
		$option = ( true === $plain_text ) ? 'plain' : 'html';
		$option = wp_parse_args( $this->option( $option, array() ), array(
			'before_subtitle' => false,
			'after_subtitle'  => false,
		) );

		$subtitle = $option['before_subtitle'] . $this->render_subtitle( $item->get_product_id() ) . $option['after_subtitle'];
		if ( $plain_text ) {
			echo esc_html( $subtitle );
		} else {
			echo wp_kses_post( $subtitle );
		}
	}
}

