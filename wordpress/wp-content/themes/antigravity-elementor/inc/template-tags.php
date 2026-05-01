<?php
/**
 * Shared template helpers.
 *
 * @package AntigravityElementor
 */

if (! defined('ABSPATH')) {
	exit;
}

function antigravity_is_built_with_elementor(?int $post_id = null): bool {
	if (! class_exists('\Elementor\Plugin')) {
		return false;
	}

	$post_id = $post_id ?: get_the_ID();

	if (! $post_id) {
		return false;
	}

	$document = \Elementor\Plugin::$instance->documents->get($post_id);

	return $document ? (bool) $document->is_built_with_elementor() : false;
}

function antigravity_has_meaningful_elementor_content(?int $post_id = null): bool {
	$post_id = $post_id ?: get_the_ID();

	if (! $post_id || ! antigravity_is_built_with_elementor($post_id)) {
		return false;
	}

	$raw_data = get_post_meta($post_id, '_elementor_data', true);

	if (! is_string($raw_data) || '' === trim($raw_data)) {
		return false;
	}

	$normalized = trim($raw_data);

	return ! in_array($normalized, ['[]', 'null', ''], true);
}

function antigravity_posted_on(): void {
	$published = sprintf(
		'<time class="entry-date published" datetime="%1$s">%2$s</time>',
		esc_attr(get_the_date(DATE_W3C)),
		esc_html(get_the_date())
	);

	printf(
		'<div class="entry-meta"><span>%1$s</span><span>%2$s</span></div>',
		wp_kses_post($published),
		esc_html(get_the_author())
	);
}

function antigravity_breadcrumb_items(): array {
	$items = [
		[
			'label' => __('Ana Sayfa', 'antigravity-elementor'),
			'url'   => home_url('/'),
		],
	];

	if (is_front_page()) {
		return $items;
	}

	if (is_home()) {
		$items[] = [
			'label' => get_the_title((int) get_option('page_for_posts')) ?: __('Blog', 'antigravity-elementor'),
			'url'   => '',
		];

		return $items;
	}

	if (is_singular('page')) {
		$ancestors = array_reverse(get_post_ancestors(get_the_ID()));

		foreach ($ancestors as $ancestor_id) {
			$items[] = [
				'label' => get_the_title($ancestor_id),
				'url'   => get_permalink($ancestor_id),
			];
		}

		$items[] = [
			'label' => get_the_title(),
			'url'   => '',
		];

		return $items;
	}

	if (is_search()) {
		$items[] = [
			'label' => __('Arama Sonuclari', 'antigravity-elementor'),
			'url'   => '',
		];

		return $items;
	}

	if (is_404()) {
		$items[] = [
			'label' => __('404', 'antigravity-elementor'),
			'url'   => '',
		];

		return $items;
	}

	if (is_archive()) {
		if (is_category() || is_tag() || is_tax()) {
			$post_type = get_post_type();
			$archive   = $post_type ? get_post_type_archive_link($post_type) : '';

			if ($archive) {
				$items[] = [
					'label' => post_type_archive_title('', false),
					'url'   => $archive,
				];
			}
		}

		$items[] = [
			'label' => wp_strip_all_tags(get_the_archive_title()),
			'url'   => '',
		];

		return $items;
	}

	if (is_singular()) {
		$post_type = get_post_type();

		if ($post_type && 'post' !== $post_type) {
			$archive = get_post_type_archive_link($post_type);

			if ($archive) {
				$items[] = [
					'label' => post_type_archive_title('', false),
					'url'   => $archive,
				];
			}
		}

		$items[] = [
			'label' => get_the_title(),
			'url'   => '',
		];
	}

	return $items;
}

function antigravity_render_breadcrumbs(): void {
	if (antigravity_render_rank_math_breadcrumbs()) {
		return;
	}

	$items = antigravity_breadcrumb_items();

	if (count($items) < 2) {
		return;
	}
	?>
	<nav class="breadcrumb-nav" aria-label="<?php esc_attr_e('Breadcrumb', 'antigravity-elementor'); ?>">
		<ol class="breadcrumb-list">
			<?php foreach ($items as $index => $item) : ?>
				<li class="breadcrumb-list__item">
					<?php if (! empty($item['url']) && $index < count($items) - 1) : ?>
						<a href="<?php echo esc_url($item['url']); ?>"><?php echo esc_html($item['label']); ?></a>
					<?php else : ?>
						<span aria-current="page"><?php echo esc_html($item['label']); ?></span>
					<?php endif; ?>
				</li>
			<?php endforeach; ?>
		</ol>
	</nav>
	<?php
}

function antigravity_render_rank_math_breadcrumbs(): bool {
	if (is_front_page() || ! function_exists('rank_math_the_breadcrumbs')) {
		return false;
	}

	ob_start();
	rank_math_the_breadcrumbs();
	$markup = trim((string) ob_get_clean());

	if ('' === $markup) {
		return false;
	}
	?>
	<nav class="breadcrumb-nav breadcrumb-nav--rankmath" aria-label="<?php esc_attr_e('Breadcrumb', 'antigravity-elementor'); ?>">
		<?php echo wp_kses_post($markup); ?>
	</nav>
	<?php

	return true;
}

function antigravity_site_logo(string $class = 'site-logo'): string {
	$logo_url = ANTIGRAVITY_THEME_URI . '/assets/images/istanbul-tente-logo.svg';

	return sprintf(
		'<a class="%1$s" href="%2$s" rel="home"><img src="%3$s" alt="%4$s" width="360" height="96"></a>',
		esc_attr($class),
		esc_url(home_url('/')),
		esc_url($logo_url),
		esc_attr(get_bloginfo('name') ?: __('Istanbul Tente Tamircisi', 'antigravity-elementor'))
	);
}

function antigravity_context_visuals(?int $post_id = null): array {
	$post_id = $post_id ?: get_the_ID();
	$slug    = $post_id ? get_post_field('post_name', $post_id) : '';

	$library = [
		'default' => [
			'hero'    => [
				'image'   => 'https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?auto=format&fit=crop&w=1400&q=80',
				'label'   => __('Yerinde Servis', 'antigravity-elementor'),
				'title'   => __('Pergola ve tente sistemlerinde sahaya uygun teknik cozum.', 'antigravity-elementor'),
				'caption' => __('Motor, kumas ve mekanizma arizalarinda kontrollu servis akisi.', 'antigravity-elementor'),
			],
			'gallery' => [
				[
					'image' => 'https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?auto=format&fit=crop&w=900&q=80',
					'label' => __('Pergola Sistemleri', 'antigravity-elementor'),
				],
				[
					'image' => 'https://images.unsplash.com/photo-1494526585095-c41746248156?auto=format&fit=crop&w=900&q=80',
					'label' => __('Tente Servisi', 'antigravity-elementor'),
				],
				[
					'image' => 'https://images.unsplash.com/photo-1512918728675-ed5a9ecdebfd?auto=format&fit=crop&w=900&q=80',
					'label' => __('Zip Perde Destegi', 'antigravity-elementor'),
				],
			],
		],
		'hakkimizda' => [
			'hero'    => [
				'image'   => 'https://images.unsplash.com/photo-1484154218962-a197022b5858?auto=format&fit=crop&w=1400&q=80',
				'label'   => __('Kurumsal Servis', 'antigravity-elementor'),
				'title'   => __('Istanbul geneline yayilan planli ve guvenilir saha organizasyonu.', 'antigravity-elementor'),
				'caption' => __('Sultanbeyli merkezli ekip ile ilce bazli servis yonetimi.', 'antigravity-elementor'),
			],
		],
		'iletisim' => [
			'hero'    => [
				'image'   => 'https://images.unsplash.com/photo-1448630360428-65456885c650?auto=format&fit=crop&w=1400&q=80',
				'label'   => __('Hizli Ulasim', 'antigravity-elementor'),
				'title'   => __('Telefon, WhatsApp ve yerinde kesif akisini tek merkezden yonetiyoruz.', 'antigravity-elementor'),
				'caption' => __('Ariza bilgisi ve gorsel destek ile sureci hizlandirin.', 'antigravity-elementor'),
			],
		],
		'tente-tamiri' => [
			'hero' => [
				'image'   => 'https://images.unsplash.com/photo-1494526585095-c41746248156?auto=format&fit=crop&w=1400&q=80',
				'label'   => __('Tente Tamiri', 'antigravity-elementor'),
				'title'   => __('Mafsalli, kasetli ve koruklu sistemlerde hedefli onarim.', 'antigravity-elementor'),
				'caption' => __('Kol, mafsal, kumas ve motor sorunlarinda sahaya uygun mudahale.', 'antigravity-elementor'),
			],
		],
		'pergola-tamiri' => [
			'hero' => [
				'image'   => 'https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?auto=format&fit=crop&w=1400&q=80',
				'label'   => __('Pergola Tamiri', 'antigravity-elementor'),
				'title'   => __('Motorlu tavan ve ray sistemlerinde profesyonel servis destegi.', 'antigravity-elementor'),
				'caption' => __('Su alma, ray zorlanmasi ve kumas problemlerinde kontrollu teknik cozum.', 'antigravity-elementor'),
			],
		],
		'zip-perde-tamiri' => [
			'hero' => [
				'image'   => 'https://images.unsplash.com/photo-1512918728675-ed5a9ecdebfd?auto=format&fit=crop&w=1400&q=80',
				'label'   => __('Zip Perde Tamiri', 'antigravity-elementor'),
				'title'   => __('Ray, gerilim ve motor ayarinda akici calisma odakli servis.', 'antigravity-elementor'),
				'caption' => __('Takilma ve dengesiz hareket sorunlarinda yerinde tespit.', 'antigravity-elementor'),
			],
		],
		'tente-motoru-tamiri' => [
			'hero' => [
				'image'   => 'https://images.unsplash.com/photo-1484154218962-a197022b5858?auto=format&fit=crop&w=1400&q=80',
				'label'   => __('Motor Servisi', 'antigravity-elementor'),
				'title'   => __('Motor, alici kart ve kumanda sorunlari icin odak servis.', 'antigravity-elementor'),
				'caption' => __('Dur-kalk, limit ve alici kart sorunlarinda hedefli kontrol.', 'antigravity-elementor'),
			],
		],
		'tente-kumasi-degisimi' => [
			'hero' => [
				'image'   => 'https://images.unsplash.com/photo-1448630360428-65456885c650?auto=format&fit=crop&w=1400&q=80',
				'label'   => __('Kumas Yenileme', 'antigravity-elementor'),
				'title'   => __('Yipranan tente kumaslarini sisteme uygun sekilde yeniliyoruz.', 'antigravity-elementor'),
				'caption' => __('Renk, gerilim ve dayanim dengesini saha kosuluna gore planliyoruz.', 'antigravity-elementor'),
			],
		],
		'mekanizma-ve-mafsal-onarimi' => [
			'hero' => [
				'image'   => 'https://images.unsplash.com/photo-1494526585095-c41746248156?auto=format&fit=crop&w=1400&q=80',
				'label'   => __('Mafsal ve Mekanizma', 'antigravity-elementor'),
				'title'   => __('Acilma-kapanma dengesini bozan mekanik arizalara hedefli cozum.', 'antigravity-elementor'),
				'caption' => __('Kol, mafsal ve baglanti noktalarinda guvenli calisma odakli onarim.', 'antigravity-elementor'),
			],
		],
		'sultanbeyli-tente-tamiri' => [
			'hero' => [
				'image'   => 'https://images.unsplash.com/photo-1494526585095-c41746248156?auto=format&fit=crop&w=1400&q=80',
				'label'   => __('Sultanbeyli Tente Tamiri', 'antigravity-elementor'),
				'title'   => __('Sultanbeyli ve yakin cevre icin yerinde tente servisi.', 'antigravity-elementor'),
				'caption' => __('Motor, kumas, mafsal ve mekanizma arizalarinda hizli servis planlamasi.', 'antigravity-elementor'),
			],
		],
	];

	$visuals = $library[ $slug ] ?? $library['default'];

	if (! isset($visuals['gallery'])) {
		$visuals['gallery'] = $library['default']['gallery'];
	}

	return $visuals;
}

function antigravity_page_intro(string $eyebrow, string $title, string $description, array $args = []): void {
	$args = wp_parse_args(
		$args,
		[
			'variant' => 'page',
		]
	);

	$visuals = antigravity_context_visuals();

	if ('post' === $args['variant']) {
		?>
		<section class="page-intro page-intro--post">
			<div class="container">
				<p class="eyebrow"><?php echo esc_html($eyebrow); ?></p>
				<h1><?php echo esc_html($title); ?></h1>
				<p class="page-intro__copy"><?php echo esc_html($description); ?></p>
			</div>
		</section>
		<?php

		return;
	}

	?>
	<section class="page-hero page-hero--service">
		<div class="page-hero__media" style="background-image: url('<?php echo esc_url($visuals['hero']['image']); ?>');"></div>
		<div class="page-hero__shade"></div>
		<div class="container-wide page-hero__inner">
			<div class="page-hero__layout">
				<div class="page-hero__content" data-reveal="hero-rise">
					<?php antigravity_render_breadcrumbs(); ?>
					<p class="eyebrow"><?php echo esc_html($eyebrow); ?></p>
					<h1><?php echo esc_html($title); ?></h1>
					<p class="page-hero__copy"><?php echo esc_html($description); ?></p>
				</div>
			</div>
			<div class="page-hero__quickbar" data-reveal="lift">
				<div class="page-hero__quickitem">
					<?php echo antigravity_icon('clock', 'icon-mark icon-mark--light'); ?>
					<span><?php esc_html_e('7/24 servis talebi', 'antigravity-elementor'); ?></span>
				</div>
				<div class="page-hero__quickitem">
					<?php echo antigravity_icon('wrench', 'icon-mark icon-mark--light'); ?>
					<span><?php esc_html_e('Yerinde tespit ve onarim', 'antigravity-elementor'); ?></span>
				</div>
				<div class="page-hero__quickitem">
					<?php echo antigravity_icon('message', 'icon-mark icon-mark--light'); ?>
					<span><?php esc_html_e('WhatsApp ile gorsel destek', 'antigravity-elementor'); ?></span>
				</div>
			</div>
		</div>
	</section>
	<?php
}

function antigravity_icon(string $name, string $class = 'icon-mark'): string {
	$icons = [
		'wrench' => '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M21 7.5a5 5 0 0 1-6.84 4.65l-7.8 7.8a1.5 1.5 0 1 1-2.12-2.12l7.8-7.8A5 5 0 0 1 16.5 3l-2.2 2.2 1.5 3 3-1.5L21 7.5Z" fill="currentColor"/></svg>',
		'shield' => '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 2 4 5v6c0 5.25 3.4 10.17 8 11.73 4.6-1.56 8-6.48 8-11.73V5l-8-3Zm-1 14-3-3 1.4-1.4 1.6 1.6 4.6-4.6L17 10l-6 6Z" fill="currentColor"/></svg>',
		'pin' => '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 2a7 7 0 0 0-7 7c0 5.15 7 13 7 13s7-7.85 7-13a7 7 0 0 0-7-7Zm0 9.5A2.5 2.5 0 1 1 12 6a2.5 2.5 0 0 1 0 5.5Z" fill="currentColor"/></svg>',
		'phone' => '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M6.6 10.8a15.4 15.4 0 0 0 6.6 6.6l2.2-2.2a1 1 0 0 1 1-.24c1.1.36 2.27.54 3.46.54a1 1 0 0 1 1 1V20a1 1 0 0 1-1 1C10.3 21 3 13.7 3 4a1 1 0 0 1 1-1h3.5a1 1 0 0 1 1 1c0 1.19.18 2.36.54 3.46a1 1 0 0 1-.24 1l-2.2 2.34Z" fill="currentColor"/></svg>',
		'bolt' => '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M13 2 5 13h5l-1 9 8-11h-5l1-9Z" fill="currentColor"/></svg>',
		'fabric' => '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M4 4h16v5l-4 2-4-2-4 2-4-2V4Zm0 7 4 2 4-2 4 2 4-2v9H4v-9Z" fill="currentColor"/></svg>',
		'route' => '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M6 3a3 3 0 1 1 0 6 3 3 0 0 1 0-6Zm12 12a3 3 0 1 1 0 6 3 3 0 0 1 0-6ZM6 9v2c0 1.66 1.34 3 3 3h4a3 3 0 0 1 3 3v1h-2v-1a1 1 0 0 0-1-1H9a5 5 0 0 1-5-5V9h2Zm12 6h-2v-2h2v2Z" fill="currentColor"/></svg>',
		'clock' => '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 2a10 10 0 1 0 0 20 10 10 0 0 0 0-20Zm1 5h-2v6l5 3 1-1.73-4-2.27V7Z" fill="currentColor"/></svg>',
		'message' => '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M4 4h16v11H7l-3 3V4Zm3 4v2h10V8H7Zm0 4v2h7v-2H7Z" fill="currentColor"/></svg>',
		'play' => '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M8 5v14l11-7L8 5Z" fill="currentColor"/></svg>',
	];

	$markup = $icons[ $name ] ?? $icons['wrench'];

	return sprintf('<span class="%1$s">%2$s</span>', esc_attr($class), $markup);
}

function antigravity_service_mascot_svg(): string {
	return '
	<svg class="service-widget__illustration" viewBox="0 0 220 260" aria-hidden="true">
		<defs>
			<linearGradient id="ag-helmet" x1="0" x2="1" y1="0" y2="1">
				<stop offset="0%" stop-color="#D6A24C"/>
				<stop offset="100%" stop-color="#C46F2A"/>
			</linearGradient>
			<linearGradient id="ag-suit" x1="0" x2="1" y1="0" y2="1">
				<stop offset="0%" stop-color="#1A2F3A"/>
				<stop offset="100%" stop-color="#284756"/>
			</linearGradient>
		</defs>
		<ellipse cx="118" cy="236" rx="62" ry="18" fill="rgba(16,26,32,0.12)"/>
		<g class="service-widget__mascot">
			<path d="M102 36c18 0 31 12 31 30v14H71V66c0-18 13-30 31-30Z" fill="url(#ag-helmet)"/>
			<rect x="80" y="69" width="45" height="16" rx="8" fill="#F5D7A7"/>
			<circle cx="102" cy="92" r="31" fill="#F1C89D"/>
			<circle cx="91" cy="89" r="3.8" fill="#172126"/>
			<circle cx="113" cy="89" r="3.8" fill="#172126"/>
			<path d="M93 104c5 5 15 5 20 0" stroke="#9A5A3A" stroke-width="4" stroke-linecap="round"/>
			<path d="M79 85c2-10 11-18 23-18 11 0 21 8 23 18" stroke="#C98F57" stroke-width="5" stroke-linecap="round"/>
			<path d="M84 77c8 4 28 4 36 0" stroke="#B26A2E" stroke-width="7" stroke-linecap="round"/>
			<rect x="73" y="123" width="58" height="66" rx="20" fill="url(#ag-suit)"/>
			<rect x="92" y="123" width="20" height="28" rx="10" fill="#D6A24C"/>
			<path d="M83 153h38" stroke="#D6A24C" stroke-width="6" stroke-linecap="round"/>
			<path d="M85 124h34l-6 15H91l-6-15Z" fill="#F4E4CB"/>
			<g class="service-widget__arm service-widget__arm--wave">
				<path d="M75 132c-11 6-24 18-27 38" stroke="#F1C89D" stroke-width="15" stroke-linecap="round"/>
				<path d="M43 169c0-8 6-13 12-13 8 0 14 7 14 16 0 7-4 12-9 13" fill="#F1C89D"/>
			</g>
			<g class="service-widget__arm service-widget__arm--point">
				<path d="M128 133c18 6 34 25 34 58" stroke="#F1C89D" stroke-width="15" stroke-linecap="round"/>
				<path d="M163 192c-2 14-8 28-15 34" stroke="#F1C89D" stroke-width="14" stroke-linecap="round"/>
				<path d="M144 224c5 1 12 2 18-1" stroke="#F1C89D" stroke-width="8" stroke-linecap="round"/>
			</g>
			<path d="M89 189v36" stroke="#243E4B" stroke-width="16" stroke-linecap="round"/>
			<path d="M115 189v36" stroke="#243E4B" stroke-width="16" stroke-linecap="round"/>
			<path d="M74 225h26" stroke="#172126" stroke-width="14" stroke-linecap="round"/>
			<path d="M104 225h26" stroke="#172126" stroke-width="14" stroke-linecap="round"/>
			<circle cx="102" cy="144" r="6" fill="#D6A24C"/>
			<path class="service-widget__arrow" d="M144 228c10 12 7 24-1 32" stroke="#D6A24C" stroke-width="4" stroke-linecap="round" stroke-dasharray="5 8"/>
			<path class="service-widget__arrow" d="M136 252l8 11 7-13" fill="none" stroke="#D6A24C" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
		</g>
	</svg>';
}

function antigravity_render_marketing_sections(array $sections): void {
	foreach ($sections as $section) {
		if ('district_local_intro' === $section['type']) {
			?>
			<section class="section-shell section-shell--district">
				<div class="container district-local-intro">
					<div class="district-local-intro__map" data-reveal="soft-zoom">
						<?php echo antigravity_icon('pin', 'icon-mark icon-mark--light'); ?>
						<strong><?php echo esc_html($section['district']); ?></strong>
						<span><?php echo esc_html($section['route_note']); ?></span>
					</div>
					<div class="district-local-intro__copy" data-reveal="hero-rise">
						<p class="eyebrow"><?php echo esc_html($section['eyebrow'] ?? __('Bolge Servisi', 'antigravity-elementor')); ?></p>
						<h2><?php echo esc_html($section['title']); ?></h2>
						<p><?php echo esc_html($section['copy']); ?></p>
						<?php if (! empty($section['facts'])) : ?>
							<div class="district-fact-row">
								<?php foreach ($section['facts'] as $fact) : ?>
									<span>
										<strong><?php echo esc_html($fact['value']); ?></strong>
										<small><?php echo esc_html($fact['label']); ?></small>
									</span>
								<?php endforeach; ?>
							</div>
						<?php endif; ?>
					</div>
				</div>
			</section>
			<?php
			continue;
		}

		if ('district_problem_rows' === $section['type']) {
			?>
			<section class="section-shell">
				<div class="container district-problem-panel">
					<div class="section-heading">
						<p class="eyebrow"><?php echo esc_html($section['eyebrow'] ?? __('Bolgedeki Talepler', 'antigravity-elementor')); ?></p>
						<h2><?php echo esc_html($section['title']); ?></h2>
						<?php if (! empty($section['copy'])) : ?>
							<p><?php echo esc_html($section['copy']); ?></p>
						<?php endif; ?>
					</div>
					<div class="district-problem-list">
						<?php foreach ($section['rows'] as $row) : ?>
							<article class="district-problem-row" data-reveal="lift">
								<?php echo antigravity_icon($row['icon'] ?? 'wrench', 'icon-mark icon-mark--ghost'); ?>
								<div>
									<h3><?php echo esc_html($row['title']); ?></h3>
									<p><?php echo esc_html($row['description']); ?></p>
								</div>
							</article>
						<?php endforeach; ?>
					</div>
				</div>
			</section>
			<?php
			continue;
		}

		if ('district_access_flow' === $section['type']) {
			?>
			<section class="section-shell">
				<div class="container district-access-flow">
					<div class="district-access-flow__heading" data-reveal="hero-rise">
						<p class="eyebrow"><?php echo esc_html($section['eyebrow'] ?? __('Servis Planlama', 'antigravity-elementor')); ?></p>
						<h2><?php echo esc_html($section['title']); ?></h2>
						<?php if (! empty($section['copy'])) : ?>
							<p><?php echo esc_html($section['copy']); ?></p>
						<?php endif; ?>
					</div>
					<ol class="district-access-steps">
						<?php foreach ($section['steps'] as $index => $step) : ?>
							<li data-reveal="lift">
								<span><?php echo esc_html(str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT)); ?></span>
								<strong><?php echo esc_html($step['title']); ?></strong>
								<small><?php echo esc_html($step['description']); ?></small>
							</li>
						<?php endforeach; ?>
					</ol>
				</div>
			</section>
			<?php
			continue;
		}

		if ('district_service_scope' === $section['type']) {
			?>
			<section class="section-shell">
				<div class="container district-scope-band">
					<div class="section-heading">
						<p class="eyebrow"><?php echo esc_html($section['eyebrow'] ?? __('Yerel Kapsam', 'antigravity-elementor')); ?></p>
						<h2><?php echo esc_html($section['title']); ?></h2>
						<?php if (! empty($section['copy'])) : ?>
							<p><?php echo esc_html($section['copy']); ?></p>
						<?php endif; ?>
					</div>
					<div class="district-scope-grid">
						<?php foreach ($section['cards'] as $card) : ?>
							<article class="district-scope-card" data-reveal="lift">
								<?php echo antigravity_icon($card['icon'] ?? 'shield', 'icon-mark icon-mark--ghost'); ?>
								<h3><?php echo esc_html($card['title']); ?></h3>
								<p><?php echo esc_html($card['description']); ?></p>
							</article>
						<?php endforeach; ?>
					</div>
				</div>
			</section>
			<?php
			continue;
		}

		if ('district_cta' === $section['type']) {
			?>
			<section class="section-shell">
				<div class="container">
					<div class="district-cta-panel" data-reveal="hero-rise">
						<div>
							<p class="eyebrow"><?php echo esc_html($section['eyebrow'] ?? __('Bolge Servisi', 'antigravity-elementor')); ?></p>
							<h2><?php echo esc_html($section['title']); ?></h2>
							<p><?php echo esc_html($section['copy']); ?></p>
						</div>
						<div class="button-row">
							<a class="button" href="<?php echo esc_url(antigravity_contact_phone_href()); ?>"><?php echo esc_html($section['primary_label'] ?? __('Hemen Ara', 'antigravity-elementor')); ?></a>
							<a class="button button--ghost button--ghost-light" href="<?php echo esc_url(antigravity_contact_whatsapp_href()); ?>" target="_blank" rel="noopener noreferrer"><?php echo esc_html($section['secondary_label'] ?? antigravity_contact_whatsapp_label()); ?></a>
						</div>
					</div>
				</div>
			</section>
			<?php
			continue;
		}

		if ('service_catalog' === $section['type']) {
			?>
			<section class="section-shell section-shell--service-catalog">
				<div class="container-wide services-overview">
					<div class="section-heading services-overview__heading">
						<p class="eyebrow"><?php echo esc_html($section['eyebrow'] ?? __('Hizmet Katalogu', 'antigravity-elementor')); ?></p>
						<h2><?php echo esc_html($section['title']); ?></h2>
						<?php if (! empty($section['copy'])) : ?>
							<p><?php echo esc_html($section['copy']); ?></p>
						<?php endif; ?>
					</div>
					<div class="services-showcase-grid">
						<?php foreach ($section['cards'] as $card) : ?>
							<a class="services-showcase-card" href="<?php echo esc_url($card['url']); ?>" data-reveal="lift">
								<span class="services-showcase-card__media" style="background-image: linear-gradient(180deg, rgba(16, 26, 32, 0.02), rgba(16, 26, 32, 0.68)), url('<?php echo esc_url($card['image']); ?>');">
									<?php echo antigravity_icon($card['icon'] ?? 'wrench', 'icon-mark icon-mark--light'); ?>
									<?php if (! empty($card['badge'])) : ?>
										<small><?php echo esc_html($card['badge']); ?></small>
									<?php endif; ?>
								</span>
								<span class="services-showcase-card__body">
									<strong><?php echo esc_html($card['title']); ?></strong>
									<span><?php echo esc_html($card['description']); ?></span>
									<?php if (! empty($card['tags'])) : ?>
										<span class="services-showcase-card__tags">
											<?php foreach ($card['tags'] as $tag) : ?>
												<em><?php echo esc_html($tag); ?></em>
											<?php endforeach; ?>
										</span>
									<?php endif; ?>
								</span>
							</a>
						<?php endforeach; ?>
					</div>
				</div>
			</section>
			<?php
			continue;
		}

		if ('intro' === $section['type']) {
			?>
			<section class="section-shell">
				<div class="container story-card">
					<p class="eyebrow"><?php echo esc_html($section['title']); ?></p>
					<p class="marketing-copy"><?php echo esc_html($section['copy']); ?></p>
				</div>
			</section>
			<?php
			continue;
		}

		if ('list' === $section['type']) {
			?>
			<section class="section-shell">
				<div class="container story-card">
					<h2><?php echo esc_html($section['title']); ?></h2>
					<ul class="check-list">
						<?php foreach ($section['items'] as $item) : ?>
							<li><?php echo esc_html($item); ?></li>
						<?php endforeach; ?>
					</ul>
				</div>
			</section>
			<?php
			continue;
		}

		if ('cards' === $section['type']) {
			?>
			<section class="section-shell">
				<div class="container">
					<div class="section-heading">
						<p class="eyebrow"><?php esc_html_e('Servis Alanlari', 'antigravity-elementor'); ?></p>
						<h2><?php echo esc_html($section['title']); ?></h2>
					</div>
					<div class="card-grid">
						<?php foreach ($section['cards'] as $card) : ?>
							<article class="feature-card">
								<h3><?php echo esc_html($card['title']); ?></h3>
								<p><?php echo esc_html($card['description']); ?></p>
							</article>
						<?php endforeach; ?>
					</div>
				</div>
			</section>
			<?php
			continue;
		}

		if ('service_visual_intro' === $section['type']) {
			?>
			<section class="section-shell section-shell--service-visual">
				<div class="container service-visual-intro">
					<div class="service-visual-intro__copy" data-reveal="hero-rise">
						<p class="eyebrow"><?php echo esc_html($section['eyebrow'] ?? __('Servis Ozeti', 'antigravity-elementor')); ?></p>
						<h2><?php echo esc_html($section['title']); ?></h2>
						<p><?php echo esc_html($section['copy']); ?></p>
						<?php if (! empty($section['items'])) : ?>
							<ul class="check-list">
								<?php foreach ($section['items'] as $item) : ?>
									<li><?php echo esc_html($item); ?></li>
								<?php endforeach; ?>
							</ul>
						<?php endif; ?>
					</div>
					<div class="service-visual-intro__media" style="background-image: linear-gradient(180deg, rgba(16, 26, 32, 0.08), rgba(16, 26, 32, 0.58)), url('<?php echo esc_url($section['image']); ?>');" data-reveal="soft-zoom">
						<?php if (! empty($section['badge'])) : ?>
							<span><?php echo esc_html($section['badge']); ?></span>
						<?php endif; ?>
					</div>
				</div>
			</section>
			<?php
			continue;
		}

		if ('service_image_cards' === $section['type']) {
			?>
			<section class="section-shell">
				<div class="container">
					<div class="section-heading">
						<p class="eyebrow"><?php echo esc_html($section['eyebrow'] ?? __('Sik Arizalar', 'antigravity-elementor')); ?></p>
						<h2><?php echo esc_html($section['title']); ?></h2>
						<?php if (! empty($section['copy'])) : ?>
							<p><?php echo esc_html($section['copy']); ?></p>
						<?php endif; ?>
					</div>
					<div class="service-image-grid">
						<?php foreach ($section['cards'] as $card) : ?>
							<article class="service-image-card" data-reveal="lift">
								<div class="service-image-card__media" style="background-image: linear-gradient(180deg, rgba(16, 26, 32, 0.02), rgba(16, 26, 32, 0.62)), url('<?php echo esc_url($card['image']); ?>');">
									<?php echo antigravity_icon($card['icon'] ?? 'wrench', 'icon-mark icon-mark--light'); ?>
								</div>
								<div class="service-image-card__body">
									<h3><?php echo esc_html($card['title']); ?></h3>
									<p><?php echo esc_html($card['description']); ?></p>
								</div>
							</article>
						<?php endforeach; ?>
					</div>
				</div>
			</section>
			<?php
			continue;
		}

		if ('service_video' === $section['type']) {
			?>
			<section class="section-shell">
				<div class="container service-video-block">
					<div class="service-video-block__media" data-reveal="soft-zoom">
						<div class="service-video-block__poster" style="background-image: linear-gradient(180deg, rgba(16, 26, 32, 0.04), rgba(16, 26, 32, 0.72)), url('<?php echo esc_url($section['poster']); ?>');">
							<span class="service-video-block__play" aria-hidden="true"><?php echo antigravity_icon('play', 'icon-mark icon-mark--light'); ?></span>
							<div>
								<strong><?php echo esc_html($section['video_label'] ?? __('Hizmet Videosu', 'antigravity-elementor')); ?></strong>
								<small><?php echo esc_html($section['duration'] ?? __('Kisa servis anlatimi', 'antigravity-elementor')); ?></small>
							</div>
						</div>
					</div>
					<div class="service-video-block__copy" data-reveal="hero-rise">
						<p class="eyebrow"><?php echo esc_html($section['eyebrow'] ?? __('Hizmet Videosu', 'antigravity-elementor')); ?></p>
						<h2><?php echo esc_html($section['title']); ?></h2>
						<p><?php echo esc_html($section['copy']); ?></p>
						<?php if (! empty($section['items'])) : ?>
							<ul class="check-list">
								<?php foreach ($section['items'] as $item) : ?>
									<li><?php echo esc_html($item); ?></li>
								<?php endforeach; ?>
							</ul>
						<?php endif; ?>
					</div>
				</div>
			</section>
			<?php
			continue;
		}

		if ('service_gallery' === $section['type']) {
			?>
			<section class="section-shell">
				<div class="container">
					<div class="section-heading">
						<p class="eyebrow"><?php echo esc_html($section['eyebrow'] ?? __('Gorsel Galeri', 'antigravity-elementor')); ?></p>
						<h2><?php echo esc_html($section['title']); ?></h2>
						<?php if (! empty($section['copy'])) : ?>
							<p><?php echo esc_html($section['copy']); ?></p>
						<?php endif; ?>
					</div>
					<div class="service-gallery-grid">
						<?php foreach ($section['images'] as $image) : ?>
							<figure class="service-gallery-item" data-reveal="lift">
								<img src="<?php echo esc_url($image['src']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" loading="lazy">
								<?php if (! empty($image['caption'])) : ?>
									<figcaption><?php echo esc_html($image['caption']); ?></figcaption>
								<?php endif; ?>
							</figure>
						<?php endforeach; ?>
					</div>
				</div>
			</section>
			<?php
			continue;
		}

		if ('service_metrics' === $section['type']) {
			?>
			<section class="section-shell">
				<div class="container">
					<div class="section-heading">
						<p class="eyebrow"><?php echo esc_html($section['eyebrow'] ?? __('Servis Avantajlari', 'antigravity-elementor')); ?></p>
						<h2><?php echo esc_html($section['title']); ?></h2>
						<?php if (! empty($section['copy'])) : ?>
							<p><?php echo esc_html($section['copy']); ?></p>
						<?php endif; ?>
					</div>
					<div class="service-metric-grid">
						<?php foreach ($section['items'] as $item) : ?>
							<article class="stats-card service-metric-card" data-reveal="lift">
								<?php echo antigravity_icon($item['icon'] ?? 'shield'); ?>
								<strong><?php echo esc_html($item['value']); ?></strong>
								<h3><?php echo esc_html($item['title']); ?></h3>
								<p><?php echo esc_html($item['description']); ?></p>
							</article>
						<?php endforeach; ?>
					</div>
				</div>
			</section>
			<?php
			continue;
		}

		if ('problem_cards' === $section['type']) {
			?>
			<section class="section-shell">
				<div class="container">
					<div class="section-heading">
						<p class="eyebrow"><?php echo esc_html($section['eyebrow'] ?? __('Sik Sorunlar', 'antigravity-elementor')); ?></p>
						<h2><?php echo esc_html($section['title']); ?></h2>
						<?php if (! empty($section['copy'])) : ?>
							<p><?php echo esc_html($section['copy']); ?></p>
						<?php endif; ?>
					</div>
					<div class="card-grid service-problem-grid">
						<?php foreach ($section['cards'] as $card) : ?>
							<article class="feature-card service-problem-card" data-reveal="lift">
								<?php echo antigravity_icon($card['icon'] ?? 'wrench'); ?>
								<h3><?php echo esc_html($card['title']); ?></h3>
								<p><?php echo esc_html($card['description']); ?></p>
							</article>
						<?php endforeach; ?>
					</div>
				</div>
			</section>
			<?php
			continue;
		}

		if ('service_split' === $section['type']) {
			?>
			<section class="section-shell">
				<div class="container service-split">
					<div class="story-card story-card--dark" data-reveal="hero-rise">
						<p class="eyebrow"><?php echo esc_html($section['eyebrow'] ?? __('Servis Alani', 'antigravity-elementor')); ?></p>
						<h2><?php echo esc_html($section['title']); ?></h2>
						<p><?php echo esc_html($section['copy']); ?></p>
						<?php if (! empty($section['items'])) : ?>
							<ul class="check-list">
								<?php foreach ($section['items'] as $item) : ?>
									<li><?php echo esc_html($item); ?></li>
								<?php endforeach; ?>
							</ul>
						<?php endif; ?>
					</div>
					<div class="stats-card service-split__panel" data-reveal="soft-zoom">
						<?php if (! empty($section['panel_title'])) : ?>
							<p class="eyebrow"><?php esc_html_e('Teknik Notlar', 'antigravity-elementor'); ?></p>
							<h2><?php echo esc_html($section['panel_title']); ?></h2>
						<?php endif; ?>
						<?php if (! empty($section['panel_points'])) : ?>
							<div class="service-note-stack">
								<?php foreach ($section['panel_points'] as $point) : ?>
									<div class="service-note">
										<?php echo antigravity_icon($point['icon'] ?? 'shield', 'icon-mark icon-mark--ghost'); ?>
										<div>
											<strong><?php echo esc_html($point['title']); ?></strong>
											<p><?php echo esc_html($point['description']); ?></p>
										</div>
									</div>
								<?php endforeach; ?>
							</div>
						<?php endif; ?>
					</div>
				</div>
			</section>
			<?php
			continue;
		}

		if ('service_process' === $section['type']) {
			?>
			<section class="section-shell">
				<div class="container">
					<div class="section-heading">
						<p class="eyebrow"><?php echo esc_html($section['eyebrow'] ?? __('Surec', 'antigravity-elementor')); ?></p>
						<h2><?php echo esc_html($section['title']); ?></h2>
					</div>
					<div class="process-grid">
						<?php foreach ($section['steps'] as $index => $step) : ?>
							<article class="process-card" data-reveal="lift">
								<?php echo antigravity_icon($step['icon'] ?? 'route'); ?>
								<strong><?php echo esc_html(sprintf('%02d', $index + 1)); ?></strong>
								<h3><?php echo esc_html($step['title']); ?></h3>
								<p><?php echo esc_html($step['description']); ?></p>
							</article>
						<?php endforeach; ?>
					</div>
				</div>
			</section>
			<?php
			continue;
		}

		if ('service_districts' === $section['type']) {
			?>
			<section class="section-shell">
				<div class="container story-card" data-reveal="hero-rise">
					<p class="eyebrow"><?php echo esc_html($section['eyebrow'] ?? __('Servis Bolgeleri', 'antigravity-elementor')); ?></p>
					<h2><?php echo esc_html($section['title']); ?></h2>
					<p><?php echo esc_html($section['copy']); ?></p>
					<div class="keyword-cluster">
						<?php foreach ($section['districts'] as $district) : ?>
							<span class="district-pill"><?php echo esc_html($district); ?></span>
						<?php endforeach; ?>
					</div>
				</div>
			</section>
			<?php
			continue;
		}

		if ('service_cta' === $section['type']) {
			?>
			<section class="section-shell">
				<div class="container">
					<div class="cta-banner" data-reveal="hero-rise">
						<div>
							<p class="eyebrow"><?php echo esc_html($section['eyebrow'] ?? __('Hemen Destek', 'antigravity-elementor')); ?></p>
							<h2><?php echo esc_html($section['title']); ?></h2>
							<p><?php echo esc_html($section['copy']); ?></p>
						</div>
						<div class="button-row">
							<a class="button" href="<?php echo esc_url(antigravity_contact_phone_href()); ?>"><?php echo esc_html($section['primary_label'] ?? __('Hemen Ara', 'antigravity-elementor')); ?></a>
							<a class="button button--ghost button--ghost-light" href="<?php echo esc_url(antigravity_contact_whatsapp_href()); ?>" target="_blank" rel="noopener noreferrer"><?php echo esc_html($section['secondary_label'] ?? antigravity_contact_whatsapp_label()); ?></a>
						</div>
					</div>
				</div>
			</section>
			<?php
			continue;
		}

		if ('faq' === $section['type']) {
			?>
			<section class="section-shell">
				<div class="container faq-stack">
					<?php foreach ($section['faq'] as $faq) : ?>
						<article class="faq-card">
							<h3><?php echo esc_html($faq['q']); ?></h3>
							<p><?php echo esc_html($faq['a']); ?></p>
						</article>
					<?php endforeach; ?>
				</div>
			</section>
			<?php
			continue;
		}

		if ('contact' === $section['type']) {
			?>
			<section class="section-shell">
				<div class="container story-grid">
					<div class="story-card">
						<p class="eyebrow"><?php esc_html_e('Iletisim', 'antigravity-elementor'); ?></p>
						<h2><?php echo esc_html($section['title']); ?></h2>
						<p><?php echo esc_html($section['copy']); ?></p>
					</div>
					<div class="stats-card">
						<div class="stats-card__row">
							<strong><?php echo esc_html(antigravity_contact_phone_display()); ?></strong>
							<span><?php esc_html_e('Telefon ile aninda ulasin', 'antigravity-elementor'); ?></span>
						</div>
						<div class="stats-card__row">
							<strong><?php echo esc_html(antigravity_full_address()); ?></strong>
							<span><?php esc_html_e('Sultanbeyli merkezli servis noktasi', 'antigravity-elementor'); ?></span>
						</div>
						<div class="button-row">
							<a class="button" href="<?php echo esc_url(antigravity_contact_phone_href()); ?>"><?php esc_html_e('Hemen Ara', 'antigravity-elementor'); ?></a>
							<a class="button button--ghost" href="<?php echo esc_url(antigravity_contact_whatsapp_href()); ?>" target="_blank" rel="noopener noreferrer"><?php echo esc_html(antigravity_contact_whatsapp_label()); ?></a>
						</div>
					</div>
				</div>
			</section>
			<?php
		}
	}
}
