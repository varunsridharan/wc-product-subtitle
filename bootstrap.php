<?php
if ( ! defined( 'WPINC' ) ) { die; }

if(!class_exists("WooCommerce_Product_Subtitle")){

    class WooCommerce_Product_Subtitle extends VSP_Framework  {
        protected static $_instance = null; # Required Plugin Class Instance

        public static function get_instance() {
            if ( null == self::$_instance ) {
                self::$_instance = new self;
            }
            return self::$_instance;
        }
        
        public function __construct() {
            parent::__construct(array(
                'plugin_file' => WCPS_FILE,
                'version' =>  WCPS_V,
                'db_slug' => 'wc_ps_',
                'hook_slug' => 'wc_ps_',
                'plugin_name' => WCPS_NAME,
                'plugin_slug' => 'wc-product-subtitle',
                'settings_page' => array(
                    'pageName' => WCPS_NAME,
                    'callback_validation' => false,
                    'show_status_page' => false,
                    'assets' => array('vsp-select2')
                ),
                'addons' => false
            ));
            
        }
        
        public function hook_settings_init($type = ''){
            if($type == 'before'){
                vsp_load_file(WCPS_INC.'class-settings.php');
                $this->settings_fields = new WooCommerce_Product_Subtitle_Settings;
            }
        }

        public function hook_load_required_files($type = ''){
            if($type == 'before'){
                vsp_load_file(WCPS_INC.'abstract-*.php');
                vsp_load_file(WCPS_INC.'class-tag-*.php');
                vsp_load_file(WCPS_INC.'class-subtitle-*.php');
            }
        }
        
        public function load_textdomain($file = '',$domain = '') {
            if (WCPS_TXT === $domain)
                return WCPS_LANGUAGE_PATH.'/'.get_locale().'.mo';

            return $file;
        }
        
        public function hook_plugins_loaded(){
            load_plugin_textdomain(WCPS_TXT, false, WCPS_LANGUAGE_PATH );
        }
        
        public function on_admin_init(){
            vsp_load_file(WCPS_INC.'class-admin-*.php');
        }
        
        public function row_links($plugin_meta, $plugin_file){
            if ( WCPS_FILE == $plugin_file ) {
                $plugin_meta[] = sprintf('<a href="%s">%s</a>', 'https://wordpress.org/plugins/wc-product-subtitle/faq/', __('F.A.Q',WCPS_TXT) );
                $plugin_meta[] = sprintf('<a href="%s">%s</a>', 'https://github.com/varunsridharan/wc-product-subtitle', __('View On Github',WCPS_TXT) );
                $plugin_meta[] = sprintf('<a href="%s">%s</a>', 'https://github.com/varunsridharan/wc-product-subtitle/issues', __('Report Issue',WCPS_TXT) );
            }
            return $plugin_meta;
        }
        
        public function action_links($action,$file,$plugin_meta,$status){
            $settings_url = admin_url('admin.php?page=woocommerce-product-subtitle-settings');
            $actions[] = sprintf('<a href="%s">%s</a>', $settings_url, __('Settings',WCPS_TXT) );
            $action = array_merge($actions,$action);
            return $action;
        }
    }
} 