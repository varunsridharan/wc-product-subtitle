<?php

namespace WC_Product_Subtitle\Admin\Product;

defined( 'ABSPATH' ) || exit;

use VSP\Base;

/**
 * Class Field
 *
 * @package WC_Product_Subtitle\Admin\Product
 * @author Varun Sridharan <varunsridharan23@gmail.com>
 * @since {NEWVERSION}
 */
class Field extends Base {
	/**
	 * On Class Init.
	 */
	public function __construct() {
		/**
		 * @uses add_subtitle_field
		 * @uses save_product_subtitle
		 */
		add_action( 'edit_form_before_permalink', array( &$this, 'add_subtitle_field' ) );
		add_action( 'save_post', array( $this, 'save_product_subtitle' ), 10, 3 );
	}

	/**
	 * Stores Subtitle In Product EDIT Page.
	 *
	 * @param $post_id
	 * @param $post
	 */
	public function save_product_subtitle( $post_id, $post ) {
		if ( 'product' !== $post->post_type ) {
			return;
		}
		if ( isset( $_POST['product_subtitle'] ) ) {
			wcps_update_subtitle( $post_id, wp_kses_post( $_POST['product_subtitle'] ) );
		}
	}

	/**
	 * Add Product Subtitle Field In Post Edit View.
	 *
	 * @param \WP_Post $post
	 */
	public function add_subtitle_field( $post ) {
		if ( 'product' === $post->post_type ) {
			global $post;
			$value = wcps_get_subtitle( $post->ID );

			if ( wc_ps_option( 'admin_wp_editor' ) ) {
				/* @var \WPO\Fields\WP_Editor $field */
				$field = wpo_field( 'wp_editor', 'product_subtitle' )
					->horizontal( true )
					->title( __( 'Product Subtitle', 'wc-product-subtitle' ) )
					->settings( array(
						'media_buttons'    => false,
						'wpautop'          => false,
						'quicktags'        => false,
						'teeny'            => true,
						'drag_drop_upload' => false,
						'textarea_rows'    => 2,
					) )
					->debug( false )
					->wrap_id( 'wc_product_subtitle' );
				$field = $field->render( $value, null );
				wponion_load_core_assets();
				wp_add_inline_script( 'wponion-core', "window.wponion.hooks.addAction( 'wponion_init', 'wcps', function() { window.wponion_init_field( 'wp_editor', jQuery( 'div#wc_product_subtitle' ) ); } );" );
			} else {
				$field = wpo_field( 'text', 'product_subtitle', '' )
					->placeholder( __( 'Subtitle : ', 'wc-product-subtitle' ) )
					->name( 'product_subtitle' )
					->only_field( true )
					->attribute( 'spellcheck', 'true' )
					->attribute( 'size', '50' )
					->attribute( 'autocomplete', 'false' )
					->attribute( 'id', 'wcps_subtitle' )
					->render( $value, null );
				$field = '<div id="subtitlediv"> <div id="subtitlewrap"> ' . $field . ' </div> </div> ';
			}
			echo <<<HTML
$field
<style>
div#wc_product_subtitle.wponion-element {display: inline-block;width: 100%;margin: 10px 0;}
div#wc_product_subtitle.wponion-element .wponion-field-title > h4{font-size: 1.3em;margin-top: 0;margin-bottom: 15px;}
#subtitlediv{ margin-top: 10px; display: inline-block; width: 100%; } 
#wcps_subtitle{padding: 3px 8px;font-size: 1.5em;line-height: 100%;height: 1.6em;width: 100%;display: inline-block;outline: none;margin: 0 0 3px;background-color: #fff;}
</style>
HTML;
		}
	}
}
