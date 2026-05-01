<?php
/**
 * Align Rank Math SEO titles, descriptions and focus keywords.
 *
 * @package AntigravitySiteManager
 */

$rank_math = static function (string $title, string $description, string $focus_keyword): array {
	return [
		'rank_math_title'         => $title,
		'rank_math_description'   => $description,
		'rank_math_focus_keyword' => $focus_keyword,
		'_rank_math_title'        => $title,
		'_rank_math_description'  => $description,
		'_rank_math_focus_keyword' => $focus_keyword,
	];
};

$page = static function (string $slug, string $title, string $excerpt, string $seo_title, string $description, string $focus_keyword) use ($rank_math): array {
	return [
		'post_type' => 'page',
		'slug'      => $slug,
		'title'     => $title,
		'status'    => 'publish',
		'excerpt'   => $excerpt,
		'content'   => '',
		'mode'      => 'safe',
		'meta'      => $rank_math($seo_title, $description, $focus_keyword),
	];
};

return [
	'id'          => '2026_05_02_004_rank_math_meta_strategy',
	'title'       => 'Rank Math SEO meta alanlarini sayfa niyetlerine gore guncelle',
	'description' => 'Mevcut sayfalar icin SEO title, meta description ve focus keyword alanlarini Rank Math uyumlu post meta olarak kaydeder.',
	'mode'        => 'safe',
	'items'       => [
		$page(
			'anasayfa',
			'Anasayfa',
			'Istanbul genelinde tente, pergola ve zip perde tamiri icin hizli servis.',
			'Istanbul Tente Tamircisi | Tente ve Pergola Tamiri',
			'Istanbul genelinde tente tamiri, pergola tamiri, zip perde servisi, motor ve kumas arizalari icin yerinde servis.',
			'istanbul tente tamircisi'
		),
		$page(
			'hizmetler',
			'Hizmetler',
			'Tente, pergola, zip perde, motor, kumas ve mekanizma arizalari icin hizmet sayfalari.',
			'Hizmetler | Istanbul Tente ve Pergola Servisi',
			'Tente tamiri, pergola tamiri, zip perde tamiri, tente motoru tamiri ve kumas degisimi hizmetlerini inceleyin.',
			'tente pergola servisi'
		),
		$page(
			'tente-tamiri',
			'Tente Tamiri',
			'Istanbul genelinde tente tamiri, motor, kumas ve mekanizma arizalari icin yerinde servis.',
			'Tente Tamiri Istanbul | Yerinde Tente Servisi',
			'Istanbul tente tamiri, tente servisi, motor arizasi, kumas degisimi ve mekanizma onarimi icin hizli servis destegi.',
			'tente tamiri'
		),
		$page(
			'pergola-tamiri',
			'Pergola Tamiri',
			'Motorlu pergola sistemlerinde ray, kumas, motor ve su tahliye sorunlari icin servis.',
			'Pergola Tamiri Istanbul | Motorlu Pergola Servisi',
			'Istanbul pergola tamiri, motorlu pergola servisi, ray, kumas, motor ve su tahliye arizalari icin teknik destek.',
			'pergola tamiri'
		),
		$page(
			'zip-perde-tamiri',
			'Zip Perde Tamiri',
			'Zip perde motoru, ray ayari ve kumas gerilimi problemleri icin servis.',
			'Zip Perde Tamiri Istanbul | Motor ve Ray Servisi',
			'Istanbul zip perde tamiri, motor arizasi, ray ayari, kumas gerilimi ve zip perde servisi icin yerinde destek.',
			'zip perde tamiri'
		),
		$page(
			'tente-motoru-tamiri',
			'Tente Motoru Tamiri',
			'Tente motoru, kumanda, alici kart ve limit ayari problemleri icin servis.',
			'Tente Motoru Tamiri Istanbul | Kumanda ve Motor Servisi',
			'Tente motoru calismiyor, kumanda algilamiyor veya sistem yarida kaliyorsa Istanbul geneli motor servisi alin.',
			'tente motoru tamiri'
		),
		$page(
			'tente-kumasi-degisimi',
			'Tente Kumasi Degisimi',
			'Yirtik, solmus, sarkmis veya su geciren tente kumaslari icin yenileme.',
			'Tente Kumasi Degisimi Istanbul | Kumas Yenileme',
			'Istanbul tente kumasi degisimi, yirtik, solmus, sarkmis veya su geciren kumaslar icin olcuye uygun yenileme.',
			'tente kumasi degisimi'
		),
		$page(
			'mekanizma-ve-mafsal-onarimi',
			'Mekanizma ve Mafsal Onarimi',
			'Tente kol, mafsal, baglanti ve acma-kapama mekanizmasi sorunlari icin servis.',
			'Tente Mekanizma ve Mafsal Onarimi Istanbul',
			'Tente kolu, mafsal, baglanti ve mekanizma arizalarinda Istanbul geneli yerinde tamir, bakim ve ayar destegi.',
			'tente mekanizma onarimi'
		),
		$page(
			'sultanbeyli-tente-tamiri',
			'Sultanbeyli Tente Tamiri',
			'Sultanbeyli ve cevresinde tente tamiri, pergola servisi ve zip perde arizalari icin lokal servis.',
			'Sultanbeyli Tente Tamiri | Yerinde Servis',
			'Sultanbeyli tente tamiri, pergola servisi, tente motoru, kumas degisimi ve mekanizma onarimi icin hizli servis.',
			'sultanbeyli tente tamiri'
		),
		$page(
			'hakkimizda',
			'Hakkimizda',
			'Istanbul Tente Tamircisi, Sultanbeyli merkezli yerinde tente ve pergola servis ekibidir.',
			'Hakkimizda | Istanbul Tente Tamircisi',
			'Sultanbeyli merkezli Istanbul Tente Tamircisi, tente, pergola ve zip perde sistemlerinde tamir ve bakim hizmeti verir.',
			'istanbul tente tamircisi'
		),
		$page(
			'iletisim',
			'Iletisim',
			'Tente ve pergola servis talebi icin telefon veya WhatsApp uzerinden bize ulasin.',
			'Iletisim | Istanbul Tente Tamircisi',
			'Istanbul Tente Tamircisi telefon, WhatsApp ve Sultanbeyli adres bilgileri. Tente ve pergola servisi icin ulasin.',
			'istanbul tente tamircisi iletisim'
		),
		$page(
			'sss',
			'SSS',
			'Istanbul tente tamiri, pergola tamiri, zip perde tamiri ve servis sureci hakkinda sik sorulan sorular.',
			'SSS | Istanbul Tente Tamiri ve Pergola Servisi',
			'Istanbul tente tamiri, pergola tamiri, zip perde tamiri, tente motoru ve kumas degisimi hakkinda sik sorular.',
			'tente tamiri sorulari'
		),
		$page(
			'referanslar',
			'Referanslarimiz',
			'Tente, pergola ve zip perde sistemlerinde uygulama ve servis referanslari.',
			'Referanslarimiz | Istanbul Tente Tamircisi',
			'Istanbul genelinde tente, pergola ve zip perde sistemlerinde tamamlanan servis ve uygulama referanslarini inceleyin.',
			'tente pergola referanslari'
		),
		$page(
			'video-galeri',
			'Video Galeri',
			'Tente ve pergola ariza tespiti, servis sureci ve bakim videolari.',
			'Video Galeri | Tente ve Pergola Servisi',
			'Tente tamiri, pergola bakimi, motor arizasi ve servis sureci hakkinda kisa video anlatimlarini inceleyin.',
			'tente tamiri video'
		),
	],
];
