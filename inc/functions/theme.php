<?php
/**
 * echotheme_include_files()
 * 
 * Set up and include the different file options
 */
function echotheme_include_files()
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

echotheme_include_files();

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
	add_image_size( 'fours', 200, 150, true );
	add_image_size( 'one-third', 300, 225, true );
	add_image_size( 'two-thirds', 620, 465, true );
	add_image_size( 'slideshow' , 1400, 400, true);
	add_image_size( 'gallery', 720, 405, true);
	
	
	// define the theme menu areas
	register_nav_menus(array( 
		'header-menu' 	=> 'Header Area Menu',
		'top-menu' 		=> 'Top Nav Bar',
		'side-bar-nav'	=> 'Sidebar Navigation',
		'footer-menu'	=> 'Footer Menu'
	));
}

add_action('after_setup_theme', 'echotheme_setup');


/**
 * echotheme_styles()
 * 
 * Register all theme stylesheets
 */
function echotheme_styles()
{
	// Bootstrap
	wp_register_style(
		'bootstrap', 
		get_template_directory_uri() . '/css/bootstrap.min.css', 
		null, 
		THEME_VERSION, 
		'screen'
	);
	
	/*
		Check for options panel setting for site responsiveness
	*/
	// if (function_exists('of_get_option') && of_get_option('site-responsive')) {
		wp_register_style(
			'bootstrap-responsive', 
			get_template_directory_uri() . '/css/bootstrap-responsive.min.css', 
			array('bootstrap'), 
			THEME_VERSION, 
			'screen'
		);
	// }
	
	// Theme
	wp_register_style(
		'theme', 
		get_template_directory_uri() . '/css/theme.css', 
		array('bootstrap'), 
		THEME_VERSION, 
		'screen'
	);
	
	// Check for options panel, get selected color theme and dynamic stylesheet
	if (function_exists('of_get_option')) {
		
		$color_scheme = of_get_option('color-scheme') ? of_get_option('color-scheme') . '.css' : 'default.css';
		
		// selected option theme
		wp_register_style(
			'color-theme', 
			get_template_directory_uri() . '/css/themes/' . $color_scheme, 
			array('theme'), 
			THEME_VERSION, 
			'screen'
		);
		
		// dynamics style sheet for options panel options
		wp_register_style(
			'options', 
			get_template_directory_uri() . '/css/custom_style.php', 
			array('style'), 
			THEME_VERSION, 
			'screen'
		);
		
	} else { // include default theme cile
		
		wp_register_style(
			'color-theme', 
			get_template_directory_uri() . '/css/themes/default.css', 
			array('theme'), 
			THEME_VERSION, 
			'screen'
		);
		
	}
	
	// Wordpress StyleSheet
	wp_register_style(
		'style', 
		get_template_directory_uri() . '/style.css', 
		array('theme'), 
		THEME_VERSION, 
		'screen'
	);
	
	// Superfish
	wp_register_style(
		'superfish', 
		get_template_directory_uri() . '/inc/scripts/superfish/css/superfish.css',
		false,
		THEME_VERSION,
		'screen'
	);
	
	// Flexslider
	wp_register_style(
		'flexslider', 
		get_template_directory_uri() . '/inc/scripts/flexslider/flexslider.css',
		null,
		THEME_VERSION,
		'screen'
	);
	
	// Isotope
	wp_register_style(
		'isotope', 
		get_template_directory_uri() . '/inc/scripts/isotope/style.css', 
		false, 
		THEME_VERSION, 
		'screen'
	);
	
	// jQuery Cycle
	wp_register_style(
		'jquery.cycle', 
		get_template_directory_uri() . '/inc/scripts/cycle/jquery.cycle.css',
		null,
		THEME_VERSION,
		'screen'
	);
	
	// NivoSlider
	wp_register_style(
		'nivo.style', 
		get_template_directory_uri() . '/inc/scripts/nivo-slider/nivo-slider.css',
		null,
		THEME_VERSION,
		'screen'
	);
	wp_register_style(
		'nivo.style.default', 
		get_template_directory_uri() . '/inc/scripts/nivo-slider/themes/default/default.css', 
		array('nivo.style'),
		THEME_VERSION,
		'screen'
	);
	
	// Shadowbox
	wp_register_style(
		'shadowbox', 
		get_template_directory_uri() . '/inc/scripts/shadowbox/shadowbox.css',
		null,
		THEME_VERSION,
		'screen'
	);
}

add_action('after_setup_theme', 'echotheme_styles');


/**
 * echotheme_jquery()
 * 
 * use theme included jQuery file instead of default WP version
 */
function echotheme_jquery() {
	wp_deregister_script('jquery');
	wp_register_script(
		'jquery', 
		get_template_directory_uri() . '/js/jquery-1.7.1.min.js', 
		null ,
		THEME_VERSION
	);
	wp_enqueue_script('jquery');
	
}
add_action('wp_enqueue_scripts', 'echotheme_jquery');

/**
 * echotheme_scripts()
 * 
 * Register all theme javascript files
 */
function echotheme_scripts()
{
	// Bootstrap
	wp_register_script(
		'bootstrap',
		get_template_directory_uri() . '/js/bootstrap.min.js',
		array('jquery'),
		THEME_VERSION
	);
	
	// Easing
	wp_register_script(
		'jquery-easing', 
		get_template_directory_uri() . '/js/jquery.easing.js', 
		array('jquery'), 
		THEME_VERSION
	);
	
	// HoverIntent
	wp_register_script(
		'hoverintent', 
		get_template_directory_uri() . '/inc/scripts/superfish/js/hoverIntent.js', 
		array('jquery'),
		THEME_VERSION
	);
	
	// Superfish
	wp_register_script(
		'superfish', 
		get_template_directory_uri() . '/inc/scripts/superfish/js/superfish.js', 
		array('hoverintent'),
		THEME_VERSION
	);
	
	// Flexslider
	wp_register_script(
		'flexslider', 
		get_template_directory_uri() . '/inc/scripts/flexslider/jquery.flexslider-min.js', 
		array('jquery-easing'),
		THEME_VERSION
	);
	
	// Isotope
	wp_register_script(
		'isotope', 
		get_template_directory_uri() . '/inc/scripts/isotope/jquery.isotope.min.js', 
		array('jquery'),
		THEME_VERSION
	);
	
	// jQuery Cycle
	wp_register_script(
		'jquery.cycle', 
		get_template_directory_uri() . '/inc/scripts/cycle/jquery.cycle.all.js', 
		array('jquery'),
		THEME_VERSION
	);
	
	// NivoSlider
	wp_register_script(
		'nivo.script', 
		get_template_directory_uri() . '/inc/scripts/nivo-slider/jquery.nivo.slider.pack.js', 
		array('jquery'),
		THEME_VERSION
	);
	
	// ShadowBox
	wp_register_script(
		'shadowbox', 
		get_template_directory_uri() . '/inc/scripts/shadowbox/shadowbox.js', 
		array('jquery'),
		THEME_VERSION
	);
	
	// General
	wp_register_script(
		'general', 
		get_template_directory_uri() . '/js/general.js', 
		array('jquery'),
		THEME_VERSION
	);
}

add_action('after_setup_theme', 'echotheme_scripts');




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