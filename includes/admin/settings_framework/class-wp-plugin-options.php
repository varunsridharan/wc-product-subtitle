<?php
/**
 * The admin-specific functionality of the plugin.
 * @link https://wordpress.org/plugins/woocommerce-role-based-price/
 * @package WooCommerce Role Based Price
 * @subpackage WooCommerce Role Based Price/Admin
 * @since 3.0
 */
if ( ! defined( 'WPINC' ) ) { die; }

class WooCommerce_Product_Subtitle_Admin_Settings_Options {
    
    public function __construct() {
    	add_filter('wc_ps_settings_pages',array($this,'settings_pages'));
		add_filter('wc_ps_settings_section',array($this,'settings_section'));
		///add_filter('wc_ps_settings_fields',array($this,'settings_fields'));
    }
	
	public function settings_pages($page){
		$page[] = array('id'=>'general','slug'=>'general','title'=>__(WCPS_NAME,WCPS_TXT));
		return $page;
	}
	public function settings_section($section){
		//$section['general'][] = array( 'id'=>'single_product', 'title'=> __('Single Product',WCPS_TXT));
		//$section['general'][] = array( 'id'=>'shop_page', 'title'=> __('Shop Page',WCPS_TXT));
        $sections = array();
        $sections = apply_filters('wc_ps_main_section',$sections);
        $section['general']  = $sections;
        return $section;
	}
	
	public function settings_fields($fields){
        
        
		$fields['general']['single_product'][] = array(
			'id' => WCPS_DB.'single_product_pos', 
			'type'    => 'select',
            'options' => $single_product_options,
			'label' => __('Title Position',WCPS_TXT),
			'desc' => __(' Where to show the subtitle ',WCPS_TXT), 
			'attr'    => array('style' => 'width:50%', 'class' => 'wc-enhanced-select' ),
		);
        
        $fields['general']['single_product'][] = wc_ps_tags_pos_settings_arr('single_product_where');
        $fields['general']['single_product'][] = wc_ps_tags_settings_arr('single_product_tag');
	
		return $fields;
	}
	
}

return new WooCommerce_Product_Subtitle_Admin_Settings_Options;