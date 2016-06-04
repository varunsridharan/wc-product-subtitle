<?php 
if ( ! defined( 'WPINC' ) ) { die; }
 
class WooCommerce_Product_Subtitle_Display_Tag_Handler {
	public $display_id = '';
	
	
	public function __construct($id){
        $this->display_id = $id;
    }
	
	public function get_subtitle($title,$tag,$pid){
        $defaults = $this->get_element_defaults($pid);
        $func = 'get_element_'.$tag;
        $return = '';
        if(method_exists($this,$func)){
            $return = $this->$func($title,$pid);
        } else {
            ob_start();
            do_action('wc_ps_subtitle_'.$tag,$title,$tag,$pid,$defaults);
            $return = ob_get_clean(); 
            ob_flush();
        }
        return $return;
    }
    
    public function print_subtitle($title,$tag,$pid){
        $subtitle = $this->get_subtitle($title,$tag,$pid);
        return $subtitle;
    }
	
	public function get_element_defaults($post_id){
		$default_class = 'product-subtitle subtitle-'.$post_id;
		$default_id = 'product-subtitle-'.$post_id;
		$class = apply_filters('wc_product_subtitle_class_'.$this->display_id,$default_class,$this->display_id,$post_id);
		$id = apply_filters('wc_product_subtitle_id_'.$this->display_id,$default_id,$this->display_id,$post_id);
		return array('elemid' =>  $id, 'elemclass' => $class);
	}
	
	public function get_element_p_tag($value = '',$id){
		if(empty($value)) { return'';}
		extract($this->get_element_defaults($id));
		$tag = '<p id="'.$elemid.'" class="'.$elemclass.'" >';
		$tag .= $value;
		$tag .= '</p>';
		return $tag;
	}
    
    public function get_element_small_tag($value = '',$id){
		if(empty($value)) { return'';}
		extract($this->get_element_defaults($id));
		$tag = '<small id="'.$elemid.'" class="'.$elemclass.'" >';
		$tag .= $value;
		$tag .= '</small>';
		return $tag;
	}
	
	public function get_element_span_tag($value = '',$id){
		if(empty($value)) { return'';}
		extract($this->get_element_defaults($id));
		$tag = '<span id="'.$elemid.'" class="'.$elemclass.'" >';
		$tag .= $value;
		$tag .= '</span>';
		return $tag;
	}
	
	public function get_element_h_tags($ntag = '',$value = '',$id){
		if(empty($value)) { return'';}
		extract($this->get_element_defaults($id));
		$tag = '<'.$ntag.' id="'.$elemid.'" class="'.$elemclass.'" >';
		$tag .= $value;
		$tag .= '</'.$ntag.'>';
		return $tag;
	}
	
	public function get_element_h1_tag($value = '', $id){
        return $this->get_element_h_tags('H1',$value,$id);
    }
    
	public function get_element_h2_tag($value = '', $id){
        return $this->get_element_h_tags('H2',$value,$id);
    }
    
	public function get_element_h3_tag($value = '', $id){
        return $this->get_element_h_tags('H3',$value,$id);
    }
    
	public function get_element_h4_tag($value = '', $id){
        return $this->get_element_h_tags('H4',$value,$id);
    }
    
	public function get_element_h5_tag($value = '', $id){
        return $this->get_element_h_tags('H5',$value,$id);
    }
    
	public function get_element_h6_tag($value = '', $id){
        return $this->get_element_h_tags('H6',$value,$id);
    }
    
}