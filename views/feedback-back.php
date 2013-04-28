<?php
if( !defined( 'ABSPATH' ) ){
    header('HTTP/1.0 403 Forbidden');
    die('No Direct Access Allowed!');
}

$output = '<img src="' . UWF_URL . 'images/uw-freelancer-widget-icon.png">';
$output .= '<h4>WordPress Freelancer Feedback Widget</h4>';
$output .= 'Display a widget featuring the latest feedback you received on freelancer.com.<br /><br />';
$output .= '<a href="' . admin_url() . 'admin.php?page=uw-freelancer-settings&tab=feedback" class="button">Configure Feedback Widget</a>';

echo apply_filters('uwf-feedback-back', $output, $instance );
?>