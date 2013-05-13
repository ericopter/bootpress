<?php
get_header();
?>
<!-- category.php -->
<div id="category-template" class="span9 <?php echotheme_sidebar_position(); ?>">
	<?php if ( have_posts() ) : ?>

		<header class="page-header">
		<h1 class="page-title">
			<?php
			printf( __( 'Category Archives: %s', 'echotheme' ), '<span>' . single_cat_title( '', false ) . '</span>' );
			?>
		</h1>

		<?php
		$category_description = category_description();
		if ( ! empty( $category_description ) ) {
			echo apply_filters( 'category_archive_meta', '<div class="category-archive-meta">' . $category_description . '</div>' );
		}
		
		// display sub categories of the current category to refine results
		$cat_id = get_cat_ID(single_cat_title( '', false ));
		$sub_cats = get_categories(array('parent' => $cat_id));

		// if the category has posts
		if (count($sub_cats) > 0) : ?>
		<div id="sub-categories">
			<h2 class="sub-title">Sub Categories</h2>
			<?php
			foreach ($sub_cats as $cat) : 
			if ($cat->count > 0):
			?>
			<a class="button-link" href="<?php echo get_category_link($cat->term_id) ?>"><?php echo $cat->name ?></a>
			<?php
			endif;
			endforeach;
			?>
		</div>
		<?php
		endif;	
		?>
	</header>
	
	<?php 
	
	echotheme_content_nav( 'nav-above' ); 
	
	/* Start the Loop */ 
	while ( have_posts() ) : 
	the_post(); 
	
	/* Include the Post-Format-specific template for the content.
	 * If you want to overload this in a child theme then include a file
	 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
	 */
	get_template_part( 'content', get_post_format() );
	
	endwhile; 
	
	echotheme_content_nav( 'nav-below' ); 
	
	else : // no posts so show search form
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

	<?php endif; ?>
</div> <!-- end #category-template -->
<?php
get_sidebar();
get_footer();
?>