<?php
/**
 * Page template.
 *
 * @package AntigravityElementor
 */

get_header();

if (have_posts()) :
	while (have_posts()) :
		the_post();
		$antigravity_is_elementor = antigravity_has_meaningful_elementor_content();
		$antigravity_slug         = get_post_field('post_name', get_the_ID());
		$antigravity_page_content = antigravity_service_page_content($antigravity_slug) ?: antigravity_district_page_content($antigravity_slug);
		$antigravity_no_sidebar   = ! empty($antigravity_page_content['no_sidebar']);
		$antigravity_hide_hero    = ! empty($antigravity_page_content['hide_page_hero']);
		?>
		<main id="content" class="site-main <?php echo $antigravity_is_elementor ? 'site-main--elementor' : ''; ?> <?php echo $antigravity_hide_hero ? 'site-main--no-page-hero' : ''; ?>">
			<?php
			if (! $antigravity_hide_hero) {
				antigravity_page_intro(
					$antigravity_page_content['eyebrow'] ?? __('Page Template', 'antigravity-elementor'),
					get_the_title(),
					$antigravity_page_content['description'] ?? (get_the_excerpt() ?: __('Bu alan Elementor veya klasik WordPress icerigi ile sorunsuz sekilde kullanilabilir.', 'antigravity-elementor'))
				);
			}
			?>
			<?php if (! $antigravity_is_elementor && $antigravity_page_content) : ?>
				<div class="container-wide service-page-layout <?php echo $antigravity_no_sidebar ? 'service-page-layout--wide' : ''; ?>">
					<div class="service-page-layout__main">
						<div class="content-single">
							<?php get_template_part('template-parts/content/content', 'page'); ?>
						</div>
						<?php if (! empty($antigravity_page_content['sections'])) : ?>
							<?php antigravity_render_marketing_sections($antigravity_page_content['sections']); ?>
						<?php endif; ?>
					</div>
					<?php if (! $antigravity_no_sidebar) : ?>
						<?php get_sidebar('service'); ?>
					<?php endif; ?>
				</div>
				<?php get_template_part('template-parts/sections/service', 'regions'); ?>
				<?php get_template_part('template-parts/sections/customer', 'reviews'); ?>
			<?php else : ?>
				<div class="container-wide content-single">
					<?php get_template_part('template-parts/content/content', 'page'); ?>
				</div>
			<?php endif; ?>
		</main>
		<?php
	endwhile;
endif;

get_footer();
