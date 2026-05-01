<?php
/**
 * Front page template.
 *
 * @package AntigravityElementor
 */

get_header();

if (have_posts()) :
	while (have_posts()) :
		the_post();
		$antigravity_show_elementor = antigravity_has_meaningful_elementor_content();
		?>
		<main id="content" class="site-main <?php echo $antigravity_show_elementor ? 'site-main--elementor' : ''; ?>">
			<?php if ($antigravity_show_elementor) : ?>
				<?php the_content(); ?>
			<?php else : ?>
				<?php get_template_part('template-parts/sections/home', 'hero'); ?>
				<?php get_template_part('template-parts/sections/home', 'trust'); ?>
				<?php get_template_part('template-parts/sections/home', 'services'); ?>
				<?php get_template_part('template-parts/sections/home', 'solutions'); ?>
				<?php get_template_part('template-parts/sections/home', 'districts'); ?>
				<?php get_template_part('template-parts/sections/home', 'process'); ?>
				<?php get_template_part('template-parts/sections/home', 'proof'); ?>
				<?php get_template_part('template-parts/sections/home', 'cta'); ?>

				<?php if (trim((string) get_the_content()) !== '') : ?>
					<section class="section-shell">
						<div class="container prose-card">
							<?php the_content(); ?>
						</div>
					</section>
				<?php endif; ?>
			<?php endif; ?>
		</main>
		<?php
	endwhile;
endif;

get_footer();
