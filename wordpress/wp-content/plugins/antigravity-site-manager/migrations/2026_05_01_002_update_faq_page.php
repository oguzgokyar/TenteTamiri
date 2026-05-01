<?php
/**
 * Update the FAQ page for primary service keywords.
 *
 * @package AntigravitySiteManager
 */

return [
	'id'          => '2026_05_01_002_update_faq_page',
	'title'       => 'SSS sayfasini ana anahtar kelimelere gore guncelle',
	'description' => 'SSS sayfasinin excerpt ve Rank Math SEO metalarini Istanbul tente tamiri odakli arama niyetlerine gore guvenli sekilde gunceller.',
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
			'meta'      => [
				'_rank_math_title'       => 'SSS | Istanbul Tente Tamiri ve Pergola Servisi',
				'_rank_math_description' => 'Istanbul tente tamiri, pergola tamiri, zip perde tamiri, tente motoru, kumas degisimi ve mafsal onarimi hakkinda sik sorular.',
			],
		],
	],
];
