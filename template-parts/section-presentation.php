<?php
/**
 * Section presentation
 *
 * @package MaudTheme
 */

?>
<section id="presentation">
	<h1><?php the_field('presentation_titre'); ?></h1>
	<?php the_field('presentation_text'); ?>
    <?php $image = get_field('presentation_img'); ?>
    <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
</section>
