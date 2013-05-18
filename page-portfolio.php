<?php
/**
 * Template Name: Portfolio Page
 * 
 * stdClass Object ( [term_id] => 4 [name] => Website Design [slug] => website-design [term_group] => 0 [term_taxonomy_id] => 4 [taxonomy] => skill [description] => [parent] => 0 [count] => 1 ) 
 *
 * @author Eric Akkerman
 */
echotheme_load_shadowbox();
echotheme_load_isotope();
get_header();

$skills = get_terms('skill');
?>
<!-- page-portfolio.php -->
<div id="portfolio-page" class="span12">
<?php

// build the filters controls
$filters = '<div id="isotope-filters" class="span12"><a class="btn selected" href="#" data-filter="*">All</a> ';
foreach($skills as $skill) {
	$filters .= '<a class="btn" href="#" data-filter=".'. $skill->slug . '">' . $skill->name . '</a> ';
}
$filters .= '</div><div class="clear"></div>';

// get the posts under the category
$args = array(
	'post_type' => 'project',
	// 'category_name' => $categoryName,
	'posts_per_page' => -1
);

$items = new WP_Query($args);

if ($items->have_posts()) :
?>
<div class="row">
<?php 
echo $filters;
?>
<div class="clearfix"></div><br>
</div>
<div id="isotope-portfolio" class="row thumbnails">
	<?php
	while ($items->have_posts()) :
		$items->the_post();
		$terms = wp_get_post_terms($post->ID, 'skill');
		
		$cats = array();
		foreach ($terms as $term) {
			$cats[] = $term->slug;
		}
		$cats = implode(' ', $cats);
		
		$title = get_the_title();
		$image = get_the_post_thumbnail($post->ID, 'featured');
		
		if ($image) {
			$image = remove_thumbnail_height($image);
			
			$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large');
			?>
			<div class="span4 item image-frame <?php echo $cats; ?>">
				<a href="<?php echo $large_image_url[0]; ?>" class="shadowbox thumbnail">
					<?php echo $image; ?>
				</a>
			</div>
			<?php
		}
		# code...
	endwhile;
	?>
	<script type="text/javascript">
	$(window).load(function() {
		// Shadowbox
		Shadowbox.init(
			{
				skipSetup : true
			}
		);

		Shadowbox.setup(
			"a.shadowbox", 
			{
				'gallery' : 'Images',
				'continuous' : true
			}
		);

		// Isotope
		var $container = $('#isotope-portfolio');
		$container.isotope();

		$('#isotope-filters a').click(function(){
		 	var selector = $(this).attr('data-filter');
		 	$container.isotope({ filter: selector });

			// add class "selected" to filter button
			if (!$(this).hasClass('selected')) {
				$('#isotope-filters a').removeClass('selected');
				$(this).addClass('selected');
			};

			var gallery = selector + ' a.shadowbox';

			Shadowbox.setup(
				gallery,
				{
					'gallery' : selector,
					'continuous' : true
				}
			);
		 	return false;
		});
	});

	</script>
</div>
<?php
endif; // end if items have posts
?>
</div>
<?php
get_footer();
?>