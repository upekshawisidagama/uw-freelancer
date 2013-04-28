<?php
if( !defined( 'ABSPATH' ) ){
    header('HTTP/1.0 403 Forbidden');
    die('No Direct Access Allowed!');
}

$output = '<img src="' . UWF_URL . 'images/uw-freelancer-widget-icon.png">';
$output .= '<h4>WordPress Freelancer Profile Widget</h4>';
$output .= 'Display a customized version of freelancer.com profile in your site.<br /><br />';
$output .= '<a href="' . admin_url() . 'admin.php?page=uw-freelancer-settings&tab=profile" class="button">Configure Profile Widget</a>';

echo apply_filters('uwf-profile-back', $output, $instance);
?>