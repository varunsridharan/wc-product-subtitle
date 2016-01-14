<?php 

if ( ! defined( 'WPINC' ) ) { die; }
 
class WooCommerce_Product_Subtitle_Shortcode_Display extends WooCommerce_Product_Subtitle_Display {

	public function __construct(){
		$this->display_id = 'shortcode';
		add_shortcode('wc-ps' ,array($this,'render_shortcode'));
		parent::__construct();
	}
	 
	
	
	public function render_shortcode($atts){
		$atts = shortcode_atts( array(
			'id' => '',
			'tag' => 'p_tag'
		), $atts, 'wc-ps' );
		
		global $post;
		$tag = $atts['tag'].'_tag';
		$pid = $atts['id'];
		if($atts['id'] == ''){$pid = $post->ID;}
		$title = $this->get_subtitle($pid);
		$elem = "get_element_$tag";
		return $this->$elem($title,$pid);
	}
}

return new WooCommerce_Product_Subtitle_Shortcode_Display;
?>