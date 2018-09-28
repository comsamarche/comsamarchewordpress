<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package MaudTheme
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<!--HEAD-->
	<?php wp_head(); ?>
	<!--FINHEAD-->
</head>

<body <?php body_class(); ?>>

<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'maudtheme' ); ?></a>

	<header id="masthead" class="site-header">
		<div class="site-branding">
			<!--TITRE-->
			<?php
			if ( is_front_page() ) : ?>
				<h1 class="site-title">
			<?php else : ?>
				<div class="site-title">
			<?php endif; ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
				<strong><?php bloginfo( 'name' ); ?></strong>
			<?php
			$description = get_bloginfo( 'description', 'display' );
			if ( $description || is_customize_preview() ) : ?>
				<span class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></span>
			<?php
			endif; ?>
			</a>
			<?php if ( is_front_page() ) : ?>
				</h1>
			<?php else : ?>
				</div>
			<?php endif; ?>
			<!--FINTITRE-->

		</div>

		<div class="header-info">
			<i class="fi flaticon-placeholder"></i>
			<p class="h5-like">ADRESSE <br/>DU CABINET</p>
			<?php if( get_theme_mod( 'address' )!=='' ): ?>
				<p class="coord-address"><?php echo nl2br(get_theme_mod( 'address' )); ?></p>
			<?php endif; ?>

		</div>

		<?php if( get_theme_mod( 'phone' )!=='' ): ?>
			<a href="tel:<?php echo get_theme_mod( 'phone' ); ?>" class="header-phone">
				<i class="fi flaticon-smartphone"></i>
				<p class="coord-phone"><?php echo get_theme_mod( 'phone' ); ?></p>
			</a>
		<?php endif; ?>


	</header><!-- #masthead -->

	<!--MENU-->
	<nav id="site-navigation" class="main-navigation">
		<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><i class="fas fa-bars"></i></button>

		<?php
			wp_nav_menu( array(
				'theme_location' => 'menu-1',
				'menu_id'        => 'primary-menu',
				'menu_class'	 => 'flex-container'
			) );
		?>

	</nav><!-- #site-navigation -->
	<!--FINMENU-->
