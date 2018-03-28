<?php
/*=========================================================================
|| FILE: _custom.php
===========================================================================
|| Create widget element
===========================================================================
||  Item template:
    class frontbox_widget extends WP_Widget {
    
        // Init
        function __construct() {
            parent::__construct(
                'frontbox_widget', // Base ID of your widget
                __('Custom widget', 'news_widget_domain'), // Widget name will appear in UI
                array( 'description' => __( 'Custom widget description', 'news_widget_domain' ), ) // Widget description
            );
        }
    
        // Creating widget front-end
        public function widget( $args, $instance ) { 
            // Variables saved in widget
            $count = $instance[ 'count' ];
            // begin widget tag
            echo $args['before_widget'];
            // This is where you run the code and display the output
            echo "Custom widget tag";
            // end widget tag
            echo $args['after_widget'];
        }
                
        // Widget Backend 
        public function form( $instance ) {
            // Set default input variables
            if ( isset( $instance[ 'title' ] ) ) {
                $title = $instance[ 'title' ];
            } else {
            $title = __( 'Title', 'news_widget_domain' );
            }
            // Widget admin form inputs
            ?>
                <p>
                    <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
                    <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
                </p>
            <?php 
        }
            
        // Updating widget replacing old instances with new
        public function update( $new_instance, $old_instance ) {
            $instance = array();
            // Rewrite variables
            $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
            return $instance;
        }
    }

    register_widget( 'frontbox_widget' );
==========================================================================*/
?>