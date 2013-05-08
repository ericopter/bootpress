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
	<body>
			
		<div class="navbar navbar-fixed-top navbar-inverse">
			
			<div class="navbar-inner">
				
				<div class="container">
					
					<button class="btn btn-navbar collapsed" data-target=".nav-collapse" data-toggle="collapse" type="button">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="brand" href="/bootpress">BootPress</a>
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
		
		<header id="site-head" class="">
			<div class="container">
				<h1><?php the_title(); ?></h1>
			</div>
		</header>

		<div id="content-wrapper">
			
			<div class="container">
				
				<div class="row">