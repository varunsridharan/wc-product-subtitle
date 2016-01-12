<?php
/**
 * Integration Demo Integration.
 *
 * @package  WC_Integration_Demo_Integration
 * @category Integration
 * @author   Patrick Rauland
 */
 

class WooCommerce_Product_Subtitle_Settings_Intergation  {

	/**
	 * Init and hook in the integration.
	 */
	public function __construct() {
		add_filter( 'woocommerce_get_sections_products', array($this,'wc_product_subtitle_settings_tab'));
		add_filter( 'woocommerce_get_settings_products', array($this,'wc_product_subtitle_settings'), 10, 2 );
	}
	
	function wc_product_subtitle_settings_tab( $sections ) {
		$sections['wcpss'] = __( 'WC Product Subtitle', WCPS_TXT);
		return $sections;
	}
	
	function wc_product_subtitle_settings( $settings, $current_section ) {
		if ( $current_section == 'wcpss' ) {
			$elemnt_type = array(
				'p_tag' => __('p Tag',WCPS_TXT),
				'span_tag' => __('span Tag',WCPS_TXT),
				'h1_tag' => __('H1 Tag',WCPS_TXT),
				'h2_tag' => __('H2 Tag',WCPS_TXT),
				'h3_tag' => __('H3 Tag',WCPS_TXT),
				'h4_tag' => __('H4 Tag',WCPS_TXT),
				'h5_tag' => __('H5 Tag',WCPS_TXT),
				'h6_tag' => __('H6 Tag',WCPS_TXT),
				
			);
			
			$postion = array('before' => __('Before',WCPS_TXT),'after' => __('After',WCPS_TXT));
			
			
			$single_product_area = array(
				'title' => __('Product Title',WCPS_TXT),
				'rating' => __('Product Rating',WCPS_TXT),
				'price' => __('Product Price',WCPS_TXT),
				'excerpt' => __('Product Excerpt',WCPS_TXT),
				'add_to_cart' => __('Product Add to cart',WCPS_TXT),
				'meta' => __('Product Meta',WCPS_TXT),
			);
			
			$loop_product_area = array(
				'title' => __('Product Title',WCPS_TXT),
				'rating' => __('Product Rating',WCPS_TXT),
				'price' => __('Product Price',WCPS_TXT),
			);
			
			$settings_slider = array();
			
			$settings_slider[] = array('name' => __( 'WC Product Subtitle Settings', WCPS_TXT ), 
									   'type' => 'title', 
									   'desc' => __( 'The following options are used to configure  WC Product Subtitle ', WCPS_TXT ), 
									   'id' => 'wcpss' );
			
			
			
			
			$settings_slider[] = array('name' => __( 'Single Product Page', WCPS_TXT ), 
									   'type' => 'title', 
									   'id' => 'wcpss_single_product_page' );
 
			$settings_slider[] = array(
				'name'     => __( 'Title Position', WCPS_TXT ),
				'id'       => WCPS_DB.'single_product_position',
				'type'     => 'select',
				'class' => 'wc-enhanced-select',
				'options' =>$single_product_area,
				'desc'     => __( ' Where to show the subtitle ', WCPS_TXT ),
			);
			
			$settings_slider[] = array(
				'id'       => WCPS_DB.'single_product_where',
				'type'     => 'select',
				'class' => 'wc-enhanced-select',
				'options' =>$postion,
				'desc'     => __( ' Where to show the subtitle ', WCPS_TXT ),
			);
			
			$settings_slider[] = array(
				'name'     => __( 'Title Element Type', WCPS_TXT ),
				'desc_tip' => __( 'Which Type of html tag you need to have ', WCPS_TXT ),
				'id'       => WCPS_DB.'single_product_element',
				'type'     => 'select',
				'class' => 'wc-enhanced-select',
				'options' => $elemnt_type,
				'desc'     => __( 'Any title you want can be added to your slider with this option!', WCPS_TXT ),
			);
			
			
			
			
			$settings_slider[] = array( 'type' => 'sectionend', 'id' => 'wcpss_single_product_page' );
			
			$settings_slider[] = array('name' => __( 'Shop Page', WCPS_TXT ), 
									   'type' => 'title', 
									   'id' => 'wcpss_loop_product_page' );
 
			$settings_slider[] = array(
				'name'     => __( 'Title Position', WCPS_TXT ),
				'id'       => WCPS_DB.'loop_product_position',
				'type'     => 'select',
				'class' => 'wc-enhanced-select',
				'options' =>$loop_product_area,
				'desc'     => __( ' Where to show the subtitle ', WCPS_TXT ),
			);
			
			$settings_slider[] = array(
				'id'       => WCPS_DB.'loop_product_where',
				'type'     => 'select',
				'class' => 'wc-enhanced-select',
				'options' =>$postion,
				'desc'     => __( ' Where to show the subtitle ', WCPS_TXT ),
			);
			
			$settings_slider[] = array(
				'name'     => __( 'Title Element Type', WCPS_TXT ),
				'desc_tip' => __( 'Which Type of html tag you need to have ', WCPS_TXT ),
				'id'       => WCPS_DB.'loop_product_element',
				'type'     => 'select',
				'class' => 'wc-enhanced-select',
				'options' => $elemnt_type,
				'desc'     => __( 'Any title you want can be added to your slider with this option!', WCPS_TXT ),
			);
			
			
			
			
			
			
			$settings_slider[] = array( 'type' => 'sectionend', 'id' => 'wcpss_loop_product_page' );
			return $settings_slider;

		/**
		 * If not, return the standard settings
		 **/
		} else {
			return $settings;
		}
	}	
	 

}