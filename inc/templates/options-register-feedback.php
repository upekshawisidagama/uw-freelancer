<?php
if( !defined( 'ABSPATH' ) ){
    header('HTTP/1.0 403 Forbidden');
    die('No Direct Access Allowed!');
}

global $uw_freelancer;

$uw_freelancer_options = get_option('uw_freelancer_options');

$feedback = $uw_freelancer->get_feedback($uw_freelancer_options['user_id']);

add_settings_section(
        'freelancer_feedback', 
        __('Freelancer Feedback', 'uwf'), 
        'freelancer_feedback', 
        'uw-freelancer-settings');

function freelancer_feedback(){
    echo __('Manage Freelancer Feedback Widget', 'uwf');
}

add_settings_field('feedback_count', __('Feedback Items Count', 'uwf'), 'feedback_count', 'uw-freelancer-settings', 'freelancer_feedback');

function feedback_count(){
    $uw_freelancer_options = get_option('uw_freelancer_options');
    echo '<input type="text" id="uw_freelancer_options[feedback_count]" name="uw_freelancer_options[feedback_count]" value="' . $uw_freelancer_options['feedback_count'] . '">';
    echo __(' Enter no of feedback items to display', 'uwf');
}

add_settings_field('feedback_type', __('Feedback Type', 'uwf'), 'feedback_type', 'uw-freelancer-settings', 'freelancer_feedback');

function feedback_type(){
    $uw_freelancer_options = get_option('uw_freelancer_options');
    echo '<select name="uw_freelancer_options[feedback_type]">';
        echo '<option value="B"' . selected( $uw_freelancer_options['feedback_type'], 'B' ) . '>Employee/Seller</option>';
        echo '<option value="S"' . selected( $uw_freelancer_options['feedback_type'], 'S' ) . '>Freelancer/Buyer</option>';
    echo '</select>';    
    echo __(' Feedback for a freelancer/buyer(B) or employer/seller(S)', 'uwf');
}

add_settings_field('show_provider', __('Project Poster', 'uwf'), 'show_provider', 'uw-freelancer-settings', 'freelancer_feedback');

function show_provider(){
    $uw_freelancer_options = get_option('uw_freelancer_options');
    $checked = $uw_freelancer_options['show_provider'];
    echo '<input type="checkbox" id="uw_freelancer_options[show_provider]" name="uw_freelancer_options[show_provider]" value="1"'; checked($checked); echo ' />';
    echo __(' Display project poster/employer (feeback provider)', 'uwf');
}

add_settings_field('show_provider_link', __('Project Poster Link', 'uwf'), 'show_provider_link', 'uw-freelancer-settings', 'freelancer_feedback');

function show_provider_link(){
    $uw_freelancer_options = get_option('uw_freelancer_options');
    $checked = $uw_freelancer_options['show_provider_link'];
    echo '<input type="checkbox" id="uw_freelancer_options[show_provider_link]" name="uw_freelancer_options[show_provider_link]" value="1"'; checked($checked); echo ' />';
    echo __(' Display a link to project poster/employer profile on freelancer.com (feeback provider)', 'uwf');
}

add_settings_field('show_project', __('Show Project', 'uwf'), 'show_project', 'uw-freelancer-settings', 'freelancer_feedback');

function show_project(){
    $uw_freelancer_options = get_option('uw_freelancer_options');
    $checked = $uw_freelancer_options['show_project'];
    echo '<input type="checkbox" id="uw_freelancer_options[show_project]" name="uw_freelancer_options[show_project]" value="1"'; checked($checked); echo ' />';
    echo __(' Display the project name for a feedback item', 'uwf');
}

add_settings_field('show_project_link', __('Show Project Link', 'uwf'), 'show_project_link', 'uw-freelancer-settings', 'freelancer_feedback');

function show_project_link(){
    $uw_freelancer_options = get_option('uw_freelancer_options');
    $checked = $uw_freelancer_options['show_project_link'];
    echo '<input type="checkbox" id="uw_freelancer_options[show_project_link]" name="uw_freelancer_options[show_project_link]" value="1"'; checked($checked); echo ' />';
    echo __(' Display a link to the project for a feedback item', 'uwf');
}

add_settings_field('show_rating', __('Project Rating', 'uwf'), 'show_rating', 'uw-freelancer-settings', 'freelancer_feedback');

function show_rating(){
    $uw_freelancer_options = get_option('uw_freelancer_options');
    $checked = $uw_freelancer_options['show_rating'];
    echo '<input type="checkbox" id="uw_freelancer_options[show_rating]" name="uw_freelancer_options[show_rating]" value="1"'; checked($checked); echo ' />';
    echo __(' Display project rating associate with the feedback', 'uwf');
}

add_settings_field('show_value', __('Project Budget', 'uwf'), 'show_value', 'uw-freelancer-settings', 'freelancer_feedback');

function show_value(){
    $uw_freelancer_options = get_option('uw_freelancer_options');
    $checked = $uw_freelancer_options['show_value'];
    echo '<input type="checkbox" id="uw_freelancer_options[show_value]" name="uw_freelancer_options[show_value]" value="1"'; checked($checked); echo ' />';
    echo __(' Display project value', 'uwf');
}

add_settings_field('show_date', __('Project Date', 'uwf'), 'show_date', 'uw-freelancer-settings', 'freelancer_feedback');

function show_date(){
    $uw_freelancer_options = get_option('uw_freelancer_options');
    $checked = $uw_freelancer_options['show_date'];
    echo '<input type="checkbox" id="uw_freelancer_options[show_date]" name="uw_freelancer_options[show_date]" value="1"'; checked($checked); echo ' />';
    echo __(' Display feedback date', 'uwf') . '<br /><br />';
}

do_action('uwf-feedback-settings');
?>
