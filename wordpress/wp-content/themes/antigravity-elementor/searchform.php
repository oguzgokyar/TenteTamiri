<?php
/**
 * Search form template.
 *
 * @package AntigravityElementor
 */

?>
<form class="search-form-shell" role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>">
	<label>
		<span class="screen-reader-text"><?php esc_html_e('Search for:', 'antigravity-elementor'); ?></span>
		<input type="search" class="search-field" placeholder="<?php esc_attr_e('Icerik ara...', 'antigravity-elementor'); ?>" value="<?php echo esc_attr(get_search_query()); ?>" name="s">
	</label>
	<button type="submit" class="button"><?php esc_html_e('Ara', 'antigravity-elementor'); ?></button>
</form>

