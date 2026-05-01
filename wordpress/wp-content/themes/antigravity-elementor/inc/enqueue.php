<?php
/**
 * Enqueue theme assets.
 *
 * @package AntigravityElementor
 */

if (! defined('ABSPATH')) {
	exit;
}

function antigravity_enqueue_assets(): void {
	wp_enqueue_style('antigravity-style', get_stylesheet_uri(), [], ANTIGRAVITY_THEME_VERSION);
	wp_enqueue_style('antigravity-tokens', ANTIGRAVITY_THEME_URI . '/assets/css/tokens.css', [], ANTIGRAVITY_THEME_VERSION);
	wp_enqueue_style('antigravity-main', ANTIGRAVITY_THEME_URI . '/assets/css/main.css', ['antigravity-style', 'antigravity-tokens'], ANTIGRAVITY_THEME_VERSION);

	wp_enqueue_script('antigravity-theme', ANTIGRAVITY_THEME_URI . '/assets/js/theme.js', [], ANTIGRAVITY_THEME_VERSION, true);

	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}
add_action('wp_enqueue_scripts', 'antigravity_enqueue_assets');

