<?php
/**
 * Theme bootstrap file.
 *
 * @package AntigravityElementor
 */

if (! defined('ABSPATH')) {
	exit;
}

define('ANTIGRAVITY_THEME_VERSION', '0.1.0');
define('ANTIGRAVITY_THEME_DIR', get_template_directory());
define('ANTIGRAVITY_THEME_URI', get_template_directory_uri());

$antigravity_includes = [
	'/inc/setup.php',
	'/inc/enqueue.php',
	'/inc/business.php',
	'/inc/elementor.php',
	'/inc/performance.php',
	'/inc/template-tags.php',
	'/inc/seo.php',
];

foreach ($antigravity_includes as $antigravity_file) {
	require_once ANTIGRAVITY_THEME_DIR . $antigravity_file;
}
