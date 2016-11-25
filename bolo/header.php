<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' :'; } ?> <?php bloginfo('name'); ?></title>

		<link href="//www.google-analytics.com" rel="dns-prefetch">
        <link href="<?php echo get_template_directory_uri(); ?>/img/icons/favicon.ico" rel="shortcut icon">
        <link href="<?php echo get_template_directory_uri(); ?>/img/icons/touch.png" rel="apple-touch-icon-precomposed">

		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="<?php bloginfo('description'); ?>">

		<?php wp_head(); ?>
		<script>
        // conditionizr.com
        // configure environment tests
        conditionizr.config({
            assets: '<?php echo get_template_directory_uri(); ?>',
            tests: {}
        });
        </script>

	</head>
	<body <?php body_class(); ?>>

		<!-- wrapper -->
		<div class="wrapper">

			<!-- header -->
			<header class="header clear" role="banner">
	
				<div class="container-fluid">
			 		<nav class="navbar navbar-default">
		      				  <div class="container-fluid">
				          		<div class="navbar-header">
				            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
		              <span class="icon-bar"></span>
		              <span class="icon-bar"></span>
		              <span class="icon-bar"></span>
		            </button>
		            <a class="navbar-brand" href="#">
						<img src="<?php bloginfo('template_directory'); ?>/img/kirael-logo.png" alt="kirael logo" class='logo'>
						<img src="<?php bloginfo('template_directory'); ?>/img/menu.png" alt="kirael logo" class='header_kirael'>
		            </a>
		          </div>

		          <div id="navbar" class="navbar-collapse collapse">
						<?php wp_nav_menu(array(
							'menu'=>'',
							'menu_class'=>'nav navbar-nav navbar-center',
							'walker'=> new wp_bootstrap_navwalker(),
						)); ?>
		          </div><!--/.nav-collapse -->
		        </div><!--/.container-fluid -->
		      </nav>
					<!-- /nav -->
</div>
			</header>
			<!-- /header -->
