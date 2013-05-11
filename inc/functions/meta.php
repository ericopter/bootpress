<?php
/**
 * remove_wp_headlinks()
 * 
 * Remove unwanter head links from wp_head hook
 */
function echotheme_remove_headlinks()
{
	remove_action('wp_head', 'index_rel_link');
	remove_action('wp_head', 'rsd_link');
	remove_action('wp_head', 'wlwmanifest_link');
	remove_action('wp_head', 'wp_generator');
}

add_action('init', 'echotheme_remove_headlinks');

/**
 * echotheme_title()
 * 
 * generates the title text
 */
function echotheme_title()
{
	/*
	 * Print the <title> tag content based on what is being viewed.
	 */
	global $page, $paged;
	
	$separator = ' - ';

	wp_title( $separator, true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo $separator . $site_description;

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo $separator . sprintf( __( 'Page %s', 'twentyten' ), max( $paged, $page ) );
}

/**
 * echotheme_meta_tags()
 * 
 * Generate the custom meta description/keywords tags for our SEO smart theme
 */
function echotheme_meta_tags()
{
	global $post;
	$description = null;
	$keywords = null;
	
	// if we have theme options and the meta description/keywords value is set
	if (function_exists('of_get_option')) {
		$description = of_get_option('meta-description') ? of_get_option('meta-description') : $description;
		$keywords = of_get_option('meta-keywords') ? of_get_option('meta-keywords') : $keywords;
	}
	
	// if the particular page/post meta description/keyword value is set
	if (function_exists('get_meta_box_value')) {
		$description = get_meta_box_value('_echotheme_meta_description_value') ? get_meta_box_value('_echotheme_meta_description_value') : $description;
		$keywords = get_meta_box_value('_echotheme_meta_keywords_value') ? get_meta_box_value('_echotheme_meta_keywords_value') : $keywords;
	}
	
	
	// if $description isn't null, output meta tag
	if ($description) {
		echo '<meta name="description" content="' . $description . '">' . "\n";
	}
	
	// if $keywords isn't null, output meta tag
	if ($keywords) {
		echo '<meta name="keywords" content="' . $keywords . '">' . "\n";
	}
}

/**
 * echotheme_analytics()
 * 
 * includes analytics code from options panel if exists
 */
function echotheme_analytics()
{
	if (function_exists('of_get_option') && $analytics = of_get_option('google-analytics')) {
?>
<script type="text/javascript"><?php echo $analytics ?></script>
<?php
	}
}

add_action('echotheme_post_wp_head', 'echotheme_analytics');



//////////////////////////////////////////////////////////////
// Functions/hooks for including feature specific assets
/////////////////////////////////////////////////////////////

/**
 * echotheme_pre_wp_head()
 * 
 * Action hook to be called directly before wp_head action
 */
function echotheme_pre_wp_head()
{ 
	// run the hook to add custom stuff at end of head
	do_action('echotheme_pre_wp_head');
}

/**
 * echotheme_post_wp_head()
 * 
 * Action hook to be called after wp_head action
 */
function echotheme_post_wp_head()
{ 
	// run the hook to add custom stuff at end of head
	do_action('echotheme_post_wp_head');
}

/**
 * echotheme_general_javascript()
 * 
 * general javascript files required by all pages
 */
function echotheme_general_javascript()
{
	wp_enqueue_script('bootstrap');
	wp_enqueue_script('general');
}

add_action('wp_enqueue_scripts', 'echotheme_general_javascript');

/**
 * Function for including theme CSS files
 */
function echotheme_general_css()
{ 
	wp_enqueue_style('style');
}

add_action('wp_print_styles', 'echotheme_general_css');


/**
 * Function to load Shadowbox assets
 */
function echotheme_load_shadowbox()
{
	wp_enqueue_style('shadowbox');
	wp_enqueue_script('shadowbox');	
}

/**
 * Function to load isotope assets
 */
function echotheme_load_isotope()
{
	// isotope
	wp_enqueue_script('isotope');
	wp_enqueue_style('isotope');
}
/**
 * Function to load Flexslider assets
 */
function echotheme_load_flexslider()
{
	wp_enqueue_script('flexslider');
	wp_enqueue_style('flexslider');
}
// add_action('echotheme_pre_wp_head', 'echotheme_load_flexslider');

/**
 * function to load jQuery Cycle assets
 */
function echotheme_load_jqueryCycle()
{
	wp_enqueue_style('jquery.cycle');
	wp_enqueue_script('jquery.cycle');
}
// add_action('echotheme_pre_wp_head', 'echotheme_load_jqueryCycle');

/**
 * function to load Nivoslider assets
 */
function echotheme_load_nivoslider()
{
	wp_enqueue_style('nivo.style');
	wp_enqueue_style('nivo.style.default');
	wp_enqueue_script('nivo.script');
}
// add_action('echotheme_pre_wp_head', 'echotheme_load_nivoslider');

//////////////////////////////////////////////////////////////
// Register CSS & Javascript below
/////////////////////////////////////////////////////////////

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
	
	// Bootstrap Responsive
	wp_register_style(
		'bootstrap-responsive', 
		get_template_directory_uri() . '/css/bootstrap-responsive.min.css', 
		array('bootstrap'), 
		THEME_VERSION, 
		'screen'
	);
	
	/*
		Check for options panel setting for site responsiveness
		Will use flag to trigger whether to include responsive stylesheet
	*/
	$themeDep = 'bootstrap';
	if (function_exists('of_get_option') && of_get_option('site-responsive')) {
		$themeDep = 'bootstrap-responsive';
	}
	
	// Theme Base
	wp_register_style(
		'theme', 
		get_template_directory_uri() . '/css/theme.css', 
		array($themeDep), 
		THEME_VERSION, 
		'screen'
	);
	
	/* ** TODO **
		If options panel is active we are checking for the existence of a color theme setting
		This is something that will need further implementation
	*/
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
			get_template_directory_uri() . '/css/options.css.php', 
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
	
	// Superfish Menus
	wp_register_style(
		'superfish', 
		get_template_directory_uri() . '/inc/scripts/superfish/css/superfish.css',
		false,
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
	
	// Isotope
	wp_register_script(
		'isotope', 
		get_template_directory_uri() . '/inc/scripts/isotope/jquery.isotope.min.js', 
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
?>