<?php
/**
 * This file is for development only
 *
 * In Progress - content-thumbnail.php
 */
?>
<article class="span4">
	<?php if (!hes_post_thumbnail()) return; ?>
	
	<div class="thumbnail">
		<?php if (has_post_thumbnail()): ?>
		<a href="<?php the_permalink() ?>" rel="bookmark" class="pull-left">
			<?php the_post_thumbnail('thumbnail'); ?>
		</a>
		<?php endif; ?>
		<header>
			<h3 class="post-title">
				<?php the_title(); ?>
			</h3>
			
		</header>

		<div class="post-content">
			<?php
			the_excerpt();
			
			?>
		</div>

	</div> <!-- end #.thumbnail -->
	
</article>