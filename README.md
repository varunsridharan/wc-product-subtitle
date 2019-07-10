# WooCommerce Product Subtitle 
**Contributors:** bravo-computing, varunms  
**Tags:** WooCommerce, product, product title,product subtitle, wc product, wc product subtitle, subtitle, post subtitle, extra title,wc extra title, wc product name, product code, product, product title,product subtitle, WooCommerce product, WooCommerce product subtitle, subtitle, post subtitle, extra title, WooCommerce product name, product code, WooCommerce extra title  
**Donate link:** https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=9L76L92SD8YAQ  
**Requires at least:** 3.0  
**Tested up to:** 5.0  
**WC requires at least:** 3.0  
**WC tested up to:** 3.6.5  
**Stable tag:** 4.0  
**License:** GPLv2 or later  
**License URI:** http://www.gnu.org/licenses/gpl-2.0.html  

WooCommerce Product Subtitle plugin allows you to easily add a subtitle to your Products.


## Description 
WooCommerce Product Subtitle allows you to easily add a subtitle to your products. also provides various options to customize the output. 

You can also use the shortcode `[wc-ps]` to display it within the post content or where ever you need.

It adds a simple input field right under the title field for products. It also add a subtitle column to the edit screen.


### WPML Ready 

WC Product Subtitle has been tested by WPML and will allow you to translate the subtitle multilingual sites.  


### Shortcode Options 

* Post ID : `[wc-ps id="99"]`
* Element : `[wc-ps tag="p"]` | '[wc-ps tag="h1"]` | '[wc-ps tag="span"]` |
* Avaiable Tags : `P, SMALL, SPAN, H1, H2, H3, H4, H5, H6`

> Settings Under : WooCommerce => WooCommerce Product Subtitle


### How do I style the subtitle? 
You can style the subtitle with the below css class
Global : `product-subtitle`
Product Specific : `subtitle-99`


## Screenshots 
* Settings Menu
* Cart Page Settings
* Checkout Page Settings
* Order Review, My Account Order View & Email Settings
* Shop Page Settings
* Single Product Page Settings
* Product Edit Page Field
* FrontEnd Single Product Page
* Frontend Shop Page
* Shortcode



## Upgrade Notice 


## Frequently Asked Questions 


### How do I style the subtitle? 
You can style the subtitle with the below css class

Global : `product-subtitle`

Product Specific : `subtitle-99`


### How To Add Custom Tag ? 
<strong> Use the below function to register the tag first </strong>
> add_filter('wc_ps_tags','register_custom_tag');
> function register_custom_tag($tags){
>    $tags['tag_slug'] = 'Tag Name';
>    return $tags;
> }

<strong> Now use the below action to render your own tag (`wc_ps_subtitle_{tag_slug}`) </strong>

> add_action('wc_ps_subtitle_tag_slug','render_custom_tag');
> function render_custom_tag($title,$tag,$pid,$defaults) {
>   echo '<custom_tag>".$title."</custom_tag>";
> }

<strong> function variable details</strong>

* `$title` : Product's Subtitle
* `$tag` : Call back Tag
* `$pid` : Current Product ID
* `$defaults` : is array of default class & id for the element





## Installation 


### Minimum Requirements 

* WordPress 3.8 or greater
* PHP version 5.2.4 or greater
* MySQL version 5.0 or greater


### Automatic installation 

Automatic installation is the easiest option as WordPress handles the file transfers itself and you don't need to leave your web browser. To do an automatic install of WooCommerce Product Subtitle, log in to your WordPress dashboard, navigate to the Plugins menu and click Add New.

In the search field type "WooCommerce Product Subtitle"  and click Search Plugins. Once you've found our plugin you can view details about it such as the the point release, rating and description. Most importantly of course, you can install it by simply clicking "Install Now"


### Manual installation 

The manual installation method involves downloading our plugin and uploading it to your Web Server via your favourite FTP application. The WordPress codex contains [instructions on how to do this here](http://codex.wordpress.org/Managing_Plugins#Manual_Plugin_Installation).

1. Installing alternatives:
 * via Admin Dashboard:
 * Go to 'Plugins > Add New', search for "WooCommerce Product Subtitle", click "install"
 * OR via direct ZIP upload:
 * Upload the ZIP package via 'Plugins > Add New > Upload' in your WP Admin
 * OR via FTP upload:
 * Upload `wc-product-subtitle` folder to the `/wp-content/plugins/` directory
 
2. Activate the plugin through the 'Plugins' menu in WordPress
 


## Changelog 

### 4.0 
* Plugin Fully Redeveloped From Ground
* Added Mini Cart Support
* Added Eamil Support
* Added Option To Switch Textfield Into WP Editor
* Used WPOnion `1.3.3`
* Used VSP Framework `0.7.3`


### 3.1 
* Fixed : Reported Issue @ https://wordpress.org/support/topic/fatal-problem-with-site-language-and-permalinks-when-updating-to-version-3-0/


### 3.0 
* Total Plugin Redeveloped
* Migrated To Our Speedy Custom Framework.
* Added Option for subtitle column in product listing page
* Fixed Issue (https://github.com/varunsridharan/wc-product-subtitle/issues/6)

### 2.3 
* Minor Bug Fixed
* Tested With Latest WooCommerce & WordPress


### 2.2 
* Fixed Issues with Email
* Checked with latest wordpress & woocommerce version.


### 2.1 
* Fixed Settings Page Issue.
* Minor Bug Fix
* Tested With latest WooCommerce & WordPress


### 2.0 
* Total Plugin Redeveloped
* Added Option To Show In Cart Page
* Added Option To Show In Checkout Page
* Added Option To Show In Email Page
* Added Option To Show In My Account Order View Page


### 1.0 
* Base Version
