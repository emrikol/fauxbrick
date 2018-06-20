<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package fauxbrick
 */
?><!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?> prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb#"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8 ie7" <?php language_attributes(); ?> prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb#"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9 ie8" <?php language_attributes(); ?> prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb#"> <![endif]-->
<!--[if IE 9]>         <html class="no-js ie9" <?php language_attributes(); ?> prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb#"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js" <?php language_attributes(); ?> prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb#"> <!--<![endif]-->
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<link rel="pingback" href="<?php echo esc_attr( get_bloginfo( 'pingback_url' ) ); ?>">

		<?php wp_head(); ?>
	</head>

	<body <?php body_class(); ?>>
		<div id="page" class="hfeed site">
			<div class="container">
				<div class="row">
					<div class="col-xs-12">
						<header id="masthead" class="site-header" role="banner">
							<div class="jumbotron">
								<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'fauxbrick' ); ?></a>

								<div class="site-branding">
									<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></a></h1>
									<h2 class="site-description"><?php echo esc_html( get_bloginfo( 'description' ) ); ?></h2>
								</div><!-- .site-branding -->

								<nav id="site-navigation" class="main-navigation" role="navigation">
									<!-- button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'fauxbrick' ); ?></button -->
									<?php // wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
								</nav><!-- #site-navigation -->
							</div>
						</header><!-- #masthead -->
					</div>
				</div>
			</div>
			<div id="content" class="site-content">
