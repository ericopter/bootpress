<?php
/**
 * Display template for featured posts
 */
?>
<!-- content-featured.php -->
<article id="post-<?php the_ID(); ?>" <?php post_class('sticky'); ?>>
	
	<header class="post-header">
		
		<h2 class="post-title">
			<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'echotheme' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
				<?php the_title(); ?>
			</a>
		</h2>
		
		<h3 class="post-format">
			<?php _e( '&iexcl; Featured Content !', 'echotheme' ); ?>
		</h3>
</header><!-- .post-header -->

	<div class="post-content">
		<?php
		if ($image = get_the_post_thumbnail(get_the_ID(), 'medium')) :
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