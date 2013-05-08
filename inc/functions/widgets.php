<?php
/**
 * This file defines the sidebars, includes custom widgets
 * and defines any common widget related functions
 */

// Array of custom post type files
$widgets = array(
	'recent-posts',
	// 'twitter'
);

foreach ($widgets as $file) {
	$file = __DIR__ . '/../widgets/' . $file . '.php';

	if (is_file($file)) {
		require_once($file);
	}
}

/**
 * This function sets up the theme sidebars
 */
function echotheme_sidebars_init() {
	
	register_sidebar(array(
		'name' => 'Default Sidebar',
		'id' => 'sidebar',
		'description' => __('This is the default widget area for the sidebar. This will be displayed if the other sidebars have not been populated with widgets.', 'echotheme'),
		'before_widget' => '<div id="%1$s" class="%2$s widget sidebarBox">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>'
	));
	
	register_sidebar(array(
		'name' => 'Home Page Sidebar',
		'id' => 'sidebar_home',
		'description' => __('Widget area for the home page sidebar.', 'echotheme'),
		'before_widget' => '<div id="%1$s" class="%2$s widget sidebarBox">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>'
	));

	register_sidebar(array(
		'name' => 'Page Sidebar',
		'id' => 'sidebar_pages',
		'description' => __('Widget area for the sidebar on pages.', 'echotheme'),
		'before_widget' => '<div id="%1$s" class="%2$s widget sidebarBox">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>'
	));

	register_sidebar(array(
		'name' => 'Posts Sidebar',
		'id' => 'sidebar_posts',
		'description' => __('Widget area for the sidebar on posts.', 'echotheme'),
		'before_widget' => '<div id="%1$s" class="%2$s widget sidebarBox">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>'
	));

	register_sidebar(array(
		'name' => 'Default Footer',
		'id' => 'footer_default',
		'description' => __('This is the default widget area for the footer. This will be displayed if the other footers have not been populated with widgets.', 'echotheme'),
		'before_widget' => '<div id="%1$s" class="%2$s four columns widget footerBox widgetBox">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>'
	));

	register_sidebar(array(
		'name' => 'Home Page Footer',
		'id' => 'footer_home',
		'description' => __('Widget area for the footer on the home page.', 'echotheme'),
		'before_widget' => '<div id="%1$s" class="%2$s four columns widget footerBox widgetBox">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>'
	));

	register_sidebar(array(
		'name' => 'Page Footer',
		'id' => 'footer_pages',	
		'description' => __('Widget area for the footer on pages.', 'echotheme'),
		'before_widget' => '<div id="%1$s" class="%2$s four columns widget footerBox widgetBox">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>'
	));

	register_sidebar(array(
		'name' => 'Posts Footer',
		'id' => 'footer_posts',	
		'description' => __('Widget area for the footer on posts.', 'echotheme'),
		'before_widget' => '<div id="%1$s" class="%2$s four columns widget footerBox widgetBox">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>'
	));
	
	
	
	add_filter('widget_text', 'do_shortcode');
}
add_action( 'widgets_init', 'echotheme_sidebars_init' );
?>