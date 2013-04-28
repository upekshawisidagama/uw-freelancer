<?php
class UW_Freelancer_Affiliate extends WP_Widget{
    
    public function __construct() {
        parent::__construct(
                'uw-freelancer-affiliate',
                __( 'UW Freelancer Affiliate Project Listing', 'uwf' ),
                array(
                        'classname' => 'uw-freelancer',
                        'description' => __( 'List latest projects from freelancer.com.', 'uwf' )
                )
        );        
        global $uw_freelancer;
        add_action('wp_enqueue_scripts', array($uw_freelancer, 'enqueue_scripts'));        
        add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'));
    }

    public function widget( $args, $instance ) {
        extract( $args, EXTR_SKIP );
        echo $before_widget;        
        include( plugin_dir_path( __FILE__ ) . '../views/affiliate-front.php' );
        echo $after_widget;
    }
    
    public function enqueue_scripts(){        
        wp_enqueue_script('uw-freelancer-affiliate', UWF_URL . 'js/uw-freelancer-affiliate.js', array('jquery'), '1.0', false );
        wp_localize_script('uw-freelancer-affiliate', 'uw_freelancer_obj', $this->localize_uwf());
    }
    
    public function localize_uwf(){
        $uw_freelancer_options = get_option('uw_freelancer_options');        
        return array(
            'show_adname' => $uw_freelancer_options['show_adname'],
            'show_addesc' => $uw_freelancer_options['show_addesc'],
            'show_startdate' => $uw_freelancer_options['show_startdate'],
            'show_enddate' => $uw_freelancer_options['show_enddate'],
            'show_daysleft' => $uw_freelancer_options['show_daysleft'],
            'show_bidcount' => $uw_freelancer_options['show_bidcount'],
            'show_bidavg' => $uw_freelancer_options['show_bidavg'],
            'show_budget' => $uw_freelancer_options['show_budget']
        );
    }
    
    public function form( $instance ) {       
        include( plugin_dir_path(__FILE__) . '../views/affiliate-back.php' );
    }
}
?>