<?php

namespace WC_Product_Subtitle\Admin;

defined( 'ABSPATH' ) || exit;

use VSP\Core\Abstracts\Plugin_Settings;

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
			$this->template['placement'] = wpo_field( 'switcher', 'placement', __( 'Placement ', 'wc-product-subtitle' ), array(
				'switch_style' => 'style-14',
				'switch_width' => '5em',
				'on'           => __( 'Before', 'wc-product-subtitle' ),
				'off'          => __( 'After', 'wc-product-subtitle' ),
				// translators: Added Code Tag
				'desc_field'   => sprintf( __( 'If %1$sBefore%2$s Selected Then Title Will Be Displayed Before The Selected Position', 'wc-product-subtitle' ), '<code>', '</code>' ),
			) );
			$this->template['placement']->dependency( 'position', 'not-empty' );
			$this->template['position']     = wpo_field( 'select', 'position', __( 'Position', 'wc-product-subtitle' ), array(
				'style'      => 'width:15%',
				'desc_field' => __( 'Where to show the subtitle', 'wc-product-subtitle' ),
				'select2'    => true,
			) );
			$this->template['element']      = wpo_field( 'select', 'element', __( 'Element Tag', 'wc-product-subtitle' ), array(
				'style'      => 'width:10%',
				'options'    => wcps_subtitle_tags(),
				'desc_field' => __( 'Which Type of html tag you need to have', 'wc-product-subtitle' ),
				'select2'    => true,
			) );
			$this->template['product_link'] = wpo_field( 'switcher', 'product_link', __( 'Link To Product', 'wc-product-subtitle' ), array(
				'switch_style' => 'style-11',
				'switch_width' => '5em',
				'on'           => __( 'Yes', 'wc-product-subtitle' ),
				'off'          => __( 'No', 'wc-product-subtitle' ),
				// translators: Added Code Tag
				'desc_field'   => __( 'Enabling this feature will add product\'s to the subtitle', 'wc-product-subtitle' ),
			) );
		}

		/**
		 * Generates Basic Settings Fields.
		 * Inits Settings.
		 */
		public function fields() {
			$this->set_template();
			$general = $this->builder->container( 'general', __( 'General', 'wc-product-subtitle' ), 'wpoic-settings' );

			$this->general( $general->container( 'admin', __( 'General Settings', 'wc-product-subtitle' ) ) );
			$this->cart_checkout_page( $general->container( 'cart_page', __( 'Cart Page', 'wc-product-subtitle' ) ) );
			$this->mini_cart( $general->container( 'mini-cart', __( 'Mini Cart', 'wc-product-subtitle' ) ) );
			$this->cart_checkout_page( $general->container( 'checkout_page', __( 'Checkout Page', 'wc-product-subtitle' ) ), true );
			$this->order_view_page( $general->container( 'order-view-page', __( 'Order View Page', 'wc-product-subtitle' ) ) );
			$this->shop_page( $general->container( 'shop-page', __( 'Shop Page', 'wc-product-subtitle' ) ) );
			$this->single_product( $general->container( 'single-product', __( 'Single Product', 'wc-product-subtitle' ) ) );
			$this->email( $general->container( 'order-email', __( 'Email', 'wc-product-subtitle' ) ) );
			$this->shortcode( $general->container( 'shortcode', __( 'Shortcode', 'wc-product-subtitle' ) ) );

			$this->builder->container( 'docs', __( 'Documentation', 'wc-product-subtitle' ), 'wpoic-book' )
				->container_class( 'wpo-text-success' )
				->href( 'https://wordpress.org/plugins/wc-product-subtitle/' )
				->attribute( 'target', '_blank' );

			$this->builder->container( 'sysinfo', __( 'System Info', 'wc-product-subtitle' ), ' wpoic-info ' )
				->callback( 'wponion_sysinfo' )
				->set_var( 'developer', 'varunsridharan23@gmail.com' );
		}

		/**
		 * General Settings Fields.
		 *
		 * @param \WPO\Container $container
		 */
		protected function general( $container ) {
			$img = wpo_image( wc_product_subtitle()->plugin_url( 'assets/img/wcps-example.jpg' ), wc_product_subtitle()->plugin_url( 'assets/img/wcps-example-big.jpg' ) )->tooltip( __( 'Click To View Full Image', 'wc-product-subtitle' ), array(
				'arrow'     => true,
				'placement' => 'bottom',
				'size'      => 'small',
			) );

			$container->subheading( __( 'Admin Settings', 'wc-product-subtitle' ) );
			$container->switcher( 'admin_column', __( 'Subtitle Column', 'wc-product-subtitle' ) )
				->switch_style( 'style-14' )
				->on( __( 'Enable', 'wc-product-subtitle' ) )
				->off( __( 'Disable', 'wc-product-subtitle' ) )
				->switch_width( '5em' )
				->desc_field( __( 'If enabled a custom product subtitle column will be added in product listing table', 'wc-product-subtitle' ) );
			$container->switcher( 'admin_order', __( 'Admin Order View', 'wc-product-subtitle' ) )
				->switch_style( 'style-14' )
				->on( __( 'Enable', 'wc-product-subtitle' ) )
				->off( __( 'Disable', 'wc-product-subtitle' ) )
				->switch_width( '5em' )
				->desc_field( __( 'If enabled a custom product subtitle column will be added in single order product listing table in admin', 'wc-product-subtitle' ) );
			$container->switcher( 'admin_below_product_title', __( 'Below Product Title', 'wc-product-subtitle' ) )
				->switch_style( 'style-14' )
				->on( __( 'Yes', 'wc-product-subtitle' ) )
				->off( __( 'No', 'wc-product-subtitle' ) )
				->switch_width( '3em' )
				->desc_field( __( 'If Enabled Subtitle Will Be Shown Below The Product Title In Product List Table', 'wc-product-subtitle' ) . ' <br/><br/>' . $img );

			$container->switcher( 'admin_wp_editor', __( 'Subtitle HTML Editor', 'wc-product-subtitle' ) )
				->switch_style( 'style-14' )
				->on( __( 'HTML Editor', 'wc-product-subtitle' ) )
				->off( __( 'Simple Input', 'wc-product-subtitle' ) )
				->switch_width( '8em' )
				->desc_field( __( 'If Enabled Then `HTML` Editor Will Be Shown Instead Of `Text Input`', 'wc-product-subtitle' ) );

			$iswcpdf_active    = wp_is_plugin_active( 'woocommerce-pdf-invoices-packing-slips/woocommerce-pdf-invoices-packingslips.php' );
			$iswcpdf_installed = wp_is_plugin_installed( 'woocommerce-pdf-invoices-packing-slips/woocommerce-pdf-invoices-packingslips.php' );
			$wrap_label        = false;
			if ( false === $iswcpdf_active ) {
				$title      = ( false === $iswcpdf_installed ) ? __( 'Plugin Not Installed', 'wc-product-subtitle' ) : __( 'Plugin Not Active', 'wc-product-subtitle' );
				$type       = ( false === $iswcpdf_installed ) ? 'danger' : 'warning';
				$wrap_label = array(
					'content'   => $title,
					'placement' => 'top-left',
					'type'      => $type,
				);
			}

			$container->subheading( __( 'Integrations', 'wc-product-subtitle' ) );
			$container->switcher( 'wcpdfinvoiceandpackingslip', __( 'WC PDF Invoices & Packing Slip', 'wc-product-subtitle' ) )
				->badge( $wrap_label )
				->desc_field( __( 'Enable this field to show subtitles in [WooCommerce PDF Invoice & Packing Slip](https://wordpress.org/plugins/woocommerce-pdf-invoices-packing-slips/) Plugin', 'wc-product-subtitle' ) );

			$container->subheading( __( 'F.A.Q', 'wc-product-subtitle' ) );
			$container->faq()->faq( __( 'How Do I Style Subtitles ?', 'wc-product-subtitle' ), array(
				FAQ::instance(),
				'hdiss',
			) );
		}

		/**
		 * order_view_page fields.
		 *
		 * @param \WPO\Container $container
		 */
		protected function order_view_page( $container ) {
			$container->subheading( __( 'Order View Page Subtitle Configuration', 'wc-product-subtitle' ) );
			$container->content( '
' . __( 'This Configration Will Be Used In The Following Pages', 'wc-product-subtitle' ) . '
' . __( '1. Order Thank You Page', 'wc-product-subtitle' ) . '
' . __( '2. MyAccount Order View Page', 'wc-product-subtitle' ) . '
' )->markdown( true );

			$fieldset = $container->set_group( 'order_view_page' );
			$fieldset->add_field( clone( $this->template['position'] ) )
				->options( wcps_subtitle_placement_areas( 'order_view' ) );
			$fieldset->add_field( clone( $this->template['placement'] ) );
			$fieldset->add_field( clone( $this->template['product_link'] ) );
			$fieldset->add_field( clone( $this->template['element'] ) );

			$container->subheading( __( 'Frequently Asked Questions', 'wc-product-subtitle' ) );
			$container->faq()
				->faq( __( 'Subtitle not visible in Thank You Page & MyAccount Order View Page ?', 'wc-product-subtitle' ), array(
					FAQ::instance(),
					'order_view_page',
				) );
		}

		/**
		 * shop page fields.
		 *
		 * @param \WPO\Container $container
		 */
		protected function shop_page( $container ) {
			$container->subheading( __( 'Shop Page Subtitle Configuration', 'wc-product-subtitle' ) );

			$fieldset = $container->set_group( 'shop_page' );
			$fieldset->add_field( clone( $this->template['position'] ) )
				->options( wcps_subtitle_placement_areas( 'shop' ) );
			$fieldset->add_field( clone( $this->template['placement'] ) );
			$fieldset->add_field( clone( $this->template['product_link'] ) );
			$fieldset->add_field( clone( $this->template['element'] ) );

			$container->subheading( __( 'Frequently Asked Questions', 'wc-product-subtitle' ) );
			$container->faq()->faq( __( 'Subtitle not visible in shop page', 'wc-product-subtitle' ), array(
				FAQ::instance(),
				'shop_page',
			) );
		}

		/**
		 * single product fields.
		 *
		 * @param \WPO\Container $container
		 */
		protected function single_product( $container ) {
			$container->subheading( __( 'Single Product Page Subtitle Configuration', 'wc-product-subtitle' ) );

			$fieldset = $container->set_group( 'single_product' );
			$fieldset->add_field( clone( $this->template['position'] ) )
				->options( wcps_subtitle_placement_areas( 'single' ) );
			$fieldset->add_field( clone( $this->template['placement'] ) );
			$fieldset->add_field( clone( $this->template['product_link'] ) );
			$fieldset->add_field( clone( $this->template['element'] ) );

			$container->subheading( __( 'Frequently Asked Questions', 'wc-product-subtitle' ) );

			$container->faq()->faq( __( 'Subtitle not visible in single product page', 'wc-product-subtitle' ), array(
				FAQ::instance(),
				'single_product',
			) );
		}

		/**
		 * cart / checkout page fields.
		 *
		 * @param \WPO\Container $container
		 * @param bool           $is_checkout
		 */
		protected function cart_checkout_page( $container, $is_checkout = false ) {
			$container = $container->set_group( true );
			$title     = ( false === $is_checkout ) ? __( 'Cart', 'wc-product-subtitle' ) : __( 'Checkout', 'wc-product-subtitle' );

			$container->subheading( $title . ' ' . __( 'Page Subtitle Configuration', 'wc-product-subtitle' ) );
			$container->add_field( clone( $this->template['position'] ) )
				->options( wcps_subtitle_placement_areas( 'cart' ) );
			$container->add_field( clone( $this->template['placement'] ) );
			$container->add_field( clone( $this->template['product_link'] ) );
			$container->add_field( clone( $this->template['element'] ) );

			$container->subheading( __( 'Frequently Asked Questions', 'wc-product-subtitle' ) );

			$faq = $container->faq();
			// translators: Added Current Section Title
			$faq->faq( sprintf( __( 'Subtitle not visible in %s page ?', 'wc-product-subtitle' ), $title ), array(
				FAQ::instance(),
				'cart_checkout',
			) );
		}

		/**
		 * mini cart fields.
		 *
		 * @param \WPO\Container $container
		 */
		protected function mini_cart( $container ) {
			$container->subheading( __( 'Mini Cart Configuration', 'wc-product-subtitle' ) );
			$fieldset = $container->set_group( 'mini_cart' );
			$fieldset->add( clone $this->template['position'] )
				->options( wcps_subtitle_placement_areas( 'mini_cart' ) );

			$fieldset->add( clone $this->template['placement'] );
			$fieldset->add( clone( $this->template['product_link'] ) );
			$fieldset->add( clone $this->template['element'] );
		}

		/**
		 * shortcode fields.
		 *
		 * @param \WPO\Container $container
		 */
		protected function shortcode( $container ) {
			$container->subheading( __( 'Shortcode Subtitle Configuration', 'wc-product-subtitle' ) );
			$fieldset = $container->set_group( 'shortcode' );
			$fieldset->add_field( clone( $this->template['element'] ) );
			$fieldset->content()->content( array( FAQ::instance(), 'shortcode' ) )->markdown( true );
		}

		/**
		 * Email fields.
		 *
		 * @param \WPO\Container $container
		 */
		protected function email( $container ) {
			$container->subheading( __( 'Email Configuration', 'wc-product-subtitle' ) );
			$fieldset = $container->set_group( 'email' );
			$fieldset->add( clone $this->template['position'] )->options( wcps_subtitle_placement_areas( 'email' ) );
			$fieldset->add( clone $this->template['placement'] );
			$fieldset->add( clone( $this->template['product_link'] ) );
			$fieldset->add( clone $this->template['element'] );

			$before = wpo_field( 'text', 'before_subtitle', __( 'Before Subtitle', 'wc-product-subtitle' ) )
				->help( __( 'HTML Tags Are Supported', 'wc-product-subtitle' ) )
				->horizontal( true )
				->wrap_class( 'col-xs-12 col-md-6' )
				->style( 'width:100%;' );
			$after  = wpo_field( 'text', 'after_subtitle', __( 'After Subtitle', 'wc-product-subtitle' ) )
				->help( __( 'HTML Tags Are Supported', 'wc-product-subtitle' ) )
				->horizontal( true )
				->wrap_class( 'col-xs-12 col-md-6' )
				->style( 'width:100%;' );

			$fieldset->content( __( 'Email Before & After Are Used To Add Custom Line Brakes Before & After The Subtitle To Style It Based On Your Needs', 'wc-product-subtitle' ) );

			$html = $fieldset->accordion( 'html' )->heading( __( 'HTML Email Before & After', 'wc-product-subtitle' ) );
			$html->add( clone $before );
			$html->add( clone $after );

			$plain = $fieldset->accordion( 'plain' )
				->heading( __( 'Plain Text Email Before & After', 'wc-product-subtitle' ) );
			$plain->add( clone $before );
			$plain->add( clone $after );
		}
	}
}
