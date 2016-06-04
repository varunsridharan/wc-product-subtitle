<?php

class WooCommerce_Product_Subtitle_Shortcode_Handler extends WooCommerce_Product_Subtitle_Display_Handler {
    public function __construct(){
        $this->slug = 'shortcode_handler';
        $this->name = __('Cart Page',WCPS_TXT);
        $this->add_settings = false;
        add_shortcode('wc-ps',array($this,'render_shortcode'));
        parent::__construct(); 
    }   
    
    
    public function render_shortcode($atts){
        $atts = shortcode_atts( array(
			'id' => '',
			'tag' => 'p' // p_tag, small_tag, span_tag, h1_tag, h2_tag and more
		), $atts, 'wc-ps' );
        
		global $post;
		$this->tag = $atts['tag'].'_tag';
		$this->pid = $atts['id'];
		if($atts['id'] == ''){$this->pid = $post->ID;} 
		return $this->render_subtitle($this->pid);        
    }
    
    public function get_element(){
        return $this->tag;
    }
    
    public function get_settings_fields(){ }  
    
    public function hookup_area(){}  
}

return new WooCommerce_Product_Subtitle_Shortcode_Handler;