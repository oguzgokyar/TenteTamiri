<?php
/**
 * SEO helpers, meta output and structured data.
 *
 * @package AntigravityElementor
 */

if (! defined('ABSPATH')) {
	exit;
}

function antigravity_meta_description(): string {
	if (is_front_page()) {
		return 'Istanbul Tente Tamircisi; pergola tamiri, tente servisi, zip perde tamiri, motor arizasi ve kumas degisimi icin Istanbul geneli 7/24 servis, ucretsiz kesif ve teklif sunar.';
	}

	if (is_page()) {
		$slug = get_post_field('post_name', get_queried_object_id());
		$content = antigravity_service_page_content($slug) ?: antigravity_district_page_content($slug);

		if ($content && ! empty($content['description'])) {
			return (string) $content['description'];
		}

		if (has_excerpt()) {
			return wp_strip_all_tags(get_the_excerpt());
		}
	}

	if (is_home()) {
		return 'Tente, pergola ve zip perde sistemleriyle ilgili ariza nedenleri, bakim onerileri ve servis rehberleri.';
	}

	return get_bloginfo('description');
}

function antigravity_filter_document_title_parts(array $parts): array {
	if (is_front_page()) {
		$parts['title'] = 'Istanbul Tente Tamircisi | Pergola, Tente ve Zip Perde Tamir Servisi';
	}

	return $parts;
}
add_filter('document_title_parts', 'antigravity_filter_document_title_parts');

function antigravity_output_meta_tags(): void {
	$description = antigravity_meta_description();
	?>
	<meta name="description" content="<?php echo esc_attr($description); ?>">
	<meta property="og:description" content="<?php echo esc_attr($description); ?>">
	<meta property="og:title" content="<?php echo esc_attr(wp_get_document_title()); ?>">
	<meta property="og:type" content="website">
	<meta property="og:url" content="<?php echo esc_url(home_url(add_query_arg([], $GLOBALS['wp']->request ?? ''))); ?>">
	<?php
}
add_action('wp_head', 'antigravity_output_meta_tags', 5);

function antigravity_schema_current_url(): string {
	if (is_singular()) {
		return get_permalink() ?: home_url('/');
	}

	if (is_front_page()) {
		return home_url('/');
	}

	return home_url(add_query_arg([], $GLOBALS['wp']->request ?? ''));
}

function antigravity_schema_business_node(): array {
	$profile = antigravity_business_profile();
	$image   = [
		'https://images.unsplash.com/photo-1494526585095-c41746248156?auto=format&fit=crop&w=1200&q=82',
		'https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?auto=format&fit=crop&w=1200&q=82',
		'https://images.unsplash.com/photo-1512918728675-ed5a9ecdebfd?auto=format&fit=crop&w=1200&q=82',
	];

	return [
		'@type'        => ['HomeAndConstructionBusiness', 'LocalBusiness'],
		'@id'          => home_url('/#business'),
		'name'         => $profile['brand']['name'],
		'description'  => $profile['brand']['tagline'],
		'telephone'    => $profile['contact']['phoneDisplay'],
		'url'          => home_url('/'),
		'image'        => $image,
		'priceRange'   => $profile['business']['priceModel'],
		'address'      => [
			'@type'           => 'PostalAddress',
			'streetAddress'   => $profile['location']['streetAddress'],
			'addressLocality' => $profile['location']['district'],
			'addressRegion'   => $profile['location']['city'],
			'postalCode'      => $profile['location']['postalCode'],
			'addressCountry'  => $profile['location']['country'],
		],
		'geo'          => [
			'@type'     => 'GeoCoordinates',
			'latitude'  => $profile['location']['latitude'],
			'longitude' => $profile['location']['longitude'],
		],
		'areaServed'   => [
			[
				'@type' => 'City',
				'name'  => $profile['serviceArea']['city'],
			],
		],
		'openingHoursSpecification' => [
			[
				'@type'    => 'OpeningHoursSpecification',
				'dayOfWeek'=> ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'],
				'opens'    => $profile['business']['openingHour'],
				'closes'   => $profile['business']['closingHour'],
			],
		],
		'contactPoint' => [
			[
				'@type'       => 'ContactPoint',
				'telephone'   => $profile['contact']['phoneDisplay'],
				'contactType' => 'customer service',
				'areaServed'  => 'TR',
				'availableLanguage' => ['tr'],
			],
		],
	];
}

function antigravity_schema_breadcrumb_node(string $current_url): ?array {
	if (! function_exists('antigravity_breadcrumb_items')) {
		return null;
	}

	$items = antigravity_breadcrumb_items();

	if (count($items) < 2) {
		return null;
	}

	$list = [];

	foreach ($items as $index => $item) {
		$list[] = [
			'@type'    => 'ListItem',
			'position' => $index + 1,
			'name'     => wp_strip_all_tags((string) $item['label']),
			'item'     => ! empty($item['url']) ? esc_url_raw($item['url']) : esc_url_raw($current_url),
		];
	}

	return [
		'@type'           => 'BreadcrumbList',
		'@id'             => trailingslashit($current_url) . '#breadcrumb',
		'itemListElement' => $list,
	];
}

function antigravity_schema_find_sections(array $sections, string $type): array {
	return array_values(
		array_filter(
			$sections,
			static function ($section) use ($type) {
				return isset($section['type']) && $section['type'] === $type;
			}
		)
	);
}

function antigravity_schema_service_images(array $sections): array {
	$images = [];

	foreach ($sections as $section) {
		if (! empty($section['image'])) {
			$images[] = esc_url_raw($section['image']);
		}

		if (! empty($section['cards']) && is_array($section['cards'])) {
			foreach ($section['cards'] as $card) {
				if (! empty($card['image'])) {
					$images[] = esc_url_raw($card['image']);
				}
			}
		}

		if (! empty($section['images']) && is_array($section['images'])) {
			foreach ($section['images'] as $image) {
				if (! empty($image['src'])) {
					$images[] = esc_url_raw($image['src']);
				}
			}
		}
	}

	return array_values(array_unique($images));
}

function antigravity_schema_service_node(array $content, string $current_url): array {
	$profile  = antigravity_business_profile();
	$sections = $content['sections'] ?? [];
	$images   = antigravity_schema_service_images($sections);

	return array_filter(
		[
			'@type'       => 'Service',
			'@id'         => trailingslashit($current_url) . '#service',
			'name'        => get_the_title(),
			'serviceType' => $content['eyebrow'] ?? get_the_title(),
			'description' => $content['description'] ?? antigravity_meta_description(),
			'provider'    => [
				'@id' => home_url('/#business'),
			],
			'areaServed'  => [
				[
					'@type' => 'City',
					'name'  => $profile['serviceArea']['city'],
				],
			],
			'availableChannel' => [
				'@type'      => 'ServiceChannel',
				'serviceUrl' => $current_url,
				'servicePhone' => [
					'@type'     => 'ContactPoint',
					'telephone' => $profile['contact']['phoneDisplay'],
					'contactType' => 'customer service',
					'availableLanguage' => ['tr'],
				],
			],
			'image'       => $images ?: null,
		]
	);
}

function antigravity_schema_faq_node(array $content, string $current_url): ?array {
	$faq_sections = antigravity_schema_find_sections($content['sections'] ?? [], 'faq');
	$questions    = [];

	foreach ($faq_sections as $section) {
		foreach (($section['faq'] ?? []) as $faq) {
			if (empty($faq['q']) || empty($faq['a'])) {
				continue;
			}

			$questions[] = [
				'@type' => 'Question',
				'name'  => wp_strip_all_tags((string) $faq['q']),
				'acceptedAnswer' => [
					'@type' => 'Answer',
					'text'  => wp_strip_all_tags((string) $faq['a']),
				],
			];
		}
	}

	if (! $questions) {
		return null;
	}

	return [
		'@type'      => 'FAQPage',
		'@id'        => trailingslashit($current_url) . '#faq',
		'mainEntity' => $questions,
	];
}

function antigravity_schema_video_node(array $content, string $current_url): ?array {
	$video_sections = antigravity_schema_find_sections($content['sections'] ?? [], 'service_video');

	foreach ($video_sections as $section) {
		$video_url = $section['embed_url'] ?? $section['content_url'] ?? '';

		if (! $video_url || empty($section['poster'])) {
			continue;
		}

		return array_filter(
			[
				'@type'        => 'VideoObject',
				'@id'          => trailingslashit($current_url) . '#service-video',
				'name'         => $section['title'] ?? get_the_title(),
				'description'  => $section['copy'] ?? antigravity_meta_description(),
				'thumbnailUrl' => [esc_url_raw($section['poster'])],
				'uploadDate'   => $section['upload_date'] ?? get_the_modified_date(DATE_W3C),
				'embedUrl'     => ! empty($section['embed_url']) ? esc_url_raw($section['embed_url']) : null,
				'contentUrl'   => ! empty($section['content_url']) ? esc_url_raw($section['content_url']) : null,
			]
		);
	}

	return null;
}

function antigravity_output_local_business_schema(): void {
	$current_url = antigravity_schema_current_url();
	$graph       = [
		antigravity_schema_business_node(),
		[
			'@type'       => 'WebPage',
			'@id'         => trailingslashit($current_url) . '#webpage',
			'url'         => $current_url,
			'name'        => wp_get_document_title(),
			'description' => antigravity_meta_description(),
			'isPartOf'    => [
				'@type' => 'WebSite',
				'@id'   => home_url('/#website'),
				'name'  => get_bloginfo('name'),
				'url'   => home_url('/'),
			],
		],
	];

	$breadcrumb = antigravity_schema_breadcrumb_node($current_url);

	if ($breadcrumb) {
		$graph[] = $breadcrumb;
	}

	if (is_page()) {
		$slug    = get_post_field('post_name', get_queried_object_id());
		$content = antigravity_service_page_content($slug) ?: antigravity_district_page_content($slug);

		if ($content) {
			$graph[] = antigravity_schema_service_node($content, $current_url);

			$faq = antigravity_schema_faq_node($content, $current_url);

			if ($faq) {
				$graph[] = $faq;
			}

			$video = antigravity_schema_video_node($content, $current_url);

			if ($video) {
				$graph[] = $video;
			}
		}
	}

	$schema = [
		'@context' => 'https://schema.org',
		'@graph'   => array_values(array_filter($graph)),
	];
	?>
	<script type="application/ld+json"><?php echo wp_json_encode($schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); ?></script>
	<?php
}
add_action('wp_head', 'antigravity_output_local_business_schema', 20);
