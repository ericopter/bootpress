<?php
get_header();
?>
<!-- taxonomy-skill.php -->
<div id="taxonomy-skill" class="span12">
	<?php
	while (have_posts()) {
		the_post();
		get_template_part('content', 'single');
	}
	?>
</div> <!-- end #taxonomy-skill -->
<?php
get_footer();
?>