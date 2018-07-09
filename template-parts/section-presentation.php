<?php
/**
 * Section presentation
 *
 * @package MaudTheme
 */

?>
<section id="presentation" class="entry-content">
	<?php $image = get_field('presentation_img'); ?>
    <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
	<?php if ( is_front_page() ) : ?><h2><?php else: ?><h1><?php endif;?>
			<?php the_field('presentation_titre'); ?>
	<?php if ( is_front_page() ) : ?></h2><?php else: ?></h1><?php endif;?>
	<?php the_field('presentation_text'); ?>
	<a class="btn btn--primary btn--split" href="<?php echo get_permalink('praticienne-cabinet') ?>"><span>Plus d'informations</span><i class="flaticon-right-arrow"></i></a>
</section>
