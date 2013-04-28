<?php
if( !defined( 'ABSPATH' ) ){
    header('HTTP/1.0 403 Forbidden');
    die('No Direct Access Allowed!');
}

global $uw_freelancer;

$uw_freelancer_options = get_option('uw_freelancer_options');

add_settings_section(
        'freelancer_transients', 
        __('Freelancer Transients', 'uwf'), 
        'freelancer_transients', 
        'uw-freelancer-settings');

function freelancer_transients(){
    echo __('Manage Freelancer Transients', 'uwf');
}

add_settings_field('transient_timeout', __('Transient Timeout', 'uwf'), 'transient_timeout', 'uw-freelancer-settings', 'freelancer_transients');

function transient_timeout(){
    $uw_freelancer_options = get_option('uw_freelancer_options');
    echo '<input type="text" id="uw_freelancer_options[transient_timeout]" name="uw_freelancer_options[transient_timeout]" value="' . $uw_freelancer_options['transient_timeout'] . '">';
    echo __(' Enter Transients Timeout in Hours', 'uwf');
}

add_settings_field('clear_transients', __('Clear Transients', 'uwf'), 'clear_transients', 'uw-freelancer-settings', 'freelancer_transients');

function clear_transients(){
    $uw_freelancer_options = get_option('uw_freelancer_options');
    $checked = $uw_freelancer_options['clear_transients'];
    echo '<input type="checkbox" id="uw_freelancer_options[clear_transients]" name="uw_freelancer_options[clear_transients]" value="1"'; checked($checked); echo ' />';
    echo __(' Delete transients (Press Save button to delete)', 'uwf') . '<br /><br />';
}
echo '<div id="tabs">';
  echo '<ul>';
    echo '<li><a href="#tabs-1">' . __('Freelancer Transients', 'uwf') . '</a></li>';
    echo '<li><a href="#tabs-2">' . __('User Object', 'uwf') . '</a></li>';
    echo '<li><a href="#tabs-3">' . __('Feedback Object', 'uwf') . '</a></li>';
  echo '</ul>';
  echo '<div id="tabs-1">';
    echo '<h3>' . __('UW Freelancer Transients', 'uwf') . '</h3>';
    echo '<p>' . __('UW Freelancer plugin stores queried freelancer.com api responses in WordPress
    transients. User Object transient stores the profile widget related data.
    Feedback Object stores the feedback widget related data. You can view the content of
    those objects in the next tabs.', 'uwf') . '</p>';
    
    echo '<p>' . __('Check the below checkbox to refresh the objects by querying the api again. Otherwise
    they will be refreshed after transient expiration.', 'uwf') . '</p>';
  echo '</div>';
  echo '<div id="tabs-2">';
    $user_transient = $uw_freelancer->freelancer_transient(
            'get',
            'user',
            $uw_freelancer_options['user_id']
            );
    echo '<h3>' . __('UW Freelancer User Object', 'uwf') . '</h3>';
    echo __('Below is the complete api query response for the user inquiry. It is cached in a WordPress
        transient. You can manually delete the transient before it expires. You can set the Transient 
        expiration period via settings.', 'uwf');
    echo '<pre>';
    print_r($user_transient);
    echo '</pre>';  
  echo '</div>';
  echo '<div id="tabs-3">';
    $feedback_transient = $uw_freelancer->freelancer_transient(
            'get',
            'feedback',
            $uw_freelancer_options['user_id']
            );
    echo '<h3>' . __('UW Freelancer Feedback Object', 'uwf') . '</h3>';
    echo __('Below is the complete api query response for the feedback inquiry. It is cached in a WordPress
        transient. You can manually delete the transient before it expires. You can set the Transient 
        expiration period via settings.', 'uwf');
    echo '<pre>';
    print_r($feedback_transient);
    echo '</pre>';  
  echo '</div>';
echo '</div>';
?>