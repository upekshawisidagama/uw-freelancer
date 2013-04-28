<?php
class UW_Freelancer_Setttings{    
    private $uw_freelancer_options;    
    private $freelancer_hook_suffix;

    function __construct() {
        add_action('after_setup_theme', array($this, 'options_init') );         
        add_action('admin_menu', array($this, 'menu_options'));        
        add_action('admin_init', array($this, 'register_settings'));        
        add_action('wp_head', array($this, 'print_freelancer_styles'));        
        add_action('admin_print_scripts', array($this, 'freelancer_admin_scripts'));
    }
    
    function register_settings(){
        register_setting( 'uw_freelancer_options', 'uw_freelancer_options', array($this, 'uw_freelancer_options_validate'));
    }

    function get_default_options() {
         $options = array(
            'show_freelancer_logo' => false,
            'user_id' => 'upekshawisidaga',            
            'show_userphoto' => true,
            'show_username' => true,
            'show_company' => true,
            'show_city' => true,
            'show_country' => true,
            'show_regdate' => true,
            'show_rating' => true,
            'show_count' => true,
            'show_jobs' => false, 
             
            'feedback_count' => 4,
            'feedback_type' => 'S', 
            'show_rating' => true, 
            'show_value' => true,
            'show_date' => true,
            'show_provider' => true,
            'show_provider_link' => true,
            'show_project' => true,
            'show_project_link' => true,
             
            'keyword' => 'wordpress',
            'ad_count' => 4,
            'owner' => '',
            'show_onlyfeatured' => true,
            'order' => 'bid_count',
            'order_dir' => 'asc',             
             
            'show_adname' => true,
            'show_addesc' => true,
            'show_startdate' => true,
            'show_enddate' => true,
            'show_daysleft' => true,
            'show_hoursleft' => true,
            'show_bidcount' => true,
            'show_bidavg' => true,
            'show_budget' => true, 
             
            'transient_timeout' => 24, 
            'clear_transients' => false,
             
            'api_query' => 'http://api.freelancer.com/User/Properties.xml?id=upekshawisidaga' 
             
         );
         return $options;
    }   
    
    function options_init() {
         $this->uw_freelancer_options = get_option( 'uw_freelancer_options' );
         if ( false === $this->uw_freelancer_options ) {
              $this->uw_freelancer_options = $this->get_default_options();
         }
         update_option( 'uw_freelancer_options', $this->uw_freelancer_options );
    }
    
    function get_settings_page_tabs() {
         $tabs = array(
            'profile' => __('Profile', 'uwf'),
            'feedback' => __('Feedback', 'uwf'),
            'affiliate' => __('Affiliate', 'uwf'),
            'settings' => __('Settings' , 'uwf')
         );
         return $tabs;
    }    
        
    function menu_options() {
                
        $this->freelancer_hook_suffix = add_menu_page(
                __('Freelancer Dashboard', 'uwf'), 
                __('Freelancer', 'uwf'), 
                'manage_options', 
                'uw-freelancer-settings', 
                array($this, 'admin_options_page'),
                UWF_URL .'images/uw-freelancer-icon.png');
                
        add_submenu_page(
                'uw-freelancer-settings', 
                __('API Console', 'uwf'), 
                __('API Console', 'uwf'), 
                'manage_options', 
                'uw-freelancer-api-console', 
                array($this, 'freelancer_api_console'));
        
        global $submenu;
        if ( isset( $submenu['uw-freelancer-settings'] ) )
                $submenu['uw-freelancer-settings'][0][0] = __('Dashboard', 'uwf');    
        
        do_action('uwf-menu-init');
    }  
    
    function freelancer_api_console(){

        echo '<div class="wrap">';           
        
            echo '<div id="icon-themes" class="icon32"><br /></div>';
            echo '<h2>' . __('Freelancer.com API Console', 'uwf') . '</h2>';         
            settings_errors(); 
            
        echo '<form action="options.php" method="post">';
            
            add_settings_section(
                    'freelancer_api_console', 
                    __('Query Freelancer.com API', 'uwf'), 
                    'freelancer_api_console', 
                    'uw-freelancer-api-console');

            function freelancer_api_console(){
                echo __('Freelancer.com API Console', 'uwf');
            }

            add_settings_field(
                    'query_string', 
                    __('API Query String', 'uwf'), 
                    'query_string', 
                    'uw-freelancer-api-console', 
                    'freelancer_api_console');

            function query_string(){
                $uw_freelancer_options = get_option('uw_freelancer_options');
                echo '<input style="width:800px; max-width:100%;" type="text" id="uw_freelancer_options[api_query]" name="uw_freelancer_options[api_query]" value="' . $uw_freelancer_options['api_query'] . '"><br />';
                echo '&nbsp' . __('Enter the query string for freelancer.com api call', 'uwf');
            }            
            
            settings_fields('uw_freelancer_options');
            do_settings_sections('uw-freelancer-api-console');                         
            echo '<input name="uw_freelancer_options[submit-api]" type="submit" class="button-primary" value="' . esc_attr__('Query API', 'uwf') . '" />';
        echo '</form>'; 
        echo '<form>';
        echo '<h3>' . __('API Query Response', 'uwf') . '</h3>'; 

    $api_query = get_transient('api_query');
    echo '<textarea style="border:none; width:100%; height:600px;"">';
    echo '<pre>';
    var_dump($api_query);
    echo '</pre>';
    echo '</textarea>';
    echo '</form>';    
    echo '</div>';
    
    }
    
    function admin_options_page() { 
        echo '<div class="wrap">';
            $this->admin_options_page_tabs(); 
            settings_errors();
        echo '<form action="options.php" method="post">';
            global $pagenow;
            if ( 'admin.php' == $pagenow && isset( $_GET['page'] ) && 'uw-freelancer-settings' == $_GET['page'] ) :
                 if ( isset ( $_GET['tab'] ) ) :
                      $tab = $_GET['tab'];
                 else:
                      $tab = 'profile';
                 endif;
                 switch ( $tab ) :
                      case 'profile' :
                           require( plugin_dir_path(__FILE__) . '/templates/options-register-profile.php' );
                           break;
                      case 'feedback' :
                           require( plugin_dir_path(__FILE__) . '/templates/options-register-feedback.php' );
                           break;
                      case 'affiliate' :
                           require( plugin_dir_path(__FILE__) . '/templates/options-register-affiliate.php' );
                           break;
                      case 'settings' :
                           require( plugin_dir_path(__FILE__) . '/templates/options-register-settings.php' );
                           break;                       
                 endswitch;
            endif;                

            settings_fields('uw_freelancer_options');
            do_settings_sections('uw-freelancer-settings');
            $tab = ( isset( $_GET['tab'] ) ? $_GET['tab'] : 'profile' );
            echo '<input name="uw_freelancer_options[submit-' . $tab . ']" type="submit" class="button-primary" value="' . esc_attr__('Save Settings', 'uwf') .'" />&nbsp';  
            echo '<input name="uw_freelancer_options[reset-' . $tab . ']" type="submit" class="button-secondary" value="' . esc_attr__('Reset Defaults', 'uwf') . '" />';
        echo '</form>';           
        echo '</div>';
    }    
    
    function admin_options_page_tabs( $current = 'profile' ) {
         if ( isset ( $_GET['tab'] ) ) :
              $current = $_GET['tab'];
         else:
              $current = 'profile';
         endif;
         $tabs = $this->get_settings_page_tabs();
         $links = array();
         foreach( $tabs as $tab => $name ) :
              if ( $tab == $current ) :
                   $links[] = "<a class='nav-tab nav-tab-active' href=?page=uw-freelancer-settings&tab=" . $tab . ">$name</a>";
              else :
                   $links[] = "<a class='nav-tab' href=?page=uw-freelancer-settings&tab=" . $tab . ">$name</a>";
              endif;
         endforeach;
         echo '<div id="icon-themes" class="icon32"><br /></div>';
         echo '<h2 class="nav-tab-wrapper">';
         foreach ( $links as $link )
              echo $link;
         echo '</h2>';
    } 
    
    function uw_freelancer_options_validate($input){
        
    global $uw_freelancer;
    
    $uw_freelancer_options = get_option( 'uw_freelancer_options' );
    $valid_input = $uw_freelancer_options;        

    $submit_profile = ( ! empty( $input['submit-profile']) ? true : false );
    $reset_profile = ( ! empty($input['reset-profile']) ? true : false );
    $submit_feedback = ( ! empty($input['submit-feedback']) ? true : false );
    $reset_feedback = ( ! empty($input['reset-feedback']) ? true : false ); 
    $submit_affiliate = ( ! empty($input['submit-affiliate']) ? true : false );
    $reset_affiliate = ( ! empty($input['reset-affiliate']) ? true : false );
    $submit_settings = ( ! empty($input['submit-settings']) ? true : false );
    $reset_settings = ( ! empty($input['reset-settings']) ? true : false );  
    
    $api_query = ( ! empty($input['submit-api']) ? true : false );  
     
    if ( $submit_profile ) {

        $valid_input['user_id'] = ( ! empty($input['user_id']) ? sanitize_text_field($input['user_id']) : 'upekshawisidaga' );
        $valid_input['show_freelancer_logo'] = ( ! empty($input['show_freelancer_logo']) ? true : false );        
        $valid_input['show_userphoto'] = ( ! empty($input['show_userphoto']) ? true : false );
        $valid_input['show_username'] = ( ! empty($input['show_username']) ? true : false );
        $valid_input['show_company'] = ( ! empty($input['show_company']) ? true : false );
        $valid_input['show_city'] = ( ! empty($input['show_city']) ? true : false );        
        $valid_input['show_country'] = ( ! empty($input['show_country']) ? true : false );
        $valid_input['show_regdate'] = ( ! empty($input['show_regdate']) ? true : false );
        $valid_input['show_rating'] = ( ! empty($input['show_rating']) ? true : false );
        $valid_input['show_count'] = ( ! empty($input['show_count']) ? true : false );
        $valid_input['show_jobs'] = ( ! empty($input['show_jobs']) ? true : false );
        
        global $uw_freelancer;

        $user_transient = $uw_freelancer->freelancer_transient(
                'delete',
                'user',
                $uw_freelancer_options['user_id']
        );         
        
        add_settings_error('uw-freelancer', 'updated', 'UW Freelancer Profile Settings Saved', 'updated');
        
    } else if ($reset_profile) {
        
        $default_options = $this->get_default_options();
        
        $valid_input['user_id'] = $default_options['user_id'];
        $valid_input['show_freelancer_logo'] = $default_options['show_freelancer_logo'];
        $valid_input['show_userphoto'] = $default_options['show_userphoto'];
        $valid_input['show_username'] = $default_options['show_username'];
        $valid_input['show_company'] = $default_options['show_company'];
        $valid_input['show_city'] = $default_options['show_city'];
        $valid_input['show_country'] = $default_options['show_country'];
        $valid_input['show_regdate'] = $default_options['show_regdate'];
        $valid_input['show_rating'] = $default_options['show_rating'];
        $valid_input['show_count'] = $default_options['show_count'];
        $valid_input['show_jobs'] = $default_options['show_jobs'];  
        
        global $uw_freelancer;

        $user_transient = $uw_freelancer->freelancer_transient(
                'delete',
                'user',
                $uw_freelancer_options['user_id']
        );         
        
        add_settings_error('uw-freelancer', 'updated', 'UW Freelancer Profile Settings changed to Defaults', 'updated');
        
    } else if($submit_feedback) {
        
        $valid_input['feedback_count'] = ( ! empty($input['feedback_count']) ? intval(sanitize_text_field($input['feedback_count'])) : 4 );
        $valid_input['feedback_type'] = ( ! empty($input['feedback_type']) && ($input['feedback_type'] == 'S') ? 'S' : 'B' ); 
        $valid_input['show_rating'] = ( ! empty($input['show_rating']) ? true : false ); 
        $valid_input['show_value'] = ( ! empty($input['show_value']) ? true : false );
        $valid_input['show_date'] = ( ! empty($input['show_date']) ? true : false );
        $valid_input['show_provider'] = ( ! empty($input['show_provider']) ? true : false ); 
        $valid_input['show_provider_link'] = ( ! empty($input['show_provider_link']) ? true : false ); 
        $valid_input['show_project'] = ( ! empty($input['show_project']) ? true : false );        
        $valid_input['show_project_link'] = ( ! empty($input['show_project_link']) ? true : false );        
        
        $feedback_transient = $uw_freelancer->freelancer_transient(
                'delete',
                'feedback',
                $uw_freelancer_options['user_id']
        );           
        
        add_settings_error('uw-freelancer', 'updated', 'UW Freelancer Feedback Settings Saved', 'updated');
        
    } else if($reset_feedback){
        
        $default_options = $this->get_default_options();
        
        $valid_input['feedback_count'] = $default_options['feedback_count'];
        $valid_input['feedback_type'] = $default_options['feedback_type'];
        $valid_input['show_rating'] = $default_options['show_rating'];
        $valid_input['show_value'] = $default_options['show_value'];
        $valid_input['show_date'] = $default_options['show_date'];
        $valid_input['show_provider'] = $default_options['show_provider'];
        $valid_input['show_provider_link'] = $default_options['show_provider_link'];
        $valid_input['show_project'] = $default_options['show_project'];
        $valid_input['show_project_link'] = $default_options['show_project_link'];
        
        $feedback_transient = $uw_freelancer->freelancer_transient(
                'delete',
                'feedback',
                $uw_freelancer_options['user_id']
        );            
        
        add_settings_error('uw-freelancer', 'updated', 'UW Freelancer Feedback Settings changed to Defaults', 'updated');
        
    } else if($submit_affiliate) {
        
        $valid_input['keyword'] = ( ! empty($input['keyword']) ? sanitize_text_field($input['keyword']) : 'wordpress' );
        $valid_input['ad_count'] = ( ! empty($input['ad_count']) ? intval(sanitize_text_field($input['ad_count'])) : 4 );
        
        $valid_input['owner'] = ( ! empty($input['owner']) ? sanitize_text_field($input['owner']) : '' );
        $valid_input['show_onlyfeatured'] = ( ! empty($input['show_onlyfeatured']) ? true : false );
        
        $order = ( ! empty($input['order']) ? sanitize_text_field($input['order']) : '' );
        $valid_order_types = array('id', 'submitdate', 'state', 'bid_count', 'bid_avg', 'bid_enddate', 'buyer', 'budget', 'relevance', 'rand');
        if (in_array($order, $valid_order_types)){
            $valid_input['order'] = $order;
        }
        
        $valid_input['order_dir'] = ( ! empty($input['order_dir']) && ($input['order_dir'] == 'asc') ? 'asc' : 'desc' ); 
        
        $valid_input['show_adname'] = ( ! empty($input['show_adname']) ? true : false );
        $valid_input['show_addesc'] = ( ! empty($input['show_addesc']) ? true : false );
        $valid_input['show_startdate'] = ( ! empty($input['show_startdate']) ? true : false );
        $valid_input['show_enddate'] = ( ! empty($input['show_enddate']) ? true : false );
        $valid_input['show_daysleft'] = ( ! empty($input['show_daysleft']) ? true : false );
        $valid_input['show_bidcount'] = ( ! empty($input['show_bidcount']) ? true : false );
        $valid_input['show_bidavg'] = ( ! empty($input['show_bidavg']) ? true : false );
        $valid_input['show_budget'] = ( ! empty($input['show_budget']) ? true : false );
        
        add_settings_error('uw-freelancer', 'updated', 'UW Freelancer Affiliate Settings Saved', 'updated');
        
    } else if($reset_affiliate){
        
        $default_options = $this->get_default_options();
        
        $valid_input['keyword'] = $default_options['keyword'];
        $valid_input['ad_count'] = $default_options['ad_count'];
        
        $valid_input['owner'] = $default_options['owner'];
        $valid_input['show_onlyfeatured'] = $default_options['show_onlyfeatured'];
        $valid_input['order'] = $default_options['order'];
        $valid_input['order_dir'] = $default_options['order_dir'];
        
        $valid_input['show_adname'] = $default_options['show_adname'];
        $valid_input['show_addesc'] = $default_options['show_addesc'];
        $valid_input['show_startdate'] = $default_options['show_startdate'];
        $valid_input['show_enddate'] = $default_options['show_enddate'];
        $valid_input['show_daysleft'] = $default_options['show_daysleft'];
        $valid_input['show_bidcount'] = $default_options['show_bidcount'];
        $valid_input['show_bidavg'] = $default_options['show_bidavg'];
        $valid_input['show_budget'] = $default_options['show_budget'];
        
        add_settings_error('uw-freelancer', 'updated', 'UW Freelancer Affiliate Settings changed to Defaults', 'updated');
        
    } else if($submit_settings) {
        
        $valid_input['transient_timeout'] = ( ! empty($input['transient_timeout']) ? sanitize_text_field($input['transient_timeout']) : 24 );
        
        if(isset($input['clear_transients'])){
            
            global $uw_freelancer;

            $user_transient = $uw_freelancer->freelancer_transient(
                    'delete',
                    'user',
                    $uw_freelancer_options['user_id']
            ); 
            
            if($user_transient == 'deleted'){
                add_settings_error('freelancer-transients', 'clear transients', 'User Transient Deleted');
            } else {
                add_settings_error('freelancer-transients', 'clear transients', 'User Transient Deletion Failed !');
            }            
            
            $feedback_transient = $uw_freelancer->freelancer_transient(
                    'delete',
                    'feedback',
                    $uw_freelancer_options['user_id']
            );     

            if($feedback_transient == 'deleted'){
                add_settings_error('freelancer-transients', 'clear transients', 'Feedback Transient Deleted');
            } else {
                add_settings_error('freelancer-transients', 'clear transients', 'Feedback Transient Deletion Failed !');
            }               
        }
        
        add_settings_error('uw-freelancer', 'updated', 'UW Freelancer Transients Settings Saved', 'updated');
    } else if($reset_settings){ 
        
        $default_options = $this->get_default_options();
        
        $valid_input['api_query'] = $default_options['api_query'];   
        
    } else if($api_query){
        $valid_input['api_query'] = ( ! empty($input['api_query']) ? sanitize_url($input['api_query']) : $valid_input['keyword'] );
        
        $api_query_response = wp_remote_get($valid_input['api_query']);
        
        $api_response = 'UW Freelancer API Queried Successfully<br />';
        
        set_transient('api_query', $api_query_response, 60*60);
        
        add_settings_error('uw-freelancer', 'updated', $api_response, 'updated'); 
        add_settings_error('uw-freelancer', 'updated', 'Query : ' . $input['api_query'], 'updated');
               
    }     
        
    $this->uw_freelancer_options = $valid_input;
    return $valid_input;
    }
    
    function print_freelancer_styles(){
        $uw_freelancer_styles = get_option('uw_freelancer_styles');
    
        $output = '<style>
            .uwf-widget{
                border-style: solid;
                border-width: ' . $uw_freelancer_styles['border_width'] . ';
                border-color: ' . $uw_freelancer_styles['border_color'] . ';
                border-radius: ' . $uw_freelancer_styles['border_radius'] . ';
                padding: ' . $uw_freelancer_styles['padding'] . ';
                margin: ' . $uw_freelancer_styles['margin'] . ';
                background-color: ' . $uw_freelancer_styles['background_color'] . ';
            }    
        </style>';
        echo apply_filters('uwf-widget-customizer', $output);      
    }
    
    function freelancer_admin_scripts(){      
        
        /**
         * Page: 'uw-freelancer-page' menu page
         * Page: 'uw-freelancer-api-console' menu page
         * 
         * Enqueue uw-freelancer-admin styles.
         * Page icon and a background image.
         */
        if(isset( $_GET['page'] ) 
           && ( 'uw-freelancer-settings' == $_GET['page']
                 || 'uw-freelancer-api-console' == $_GET['page'] ))
        {
            wp_enqueue_style('uw-freelancer-admin', UWF_URL . 'css/uw-freelancer-admin.css');
            
            /**
             * Page: 'uw-freelancer-page' menu page
             * Tab: Settings Tab
             * 
             * Enqueue jQuery-ui Tabs scripts.
             */
            if(isset( $_GET['tab'] ) 
               && 'settings' == $_GET['tab'])
            {
            wp_enqueue_script('jquery-ui-tabs');
            wp_enqueue_script('freelancer-settings', UWF_URL . 'js/uw-freelancer-settings.js', 'jquery-ui-tabs', '1.0', true);
            wp_enqueue_style('jquery-style', UWF_URL . 'css/smoothness/jquery-ui-1.10.0.custom.css');
            }
        }
    }   
}
?>