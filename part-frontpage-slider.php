<?php
$args = array(
	'post_type' => 'echotheme_slideshow',
	'posts_per_page' => -1,
	'orderby' => 'menu_order'
);

$slides = new WP_Query($args);

if (!$slides->have_posts()) {
	return;
}
// create a counter
$count = 0;
?>
<div id="slideshow-wrapper">
	<div class="container">
		<div class="row">
			<div class="span12">
				<div id="frontpage-carousel" class="carousel slide">
					<div class="carousel-inner">
						<?php while ($slides->have_posts()) :
							$slides->the_post();
					
							if ($count == 0) {
								$class = 'item active';
							} else {
								$class = 'item';
							}
					
							// increment the count
							$count++;
							$image = get_the_post_thumbnail($slide->ID, 'slideshow');
					
							$display_text = get_meta_box_value('_echotheme_slide_display_value');
					
							if ($display_text == 'true') :
								$title = get_the_title();
								$content = get_the_content();
								$link = get_meta_box_value('_echotheme_slide_url_value');
							endif; // end $display
						?>
						<div class="<?php echo $class; ?>">
							<?php 
							echo $image;
					
							if ($display_text): ?>
							<div class="carousel-caption">
								<h4><?php echo $title; ?></h4>
								<p><?php echo $content ?></p>
							</div> <!-- end .carousel-caption -->
							<?php endif; ?>
						</div>
				
						<?php
						endwhile; ?>
					</div> <!-- end .carousel-inner -->
			
					<ol class="carousel-indicators">
						<?php for ($i = 0; $i < $count; $i++) :?>
						<li data-target="#frontpage-carousel" data-slide-to="<?php echo $i; ?>"></li>
						<?php endfor; ?>
					</ol>
			
					<a class="carousel-control left" href="#frontpage-carousel" data-slide="prev">&lsaquo;</a>
					<a class="carousel-control right" href="#frontpage-carousel" data-slide="next">&rsaquo;</a>
				</div> <!-- end frontpage-carousel -->
				<script type="text/javascript">
					$('#frontpage-carousel').carousel();
				</script>
		
			</div> <!-- end .span12 -->
		</div> <!-- end .row -->
	</div>
</div> <!-- end #frontpage-slider -->
<?php wp_reset_query(); ?>