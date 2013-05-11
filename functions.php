<?php
define('THEME_VERSION', '0.1');

// Creates absolute url "/wp-content/themes/~themename/" for use in templates
define('ABSURL', str_replace($_SERVER['DOCUMENT_ROOT'], '', TEMPLATEPATH) . '/');

// Define file path to our includes directory
define('INCLUDEPATH', dirname(realpath(__FILE__)) . '/inc/');

// add all theme function files to be included
$includeFiles = array(
	'theme', 
	'meta', 
	'content',
	'widgets',
	'shortcodes',
	'post-types'
);

// include each of our theme function files
foreach ($includeFiles as $file) {
	$file = INCLUDEPATH . 'functions/' . $file . '.php';

	if (is_file($file)) {
		require_once($file);
	}
}

?>