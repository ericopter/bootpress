<?php
get_header();
?>
<!-- page.php -->
<div id="page-template" class="span9 <?php echotheme_sidebar_position('content'); ?>">
	<?php
	the_post();
	get_template_part('content', 'page');
	?>
</div>
<?php
get_sidebar();
get_footer();
?>