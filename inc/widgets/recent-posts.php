<?php
/**
 * Adds Echotheme_Recent_Posts widget.
 * title, number, post_type
 */
class Echotheme_Recent_Posts extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
	 		'echotheme_recent_posts', // Base ID
			'Echotheme Recent Posts', // Name
			array( 'description' => __( 'Display recent posts of any post type', 'echotheme' ), ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		$number = $instance['number'] > 0 ? (int) $instance['number'] : 10;
		
		if ($number < 1) {
			$number = 1;
		} else if ($number > 10) {
			$number = 10;
		}
		
		$display = isset($instance['display']) ? $instance['display'] : 'text';
		
		$post_type = $instance['post_type'];
		
		$args = array(
			'post_type' => $post_type,
			'posts_per_page' => -1,
			'post_status' => 'publish'
		);
		
		$query = new WP_Query($args);
		
		if ($query->have_posts()) : 
			echo $before_widget;
			
			if ($title) {
				echo $before_title . $title . $after_title;
			}
			
		?>
			<ul class="echotheme-recent-posts">
			    <?php
				$count = 1;
			    while($query->have_posts()) :
				if ($count > $number) {
					break;
				}
				$query->the_post();
				$thumb = get_the_post_thumbnail($post->ID, 'thumbnail');
				
				// if no thumbnail and thats the desired display then skip this beat
				if (!$thumb && ($display == 'both' || $display == 'image')) {
					continue;
				}
				
				?>
				<li class="<?php echo $display; ?>">
					<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
						<?php 
						if ($thumb && ($display == 'both' || $display == 'image')):
							echo $thumb;
						endif;
						if ($display == 'both' || $display == 'text') :
						?>
						<span><?php the_title(); ?></span>
						<div class="clear"></div>
						<?php
						endif;
						?>
						
					</a>
					
				</li>
				<?php
				$count++;
				endwhile;
			    ?>
				<div class="clear"></div>
			</ul>
		<?php
			echo $after_widget;
		
			wp_reset_query(); 
		endif;
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['number'] = (int) $new_instance['number'];
		$instance['post_type'] = $new_instance['post_type'];
		$instance['display'] = $new_instance['display'];

		return $instance;
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		$title = isset($instance['title']) ? $instance['title'] : __('Recent Posts', 'echotheme');
		$number = $instance['number'] > 0 ? (int) $instance['number'] : 5;
		$post_type = isset($instance['post_type']) ? $instance['post_type'] : null;
		$display = isset($instance['display']) ? $instance['display'] : null;
		
		// get available post types registered
		$args = array(
			'public' => true,
			'publicly_queryable' => true,
			// 'capability_type' => 'post',
			'_builtin' => false
		);
		$post_types = get_post_types($args, 'names');
		
		$display_options = array(
			'text' => 'Text List Only',
			'both' => 'Thumbnail and Text',
			'image'=> 'Thumbnail Only'
		);
		
		
		?>
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		
		<p>
		<label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number (1-10):' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo esc_attr( $number ); ?>" />
		</p>
		
		<p><label for="<?php echo $this->get_field_id('post_type'); ?>"><?php _e('Post Type', 'echotheme'); ?></label>
		<select class="widefat" id="<?php echo $this->get_field_id('post_type'); ?>" name="<?php echo $this->get_field_name('post_type'); ?>">
			<option value=""><?php _e('Any', 'echotheme'); ?></option>
			<?php foreach ($post_types as $name) {				
				echo '<option value="'.$name.'" '.selected($name, $post_type).'>'.ucfirst($name).'</option>';
			} ?>
		</select></p>
		
		<p><label for="<?php echo $this->get_field_id('display'); ?>"><?php _e('Display', 'echotheme'); ?></label>
		<select class="widefat" id="<?php echo $this->get_field_id('display'); ?>" name="<?php echo $this->get_field_name('display'); ?>">
			<?php foreach ($display_options as $key => $value) {				
				echo '<option value="'.$key.'" '.selected($key, $display).'>'.ucfirst($value).'</option>';
			} ?>
		</select></p>
		<?php 
	}

} // class Foo_Widget
// register Foo_Widget widget
add_action( 'widgets_init', create_function( '', 'register_widget( "echotheme_recent_posts" );' ) );
?>