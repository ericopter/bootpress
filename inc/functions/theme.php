<?php
/**
 * echotheme_include_files()
 * 
 * Set up and include the different file options
 */
function echotheme_include_libs()
{
	// Load main options panel file  
	if ( !function_exists( 'optionsframework_init' ) ) {
		define('OPTIONS_FRAMEWORK_URL', TEMPLATEPATH . '/inc/options/');
		define('OPTIONS_FRAMEWORK_DIRECTORY', get_bloginfo('template_directory') . '/inc/options/');
		require_once (OPTIONS_FRAMEWORK_URL . 'options-framework.php');
	}
	
	// include the breadcrumbs
	if (file_exists(INCLUDEPATH . 'scripts/breadcrumbs/breadcrumbs.php')) {
		require_once(INCLUDEPATH . 'scripts/breadcrumbs/breadcrumbs.php');
	}
	
	// include multiple featured images
	if (file_exists(INCLUDEPATH . 'scripts/MultiPostThumbnails/MultiPostThumbnails.php')) {
		require_once(INCLUDEPATH . 'scripts/MultiPostThumbnails/MultiPostThumbnails.php');
	}
}

echotheme_include_libs();

/**
 * echotheme_setup()
 * 
 * Set up Wordpress theme features
 */
function echotheme_setup()
{
	// This theme uses post thumbnails
	add_theme_support( 'post-thumbnails' );
	
	// define the image theme sizes
	add_image_size( 'slideshow' , 940, 400, true);
	// add_image_size( 'slideshow' , 940, 400, true);
	
	
	// define the theme menu areas
	register_nav_menus(array( 
		'header-menu' 	=> 'Header Area Menu',
		'top-menu' 		=> 'Top Nav Bar',
		'side-bar-nav'	=> 'Sidebar Navigation',
		'footer-menu'	=> 'Footer Menu'
	));
}

add_action('after_setup_theme', 'echotheme_setup');


//////////////////////////////////////////////////////////////
// Feature Images (Post Thumbnails)
/////////////////////////////////////////////////////////////

// new MultiPostThumbnails(array(
// 	'label' => 'Background Image',
// 	'id' => 'background_image',
// 	'post_type' => 'project'
// 	)
// );


// add_image_size('echotheme_slideshow_image_full', 960, 350, true);
// add_image_size('echotheme_background_image_full', 3000, 30000);


/**
 * multi_post_thumbnail_links()
 * 
 * Hide MultiPostThumbnails Links in regular media upload page
 */
function multi_post_thumbnail_links() {
   echo '<style type="text/css">
           .media-php .post-slidewhow_image-thumbnail{display: none;}
           .media-php .page-slidewhow_image-thumbnail{display: none;}
           .media-php .project-slidewhow_image-thumbnail{display: none;}
         </style>';
}

add_action('admin_head', 'multi_post_thumbnail_links');