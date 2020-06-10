<?php

namespace WC_Product_Subtitle\Admin;

use WPOnion\Traits\Self_Instance;

defined( 'ABSPATH' ) || exit;

/**
 * Class FAQ
 *
 * @package WC_Product_Subtitle\Admin
 * @author Varun Sridharan <varunsridharan23@gmail.com>
 * @since {NEWVERSION}
 */
class FAQ {
	use Self_Instance;

	public function shortcode() {
		include wc_product_subtitle()->plugin_path( 'assets/markdown/shortcode.md' );
	}

	public function hdiss() {
		include wc_product_subtitle()->plugin_path( 'assets/markdown/how-do-i-style-subtitles.md' );
	}

	public function order_view_page() {
		include wc_product_subtitle()->plugin_path( 'assets/markdown/subtitle-not-visible-in-thankyou-page-myaccount-order-view-page.md' );
	}

	public function shop_page() {
		include wc_product_subtitle()->plugin_path( 'assets/markdown/subtitle-not-visible-in-shop-page.md' );
	}

	public function single_product() {
		include wc_product_subtitle()->plugin_path( 'assets/markdown/subtitle-not-visible-in-single-product-page.md' );
	}

	public function cart_checkout() {
		include wc_product_subtitle()->plugin_path( 'assets/markdown/cart-page.md' );
	}
}
