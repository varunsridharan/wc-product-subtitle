<?php

class WooCommerce_Product_Subtitle_Single_Product_Page extends WooCommerce_Product_Subtitle_Display_Handler {
    public function __construct(){
        $this->slug = 'single_product';
        $this->name = __('Single Product',WCPS_TXT);
        $this->add_settings = true;
        
        parent::__construct(); 
    }   
    
    
    public function get_settings_fields(){
        $single_product_options = array(
            '' => __("Disable / Use Shortcode",WCPS_TXT),
            'title' => __('Product Title',WCPS_TXT),
            'rating' => __('Product Rating',WCPS_TXT),
            'price' => __('Product Price',WCPS_TXT),
            'excerpt' => __('Product Excerpt',WCPS_TXT),
            'add_to_cart' => __('Product Add to cart',WCPS_TXT),
            'meta' => __('Product Meta',WCPS_TXT),
        );
        
        return array(
            wc_ps_tags_area_settings_arr('single_product_pos',$single_product_options),
            wc_ps_tags_pos_settings_arr('single_product_where'),
            wc_ps_tags_settings_arr('single_product_tag')
        );
    }  
    
    public function hookup_area(){ 
        $position = $this->get_position();
        $key = 'woocommerce_single_product_summary';
		$where = $this->get_where();
		$p = 10; 

        if(empty($position)){ return;}
		if('title' == $position && 'before' == $where){ $p = 4;}
		if('rating' == $position && 'before' == $where){ $p = 9;}
		if('price' == $position && 'before' == $where){ $p = 9;}
		if('excerpt' == $position && 'before' == $where){ $p = 19;}
		if('add_to_cart' == $position && 'before' == $where){ $p = 29;}
		if('meta' == $position && 'before' == $where){ $p = 39;}
		
		if('title' == $position && 'after' == $where){ $p = 6;}
		if('rating' == $position && 'after' == $where){ $p = 11;}
		if('price' == $position && 'after' == $where){ $p = 11;}
		if('excerpt' == $position && 'after' == $where){ $p = 21;}
		if('add_to_cart' == $position && 'after' == $where){ $p = 31;}
		if('meta' == $position && 'after' == $where){ $p = 41;}

        add_action($key,array($this,'the_subtitle'),$p);
    } 
}


return new WooCommerce_Product_Subtitle_Single_Product_Page;