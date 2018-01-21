<?php
/**
 * Template part for displaying page content in template-homepage.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package MaudTheme
 */

$fields = get_fields();
$field_type = [];
?>


<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<div class="entry-content">

		<?php
			if( $fields ):
					foreach( $fields as $name => $value ):

						$presentation = stripos($name,"presentation");
						if (!in_array("presentation", $field_type) && is_numeric($presentation)) {
							array_push($field_type, "presentation");
						}

						$acte = stripos($name,"acte");
						if (!in_array("actes", $field_type) && is_numeric($acte)) {
							array_push($field_type, "actes");
						}

					endforeach;
			 endif;
		?>

		<?php
			foreach( $field_type as $value ):
				get_template_part( 'template-parts/section', $value );
			endforeach;
		?>


	</div><!-- .entry-content -->

</article><!-- #post-<?php the_ID(); ?> -->
