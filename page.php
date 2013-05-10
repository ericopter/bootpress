<?php
get_header();
the_post();
?>
<!-- page.php -->
<div id="side-bar" class="span3">
	<?php get_sidebar(); ?>
</div>

<div class="span9">
	<?php the_content(); ?>
</div>
<?php
get_footer();
?>