<?php 
/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @link https://wordpress.org/plugins/wc-product-subtitle/
 * @package WC Product Subtitle
 * @subpackage WC Product Subtitle/core
 * @since 2.0
 */
class WooCommerce_Product_Subtitle_Activator {
	
    public function __construct() {
    }
	
	public static function activate() {
		require_once(WCPS_INC.'helpers/class-version-check.php');
		require_once(WCPS_INC.'helpers/class-dependencies.php');
		
		if(WooCommerce_Product_Subtitle_Dependencies(WCPS_DEPEN)){
			WooCommerce_Product_Subtitle_Version_Check::activation_check('3.7');	
		} else {
			if ( is_plugin_active(WCPS_FILE) ) { deactivate_plugins(WCPS_FILE);} 
			wp_die(wc_ps_dependency_message());
		}
	} 
 
}