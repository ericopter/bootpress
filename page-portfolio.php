<?php
/**
 * Template Name: Portfolio Page
 * 
 *
 * @author Eric Akkerman
 */

// Load the shadowbox and isotope resources
echotheme_load_shadowbox();
echotheme_load_isotope();

get_header();
?>
<!-- page-portfolio.php -->
<div id="portfolio-page" class="span12">
	<?php
	// do the normal page stuff
	the_post();
	get_template_part('content', 'page');
	?> 
</div> <!-- end #portfolio-page.span12 -->

<div id="isotope-portfolio" class="span12">
	<?php
	// get the post type tags, aka get da "skills"!
	$skills = get_terms('skill');

	// build the filters controls
	$filters = '<div id="isotope-filters">';
	$filters .= '<a class="btn selected" href="#" data-filter="*">All</a> ';

	foreach($skills as $skill) {
		$filters .= '<a class="btn" href="#" data-filter=".'. $skill->slug . '">' . $skill->name . '</a> ';
	}

	$filters .= '</div>';

	// get all the project post types
	$args = array(
		'post_type' => 'project',
		'posts_per_page' => -1,
		'orderby' => 'name',
		'order' => 'ASC'
	);
	$items = new WP_Query($args);

	// go forward?
	if ($items->have_posts()) :
		// outpur the filter buttons
		echo $filters;
	?> 
	
	<div id="isotope-items" class="thumbnails">
		<?php
		// run through the items
		while ($items->have_posts()) :
			$items->the_post();
		
			// get the current portfolio item tags
			$terms = wp_get_post_terms($post->ID, 'skill');
		
			// add the skill tags to an array
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
		<div class="span4 item <?php echo $cats; ?>">
			<div class="thumbnail">
				<a href="<?php echo $large_image_url[0]; ?>" class="shadowbox">
					<?php echo $image; ?>
				</a>
				
				<div class="item-info caption">
					<a href="<?php the_permalink(); ?>" class="">
						<?php the_title(); ?>
					</a>
				</div>
			</div>
		</div> <!-- end .item -->
		<?php
			}
		endwhile;
		?> 
		<script type="text/javascript">
			$(document).ready(function() {
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
				var $container = $('#isotope-items');
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
	</div> <!-- end #isotope-items -->
	<?php
	endif; // end if items have posts
	?> 
</div> <!-- end #isotope-portfolio -->
<?php
get_footer();
?>