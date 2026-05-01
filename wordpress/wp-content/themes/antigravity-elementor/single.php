<?php
/**
 * Single post template.
 *
 * @package AntigravityElementor
 */

get_header();

if (have_posts()) :
	while (have_posts()) :
		the_post();
		?>
		<main id="content" class="site-main">
			<?php antigravity_page_intro(__('Single Story', 'antigravity-elementor'), get_the_title(), get_the_excerpt() ?: __('Uzun form icerik, yazar bilgisi ve CTA bloklari ile guclu bir editorial duzen saglar.', 'antigravity-elementor'), ['variant' => 'post']); ?>
			<div class="container content-with-sidebar">
				<div class="content-stack">
					<?php get_template_part('template-parts/content/content', 'single'); ?>
					<?php if (comments_open() || get_comments_number()) : ?>
						<?php comments_template(); ?>
					<?php endif; ?>
				</div>
				<?php get_sidebar(); ?>
			</div>
		</main>
		<?php
	endwhile;
endif;

get_footer();
