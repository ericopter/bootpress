<?php
/*
	Template Name: Home Page
*/
the_post();
get_header();
?>
<!-- page-home.php -->
<div class="span12">
	<h1 id="page-title">
		<?php the_title(); ?>
	</h1>
	
	<?php the_content(); ?>
</div>


<?php
get_footer();
?>