<?php
/**
 * This file is for development only
 *
 * In Progress - content-thumbnail.php
 */
?>
<article class="span4">
	<?php if (!has_post_thumbnail()) return; ?>
	
	<div class="thumbnail">
		<?php if (has_post_thumbnail()): ?>
		<a href="<?php the_permalink() ?>" rel="bookmark" class="">
			<?php the_post_thumbnail('featured'); ?>
		</a>
		<?php endif; ?>
		<div class="caption">
				<a href="<?php the_permalink() ?>" rel="bookmark" class="">
				<?php the_title(); ?>
				</a>
			
			<?php
			// wpautop(the_excerpt());
			
			?>
		</div>
		<header>

			
		</header>

		<div class="post-content">
			
		</div>

	</div> <!-- end #.thumbnail -->
	
</article>