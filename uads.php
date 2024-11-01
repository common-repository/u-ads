<?php
/*
Plugin Name: U Ads
Plugin URI: http://weblife24h.com
Description: When scrolling post down U Ads will display a advertisement flyout box <a href="options-general.php?page=uads">Options configuration panel</a>
Author: doanhienitpro
Version: 1.0
Author URI: http://weblife24h.com
*/

register_sidebar( array(
    'id'            => 'U-Ads',
    'name'          => __( 'U Ads', '' ),
    'description'   => __( 'This is a widget area - U Ads', '' ),
    'before_widget' => '<div id="home-featured"><div id="%1$s" class="widget %2$s"><div class="widget-wrap">',
    'after_widget' => "</div></div></div>\n",
    'before_title' => '<h4 class="widgettitle addtion-title">',
    'after_title' => "</h4>\n"
) );
global $uads_currentPostID, $uads_is_single, $uads_added;

include('uads_settings.php');

function uads_box() {
    echo "<div id='uads_box'>";
    dynamic_sidebar( "U-Ads" ); 
    echo "</div>";   
}
add_action('wp_footer', 'uads_box');

function uads_shortcode( $atts, $content = null ) {
    global $uads_added;
    $uads_added = true;
    return '<div id="uads_box">'.$content.'<button id="uads_close" type="button">Close</button></div>';
}
add_shortcode( 'uads', 'uads_shortcode' );

function uads_init() {
    $plugin_path = WP_PLUGIN_URL.'/'.str_replace(basename( __FILE__),"",plugin_basename(__FILE__));
    wp_enqueue_script("jquery");
    wp_enqueue_script("uads-js",$plugin_path.'uads_js.php'); //wp_enqueue_script("uads-js",$plugin_path.'uads_js.php',array(),'1.4.0',true);
    wp_enqueue_style("uads-css",$plugin_path.'uads.css');
}
add_action('init', 'uads_init');

function uads_styles() {
    $options = get_option("uads-settings-group");
    $position = $options['uads_position'] != 'left' ? "right" : "left";
    if ($options['uads_animation'] == "fade") {
        echo "<style type='text/css'>#uads_box {display:none;$position: 0px;}</style>\n";
    } else {
        echo "<style type='text/css'>#uads_box {display:block;$position: -400px;}</style>\n";
    }
}
add_action('wp_print_styles', 'uads_styles')

?>
