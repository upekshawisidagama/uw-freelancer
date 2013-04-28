<?php
if( !defined( 'ABSPATH' ) ){
    header('HTTP/1.0 403 Forbidden');
    die('No Direct Access Allowed!');
}

add_settings_section(
        'affiliate_config', 
        __('Freelancer Affiliate Program', 'uwf'), 
        'affiliate_config', 
        'uw-freelancer-settings');

function affiliate_config(){
    echo __('Freelancer Affiliate Program Settings', 'uwf');
}

add_settings_field('keyword', __('Search Keyword', 'uwf'), 'keyword', 'uw-freelancer-settings', 'affiliate_config');

function keyword(){
    $uw_freelancer_options = get_option('uw_freelancer_options');
    echo '<input type="text" id="uw_freelancer_options[keyword]" name="uw_freelancer_options[keyword]" value="' . $uw_freelancer_options['keyword'] . '">';
    echo __(' Enter keyword to query projects', 'uwf');
}

add_settings_field('ad_count', __('Project Count', 'uwf'), 'ad_count', 'uw-freelancer-settings', 'affiliate_config');

function ad_count(){
    $uw_freelancer_options = get_option('uw_freelancer_options');
    echo '<input type="text" id="uw_freelancer_options[ad_count]" name="uw_freelancer_options[ad_count]" value="' . $uw_freelancer_options['ad_count'] . '">';
    echo __(' How many projects should be listed on affliate widget', 'uwf');
}

add_settings_field('owner', __('Project Owner', 'uwf'), 'owner', 'uw-freelancer-settings', 'affiliate_config');

function owner(){
    $uw_freelancer_options = get_option('uw_freelancer_options');
    echo '<input type="text" id="uw_freelancer_options[owner]" name="uw_freelancer_options[owner]" value="' . $uw_freelancer_options['owner'] . '">';
    echo __(' Search owners projects for listing. This setting is for Sellers.', 'uwf');
}

add_settings_field('only_featured', __('Only Featured Projects', 'uwf'), 'only_featured', 'uw-freelancer-settings', 'affiliate_config');

function only_featured(){
    $uw_freelancer_options = get_option('uw_freelancer_options');
    $checked = $uw_freelancer_options['show_onlyfeatured'];
    echo '<input type="checkbox" id="uw_freelancer_options[show_onlyfeatured]" name="uw_freelancer_options[show_onlyfeatured]" value="1"'; checked($checked); echo ' />';
    echo __(' List only featured projects', 'uwf');
}

add_settings_field('order', __('Project Listing Order', 'uwf'), 'order', 'uw-freelancer-settings', 'affiliate_config');

function order(){
    $uw_freelancer_options = get_option('uw_freelancer_options');
    echo '<select name="uw_freelancer_options[order]">';
        echo '<option value="id"' . selected( $uw_freelancer_options['order'], 'id' ) . '>id</option>';
        echo '<option value="submitdate"' . selected( $uw_freelancer_options['order'], 'submitdate' ) . '>submitdate</option>';
        echo '<option value="state"' . selected( $uw_freelancer_options['order'], 'state' ) . '>state</option>';
        echo '<option value="bid_count"' . selected( $uw_freelancer_options['order'], 'bid_count' ) . '>bid_count</option>';
        echo '<option value="bid_avg"' . selected( $uw_freelancer_options['order'], 'bid_avg' ) . '>bid_avg</option>';
        echo '<option value="bid_enddate"' . selected( $uw_freelancer_options['order'], 'bid_enddate' ) . '>bid_enddate</option>';
        echo '<option value="buyer"' . selected( $uw_freelancer_options['order'], 'buyer' ) . '>buyer</option>';
        echo '<option value="budget"' . selected( $uw_freelancer_options['order'], 'budget' ) . '>budget</option>';
        echo '<option value="relevance"' . selected( $uw_freelancer_options['order'], 'relevance' ) . '>relevance</option>';
        echo '<option value="rand"' . selected( $uw_freelancer_options['order'], 'rand' ) . '>rand</option>';        
    echo '</select>';    
    echo __(' How to order projects in the result output.', 'uwf');
}

add_settings_field('order_dir', __('Order Direction', 'uwf'), 'order_dir', 'uw-freelancer-settings', 'affiliate_config');

function order_dir(){
    $uw_freelancer_options = get_option('uw_freelancer_options');
    echo '<select name="uw_freelancer_options[order_dir]">';
        echo '<option value="asc"' . selected( $uw_freelancer_options['order_dir'], 'asc' ) . '>asc</option>';
        echo '<option value="desc"' . selected( $uw_freelancer_options['order_dir'], 'desc' ) . '>desc</option>';
    echo '</select>';    
    echo __(' Direction of sorting', 'uwf');
}

add_settings_section(
        'affiliate_listing', 
        __('Freelancer Affiliate Listing', 'uwf'), 
        'affiliate_listing', 
        'uw-freelancer-settings');

function affiliate_listing(){
    echo __('Format Freelancer Affiliate Listing', 'uwf');
}

add_settings_field('show_adname', __('Project Name', 'uwf'), 'show_adname', 'uw-freelancer-settings', 'affiliate_listing');

function show_adname(){
    $uw_freelancer_options = get_option('uw_freelancer_options');
    $checked = $uw_freelancer_options['show_adname'];
    echo '<input type="checkbox" id="uw_freelancer_options[show_adname]" name="uw_freelancer_options[show_adname]" value="1"'; checked($checked); echo ' />';
    echo __(' Display Project Name', 'uwf');
}

add_settings_field('show_addesc', __('Project Description', 'uwf'), 'show_addesc', 'uw-freelancer-settings', 'affiliate_listing');

function show_addesc(){
    $uw_freelancer_options = get_option('uw_freelancer_options');
    $checked = $uw_freelancer_options['show_addesc'];
    echo '<input type="checkbox" id="uw_freelancer_options[show_addesc]" name="uw_freelancer_options[show_addesc]" value="1"'; checked($checked); echo ' />';
    echo __(' Display Project Description', 'uwf');
}

add_settings_field('show_startdate', __('Project Start Date', 'uwf'), 'show_startdate', 'uw-freelancer-settings', 'affiliate_listing');

function show_startdate(){
    $uw_freelancer_options = get_option('uw_freelancer_options');
    $checked = $uw_freelancer_options['show_startdate'];
    echo '<input type="checkbox" id="uw_freelancer_options[show_startdate]" name="uw_freelancer_options[show_startdate]" value="1"'; checked($checked); echo ' />';
    echo __(' Display Project Posted Date', 'uwf');
}

add_settings_field('show_enddate', __('Project End Date', 'uwf'), 'show_enddate', 'uw-freelancer-settings', 'affiliate_listing');

function show_enddate(){
    $uw_freelancer_options = get_option('uw_freelancer_options');
    $checked = $uw_freelancer_options['show_enddate'];
    echo '<input type="checkbox" id="uw_freelancer_options[show_enddate]" name="uw_freelancer_options[show_enddate]" value="1"'; checked($checked); echo ' />';
    echo __(' Display Project Bidding End Date', 'uwf');
}

add_settings_field('show_daysleft', __('Days Left for Bidding', 'uwf'), 'show_daysleft', 'uw-freelancer-settings', 'affiliate_listing');

function show_daysleft(){
    $uw_freelancer_options = get_option('uw_freelancer_options');
    $checked = $uw_freelancer_options['show_daysleft'];
    echo '<input type="checkbox" id="uw_freelancer_options[show_daysleft]" name="uw_freelancer_options[show_daysleft]" value="1"'; checked($checked); echo ' />';
    echo __(' Display the number of days left for bidding', 'uwf');
}

add_settings_field('show_bidcount', __('Bid Count', 'uwf'), 'show_bidcount', 'uw-freelancer-settings', 'affiliate_listing');

function show_bidcount(){
    $uw_freelancer_options = get_option('uw_freelancer_options');
    $checked = $uw_freelancer_options['show_bidcount'];
    echo '<input type="checkbox" id="uw_freelancer_options[show_bidcount]" name="uw_freelancer_options[show_bidcount]" value="1"'; checked($checked); echo ' />';
    echo __(' Display Current number of bids for the project', 'uwf');
}

add_settings_field('show_bidavg', __('Average Bid Value', 'uwf'), 'show_bidavg', 'uw-freelancer-settings', 'affiliate_listing');

function show_bidavg(){
    $uw_freelancer_options = get_option('uw_freelancer_options');
    $checked = $uw_freelancer_options['show_bidavg'];
    echo '<input type="checkbox" id="uw_freelancer_options[show_bidavg]" name="uw_freelancer_options[show_bidavg]" value="1"'; checked($checked); echo ' />';
    echo __(' Display Bid value average', 'uwf');
}

add_settings_field('show_budget', __('Project Budget', 'uwf'), 'show_budget', 'uw-freelancer-settings', 'affiliate_listing');

function show_budget(){
    $uw_freelancer_options = get_option('uw_freelancer_options');
    $checked = $uw_freelancer_options['show_budget'];
    echo '<input type="checkbox" id="uw_freelancer_options[show_budget]" name="uw_freelancer_options[show_budget]" value="1"'; checked($checked); echo ' />';
    echo __(' Display Project Budget', 'uwf') . '<br /><br />';
}

do_action('uwf-affiliate-settings');
?>
