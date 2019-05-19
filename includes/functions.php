<?php

if(!function_exists('wc_ps_option')){
	function wc_ps_option($key = '',$default = ''){
        $key = 'wc_ps_'.$key;
		return vsp_option('wc-product-subtitle',$key,$default);
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
			'attr'    => array('style' => 'width:50%;', 'class' => 'vsp-select2' ),
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
			'attr'    => array('style' => 'width:50%;', 'class' => 'vsp-select2' ),
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
            'attr'    => array('style' => 'width:50%', 'class' => 'vsp-select2' ),
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