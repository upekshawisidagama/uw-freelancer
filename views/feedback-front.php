<?php
if( !defined( 'ABSPATH' ) ){
    header('HTTP/1.0 403 Forbidden');
    die('No Direct Access Allowed!');
}

global $uw_freelancer;

$uw_freelancer_options = get_option('uw_freelancer_options');

$feedback = $uw_freelancer->get_feedback($uw_freelancer_options['user_id']);

foreach($feedback->feedbacks->items as $project){
    $project_name = $project->project->name;
    $project_link = $project->project->url;
    
    $from_user = $project->from_user->username;
    $from_user_link = $project->from_user->url;
    
    $feedback = $project->descr;
    $rating = $project->rating;
    $value = $project->bid->amount;
    $date = $project->active_unixtime;

$output = '<div>';
    $output .= '<div class="uwf-widget">';

    if($uw_freelancer_options['show_project'] == true && isset($project_name)){
        if($uw_freelancer_options['show_project_link'] && isset($project_link)){
            $output .= '<h4><a href="' . esc_url($project_link) . '">' . esc_html($project_name) . '</a></h4>';
        } else {
            $output .= '<h4>' . esc_html($project_name) . '</h4>';
        }    
    } 
    
    $output .= '<div class="uwf-feedback">';
    $output .= esc_html($feedback);
    
    if($uw_freelancer_options['show_provider'] == true && isset($feedback)){        
        if($uw_freelancer_options['show_provider_link'] && isset($from_user_link)){
            $output .= ' - <a href="' . esc_url($from_user_link) . '">' . esc_html($from_user) . '</a>';
        } else {
            $output .= ' - ' . esc_html($from_user);
        } 
        $output .= '</div>';
    }  
    
    $output .= ' <div class="uwf-profile-details">';
    
    if($uw_freelancer_options['show_rating'] == true && isset($rating)){
        $output .= '<span class="uwf-item">';
        $output .= '<span class="uwf-item-header">' . __('Rating', 'uwf') . ' : </span>' . absint($rating) . ' (/10)';
        $output .= '</span>';
    }
    
    if($uw_freelancer_options['show_value'] == true && isset($value)){
        $output .= '<span class="uwf-item">';
        $output .= '<span class="uwf-item-header">' . __('Project Value', 'uwf') . ' : </span>' . absint($value) . ' USD';
        $output .= '</span>';
    }
    
    if($uw_freelancer_options['show_date'] == true && isset($date)){
        $output .= '<span class="uwf-item">';
        $output .= '<span class="uwf-item-header">' . __('Date', 'uwf') . ' : </span>' . date("j, n, Y", absint($date)) ;
        $output .= '</span>';
    }       
    
    $output .= '</div>';
 
    $output .= '</div>';
$output .= '</div>';

echo apply_filters('uwf-feedback-front', $output, $feedback, $uw_freelancer_options, $instance);
    
}