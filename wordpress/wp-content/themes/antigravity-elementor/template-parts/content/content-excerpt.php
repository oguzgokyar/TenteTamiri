<?php
/**
 * Loop card template.
 *
 * @package AntigravityElementor
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class('post-card'); ?>>
	<a class="post-card__inner" href="<?php the_permalink(); ?>">
		<?php if (has_post_thumbnail()) : ?>
			<div class="post-card__media">
				<?php the_post_thumbnail('large'); ?>
			</div>
		<?php endif; ?>
		<div class="post-card__body">
			<?php antigravity_posted_on(); ?>
			<h2><?php the_title(); ?></h2>
			<p><?php echo esc_html(get_the_excerpt()); ?></p>
			<span class="text-link"><?php esc_html_e('Yaziyi oku', 'antigravity-elementor'); ?></span>
		</div>
	</a>
</article>

