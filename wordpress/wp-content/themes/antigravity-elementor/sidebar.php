<?php
/**
 * Sidebar template.
 *
 * @package AntigravityElementor
 */

if (! is_active_sidebar('primary-sidebar')) {
	return;
}
?>
<aside class="site-sidebar" aria-label="<?php esc_attr_e('Sidebar', 'antigravity-elementor'); ?>">
	<?php dynamic_sidebar('primary-sidebar'); ?>
</aside>

