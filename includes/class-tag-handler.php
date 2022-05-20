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
	public function get_subtitle( $title, $tag, $product_id, $is_linkback ) {
		$defaults = $this->get_element_defaults( $product_id );

		if ( wc_ps_option( 'admin_wp_editor' ) && 'p' === $tag ) {
			$tag = 'div';
		}

		if ( in_array( $tag, array_keys( wcps_subtitle_default_tags() ), true ) ) {
			$return = $this->get_subtitle_in_element( $tag, $title, $product_id, $is_linkback );
		} else {
			ob_start();
			do_action( 'wc_ps_subtitle_' . $tag, $title, $tag, $product_id, $is_linkback, $defaults );
			$return = ob_get_clean();
			ob_flush();
		}

		return $return;
	}

	/**
	 * Echo The Subtitle.
	 *
	 * @param string $title
	 * @param mixed  $tag
	 * @param int    $product_id
	 * @param bool   $is_linkback
	 *
	 * @return false|string
	 */
	public function print_subtitle( $title, $tag, $product_id, $is_linkback ) {
		return $this->get_subtitle( $title, $tag, $product_id, $is_linkback );
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
			'id'    => esc_attr( apply_filters( 'wc_product_subtitle_id_' . $this->display_id, 'product-subtitle-' . $post_id, $this->display_id, $post_id ) ),
			'class' => esc_attr( apply_filters( 'wc_product_subtitle_class_' . $this->display_id, 'product-subtitle subtitle-' . $post_id, $this->display_id, $post_id ) ),
		);
	}

	/**
	 * Generates Element & Inserts Subtitle.
	 *
	 * @param string $ntag
	 * @param string $value
	 * @param bool   $id
	 * @param bool   $linkback
	 *
	 * @return string
	 */
	public function get_subtitle_in_element( $ntag = '', $value = '', $id = false, $linkback = false ) {
		if ( empty( $value ) ) {
			return '';
		}
		$arg    = $this->get_element_defaults( $id );
		$return = '<' . $ntag . ' id="' . $arg['id'] . '" class="' . $arg['class'] . '" >' . $value . '</' . $ntag . '>';

		if ( wponion_is_bool_val( $linkback ) ) {
			$permalink = get_permalink( $id );
			$title     = get_the_title( $id );
			$attr      = wponion_array_to_html_attributes( apply_filters( 'wc_product_subtitle_link_attributes', array(
				'href'  => esc_attr( $permalink ),
				'title' => esc_attr( $title ),
				'class' => 'product-subtitle-link product-' . $id . '-subtitle-link',
			) ) );
			$return    = '<a ' . $attr . '>' . $return . '</a> ';
		}
		return $return;
	}
}
