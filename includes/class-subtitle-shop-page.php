<?php

class WooCommerce_Product_Subtitle_Shop_Page extends WooCommerce_Product_Subtitle_Display_Handler {
    public function __construct(){
        $this->slug = 'shop_page';
        $this->name = __('Shop Page',WCPS_TXT);
        $this->add_settings = true;
        
        parent::__construct(); 
    }   
    
    
    public function get_settings_fields(){
        $loop_product_area = array(
            '' => __("Disable / Use Shortcode",WCPS_TXT),
            'title' => __('Product Title',WCPS_TXT),
            'rating' => __('Product Rating',WCPS_TXT),
            'price' => __('Product Price',WCPS_TXT),
        );
        
        return array(
            wc_ps_tags_area_settings_arr('shop_page_pos',$loop_product_area),
            wc_ps_tags_pos_settings_arr('shop_page_where'),
            wc_ps_tags_settings_arr('shop_page_tag')
        );
    }  
    
    public function hookup_area(){ 
        $position = $this->get_position();
		$where = $this->get_where();
		$p = 10; 
		$key = '';
		if(empty($position)){ return;}
		
		if('title' == $position && 'before' == $where){ $p = 9; $key = 'woocommerce_shop_loop_item_title';}
		if('rating' == $position && 'before' == $where){ $p = 4; $key = 'woocommerce_after_shop_loop_item_title';}
		if('price' == $position && 'before' == $where){ $p = 9; $key = 'woocommerce_after_shop_loop_item_title';}
		
		if('title' == $position && 'after' == $where){ $p = 11; $key = 'woocommerce_shop_loop_item_title';}
		if('rating' == $position && 'after' == $where){ $p = 6; $key = 'woocommerce_after_shop_loop_item_title';}
		if('price' == $position && 'after' == $where){ $p = 11; $key = 'woocommerce_after_shop_loop_item_title';}
		
        add_action($key,array($this,'the_subtitle'),$p);
    } 
}

return new WooCommerce_Product_Subtitle_Shop_Page;