<?php
if( !defined( 'ABSPATH') && !defined('WP_UNINSTALL_PLUGIN') )
    exit();

if( get_option('uw_freelancer_options') ){
    delete_option( 'uw_freelancer_options' );
    delete_option( 'uw_freelancer_styles' );    
}
?>