<?php
/**
 * The template for displaying content in the single.php template
 *
 */
?>
<!-- content-single.php -->
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php echotheme_get_title('post'); ?>

	<div class="entry-content">
		<?php 
		if (is_sticky()): 
			get_template_part('part', 'flexslider-gallery');
		endif; 
		
		the_content(); 
		
		wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'echotheme' ) . '</span>', 'after' => '</div>' ) ); 
		?>
	</div><!-- .entry-content -->

	<footer class="entry-meta">
		<?php
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( __( ', ', 'echotheme' ) );

		/* translators: used between list items, there is a space after the comma */
		$tag_list = get_the_tag_list( '', __( ', ', 'echotheme' ) );
		if ( '' != $tag_list ) {
			$utility_text = __( 'This entry was posted in %1$s and tagged %2$s by <a href="%6$s">%5$s</a>. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'echotheme' );
		} elseif ( '' != $categories_list ) {
			$utility_text = __( 'This entry was posted in %1$s by <a href="%6$s">%5$s</a>. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'echotheme' );
		} else {
			$utility_text = __( 'This entry was posted by <a href="%6$s">%5$s</a>. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'echotheme' );
		}

		printf(
			$utility_text,
			$categories_list,
			$tag_list,
			esc_url( get_permalink() ),
			the_title_attribute( 'echo=0' ),
			get_the_author(),
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) )
		);
		
		// add the edit post link
		edit_post_link( __( 'Edit', 'echotheme' ), '<span class="edit-link">', '</span>' ); 
		
		// If a user has filled out their description and this is a multi-author blog, show a bio on their entries 
		if ( get_the_author_meta( 'description' ) && ( ! function_exists( 'is_multi_author' ) || is_multi_author() ) ) : 
		?>
		<div id="author-info">
			<div id="author-avatar">
				<?php 
				echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'echotheme_author_bio_avatar_size', 68 ) ); 
				?>
			</div><!-- #author-avatar -->
			
			<div id="author-description">
				<h2>
					<?php printf( __( 'About %s', 'echotheme' ), get_the_author() ); ?>
				</h2>
				<?php 
				the_author_meta( 'description' ); 
				?>
				<div id="author-link">
					<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
						<?php 
						printf( __( 'View all posts by %s <span class="meta-nav">&rarr;</span>', 'echotheme' ), get_the_author() ); 
						?>
					</a>
				</div><!-- #author-link	-->
			</div><!-- #author-description -->
		</div><!-- #entry-author-info -->
		<?php endif; ?>
	</footer><!-- .entry-meta -->
</article><!-- #post-<?php the_ID(); ?> -->
