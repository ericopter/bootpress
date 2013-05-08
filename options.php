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
	
	$optionsArr = array(
		'global' => array(
			'color-scheme' => array(
				'blue-grey' => 'Blue/Grey (Default)',
				'black-red' => 'Black/Red',
				'dev' 		=> 'Development',
			),
			'site-width' => array(
				'960' 		=> '960px',
				'1120' 		=> '1120px',
			),
			'site-layout' => array(
				'full' 		=> $imagepath . 'option-layout-full.png',
				'framed' 	=> $imagepath . 'option-layout-framed.png',
			),
			'sidebar-position' => array(
				'right' 	=> $imagepath . '2cr.png',
				'left' 		=> $imagepath . '2cl.png',
			),
		),
		'global-color-type' => array(
			'general' => array(
				
			),
			'links' => array(
				
			),
			'headings' => array(
				
			)
		),
		'header' => array(
			
		),
		'navigation' => array(
			
		),
		'content' => array(
			
		),
		'footer' => array(
			'text' => '<a href="http://www.echowebdynamics.com">Theme By EchoWebDynamics.com</a>'
		),
		'slideshow' => array(
			'display' => 1,
			'home-width' => array(
				'full' => 'Full Width',
				'framed' => 'Framed'
			),
			'delay' => 6,
			'speed' => 6,
			'effect' => 'fading',
			'direction' => 'horizontal',
			'direction-reverse' => 0,
			'navigation' => 1,
			'pagination' => 1,
			'keyboard' => 1
		),
		'contact' => array(
			'recaptcha' => array(
				'theme' => 'clean'
			)
		),
		'meta-data' => array(
			
		)
	);
	
	$defaults = array(
		'global' => array(
			'color-scheme' 		=> 'blue-grey',
			'site-width' 		=> '960',
			'site-layout' 		=> 'full',
			'sidebar-position' 	=> 'right',
			'frame-shadow'		=> '1',
			'frame-shadow-color'=> '#999999',
			'frame-shadow-size'	=> '4',
			'frame-border'		=> '#cccccc',
			'global-custom'		=> '0'
		),
		'header' => array(
			'custom-background'	=> '0',
			'custom-text'		=> '0'
		),
		'footer-copy' 		=> '<a href="http://www.echowebdynamics.com">Theme By EchoWebDynamics.com</a>',
		'typo-general' => array(
			'size' => '16px',
			'face' => 'helvetica',
			'style' => 'normal',
			'color' => '#333333' 
		),
		'typo-general-links' => array(
			'color' => '#2A63A6'
		),
		'slideshow' => array(
			'display' => 1,
			'home-width' => 'framed',
			'delay' => 6,
			'speed' => 6,
			'effect' => 'fading',
			'direction' => 'horizontal',
			'direction-reverse' => 0,
			'navigation' => 1,
			'pagination' => 1,
			'keyboard' => 1
		),
		'recaptcha' => array(
			'theme' => 'clean'
		)
	);
/////////////////////////////////////////////////////////////////////////////////////////////	
	$options = array();
	
/*
	boilerplate
	
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
	 Global Options
	******************************************************/
	
	// $options[] = array(
	// 	'name' => __('Global Settings', 'echotheme'),
	// 	'type' => 'heading'
	// );
	// 
	// $options[] = array(
	// 	'name' 	=> __('Wireframe', 'echotheme'),
	// 	'desc'	=> __('Show primary layout elements wireframe for design purposes?', 'echotheme'),
	// 	'type' 	=> 'checkbox',
	// 	'id' 	=> 'site-wireframe',
	// 	'std'	=> '0',
	// );
	// 
	// $options[] = array(
	// 	'name' 	=> __('Color Scheme', 'echotheme'),
	// 	'desc'	=> __('Pick your sites default color Scheme', 'echotheme'),
	// 	'type' 	=> 'radio',
	// 	'id' 	=> 'color-scheme',
	// 	'options' => $optionsArr['global']['color-scheme'],
	// 	'std' 	=> $defaults['global']['color-scheme']
	// 	
	// );
	// 
	// $options[] = array(
	// 	'name' 	=> __('Site Content Area Width', 'echotheme'),
	// 	'desc'	=> __('Choose the site content width area for your site', 'echotheme'),
	// 	'type' 	=> 'radio',
	// 	'id' 	=> 'site-width',
	// 	'options' => $optionsArr['global']['site-width'],
	// 	'std'	=> $defaults['global']['site-width'],
	// 	
	// );
	// 
	// $options[] = array(
	// 	'name' 	=> __('Sidebar Position', 'echotheme'),
	// 	'desc'	=> __('Choose which side your sites sidebar will appear on', 'echotheme'),
	// 	'type' 	=> 'images',
	// 	'id' 	=> 'sidebar-position',
	// 	'options' => $optionsArr['global']['sidebar-position'],
	// 	'std'	=> $defaults['global']['sidebar-position'],
	// );
	// 
	// $options[] = array(
	// 	'name' 	=> __('Site Layout Display', 'echotheme'),
	// 	'desc'	=> __('Choose between full width layout or a framed/boxed layout', 'echotheme'),
	// 	'type' 	=> 'images',
	// 	'id' 	=> 'site-layout',
	// 	'options' => $optionsArr['global']['site-layout'],
	// 	'std'	=> $defaults['global']['site-layout'],
	// 	
	// );
	// 
	// $options[] = array(
	// 	'name' 	=> __('Add Box Shadow to Framed Layout', 'echotheme'),
	// 	'desc'	=> __('Check this box if you would like to add a CSS box shadow to the frame/box layout', 'echotheme'),
	// 	'type' 	=> 'checkbox',
	// 	'id' 	=> 'frame-shadow',
	// 	'std'	=> $defaults['global']['frame-shadow'],
	// );
	// 
	// $options[] = array(
	// 	'name' 	=> __('Box Shadow Color', 'echotheme'),
	// 	'desc'	=> __('Enter the box shadow color', 'echotheme'),
	// 	'type' 	=> 'color',
	// 	'id' 	=> 'frame-shadow-color',
	// 	'std'	=> $defaults['general']['frame-shadow-color'],
	// );
	// 
	// $options[] = array(
	// 	'name' 	=> __('Box Shadow Size', 'echotheme'),
	// 	'desc'	=> __('Enter the size in pixels of the shadow spread', 'echotheme'),
	// 	'type' 	=> 'text',
	// 	'id' 	=> 'frame-shadow-size',
	// 	'std'	=> $defaults['general']['frame-shadow-size'],
	// 	'class'	=> 'mini'
	// );
	// 
	// $options[] = array(
	// 	'name' 	=> __('Add border to framed layout', 'echotheme'),
	// 	'desc'	=> __('Select the color of the border you want surrounding framed content', 'echotheme'),
	// 	'type' 	=> 'color',
	// 	'id' 	=> 'frame-border',
	// 	'std'	=> $defaults['global']['frame-border']
	// );
	// 
	// $options[] = array(
	// 	'name' 	=> __('Override Theme Body/Wrapper Background?', 'echotheme'),
	// 	'desc'	=> __('Check this box to override the selected themes body and content wrapper backgrounds', 'echotheme'),
	// 	'type' 	=> 'checkbox',
	// 	'id' 	=> 'global-custom-background',
	// 	'std'	=> $defaults['global']['global-custom'],
	// );
	// 
	// $options[] = array(
	// 	'name' 	=> __('Body Background', 'echotheme'),
	// 	'desc'	=> __('Site Body Background', 'echotheme'),
	// 	'type' 	=> 'background',
	// 	'id' 	=> 'body-background',
	// );
	// 
	// $options[] = array(
	// 	'name' 	=> __('Wrapper Background', 'echotheme'),
	// 	'desc'	=> __('Outer content wrapper background', 'echotheme'),
	// 	'type' 	=> 'background',
	// 	'id' 	=> 'wrapper-background',
	// );
	// 
	// $options[] = array(
	// 	'name' 	=> __('Override Theme Global Text Properties?', 'echotheme'),
	// 	'desc'	=> __('Check this box to override the selected themes global text properties', 'echotheme'),
	// 	'type' 	=> 'checkbox',
	// 	'id' 	=> 'global-custom-text',
	// 	'std'	=> $defaults['global']['global-custom'],
	// );
	// 
	// $options[] = array(
	// 	'name' 	=> __('Global Headings', 'echotheme'),
	// 	'desc'	=> __('Set the global Heading characteristics for the site', 'echotheme'),
	// 	'type' 	=> 'typography',
	// 	'id' 	=> 'global-text-headings',
	// 	// 'std'	=> $defaults['typo-general-links'],
	// 	// 'options' => $defaults['typo-general-links']
	// );
	// 
	// $options[] = array(
	// 	'name' 	=> __('Global Text', 'echotheme'),
	// 	'desc'	=> __('Set your sites global font characteristics', 'echotheme'),
	// 	'type' 	=> 'typography',
	// 	'id' 	=> 'global-text',
	// 	// 'std'	=> $defaults['typo-general'],
	// 	// 'options' => $defaults['typo-general']
	// );
	// 
	// $options[] = array(
	// 	'name' 	=> __('Global Links', 'echotheme'),
	// 	'desc'	=> __('Set the global link characteristics for the site', 'echotheme'),
	// 	'type' 	=> 'typography',
	// 	'id' 	=> 'global-text-links',
	// 	// 'std'	=> $defaults['typo-general-links'],
	// 	// 'options' => $defaults['typo-general-links']
	// );
	// 
	// $options[] = array(
	// 	'name' 	=> __('Global Links (hover)', 'echotheme'),
	// 	'desc'	=> __('Set the global link hover characteristics for the site', 'echotheme'),
	// 	'type' 	=> 'typography',
	// 	'id' 	=> 'global-text-links-hover',
	// 	// 'std'	=> $defaults['typo-general-links'],
	// 	// 'options' => $defaults['typo-general-links']
	// );
	// 
	
	
	
	
	
	/******************************************************
	 Header Options
	******************************************************/
	
	// $options[] = array(
	// 	'name' => __('Header', 'echotheme'),
	// 	'type' => 'heading'
	// );
	// 
	// $options[] = array(
	// 	'name' 	=> __('Site Logo', 'echotheme'),
	// 	'desc'	=> __('Upload a custom logo for your site', 'echotheme'),
	// 	'type' 	=> 'upload',
	// 	'id' 	=> 'site-logo'
	// );
	// 
	// $options[] = array(
	// 	'name' 	=> __('Modify Theme Header Background', 'echotheme'),
	// 	'desc'	=> __('Check this box to customize the Headers background properties', 'echotheme'),
	// 	'type' 	=> 'checkbox',
	// 	'id' 	=> 'header-custom-background',
	// 	'std'	=> $defaults['header']['custom-background'],
	// );
	// 
	// $options[] = array(
	// 	'name' 	=> __('Header Background', 'echotheme'),
	// 	'desc'	=> __('Site Header Background', 'echotheme'),
	// 	'type' 	=> 'background',
	// 	'id' 	=> 'header-background',
	// );
	// 
	// $options[] = array(
	// 	'name' 	=> __('Modify Theme Header Links', 'echotheme'),
	// 	'desc'	=> __('Check this box to customize the Headers background properties', 'echotheme'),
	// 	'type' 	=> 'checkbox',
	// 	'id' 	=> 'header-custom-text',
	// 	'std'	=> $defaults['header']['custom-text'],
	// );
	// 
	// $options[] = array(
	// 	'name' 	=> __('Header Links', 'echotheme'),
	// 	'desc'	=> __('Set the global link characteristics for the site', 'echotheme'),
	// 	'type' 	=> 'typography',
	// 	'id' 	=> 'header-text-links',
	// 	// 'std'	=> $defaults['typo-general-links'],
	// );
	// 
	// $options[] = array(
	// 	'name' 	=> __('Header Links (Hover)', 'echotheme'),
	// 	'desc'	=> __('Set the global link characteristics for the site', 'echotheme'),
	// 	'type' 	=> 'typography',
	// 	'id' 	=> 'header-text-links-hover',
	// 	// 'std'	=> $defaults['typo-general-links'],
	// );
	// 
	
	
	/******************************************************
	 Navigation Options
	******************************************************/
	
	// $options[] = array(
	// 	'name' => __('Navigation', 'echotheme'),
	// 	'type' => 'heading'
	// );
	// 
	// $options[] = array(
	// 	'name' 	=> __('Navigation Bar Background', 'echotheme'),
	// 	'desc'	=> __('Site Header Background', 'echotheme'),
	// 	'type' 	=> 'background',
	// 	'id' 	=> 'navigation-background',
	// );
	
	
	
	/******************************************************
	 Content Options
	******************************************************/
	
	// $options[] = array(
	// 	'name' => __('Content', 'echotheme'),
	// 	'type' => 'heading'
	// );
	// 
	// $options[] = array(
	// 	'name' 	=> __('Content Background', 'echotheme'),
	// 	'desc'	=> __('Site Content Background', 'echotheme'),
	// 	'type' 	=> 'background',
	// 	'id' 	=> 'content-background',
	// );
	// 
	
	
	/******************************************************
	 Footer Options
	******************************************************/
	
	// $options[] = array(
	// 	'name' => __('Footer', 'echotheme'),
	// 	'type' => 'heading'
	// );
	// 
	// $options[] = array(
	// 	'name' 	=> __('Footer Background', 'echotheme'),
	// 	'desc'	=> __('Site Footer Background', 'echotheme'),
	// 	'type' 	=> 'background',
	// 	'id' 	=> 'footer-background',
	// );
	// 
	// $options[] = array(
	// 	'name' 	=> __('Custom Footer Text Settings', 'echotheme'),
	// 	'desc'	=> __('Check the box to override the theme footer text settings', 'echotheme'),
	// 	'type' 	=> 'checkbox',
	// 	'id' 	=> 'footer-custom-text',
	// 	'std'	=> '0'
	// );
	// 
	// $options[] = array(
	// 	'name' 	=> __('Footer Text', 'echotheme'),
	// 	'desc'	=> __('Set the footer text characteristics', 'echotheme'),
	// 	'type' 	=> 'typography',
	// 	'id' 	=> 'footer-text-general',
	// 	// 'std'	=> $defaults['typo-general-links'],
	// 	// 'options' => $defaults['typo-general-links']
	// );
	// 
	// $options[] = array(
	// 	'name' 	=> __('Footer Links', 'echotheme'),
	// 	'desc'	=> __('Set the Footer link characteristics', 'echotheme'),
	// 	'type' 	=> 'typography',
	// 	'id' 	=> 'footer-text-links',
	// 	// 'std'	=> $defaults['typo-general-links'],
	// 	// 'options' => $defaults['typo-general-links']
	// );
	// 
	// $options[] = array(
	// 	'name' 	=> __('Footer Links (Hover)', 'echotheme'),
	// 	'desc'	=> __('Set the Footer link hover characteristics', 'echotheme'),
	// 	'type' 	=> 'typography',
	// 	'id' 	=> 'footer-text-links-hover',
	// 	// 'std'	=> $defaults['typo-general-links'],
	// 	// 'options' => $defaults['typo-general-links']
	// );
	// 
	// $options[] = array(
	// 	'name' 	=> __('Footer Copy', 'echotheme'),
	// 	'desc'	=> __('Add your "Footer" text here', 'echotheme'),
	// 	'type' 	=> 'textarea',
	// 	'id' 	=> 'footer-copy',
	// 	'std'	=> $defaults['footer-copy'],
	// );
	
	
	
	/******************************************************
	 Slideshow Options
	******************************************************/
	
	// $options[] = array(
	// 	'name' => __('Slideshow', 'options_framework_theme'),
	// 	'type' => 'heading'
	// );
	// 
	// $options[] = array(
	// 	'name' 	=> __('Enable Homepage Slideshow', 'echotheme'),
	// 	'desc'	=> __('Check button to enable homepage slideshow', 'echotheme'),
	// 	'type' 	=> 'checkbox',
	// 	'id' 	=> 'slideshow-display',
	// 	'std'	=> $defaults['slideshow']['display']
	// );
	// 
	// $options[] = array(
	// 	'name' 	=> __('Homepage Slideshow Width', 'echotheme'),
	// 	'desc'	=> __('Do you want the slideshow full screen width or to match the content width?', 'echotheme'),
	// 	'type' 	=> 'radio',
	// 	'id' 	=> 'home-slideshow-width',
	// 	'std'	=> $defaults['slideshow']['home-width'],
	// 	'options' => $optionsArr['slideshow']['home-width']
	// );
	// 
	// $options[] = array(
	// 	'name' 	=> __('Slideshow Transition Effect', 'echotheme'),
	// 	'desc'	=> __('Choose between a fading or sliding transition', 'echotheme'),
	// 	'type' 	=> 'select',
	// 	'id' 	=> 'slideshow-effect',
	// 	'std'	=> $defaults['slideshow']['effect'],
	// 	'class'	=> 'mini',
	// 	'options' => array(
	// 		'fading' => 'Fading',
	// 		'sliding' => 'Sliding'
	// 	)
	// );
	// 
	// $options[] = array(
	// 	'name' 	=> __('Slideshow Direction', 'echotheme'),
	// 	'desc'	=> __('Direction of sliding movement (for "Sliding" type transition only)', 'echotheme'),
	// 	'type' 	=> 'select',
	// 	'id' 	=> 'slideshow-direction',
	// 	'std'	=> $defaults['slideshow']['direction'],
	// 	'class'	=> 'mini',
	// 	'options' => array(
	// 		'horizontal' => 'Horizontal',
	// 		'vertical' => 'Vertical'
	// 	)
	// );
	// 
	// $options[] = array(
	// 	'name' 	=> __('Reverse Sliding Direction', 'echotheme'),
	// 	'desc'	=> __('Check this box to reverse the default direction of the slide movement', 'echotheme'),
	// 	'type' 	=> 'checkbox',
	// 	'id' 	=> 'slideshow-direction-reverse',
	// 	'std'	=> $defaults['slideshow']['direction-reverse']
	// );
	// 
	// $options[] = array(
	// 	'name' 	=> __('Slideshow Speed', 'echotheme'),
	// 	'desc'	=> __('Delay in seconds to change slides', 'echotheme'),
	// 	'type' 	=> 'select',
	// 	'id' 	=> 'slideshow-delay',
	// 	'std'	=> $defaults['slideshow']['delay'],
	// 	'class'	=> 'mini',
	// 	'options' => array(
	// 		1 => '1 Second',
	// 		2 => '2 Seconds',
	// 		3 => '3 Seconds',
	// 		4 => '4 Seconds',
	// 		5 => '5 Seconds',
	// 		6 => '6 Seconds',
	// 		7 => '7 Seconds',
	// 		8 => '8 Seconds',
	// 		9 => '9 Seconds',
	// 		10 => '10 Seconds',
	// 	)
	// );
	// 
	// $options[] = array(
	// 	'name' 	=> __('Animation Speed', 'echotheme'),
	// 	'desc'	=> __('Time for animation transition effect to occur', 'echotheme'),
	// 	'type' 	=> 'select',
	// 	'id' 	=> 'slideshow-speed',
	// 	'std'	=> $defaults['slideshow']['speed'],
	// 	'class'	=> 'mini',
	// 	'options' => array(
	// 		1 => '.1 Second',
	// 		2 => '.2 Seconds',
	// 		3 => '.3 Seconds',
	// 		4 => '.4 Seconds',
	// 		5 => '.5 Seconds',
	// 		6 => '.6 Seconds',
	// 		7 => '7 Seconds',
	// 		8 => '.8 Seconds',
	// 		9 => '.9 Seconds',
	// 		10 => '1.0 Seconds',
	// 		11 => '1.1 Seconds',
	// 		12 => '1.2 Seconds',
	// 		13 => '1.3 Seconds',
	// 		14 => '1.4 Seconds',
	// 		15 => '1.5 Seconds',
	// 	)
	// );
	// 
	// $options[] = array(
	// 	'name' 	=> __('Slideshow Pagination', 'echotheme'),
	// 	'desc'	=> __('Check to show navigation links for each slide in the show', 'echotheme'),
	// 	'type' 	=> 'checkbox',
	// 	'id' 	=> 'slideshow-pagination',
	// 	'std'	=> $defaults['slideshow']['pagination'],
	// );
	// 
	// $options[] = array(
	// 	'name' 	=> __('Slideshow Navigation', 'echotheme'),
	// 	'desc'	=> __('Check to show prev/next buttons for the slideshow', 'echotheme'),
	// 	'type' 	=> 'checkbox',
	// 	'id' 	=> 'slideshow-navigation',
	// 	'std'	=> $defaults['slideshow']['navigation'],
	// );
	// 
	// $options[] = array(
	// 	'name' 	=> __('Slideshow Keyboard Navigation', 'echotheme'),
	// 	'desc'	=> __('Check to allow navigating prev/next slides with keyboard arrow keys', 'echotheme'),
	// 	'type' 	=> 'checkbox',
	// 	'id' 	=> 'slideshow-keyboard',
	// 	'std'	=> $defaults['slideshow']['keyboard'],
	// );
	
	
	
	/******************************************************
	 Contact Page Options
	******************************************************/
	// $options[] = array(
	// 	'name'	=> __('Contact', 'echotheme'),
	// 	'type'	=> 'heading'
	// );
	// 
	// $options[] = array(
	// 	'name' 	=> __('Email Recipients', 'echotheme'),
	// 	'desc'	=> __('Please enter recipient\'s email address, comma-separate multiple recipients', 'echotheme'),
	// 	'type' 	=> 'textarea',
	// 	'id' 	=> 'email-recipients',
	// );
	// 
	// $options[] = array(
	// 	'name' 	=> __('Add reCAPTCHA', 'echotheme'),
	// 	'desc'	=> __(' Add ReCAPTCHA to the email form for extra security. <a href="http://www.google.com/recaptcha">reCAPTCHA Site</a>', 'echotheme'),
	// 	'type' 	=> 'checkbox',
	// 	'id' 	=> 'use-recaptcha',
	// );
	// 
	// $options[] = array(
	// 	'name' 	=> __('reCAPTCHA Public Key', 'echotheme'),
	// 	'desc'	=> __('Your reCAPTCHA public key', 'echotheme'),
	// 	'type' 	=> 'text',
	// 	'id' 	=> 'recaptcha-public-key',
	// );
	// 
	// $options[] = array(
	// 	'name' 	=> __('reCAPTCHA Private Key', 'echotheme'),
	// 	'desc'	=> __('Your reCAPTCHA private key', 'echotheme'),
	// 	'type' 	=> 'text',
	// 	'id' 	=> 'recaptcha-private-key',
	// );
	// 
	// $options[] = array(
	// 	'name' 	=> __('reCAPTCHA Theme', 'echotheme'),
	// 	'desc'	=> __('Choose reCAPTCHA them', 'echotheme'),
	// 	'type' 	=> 'select',
	// 	'id' 	=> 'recaptcha-theme',
	// 	'std'	=> $defaults['recaptcha']['theme'],
	// 	'class'	=> 'mini',
	// 	'options' => array(
	// 		'white' => 'White', 
	// 		'red' => 'Red',
	// 		'blackglass' => 'Black Glass',
	// 		'clean' => 'Clean'
	// 	)
	// );
	
	/******************************************************
	 Meta Data Options
	******************************************************/
	// $options[] = array(
	// 	'name'	=> __('Meta Data', 'echotheme'),
	// 	'type'	=> 'heading'
	// );
	// 
	// $options[] = array(
	// 	'name' 	=> __('Meta Description', 'echotheme'),
	// 	'desc'	=> __('Enter your site meta description', 'echotheme'),
	// 	'type' 	=> 'textarea',
	// 	'id' 	=> 'meta-description',
	// );
	// 
	// $options[] = array(
	// 	'name' 	=> __('Meta Keywords', 'echotheme'),
	// 	'desc'	=> __('Enter your sites meta keywords (comma separated)', 'echotheme'),
	// 	'type' 	=> 'textarea',
	// 	'id' 	=> 'meta-keywords',
	// );
	// 
	// $options[] = array(
	// 	'name' 	=> __('Google Analytics', 'echotheme'),
	// 	'desc'	=> __('Paste in your google analytics code (Script tag not required)', 'echotheme'),
	// 	'type' 	=> 'textarea',
	// 	'id' 	=> 'google-analytics',
	// );

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

	/*
		Global Options
	*/
	
	// framed layout box default display
	if ($('#section-site-layout .of-radio-img-radio:checked').val() == 'framed') {
		$('[id^=section-frame]').show();
	} else {
		$('[id^=section-frame]').hide();
	}
	
	// event responder from layout_framed click, need both of following due to complex image elements
	$('#site-layout_framed').nextAll('img').first().click(function() {
		$('[id^=section-frame]').slideDown(400);
		
		// show hide frame shadow options
		if ($('#frame-shadow').is(':checked')) {
			$('#section-frame-shadow-color').show();
			$('#section-frame-shadow-size').show();
		} else {
			$('#section-frame-shadow-color').hide();
			$('#section-frame-shadow-size').hide();
		}
	})
	// event responder from layout_full click, need both of following due to complex image elements
	$('#site-layout_full').nextAll('img').first().click(function() {
		$('[id^=section-frame]').slideUp(400);
	});
	
	
	// show hide frame shadow options
	if ($('#frame-shadow').is(':checked')) {
		$('#section-frame-shadow-color').show();
		$('#section-frame-shadow-size').show();
	} else {
		$('#section-frame-shadow-color').hide();
		$('#section-frame-shadow-size').hide();
	}
	// respond to frame shadow click
	$('#frame-shadow').click(function() {
		$('#section-frame-shadow-color').slideToggle();
		$('#section-frame-shadow-size').slideToggle();
	});
	
	
	// show hide custom background options
	if ($('#global-custom-background').is(':checked')) {
		$('#section-body-background, #section-wrapper-background').show();
	} else {
		$('#section-body-background, #section-wrapper-background').hide();
	}
	
	$('#global-custom-background').click(function() {
		$('#section-body-background').slideToggle();
		$('#section-wrapper-background').slideToggle();
	});
	
	// show hide custom text options
	if ($('#global-custom-text').is(':checked')) {
		$('#section-global-text-headings').show();
		$('#section-global-text').show();
		$('#section-global-text-links').show();
		$('#section-global-text-links-hover').show();
	} else {
		$('#section-global-text-headings').hide();
		$('#section-global-text').hide();
		$('#section-global-text-links').hide();
		$('#section-global-text-links-hover').hide();
	}
	
	$('#global-custom-text').click(function() {
		$('#section-global-text-headings').slideToggle();
		$('#section-global-text').slideToggle();
		$('#section-global-text-links').slideToggle();
		$('#section-global-text-links-hover').slideToggle();
	});
	
	/*
		Header Options
	*/
	
	// show hide custom background options
	if ($('#header-custom-background').is(':checked')) {
		$('#section-header-background').show();
	} else {
		$('#section-header-background').hide();
	}
	
	$('#header-custom-background').click(function() {
		$('#section-header-background').slideToggle();
	});
	
	// show hide custom text options
	if ($('#header-custom-text').is(':checked')) {
		$('#section-header-text-links').show();
		$('#section-header-text-links-hover').show();
	} else {
		$('#section-header-text-links').hide();
		$('#section-header-text-links-hover').hide();
	}
	
	$('#header-custom-text').click(function() {
		$('#section-header-text-links').slideToggle();
		$('#section-header-text-links-hover').slideToggle();
	});
	
	/*
		Slideshow Options
	*/
	if ($('#slideshow-effect').val() == 'fading') {
		$('#section-slideshow-direction').hide();
		$('#section-slideshow-direction-reverse').hide();
	} else {
		$('#section-slideshow-navigation').hide();
		
	}
	
	$('#slideshow-effect').change(function() {
		$('#section-slideshow-direction').slideToggle();
		$('#section-slideshow-direction-reverse').slideToggle();
		$('#section-slideshow-navigation').slideToggle();
	});
	
	/*
		Recaptcha Options
	*/
	if ($('#use-recaptcha:checked').val() !== undefined) {
		$('#section-recaptcha-public-key').show();
		$('#section-recaptcha-private-key').show();
		$('#section-recaptcha-theme').show();
	} else {
		$('#section-recaptcha-public-key').hide();
		$('#section-recaptcha-private-key').hide();
		$('#section-recaptcha-theme').hide();
	}
	
	$('#use-recaptcha').click(function() {
		$('#section-recaptcha-public-key').slideToggle(400);
		$('#section-recaptcha-private-key').slideToggle(400);
		$('#section-recaptcha-theme').slideToggle(400);
	});
	
	
	// Footer Text
	if ($('#footer-custom-text').is(':checked')) {
		$('[id*="section-footer-text"]').show();
	} else {
		$('[id*="section-footer-text"]').hide();
	}
	
	$('#footer-custom-text').click(function() {
		$('[id*="section-footer-text"]').slideToggle();
	})
	
});
</script>

<?php
}