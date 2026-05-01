<?php
/**
 * Single content template.
 *
 * @package AntigravityElementor
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class('entry-card prose-card'); ?>>
	<?php antigravity_posted_on(); ?>
	<div class="entry-content">
		<?php the_content(); ?>
	</div>
	<footer class="entry-footer">
		<?php the_tags('<div class="tag-list">', '', '</div>'); ?>
	</footer>
</article>

