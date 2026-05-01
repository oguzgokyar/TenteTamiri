<?php
/**
 * Template Name: Elementor Full Width
 * Template Post Type: page
 *
 * @package AntigravityElementor
 */

get_header();

if (have_posts()) :
	while (have_posts()) :
		the_post();
		?>
		<main id="content" class="site-main site-main--elementor">
			<div class="container-wide elementor-shell">
				<?php the_content(); ?>
			</div>
		</main>
		<?php
	endwhile;
endif;

get_footer();

