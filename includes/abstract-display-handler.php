<?php

namespace WC_Product_Subtitle;
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! class_exists( '\WC_Product_Subtitle\Display_Handler' ) ) {
	/**
	 * Class Display_Handler
	 *
	 * @package WC_Product_Subtitle
	 * @author Varun Sridharan <varunsridharan23@gmail.com>
	 * @since 1.0
	 */
	abstract class Display_Handler extends \VSP\Base {
		/**
		 * Stores Options.
		 *
		 * @var array
		 * @access
		 */
		protected $options = array();

		/**
		 * @var bool|\WC_Product_Subtitle\Tag_Handler
		 * @access
		 */
		protected $tag_handler = false;

		/**
		 * Display_Handler constructor.
		 *
		 * @param string $slug
		 */
		public function __construct( $slug ) {
			$this->tag_handler = new Tag_Handler( $slug );
			$this->options     = wc_ps_option( $slug, array() );
		}

		/**
		 * @return bool|mixed
		 */
		public function get_position() {
			return ( isset( $this->options['position'] ) ) ? $this->options['position'] : false;
		}

		/**
		 * @return bool|mixed
		 */
		public function is_before() {
			return ( isset( $this->options['placement'] ) ) ? $this->options['placement'] : false;
		}

		/**
		 * @return bool|mixed
		 */
		public function get_element() {
			return ( isset( $this->options['element'] ) ) ? $this->options['element'] : false;
		}

		/**
		 * @param string $pid
		 */
		public function the_subtitle( $pid = '' ) {
			echo $this->render_subtitle( $pid );
		}

		/**
		 * @param string $pid
		 *
		 * @return false|string
		 */
		public function render_subtitle( $pid = '' ) {
			global $post;
			if ( empty( $pid ) && isset( $post->ID ) ) {
				$pid = $post->ID;
			}
			return $this->tag_handler->print_subtitle( get_product_subtitle( $pid ), $this->get_element(), $pid );
		}
	}
}
