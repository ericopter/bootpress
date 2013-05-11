<?php
$menu_class = 'nav nav-list side-bar-nav';

$menu_class .= of_get_option('site-sidebar-fixed') ? ' affix' : null;

$args = array(
	'theme_location' 	=> 'side-bar-nav',
	'container'			=> false,
	'menu_id'			=> 'side-nav',
	'menu_class'		=> $menu_class,
	'echo'				=> false,
	'fallback_cb'		=> false
);

$menu = wp_nav_menu($args);

if ($menu) {
	echo $menu;
}

if (of_get_option('site-sidebar-fixed')) :
?>
<script type="text/javascript">
	$(document).ready(function() {
		// calculate distance from top
		var topHeight = $('#site-header').outerHeight();
		var bottomHeight = $('#site-footer').outerHeight();

		if ($('#title-bar:visible')) {
			topHeight += $('#title-bar').outerHeight();
		};

		$('#side-nav').affix({
			offset: {
				top : topHeight,
				bottom : bottomHeight
			}
		});
	});
</script>
<?php
endif;
?>