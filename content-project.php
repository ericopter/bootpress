<?php
/**
 * content-project.php
 *
 * @author Eric Akkerman
 */
?>
<article class="project">
	<?php echotheme_get_title('post'); ?>
	
	<div class="post-content">
		<?php 
		$image = get_the_post_thumbnail(get_the_ID(), 'featured', array('class' => 'thumbnail span5'));
		if ($image) :
		?> 
		<div class="pull-right">
			<?php echo $image; ?>
		</div>
		<?php
		endif;
		the_content(); 
		?>
	</div>
</article>