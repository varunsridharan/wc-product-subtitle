<?php
/**
 * The admin-specific functionality of the plugin.
 * @link https://wordpress.org/plugins/wc-product-subtitle/
 * @package WC Product Subtitle
 * @subpackage WC Product Subtitle/Admin
 * @since 2.0
 */
if ( ! defined( 'WPINC' ) ) { die; }

class WooCommerce_Product_Subtitle_Admin_Handler {
    
    public function __construct() {
        add_action('edit_form_after_title',array($this,'add_subtitle_field'));
        add_action('save_post', array($this,'save_product_subtitle'), 10, 3 );
    }
    
    public function add_subtitle_field($post){  
        if($post->post_type == 'product'){
            global $post;
            $postID = $post->ID;
            $value = get_product_subtitle($postID);
            $pvalue = __('Subtitle',WCPS_TXT);
            echo '<div id="subtitlediv">';
            echo '<label for="subtitle"><strong> '.$pvalue.' : </strong> </lable>';
            echo '<input type="text" autocomplete="off" spellcheck="true" id="subtitle"  size="50" name="product_subtitle" value="'.$value.'" placeholder="'.$pvalue.'">'; 
            echo '</div>';
        }
    }  
    
    public function save_product_subtitle( $post_id, $post, $update ){
        if($post->post_type != 'product'){return ;}
            if ( isset( $_POST['product_subtitle'] ) ) {
                update_post_meta( $post_id, WCPS_DB.'subtitle', sanitize_text_field( $_POST['product_subtitle'] ) );
            }
    }	 
}