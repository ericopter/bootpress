<?php
/**
 * This file is for development only
 *
 * In Progress - content-index.php
 */
?>
<article class="media">
	<?php if (has_post_thumbnail()): ?>
	<a href="<?php the_permalink() ?>" rel="bookmark" class="pull-left">
		<?php the_post_thumbnail('thumbnail'); ?>
	</a>
	<?php endif; ?>
	
	<div class="media-body">
		<header>
			<h1 class="post-title">
				<?php the_title(); ?>
			</h1>
			<?php 
			if (is_sticky()): 
			?>
			<h2 class="post-format">
				<?php _e( 'Featured Content', 'echotheme' ); ?>
			</h2>
			<?php 
			endif; 
			
			if ('post' == get_post_type()) :
			?>
			<div class="post-meta">
				<?php echotheme_posted_on(); ?>
			</div> <!-- end #.post-meta -->
			<?php
			endif;
			
			if (comments_open() && !post_password_required()) :
			?>
			<div class="comments-link">
				<?php 
				comments_popup_link( 
					'<span class="btn">' . __( 'Reply', 'echotheme' ) . '</span>', 
					_x( '1', 'comments number', 'echotheme' ), 
					_x( '%', 'comments number', 'echotheme' ),
					'btn'
				); 
				?>
			</div> <!-- end #.comments-link -->
			<?php
			endif;
			?>
		</header>

		<div class="post-content">
			<?php
			if (is_search()) {
				the_excerpt();
			} else {
				the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'echotheme' ) ); 

				wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'echotheme' ) . '</span>', 'after' => '</div>' ) );
			}
			?>
		</div>

		<footer class="post-meta">
			<?php 
			$show_sep = false; 
			if ( 'post' == get_post_type() ) : // Hide category and tag text for pages on Search 
				/* translators: used between list items, there is a space after the comma */
				$categories_list = get_the_category_list( __( ', ', 'echotheme' ) );
				if ( $categories_list ):
			?>
			<span class="cat-links">
				<?php 
				printf( __( '<span class="%1$s">Posted in</span> %2$s', 'echotheme' ), 'post-utility-prep post-utility-prep-cat-links', $categories_list );
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
				printf( __( '<span class="%1$s">Tagged</span> %2$s', 'echotheme' ), 'post-utility-prep post-utility-prep-tag-links', $tags_list );
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
		</footer>
	</div> <!-- end #.media-body -->
	
</article>