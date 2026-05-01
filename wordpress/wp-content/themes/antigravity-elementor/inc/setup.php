<?php
/**
 * Theme setup.
 *
 * @package AntigravityElementor
 */

if (! defined('ABSPATH')) {
	exit;
}

function antigravity_theme_setup(): void {
	load_theme_textdomain('antigravity-elementor', ANTIGRAVITY_THEME_DIR . '/languages');

	add_theme_support('title-tag');
	add_theme_support('post-thumbnails');
	add_theme_support('responsive-embeds');
	add_theme_support('align-wide');
	add_theme_support('wp-block-styles');
	add_theme_support('rank-math-breadcrumbs');
	add_theme_support(
		'html5',
		[
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'search-form',
			'script',
			'style',
		]
	);
	add_theme_support(
		'custom-logo',
		[
			'height'      => 64,
			'width'       => 220,
			'flex-height' => true,
			'flex-width'  => true,
		]
	);
	add_theme_support('editor-styles');
	add_editor_style(
		[
			'assets/css/tokens.css',
			'assets/css/main.css',
		]
	);

	register_nav_menus(
		[
			'primary' => __('Primary Menu', 'antigravity-elementor'),
			'footer'  => __('Footer Menu', 'antigravity-elementor'),
			'legal'   => __('Legal Menu', 'antigravity-elementor'),
		]
	);
}
add_action('after_setup_theme', 'antigravity_theme_setup');

function antigravity_content_width(): void {
	$GLOBALS['content_width'] = 760;
}
add_action('after_setup_theme', 'antigravity_content_width', 0);

function antigravity_widgets_init(): void {
	register_sidebar(
		[
			'name'          => __('Primary Sidebar', 'antigravity-elementor'),
			'id'            => 'primary-sidebar',
			'description'   => __('Blog ve tekil icerik sayfalari icin ana kenar alani.', 'antigravity-elementor'),
			'before_widget' => '<section id="%1$s" class="widget widget-card %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		]
	);

	register_sidebar(
		[
			'name'          => __('Footer Widgets', 'antigravity-elementor'),
			'id'            => 'footer-widgets',
			'description'   => __('Footer icindeki ikincil widget alani.', 'antigravity-elementor'),
			'before_widget' => '<section id="%1$s" class="widget footer-widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		]
	);
}
add_action('widgets_init', 'antigravity_widgets_init');
