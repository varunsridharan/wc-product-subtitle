<?php
/**
 * Check the version of WordPress
 *
 * @link https://wordpress.org/plugins/wc-product-subtitle/
 * @package WC Product Subtitle
 * @subpackage WC Product Subtitle/core
 * @since 2.0
 */
class WooCommerce_Product_Subtitle_Version_Check {
    static $version;
    
    public static function activation_check( $version ) {
        self::$version = $version;
        if ( ! self::compatible_version() ) {
            deactivate_plugins(WCPS_FILE);
            wp_die( __( WCPS_NAME . ' requires WordPress ' . self::$version . ' or higher!', WCPS_TXT ) );
        } 
    }
	
    
    public function check_version() {
        if ( ! self::compatible_version() ) {
            if ( is_plugin_active(WCPS_FILE) ) {
                deactivate_plugins(WCPS_FILE);
                add_action( 'admin_notices', array( $this, 'disabled_notice' ) );
                if ( isset( $_GET['activate'] ) ) {
                    unset( $_GET['activate'] );
                }
            } 
        } 
    }
	
   
    public function disabled_notice() {
       echo '<strong>' . esc_html__( WCPS_NAME . ' requires WordPress ' . self::$version . ' or higher!', WCPS_TXT ) . '</strong>';
    } 

    
    public static function compatible_version() {
        if ( version_compare( $GLOBALS['wp_version'], self::$version, '<' ) ) {
             return false;
         }
        return true;
    }
}