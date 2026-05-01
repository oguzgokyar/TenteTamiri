<?php
/**
 * Ensure the FAQ page is visible in the primary navigation.
 *
 * @package AntigravitySiteManager
 */

return [
	'id'          => '2026_05_01_003_add_faq_to_primary_menu',
	'title'       => 'SSS sayfasini ana menuye ekle',
	'description' => 'SSS sayfasi daha once olusturulmus veya guncellenmis olsa bile ana menude gorunmesini garanti eder.',
	'mode'        => 'safe',
	'items'       => [
		[
			'post_type' => 'page',
			'slug'      => 'sss',
			'title'     => 'SSS',
			'status'    => 'publish',
			'excerpt'   => 'Istanbul tente tamiri, pergola tamiri, zip perde tamiri, tente motoru, kumas degisimi ve mekanizma onarimi hakkinda sik sorulan sorular.',
			'content'   => '',
			'mode'      => 'safe',
			'menu'      => [
				'location' => 'primary',
				'order'    => 6,
			],
		],
	],
];
