<?php

class WooCommerce_Product_Subtitle_Order_View_Page extends WooCommerce_Product_Subtitle_Display_Handler {
    public function __construct(){
        $this->slug = 'order_view_page';
        $this->name = __('Order View Page',WCPS_TXT);
        $this->add_settings = true;
        $this->desc = __('This works on Order Thank you page & My Account Order View Page',WCPS_TXT);
        
        parent::__construct(); 
    }   
    
    
    public function get_settings_fields(){
        $loop_product_area = array(
            '' => __("Disable / Use Shortcode",WCPS_TXT),
            'title' => __('Product Title',WCPS_TXT), 
            'qty' => __('Product Qty',WCPS_TXT), 
        );
        
        return array(
            wc_ps_tags_area_settings_arr($this->slug.'_pos',$loop_product_area),
            wc_ps_tags_pos_settings_arr($this->slug.'_where'),
            wc_ps_tags_settings_arr($this->slug.'_tag')
        );
    }  
    
    public function hookup_area(){ 
        $position = $this->get_position();
        if($position == 'title'){
           $key = 'woocommerce_order_item_name'; 
        } else {
            $key = 'woocommerce_order_item_quantity_html';
        }
		$p = 10; 
		if(empty($position)){ return;}
        add_filter($key,array($this,'order_page_subtitle'),$p,3);
    } 
    
    public function order_page_subtitle($title = '',$cart_item = '', $cart_item_key = ''){
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

return new WooCommerce_Product_Subtitle_Order_View_Page;