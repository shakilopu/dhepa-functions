<?php
/**
 * Plugin Name: Dhepa Functions
 * Plugin URI: https://www.dhepa.com/dhepa-function
 * Description: This plugin is required for Dhepa Newspaper Theme.
 * Version: 1.0
 * Author: Dhepa
 * Author URI: https://www.dhepa.com
 */

 /// Dhepa sidebar Widgets

/// Redux Admin Panel
include_once('redux/admin/redux-core/framework.php');
include_once('redux/admin/sample/config.php');

global $dhepa;
$dhepa = get_option('dhepa');
include_once('widgets/dhepa-related-popular-post.php');
include_once('widgets/dhepa-popular-post.php');
include_once('widgets/dhepa-recommend-post.php');
include_once('widgets/dhepa-facebook-like-box.php');
include_once('widgets/dhepa-latest-popular-tab-mobile.php');
include_once('widgets/dhepa-prayer-time.php');
include_once('widgets/dhepa-map-news.php');
include_once('widgets/dhepa-latest-popular-tab.php');

/// Custom Post
include_once('custom_post/dhepa-custom-posts.php');

/// Import Demo Data
////////////////

function prefix_demo_import_lists(){
	$demo_lists = array(
		'demo1' =>array(
			'title' => __( 'Demo 1', 'dhepa' ),/*Title*/
			'is_pro' => true,/*Is Premium*/
			//'type' => 'gutentor',/*Optional eg gutentor, elementor or other page builders or type*/
			'author' => __( 'Dhepa Coding Studio', 'dhepa' ),/*Author Name*/
		//	'keywords' => array( 'Newspaper', 'Blog' ),/*Search keyword*/
		//	'categories' => array( 'Newspaper','Blog' ),/*Categories*/
            'template_url' => array(
                'content' =>  plugin_dir_url( __FILE__ ).'demo/demo1/content.json', /*Full URL Path to content.json*/
                'options' =>  plugin_dir_url( __FILE__ ).'demo/demo1/options.json', /*Full URL Path to options.json*/
                'widgets' =>  plugin_dir_url( __FILE__ ).'demo/demo1/widgets.json', /*Full URL Path to widgets.json*/
            ),
			'screenshot_url' => plugin_dir_url( __FILE__ ).'demo/demo1/preview_import_image1.jpg',/*Full URL Path to demo screenshot image*/
			'demo_url' => 'https://latest.dhepa.com/',/*Full URL Path to Live Demo*/
			
		),

        /*and so on ............................*/
	);
	return $demo_lists;
}
add_filter('advanced_import_demo_lists','prefix_demo_import_lists');
//Give premium template access on premium version of theme
add_action( 'advanced_import_is_pro_active','prefix_set_active' );
function prefix_set_active($is_pro_active){
    //You can add your own logic to return true or false
    return true;
}

/////////////////////////////////////////////

require __DIR__ . '/vendor/autoload.php';
use Automattic\WooCommerce\Client;

$woocommerce = new Client(
    'https://dhepa.com',
    'ck_11d3450df35fcf49141d2f029a33c7b2d802e7e6',
    'cs_08e1ac4b17132e2ce57b66ef9838b3e46e0709f3',
    [
        'wp_api' => true,
        'version' => 'wc/v3'
    ]
);

$order_data = json_encode($woocommerce->get('orders'));

$order_data = json_decode($order_data, true);
$orderid = $dhepa["purchase-code"];
$bks_trans = $dhepa["bkash-code"];
$search_key = $orderid;
$website = "";
$status = "";
$order_key = "";
$product_id = "";
$bkash = "";
$billing_name ="";
foreach ($order_data as $item) {   // $order_data is initial array
    foreach($item as $subitem){
        if (is_array($subitem) || is_object($subitem)){
            foreach($subitem as $finalItem){
                if ($item['order_key'] === $search_key) {
                    $status = $item['status'];
                    $order_key = $item['order_key'];
                    $website = $item['meta_data'][4]['value'];
                    $bkash = $item['meta_data'][3]['value'];
                    $product_id = $item['line_items'][0]['product_id'];
                    $billing_name = $item['billing']['first_name'];
                    break;
                }
            }
        }
    }
}

$url = parse_url(get_home_url(), PHP_URL_HOST);
if(!is_admin() && $GLOBALS['pagenow'] !== 'wp-login.php'){
    if($orderid === $order_key && $product_id == 1926 && $url === 'localhost' && $bks_trans === $bkash && $status == "completed"){
      
    }else{
       
       ?> 
      <div style="text-align:center;">
            <p style="font-size:20px;"> Hello <span style="font-weight:bold;"><?php echo esc_attr($billing_name); ?>!</span> </p> 
            <p style="font-size:20px;">Thanks to you for purchase our theme for <span style="font-weight:bold;"><?php echo esc_attr($website); ?> </span>. But You are trying to use it for <span style="font-weight:bold;"><?php echo esc_attr($url); ?> </span> </p> 
            <p style="font-size:20px;"> Your Order status is <span style="font-weight:bold;"><?php echo esc_attr($status); ?></span> now. Please contact with us. </p> 
            <p style="font-size:20px;"> Your OrderID: <span style="font-weight:bold;"> <?php echo esc_attr($orderid); ?></span>. </p>
            <h1>Please buy and activate this theme from <a target="_blank" href='https://dhepa.com/product/dhepa-latest-newspaper-theme-single-website-lifetime-license/'> Dhepa.com</a></h1>
            <p style="font-size:20px;">If you feel its a problem, Please contact us soon.</p>
      </div>
       
      
      <?php die();
    }
}
///////////////////////////////
