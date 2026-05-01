<?php
/**
 * Content migration engine.
 *
 * @package AntigravitySiteManager
 */

if (! defined('ABSPATH')) {
	exit;
}

class AGSM_Content_Migrator {
	private const APPLIED_OPTION = 'agsm_applied_migrations';
	private const LOG_OPTION     = 'agsm_migration_logs';
	private const BACKUP_OPTION  = 'agsm_migration_backups';

	private string $migration_dir;

	public function __construct(string $migration_dir) {
		$this->migration_dir = untrailingslashit($migration_dir);
	}

	public function migrations(): array {
		$files      = glob($this->migration_dir . '/*.php') ?: [];
		$migrations = [];

		sort($files);

		foreach ($files as $file) {
			if ('manifest.php' === basename($file)) {
				continue;
			}

			$migration = require $file;

			if (! is_array($migration) || empty($migration['id'])) {
				continue;
			}

			$migrations[ $migration['id'] ] = $migration;
		}

		return $migrations;
	}

	public function manifest(): array {
		$file = $this->migration_dir . '/manifest.php';

		if (! file_exists($file)) {
			return [];
		}

		$manifest = require $file;

		return is_array($manifest) ? $manifest : [];
	}

	public function applied_ids(): array {
		$ids = get_option(self::APPLIED_OPTION, []);

		return is_array($ids) ? array_values(array_filter($ids, 'is_string')) : [];
	}

	public function pending_migrations(): array {
		$applied = $this->applied_ids();

		return array_filter(
			$this->migrations(),
			static fn(array $migration): bool => ! in_array($migration['id'], $applied, true)
		);
	}

	public function dry_run(?array $migrations = null): array {
		$migrations = $migrations ?? $this->pending_migrations();
		$report     = [];

		foreach ($migrations as $migration) {
			$items = [];

			foreach (($migration['items'] ?? []) as $item) {
				$items[] = $this->preview_item($item, $migration);
			}

			foreach (($migration['options'] ?? []) as $option) {
				$items[] = $this->preview_option($option, $migration);
			}

			$report[] = [
				'id'          => $migration['id'],
				'title'       => $migration['title'] ?? $migration['id'],
				'description' => $migration['description'] ?? '',
				'items'       => $items,
			];
		}

		return $report;
	}

	public function apply_pending(int $user_id): array {
		$pending = $this->pending_migrations();
		$result  = [
			'applied' => [],
			'errors'  => [],
		];

		foreach ($pending as $migration) {
			try {
				$this->apply_migration($migration, $user_id);
				$result['applied'][] = $migration['id'];
			} catch (Throwable $error) {
				$result['errors'][] = [
					'id'      => $migration['id'],
					'message' => $error->getMessage(),
				];
				break;
			}
		}

		return $result;
	}

	public function site_health(): array {
		$manifest       = $this->manifest();
		$required_pages = $manifest['required_pages'] ?? [];
		$rows           = [];

		foreach ($required_pages as $page) {
			$slug = is_array($page) ? ($page['slug'] ?? '') : (string) $page;

			if ('' === $slug) {
				continue;
			}

			$existing = get_page_by_path($slug, OBJECT, 'page');
			$rows[]   = [
				'slug'   => $slug,
				'title'  => is_array($page) ? ($page['title'] ?? $slug) : $slug,
				'exists' => (bool) $existing,
				'id'     => $existing ? (int) $existing->ID : 0,
			];
		}

		return $rows;
	}

	public function logs(): array {
		$logs = get_option(self::LOG_OPTION, []);

		return is_array($logs) ? $logs : [];
	}

	private function apply_migration(array $migration, int $user_id): void {
		$applied = $this->applied_ids();

		foreach (($migration['items'] ?? []) as $item) {
			$this->apply_item($item, $migration, $user_id);
		}

		foreach (($migration['options'] ?? []) as $option) {
			$this->apply_option($option);
		}

		$applied[] = $migration['id'];
		update_option(self::APPLIED_OPTION, array_values(array_unique($applied)), false);

		$this->add_log(
			[
				'migration' => $migration['id'],
				'user_id'   => $user_id,
				'status'    => 'success',
				'message'   => 'Migration applied.',
			]
		);
	}

	private function preview_item(array $item, array $migration): array {
		$type = $item['post_type'] ?? 'page';
		$slug = $item['slug'] ?? '';
		$mode = $item['mode'] ?? ($migration['mode'] ?? 'safe');

		if ('' === $slug) {
			return [
				'action' => 'skip',
				'label'  => 'Missing slug',
				'mode'   => $mode,
			];
		}

		$existing = get_page_by_path($slug, OBJECT, $type);

		return [
			'action' => $existing ? $this->action_for_existing($mode) : 'create',
			'label'  => sprintf('%s (%s)', $item['title'] ?? $slug, $slug),
			'mode'   => $mode,
			'id'     => $existing ? (int) $existing->ID : 0,
		];
	}

	private function preview_option(array $option, array $migration): array {
		return [
			'action' => 'option',
			'label'  => $option['label'] ?? ($option['name'] ?? 'option'),
			'mode'   => $migration['mode'] ?? 'safe',
			'id'     => 0,
		];
	}

	private function apply_item(array $item, array $migration, int $user_id): void {
		$type     = $item['post_type'] ?? 'page';
		$slug     = $item['slug'] ?? '';
		$mode     = $item['mode'] ?? ($migration['mode'] ?? 'safe');
		$existing = $slug ? get_page_by_path($slug, OBJECT, $type) : null;

		if ('' === $slug) {
			throw new RuntimeException('Migration item is missing slug.');
		}

		if ($existing && 'create_only' === $mode) {
			return;
		}

		if ($existing) {
			$this->backup_post((int) $existing->ID, $migration['id']);
		}

		if ($existing && 'meta_only' === $mode) {
			$this->apply_item_meta((int) $existing->ID, $item);

			return;
		}

		$postarr = [
			'post_type'   => $type,
			'post_name'   => $slug,
			'post_title'  => $item['title'] ?? $slug,
			'post_status' => $item['status'] ?? 'publish',
			'post_author' => $user_id,
		];

		if (! empty($item['excerpt'])) {
			$postarr['post_excerpt'] = $item['excerpt'];
		}

		if (! $existing || 'overwrite' === $mode) {
			$postarr['post_content'] = $item['content'] ?? '';
		}

		if ($existing) {
			$postarr['ID'] = (int) $existing->ID;
			$post_id      = wp_update_post(wp_slash($postarr), true);
		} else {
			$post_id = wp_insert_post(wp_slash($postarr), true);
		}

		if (is_wp_error($post_id)) {
			throw new RuntimeException($post_id->get_error_message());
		}

		$this->apply_item_meta((int) $post_id, $item);

		if (! empty($item['menu'])) {
			$this->ensure_menu_item((int) $post_id, $item['menu']);
		}
	}

	private function apply_option(array $option): void {
		$name = $option['name'] ?? '';

		if ('' === $name) {
			return;
		}

		$value = $option['value'] ?? '';

		if ('page_slug' === ($option['value_type'] ?? '')) {
			$page  = get_page_by_path((string) $value, OBJECT, 'page');
			$value = $page ? (int) $page->ID : 0;
		}

		update_option($name, $value);

		if ('permalink_structure' === $name) {
			flush_rewrite_rules(false);
		}
	}

	private function apply_item_meta(int $post_id, array $item): void {
		if (! empty($item['template'])) {
			update_post_meta($post_id, '_wp_page_template', sanitize_text_field($item['template']));
		}

		foreach (($item['meta'] ?? []) as $key => $value) {
			update_post_meta($post_id, sanitize_key($key), wp_slash($value));
		}
	}

	private function ensure_menu_item(int $post_id, array $menu_config): void {
		$location  = $menu_config['location'] ?? 'primary';
		$menu_name = $menu_config['menu_name'] ?? 'Ana Menu';
		$locations = get_nav_menu_locations();
		$menu_id   = $locations[ $location ] ?? 0;

		if (! $menu_id) {
			$menu_id = wp_create_nav_menu($menu_name);

			if (is_wp_error($menu_id)) {
				return;
			}

			$locations[ $location ] = (int) $menu_id;
			set_theme_mod('nav_menu_locations', $locations);
		}

		$existing = wp_get_nav_menu_items((int) $menu_id) ?: [];

		foreach ($existing as $menu_item) {
			if ((int) $menu_item->object_id === $post_id) {
				return;
			}
		}

		wp_update_nav_menu_item(
			(int) $menu_id,
			0,
			[
				'menu-item-object-id' => $post_id,
				'menu-item-object'    => 'page',
				'menu-item-type'      => 'post_type',
				'menu-item-status'    => 'publish',
				'menu-item-position'  => (int) ($menu_config['order'] ?? 0),
			]
		);
	}

	private function action_for_existing(string $mode): string {
		return match ($mode) {
			'create_only' => 'skip',
			'overwrite'   => 'overwrite',
			'meta_only'   => 'update_meta',
			default       => 'safe_update',
		};
	}

	private function backup_post(int $post_id, string $migration_id): void {
		$post = get_post($post_id);

		if (! $post) {
			return;
		}

		$backups   = get_option(self::BACKUP_OPTION, []);
		$backups   = is_array($backups) ? $backups : [];
		$backups[] = [
			'time'         => current_time('mysql'),
			'migration_id' => $migration_id,
			'post_id'      => $post_id,
			'post_title'   => $post->post_title,
			'post_content' => $post->post_content,
			'post_excerpt' => $post->post_excerpt,
			'meta'         => get_post_meta($post_id),
		];

		update_option(self::BACKUP_OPTION, array_slice($backups, -30), false);
	}

	private function add_log(array $entry): void {
		$logs   = $this->logs();
		$logs[] = array_merge(
			[
				'time' => current_time('mysql'),
			],
			$entry
		);

		update_option(self::LOG_OPTION, array_slice($logs, -50), false);
	}
}
