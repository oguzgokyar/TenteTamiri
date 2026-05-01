<?php
/**
 * Search template.
 *
 * @package AntigravityElementor
 */

get_header();
?>
<main id="content" class="site-main">
	<?php antigravity_page_intro(__('Search Results', 'antigravity-elementor'), sprintf(__('"%s" icin sonuclar', 'antigravity-elementor'), get_search_query()), __('Arama deneyimi, icerik bulunabilirligini arttiran temiz kart yapisi ve yan alanlarla desteklenir.', 'antigravity-elementor')); ?>
	<div class="container content-with-sidebar">
		<div class="content-stack">
			<?php get_search_form(); ?>
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

