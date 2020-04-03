<?php
/**
 *
 * @author Varun Sridharan <varunsridharan23@gmail.com>
 * @version 1.0
 * @since 1.0
 * @link
 * @copyright 2019 Varun Sridharan
 * @license GPLV3 Or Greater (https://www.gnu.org/licenses/gpl-3.0.txt)
 */

use VSP\Framework;

if ( ! defined( 'ABSPATH' ) ) {
	die;
}

if ( ! class_exists( 'WC_Product_Subtitle' ) ) {
	/**
	 * Class WC_Product_Subtitle
	 *
	 * @author Varun Sridharan <varunsridharan23@gmail.com>
	 * @since 1.0
	 */
	class WC_Product_Subtitle extends Framework {
		/**
		 * WC_Product_Subtitle constructor.
		 *
		 * @throws \Exception
		 */
		public function __construct() {
			$this->name               = WCPS_NAME;
			$this->version            = WCPS_VERSION;
			$this->db_slug            = '_wcps';
			$this->hook_slug          = 'wc_ps';
			$this->file               = WCPS_FILE;
			$options                  = array(
				'logging'      => false,
				'addons'       => false,
				'localizer'    => false,
				'autoloader'   => array(
					'namespace' => 'WC_Product_Subtitle',
					'base_path' => $this->plugin_path( 'includes/' ),
				),
				'system_tools' => false,
			);
			$options['settings_page'] = array(
				'option_name'    => '_wc_product_subtitle',
				//'framework_title' => __( 'Product Subtitles For WooCommerce' ),
				'framework_desc' => __( 'This handy plugin allows you to easily add a subtitle to your products. also provides various options to customize the output. ', 'wc-product-subtitle' ),
				'theme'          => 'wp',
				'is_single_page' => 'submenu',
				'ajax'           => true,
				'search'         => false,
				'menu'           => array(
					'page_title' => WCPS_NAME,
					'menu_title' => __( 'Product Subtitle', 'wc-product-subtitle' ),
					'submenu'    => 'woocommerce',
					'menu_slug'  => 'product-subtitle',
				),
			);
			parent::__construct( $options );
		}

		/**
		 * Inits Settings Page.
		 */
		public function settings_init_before() {
			$this->_instance( '\WC_Product_Subtitle\Admin\Settings', false, false, $this->slug( 'hook' ) );
		}

		/**
		 * Creates Instance For The Required Classes.
		 */
		public function init_class() {
			if ( vsp_is_admin() ) {
				$this->_instance( '\WC_Product_Subtitle\Admin\Admin' );
			}

			$this->_instance( '\WC_Product_Subtitle\Cart_Page' );
			$this->_instance( '\WC_Product_Subtitle\Checkout_Page' );
			$this->_instance( '\WC_Product_Subtitle\Single_Product_Page' );
			$this->_instance( '\WC_Product_Subtitle\Shop_Page' );
			$this->_instance( '\WC_Product_Subtitle\Order_View_Page' );
			$this->_instance( '\WC_Product_Subtitle\Shortcode' );
			$this->_instance( '\WC_Product_Subtitle\Email' );
			$this->_instance( '\WC_Product_Subtitle\Mini_Cart' );
			$this->_instance( '\WC_Product_Subtitle\Integrations' );
		}
	}
}
