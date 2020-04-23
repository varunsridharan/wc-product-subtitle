<?php

defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'wc_ps_option' ) ) {
	/**
	 * Retrives Options From DB.
	 *
	 * @param string|bool $key Option Key.
	 * @param bool        $default
	 *
	 * @return bool|mixed
	 */
	function wc_ps_option( $key = false, $default = false ) {
		return wpo_settings( '_wc_product_subtitle', $key, $default );
	}
}

if ( ! function_exists( 'wp_product_subtitle_placements' ) ) {
	/**
	 * Returns A List of places where subtitle's can be display based on the page.
	 *
	 * @param bool $place
	 *
	 * @return mixed|void
	 */
	function wp_product_subtitle_placements( $place = false ) {
		$placements = array(
			''      => __( 'Disable/ Use Shortcode', 'wc-product-subtitle' ),
			'title' => __( 'Product Title', 'wc-product-subtitle' ),
		);

		switch ( $place ) {
			case 'cart':
			case 'checkout':
				// Nothing To Do Here.
				break;
			case 'order_view':
				$placements['qty'] = __( 'Product Qty', 'wc-product-subtitle' );
				break;
			case 'shop':
				$placements['rating'] = __( 'Product Rating', 'wc-product-subtitle' );
				$placements['price']  = __( 'Product Price', 'wc-product-subtitle' );
				break;
			case 'single':
				$placements['rating']    = __( 'Product Rating', 'wc-product-subtitle' );
				$placements['price']     = __( 'Product Price', 'wc-product-subtitle' );
				$placements['excerpt']   = __( 'Product Excerpt', 'wc-product-subtitle' );
				$placements['addtocart'] = __( 'Product AddToCart', 'wc-product-subtitle' );
				$placements['meta']      = __( 'Product Meta', 'wc-product-subtitle' );
				break;
			case 'email':
				unset( $placements['title'] );
				$placements['meta'] = __( 'Product Meta', 'wc-product-subtitle' );
				break;
		}
		return apply_filters( 'wc_product_subtitle_placements', $placements, $place );
	}
}

if ( ! function_exists( 'wc_product_subtitle_default_tags' ) ) {
	/**
	 * Returns Default Tags.
	 *
	 * @return array
	 */
	function wc_product_subtitle_default_tags() {
		return array(
			'i'      => '&#x3C;i&#x3E;',
			'p'      => '&#x3C;p&#x3E;',
			'mark'   => '&#x3C;mark&#x3E;',
			'span'   => '&#x3C;span&#x3E;',
			'small'  => '&#x3C;small&#x3E;',
			'strong' => '&#x3C;strong&#x3E;',
			'div'    => '&#x3C;div&#x3E;',
			'h1'     => '&#x3C;h1&#x3E;',
			'h2'     => '&#x3C;h2&#x3E;',
			'h3'     => '&#x3C;h3&#x3E;',
			'h4'     => '&#x3C;h4&#x3E;',
			'h5'     => '&#x3C;h5&#x3E;',
			'h6'     => '&#x3C;h6&#x3E;',
		);
	}
}

if ( ! function_exists( 'wc_product_subtitle_tags' ) ) {
	/**
	 * Returns Avaiable Tag Options.
	 *
	 * @return mixed|void
	 */
	function wc_product_subtitle_tags() {
		return apply_filters( 'wc_product_subtitle_tags', wc_product_subtitle_default_tags() );
	}
}

if ( ! function_exists( 'update_product_subttile' ) ) {
	/**
	 * Updates Post Meta In DB.
	 *
	 * @param $post_id
	 * @param $subtitle
	 *
	 * @return bool|int
	 */
	function update_product_subtitle( $post_id, $subtitle ) {
		return update_post_meta( $post_id, 'wc_ps_subtitle', $subtitle );
	}
}

if ( ! function_exists( 'get_product_subtitle' ) ) {
	/**
	 * Gets From DB.
	 *
	 * @param $id
	 *
	 * @return mixed
	 */
	function get_product_subtitle( $id ) {
		return get_post_meta( $id, 'wc_ps_subtitle', true );
	}
}

if ( ! function_exists( 'the_product_subtitle' ) ) {
	/**
	 * Echos Subtitle's
	 *
	 * @param $id
	 */
	function the_product_subtitle( $id ) {
		echo get_product_subtitle( $id );
	}
}
