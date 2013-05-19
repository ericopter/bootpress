<?php
/**
 * single-project.php
 *
 * @author Eric Akkerman
 */
get_header();
?>
<div id="project" class="span12">
	<?php
	the_post();
	get_template_part('content', 'project');
	?>
</div> <!-- end #project.span12 -->
<?php
get_footer();
?>