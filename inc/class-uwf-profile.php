<?php
class UW_Freelancer_Profile extends WP_Widget{
    
    public function __construct() {
        parent::__construct(
                'uw-freelancer-profile',
                __( 'UW Freelancer Profile', 'uwf' ),
                array(
                        'classname' => 'uw-freelancer',
                        'description' => __( 'Freelancer.com profile information display widget', 'uwf' )
                )
        );
          
        global $uw_freelancer;
        add_action('wp_enqueue_scripts', array($uw_freelancer, 'enqueue_scripts'));
    }

    public function widget( $args, $instance ) {
        extract( $args, EXTR_SKIP );
        echo $before_widget;                
        include( plugin_dir_path( __FILE__ ) . '../views/profile-front.php' );
        echo $after_widget;
    }

    public function form( $instance ) {
        include( plugin_dir_path(__FILE__) . '../views/profile-back.php' );
    }
}
?>
