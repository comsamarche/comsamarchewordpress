<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package MaudTheme
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

<div class="entry-content full-content">
	<?php
		get_template_part( 'template-parts/section', 'entete' );
	?>
	<?php the_content(); ?>
</div>

</article><!-- #post-<?php the_ID(); ?> -->
