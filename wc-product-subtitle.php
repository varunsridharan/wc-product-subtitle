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
 * Version:           3.1
 * Author:            Varun Sridharan
 * Author URI:        http://varunsridharan.in
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       woocommerce-product-subtitle
 * Domain Path:       /languages
 * WC requires at least: 2.8.0
 * WC tested up to: 3.5.0
 */

define('WCPS_DEPEN','woocommerce/woocommerce.php');
define('WCPS_NAME', 'WooCommerce Product Subtitle'); # Plugin Name
define('WCPS_SLUG', 'woocommerce-product-subtitle'); # Plugin Slug
define('WCPS_TXT',  'woocommerce-product-subtitle'); #plugin lang Domain
define('WCPS_DB', 'wc_ps_');
define('WCPS_V','3.1'); # Plugin Version

define('WCPS_FILE',plugin_basename( __FILE__ ));
define('WCPS_PATH',plugin_dir_path( __FILE__ )); # Plugin DIR
define('WCPS_FRAMEWORK',WCPS_PATH.'vsp-framework/'); # Plugin DIR
define('WCPS_INC',WCPS_PATH.'includes/'); # Plugin INC Folder
define('WCPS_LANGUAGE_PATH',WCPS_PATH.'languages'); # Plugin Language Folder

define('WCPS_URL',plugins_url('', __FILE__ ).'/');  # Plugin URL
define('WCPS_CSS',WCPS_URL.'includes/css/'); # Plugin CSS URL
define('WCPS_IMG',WCPS_URL.'includes/img/'); # Plugin IMG URL
define('WCPS_JS',WCPS_URL.'includes/js/'); # Plugin JS URL



require_once(WCPS_FRAMEWORK.'vsp-init.php');
require_once(WCPS_INC.'functions.php');

if(function_exists("vsp_mayby_framework_loader")){
    vsp_mayby_framework_loader(WCPS_PATH);
}

register_activation_hook( __FILE__, 'wc_ps_activate_plugin' );
register_deactivation_hook( __FILE__, 'wc_ps_deactivate_plugin' );
register_deactivation_hook( WCPS_DEPEN, 'wc_ps_dependency_deactivate' );

if(!function_exists("wc_ps_activate_plugin")){
    function wc_ps_activate_plugin(){
        vsp_plugin_activator(array(
            'dependency' => WCPS_DEPEN,
            'required_wp_version' => '3.0',
            'plugin_file' => WCPS_FILE,
            'dependency_message' => '<b>'.WCPS_NAME.'</b> '.__(' Requires WooCommerce To Be Installed. <br/> <i> Plugin Deactivated ',WCPS_TXT),
        ));
    }
}

if(!function_exists("wc_ps_deactivate_plugin")){
    function wc_ps_deactivate_plugin(){
        vsp_plugin_deactivator();
    }
}

if(!function_exists("wc_ps_dependency_deactivate")){
    function wc_ps_dependency_deactivate(){
        vsp_plugin_dependency_deactivator(WCPS_FILE);
    }
}

add_action("vsp_framework_loaded",'WooCommerce_Product_Subtitle');

function WooCommerce_Product_Subtitle(){
    require_once(WCPS_PATH .'bootstrap.php');
    return WooCommerce_Product_Subtitle::get_instance();  
}
