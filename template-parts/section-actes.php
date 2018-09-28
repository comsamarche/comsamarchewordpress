<?php
/**
 * Section actes
 *
 * @package MaudTheme
 */

	 $i = 1;
	 $arraytitre = [];
	 $search = [' ' , 'é' , '&'];
	 $replace = ['_' , 'e' , ''];
	 $class = [];

?>

	<section id="actes" class="entry-content acte_wrap">
		<h2 class="titre_acte h2-like"><?php the_field('acte_titre'); ?></h2>

		<?php
			while (get_field('acte_'.$i.'_nom')):

				array_push( $arraytitre, get_field('acte_'.$i.'_nom'));
				$class[$i] = ($i===1) ?' active' : '';
		?>

		<li class="nav_acte nav_<?php echo $i; ?>">
			<a href="#<?php echo str_replace( $search , $replace , strtolower ( $arraytitre[$i-1])); ?>"
			class="btn btn--primary btn--split<?php echo $class[$i]; ?>"
			data-active="<?php echo str_replace($search,$replace,strtolower (  $arraytitre[$i-1])); ?>">
				<span><?php echo str_replace('&', '<br/>&',get_field('acte_'.$i.'_nom')); ?></span><i class="flaticon-right-arrow"></i>
			</a>
		</li>

		<div class="wrap wrap_<?php echo str_replace($search,$replace,strtolower ( get_field('acte_'.$i.'_nom') ) ).$class[$i]; ?>">
			<h3 class="acte-title"><?php the_field('acte_'.$i.'_titre'); ?></h3>
			<div><?php the_field('acte_'.$i.'_resum'); ?></div>
			<div class="text_content"><?php the_field('acte_'.$i.'_text'); ?></div>
			<a class="btn btn--primary btn--split btn--split-invert" href="<?php the_field('acte_'.$i.'_url'); ?>"><i class="flaticon-download-arrow"></i><span class="acte_more acte_<?php echo $i; ?>'">En savoir +</span></a>
		</div>
		<?php
			$i++;
			endwhile;
		?>
	</section>
