<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 */

function optionsframework_option_name() {

	// This gets the theme name from the stylesheet
	$themename = get_option( 'stylesheet' );
	$themename = preg_replace("/\W/", "_", strtolower($themename) );

	$optionsframework_settings = get_option( 'optionsframework' );
	$optionsframework_settings['id'] = $themename;
	update_option( 'optionsframework', $optionsframework_settings );
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 * If you are making your theme translatable, you should replace 'options_framework_theme'
 * with the actual text domain for your theme.  Read more:
 * http://codex.wordpress.org/Function_Reference/load_theme_textdomain
 */

function optionsframework_options() {
	
	// If using image radio buttons, define a directory path
	$imagepath =  get_template_directory_uri() . '/images/options/';
	
	/******************************************************
	* Option options ;)
	******************************************************/
	$optionsArr = array(
		'site' => array(
			'responsive',
			'title-bar',
		),
	);
	
	/******************************************************
	* Defaults
	******************************************************/
	$defaults = array(
		'site' => array(
			'responsive' => 0,
			'title-bar'		=> 0,
		),
	);
/////////////////////////////////////////////////////////////////////////////////////////////	
	$options = array();
	
	/******************************************************
	* Boilerplate
	******************************************************/
/*
	$options[] = array(
		'name' 	=> __('', 'echotheme'),
		'desc'	=> __('', 'echotheme'),
		'type' 	=> '',
		'id' 	=> '',
		'options' => array(),
		'std'	=> '',
		'class'	=> ''
	);
*/
	/******************************************************
	* Site
	******************************************************/
	$options[] = array(
		'name' 	=> __('Site Settings', 'echotheme'),
		'type' 	=> 'heading',
	);
	
	$options[] = array(
		'name' 	=> __('Responsive', 'echotheme'),
		'desc'	=> __('Enable site resizing based on browser width?', 'echotheme'),
		'type' 	=> 'checkbox',
		'id' 	=> 'site-responsive',
		'std'	=> $defaults['site']['responsive'],
	);
	
	$options[] = array(
		'name' 	=> __('Title Bar', 'echotheme'),
		'desc'	=> __('Display page titles in full width bar?', 'echotheme'),
		'type' 	=> 'checkbox',
		'id' 	=> 'site-title-bar',
		'std'	=> $defaults['site']['title-bar'],
	);
	
	/******************************************************
	* Slideshow
	******************************************************/
	
	
	/******************************************************
	* 
	******************************************************/
	return $options;
}

/*
 * This is an example of how to add custom scripts to the options panel.
 * This example shows/hides an option when a checkbox is clicked.
 */

add_action('optionsframework_custom_scripts', 'optionsframework_custom_scripts');

function optionsframework_custom_scripts() { ?>

<script type="text/javascript">
jQuery(document).ready(function($) {
	
});
</script>

<?php
}