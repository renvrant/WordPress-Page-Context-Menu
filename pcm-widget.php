<?php 
class PCM_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			PCM_Settings::$option_name, // Base ID
			__('Page Context Menu'), // Name
			array( 'description' => __( 'Use this widget to display an automatically generated menu of parent and child pages' ), ) // Args
		);
	}

	public function widget( $args, $instance ) {
	
     	echo $args['before_widget'];
     	if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
		}

		PCM_Main::show_nav();

		echo $args['after_widget'];
	}

	public function form( $instance ) {
		$instance['title'] = (isset($instance['title'])) ? $instance['title'] : ''; ?>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> <br>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>">
		<?php 
	}

	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : $old_instance['title'];
	
		return $instance;
	}

} 