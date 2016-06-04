<?php 
if ( ! defined( 'WPINC' ) ) { die; }
 
abstract class WooCommerce_Product_Subtitle_Display_Handler {
	public $slug = '';
    public $name = '';
    public $add_settings = false;
    public $desc = '';
	
	
	public function __construct(){
        if($this->add_settings){
            add_filter('wc_ps_main_section',array($this,'add_section'));  
            add_filter('wc_ps_settings_fields',array($this,'settings_fields'));
        }

        add_action('wc_ps_init',array($this,'hookup_area'));
        $this->tag_handler = new WooCommerce_Product_Subtitle_Display_Tag_Handler($this->slug);
    }
    
    public function hookup_area(){
        
    }
    
    public function settings_fields($fields){ 
        $fields['general'][$this->slug] = $this->get_settings_fields();
        return $fields;
    }
    
    public function get_settings_fields(){
        return array();
    }
    
    public function add_section($sec){
        $sec[] = array( 'id'=>$this->slug, 'title'=> $this->name,'desc' => $this->desc,);
        return $sec;
    }
	
	public function get_position(){ 
		$value = wc_ps_option($this->slug.'_pos');
		return $value;
	}
	
	public function get_where(){
		$value = wc_ps_option($this->slug.'_where',true);
		return $value;
	}
	
	public function get_element(){
		$value = wc_ps_option($this->slug.'_tag',true);
		return $value;
	}
	
	public function get_subtitle($post_id){
		$value = get_product_subtitle($post_id);
		return $value;
	}
    
    public function the_subtitle($pid = ''){
        $echo = $this->render_subtitle($pid = '');
        echo $echo;
    }
    
    public function render_subtitle($pid = ''){
        
        if(empty($pid)){
            global $post;  
            $pid = $post->ID;
        }
        
		$tag = $this->get_element(); 
		$title = $this->get_subtitle($pid); 
        $value = $this->tag_handler->print_subtitle($title,$tag,$pid);
        return $value;
    }
    
}