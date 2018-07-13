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

	<footer id="colophon" class="site-footer col-all">

		<div class="site-form">
			<div class="flex-container">
				<blockquote class="flex-item-fluid">
					<h2>
					Prendre rendez-vous<br/>
					avec votre podologue</h2>
					<p>
					Maud Chenut-Briotet <br/>
					vous reçoit à son cabinet<br/>
					de 8h à 19h <br/>
					au 33 Rue de la Libération<br/>
					21240 Talant</p>
					<p>	Consultations uniquement sur rendez-vous<br/>
					<a href="tel:0380590775"><strong>Tél : 03 80 59 07 75</strong></a>
				</p>
				</blockquote>
				<div id="map"></div>
			</div>

			<div class="flaticon-open-envelope">
			<?php echo do_shortcode('[contact-form-7 id="45" title="Pied de page contact"]');?>
			</div>
		</div>

		<div class="site-info">

			<?php if( get_theme_mod( 'footer_titre' )!=='' ): ?>
						<h3><?php echo get_theme_mod( 'footer_titre' ); ?></h3>
			<?php endif; ?>
			<?php if( get_theme_mod( 'footer_sstitre' )!=='' ): ?>
						<p><?php echo nl2br(get_theme_mod( 'footer_sstitre' )); ?></p>
			<?php endif; ?>

		</div><!-- .site-info -->

		<div class="site-coord">

			<?php if( get_theme_mod( 'address' )!=='' ): ?>
						<p class="coord-address flaticon-placeholder">
							<?php echo nl2br(get_theme_mod( 'address' )); ?></p>
			<?php endif; ?>
			<?php if( get_theme_mod( 'phone' )!=='' ): ?>
						<p class="coord-phone flaticon-smartphone"><?php echo get_theme_mod( 'phone' ); ?></p>
			<?php endif; ?>
			<?php if( get_theme_mod( 'email' )!=='' ): ?>
						<p class="coord-mail flaticon-envelope"><?php echo get_theme_mod( 'email' ); ?></p>
			<?php endif; ?>

		</div>

		<div class="site-mention">
			<?php echo date('Y'); ?> © Copyright <span class="sep"> - </span> Maud Chenut-Briotet <span class="sep"> - </span><a href="<?php echo esc_url( __( './mentions-legales/', 'maudtheme' ) ); ?>">Mentions légales</a>
			<span class="sep"> - </span>
			<a href="http://www.comsamarche.com">Conception Comsamarche.com</a>
		</div>

	</footer><!-- #colophon -->
</div><!-- #page -->

<!--FOOTER-->
<?php wp_footer(); ?>
<!--FINFOOTER-->
</body>
</html>
