<?php
/*
	Template Name: Full Width
*/
get_header();
?>
<!-- page-fullwidth.php -->
<div id="page-fullwidth" class="span12">
	<?php
	the_post();
	get_template_part('content', 'page');
	?> 
</div> <!-- end #page-fullwidth -->
<?php
get_footer();
?>