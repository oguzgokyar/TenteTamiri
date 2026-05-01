<?php
/**
 * Admin page for Antigravity Site Manager.
 *
 * @package AntigravitySiteManager
 */

if (! defined('ABSPATH')) {
	exit;
}

class AGSM_Admin_Page {
	private AGSM_Content_Migrator $migrator;
	private AGSM_GitHub_Updater $updater;

	public function __construct(AGSM_Content_Migrator $migrator, AGSM_GitHub_Updater $updater) {
		$this->migrator = $migrator;
		$this->updater  = $updater;

		add_action('admin_menu', [$this, 'register_menu']);
		add_action('admin_post_agsm_apply_migrations', [$this, 'handle_apply']);
		add_action('admin_post_agsm_save_github_settings', [$this, 'handle_save_github_settings']);
		add_action('admin_post_agsm_sync_github', [$this, 'handle_sync_github']);
	}

	public function register_menu(): void {
		add_menu_page(
			'Antigravity Site Manager',
			'Antigravity',
			'manage_options',
			'agsm-site-manager',
			[$this, 'render'],
			'dashicons-migrate',
			58
		);
	}

	public function handle_apply(): void {
		if (! current_user_can('manage_options')) {
			wp_die(esc_html__('Bu islem icin yetkiniz yok.', 'antigravity-site-manager'));
		}

		check_admin_referer('agsm_apply_migrations');

		$result = $this->migrator->apply_pending(get_current_user_id());
		$arg    = empty($result['errors']) ? 'applied' : 'error';

		wp_safe_redirect(
			add_query_arg(
				[
					'page'        => 'agsm-site-manager',
					'agsm_notice' => $arg,
				],
				admin_url('admin.php')
			)
		);
		exit;
	}

	public function handle_save_github_settings(): void {
		if (! current_user_can('manage_options')) {
			wp_die(esc_html__('Bu islem icin yetkiniz yok.', 'antigravity-site-manager'));
		}

		check_admin_referer('agsm_save_github_settings');

		try {
			$this->updater->update_settings($_POST);
			$notice = 'github_settings_saved';
		} catch (Throwable $error) {
			$notice = 'github_error';
		}

		wp_safe_redirect(
			add_query_arg(
				[
					'page'        => 'agsm-site-manager',
					'agsm_notice' => $notice,
				],
				admin_url('admin.php')
			)
		);
		exit;
	}

	public function handle_sync_github(): void {
		if (! current_user_can('manage_options')) {
			wp_die(esc_html__('Bu islem icin yetkiniz yok.', 'antigravity-site-manager'));
		}

		check_admin_referer('agsm_sync_github');

		try {
			$this->updater->sync_from_github();
			$notice = 'github_synced';
			$message = '';
		} catch (Throwable $error) {
			$notice  = 'github_error';
			$message = rawurlencode($error->getMessage());
		}

		wp_safe_redirect(
			add_query_arg(
				[
					'page'         => 'agsm-site-manager',
					'agsm_notice'  => $notice,
					'agsm_message' => $message,
				],
				admin_url('admin.php')
			)
		);
		exit;
	}

	public function render(): void {
		if (! current_user_can('manage_options')) {
			return;
		}

		$pending = $this->migrator->pending_migrations();
		$applied = $this->migrator->applied_ids();
		$dry_run = $this->migrator->dry_run($pending);
		$health  = $this->migrator->site_health();
		$logs    = array_reverse($this->migrator->logs());
		$github  = $this->updater->settings();
		$github_logs = array_reverse($this->updater->logs());
		?>
		<div class="wrap agsm-wrap">
			<h1>Antigravity Site Manager</h1>
			<p>Bu panel, GitHub ile gelen tema/eklenti dosyalarini kontrollu sekilde gunceller ve migration dosyalarini canli WordPress veritabanina guvenli sekilde uygular.</p>

			<?php $this->render_notice(); ?>

			<style>
				.agsm-grid { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 16px; margin: 20px 0; }
				.agsm-card { background: #fff; border: 1px solid #dcdcde; border-radius: 10px; padding: 16px; box-shadow: 0 1px 2px rgba(0,0,0,.04); }
				.agsm-card h2 { margin: 0 0 8px; font-size: 16px; }
				.agsm-card strong { font-size: 28px; }
				.agsm-form-grid { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 14px; max-width: 920px; }
				.agsm-form-grid label { display: block; font-weight: 700; margin-bottom: 6px; }
				.agsm-form-grid input[type="text"], .agsm-form-grid input[type="password"] { width: 100%; }
				.agsm-muted { color: #646970; }
				.agsm-table { margin-top: 16px; }
				.agsm-status { display: inline-flex; align-items: center; min-height: 24px; padding: 0 8px; border-radius: 999px; font-size: 12px; font-weight: 700; }
				.agsm-status--ok { background: #e7f7ed; color: #116329; }
				.agsm-status--wait { background: #fff4d9; color: #755100; }
				.agsm-status--bad { background: #ffe8e8; color: #8a1f11; }
				@media (max-width: 960px) { .agsm-grid { grid-template-columns: 1fr; } }
			</style>

			<div class="agsm-grid">
				<div class="agsm-card">
					<h2>Bekleyen Migration</h2>
					<strong><?php echo esc_html((string) count($pending)); ?></strong>
				</div>
				<div class="agsm-card">
					<h2>Uygulanan Migration</h2>
					<strong><?php echo esc_html((string) count($applied)); ?></strong>
				</div>
				<div class="agsm-card">
					<h2>Site Kontrolu</h2>
					<strong><?php echo esc_html((string) count(array_filter($health, static fn($row) => ! $row['exists']))); ?></strong>
					<p>Eksik zorunlu sayfa</p>
				</div>
			</div>

			<div class="agsm-card" style="margin-top:16px;">
				<h2>GitHub Dosya Guncelleme</h2>
				<p>Bu alan GitHub reposundaki son dosyalari indirir, mevcut tema ve eklenti klasorlerini yedekler, ardindan sadece izinli proje klasorlerini gunceller. Migrationlar otomatik uygulanmaz; guncellemeden sonra asagidaki migration onizleme alanindan manuel uygularsiniz.</p>

				<form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
					<?php wp_nonce_field('agsm_save_github_settings'); ?>
					<input type="hidden" name="action" value="agsm_save_github_settings">
					<div class="agsm-form-grid">
						<div>
							<label for="agsm-repository">GitHub Repository</label>
							<input id="agsm-repository" type="text" name="repository" value="<?php echo esc_attr((string) $github['repository']); ?>" placeholder="owner/repo">
							<p class="agsm-muted">Ornek: <code>oguzgokyar/TenteTamiri</code></p>
						</div>
						<div>
							<label for="agsm-branch">Branch</label>
							<input id="agsm-branch" type="text" name="branch" value="<?php echo esc_attr((string) $github['branch']); ?>" placeholder="main">
						</div>
						<div>
							<label for="agsm-token">GitHub Token</label>
							<input id="agsm-token" type="password" name="token" value="" autocomplete="new-password" placeholder="<?php echo esc_attr($this->updater->masked_token()); ?>">
							<p class="agsm-muted">Public repo icin bos birakilabilir. Private repo icin sadece repo okuma yetkili token kullanin.</p>
						</div>
						<div>
							<label>&nbsp;</label>
							<label style="font-weight:400;">
								<input type="checkbox" name="clear_token" value="1"> Kayitli tokeni temizle
							</label>
						</div>
					</div>
					<?php submit_button('GitHub Ayarlarini Kaydet', 'secondary', 'submit', false); ?>
				</form>

				<form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" style="margin-top: 16px;">
					<?php wp_nonce_field('agsm_sync_github'); ?>
					<input type="hidden" name="action" value="agsm_sync_github">
					<?php submit_button('GitHubdan Dosyalari Guncelle', 'primary', 'submit', false); ?>
				</form>

				<p class="agsm-muted">Guncellenen hedefler: <code>wp-content/themes/antigravity-elementor</code> ve <code>wp-content/plugins/antigravity-site-manager</code>.</p>

				<?php if (! empty($github_logs)) : ?>
					<table class="widefat striped agsm-table">
						<thead>
							<tr>
								<th>Tarih</th>
								<th>Repo</th>
								<th>Branch</th>
								<th>Durum</th>
								<th>Yedek</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach (array_slice($github_logs, 0, 5) as $log) : ?>
								<tr>
									<td><?php echo esc_html($log['time'] ?? ''); ?></td>
									<td><?php echo esc_html($log['repository'] ?? ''); ?></td>
									<td><?php echo esc_html($log['branch'] ?? ''); ?></td>
									<td><?php echo esc_html($log['status'] ?? ''); ?></td>
									<td><code><?php echo esc_html($log['backup_dir'] ?? ''); ?></code></td>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				<?php endif; ?>
			</div>

			<div class="agsm-card">
				<h2>Migration Onizleme</h2>
				<?php if (empty($dry_run)) : ?>
					<p><span class="agsm-status agsm-status--ok">Guncel</span> Bekleyen migration yok.</p>
				<?php else : ?>
					<?php foreach ($dry_run as $migration) : ?>
						<h3><?php echo esc_html($migration['id']); ?> - <?php echo esc_html($migration['title']); ?></h3>
						<?php if (! empty($migration['description'])) : ?>
							<p><?php echo esc_html($migration['description']); ?></p>
						<?php endif; ?>
						<table class="widefat striped agsm-table">
							<thead>
								<tr>
									<th>Islem</th>
									<th>Kayit</th>
									<th>Mod</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($migration['items'] as $item) : ?>
									<tr>
										<td><?php echo esc_html($item['action']); ?></td>
										<td><?php echo esc_html($item['label']); ?></td>
										<td><?php echo esc_html($item['mode']); ?></td>
									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					<?php endforeach; ?>

					<form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" style="margin-top: 16px;">
						<?php wp_nonce_field('agsm_apply_migrations'); ?>
						<input type="hidden" name="action" value="agsm_apply_migrations">
						<?php submit_button('Bekleyen Migrationlari Uygula', 'primary', 'submit', false); ?>
					</form>
				<?php endif; ?>
			</div>

			<div class="agsm-card" style="margin-top:16px;">
				<h2>Zorunlu Sayfa Kontrolu</h2>
				<table class="widefat striped agsm-table">
					<thead>
						<tr>
							<th>Durum</th>
							<th>Slug</th>
							<th>Baslik</th>
							<th>ID</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($health as $row) : ?>
							<tr>
								<td>
									<?php if ($row['exists']) : ?>
										<span class="agsm-status agsm-status--ok">Var</span>
									<?php else : ?>
										<span class="agsm-status agsm-status--bad">Eksik</span>
									<?php endif; ?>
								</td>
								<td><?php echo esc_html($row['slug']); ?></td>
								<td><?php echo esc_html($row['title']); ?></td>
								<td><?php echo esc_html($row['id'] ? (string) $row['id'] : '-'); ?></td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>

			<div class="agsm-card" style="margin-top:16px;">
				<h2>Son Loglar</h2>
				<?php if (empty($logs)) : ?>
					<p>Henuz log yok.</p>
				<?php else : ?>
					<table class="widefat striped agsm-table">
						<thead>
							<tr>
								<th>Tarih</th>
								<th>Migration</th>
								<th>Durum</th>
								<th>Mesaj</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach (array_slice($logs, 0, 10) as $log) : ?>
								<tr>
									<td><?php echo esc_html($log['time'] ?? ''); ?></td>
									<td><?php echo esc_html($log['migration'] ?? ''); ?></td>
									<td><?php echo esc_html($log['status'] ?? ''); ?></td>
									<td><?php echo esc_html($log['message'] ?? ''); ?></td>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				<?php endif; ?>
			</div>
		</div>
		<?php
	}

	private function render_notice(): void {
		$notice = sanitize_text_field(wp_unslash($_GET['agsm_notice'] ?? ''));

		if ('applied' === $notice) {
			echo '<div class="notice notice-success is-dismissible"><p>Bekleyen migrationlar uygulandi.</p></div>';
		}

		if ('error' === $notice) {
			echo '<div class="notice notice-error is-dismissible"><p>Migration uygulanirken hata olustu. Loglari kontrol edin.</p></div>';
		}

		if ('github_settings_saved' === $notice) {
			echo '<div class="notice notice-success is-dismissible"><p>GitHub ayarlari kaydedildi.</p></div>';
		}

		if ('github_synced' === $notice) {
			echo '<div class="notice notice-success is-dismissible"><p>GitHub dosyalari guncellendi. Simdi bekleyen migrationlari kontrol edin.</p></div>';
		}

		if ('github_error' === $notice) {
			$message = sanitize_text_field(wp_unslash($_GET['agsm_message'] ?? ''));
			$text    = $message ? 'GitHub guncellemesi basarisiz: ' . $message : 'GitHub guncellemesi basarisiz.';
			echo '<div class="notice notice-error is-dismissible"><p>' . esc_html($text) . '</p></div>';
		}
	}
}
