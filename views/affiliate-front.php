<?php
if( !defined( 'ABSPATH' ) ){
    header('HTTP/1.0 403 Forbidden');
    die('No Direct Access Allowed!');
}

$uw_freelancer_options = get_option('uw_freelancer_options');
$count = $uw_freelancer_options['ad_count'];
$keyword = $uw_freelancer_options['keyword'];
$aff = $uw_freelancer_options['user_id'];
$owner = $uw_freelancer_options['owner'];
$only_featured = $uw_freelancer_options['show_onlyfeatured'];
$order = $uw_freelancer_options['order'];
$order_dir = $uw_freelancer_options['order_dir'];

$script_string =  '<script src="http://api.freelancer.com/Project/Search.json?';
        if(!empty($count)) $script_string .= '&count=' . absint($count);
        if(!empty($keyword)) $script_string .= '&keyword=' . esc_html($keyword) ;
        if(!empty($aff)) $script_string .= '&aff=' . esc_html($aff);
        if(!empty($owner)) $script_string .= '&owner=' . $owner;
        if(!empty($only_featured)) $script_string .= '&featured=' . esc_html($only_featured);
        if(!empty($order)) $script_string .= '&order=' . esc_html($order);
        if(!empty($order_dir)) $script_string .= '&order_dir=' . esc_html($order_dir);        
$script_string .= '&callback=uw_freelancer_affiliate" language="javascript"></script>';
echo apply_filters('uwf-affiliate-front', $script_string, $aff, $uw_freelancer_options, $instance);
?>