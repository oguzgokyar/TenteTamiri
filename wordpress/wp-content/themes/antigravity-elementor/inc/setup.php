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

function antigravity_nav_link_attributes(array $atts, WP_Post $item): array {
	$label = trim(wp_strip_all_tags((string) $item->title));

	if ('' !== $label && empty($atts['title'])) {
		$atts['title'] = sprintf(__('%s sayfasina git', 'antigravity-elementor'), $label);
	}

	if ('' !== $label && empty($atts['aria-label'])) {
		$atts['aria-label'] = $label;
	}

	if (! empty($atts['target']) && '_blank' === $atts['target']) {
		$rel         = $atts['rel'] ?? '';
		$rel_values  = array_filter(explode(' ', $rel));
		$rel_values  = array_unique(array_merge($rel_values, ['noopener', 'noreferrer']));
		$atts['rel'] = implode(' ', $rel_values);
	}

	return $atts;
}
add_filter('nav_menu_link_attributes', 'antigravity_nav_link_attributes', 10, 2);

function antigravity_custom_logo_html(string $html): string {
	if ('' === $html || false !== strpos($html, ' aria-label=')) {
		return $html;
	}

	$label = esc_attr__('Istanbul Tente Tamircisi ana sayfa', 'antigravity-elementor');

	return str_replace('<a ', '<a title="' . $label . '" aria-label="' . $label . '" ', $html);
}
add_filter('get_custom_logo', 'antigravity_custom_logo_html');
