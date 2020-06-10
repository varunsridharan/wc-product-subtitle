<?php

namespace WC_Product_Subtitle;

defined( 'ABSPATH' ) || exit;

/**
 * Class Tag_Handler
 *
 * @package WC_Product_Subtitle
 * @author Varun Sridharan <varunsridharan23@gmail.com>
 */
class Tag_Handler {
	/**
	 * @var string
	 */
	public $display_id = '';

	/**
	 * Tag_Handler constructor.
	 *
	 * @param $id
	 */
	public function __construct( $id ) {
		$this->display_id = $id;
	}

	/**
	 * Fetches Subtitle.
	 *
	 * @param $title
	 * @param $tag
	 * @param $pid
	 *
	 * @return false|string
	 */
	public function get_subtitle( $title, $tag, $pid ) {
		$defaults = $this->get_element_defaults( $pid );

		if ( wc_ps_option( 'admin_wp_editor' ) && 'p' === $tag ) {
			$tag = 'div';
		}

		if ( in_array( $tag, array_keys( wc_product_subtitle_default_tags() ), true ) ) {
			$return = $this->get_subtitle_in_element( $tag, $title, $pid );
		} else {
			ob_start();
			do_action( 'wc_ps_subtitle_' . $tag, $title, $tag, $pid, $defaults );
			$return = ob_get_clean();
			ob_flush();
		}

		return $return;
	}

	/**
	 * Echo The Subtitle.
	 *
	 * @param $title
	 * @param $tag
	 * @param $pid
	 *
	 * @return false|string
	 */
	public function print_subtitle( $title, $tag, $pid ) {
		return $this->get_subtitle( $title, $tag, $pid );
	}

	/**
	 * Returns Subtitle Element's Default Attributes.
	 *
	 * @param $post_id
	 *
	 * @return array
	 */
	public function get_element_defaults( $post_id ) {
		return array(
			'id'    => apply_filters( 'wc_product_subtitle_id_' . $this->display_id, 'product-subtitle-' . $post_id, $this->display_id, $post_id ),
			'class' => apply_filters( 'wc_product_subtitle_class_' . $this->display_id, 'product-subtitle subtitle-' . $post_id, $this->display_id, $post_id ),
		);
	}

	/**
	 * Generates Element & Inserts Subtitle.
	 *
	 * @param string $ntag
	 * @param string $value
	 * @param bool   $id
	 *
	 * @return string
	 */
	public function get_subtitle_in_element( $ntag = '', $value = '', $id = false ) {
		if ( empty( $value ) ) {
			return '';
		}
		$arg = $this->get_element_defaults( $id );
		return '<' . $ntag . ' id="' . $arg['id'] . '" class="' . $arg['class'] . '" >' . $value . '</' . $ntag . '>';
	}
}
