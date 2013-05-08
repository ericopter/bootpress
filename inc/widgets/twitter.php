<?php
/**
 * Adds Echotheme_Twitter widget.
 * title, number, post_type
 */
/**
* 
*/
class Echotheme_Twitter extends WP_Widget {
 
	function echotheme_Twitter() {
	
		global $echotheme_theme_name, $echotheme_version, $options;
		
        $widget_ops = array('classname' => 'widget_echotheme_twitter', 'description' => 'Display latest tweets.');
		$this->WP_Widget('echotheme_twitter', $echotheme_theme_name.' '.__('Twitter', 'echotheme'), $widget_ops);
    
    }
 
    function widget($args, $instance) {
    
    	global $echotheme_theme_name, $echotheme_version, $options;
       
        extract( $args );
        
        $title	= empty($instance['title']) ? 'Latest Tweets' : $instance['title'];
        $user	= $instance['user'];        
        $label	= empty($instance['twitter_label']) ? 'Follow' : $instance['twitter_label'];
        if ( !$nr = (int) $instance['twitter_count'] )
			$nr = 5;
		else if ( $nr < 1 )
			$nr = 1;
		else if ( $nr > 15 )
			$nr = 15;
 
        ?>
			<?php echo $before_widget; ?>
				<?php echo $before_title . $title . $after_title; ?>
								
				<div id="twitterBox" class="clearfix"></div>

    			<script type="text/javascript">
 					//<![CDATA[
					jQuery(document).ready(function() {
						jQuery("#twitterBox").getTwitter({
							userName: '<?php echo $user; ?>',
							numTweets: '<?php echo $nr; ?>',
							loaderText: "Loading tweets...",
							slideIn: false,
							showHeading: false,
							headingText: "",
							showProfileLink: false
						});
					});
					//]]>    			
    			</script>				
				
				<?php if($label) : ?>
                <p class="twitterLink"><a class="action" href="http://twitter.com/<?php echo $user; ?>"><span><?php echo $label; ?></span></a></p>
                <?php endif; ?>
 
			<?php echo $after_widget; ?>
        <?php
    }

    function update($new_instance, $old_instance) {  
    
    	$instance['title'] = strip_tags($new_instance['title']);
    	$instance['user'] = strip_tags($new_instance['user']);    
    	$instance['twitter_label'] = strip_tags($new_instance['twitter_label']);
    	$instance['twitter_count'] = (int) $new_instance['twitter_count'];
                  
        return $new_instance;
    }
 
    function form($instance) {
    
    	global $echotheme_theme_name, $echotheme_version, $options;
        
		$instance	= wp_parse_args( (array) $instance, array( 'title' => '', 'user' => '', 'twitter_link' => '', 'twitter_label' => '', 'twitter_count' => '') );
		$title		= empty($instance['title']) ? 'Latest Tweets' : $instance['title'];
		$user		= $instance['user'];		
		$label		= $instance['twitter_label'];
		if (!$count = (int) $instance['twitter_count']) $count = 5;
?>

		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'echotheme'); ?>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
			</label>
		</p>		
		<p>
			<label for="<?php echo $this->get_field_id('user'); ?>"><?php _e('Username:', 'echotheme'); ?>
			<input class="widefat" id="<?php echo $this->get_field_id('user'); ?>" name="<?php echo $this->get_field_name('user'); ?>" type="text" value="<?php echo esc_attr($user); ?>" />
			</label>
		</p>		
		<p>
			<label for="<?php echo $this->get_field_id('twitter_count'); ?>"><?php _e('Number of tweets:', 'echotheme'); ?></label>
			<input id="<?php echo $this->get_field_id('twitter_count'); ?>" name="<?php echo $this->get_field_name('twitter_count'); ?>" type="text" value="<?php echo $count; ?>" size="3" /><br />
		</p>		
		<p>
			<label for="<?php echo $this->get_field_id('twitter_label'); ?>"><?php _e('Follow Link label:', 'echotheme'); ?>
			<input class="widefat" id="<?php echo $this->get_field_id('twitter_label'); ?>" name="<?php echo $this->get_field_name('twitter_label'); ?>" type="text" value="<?php echo esc_attr($label); ?>" />
			</label>
		</p>
		
<?php
	}

}
 
// register_widget('echotheme_Twitter');
add_action( 'widgets_init', create_function( '', 'register_widget( "echotheme_twitter" );' ) );