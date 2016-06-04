<?php
/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @link https://wordpress.org/plugins/wc-product-subtitle/
 * @package WC Product Subtitle
 * @subpackage WC Product Subtitle/core
 * @since 2.0
 */
class WooCommerce_Product_Subtitle_Deactivator {

    
	public static function deactivate() { }

	public static function dependency_deactivate(){ 
		if ( is_plugin_active(WCPS_FILE) ) {
			add_action('update_option_active_plugins', array(__CLASS__,'deactivate_dependent'));
		}
	}
	
	public static function deactivate_dependent(){
		deactivate_plugins(WCPS_FILE);
	}

}