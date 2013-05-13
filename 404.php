<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 */

get_header(); 
?> 
<!-- 404.php -->
<div id="404-template" class="span9 <?php echotheme_sidebar_position('content') ?>">
	<article id="post-0" class="post error404 not-found">
		<header class="entry-header">
			<h1 class="entry-title">
				<?php _e( 'The page you requested could not be found...', 'twentyeleven' ); ?> 
			</h1>
		</header>

		<div class="entry-content">
			<p>
				<?php _e( 'The requested page could not be found. Try going back and looking again, or use the search for below', 'twentyeleven' ); ?> 
			</p>

			<?php get_search_form(); ?> 
		</div><!-- .entry-content -->
	</article><!-- #post-0 -->
</div> <!-- end #404 -->
<?php 
get_sidebar();
get_footer(); 
?>