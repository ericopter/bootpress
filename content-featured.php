<?php
/**
 * Display template for featured posts
 */
?>
<!-- content-featured.php -->
<article id="post-<?php the_ID(); ?>" <?php post_class('sticky span4'); ?>>
	
	<header class="post-header page-header">
		<h2 class="post-title">
			<a href="<?php the_permalink(); ?>">
				<?php the_title(); ?>
			</a>
			<?php
			/*
			if (is_sticky()): 
			?>
			<small><i>
				<?php _e( 'Featured Content', 'echotheme' ); ?>
			</i></small>
			<?php 
			endif;
			*/
			?>
		</h2>
		<?php 
		
		/*
		if ('post' == get_post_type()) :
		?>
		<div class="post-meta muted">
			<?php 
			echotheme_posted_on(); 
			if (comments_open() && !post_password_required()) :
			?>
			<div class="comments-link pull-right">
				<?php 
				comments_popup_link( 
					__( 'Reply', 'echotheme' ) . ' <span class="icon-share-alt"></span>', 
					_x( '1 Comment', 'comments number', 'echotheme' ), 
					_x( '% Comments', 'comments number', 'echotheme' ),
					'btn btn-mini'
				); 
				?>
			</div> <!-- end #.comments-link -->
			<?php
			endif;
			?>
			<div class="clearfix"></div>
		</div> <!-- end #.post-meta -->
		<?php
		endif;
		*/
		
		?>
	</header>

	<div class="post-content">
		<?php
		if ($image = get_the_post_thumbnail(get_the_ID(), 'featured')) :
		?>
		<div class="post-thumbnail image-frame center">
			<a href="<?php the_permalink(); ?>">
				<?php echo $image; ?>
			</a>
		</div> <!-- end .post-thumbnail -->
		<br />
		<?php
		endif;
		
		the_excerpt(); 
		
		wp_link_pages(array( 
			'before' => '<div class="page-link"><span>' . __( 'Pages:', 'echotheme' ) . '</span>', 'after' => '</div>' 
		)); 
		?>
	</div><!-- .post-content -->

	<div class="clearfix"></div>
</article><!-- #post-<?php the_ID(); ?> -->