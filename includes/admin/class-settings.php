<?php

namespace WC_Product_Subtitle\Admin;

use VSP\Core\Abstracts\Plugin_Settings;

if ( ! defined( 'ABSPATH' ) ) {
	die;
}

if ( ! class_exists( '\WC_Product_Subtitle\Admin\Settings' ) ) {
	/**
	 * Class Settings
	 *
	 * @package WC_Product_Subtitle\Admin
	 * @author Varun Sridharan <varunsridharan23@gmail.com>
	 * @since 1.0
	 */
	class Settings extends Plugin_Settings {
		/**
		 * @var array|\WPO\Field
		 * @access
		 */
		protected $template = array();

		/**
		 * Sets Basic Template.
		 */
		protected function set_template() {
			$this->template['placement'] = wpo_field( 'switcher', 'placement', __( 'Placement ' ), array(
				'switch_style' => 'style-14',
				'switch_width' => '5em',
				'on'           => __( 'Before' ),
				'off'          => __( 'After' ),
				// translators: Added Code Tag
				'desc_field'   => sprintf( __( 'If %1$sBefore%2$s Selected Then Title Will Be Displayed Before The Selected Position' ), '<code>', '</code>' ),
			) )->dependency( 'position', 'not-empty' );
			$this->template['position']  = wpo_field( 'select', 'position', __( 'Position' ), array(
				'style'      => 'width:50%',
				'desc_field' => __( 'Where to show the subtitle' ),
				'select2'    => true,
			) );
			$this->template['element']   = wpo_field( 'select', 'element', __( 'Element Tag' ), array(
				'style'      => 'width:50%',
				'options'    => wc_product_subtitle_tags(),
				'desc_field' => __( 'Which Type of html tag you need to have' ),
				'select2'    => true,
			) );
		}

		/**
		 * Inits Settings.
		 */
		public function fields() {
			$this->set_template();
			$general = $this->builder->container( 'general', __( 'General' ) );

			$this->admin_page( $general->container( 'admin', __( 'Admin Settings' ) ) );
			$this->cart_checkout_page( $general->container( 'cart-page', __( 'Cart Page' ) ) );
			$this->mini_cart( $general->container( 'mini-cart', __( 'Mini Cart' ) ) );
			$this->cart_checkout_page( $general->container( 'checkout-page', __( 'Checkout Page' ) ), true );
			$this->order_view_page( $general->container( 'order-view-page', __( 'Order View Page' ) ) );
			$this->shop_page( $general->container( 'shop-page', __( 'Shop Page' ) ) );
			$this->single_product( $general->container( 'single-product', __( 'Single Product' ) ) );
			$this->email( $general->container( 'order-email', __( 'Email' ) ) );
			$this->shortcode( $general->container( 'shortcode', __( 'Shortcode' ) ) );

			$this->builder->container( 'system-info', __( 'System Tool/Info' ), 'dashicons dashicons-info' )
				->set_callback( 'wponion_sysinfo' )
				->set_var( 'developer', 'varunsridharan23@gmail.com' );
		}

		/**
		 * @param \WPO\Container $container
		 */
		protected function admin_page( $container ) {
			$img = wpo_image( wc_product_subtitle()->plugin_url( 'assets/img/wcps-example.jpg' ), wc_product_subtitle()->plugin_url( 'assets/img/wcps-example-big.jpg' ) )->tooltip( __( 'Click To View Full Image' ), array(
				'arrow'     => true,
				'placement' => 'bottom',
				'size'      => 'small',
			) );

			$container->subheading( __( 'Admin Settings' ) );
			$container->switcher( 'admin_column', __( 'Subtitle Column' ) )
				->switch_style( 'style-14' )
				->on( __( 'Enable' ) )
				->off( __( 'Disable' ) )
				->switch_width( '5em' )
				->desc_field( __( 'If enabled a custom product subtitle column will be added in product listing table' ) );
			$container->switcher( 'admin_below_product_title', __( 'Below Product Title' ) )
				->switch_style( 'style-14' )
				->on( __( 'Yes' ) )
				->off( __( 'No' ) )
				->switch_width( '3em' )
				->desc_field( __( 'If Enabled Subtitle Will Be Shown Below The Product Title In Product List Table' ) . ' <br/><br/>' . $img );

			$container->switcher( 'admin_wp_editor', __( 'Subtitle HTML Editor' ) )
				->switch_style( 'style-14' )
				->on( __( 'HTML Editor' ) )
				->off( __( 'Simple Input' ) )
				->switch_width( '8em' )
				->desc_field( __( 'If Enabled Then **HTML** Editor Will Be Shown Instead Of **Text Input**' ) );
			$container->subheading( __( 'F.A.Q' ) );
			$container->faq()
				->faq( __( 'How Do I Style Subtitles ?' ), wc_product_subtitle()->plugin_path( 'assets/markdown/how-do-i-style-subtitles.md' ) )
				->faq( __( 'How i can add my own HTML render Tag ?' ), wc_product_subtitle()->plugin_path( 'assets/markdown/how-i-can-add-my-own-html-render-tag.md' ) );
		}

		/**
		 * @param \WPO\Container $container
		 */
		protected function order_view_page( $container ) {
			$container->subheading( __( 'Order View Page Subtitle Configuration' ) );

			$container->content( '
' . __( 'This Configration Will Be Used In The Following Pages' ) . '
' . __( '1. Order Thank You Page' ) . '
' . __( '2. MyAccount Order View Page' ) . '
' )
				->markdown( true );

			$fieldset = $container->fieldset( 'order_view_page' );
			$fieldset->field( clone( $this->template['position'] ) )
				->options( wp_product_subtitle_placements( 'order_view' ) );
			$fieldset->field( clone( $this->template['placement'] ) );
			$fieldset->field( clone( $this->template['element'] ) );

			$container->subheading( __( 'Frequently Asked Questions' ) );
			$container->faq()
				->faq( __( 'Subtitle not visible in Thank You Page & MyAccount Order View Page ?' ), wc_product_subtitle()->plugin_path( 'assets/markdown/subtitle-not-visible-in-thankyou-page-myaccount-order-view-page.md' ) );
		}

		/**
		 * @param \WPO\Container $container
		 */
		protected function shop_page( $container ) {
			$container->subheading( __( 'Shop Page Subtitle Configuration' ) );

			$fieldset = $container->fieldset( 'shop_page' );
			$fieldset->field( clone( $this->template['position'] ) )
				->options( wp_product_subtitle_placements( 'shop' ) );
			$fieldset->field( clone( $this->template['placement'] ) );
			$fieldset->field( clone( $this->template['element'] ) );

			$container->subheading( __( 'Frequently Asked Questions' ) );
			$container->faq()
				->faq( __( 'Subtitle not visible in shop page' ), wc_product_subtitle()->plugin_path( 'assets/markdown/subtitle-not-visible-in-shop-page.md' ) );
		}

		/**
		 * @param \WPO\Container $container
		 */
		protected function single_product( $container ) {
			$container->subheading( __( 'Single Product Page Subtitle Configuration' ) );

			$fieldset = $container->fieldset( 'single_product' );
			$fieldset->field( clone( $this->template['position'] ) )
				->options( wp_product_subtitle_placements( 'single' ) );
			$fieldset->field( clone( $this->template['placement'] ) );
			$fieldset->field( clone( $this->template['element'] ) );

			$container->subheading( __( 'Frequently Asked Questions' ) );

			$container->faq()
				->faq( __( 'Subtitle not visible in single product page' ), wc_product_subtitle()->plugin_path( 'assets/markdown/subtitle-not-visible-in-single-product-page.md' ) );
		}

		/**
		 * @param \WPO\Container $container
		 * @param bool           $is_checkout
		 */
		protected function cart_checkout_page( $container, $is_checkout = false ) {
			$id    = ( false === $is_checkout ) ? 'cart_page' : 'checkout_page';
			$title = ( false === $is_checkout ) ? __( 'Cart' ) : __( 'Checkout' );

			$container->subheading( $title . ' ' . __( 'Page Subtitle Configuration' ) );

			$fieldset = $container->fieldset( $id );
			$fieldset->field( clone( $this->template['position'] ) )
				->options( wp_product_subtitle_placements( 'cart' ) );
			$fieldset->field( clone( $this->template['placement'] ) );
			$fieldset->field( clone( $this->template['element'] ) );

			$container->subheading( __( 'Frequently Asked Questions' ) );

			$container->faq()
				->faq( sprintf( __( 'Subtitle not visible in %s page ?' ), $title ), wc_product_subtitle()->plugin_path( 'assets/markdown/cart-page.md' ) );
		}

		/**
		 * @param \WPO\Container $container
		 */
		protected function mini_cart( $container ) {
			$container->subheading( __( 'Mini Cart Configuration' ) );
			$fieldset = $container->fieldset( 'mini_cart' );
			$fieldset->add( clone $this->template['position'] )
				->options( wp_product_subtitle_placements( 'mini_cart' ) );

			$fieldset->add( clone $this->template['placement'] );
			$fieldset->add( clone $this->template['element'] );
		}

		/**
		 * @param \WPO\Container $container
		 */
		protected function shortcode( $container ) {
			$container->subheading( __( 'Shortcode Subtitle Configuration' ) );
			$fieldset = $container->fieldset( 'shortcode' );
			$fieldset->field( clone( $this->template['element'] ) );
			$fieldset->markdown( wc_product_subtitle()->plugin_path( 'assets/markdown/shortcode.md' ) );
		}

		/**
		 * @param \WPO\Container $container
		 */
		protected function email( $container ) {
			$container->subheading( __( 'Email Configuration' ) );
			$fieldset = $container->fieldset( 'email' );
			$fieldset->add( clone $this->template['position'] )
				->options( wp_product_subtitle_placements( 'email' ) );
			$fieldset->add( clone $this->template['placement'] );
			$fieldset->add( clone $this->template['element'] );

			$before = wpo_field( 'text', 'before_subtitle', __( 'Before Subtitle' ) )
				->help( __( 'HTML Tags Are Supported' ) )
				->horizontal( true )
				->style( 'width:100%;' );
			$after  = wpo_field( 'text', 'after_subtitle', __( 'After Subtitle' ) )
				->help( __( 'HTML Tags Are Supported' ) )
				->horizontal( true )
				->style( 'width:100%;' );

			$fieldset->content( __( 'Email Before & After Are Used To Add Custom Line Brakes Before & After The Subtitle To Style It Based On Your Needs' ) );

			$html = $fieldset->accordion( 'html' )
				->heading( __( 'HTML Email Before & After' ) )
				->wrap_class( 'col-xs-12 col-md-6' );
			$html->add( clone $before );
			$html->add( clone $after );

			$plain = $fieldset->accordion( 'plain' )
				->heading( __( 'Plain Text Email Before & After' ) )
				->wrap_class( 'col-xs-12 col-md-6' );
			$plain->add( clone $before );
			$plain->add( clone $after );
		}
	}
}
