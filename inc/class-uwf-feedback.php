<?php
class UW_Freelancer_Feedback extends WP_Widget{
    
    public function __construct() {
        parent::__construct(
                'uw-freelancer-feedback-r',
                __( 'UW Freelancer Feedback', 'uwf' ),
                array(
                        'classname' => 'uw-freelancer',
                        'description' => __( 'Show a list of recent feedbacks for projects at freelancer.com.', 'uwf' )
                )
        );
        
        global $uw_freelancer;
        add_action('wp_enqueue_scripts', array($uw_freelancer, 'enqueue_scripts'));        
    }

    public function widget( $args, $instance ) {
        extract( $args, EXTR_SKIP );
        echo $before_widget;           
        include( plugin_dir_path( __FILE__ ) . '../views/feedback-front.php' );
        echo $after_widget;
    }

    public function form( $instance ) {
        include( plugin_dir_path(__FILE__) . '../views/feedback-back.php' );
    }
}

?>
