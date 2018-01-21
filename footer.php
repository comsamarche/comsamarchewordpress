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
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'maudtheme' ) ); ?>"><?php
				/* translators: %s: CMS name, i.e. WordPress. */
				printf( esc_html__( 'Proudly powered by %s', 'maudtheme' ), 'WordPress' );
			?></a>
			<span class="sep"> | </span>
			<?php
				/* translators: 1: Theme name, 2: Theme author. */
				printf( esc_html__( 'Theme: %1$s by %2$s.', 'maudtheme' ), 'maudtheme', '<a href="http://www.comsamarche.com">Christine GUINAUDEAU - Comsamarche</a>' );
			?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
