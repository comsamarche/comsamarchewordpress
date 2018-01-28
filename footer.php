<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package MaudTheme
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer col-all">
		<div class="site-info">

			<?php if( get_theme_mod( 'footer_logo' )!=='' ): ?>
						<img src="<?php echo esc_url( get_theme_mod( 'footer_logo' )) ?>">
			<?php endif; ?>

			<?php if( get_theme_mod( 'footer_titre' )!=='' ): ?>
						<p><?php echo get_theme_mod( 'footer_titre' ); ?></p>
			<?php endif; ?>
			<?php if( get_theme_mod( 'footer_sstitre' )!=='' ): ?>
						<p><?php echo get_theme_mod( 'footer_sstitre' ); ?></p>
			<?php endif; ?>

		</div><!-- .site-info -->

		<div class="site-coord">

			<?php if( get_theme_mod( 'address' )!=='' ): ?>
						<p class="coord-address"><?php echo get_theme_mod( 'address' ); ?></p>
			<?php endif; ?>
			<?php if( get_theme_mod( 'phone' )!=='' ): ?>
						<p class="coord-phone"><?php echo get_theme_mod( 'phone' ); ?></p>
			<?php endif; ?>
			<?php if( get_theme_mod( 'email' )!=='' ): ?>
						<p class="coord-mail"><?php echo get_theme_mod( 'email' ); ?></p>
			<?php endif; ?>

		</div>

		<div class="site-mention">
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'maudtheme' ) ); ?>"><?php
				/* translators: %s: CMS name, i.e. WordPress. */
				printf( esc_html__( 'Proudly powered by %s', 'maudtheme' ), 'WordPress' );
			?></a>
			<span class="sep"> | </span>
			<?php
				/* translators: 1: Theme name, 2: Theme author. */
				printf( esc_html__( 'Theme: %1$s by %2$s.', 'maudtheme' ), 'maudtheme', '<a href="http://www.comsamarche.com">Christine GUINAUDEAU - Comsamarche</a>' );
			?>
		</div>

	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
