<?php
/*
Plugin Name: UW Freelancer
Plugin URI: http://bapml.com/wordpress-freelancer-plugin
Description: Display freelancer.com user information, including feedback, using widgets. ( + freelancer.com project listing widget )
Version: 0.1
Author: Upeksha Wisidagama
Author URI: http://bapml.com/wordpress-freelancer-plugin
License: GPLv3
License URI: http://www.gnu.org/licenses/gpl-3.0.txt
*/

/*  Copyright 2013  Upeksha Wisidagama  (email : upekshawisidagama@gmail.com)

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

if ( !defined('UWF_URL') )
	define( 'UWF_URL', plugin_dir_url( __FILE__ ) );
if ( !defined('UWF_PATH') )
	define( 'UWF_PATH', plugin_dir_path( __FILE__ ) );

if ( ! class_exists( 'UW_Freelancer' ) ){
    
class UW_Freelancer{
    
    private $api_url = 'http://api.freelancer.com';    
    private $settings;
    private $customizer;
    private $tracker;
    private $prefix = 'uw_freelancer';
    
    function __construct() {
        
        $this->load_language( 'uwf' );
        
        require 'inc/class-uwf-settings.php';
        $this->settings = new UW_Freelancer_Setttings();    
        
        require 'inc/class-uwf-customizer.php';
        $this->customizer = new UW_Freelancer_Customizer();                 
        
        add_action( 'widgets_init', array($this, 'register_widgets') );       
        
        add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), 
                array($this, 'plugin_action_links') );
        
    }

    function enqueue_scripts(){
        wp_enqueue_style('uw-freelancer-widget-styles', 
                plugin_dir_url(__FILE__) . 'css/uw-freelancer-widgets.css');
    }    
    
    function register_widgets(){
        
        require 'inc/class-uwf-profile.php';
        register_widget( 'UW_Freelancer_Profile' );
        
        require 'inc/class-uwf-feedback.php';
        register_widget( 'UW_Freelancer_Feedback' );   
        
        require 'inc/class-uwf-affiliate.php';
        register_widget( 'UW_Freelancer_Affiliate' );            
    }

    
    function get_user($user_id = 'upekshawisidaga'){        
        $value = $this->prefix . '_user_' . $user_id;
        
        $user = get_transient($value);
        
        if(!$user){ 
            $url = $this->api_url . '/User/Properties.json?id=' . $user_id;
            $response = wp_remote_get($url); 
            $uw_freelancer_options = get_option( 'uw_freelancer_options' );
            $transient_timeout = $uw_freelancer_options['transient_timeout']*60*60;
        
            if(is_wp_error($response)){
                return __('error occured', 'uwf');
            } else {
                $user = json_decode($response['body']);
                set_transient($value, $user, $transient_timeout);                                  
                return $user;
            }
        
        } else {
            return $user;
        }
    }    
    
    function get_feedback($user_id = 'upekshawisidaga'){        
        $value = $this->prefix . '_feedback_' . $user_id;
        
        $feedback = get_transient($value);
        
        if(!$feedback){ 
            $uw_freelancer_options = get_option( 'uw_freelancer_options' );
            $count = $uw_freelancer_options['feedback_count'];
            $type = $uw_freelancer_options['feedback_type'];
            $transient_timeout = $uw_freelancer_options['transient_timeout']*60*60;
            
            $url = $this->api_url . '/Feedback/Search.json?count=' . $count . '&type=' . $type . '&user=' . $user_id;
            $response = wp_remote_get($url); 
        
            if(is_wp_error($response)){
                return __('error occured', 'uwf');
            } else {
                $user = json_decode($response['body']);
                set_transient($value, $user, $transient_timeout);                                  
                return $user;
            }
        
        } else {
            return $feedback;
        }
    }     
    
    function freelancer_transient($method = 'get', $type = 'user', $user_id = 'upekshawisidaga'){        
        $value = $this->prefix . '_' . $type . '_' . $user_id;
        
        if($method == 'get'){
            return get_transient($value);
        } else if ($method == 'delete'){
            delete_transient($value);
            return 'deleted';
        }
    }
    
    function load_language( $domain ){
            load_plugin_textdomain(
                    $domain,
                    null,
                    dirname( plugin_basename( __FILE__ ) ) . '/languages'
            );
    }    
    
    function plugin_action_links($links){
        $dashboard = admin_url() . 'admin.php?page=uw-freelancer-settings';
        $apiconsole = admin_url() . 'admin.php?page=uw-freelancer-api-console';
    return array_merge(
       array(
                    'settings' => '<a href="' . $dashboard . '">' . __('Settings', 'uwf') . '</a>',
                    'apiconsole' => '<a href="' . $apiconsole . '">' . __('Console', 'uwf') . '</a>'
                ),
       $links
    );
    }
}

}

$uw_freelancer = new UW_Freelancer();

?>
