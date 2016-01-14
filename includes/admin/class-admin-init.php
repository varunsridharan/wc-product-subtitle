<?php
/**
 * The admin-specific functionality of the plugin.
 * @package    @TODO
 * @subpackage @TODO
 * @author     Varun Sridharan <varunsridharan23@gmail.com>
 */
if ( ! defined( 'WPINC' ) ) { die; }

class WooCommerce_Product_Subtitle_Admin extends WooCommerce_Product_Subtitle {

    /**
	 * Initialize the class and set its properties.
	 * @since      0.1
	 */
	public function __construct() {
        add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_styles' ),99);
        add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
        add_action( 'admin_init', array( $this, 'admin_init' ));
		add_filter( 'plugin_row_meta', array($this, 'plugin_row_links' ), 10, 2 );
	}

    /**
     * Inits Admin Sttings
     */
    public function admin_init(){
       new WooCommerce_Product_Subtitle_Admin_PostTypes;
	   new WooCommerce_Product_Subtitle_Settings_Intergation;
    }
  
    /**
	 * Register the stylesheets for the admin area.
	 */
	public function enqueue_styles() { 
        wp_enqueue_style(WCPS_SLUG.'_core_style',WCPS_CSS.'style.css' , array(), WCPS_V, 'all' ); 
	}
	
    
    /**
	 * Register the JavaScript for the admin area.
	 */
	public function enqueue_scripts() {
        if(in_array($this->current_screen() , $this->get_screen_ids())) {
            wp_enqueue_script(WCPS_SLUG.'_core_script', WCPS_JS.'script.js', array('jquery'), WCPS_V, false ); 
        }
 
	}
    
    /**
     * Gets Current Screen ID from wordpress
     * @return string [Current Screen ID]
     */
    public function current_screen(){
       $screen =  get_current_screen();
       return $screen->id;
    }
    
    /**
     * Returns Predefined Screen IDS
     * @return [Array] 
     */
    public function get_screen_ids(){
        $screen_ids = array();
        return $screen_ids;
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
			$settings_url = admin_url('admin.php?page=wc-settings&tab=products&section=wcpss')	;
            $plugin_meta[] = sprintf('<a href="%s">%s</a>', $settings_url, __('Settings',WCPS_TXT) );
            $plugin_meta[] = sprintf('<a href="%s">%s</a>', 'https://wordpress.org/plugins/wc-product-subtitle/faq/', __('F.A.Q',WCPS_TXT) );
            $plugin_meta[] = sprintf('<a href="%s">%s</a>', 'https://github.com/technofreaky/wc-product-subtitle', __('View On Github',WCPS_TXT) );
            $plugin_meta[] = sprintf('<a href="%s">%s</a>', 'https://github.com/technofreaky/wc-product-subtitle/issues', __('Report Issue',WCPS_TXT) );
		}
		return $plugin_meta;
	}	    
}

?>