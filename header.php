<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8">
		
		<?php echotheme_meta_tags(); ?>
		<link rel="shortcut icon" href="<?php echo ABSURL; ?>images/favicon.ico" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>
			<?php echotheme_title(); ?>
		</title>
		<?php
		
		// stuff we wanna call before wp_head
		echotheme_pre_wp_head();
		// call the wp_head stuff
		wp_head();
		// stuff we wana call after wp_head
		echotheme_post_wp_head();
		
		?>
	<!-- Website by http://www.echowebdynamics.com -->
	</head>
	<?php
	// build custom body classes
	$bodyClasses = '';
	
	if (function_exists('of_get_option')) {
		$bodyClasses .= of_get_option('site-title-bar') ? 'title-bar ' : null;
	}
	?>
	<body class="<?php echo $bodyClasses; ?>">
			
		<div class="navbar navbar-fixed-top navbar-inverse">
			<div class="navbar-inner">
				<div class="container">
					<button class="btn btn-navbar collapsed" data-target=".nav-collapse" data-toggle="collapse" type="button">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="brand" href="<?php bloginfo('url'); ?>/"><?php bloginfo('name'); ?></a>
					<?php
					// Get the top menu
					$args = array(
						'theme_location' 	=> 'top-menu',
						'echo'				=> false,
						'fallback_cb'		=> false,
						'container'			=> 'div',
						'container_class'	=> 'nav-collapse collapse',
						'menu_id'			=> 'top-bar',
						'menu_class'		=> 'nav',
						'after'				=> '</li><li class="divider-vertical"></li>'
					);
					
					$menu = wp_nav_menu($args);
					if ($menu) {
						echo $menu;
					}
					?>
					
				</div>
			</div>
		</div>
		
		<header id="site-header">
			<div class="container">
				<div class="row">
					<div id="site-branding" class="span6">
						<h1>
							<a href="<?php bloginfo('url'); ?>">
								<?php bloginfo('name'); ?>
							</a>
						</h1>
						<p class="lead">
							<?php bloginfo('description') ?>
						</p>
					</div> <!-- end .span6 -->

					<div class="span6">
						<?php if (is_active_sidebar('sidebar_header')) dynamic_sidebar('sidebar_header');?>
					</div> <!-- end .span6 -->
				</div> <!-- end .row -->
				
			</div>
		</header>
		
		<?php 
		if (is_home() || is_front_page()): 
			get_template_part('part', 'frontpage-slider');
		endif; 
		?>
		
		<?php 
		// display title bar if we have a title
		if ($title = get_the_title()): ?>
		<div id="title-bar">
			<div class="container">
				<h1><?php echo $title; ?></h1>
			</div> <!-- end .container -->
		</div> <!-- end #title-bar -->
		<?php endif; ?>
		
		
		<div id="content-wrapper">
			
			<div class="container">
				
				<div class="row">