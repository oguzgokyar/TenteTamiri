<?php
/**
 * Blog home template.
 *
 * @package AntigravityElementor
 */

get_header();
?>
<main id="content" class="site-main">
	<?php antigravity_page_intro(__('Editorial Feed', 'antigravity-elementor'), __('Blog', 'antigravity-elementor'), __('Kurumsal icerik akislarini, kategori odakli editor secimlerini ve guclu CTA alanlarini modern bir duzenle sunar.', 'antigravity-elementor')); ?>
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

