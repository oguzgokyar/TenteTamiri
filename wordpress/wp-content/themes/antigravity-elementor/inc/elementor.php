<?php
/**
 * Elementor integration hooks.
 *
 * @package AntigravityElementor
 */

if (! defined('ABSPATH')) {
	exit;
}

function antigravity_add_elementor_support(): void {
	add_theme_support('elementor');
	add_theme_support('elementor-pro');
}
add_action('after_setup_theme', 'antigravity_add_elementor_support');

function antigravity_register_elementor_locations($elementor_theme_manager): void {
	if (! $elementor_theme_manager) {
		return;
	}

	$elementor_theme_manager->register_all_core_location();
}
add_action('elementor/theme/register_locations', 'antigravity_register_elementor_locations');

function antigravity_elementor_body_class(array $classes): array {
	if (antigravity_is_built_with_elementor()) {
		$classes[] = 'antigravity-elementor-page';
	}

	return $classes;
}
add_filter('body_class', 'antigravity_elementor_body_class');

