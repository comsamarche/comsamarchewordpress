<?php
/**
 * Template Name: Page interieure
 *
 * @package MaudTheme
 * @subpackage Elementor plugin
 * @since Twenty Fourteen 1.0
 */

get_header(); ?>
	<div id="content" class="col-all">
		<div id="primary" class="content-area" data-namespace="page">
			<main id="main" class="site-main">

				<?php
				while ( have_posts() ) : the_post();

					the_content();

				endwhile; // End of the loop.
				?>

			</main><!-- #main -->
		</div><!-- #primary -->
	</div>

<?php
get_footer();
