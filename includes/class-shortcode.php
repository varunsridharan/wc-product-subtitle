<?php

namespace WC_Product_Subtitle;

defined( 'ABSPATH' ) || exit;

use WP_Post;

/**
 * Class WooCommerce_Product_Subtitle_Shortcode_Handler
 *
 * @package WC_Product_Subtitle
 * @author Varun Sridharan <varunsridharan23@gmail.com>
 */
class Shortcode extends Display_Handler {
	/**
	 * WooCommerce_Product_Subtitle_Shortcode_Handler constructor.
	 */
	public function __construct() {
		/**
		 * @deprecated Use wc_ps
		 */
		add_shortcode( 'wc-ps', array( $this, 'render_shortcode' ) );
		add_shortcode( 'wc_ps', array( $this, 'render_shortcode' ) );
		add_shortcode( 'product_subtitle', array( $this, 'render_shortcode' ) );
		parent::__construct( 'shortcode' );
	}

	/**
	 * Renders Shortcode.
	 *
	 * @param $atts
	 *
	 * @return false|string
	 */
	public function render_shortcode( $atts ) {
		$atts = shortcode_atts( array(
			'id'  => false,
			'tag' => $this->get_element(),
		), $atts, 'wc_ps' );

		global $post;
		$this->set_option( 'tag', str_replace( '_tag', '', $atts['tag'] ) );
		if ( empty( $atts['id'] ) && $post instanceof WP_Post ) {
			$atts['id'] = isset( $post->ID ) ? $post->ID : $atts['id'];
		}
		return $this->render_subtitle( $atts['id'] );
	}
}
