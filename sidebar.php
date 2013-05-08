<?php
$args = array(
	'theme_location' 	=> 'side-bar-nav',
	'container'			=> false,
	'menu_id'			=> 'side-nav',
	'menu_class'		=> 'nav nav-list affix side-bar-nav',
	'echo'				=> false,
	'fallback_cb'		=> false
);
$menu = wp_nav_menu($args);
if ($menu) {
	echo $menu;
}
?>