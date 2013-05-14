<?php
/**
 * The default template for displaying content
 *
 */
?>
<!-- content.php -->
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<header class="entry-header">
			<?php 
			if ( is_sticky() ) : 
			?>
			<hgroup>
				<h2 class="post-title">
					<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'echotheme' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
						<?php the_title(); ?>
					</a>
				</h2>
				
				<h3 class="post-format">
					<?php _e( 'Featured', 'echotheme' ); ?>
				</h3>
			</hgroup>
			<?php 
			else : 
			?>
			<h1 class="post-title">
				<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'echotheme' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
					<?php the_title(); ?>
				</a>
			</h1>
			<?php 
			endif; 
			
			if ( 'post' == get_post_type() ) : 
			?>
			<div class="post-meta">
				<?php echotheme_posted_on(); ?>
			</div><!-- .entry-meta -->
			<?php 
			endif; 
			
			if ( comments_open() && ! post_password_required() ) : 
			?>
			<div class="comments-link">
				<?php comments_popup_link( '<span class="leave-reply">' . __( 'Comment', 'echotheme' ) . '</span>', _x( '1 Comment', 'comments number', 'echotheme' ), _x( '% Comments', 'comments number', 'echotheme' ) ); ?>
			</div>
			<?php 
			endif; 
			?>
		</header><!-- .entry-header -->

		<?php 
		if ( is_search() ) : // Only display Excerpts for Search 
		?>
		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->
		<?php 
		else : 
		?>
		<div class="entry-content">
			<?php 
			// Show post thumbnail?
			if (is_category() || is_archive()): 
				if ($thumbnail = get_the_post_thumbnail($post->ID, 'thumbnail')) :
			?>
			<div class="image-frame floatR">
				<a href="<?php the_permalink(); ?>">
					<?php echo $thumbnail; ?>
				</a>
			</div>
			<?php 
				endif; // end if thumbnail
			
				// show the excerpt only for the category and archive view
				the_excerpt();
			
				else: // not a category or archive
			
				the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'echotheme' ) ); 
			
				endif; // end if is_category(),is_archive()
			
				wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'echotheme' ) . '</span>', 'after' => '</div>' ) ); 
			?>
		</div><!-- .entry-content -->
		<?php 
		endif; // end if/else is_search()
		?>

		<footer class="entry-meta">
			<?php 
			$show_sep = false; 
			if ( 'post' == get_post_type() ) : // Hide category and tag text for pages on Search 
				
				/* translators: used between list items, there is a space after the comma */
				$categories_list = get_the_category_list( __( ', ', 'echotheme' ) );
				if ( $categories_list ):
			?>
			<span class="cat-links">
				<?php printf( __( '<span class="%1$s">Posted in</span> %2$s', 'echotheme' ), 'entry-utility-prep entry-utility-prep-cat-links', $categories_list );
				$show_sep = true; ?>
			</span>
			<?php 
				endif; // End if categories 
			
				/* translators: used between list items, there is a space after the comma */
				$tags_list = get_the_tag_list( '', __( ', ', 'echotheme' ) );
				if ( $tags_list ):
					if ( $show_sep ) : 
				?>
			<span class="sep"> | </span>
				<?php 
					endif; // End if $show_sep 
				?>
			<span class="tag-links">
				<?php printf( __( '<span class="%1$s">Tagged</span> %2$s', 'echotheme' ), 'entry-utility-prep entry-utility-prep-tag-links', $tags_list );
				$show_sep = true; ?>
			</span>
			<?php 
				endif; // End if $tags_list 
			endif; // End if 'post' == get_post_type() 
			?>

			<?php 
			if ( comments_open() ) : 
				if ( $show_sep ) : 
				?>
			<span class="sep"> | </span>
				<?php 
				endif; // End if $show_sep 
				?>
			<span class="comments-link"><?php comments_popup_link( '<span class="leave-reply">' . __( 'Leave a reply', 'echotheme' ) . '</span>', __( '<b>1</b> Reply', 'echotheme' ), __( '<b>%</b> Replies', 'echotheme' ) ); ?></span>
			<?php 
			endif; // End if comments_open() 
			
			edit_post_link( __( 'Edit', 'echotheme' ), '<span class="edit-link">', '</span>' ); 
			?>
		</footer><!-- #entry-meta -->
	</article><!-- #post-<?php the_ID(); ?> -->
