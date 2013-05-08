<?php
/**
 * Shortcut to get post custom field
 * @param string $name requested custom field
 * @return string $value
 */
function get_custom_value($name = null)
{
	if ($name == null) {
		return null;
	}

	$val = get_post_custom_values($name);
	return $val[0];
}

/**
 * Shortcut to get meta box value
 * @param string $name requested custom field
 * @return string $value
 */
function get_meta_box_value($name) {
	global $wp_query, $post;
	$value = get_post_meta($post->ID, $name, true);
	return $value;
}

function echotheme_posted_on() {
	printf(__('<span class="sep">Posted on </span><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s" pubdate>%4$s</time></a><span class="by-author"> <span class="sep"> by </span> <span class="author vcard"><a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s</a></span></span>', 'twentyeleven'),
		esc_url(get_permalink()),
		esc_attr(get_the_time()),
		esc_attr(get_the_date('c')),
		esc_html(get_the_date()),
		esc_url(get_author_posts_url(get_the_author_meta('ID'))),
		esc_attr(sprintf(__('View all posts by %s', 'twentyeleven'), get_the_author())),
		get_the_author()
	);
}

function echotheme_excerpt_length($length) {
	return 85;
}
add_filter('excerpt_length', 'echotheme_excerpt_length');

/**
 * Returns a "Continue Reading" link for excerpts
 */
function echotheme_continue_reading_link() {
	return ' <a href="'. esc_url(get_permalink()) . '">' . __('Continue reading <span class="meta-nav">&rarr;</span>', 'echotheme') . '</a>';
}

/**
 * Replaces Automatically generated "more" links with our custom one
 */
function echotheme_auto_excerpt_more($more) {
	return '&hellip; <br />' . echotheme_continue_reading_link();
}
add_filter('excerpt_more', 'echotheme_auto_excerpt_more');

/**
 * Replaces Automatically generated "more" links with our custom one
 */
function echotheme_auto_content_more($more) {
	return echotheme_continue_reading_link();
}
add_filter('the_content_more_link', 'echotheme_auto_content_more');

/**
 * Adds a pretty "Continue Reading" link to custom post excerpts.
 */
function echotheme_custom_excerpt_more($output) {
	if (has_excerpt() && ! is_attachment()) {
		$output .= echotheme_continue_reading_link();
	}
	return $output;
}
add_filter('get_the_excerpt', 'echotheme_custom_excerpt_more');


/**
 * Remove image height property to allow image to scale at original aspect ratio responsively
 */
function remove_thumbnail_height($html) {
    $html = preg_replace('/height=\"\d*\"\s/', "", $html);
    return $html;
}

/**
 * Replaces image width value based on theme width option
 */
function set_isotope_image_width($html) {
	
	$width = 960 == of_get_option('site-width') ? 218 : 202;
	
	// remove the "height" attribute to prevent image distorting
	$html = remove_thumbnail_height($html);
	
    $html = preg_replace('/width=\"\d*\"\s/', "width=\"$width\" ", $html);

    return $html;
}

/**
 * Display navigation to next/previous pages when applicable
 */
function echotheme_content_nav($nav_id = null, $query = null) {
	
	if ($query === null) {
		global $wp_query;
		$query = $wp_query;
	} 

	if ($query->max_num_pages > 1) : 
?>
<nav id="<?php echo $nav_id ?>">
	<div class="nav-previous content-nav">
		<?php previous_posts_link(__('<span class="meta-nav">&larr;</span> Previous Page', 'echotheme')); ?>
		&nbsp;
	</div>
	<div class="nav-next content-nav">
		<?php next_posts_link(__('Next Page<span class="meta-nav">&rarr;</span>', 'echotheme')); ?>
	</div>
	
	<div class="clear"></div>
</nav><!-- #category-navigation -->
<?php
	endif;
}

function echotheme_post_nav() {
?>
<nav id="nav-single">
	<h3 class="assistive-text"><?php _e( 'Post navigation', 'echotheme' ); ?></h3>
	<span class="nav-previous"><?php previous_post_link( '%link', __( '<span class="meta-nav">&larr;</span> Previous', 'twentyeleven' ) ); ?></span>
	<span class="nav-next"><?php next_post_link( '%link', __( 'Next <span class="meta-nav">&rarr;</span>', 'echotheme' ) ); ?></span>
</nav><!-- #nav-single -->
<?php
}

function echotheme_comment($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
	switch ($comment->comment_type) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e('Pingback:', 'echotheme'); ?> <?php comment_author_link(); ?><?php edit_comment_link(__('Edit', 'echotheme'), '<span class="edit-link">', '</span>'); ?></p>
	<?php
			break;
		default :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<footer class="comment-meta">
				<div class="comment-author vcard">
					<?php
						$avatar_size = 89;

						echo get_avatar($comment, $avatar_size);

						/* translators: 1: comment author, 2: date and time */
						printf(__('%1$s on %2$s <span class="says">said:</span>', 'echotheme'),
							sprintf('<span class="fn">%s</span>', get_comment_author_link()),
							sprintf('<a href="%1$s"><time pubdate datetime="%2$s">%3$s</time></a>',
								esc_url(get_comment_link($comment->comment_ID)),
								get_comment_time('c'),
								/* translators: 1: date, 2: time */
								sprintf(__('%1$s at %2$s', 'echotheme'), get_comment_date(), get_comment_time())
							)
						);
					?>

					<?php edit_comment_link(__('Edit', 'echotheme'), '<span class="edit-link">', '</span>'); ?>
				</div><!-- .comment-author .vcard -->

				<?php if ($comment->comment_approved == '0') : ?>
					<em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.', 'echotheme'); ?></em>
					<br />
				<?php endif; ?>

			</footer>

			<div class="comment-content"><?php comment_text(); ?></div>

			<div class="reply">
				<?php comment_reply_link(array_merge($args, array('reply_text' => __('Reply <span>&darr;</span>', 'echotheme'), 'depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
			</div><!-- .reply -->
		</article><!-- #comment-## -->
	</li>
	<?php
			break;
	endswitch;
}

/**
 * Filter to alter the tag cloud font sizes
 */
function echotheme_tag_cloud_args($args) {
	// $args['largest'] = 19; //largest tag
	// $args['smallest'] = 11; //smallest tag
	$args['unit'] = 'px'; //tag font unit
	return $args;
}
add_filter( 'widget_tag_cloud_args', 'echotheme_tag_cloud_args' );
?>