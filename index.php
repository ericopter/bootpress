<?php
get_header();
?>
<!-- index.php -->
<div class="span9 <?php echotheme_sidebar_position('content'); ?>">
	<?php 
	if ( have_posts() ) : 
		echotheme_content_nav( 'nav-above' ); 
		
		/* Start the Loop */ 
		while ( have_posts() ) : the_post(); 
			get_template_part( 'content', 'index' ); 
		endwhile; 
	
		echotheme_content_nav( 'nav-below' ); 
	else : // no posts
	?> 
	<article id="post-0" class="post no-results not-found">
		<header class="entry-header">
			<h1 class="entry-title"><?php _e( 'Nothing Found', 'echotheme' ); ?></h1>
		</header><!-- .entry-header -->

		<div class="entry-content">
			<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'echotheme' ); ?></p>
			<?php get_search_form(); ?>
		</div><!-- .entry-content -->
	</article><!-- #post-0 -->

	<?php 
	endif; 
	?> 
</div>
					
<?php
get_sidebar();
get_footer();
?>