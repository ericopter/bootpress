<?php
/**
 * Custom Post Type: Projects
 */

add_action('init', 'create_taxonomy_projects');

function create_taxonomy_projects()
{
	// Project Skills
	$labels = array(
    	'name' => __( 'Skills' ),
    	'singular_name' => __( 'Skill' ),
    	'search_items' =>  __( 'Search Skills' ),
    	'all_items' => __( 'All Skills' ),
    	'parent_item' => __( 'Parent Skill' ),
    	'parent_item_colon' => __( 'Parent Skill:' ),
    	'edit_item' => __( 'Edit Skill' ),
    	'update_item' => __( 'Update Skill' ),
    	'add_new_item' => __( 'Add New Skill' ),
    	'new_item_name' => __( 'New Skill Name' ),
		'popular_items' => __('Popular Skills')
  	); 	

  	register_taxonomy('skill', 'project', array(
    	'hierarchical' => false,
    	'labels' => $labels
  	));

	flush_rewrite_rules(false);
}

add_action('init', 'create_post_type_projects');

function create_post_type_projects()
{
	// Projects Custom Post Type
	$labels = array(
		'name' => __( 'Projects' ),
		'singular_name' => __( 'Project' ),
		'add_new' => __( 'Add New' ),
		'add_new_item' => __( 'Add New Project' ),
		'edit' => __( 'Edit' ),
		'edit_item' => __( 'Edit Project' ),
		'new_item' => __( 'New Project' ),
		'view' => __( 'View Project' ),
		'view_item' => __( 'View Project' ),
		'search_items' => __( 'Search Projects' ),
		'not_found' => __( 'No projects found' ),
		'not_found_in_trash' => __( 'No projects found in Trash' ),
		'parent' => __( 'Parent Project' ),
	);
	
	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => 25,
		'supports' => array('title', 'editor', 'thumbnail', 'comments', 'revisions', 'excerpt')
	); 	
	
	register_post_type( 'project' , $args );
	
	flush_rewrite_rules(false);
}

// define project post type custom meta box inputs
$project_details = array(		

		"url" => array(
    		"type" => "textfield",
			"name" => $prefix."url",
    		"std" => "",
    		"title" => __('URL','themetrust'),
    		"description" => __('Enter the URL of your project.','themetrust')
		),
		"url_label" => array(
			"type" => "textfield",
			"name" => $prefix."url_label",
			"std" => "",
			"title" => __('URL Label','themetrust'),
			"description" => __('Enter a label for the URL.','themetrust')
		)		
);

// Add the inputs to the meta box group array to ensure they're saved
$meta_box_groups[] = $project_details;

/**
 * Add the custom meta box to the post editor
 */

add_action('admin_menu', 'create_meta_box_project');

function create_meta_box_project() {	
	global $project_details;	
	
	if ( function_exists('add_meta_box') ) {
		add_meta_box(
			'new-meta-boxes-details', 
			__('Project Options','themetrust'), 
			'new_meta_box', 
			'project', 
			'normal', 
			'high', 
			array('inputs'=>$project_details) 
		);
	}
}