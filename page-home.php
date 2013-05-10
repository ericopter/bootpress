<?php
/*
	Template Name: Home Page
*/

get_header();
the_post();
?>
<!-- page-home.php -->
<div class="span12">
	<h1>
		<?php the_title(); ?>
	</h1>
	
	<?php the_content(); ?>
</div>


<?php
get_footer();
?>