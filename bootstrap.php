<?php 
/**
 * Plugin Main File
 *
 * @link https://wordpress.org/plugins/wc-product-subtitle/
 * @package WC Product Subtitle
 * @subpackage WC Product Subtitle/core
 * @since 2.0
 */
if ( ! defined( 'WPINC' ) ) { die; }
 
class WooCommerce_Product_Subtitle {
	public $version = '2.0';
	public $plugin_vars = array();
	
	protected static $_instance = null; # Required Plugin Class Instance
    protected static $functions = null; # Required Plugin Class Instance
	protected static $admin = null;     # Required Plugin Class Instance
	protected static $settings = null;  # Required Plugin Class Instance

    /**
     * Creates or returns an instance of this class.
     */
    public static function get_instance() {
        if ( null == self::$_instance ) {
            self::$_instance = new self;
        }
        return self::$_instance;
    }
    
    /**
     * Class Constructor
     */
    public function __construct() {
        $this->define_constant();
        $this->load_required_files();
        $this->init_class();
        add_action('plugins_loaded', array( $this, 'after_plugins_loaded' ));
        add_filter('load_textdomain_mofile',  array( $this, 'load_plugin_mo_files' ), 10, 2);
    }
	
	/**
	 * Throw error on object clone.
	 *
	 * Cloning instances of the class is forbidden.
	 *
	 * @since 1.0
	 * @return void
	 */
	public function __clone() {
		_doing_it_wrong( __FUNCTION__, __( 'Cloning instances of the class is forbidden.', WCPS_TXT), WCPS_V );
	}	

	/**
	 * Disable unserializing of the class
	 *
	 * Unserializing instances of the class is forbidden.
	 *
	 * @since 1.0
	 * @return void
	 */
	public function __wakeup() {
		_doing_it_wrong( __FUNCTION__, __( 'Unserializing instances of the class is forbidden.',WCPS_TXT), WCPS_V);
	}

    /**
     * Loads Required Plugins For Plugin
     */
    private function load_required_files(){
       $this->load_files(WCPS_INC.'abstract-*.php');
       $this->load_files(WCPS_INC.'class-tag-*.php');
       $this->load_files(WCPS_INC.'class-subtitle-*.php');
        
	   $this->load_files(WCPS_ADMIN.'settings_framework/class-wp-*.php');
        
       if(wc_ps_is_request('admin')){
           $this->load_files(WCPS_ADMIN.'class-*.php');
       } 
    }
    
    /**
     * Inits loaded Class
     */
    private function init_class(){
		self::$settings = new WooCommerce_Product_Subtitle_Settings_Framework; 

        if(wc_ps_is_request('admin')){
            self::$admin = new WooCommerce_Product_Subtitle_Admin;
        }
        
        do_action('wc_ps_init');
    }
    
    
	# Returns Plugin's Functions Instance
	public function func(){
		return self::$functions;
	}
	
	# Returns Plugin's Settings Instance
	public function settings(){
		return self::$settings;
	}
	
	# Returns Plugin's Admin Instance
	public function admin(){
		return self::$admin;
	}
    
    /**
     * Loads Files Based On Give Path & regex
     */
    protected function load_files($path,$type = 'require'){
        foreach( glob( $path ) as $files ){
            if($type == 'require'){ require_once( $files ); } 
			else if($type == 'include'){ include_once( $files ); }
        } 
    }
    
    /**
     * Set Plugin Text Domain
     */
    public function after_plugins_loaded(){
        load_plugin_textdomain(WCPS_TXT, false, WCPS_LANGUAGE_PATH );
    }
    
    /**
     * load translated mo file based on wp settings
     */
    public function load_plugin_mo_files($mofile, $domain) {
        if (WCPS_TXT === $domain)
            return WCPS_LANGUAGE_PATH.'/'.get_locale().'.mo';

        return $mofile;
    }
    
    /**
     * Define Required Constant
     */
    private function define_constant(){
        $this->define('WCPS_NAME', 'WooCommerce Product Subtitle'); # Plugin Name
        $this->define('WCPS_SLUG', 'woocommerce-product-subtitle'); # Plugin Slug
        $this->define('WCPS_TXT',  'woocommerce-product-subtitle'); #plugin lang Domain
		$this->define('WCPS_DB', 'wc_ps_');
		$this->define('WCPS_V',$this->version); # Plugin Version
		
		$this->define('WCPS_LANGUAGE_PATH',WCPS_PATH.'languages'); # Plugin Language Folder
		$this->define('WCPS_ADMIN',WCPS_INC.'admin/'); # Plugin Admin Folder
		$this->define('WCPS_SETTINGS',WCPS_ADMIN.'settings/'); # Plugin Settings Folder
        
		$this->define('WCPS_URL',plugins_url('', __FILE__ ).'/');  # Plugin URL
		$this->define('WCPS_CSS',WCPS_URL.'includes/css/'); # Plugin CSS URL
		$this->define('WCPS_IMG',WCPS_URL.'includes/img/'); # Plugin IMG URL
		$this->define('WCPS_JS',WCPS_URL.'includes/js/'); # Plugin JS URL
    }
	
    /**
	 * Define constant if not already set
	 * @param  string $name
	 * @param  string|bool $value
	 */
    protected function define($key,$value){
        if(!defined($key)){
            define($key,$value);
        }
    }
    
}