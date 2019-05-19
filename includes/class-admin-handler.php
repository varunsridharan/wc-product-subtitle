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
        if ( version_compare( $GLOBALS['wp_version'], '4.1-alpha', '<' ) ) {
            add_action( 'edit_form_after_title', array( &$this, 'add_subtitle_field' ) );
        } else {
            add_action( 'edit_form_before_permalink', array( &$this, 'add_subtitle_field' ) );
        }

        add_action('save_post', array($this,'save_product_subtitle'), 10, 3 );
        if(wc_ps_option("admin_product_column")){
            add_action( 'manage_product_posts_columns', array( &$this, 'build_subtitles_column_head' ), 10, 2 );
            add_action( 'manage_product_posts_custom_column', array( &$this, 'build_subtitles_column_content' ), 10, 2 );
        }
    }
    
    public function build_subtitles_column_head($posts_columns){
        $posts_columns['subtitle'] = esc_html__( 'Subtitle', 'subtitles' );
        return $posts_columns;
    }
    
    public function build_subtitles_column_content( $column_name, $post_id ){
        if($column_name == 'subtitle'){
            echo get_product_subtitle($post_id);
        }
    }
    
    public function add_subtitle_field($post){  
        if($post->post_type == 'product'){
            global $post;
            $postID = $post->ID;
            $value = get_product_subtitle($postID);
            
            $pvalue = __('Subtitle',WCPS_TXT);
            echo '<div id="subtitlediv">';
            echo '<div id="subtitlewrap">';
            echo '<label  id="subtitle-prompt-text" for="wc_ps_subtitle"><strong> '.$pvalue.' : </strong> </label>';
            echo '<input type="text"  autocomplete="off" spellcheck="true" id="wcps_subtitle" size="50" name="product_subtitle" value="'.esc_attr($value).'" placeholder="'.$pvalue.'">'; 
            echo '</div>';
            echo '</div>';
            echo '<style>#subtitlediv{margin-top:10px;} #wcps_subtitle{padding: 3px 8px;font-size: 1.7em;line-height: 100%;height: 1.7em;width: 100%;outline: none;margin: 0 0 3px;background-color: #fff;}</style>';
        }
    }  
    
    public function save_product_subtitle( $post_id, $post, $update ){
        if($post->post_type != 'product'){return ;}
            if ( isset( $_POST['product_subtitle'] ) ) {
                update_post_meta( $post_id, WCPS_DB.'subtitle', wp_kses( $_POST['product_subtitle'],array() ) );
            }
    }	 
}

return new WooCommerce_Product_Subtitle_Admin_Handler;