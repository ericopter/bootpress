<?php
/**
 * The template used for displaying page content in page.php
 *
 */
?>
<!-- content-page.php -->
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php 
	// get the page title if appropriate
	echotheme_get_title(); 
	?>

	<div class="page-content">
		<?php
		if ($image = get_the_post_thumbnail(get_the_ID(), 'medium', array('class' => 'img-polaroid'))) :
			// get the image link url
			$image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full');
		?>
		<div class="post-thumbnail image-frame pull-right">
			<a href="<?php echo $image_url[0]; ?>">
				<?php echo $image; ?>
			</a>
		</div> <!-- end .post-thumbnail -->
		<?php
		endif;
		?>
		<?php 
		the_content(); 
		wp_link_pages(array(
			'before' => '<div class="page-link"><span>' . __( 'Pages:', 'echotheme' ) . '</span>', 
			'after' => '</div>'
		)); 
		?>
	</div><!-- .entry-content -->
	
	<footer class="entry-meta">
		<?php 
		edit_post_link( __( 'Edit', 'echotheme' ), '<span class="edit-link">', '</span>' ); 
		?>
	</footer><!-- .entry-meta -->
</article><!-- #post-<?php the_ID(); ?> -->
