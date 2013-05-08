<?php
/**
 * remove_wp_headlinks()
 * 
 * Remove unnecessary headlinks that screw validation in wp_head hook
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
	 * Print the <title> tag based on what is being viewed.
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
 * echotheme_general_javascript()
 * 
 * general javascript files required by all pages
 */
function echotheme_general_javascript()
{
	wp_enqueue_script('general');
	// wp_enqueue_script('jquery');
	wp_enqueue_script('bootstrap');
}

add_action('wp_enqueue_scripts', 'echotheme_general_javascript');

/**
 * Function for linking to custom css files
 */
function echotheme_general_css()
{ 
	wp_enqueue_style('style');
}

add_action('wp_print_styles', 'echotheme_general_css');

/**
 * Creates action hook to be called directly before wp_head action
 */
function echotheme_pre_wp_head()
{ 
	// run the hook to add custom stuff at end of head
	do_action('echotheme_pre_wp_head');
}

/**
 * Creates action hook to be called directly before closing the head
 */
function echotheme_post_wp_head()
{ 
	// run the hook to add custom stuff at end of head
	do_action('echotheme_post_wp_head');
}


/**
 * Function/hook for adding Shadowbox to a page
 */
function echotheme_load_shadowbox()
{
	wp_enqueue_style('shadowbox');
	wp_enqueue_script('shadowbox');	
}

/**
 * Function to load isotope
 */
function echotheme_load_isotope()
{
	// isotope
	wp_enqueue_script('isotope');
	wp_enqueue_style('isotope');
}
/**
 * Function/hook for adding Slideshow to a page
 */
function echotheme_load_flexslider()
{
	wp_enqueue_script('flexslider');
	wp_enqueue_style('flexslider');
}
// add_action('echotheme_pre_wp_head', 'echotheme_load_flexslider');

function echotheme_load_jqueryCycle()
{
	wp_enqueue_style('jquery.cycle');
	wp_enqueue_script('jquery.cycle');
}
// add_action('echotheme_pre_wp_head', 'echotheme_load_jqueryCycle');

function echotheme_load_nivoslider()
{
	wp_enqueue_style('nivo.style');
	wp_enqueue_style('nivo.style.default');
	wp_enqueue_script('nivo.script');
}
// add_action('echotheme_pre_wp_head', 'echotheme_load_nivoslider');

function echotheme_analytics()
{
	if (function_exists('of_get_option') && $analytics = of_get_option('google-analytics')) {
?>
<script type="text/javascript"><?php echo $analytics ?></script>
<?php
	}
}

add_action('echotheme_post_wp_head', 'echotheme_analytics');
?>