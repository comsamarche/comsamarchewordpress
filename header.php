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

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site grid-10-small-3">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'maudtheme' ); ?></a>

	<header id="masthead" class="site-header col-all grid">
		<div class="site-branding">
			<?php
			//the_custom_logo();
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

		</div><!-- .site-branding -->

		<div class="header-info">

			<p class="h5-like">ADRESSE DU CABINET</p>
			<?php if( get_theme_mod( 'address' )!=='' ): ?>
						<p class="coord-address"><?php echo get_theme_mod( 'address' ); ?></p>
			<?php endif; ?>

		</div>
		<div class="header-phone">
			<?php if( get_theme_mod( 'phone' )!=='' ): ?>
					<p class="coord-phone"><?php echo get_theme_mod( 'phone' ); ?></p>
			<?php endif; ?>
		</div>

	</header><!-- #masthead -->

	<nav id="site-navigation" class="main-navigation col-all">
		<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'maudtheme' ); ?></button>
		<?php
			wp_nav_menu( array(
				'theme_location' => 'menu-1',
				'menu_id'        => 'primary-menu',
				'menu_class'	 => 'flex-container'
			) );
		?>
	</nav><!-- #site-navigation -->

	<div id="content" class="site-content col-all">
