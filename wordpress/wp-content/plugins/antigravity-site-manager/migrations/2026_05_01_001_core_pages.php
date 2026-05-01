<?php
/**
 * Create and align core pages for Istanbul Tente Tamircisi.
 *
 * @package AntigravitySiteManager
 */

$rank_math = static function (string $title, string $description): array {
	return [
		'_rank_math_title'       => $title,
		'_rank_math_description' => $description,
	];
};

$page = static function (string $slug, string $title, string $excerpt, array $meta = [], array $menu = []): array {
	return [
		'post_type' => 'page',
		'slug'      => $slug,
		'title'     => $title,
		'status'    => 'publish',
		'excerpt'   => $excerpt,
		'content'   => '',
		'mode'      => 'safe',
		'meta'      => $meta,
		'menu'      => $menu,
	];
};

return [
	'id'          => '2026_05_01_001_core_pages',
	'title'       => 'Temel sayfalari ve SEO metalarini hazirla',
	'description' => 'Anasayfa, hizmet sayfalari, bolge sayfasi ve iletisim sayfalarini slug bazli olusturur veya guvenli sekilde gunceller.',
	'mode'        => 'safe',
	'items'       => [
		$page(
			'anasayfa',
			'Anasayfa',
			'Istanbul genelinde tente, pergola ve zip perde tamiri icin hizli servis.',
			$rank_math(
				'Istanbul Tente Tamircisi | Pergola ve Tente Tamiri',
				'Istanbul genelinde tente tamiri, pergola tamiri, zip perde servisi, motor ve kumas arizalari icin hizli servis destegi.'
			),
			[
				'location' => 'primary',
				'order'    => 1,
			]
		),
		$page(
			'hizmetler',
			'Hizmetler',
			'Tente, pergola, zip perde, motor, kumas ve mekanizma arizalari icin hizmet sayfalari.',
			$rank_math(
				'Hizmetler | Istanbul Tente ve Pergola Servisi',
				'Istanbul genelinde tente tamiri, pergola tamiri, zip perde tamiri, tente motoru tamiri ve kumas degisimi hizmetleri.'
			),
			[
				'location' => 'primary',
				'order'    => 2,
			]
		),
		$page(
			'tente-tamiri',
			'Tente Tamiri',
			'Istanbul genelinde tente tamiri, motor, kumas ve mekanizma arizalari icin yerinde servis.',
			$rank_math(
				'Istanbul Tente Tamiri | Hemen Servis Cagirin',
				'Istanbul genelinde tente tamiri, tente servisi, motor arizasi, kumas degisimi ve mekanizma onarimi icin yerinde servis.'
			),
			[
				'location' => 'primary',
				'order'    => 3,
			]
		),
		$page(
			'pergola-tamiri',
			'Pergola Tamiri',
			'Motorlu pergola sistemlerinde ray, kumas, motor ve su tahliye sorunlari icin servis.',
			$rank_math(
				'Istanbul Pergola Tamiri | Pergola Servisi',
				'Istanbul genelinde pergola tamiri, motorlu pergola servisi, ray, kumas ve mekanizma arizalari icin teknik destek.'
			)
		),
		$page(
			'zip-perde-tamiri',
			'Zip Perde Tamiri',
			'Zip perde motoru, ray ayari ve kumas gerilimi problemleri icin servis.',
			$rank_math(
				'Istanbul Zip Perde Tamiri | Motor ve Ray Servisi',
				'Istanbul genelinde zip perde tamiri, motor arizasi, ray ayari ve kumas gerilimi sorunlari icin servis destegi.'
			)
		),
		$page(
			'tente-motoru-tamiri',
			'Tente Motoru Tamiri',
			'Tente motoru, kumanda, alici kart ve limit ayari problemleri icin servis.',
			$rank_math(
				'Tente Motoru Tamiri Istanbul | Kumanda ve Motor Servisi',
				'Tente motoru calismiyor, kumanda algilamiyor veya sistem yarida kaliyorsa Istanbul geneli teknik servis destegi.'
			)
		),
		$page(
			'tente-kumasi-degisimi',
			'Tente Kumasi Degisimi',
			'Yirtik, solmus, sarkmis veya su geciren tente kumaslari icin yenileme.',
			$rank_math(
				'Tente Kumasi Degisimi Istanbul | Kumas Yenileme',
				'Istanbul genelinde yirtik, solmus veya sarkmis tente kumaslari icin olcuye uygun kumas degisimi ve gergi ayari.'
			)
		),
		$page(
			'mekanizma-ve-mafsal-onarimi',
			'Mekanizma ve Mafsal Onarimi',
			'Tente kol, mafsal, baglanti ve acma-kapama mekanizmasi sorunlari icin servis.',
			$rank_math(
				'Tente Mekanizma ve Mafsal Onarimi Istanbul',
				'Tente kolu, mafsal, baglanti ve mekanizma arizalarinda Istanbul geneli yerinde tamir ve ayar destegi.'
			)
		),
		$page(
			'sultanbeyli-tente-tamiri',
			'Sultanbeyli Tente Tamiri',
			'Sultanbeyli ve cevresinde tente tamiri, pergola servisi ve zip perde arizalari icin lokal servis.',
			$rank_math(
				'Sultanbeyli Tente Tamiri | Yerinde Servis',
				'Sultanbeyli tente tamiri, pergola servisi, tente motoru ve kumas arizalari icin Istanbul Tente Tamircisi ile hizli servis.'
			)
		),
		$page(
			'hakkimizda',
			'Hakkimizda',
			'Istanbul Tente Tamircisi, Sultanbeyli merkezli yerinde tente ve pergola servis ekibidir.',
			$rank_math(
				'Hakkimizda | Istanbul Tente Tamircisi',
				'Sultanbeyli merkezli Istanbul Tente Tamircisi, tente, pergola ve zip perde sistemlerinde tamir ve bakim hizmeti verir.'
			),
			[
				'location' => 'primary',
				'order'    => 4,
			]
		),
		$page(
			'iletisim',
			'Iletisim',
			'Tente ve pergola servis talebi icin telefon veya WhatsApp uzerinden bize ulasin.',
			$rank_math(
				'Iletisim | Istanbul Tente Tamircisi',
				'Istanbul Tente Tamircisi telefon, WhatsApp ve Sultanbeyli adres bilgileri. Tente ve pergola servisi icin hemen ulasin.'
			),
			[
				'location' => 'primary',
				'order'    => 5,
			]
		),
		$page(
			'sss',
			'SSS',
			'Tente ve pergola tamiri hakkinda sik sorulan sorular.',
			$rank_math(
				'Sik Sorulan Sorular | Tente ve Pergola Tamiri',
				'Tente tamiri, pergola servisi, zip perde arizasi ve Istanbul geneli servis sureci hakkinda sik sorulan sorular.'
			)
		),
		$page(
			'referanslar',
			'Referanslarimiz',
			'Tente, pergola ve zip perde sistemlerinde uygulama ve servis referanslari.',
			$rank_math(
				'Referanslarimiz | Istanbul Tente Tamircisi',
				'Istanbul genelinde tente, pergola ve zip perde sistemlerinde servis verilen uygulama alanlari ve referans sayfasi.'
			)
		),
		$page(
			'video-galeri',
			'Video Galeri',
			'Tente ve pergola ariza tespiti, servis sureci ve bakim videolari.',
			$rank_math(
				'Video Galeri | Tente ve Pergola Servisi',
				'Tente tamiri, pergola bakimi, motor arizasi ve servis sureci hakkinda video galeri ve bilgilendirici icerikler.'
			)
		),
	],
	'options'     => [
		[
			'name'       => 'show_on_front',
			'value'      => 'page',
			'label'      => 'Ana sayfa tipi statik sayfa yapilacak',
			'value_type' => 'raw',
		],
		[
			'name'       => 'page_on_front',
			'value'      => 'anasayfa',
			'label'      => 'Anasayfa statik on sayfa olarak atanacak',
			'value_type' => 'page_slug',
		],
		[
			'name'       => 'permalink_structure',
			'value'      => '/%postname%/',
			'label'      => 'Kalici baglanti yapisi yazi ismi olacak',
			'value_type' => 'raw',
		],
	],
];
