<?php

namespace WC_Product_Subtitle\Admin;

defined( 'ABSPATH' ) || exit;

use VSP\Base;

/**
 * Class Admin
 *
 * @package WC_Product_Subtitle\Admin
 * @author Varun Sridharan <varunsridharan23@gmail.com>
 */
class Admin extends Base {
	/**
	 * On Class Init.
	 */
	public function __construct() {
		$this->_instance( '\WC_Product_Subtitle\Admin\Product\Field' );
		$this->_instance( '\WC_Product_Subtitle\Admin\Product\Render' );
		$this->_instance( '\WC_Product_Subtitle\Admin\Markdown_Content' );

		if ( wc_ps_option( 'admin_order' ) ) {
			$this->_instance( '\WC_Product_Subtitle\Admin\Order_Render' );
		}

		wponion_plugin_links( $this->plugin()->file() )
			->action_link_before( 'settings', __( '⚙️ Settings', 'wc-product-subtitle' ), admin_url( 'admin.php?page=product-subtitle' ) )
			->action_link_after( 'sysinfo', __( 'ℹ️ System Info', 'wc-product-subtitle' ), admin_url( 'admin.php?page=product-subtitle&container-id=system-info' ) )
			->row_link( __( '📚 F.A.Q', 'wc-product-subtitle' ), 'https://wordpress.org/plugins/wc-product-subtitle/faq' )
			->row_link( __( '📦 View On Github', 'wc-product-subtitle' ), 'https://github.com/varunsridharan/wc-product-subtitle' )
			->row_link( __( '📝 Report An Issue', 'wc-product-subtitle' ), 'https://github.com/varunsridharan/wc-product-subtitle/issues' )
			->row_link( __( '💁🏻 Donate', 'wc-product-subtitle' ), 'https://paypal.me/varunsridharan' );
	}
}
