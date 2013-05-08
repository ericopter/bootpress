<?php
// create meta box fields for adding meta description and keywords to page post-types
$page_options = array(
	'meta_description' => array(
		'type' => 'textarea', 
		'name' => $prefix.'meta_description',
		'std' => '',
		'title' => __('Page Meta Description', 'echotheme'),
		'description' => __('Set the meta description for this	 page (overwrites default in theme options)', 'echotheme')
	),
	'meta_keywords' => array(
		'type' => 'textarea', 
		'name' => $prefix.'meta_keywords',
		'std' => '',
		'title' => __('Page Meta Keywords', 'echotheme'),
		'description' => __('Set the meta keywords for this page (overwrites site default in theme options)', 'echotheme')
	)
);

// add $page_options options to the meta box group
$meta_box_groups[] = $page_options;

add_action('admin_menu', 'create_meta_box_page');

function create_meta_box_page() {	
	global $page_options;	
	
	if ( function_exists('add_meta_box') ) {
		add_meta_box(
			'new-meta-boxes-meta', 
			__('Meta Tags','echotheme'), 
			'new_meta_box', 
			'page', 
			'normal', 
			'high', 
			array('inputs'=>$page_options) 
		);
	}
}