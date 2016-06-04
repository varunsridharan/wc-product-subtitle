<?php 
if(isset($_REQUEST['change'])){
	$files_check = array();
	get_php_files(__DIR__);
	foreach ($files_check as $f){
		$file = file_get_contents($f);
		
        $file = str_replace('WooCommerce_Plugin_Boiler_Plate', 'WooCommerce_Product_Subtitle', $file);
		$file = str_replace('WooCommerce Plugin Boiler Plate', 'WooCommerce Product Subtitle', $file);
		$file = str_replace('woocommerce-plugin-boiler-plate', 'woocommerce-product-subtitle', $file);
        
		$file = str_replace('https://wordpress.org/plugins/woocommerce-plugin-boiler-plate/', 'https://wordpress.org/plugins/wc-product-subtitle/' , $file ); 
		$file = str_replace('[version]', '2.0' , $file ); 
		$file = str_replace('[package]', 'WC Product Subtitle' , $file ); 
		$file = str_replace('[plugin_name]', 'WooCommerce Product Subtitle' , $file ); 
		$file = str_replace('[plugin_url]', 'https://wordpress.org/plugins/wc-product-subtitle/' , $file ); 
		$file = str_replace('wc_pbp_','wc_ps_',$file);
		$file = str_replace('PLUGIN_FILE', 'WCPS_FILE' , $file);
		$file = str_replace('PLUGIN_PATH', 'WCPS_PATH' , $file);
		$file = str_replace('PLUGIN_INC', 'WCPS_INC' , $file);
		$file = str_replace('PLUGIN_DEPEN', 'WCPS_DEPEN' , $file);
		$file = str_replace('PLUGIN_NAME', 'WCPS_NAME' , $file);
		$file = str_replace('PLUGIN_SLUG', 'WCPS_SLUG' , $file);
		$file = str_replace('PLUGIN_TXT', 'WCPS_TXT' , $file);
		$file = str_replace('PLUGIN_DB', 'WCPS_DB' , $file);
		$file = str_replace('PLUGIN_V', 'WCPS_V' , $file);
		$file = str_replace('PLUGIN_LANGUAGE_PATH', 'WCPS_LANGUAGE_PATH' , $file);
		$file = str_replace('PLUGIN_ADMIN', 'WCPS_ADMIN' , $file);
		$file = str_replace('PLUGIN_SETTINGS', 'WCPS_SETTINGS' , $file);
		$file = str_replace('PLUGIN_URL', 'WCPS_URL' , $file);
		$file = str_replace('PLUGIN_CSS', 'WCPS_CSS' , $file);
		$file = str_replace('PLUGIN_IMG', 'WCPS_IMG' , $file);
		$file = str_replace('PLUGIN_JS', 'WCPS_JS' , $file);		
		
		file_put_contents($f,$file); 
	}
}

function get_php_files($dir = __DIR__){
	global $files_check;
	$files = scandir($dir); 
	foreach($files as $file) {
		if($file == '' || $file == '.' || $file == '..' ){continue;}
		if(is_dir($dir.'/'.$file)){
			get_php_files($dir.'/'.$file);
		} else {
			if(pathinfo($dir.'/'.$file, PATHINFO_EXTENSION) == 'php' || pathinfo($dir.'/'.$file, PATHINFO_EXTENSION) == 'txt'){
				if($file == 'generate.php'){continue;}
				$files_check[$file] = $dir.'/'.$file;
			}
		}
	}
}