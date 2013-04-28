<?php
if( !defined( 'ABSPATH' ) ){
    header('HTTP/1.0 403 Forbidden');
    die('No Direct Access Allowed!');
}

global $uw_freelancer;

$uw_freelancer_options = get_option('uw_freelancer_options');

$user = $uw_freelancer->get_user($uw_freelancer_options['user_id'])->profile;

$jobs = implode(", ", $user->jobs);

$hireme_link = 'https://www.freelancer.com/users/' . $user->id . '.html?ext=1&action=hireme';
$hireme_image = UWF_URL . 'images/uw-freelancer-hireme.png';
$freelancer_logo = UWF_URL . 'images/uw-freelancer-com-logo.png';

$output = '<div class="uwf-widget">';

if($uw_freelancer_options['show_freelancer_logo'] == true){
    $output .= ' <div class="uwf-freelancer-logo">';
    $output .= '<img src="' . $freelancer_logo . '" alt="freelancer-com-logo" />';
    $output .= ' </div>';
}

if($uw_freelancer_options['show_userphoto'] == true && isset($user->profile_logo_url)){
    $output .= ' <div class="uwf-profile-photo">';
    $output .= '<img src="' . esc_url($user->profile_logo_url) . '" alt="freelancer-user-photo" />';
    $output .= ' </div>';
}

    $output .= ' <div class="uwf-profile-details">';

if($uw_freelancer_options['show_username'] == true && isset($user->username)){
    $output .= '<span class="uwf-item">';
    $output .= '<span class="uwf-item-header">' . __('Username', 'uwf') . ' : </span>' . esc_html($user->username) ;
    $output .= '</span>';
}

if($uw_freelancer_options['show_company'] == true && isset($user->company)){
    $output .= '<span class="uwf-item">';
    $output .= '<span class="uwf-item-header">' . __('Company', 'uwf') . ' : </span>' . esc_html($user->company) ;
    $output .= '</span>';
}

if($uw_freelancer_options['show_city'] == true && isset($user->address->city)){
    $output .= '<span class="uwf-item">';
    $output .= '<span class="uwf-item-header">' . __('City', 'uwf') . ' : </span>' . esc_html($user->address->city) ;
    $output .= '</span>';
}

if($uw_freelancer_options['show_country'] == true && isset($user->address->country)){
    $output .= '<span class="uwf-item">';
    $output .= '<span class="uwf-item-header">' . __('Country', 'uwf') . ' : </span>' . esc_html($user->address->country) ;
    $output .= '</span>';
}

if($uw_freelancer_options['show_regdate'] == true && isset($user->reg_unixtime)){
    $output .= '<span class="uwf-item">';
    $output .= '<span class="uwf-item-header">' . __('Registered date', 'uwf') . ' : </span>' . date("j, n, Y", absint($user->reg_unixtime)) ;
    $output .= '</span>';
}

if($uw_freelancer_options['show_rating'] == true && isset($user->provider_rating->avg)){
    $output .= '<span class="uwf-item">';
    $output .= '<span class="uwf-item-header">' . __('Average Rating', 'uwf') . ' : </span>' . absint( $user->provider_rating->avg ) . ' (/10)';
    $output .= '</span>';
}

if($uw_freelancer_options['show_count'] == true && isset($user->provider_rating->count)){
    $output .= '<span class="uwf-item">';
    $output .= '<span class="uwf-item-header">' . __('No of projects completed', 'uwf') . ' : </span>' . absint($user->provider_rating->count) ;
    $output .= '</span>';
}

if($uw_freelancer_options['show_jobs'] == true && isset($user->jobs)){
    $output .= '<span class="uwf-item">';
    $output .= '<span class="uwf-item-header">' . __('Jobs', 'uwf') . ' : </span>' . esc_html($jobs) ;
    $output .= '</span>';
}
    $output .= ' </div>';
    $output .= ' <div class="uwf-hire-me-link">';    
    $output .= ' <a  href="'. esc_url($hireme_link) .'"><img src="' . esc_url($hireme_image) . '" /></a>';
    $output .= ' </div>';
    $output .= ' </div>';
    
echo apply_filters('uwf-profile-front', $output, $user, $uw_freelancer_options, $instance);

?>