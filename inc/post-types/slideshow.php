<?php
/**
 * Custom Post Type: Homepage Slideshow
 */

add_action('init', 'create_post_type_slideshow');

function create_post_type_slideshow()
{
	// Homepage Slideshow Custom Post Type
	$labels = array(
		'name' => __('Slide Show'),
		'singular_name' => __('Slide'),
		'all_items' => __('All Slides'),
		'add_new' => __('Add New Slide'),
		'add_new_item' => __('Add A New Slide'),
		'new_item' => __('Add Slide'),
		'edit_item' => __('Edit Slide'),
	);
	
	$args = array(
		'labels' => $labels,
		'description' => 'Use this panel to add images to the site slide show',
		'public' => false,
		'show_ui' => true,
		'menu_position' => 25,
		'supports' => array(
			'title',
			'editor',
			'thumbnail',
			'page-attributes'
		),
		'show_in_nav_menus' => false,
	);
	
	register_post_type( 'echotheme_slideshow' , $args );
}

// define slideshow post type custom meta box inputs
$slideshow_options = array(
	'slide_display' => array(
		'type' => 'checkbox', 
		'name' => $prefix.'slide_display',
		'std' => '',
		'title' => __('Show Title and Description on Slide?', 'echotheme'),
		'description' => __('Display the title and content on the slide?', 'echotheme')
	),
	'slide_url' => array(
		'type' => 'textfield', 
		'name' => $prefix.'slide_url',
		'std' => '',
		'title' => __('Slide Text Link Url', 'echotheme'),
		'description' => __('Url to link the slide text to if set to display', 'echotheme')
	)
);

// add $slideshow options to the meta box group
$meta_box_groups[] = $slideshow_options;

/**
 * Add the custom meta box to the post editor
 */

add_action('admin_menu', 'create_meta_box_slideshow');

function create_meta_box_slideshow() {	
	global $slideshow_options;	
	
	if ( function_exists('add_meta_box') ) {
		add_meta_box(
			'new-meta-boxes-details', 
			__('Slide Options','themetrust'), 
			'new_meta_box', 
			'echotheme_slideshow', 
			'normal', 
			'high', 
			array('inputs'=>$slideshow_options) 
		);
	}
}