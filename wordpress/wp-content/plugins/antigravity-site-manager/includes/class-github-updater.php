<?php
/**
 * GitHub based controlled file updater.
 *
 * @package AntigravitySiteManager
 */

if (! defined('ABSPATH')) {
	exit;
}

class AGSM_GitHub_Updater {
	private const SETTINGS_OPTION = 'agsm_github_settings';
	private const LOG_OPTION      = 'agsm_github_update_logs';

	public function settings(): array {
		$settings = get_option(self::SETTINGS_OPTION, []);
		$settings = is_array($settings) ? $settings : [];

		return wp_parse_args(
			$settings,
			[
				'repository' => 'oguzgokyar/TenteTamiri',
				'branch'     => 'main',
				'token'      => '',
			]
		);
	}

	public function update_settings(array $input): void {
		$current    = $this->settings();
		$repository = sanitize_text_field(wp_unslash($input['repository'] ?? ''));
		$branch     = sanitize_text_field(wp_unslash($input['branch'] ?? 'main'));
		$token      = sanitize_text_field(wp_unslash($input['token'] ?? ''));

		if (empty($input['clear_token']) && '' === $token) {
			$token = (string) $current['token'];
		}

		update_option(
			self::SETTINGS_OPTION,
			[
				'repository' => $repository,
				'branch'     => $branch ?: 'main',
				'token'      => $token,
			],
			false
		);
	}

	public function masked_token(): string {
		$token = (string) $this->settings()['token'];

		if ('' === $token) {
			return 'Token yok';
		}

		return substr($token, 0, 4) . str_repeat('*', max(4, strlen($token) - 8)) . substr($token, -4);
	}

	public function logs(): array {
		$logs = get_option(self::LOG_OPTION, []);

		return is_array($logs) ? $logs : [];
	}

	public function sync_from_github(): array {
		$settings   = $this->settings();
		$repository = (string) $settings['repository'];
		$branch     = (string) $settings['branch'];

		$this->validate_repository($repository);
		$this->validate_branch($branch);

		$upload_dir = wp_upload_dir();
		$work_dir   = trailingslashit($upload_dir['basedir']) . 'antigravity-site-manager/github-sync';
		$backup_dir = trailingslashit($upload_dir['basedir']) . 'antigravity-site-manager/backups/' . gmdate('Ymd-His');

		$this->ensure_directory($work_dir);
		$this->ensure_directory($backup_dir);
		$this->clear_directory($work_dir);

		$zip_file = trailingslashit($work_dir) . 'source.zip';
		$this->download_archive($repository, $branch, (string) $settings['token'], $zip_file);

		$extract_dir = trailingslashit($work_dir) . 'source';
		$this->ensure_directory($extract_dir);
		$this->clear_directory($extract_dir);
		$this->extract_archive($zip_file, $extract_dir);

		$source_root = $this->find_extracted_root($extract_dir);
		$targets     = $this->allowed_targets();
		$updated     = [];

		foreach ($targets as $target) {
			$source = trailingslashit($source_root) . $target['source'];

			if (! is_dir($source)) {
				$updated[] = [
					'label'  => $target['label'],
					'status' => 'skipped',
					'detail' => 'GitHub arsivinde kaynak klasor bulunamadi.',
				];
				continue;
			}

			$this->backup_directory($target['destination'], trailingslashit($backup_dir) . $target['backup']);
			$this->copy_directory($source, $target['destination']);

			$updated[] = [
				'label'  => $target['label'],
				'status' => 'updated',
				'detail' => $target['destination'],
			];
		}

		$result = [
			'repository' => $repository,
			'branch'     => $branch,
			'backup_dir' => $backup_dir,
			'updated'    => $updated,
		];

		$this->add_log(
			[
				'status'     => 'success',
				'message'    => 'GitHub update completed.',
				'repository' => $repository,
				'branch'     => $branch,
				'backup_dir' => $backup_dir,
			]
		);

		return $result;
	}

	private function allowed_targets(): array {
		return [
			[
				'label'       => 'Tema',
				'source'      => 'wordpress/wp-content/themes/antigravity-elementor',
				'destination' => WP_CONTENT_DIR . '/themes/antigravity-elementor',
				'backup'      => 'theme-antigravity-elementor',
			],
			[
				'label'       => 'Site Manager Eklentisi',
				'source'      => 'wordpress/wp-content/plugins/antigravity-site-manager',
				'destination' => WP_CONTENT_DIR . '/plugins/antigravity-site-manager',
				'backup'      => 'plugin-antigravity-site-manager',
			],
		];
	}

	private function download_archive(string $repository, string $branch, string $token, string $destination): void {
		$url     = sprintf('https://codeload.github.com/%s/zip/refs/heads/%s', rawurlencode($repository), rawurlencode($branch));
		$url     = str_replace('%2F', '/', $url);
		$headers = [
			'Accept'     => 'application/vnd.github+json',
			'User-Agent' => 'Antigravity-Site-Manager/' . AGSM_VERSION,
		];

		if ('' !== $token) {
			$headers['Authorization'] = 'Bearer ' . $token;
		}

		$response = wp_remote_get(
			$url,
			[
				'timeout'  => 60,
				'stream'   => true,
				'filename' => $destination,
				'headers'  => $headers,
			]
		);

		if (is_wp_error($response)) {
			throw new RuntimeException($response->get_error_message());
		}

		$code = (int) wp_remote_retrieve_response_code($response);

		if (200 !== $code) {
			throw new RuntimeException('GitHub arsivi indirilemedi. HTTP durum kodu: ' . $code);
		}

		if (! file_exists($destination) || 0 === filesize($destination)) {
			throw new RuntimeException('GitHub arsivi bos veya indirilemedi.');
		}
	}

	private function extract_archive(string $zip_file, string $destination): void {
		if (! class_exists('ZipArchive')) {
			throw new RuntimeException('Sunucuda ZipArchive etkin degil. Hosting PHP zip eklentisini acmalidir.');
		}

		$zip = new ZipArchive();

		if (true !== $zip->open($zip_file)) {
			throw new RuntimeException('GitHub ZIP arsivi acilamadi.');
		}

		if (! $zip->extractTo($destination)) {
			$zip->close();
			throw new RuntimeException('GitHub ZIP arsivi cikartilamadi.');
		}

		$zip->close();
	}

	private function find_extracted_root(string $extract_dir): string {
		$entries = array_values(
			array_filter(
				scandir($extract_dir) ?: [],
				static fn(string $entry): bool => ! in_array($entry, ['.', '..'], true)
			)
		);

		if (1 === count($entries) && is_dir(trailingslashit($extract_dir) . $entries[0])) {
			return trailingslashit($extract_dir) . $entries[0];
		}

		return $extract_dir;
	}

	private function backup_directory(string $source, string $destination): void {
		if (! is_dir($source)) {
			return;
		}

		$this->copy_directory($source, $destination);
	}

	private function copy_directory(string $source, string $destination): void {
		$source      = wp_normalize_path($source);
		$destination = wp_normalize_path($destination);

		if (! is_dir($source)) {
			throw new RuntimeException('Kaynak klasor bulunamadi: ' . $source);
		}

		$this->ensure_directory($destination);

		$iterator = new RecursiveIteratorIterator(
			new RecursiveDirectoryIterator($source, FilesystemIterator::SKIP_DOTS),
			RecursiveIteratorIterator::SELF_FIRST
		);

		foreach ($iterator as $item) {
			$relative = ltrim(str_replace($source, '', wp_normalize_path($item->getPathname())), '/');
			$target   = trailingslashit($destination) . $relative;

			if ($item->isDir()) {
				$this->ensure_directory($target);
				continue;
			}

			$this->ensure_directory(dirname($target));

			if (! copy($item->getPathname(), $target)) {
				throw new RuntimeException('Dosya kopyalanamadi: ' . $target);
			}
		}
	}

	private function clear_directory(string $directory): void {
		if (! is_dir($directory)) {
			return;
		}

		$iterator = new RecursiveIteratorIterator(
			new RecursiveDirectoryIterator($directory, FilesystemIterator::SKIP_DOTS),
			RecursiveIteratorIterator::CHILD_FIRST
		);

		foreach ($iterator as $item) {
			if ($item->isDir()) {
				rmdir($item->getPathname());
				continue;
			}

			unlink($item->getPathname());
		}
	}

	private function ensure_directory(string $directory): void {
		if (is_dir($directory)) {
			return;
		}

		if (! wp_mkdir_p($directory)) {
			throw new RuntimeException('Klasor olusturulamadi: ' . $directory);
		}
	}

	private function validate_repository(string $repository): void {
		if (! preg_match('/^[A-Za-z0-9_.-]+\/[A-Za-z0-9_.-]+$/', $repository)) {
			throw new RuntimeException('GitHub repository formati owner/repo seklinde olmalidir.');
		}
	}

	private function validate_branch(string $branch): void {
		if (! preg_match('/^[A-Za-z0-9_.\/-]+$/', $branch)) {
			throw new RuntimeException('GitHub branch adi gecersiz karakter iceriyor.');
		}
	}

	private function add_log(array $entry): void {
		$logs   = $this->logs();
		$logs[] = array_merge(
			[
				'time' => current_time('mysql'),
			],
			$entry
		);

		update_option(self::LOG_OPTION, array_slice($logs, -30), false);
	}
}
