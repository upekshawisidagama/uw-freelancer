<?php
if( !defined( 'ABSPATH' ) ){
    header('HTTP/1.0 403 Forbidden');
    die('No Direct Access Allowed!');
}

global $uw_freelancer;

$uw_freelancer_options = get_option('uw_freelancer_options');

$feedback = $uw_freelancer->get_user($uw_freelancer_options['user_id']);
$feedback = $uw_freelancer->get_feedback($uw_freelancer_options['user_id']);

add_settings_section(
        'profile_information', 
        __('Freelancer Profile', 'uwf'), 
        'profile_information', 
        'uw-freelancer-settings');

function profile_information(){
    echo __('Freelancer Profile Information', 'uwf');
}

add_settings_field('user_id', __('User ID', 'uwf'), 'user_id', 'uw-freelancer-settings', 'profile_information');

function user_id(){
    $uw_freelancer_options = get_option('uw_freelancer_options');
    echo '<input type="text" id="uw_freelancer_options[user_id]" name="uw_freelancer_options[user_id]" value="' . $uw_freelancer_options['user_id'] . '">';
    echo __(' Enter your freelancer.com user id', 'uwf');
}

add_settings_section(
        'profile_structure', 
        __('Profile Structure', 'uwf'), 
        'profile_structure', 
        'uw-freelancer-settings');

function profile_structure(){
    echo __('Manage freelancer profile widget structure', 'uwf');
}

add_settings_field('freelancer_logo', __('Freelancer Logo', 'uwf'), 'freelancer_logo', 'uw-freelancer-settings', 'profile_structure');

function freelancer_logo(){
    $uw_freelancer_options = get_option('uw_freelancer_options');
    $checked = $uw_freelancer_options['show_freelancer_logo'];
    echo '<input type="checkbox" id="uw_freelancer_options[show_freelancerlogo]" name="uw_freelancer_options[show_freelancer_logo]" value="1"'; checked($checked); echo ' />';
    echo __(' Display freelancer.com logo on top of the profile widget', 'uwf');
}

add_settings_field('user_photo', __('User Photo', 'uwf'), 'freelancer_user_photo', 'uw-freelancer-settings', 'profile_structure');

function freelancer_user_photo(){
    $uw_freelancer_options = get_option('uw_freelancer_options');
    $checked = $uw_freelancer_options['show_userphoto'];
    echo '<input type="checkbox" id="uw_freelancer_options[show_userphoto]" name="uw_freelancer_options[show_userphoto]" value="1"'; checked($checked); echo ' />';
    echo __(' Display freelancer.com user profile photo in the profile widget', 'uwf');
}

add_settings_field('username', __('Username', 'uwf'), 'freelancer_username', 'uw-freelancer-settings', 'profile_structure');

function freelancer_username(){
    $uw_freelancer_options = get_option('uw_freelancer_options');
    $checked = $uw_freelancer_options['show_username'];
    echo '<input type="checkbox" id="uw_freelancer_options[show_username]" name="uw_freelancer_options[show_username]" value="1"'; checked($checked); echo ' />';
    echo __(' Display freelancer.com username in the profile widget', 'uwf');
}

add_settings_field('company', __('Company', 'uwf'), 'freelancer_company', 'uw-freelancer-settings', 'profile_structure');

function freelancer_company(){
    $uw_freelancer_options = get_option('uw_freelancer_options');
    $checked = $uw_freelancer_options['show_company'];
    echo '<input type="checkbox" id="uw_freelancer_options[show_company]" name="uw_freelancer_options[show_company]" value="1"'; checked($checked); echo ' />';
    echo __(' Display freelancer.com user company in the profile widget', 'uwf');
}

add_settings_field('city', __('City', 'uwf'), 'freelancer_city', 'uw-freelancer-settings', 'profile_structure');

function freelancer_city(){
    $uw_freelancer_options = get_option('uw_freelancer_options');
    $checked = $uw_freelancer_options['show_city'];
    echo '<input type="checkbox" id="uw_freelancer_options[show_city]" name="uw_freelancer_options[show_city]" value="1"'; checked($checked); echo ' />';
    echo __(' Display freelancer.com user city in the profile widget', 'uwf');
}

add_settings_field('country', __('Country', 'uwf'), 'freelancer_country', 'uw-freelancer-settings', 'profile_structure');

function freelancer_country(){
    $uw_freelancer_options = get_option('uw_freelancer_options');
    $checked = $uw_freelancer_options['show_country'];
    echo '<input type="checkbox" id="uw_freelancer_options[show_country]" name="uw_freelancer_options[show_country]" value="1"'; checked($checked); echo ' />';
    echo __(' Display freelancer.com user country in the profile widget', 'uwf');
}

add_settings_field('regdate', __('Registred Date', 'uwf'), 'freelancer_regdate', 'uw-freelancer-settings', 'profile_structure');

function freelancer_regdate(){
    $uw_freelancer_options = get_option('uw_freelancer_options');
    $checked = $uw_freelancer_options['show_regdate'];
    echo '<input type="checkbox" id="uw_freelancer_options[show_regdate]" name="uw_freelancer_options[show_regdate]" value="1"'; checked($checked); echo ' />';
    echo __(' Display freelancer.com user registered date in the profile widget', 'uwf');
}

add_settings_field('rating', __('Rating', 'uwf'), 'freelancer_rating', 'uw-freelancer-settings', 'profile_structure');

function freelancer_rating(){
    $uw_freelancer_options = get_option('uw_freelancer_options');
    $checked = $uw_freelancer_options['show_rating'];
    echo '<input type="checkbox" id="uw_freelancer_options[show_rating]" name="uw_freelancer_options[show_rating]" value="1"'; checked($checked); echo ' />';
    echo __(' Display freelancer.com user provider rating in the profile widget', 'uwf');
}

add_settings_field('count', __('Project Count', 'uwf'), 'freelancer_count', 'uw-freelancer-settings', 'profile_structure');

function freelancer_count(){
    $uw_freelancer_options = get_option('uw_freelancer_options');
    $checked = $uw_freelancer_options['show_count'];
    echo '<input type="checkbox" id="uw_freelancer_options[show_count]" name="uw_freelancer_options[show_count]" value="1"'; checked($checked); echo ' />';
    echo __(' Display freelancer.com user completed project count in the profile widget', 'uwf');
}

add_settings_field('jobs', __('Job List', 'uwf'), 'freelancer_jobs', 'uw-freelancer-settings', 'profile_structure');

function freelancer_jobs(){
    $uw_freelancer_options = get_option('uw_freelancer_options');
    $checked = $uw_freelancer_options['show_jobs'];
    echo '<input type="checkbox" id="uw_freelancer_options[show_jobs]" name="uw_freelancer_options[show_jobs]" value="1"'; checked($checked); echo ' />';
    echo __(' Display freelancer.com job list in the profile widget', 'uwf');
}

add_settings_section(
        'profile_format', 
        __('Freelancer Styles', 'uwf'), 
        'profile_format', 
        'uw-freelancer-settings');

function profile_format(){
    echo __('Formatting/Styling options for Freelancer.com Widgets', 'uwf');
}

add_settings_field('customizer_link', __('Customize Appearence', 'uwf'), 'customizer_link', 'uw-freelancer-settings', 'profile_format');

function customizer_link(){
    echo '<p><a class="button" href="' . get_admin_url() . 'customize.php">' . __('Customize Widget Appearence', 'uwf') . '</a> ' . __('Visit Freelancer Widget section to customize the widget appearence', 'uwf') . '</p><br /><br />';
}

do_action('uwf-profile-settings');
?>
