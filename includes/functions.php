<?php
/**
 * Common Plugin Functions
 * 
 * @link https://wordpress.org/plugins/wc-product-subtitle/
 * @package WC Product Subtitle
 * @subpackage WC Product Subtitle/core
 * @since 2.0
 */
if ( ! defined( 'WPINC' ) ) { die; }

global $wc_ps_db_settins_values;
$wc_ps_db_settins_values = array();
add_action('wc_ps_init','wc_ps_get_settings_from_db',1);

if(!function_exists('wc_ps_option')){
	function wc_ps_option($key = ''){
		global $wc_ps_db_settins_values;
		if($key == ''){return $wc_ps_db_settins_values;}
		if(isset($wc_ps_db_settins_values[WCPS_DB.$key])){
			return $wc_ps_db_settins_values[WCPS_DB.$key];
		} 
		
		return false;
	}
}

if(!function_exists('wc_ps_get_settings_from_db')){
	/**
	 * Retrives All Plugin Options From DB
	 */
	function wc_ps_get_settings_from_db(){
		global $wc_ps_db_settins_values;
		$section = array();
		$section = apply_filters('wc_ps_settings_section',$section); 
        
		$values = array();
		foreach($section as $settings){
			foreach($settings as $set){
				$db_val = get_option(WCPS_DB.$set['id']);
				if(is_array($db_val)){ unset($db_val['section_id']); $values = array_merge($db_val,$values); }
			}
		}        
		$wc_ps_db_settins_values = $values; 
	}
}

if(!function_exists('wc_ps_is_request')){
    /**
	 * What type of request is this?
	 * string $type ajax, frontend or admin
	 * @return bool
	 */
    function wc_ps_is_request( $type ) {
        switch ( $type ) {
            case 'admin' :
                return is_admin();
            case 'ajax' :
                return defined( 'DOING_AJAX' );
            case 'cron' :
                return defined( 'DOING_CRON' );
            case 'frontend' :
                return ( ! is_admin() || defined( 'DOING_AJAX' ) ) && ! defined( 'DOING_CRON' );
        }
    }
}

if(!function_exists('wc_ps_current_screen')){
    /**
     * Gets Current Screen ID from wordpress
     * @return string [Current Screen ID]
     */
    function wc_ps_current_screen(){
       $screen =  get_current_screen();
       return $screen->id;
    }
}

if(!function_exists('wc_ps_get_screen_ids')){
    /**
     * Returns Predefined Screen IDS
     * @return [Array] 
     */
    function wc_ps_get_screen_ids(){
        $screen_ids = array();
        $screen_ids[] = 'woocommerce_page_woocommerce-product-subtitle-settings';
        return $screen_ids;
    }
}

if(!function_exists('wc_ps_dependency_message')){
	function wc_ps_dependency_message(){
		$text = __( WCPS_NAME . ' requires <b> WooCommerce </b> To Be Installed..  <br/> <i>Plugin Deactivated</i> ', WCPS_TXT);
		return $text;
	}
}

if(!function_exists('wc_ps_settings_products_json')){
    function wc_ps_settings_products_json($ids){
        $json_ids    = array();
        if(!empty($ids)){
            $ids = explode(',',$ids);
            foreach ( $ids as $product_id ) {
                $product = wc_get_product( $product_id );
                $json_ids[ $product_id ] = wp_kses_post( $product->get_formatted_name() );
            }   
        }
        return $json_ids;
    }
}

if(!function_exists('wc_ps_settings_get_categories')){
    function wc_ps_settings_get_categories($tax='product_cat'){
        $args = array();
        $args['hide_empty'] = false;
        $args['number'] = 0; 
        $args['pad_counts'] = true; 
        $args['update_term_meta_cache'] = false;
        $terms = get_terms($tax,$args);
        $output = array();
        
        foreach($terms as $term){
            $output[$term->term_id] = $term->name .' ('.$term->count.') ';
        }
        
        return $output; 
    }
}

if(!function_exists('wc_ps_settings_page_link')){
    function wc_ps_settings_page_link($tab = '',$section = ''){
        $settings_url = admin_url('admin.php?page='.WCPS_SLUG.'-settings');
        if(!empty($tab)){$settings_url .= '&tab='.$tab;}
        if(!empty($section)){$settings_url .= '#'.$section;}
        return $settings_url;
    }   
}

if(!function_exists('wc_ps_get_settings_sample')){
	/**
	 * Retunrs the sample array of the settings framework
	 * @param [string] [$type = 'page' | 'section' | 'field'] [[Description]]
	 */
	function wc_ps_get_settings_sample($type = 'page'){
		$return = array();
		
		if($type == 'page'){
			$return = array( 
				'id'=>'settings_general', 
				'slug'=>'general', 
				'title'=>__('General',WCPS_TXT),
				'multiform' => 'false / true',
				'submit' => array( 
					'text' => __('Save Changes',WCPS_TXT), 
					'type' => 'primary / secondary / delete', 
					'name' => 'submit'
				)
			);
			
		} else if($type == 'section'){
			$return['page_id'][] = array(
				'id'=>'general',
				'title'=>'general', 
				'desc' => 'general',
				'submit' => array(
					'text' => __('Save Changes',WCPS_TXT), 
					'type' => 'primary / secondary / delete', 
					'name' => 'submit'
				)
			);
		} else if($type == 'field'){
			$return['page_id']['section_id'][] = array(
				'id' => '',
				'type' => 'text, textarea, checkbox, multicheckbox, radio, select, field_row, extra',
				'label' => '',
				'options' => 'Only required for type radio, select, multicheckbox [KEY Value Pair]',
				'desc' => '',
				'size' => '',
				'default' => '',
				'attr' => "Key Value Pair",
				'before' => 'Content before the field label',
				'after' => 'Content after the field label',
				'content' => 'Content used for type extra' ,
				'text_type' => "Set the type for text input field (e.g. 'hidden' )",
			);
		}
	}
}

if(!function_exists('wc_ps_admin_notice')){
    function wc_ps_admin_notice($msg , $type = 'updated'){
        $notice = ' <div class="'.$type.' settings-error notice is-dismissible" id="setting-error-settings_updated"> 
<p>'.$msg.'</p><button class="notice-dismiss" type="button"><span class="screen-reader-text">Dismiss this notice.</span></button></div>';
        return $notice;
    }
}

if(!function_exists('wc_ps_get_ajax_overlay')){
	/**
	 * Prints WC PBP Ajax Loading Code
	 */
	function wc_ps_get_ajax_overlay($echo = true){
		$return = '<div class="wc_ps_ajax_overlay">
		<div class="sk-folding-cube">
		<div class="sk-cube1 sk-cube"></div>
		<div class="sk-cube2 sk-cube"></div>
		<div class="sk-cube4 sk-cube"></div>
		<div class="sk-cube3 sk-cube"></div>
		</div>
		</div>';
		if($echo){echo $return;}
		else{return $return;}
	}
}

if(!function_exists('wc_ps_tags')){
    function wc_ps_tags($req_tag = ''){
        $return = array();
        $return['p_tag'] =  __('P Tag',WCPS_TXT);
        $return['span_tag'] = __('SPAN Tag',WCPS_TXT);
        $return['small_tag'] = __('SMALL Tag',WCPS_TXT); 
        
        $return['h1_tag'] = __('H1 Tag',WCPS_TXT);
        $return['h2_tag'] = __('H2 Tag',WCPS_TXT);
        $return['h3_tag'] = __('H3 Tag',WCPS_TXT);
        $return['h4_tag'] = __('H4 Tag',WCPS_TXT);
        $return['h5_tag'] = __('H5 Tag',WCPS_TXT);
        $return['h6_tag'] = __('H6 Tag',WCPS_TXT);
        
        $return = apply_filters('wc_ps_tags',$return);
        
        if(!empty($req_tag)){
            if(isset($return[$req_tag])){
                return $return[$req_tag];
            }
        }
        return $return;
    }
}

if(!function_exists('wc_ps_tags_settings_arr')){
    function wc_ps_tags_settings_arr($id = ''){
        return array(
			'id' => WCPS_DB.$id, 
			'type'    => 'select',
            'options' => wc_ps_tags(),
			'label' => __('Title Element Type',WCPS_TXT),
			'desc' => __('Which Type of html tag you need to have',WCPS_TXT), 
			'attr'    => array('style' => 'width:50%;', 'class' => 'wc-enhanced-select' ),
		);
    }
}

if(!function_exists('wc_ps_tags_pos_settings_arr')){
    function wc_ps_tags_pos_settings_arr($id = ''){
        return array(
			'id' => WCPS_DB.$id, 
			'type'    => 'select',
            'options' => array('before' => __('Before',WCPS_TXT),'after' => __('After',WCPS_TXT)),
			'label' => __('',WCPS_TXT),
			'desc' => __('Where to show the subtitle',WCPS_TXT), 
			'attr'    => array('style' => 'width:50%;', 'class' => 'wc-enhanced-select' ),
		);
    }
}

if(!function_exists('wc_ps_tags_area_settings_arr')){
    function wc_ps_tags_area_settings_arr($id,$options){
       return array( 
            'id' => WCPS_DB.$id, 
            'type'    => 'select',
            'options' => $options,
            'label' => __('Title Position',WCPS_TXT),
            'desc' => __(' Where to show the subtitle ',WCPS_TXT), 
            'attr'    => array('style' => 'width:50%', 'class' => 'wc-enhanced-select' ),
        );
    }
}

if(!function_exists('get_product_subtitle')){
    function get_product_subtitle($id){ 
        $value = get_post_meta($id,WCPS_DB.'subtitle',true);
        return $value;
    }
}

if(!function_exists('the_product_subtitle')){
    function the_product_subtitle($id){ 
        $value = get_product_subtitle($id);
        echo $value;
    }
}