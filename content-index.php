<?php
/**
 * The default template for displaying content
 *
 */
?>
<!-- content-index.php -->
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<header class="entry-header">
			<?php 
			if ( is_sticky() ) : 
			?>
			<hgroup>
				<h2 class="entry-title">
					<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'echotheme' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
						<?php the_title(); ?>
					</a>
				</h2>
				
				<h3 class="entry-format">
					<?php _e( 'Featured Content', 'echotheme' ); ?>
				</h3>
			</hgroup>
			<?php 
			else : // not sticky
			?>
			<h1 class="entry-title">
				<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'echotheme' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
					<?php the_title(); ?>
				</a>
			</h1>
			<?php 
			endif; // end if is_sticky()
			
			if ( 'post' == get_post_type() ) : 
			?>
			<div class="entry-meta">
				<?php echotheme_posted_on(); ?>
			</div><!-- .entry-meta -->
			<?php 
			endif; // end if 'post' == get_post_type()
			
			// Comments?
			if ( comments_open() && ! post_password_required() ) : 
			?>
			<div class="comments-link">
				<?php 
				comments_popup_link( '<span class="leave-reply">' . __( 'Reply', 'echotheme' ) . '</span>', _x( '1', 'comments number', 'echotheme' ), _x( '%', 'comments number', 'echotheme' ) ); 
				?>
			</div>
			<?php 
			endif; // end if comments
			?>
		</header><!-- .entry-header -->

		<?php 
		if ( is_search() ) : // Only display Excerpts for Search 
		?>
		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->
		<?php 
		else : // not a search
		?>
		<div class="entry-content">
			<?php 
			if (has_post_thumbnail()) :
			?>
			<div class="floatL image-frame">
				<a href="<?php the_permalink() ?>" rel="bookmark">
					<?php the_post_thumbnail('thumbnail'); ?>
				</a>
			</div>
			<?php
			endif; // end if has_post_thumbnail()
			
			the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'echotheme' ) ); 
			
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
				<?php 
				printf( __( '<span class="%1$s">Posted in</span> %2$s', 'echotheme' ), 'entry-utility-prep entry-utility-prep-cat-links', $categories_list );
				$show_sep = true; 
				?>
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
				<?php 
				printf( __( '<span class="%1$s">Tagged</span> %2$s', 'echotheme' ), 'entry-utility-prep entry-utility-prep-tag-links', $tags_list );
				$show_sep = true; 
				?>
			</span>
			<?php 
				endif; // End if $tags_list 
			endif; // End if 'post' == get_post_type() 
			
			if ( comments_open() ) : 
				if ( $show_sep ) : 
			?>
			<span class="sep"> | </span>
			<?php 
				endif; // End if $show_sep 
			?>
			<span class="comments-link">
				<?php comments_popup_link( '<span class="leave-reply">' . __( 'Leave a reply', 'echotheme' ) . '</span>', __( '<b>1</b> Reply', 'echotheme' ), __( '<b>%</b> Replies', 'echotheme' ) ); ?>
			</span>
			<?php endif; // End if comments_open() ?>

			<?php edit_post_link( __( 'Edit', 'echotheme' ), '<span class="edit-link">', '</span>' ); ?>
		</footer><!-- #entry-meta -->
		<!-- <div class="clear"></div> -->
	</article><!-- #post-<?php the_ID(); ?> -->
