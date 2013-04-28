<?php
if( !defined( 'ABSPATH' ) ){
    header('HTTP/1.0 403 Forbidden');
    die('No Direct Access Allowed!');
}

$output = '<img src="' . UWF_URL. 'images/uw-freelancer-widget-icon.png">';
$output .= '<h4>WordPress Freelancer Affiliate Widget</h4>';
$output .= 'Refer your friends/visitors to freelancer.com help get their projects done. + earn bonuses.<br /><br />';
$output .= '<a href="' . admin_url() . 'admin.php?page=uw-freelancer-settings&tab=affiliate" class="button">Configure Affiliate Widget</a>';

echo apply_filters('uwf-affiliate-back', $output, $instance);
?> 