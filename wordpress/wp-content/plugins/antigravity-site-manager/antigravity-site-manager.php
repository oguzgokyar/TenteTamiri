<?php
/**
 * Plugin Name: Antigravity Site Manager
 * Description: Controlled content migrations and deployment helpers for Antigravity WordPress projects.
 * Version: 0.1.0
 * Author: Antigravity
 * Text Domain: antigravity-site-manager
 *
 * @package AntigravitySiteManager
 */

if (! defined('ABSPATH')) {
	exit;
}

define('AGSM_VERSION', '0.1.0');
define('AGSM_PLUGIN_FILE', __FILE__);
define('AGSM_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('AGSM_PLUGIN_URL', plugin_dir_url(__FILE__));

require_once AGSM_PLUGIN_DIR . 'includes/class-content-migrator.php';
require_once AGSM_PLUGIN_DIR . 'includes/class-admin-page.php';

function agsm_boot(): void {
	$migrator = new AGSM_Content_Migrator(AGSM_PLUGIN_DIR . 'migrations');
	new AGSM_Admin_Page($migrator);
}
add_action('plugins_loaded', 'agsm_boot');
