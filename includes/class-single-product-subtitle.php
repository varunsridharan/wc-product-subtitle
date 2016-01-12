<?php 

if ( ! defined( 'WPINC' ) ) { die; }
 
class WooCommerce_Product_Subtitle_Single_Product_Display extends WooCommerce_Product_Subtitle_Display {

	public function __construct(){
		$this->display_id = 'single_product';
		parent::__construct();
		$this->add_display_subttile_action();
	}
	
	public function add_display_subttile_action(){
		$position = $this->get_position();
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
		
		add_action('woocommerce_single_product_summary',array($this,'show_single_product_subtitle'),$p);
	}
	
	
	public function show_single_product_subtitle(){
		global $post;
		$tag = $this->get_element();
		$pid = $post->ID;
		$title = $this->get_subtitle($pid);
		$elem = "get_element_$tag";
		echo $this->$elem($title,$pid);
	}
}

return new WooCommerce_Product_Subtitle_Single_Product_Display;
?>