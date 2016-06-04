<?php
/**
 * Plugin's Admin code
 *
 * @link https://wordpress.org/plugins/wc-product-subtitle/
 * @package WC Product Subtitle
 * @subpackage WC Product Subtitle/Admin
 * @since 2.0
 */
if ( ! defined( 'WPINC' ) ) { die; }

class WooCommerce_Product_Subtitle_Admin {

    /**
	 * Initialize the class and set its properties.
	 * @since      0.1
	 */
	public function __construct() {
        add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_styles' ),99);
        add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );

        add_filter( 'plugin_row_meta', array($this, 'plugin_row_links' ), 10, 2 );
        add_filter( 'plugin_action_links_'.WCPS_FILE, array($this,'plugin_action_links'),10,10); 
        add_filter( 'woocommerce_screen_ids',array($this,'set_wc_screen_ids'),99);
        
        $this->admin_init();
	}

    public function set_wc_screen_ids($screens){ 
        $screen = $screens; 
      	$screen[] = 'woocommerce_page_woocommerce-product-subtitle-settings';
        return $screen;
    }
    
    /**
     * Inits Admin Sttings
     */
    public function admin_init(){ 
        new WooCommerce_Product_Subtitle_Admin_Handler;
    }
    
    /**
	 * Register the stylesheets for the admin area.
	 */
	public function enqueue_styles() { 
        $current_screen = wc_ps_current_screen();
        
        wp_register_style(WCPS_SLUG.'_backend_style',WCPS_CSS.'backend.css' , array(), WCPS_V, 'all' );  
        
        if(in_array($current_screen , wc_ps_get_screen_ids())) {
            wp_enqueue_style(WCPS_SLUG.'_backend_style');  
        }
	}
	
    
    /**
	 * Register the JavaScript for the admin area.
	 */
	public function enqueue_scripts() {
        $current_screen = wc_ps_current_screen();

        wp_register_script(WCPS_SLUG.'_backend_script', WCPS_JS.'backend.js', array('jquery'), WCPS_V, false );  
        
        if(in_array($current_screen , wc_ps_get_screen_ids())) {
            wp_enqueue_script(WCPS_SLUG.'_backend_script' ); 
        } 

    }
     
 
    /**
	 * Adds Some Plugin Options
	 * @param  array  $plugin_meta
	 * @param  string $plugin_file
	 * @since 0.11
	 * @return array
	 */
    public function plugin_action_links($action,$file,$plugin_meta,$status){
        $settings_url = admin_url('admin.php?page=woocommerce-product-subtitle-settings');
        $actions[] = sprintf('<a href="%s">%s</a>', $settings_url, __('Settings',WCPS_TXT) );
        $action = array_merge($actions,$action);
        return $action;
    }
    
    /**
	 * Adds Some Plugin Options
	 * @param  array  $plugin_meta
	 * @param  string $plugin_file
	 * @since 0.11
	 * @return array
	 */
	public function plugin_row_links( $plugin_meta, $plugin_file ) {
		if ( WCPS_FILE == $plugin_file ) {
            $plugin_meta[] = sprintf('<a href="%s">%s</a>', 'https://wordpress.org/plugins/wc-product-subtitle/faq/', __('F.A.Q',WCPS_TXT) );
            $plugin_meta[] = sprintf('<a href="%s">%s</a>', 'https://github.com/technofreaky/wc-product-subtitle', __('View On Github',WCPS_TXT) );
            $plugin_meta[] = sprintf('<a href="%s">%s</a>', 'https://github.com/technofreaky/wc-product-subtitle/issues', __('Report Issue',WCPS_TXT) );
		}
		return $plugin_meta;
	}	    
}