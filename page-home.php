<?php
/*
	Template Name: Home Page
*/
get_header();
?>
<!-- page-home.php -->
<div id="page-home" class="span12">
	<?php
	the_post();
	get_template_part('content', 'page');
	?>
</div>

<?php
$sticky = get_option('sticky_posts');
$args = array(
	'post__in' => $sticky,
	'posts_per_page' => -1,
	'post_type' => 'post',
);

$query = new WP_Query($args);
if ($query->have_posts() && $sticky[0]) :
?>
<div id="featured-posts" class="span12">
	<?php
		while ($query->have_posts()) :
			$query->the_post();
			get_template_part('content', 'featured');
		endwhile;
	?>
</div> <!-- end #featured-posts -->
<?php
endif;
?>
<?php
get_footer();
?>