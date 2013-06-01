<?php
/**
 * Template Name: Thumbnail Children
 */
get_header();
?>
<!-- page-subpages.php -->
<div id="page-subpages" class="span12">
	<?php
	the_post();
	get_template_part('content', 'page');
	?>
	<hr />
</div>
<?php
$args = array(
	'post_type' => 'page',
	'post_parent' => get_the_ID(),
	'posts_per_page' => -1,
	'orderby' => 'name',
	'order' => 'ASC'
);

$children = new WP_Query($args);

if ($children->have_posts()) :
?>

<div id="subpages">
	<?php
	while ($children->have_posts()):
		$children->the_post();
		if (has_post_thumbnail()) :
	?>
	<div class="span4">
		<div class="thumbnail">
			<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail('featured'); ?>
			</a>
			<div class="caption">
				<h3>
					<a href="<?php the_permalink(); ?>">
						<?php the_title(); ?>
					</a>
				</h3>
			</div>
		</div>
	</div>
	<?php
		endif;
	endwhile;
	?>
</div>
<?php
endif;
?>
<?php
get_footer();
?>