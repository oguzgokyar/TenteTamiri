<?php
/**
 * Frontend performance optimizations.
 *
 * @package AntigravityElementor
 */

if (! defined('ABSPATH')) {
	exit;
}

function antigravity_disable_emojis(): void {
	remove_action('wp_head', 'print_emoji_detection_script', 7);
	remove_action('wp_print_styles', 'print_emoji_styles');
	remove_action('admin_print_scripts', 'print_emoji_detection_script');
	remove_action('admin_print_styles', 'print_emoji_styles');
	remove_filter('the_content_feed', 'wp_staticize_emoji');
	remove_filter('comment_text_rss', 'wp_staticize_emoji');
	remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
}
add_action('init', 'antigravity_disable_emojis');

function antigravity_disable_embeds(): void {
	remove_action('rest_api_init', 'wp_oembed_register_route');
	remove_filter('oembed_dataparse', 'wp_filter_oembed_result', 10);
	remove_action('wp_head', 'wp_oembed_add_discovery_links');
	remove_action('wp_head', 'wp_oembed_add_host_js');
}
add_action('init', 'antigravity_disable_embeds', 9999);

function antigravity_reduce_frontend_assets(): void {
	if (is_admin()) {
		return;
	}

	if (! is_user_logged_in()) {
		wp_dequeue_style('dashicons');
	}

	wp_dequeue_style('classic-theme-styles');
	wp_dequeue_style('global-styles');
	wp_dequeue_style('wp-block-library');
	wp_dequeue_style('wp-block-library-theme');
	wp_dequeue_script('wp-embed');

	$has_elementor_content = antigravity_has_meaningful_elementor_content();

	if (! $has_elementor_content) {
		wp_dequeue_style('elementor-icons');
		wp_dequeue_style('elementor-frontend');
		wp_dequeue_style('elementor-pro');
		wp_dequeue_style('elementor-post-' . get_the_ID());
		wp_dequeue_style('elementor-global');
		wp_dequeue_script('elementor-webpack-runtime');
		wp_dequeue_script('elementor-frontend');
		wp_dequeue_script('elementor-waypoints');
		wp_dequeue_script('imagesloaded');
	}
}
add_action('wp_enqueue_scripts', 'antigravity_reduce_frontend_assets', 100);

function antigravity_disable_update_checks($value) {
	if (is_object($value)) {
		return $value;
	}

	return new stdClass();
}
add_filter('pre_site_transient_update_core', 'antigravity_disable_update_checks');
add_filter('pre_site_transient_update_plugins', 'antigravity_disable_update_checks');
add_filter('pre_site_transient_update_themes', 'antigravity_disable_update_checks');

add_filter('automatic_updater_disabled', '__return_true');
add_filter('auto_update_core', '__return_false');
add_filter('auto_update_plugin', '__return_false');
add_filter('auto_update_theme', '__return_false');

function antigravity_disable_elementor_remote_features(): void {
	if (! did_action('elementor/loaded')) {
		return;
	}

	add_filter('elementor/experiments/default-features-allowed', '__return_false');
	add_filter('elementor/experiments/default-features-network', '__return_empty_array');
}
add_action('init', 'antigravity_disable_elementor_remote_features', 20);
