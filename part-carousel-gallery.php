<?php
// display flex gallery only on pages and posts
if (!is_single() && !is_page()) {
	return null;
}

$args = array(
/* 	'order' 		=> 'ASC', */
	'orderby'        => 'rand',
    'post_type'      => 'attachment',
    'post_parent'    => $post->ID,
    'post_mime_type' => 'image',
    'post_status'    => null,
    'numberposts'    => -1,
);
$attachments = get_children( $args );

// add featured image to the array
$post_thumbnail_id = get_post_thumbnail_id($post->ID);
if ($post_thumbnail_id) {
	$attachments[$post_thumbnail_id] = get_the_post_thumbnail($post->ID, 'slideshow');
}


// only continue if we have at least one of something
if ($imageCount = count($attachments) > 0) :
$id = 'carousel-' . $post->ID;
?>
<div id="<?php echo $id ?>" class="carousel slide gallery">
	
	<div class="carousel-inner">
		<?php
		$i = 0;
		foreach ( $attachments as $attachment_id => $attachment ) :
		?>
		<div class="item<?php if ($i == 0) echo ' active';?>">
			<?php echo wp_get_attachment_image( $attachment_id, 'slideshow' ); ?>
		</div>
		<?php
		$i++;
		endforeach;
		?>
	</div>
	
	<ol class="carousel-indicators">
		<?php for ($c = 0; $c < $i; $c++) :?>
		<li data-target="#<?php echo $id; ?>" data-slide-to="<?php echo $c; ?>"></li>
		<?php endfor; ?>
	</ol>
	
	<a class="carousel-control left" href="#<?php echo $id; ?>" data-slide="prev">&lsaquo;</a>
	<a class="carousel-control right" href="#<?php echo $id; ?>" data-slide="next">&rsaquo;</a>
	
	<script type="text/javascript">
		$('#<?php echo $id; ?>.carousel').carousel();
	</script>
</div>
<?php
endif;

// do we need this?
// wp_reset_query();
?>