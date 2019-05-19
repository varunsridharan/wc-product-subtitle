<?php
/**
 * The admin-specific functionality of the plugin.
 * @link https://wordpress.org/plugins/woocommerce-role-based-price/
 * @package WooCommerce Role Based Price
 * @subpackage WooCommerce Role Based Price/Admin
 * @since 3.0
 */
if ( ! defined( 'WPINC' ) ) { die; }

class WooCommerce_Product_Subtitle_Settings {
    
    public function __construct() {
    	add_filter('wc_ps_settings_pages',array($this,'settings_pages'));
		add_filter('wc_ps_settings_section',array($this,'settings_section'));
		add_filter('wc_ps_settings_fields',array($this,'settings_fields'));
    }
	
	public function settings_pages($page){
		$page[] = array('id'=>'general','slug'=>'general','title'=>__(WCPS_NAME,WCPS_TXT));
		return $page;
	}
	public function settings_section($section){
        $sections = array();
        
        $section['general'][] = array('id' => 'general' ,'title' => __("Admin Settings"),'slug' => 'admin-settings');
        $section['general'] = array_merge($section['general'],apply_filters('wc_ps_main_section',array()));
        return $section;
	}
    
    public function settings_fields($fields = array()){
        
        $fields['general']['general'][] =array(
			'id' => WCPS_DB.'admin_product_column', 
			'type'    => 'checkbox',
			'label' => __('Add Subtitle Column',WCPS_TXT),
			'desc' => __('Adds A Custom Column IN Product list Tables (wp-admin)',WCPS_TXT), 
			'attr'    => array('style' => 'width:50%;', 'class' => 'vsp-switch' ),
		);
        
        return $fields;
    }

}