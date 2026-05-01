<?php
/**
 * Template Name: Elementor Canvas
 * Template Post Type: page
 *
 * @package AntigravityElementor
 */

?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class('elementor-canvas-template'); ?>>
<?php wp_body_open(); ?>
<?php
if (have_posts()) :
	while (have_posts()) :
		the_post();
		?>
		<main id="content" class="site-main site-main--canvas">
			<?php the_content(); ?>
		</main>
		<?php
	endwhile;
endif;
wp_footer();
?>
</body>
</html>

