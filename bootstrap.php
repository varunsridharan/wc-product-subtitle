<?php

defined( 'ABSPATH' ) || exit;

use VSP\Framework;

/**
 * Class WC_Product_Subtitle
 *
 * @author Varun Sridharan <varunsridharan23@gmail.com>
 */
final class WC_Product_Subtitle extends Framework {
	/**
	 * WC_Product_Subtitle constructor.
	 *
	 * @throws \Exception
	 */
	public function __construct() {
		$options                  = array(
			'name'         => WCPS_NAME,
			'version'      => WCPS_VERSION,
			'db_slug'      => '_wcps',
			'hook_slug'    => 'wc_ps',
			'file'         => WCPS_FILE,
			'logging'      => false,
			'addons'       => false,
			'localizer'    => false,
			'autoloader'   => array(
				'namespace' => 'WC_Product_Subtitle',
				'base_path' => $this->plugin_path( 'includes/', WCPS_FILE ),
				'options'   => array(
					'classmap' => $this->plugin_path( 'classmaps.php', WCPS_FILE ),
				),
			),
			'system_tools' => false,
		);
		$options['settings_page'] = array(
			'option_name'    => '_wc_product_subtitle',
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
