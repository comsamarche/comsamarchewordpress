<?php
/**
 * Section actes
 *
 * @package MaudTheme
 */

?>

	<section id="actes">
		<?php
			$i = 1;
			while (get_field('acte_'.$i.'_nom')):
		?>
			<p><?php the_field('acte_'.$i.'_nom'); ?></p>
			<h2><?php the_field('acte_'.$i.'_titre'); ?></h2>
			<p><?php the_field('acte_'.$i.'_resum'); ?></p>
		<?php
			$i++;
			endwhile;
		?>
	</section>
