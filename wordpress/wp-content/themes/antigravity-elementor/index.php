<?php
/**
 * Main index template.
 *
 * @package AntigravityElementor
 */

get_header();
?>
<main id="content" class="site-main">
	<?php antigravity_page_intro(__('Latest Stories', 'antigravity-elementor'), get_bloginfo('name'), __('Tema icindeki varsayilan liste gorunumu, blog ve icerik akislarini guvenli bir sekilde kapsar.', 'antigravity-elementor')); ?>
	<div class="container content-with-sidebar">
		<div class="content-stack">
			<?php if (have_posts()) : ?>
				<div class="post-grid">
					<?php
					while (have_posts()) :
						the_post();
						get_template_part('template-parts/content/content', 'excerpt');
					endwhile;
					?>
				</div>
				<?php the_posts_pagination(); ?>
			<?php else : ?>
				<?php get_template_part('template-parts/content/content', 'none'); ?>
			<?php endif; ?>
		</div>
		<?php get_sidebar(); ?>
	</div>
</main>
<?php
get_footer();

