<?php
get_header();
?>
<!-- taxonomy-skill.php -->
<div id="skill" class="span12">
	<div class="thumbnails">
	<?php
	while (have_posts()) {
		the_post();
		get_template_part('content', 'thumbnail');
	}
	?>
	</div>
</div> <!-- end #taxonomy-skill -->
<?php
get_footer();
?>