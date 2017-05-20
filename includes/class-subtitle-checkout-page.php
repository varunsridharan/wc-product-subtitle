<?php

class WooCommerce_Product_Subtitle_Checkout_Page extends WooCommerce_Product_Subtitle_Display_Handler {
    public function __construct(){
        $this->slug = 'checkout_page';
        $this->name = __('Checkout Page',WCPS_TXT);
        $this->add_settings = true;
        
        parent::__construct(); 
    }   
    
    
    public function get_settings_fields(){
        $loop_product_area = array(
            '' => __("Disable / Use Shortcode",WCPS_TXT),
            'title' => __('Product Title',WCPS_TXT), 
        );
        
        return array(
            wc_ps_tags_area_settings_arr($this->slug.'_pos',$loop_product_area),
            wc_ps_tags_pos_settings_arr($this->slug.'_where'),
            wc_ps_tags_settings_arr($this->slug.'_tag')
        );
    }  
    
    public function hookup_area(){ 
        $position = $this->get_position();
		$p = 10; 
		$key = 'woocommerce_cart_item_name';
		if(empty($position)){ return;}
        add_filter($key,array($this,'cart_subtitle'),$p,3);
    } 
    
    public function cart_subtitle($title,$cart_item, $cart_item_key){
        if(!is_checkout()){return $title;}
        if(!isset($cart_item['product_id'])){return $title;}
        
        $where = $this->get_where();
        $return = '';
        $subtitle = $this->render_subtitle($cart_item['product_id']);
        if($where == 'before'){
            $return = $subtitle.' '.$title;
        } else if($where == 'after'){
            $return = $title.$subtitle;
        } else{
            $return = $title;
        }
        
        return $return;
    }
}

return new WooCommerce_Product_Subtitle_Checkout_Page;