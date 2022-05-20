<?php
/**
 * Plugin Name: Product Subtitle For WooCommerce
 * Plugin URI: https://wordpress.org/plugins/wc-product-subtitle
 * Description: Create Custom Product Subtitle For WooCommerce Products.
 * Version: 4.6.2
 * Author: Varun Sridharan
 * Author URI: http://varunsridharan.in
 * Text Domain: wc-product-subtitle
 * Domain Path: /i18n
 * WC requires at least: 3.0
 * WC tested up to: 6.5.1
 */

defined( 'ABSPATH' ) || exit;

use Varunsridharan\WordPress\Plugin_Version_Management;

defined( 'WCPS_VERSION' ) || define( 'WCPS_VERSION', '4.6.2' );
defined( 'WCPS_FILE' ) || define( 'WCPS_FILE', __FILE__ );
defined( 'WCPS_NAME' ) || define( 'WCPS_NAME', __( 'Product Subtitle For WooCommerce', 'wc-product-subtitle' ) );

require_once __DIR__ . '/vendor/autoload.php';

if ( function_exists( 'wponion_load' ) ) {
	wponion_load( __DIR__ . '/vendor/wponion/wponion' );
}

if ( function_exists( 'vsp_maybe_load' ) ) {
	vsp_maybe_load( 'wc_product_subtitle_init', __DIR__ . '/vendor/varunsridharan/' );
}

register_activation_hook( __FILE__, 'wc_product_subtitle_installer' );

if ( ! function_exists( 'wc_product_subtitle_installer' ) ) {
	/**
	 * Triggers Plugin Installer.
	 */
	function wc_product_subtitle_installer() {
		vsp_force_load_vendors();
		require_once __DIR__ . '/installer/index.php';

		$instance = new Plugin_Version_Management( array(
			'slug'    => 'wc-product-subtitle',
			'version' => WCPS_VERSION,
			'logs'    => false,
		), array(
			'4.0' => array( '\WC_Product_Subtitle\Installer\Installer', 'run_v4' ),
		) );
		$instance->run();
	}
}

if ( ! function_exists( 'wc_product_subtitle_init' ) ) {
	/**
	 * Inits Plugin Instance.
	 *
	 * @return bool|\WC_Product_Subtitle
	 */
	function wc_product_subtitle_init() {
		if ( vsp_add_wc_required_notice( WCPS_NAME, '3.0', '>=' ) ) {
			return false;
		}
		require_once __DIR__ . '/includes/functions.php';
		require_once __DIR__ . '/bootstrap.php';
		return wc_product_subtitle();
	}
}

if ( ! function_exists( 'wc_product_subtitle' ) ) {
	/**
	 * Returns Product Subtitle Instance.
	 *
	 * @return \WC_Product_Subtitle
	 */
	function wc_product_subtitle() {
		return WC_Product_Subtitle::instance();
	}
}
