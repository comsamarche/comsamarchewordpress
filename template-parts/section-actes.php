<?php
/**
 * Section actes
 *
 * @package MaudTheme
 */

 	$i = 1;

?>

	<section id="actes" class="entry-content acte_wrap active_<?php echo $i; ?>">
		<?php
			while (get_field('acte_'.$i.'_nom')):
		?>
			<p><?php the_field('acte_'.$i.'_nom'); ?></p>
			<h2><?php the_field('acte_'.$i.'_titre'); ?></h2>
			<p><?php the_field('acte_'.$i.'_resum'); ?></p>
			<a href="<?php the_field('acte_'.$i.'_url'); ?>"><span class="acte_more acte_<?php echo $i; ?>'">More</span>En savoir +</a>
		<?php
			$i++;
			endwhile;
		?>
	</section>
