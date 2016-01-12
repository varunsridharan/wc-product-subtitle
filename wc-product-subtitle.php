<?php
/**
 * Plugin Name:       WooCommerce Product Subtitle
 * Plugin URI:        https://wordpress.org/plugins/woocommerce-product-subtitle/
 * Description:       Sample Plugin For WooCommerce
 * Version:           0.1
 * Author:            Varun Sridharan
 * Author URI:        http://varunsridharan.in
 * Text Domain:       woocommerce-product-subtitle
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt 
 * GitHub Plugin URI: @TODO
 */

if ( ! defined( 'WPINC' ) ) { die; }
define('WCPS_FILE',plugin_basename( __FILE__ )); # Current File
require_once(plugin_dir_path(__FILE__).'bootstrap.php');
require_once(plugin_dir_path(__FILE__).'includes/class-dependencies.php');


if(WooCommerce_Product_Subtitle_Dependencies()){
	if(!function_exists('WooCommerce_Product_Subtitle')){
		function WooCommerce_Product_Subtitle(){
			return WooCommerce_Product_Subtitle::get_instance();
		}
	}
	WooCommerce_Product_Subtitle();
}

?>