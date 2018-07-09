<?php
/**
 * The template for Homepage
 *
 	Template Name: Homepage
 *
 * @package MaudTheme
 */

get_header(); ?>

	<div id="primary" class="content-area" data-namespace="homepage">
		<main id="main" class="site-main">

			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'home' );

			endwhile; // End of the loop.
			?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
