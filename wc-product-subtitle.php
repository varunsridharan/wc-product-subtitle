<?php 
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://wordpress.org/plugins/wc-product-subtitle/
 * @since             2.0
 * @package           WooCommerce Product Subtitle
 *
 * @wordpress-plugin
 * Plugin Name:       WooCommerce Product Subtitle
 * Plugin URI:        https://wordpress.org/plugins/wc-product-subtitle/
 * Description:       WC Product Subtitle plugin allows you to easily add a subtitle to your Products.
 * Version:           2.1
 * Author:            Varun Sridharan
 * Author URI:        http://varunsridharan.in
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       woocommerce-product-subtitle
 * Domain Path:       /languages
 */

if ( ! defined( 'WPINC' ) ) { die; }
 
define('WCPS_FILE',plugin_basename( __FILE__ ));
define('WCPS_PATH',plugin_dir_path( __FILE__ )); # Plugin DIR
define('WCPS_INC',WCPS_PATH.'includes/'); # Plugin INC Folder
define('WCPS_DEPEN','woocommerce/woocommerce.php');

register_activation_hook( __FILE__, 'wc_ps_activate_plugin' );
register_deactivation_hook( __FILE__, 'wc_ps_deactivate_plugin' );
register_deactivation_hook( WCPS_DEPEN, 'wc_ps_dependency_deactivate' );



/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-plugin-name-activator.php
 */
function wc_ps_activate_plugin() {
	require_once(WCPS_INC.'helpers/class-activator.php');
	WooCommerce_Product_Subtitle_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-plugin-name-deactivator.php
 */
function wc_ps_deactivate_plugin() {
	require_once(WCPS_INC.'helpers/class-deactivator.php');
	WooCommerce_Product_Subtitle_Deactivator::deactivate();
}


/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-plugin-name-deactivator.php
 */
function wc_ps_dependency_deactivate() {
	require_once(WCPS_INC.'helpers/class-deactivator.php');
	WooCommerce_Product_Subtitle_Deactivator::dependency_deactivate();
}



require_once(WCPS_INC.'functions.php');
require_once(plugin_dir_path(__FILE__).'bootstrap.php');

if(!function_exists('WooCommerce_Product_Subtitle')){
    function WooCommerce_Product_Subtitle(){
        return WooCommerce_Product_Subtitle::get_instance();
    }
}
WooCommerce_Product_Subtitle();