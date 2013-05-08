<?php
/**
 * Custom Post Type: Portfolio
 */

add_action('init', 'create_taxonomy_portfolio');

function create_taxonomy_portfolio()
{
	// Portfolio Category
	$labels = array(
		'name' => __( 'Portfolios' ),
		'singular_name' => __( 'Portfolio' ),
		'search_items' =>  __( 'Search Portfolios' ),
		'all_items' => __( 'All Portfolios' ),
		'parent_item' => __( 'Parent Portfolio' ),
		'parent_item_colon' => __( 'Parent Portfolio:' ),
		'edit_item' => __( 'Edit Portfolio' ),
		'update_item' => __( 'Update Portfolio' ),
		'add_new_item' => __( 'Add New Portfolio' ),
		'new_item_name' => __( 'New Portfolio Name' ),
		'popular_items' => __('Popular Portfolios')
	); 	

	register_taxonomy('portfolio', 'work', array(
		'hierarchical' => false,
		'labels' => $labels
	));

	flush_rewrite_rules(false);
}

add_action('init', 'create_post_type_work');

function create_post_type_work()
{
	/*
		Portfolio Custom post Type
	*/
	$labels = array(
		'name' => __( 'Your Works' ),
		'singular_name' => __( 'Work' ),
		'add_new' => __( 'Add Work' ),
		'add_new_item' => __( 'Add Work' ),
		'edit' => __( 'Edit' ),
		'edit_item' => __( 'Edit Work' ),
		'new_item' => __( 'New Work' ),
		'view' => __( 'View Work' ),
		'view_item' => __( 'View Work' ),
		'search_items' => __( 'Search Portfolio' ),
		'not_found' => __( 'No items found' ),
		'not_found_in_trash' => __( 'No portfolio works found in Trash' ),
		'parent' => __( 'Parent Portfolio Work' ),
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
		'supports' => array('title', 'editor', 'thumbnail', 'comments', 'revisions', 'excerpt'),
		'taxonomies' => array('portfolio')
	); 	

	register_post_type( 'work' , $args );

	flush_rewrite_rules( false );
}