<?php 

if ( ! defined( 'WPINC' ) ) { die; }
 
class WooCommerce_Product_Subtitle_Loop_Product_Display extends WooCommerce_Product_Subtitle_Display {

	public function __construct(){
		$this->display_id = 'loop_product';
		parent::__construct();
		$this->add_display_subttile_action();
	}
	
	public function add_display_subttile_action(){
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
		
		add_action($key,array($this,'show_loop_product_subtitle'),$p);
	}
	
	
	public function show_loop_product_subtitle(){
		global $post;
		$tag = $this->get_element();
		$pid = $post->ID;
		$title = $this->get_subtitle($pid);
		$elem = "get_element_$tag";
		echo $this->$elem($title,$pid);
	}
}

return new WooCommerce_Product_Subtitle_Loop_Product_Display;
?>