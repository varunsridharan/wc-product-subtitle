=== Product Subtitle For WooCommerce ===
Contributors: bravo-computing, varunms
Tags: WooCommerce, product, product title,product subtitle, wc product, product subtitle for wc, subtitle, post subtitle, extra title,wc extra title, wc product name, product code, product, product title,product subtitle, WooCommerce product, subtitle, post subtitle, extra title, WooCommerce product name, product code, WooCommerce extra title
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=9L76L92SD8YAQ
Requires at least: 5.0
Tested up to: 5.9.3
WC requires at least: 3.0
WC tested up to: 6.5.1
Stable tag: 4.6.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Product Subtitle For WooCommerce plugin allows you to easily add a subtitle to your Products.

== Description ==
Product Subtitle For WooCommerce allows you to easily add a subtitle to your products. also provides various options to customize the output. 

You can also use the shortcode `[wc-ps]` to display it within the post content or where ever you need.

It adds a simple input field right under the title field for products. It also add a subtitle column to the edit screen.

= WPML Ready =

Product Subtitle For WooCommerce has been tested by WPML and will allow you to translate the subtitle multilingual sites.

= Shortcode Options =

* Post ID : `[wc-ps id="99"]`
* Element : `[wc-ps tag="p"]` | `[wc-ps tag="h1"]` | `[wc-ps tag="span"]`
* Avaiable Tags : `P, SMALL, SPAN, H1, H2, H3, H4, H5, H6`

> Settings Under : WooCommerce => Product Subtitle For WooCommerce

= How do I style the subtitle? =
You can style the subtitle with the below css class
Global : `product-subtitle`
Product Specific : `subtitle-99`

== Screenshots ==
1. Settings Menu
2. General Settings
3. All Settings
4. Shortcode Settings
5. New Product Subtitle
6. Edit Product Subtitle
7. Subtitle In WPEditor
8. Subtitle In Product List Table
9. Cart Page
10. Mini Cart
11. Checkout Page
12. Order Details Page
13. Shop Page
14. Single Product Page
15. Admin Order Page

== Frequently Asked Questions == 

= How do I style the subtitle? =
You can style the subtitle with the below css class

Global : `product-subtitle`

Product Specific : `subtitle-99`

== Installation ==

= Minimum Requirements =

* WordPress 3.8 or greater
* PHP version 5.2.4 or greater
* MySQL version 5.0 or greater

= Automatic installation =

Automatic installation is the easiest option as WordPress handles the file transfers itself and you don't need to leave your web browser. To do an automatic install of Product Subtitle For WooCommerce, log in to your WordPress dashboard, navigate to the Plugins menu and click Add New.

In the search field type "Product Subtitle For WooCommerce"  and click Search Plugins. Once you've found our plugin you can view details about it such as the the point release, rating and description. Most importantly of course, you can install it by simply clicking "Install Now"

= Manual installation =

The manual installation method involves downloading our plugin and uploading it to your Web Server via your favourite FTP application. The WordPress codex contains [instructions on how to do this here](http://codex.wordpress.org/Managing_Plugins#Manual_Plugin_Installation).

1. Installing alternatives:
 * via Admin Dashboard:
 * Go to 'Plugins > Add New', search for "Product Subtitle For WooCommerce", click "install"
 * OR via direct ZIP upload:
 * Upload the ZIP package via 'Plugins > Add New > Upload' in your WP Admin
 * OR via FTP upload:
 * Upload `wc-product-subtitle` folder to the `/wp-content/plugins/` directory
 
2. Activate the plugin through the 'Plugins' menu in WordPress
 

== Changelog ==
= 4.6.2 =
* Added Option to enable product link in subtitle
* Tested : With Latest WP `5.9.3`
* Tested : With Latest WC `6.5.1`

= 4.6.1 =
* Improved Content Escaping

= 4.6 =
* Renamed `wp_product_subtitle_placements` to `wcps_subtitle_placement_areas`
* Renamed `wc_product_subtitle_default_tags` to `wcps_subtitle_default_tags`
* Renamed `wc_product_subtitle_tags` to `wcps_subtitle_tags`
* Renamed `update_product_subttile` to `wcps_update_subtitle`
* Renamed `get_product_subtitle` to `wcps_get_subtitle`
* Removed `the_product_subtitle`

= 4.5.3 =
* Fixed All Security Issues Reported By WordPress.org Team
* Tested : With Latest WP `5.9`
* Tested : With Latest WC `6.1.1`

= 4.5.2 =
* Updated WPOnion To `1.5.3.7`
* Updated VSP Framework To `1.8.9.8`
* Tested : With Latest WP `5.7`
* Tested : With Latest WC `5.1.0`

= 4.5.1 =
* Fixed : https://github.com/wponion/wponion/issues/252
* Updated WPOnion To `1.5.2`

= 4.5 =
* Fixed : <a href="https://github.com/varunsridharan/wc-product-subtitle/issues/30">2 Subtitle Shown when `order-view` or `email` is configured in our plugin</a>
* Added Option to show subtitle in admin order screen
* improved Performance
* Updated VSP Framework To `1.8.9.1`
* Updated WPOnion To `1.5.1`
* Tested : With Latest WP `5.4.1`
* Tested : With Latest WC `4.2.0`

= 4.4.3 =
* Updated VSP Framework To `0.8.5`
* Updated WPOnion To `1.4.5.3`

= 4.4.2 =
* Updated VSP Framework To `0.8.4`
* Updated WPOnion To `1.4.5.2`

= 4.4.1 =
* Fixed : Minor release bug.

= 4.4 =
* Updated VSP Framework To `0.8.0`
* Updated WPOnion To `1.4.5`
* Tested : With Latest WP
* Tested : With Latest WC

= 4.3 =
* Fixed : HTML Subtitle Display Issue
* Updated VSP Framework To `0.7.9`
* Updated WPOnion To `1.4.0`
* Tested : With Latest WP
* Tested : With Latest WC

= 4.2.1 =
* Added : Option to remove subtitle from WooCommerce PDF Invoices / Packing Slips.
* Updated WPOnion To `1.3.7`

= 4.2 =
* Updated VSP Framework To `0.7.7` which fixes a major vulnerability

= 4.1 =
* Fixed : Subtitle shown even if its set to disabled for single product page
* Updated WPOnion To `1.3.6`
* Updated VSP Framework To `0.7.6`
* Tested With WordPress `5.2.3`
* Tested With WooCommerce `3.7.0`

= 4.0 =
* Plugin Fully Redeveloped From Ground
* Added Mini Cart Support
* Added Eamil Support
* Added Option To Switch Textfield Into WP Editor
* Used WPOnion `1.3.3`
* Used VSP Framework `0.7.3`

= 3.1 =
* Fixed : Reported Issue @ https://wordpress.org/support/topic/fatal-problem-with-site-language-and-permalinks-when-updating-to-version-3-0/

= 3.0 =
* Total Plugin Redeveloped
* Migrated To Our Speedy Custom Framework.
* Added Option for subtitle column in product listing page
* Fixed Issue (https://github.com/varunsridharan/wc-product-subtitle/issues/6)
= 2.3 =
* Minor Bug Fixed
* Tested With Latest WooCommerce & WordPress

= 2.2 =
* Fixed Issues with Email
* Checked with latest wordpress & woocommerce version.

= 2.1 =
* Fixed Settings Page Issue.
* Minor Bug Fix
* Tested With latest WooCommerce & WordPress

= 2.0 =
* Total Plugin Redeveloped
* Added Option To Show In Cart Page
* Added Option To Show In Checkout Page
* Added Option To Show In Email Page
* Added Option To Show In My Account Order View Page

= 1.0 =
* Base Version
