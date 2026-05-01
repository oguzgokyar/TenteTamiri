<?php
/**
 * Page content template.
 *
 * @package AntigravityElementor
 */

?>
<?php if (antigravity_is_built_with_elementor() || trim((string) get_the_content()) !== '') : ?>
	<article id="post-<?php the_ID(); ?>" <?php post_class('entry-card prose-card'); ?>>
		<?php if (antigravity_is_built_with_elementor()) : ?>
			<?php the_content(); ?>
		<?php else : ?>
			<div class="entry-content">
				<?php the_content(); ?>
			</div>
		<?php endif; ?>
	</article>
<?php endif; ?>
