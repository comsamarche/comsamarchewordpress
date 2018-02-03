<?php
/**
 * Section presentation
 *
 * @package MaudTheme
 */

?>
<section id="presentation" class="entry-content">
	<?php if ( is_front_page() ) : ?><h2><?php else: ?><h1><?php endif;?>
			<?php the_field('presentation_titre'); ?>
	<?php if ( is_front_page() ) : ?></h2><?php else: ?></h1><?php endif;?>
	<?php the_field('presentation_text'); ?>
    <?php $image = get_field('presentation_img'); ?>
    <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
</section>
