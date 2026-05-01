<?php
/**
 * Business profile and content maps.
 *
 * @package AntigravityElementor
 */

if (! defined('ABSPATH')) {
	exit;
}

function antigravity_business_profile(): array {
	static $profile = null;

	if (null === $profile) {
		$profile = require ANTIGRAVITY_THEME_DIR . '/inc/generated-business-profile.php';
	}

	return $profile;
}

function antigravity_business_value(array $path, $default = '') {
	$value = antigravity_business_profile();

	foreach ($path as $segment) {
		if (! is_array($value) || ! array_key_exists($segment, $value)) {
			return $default;
		}

		$value = $value[ $segment ];
	}

	return $value;
}

function antigravity_contact_phone_display(): string {
	return (string) antigravity_business_value(['contact', 'phoneDisplay']);
}

function antigravity_contact_phone_href(): string {
	return (string) antigravity_business_value(['contact', 'phoneHref']);
}

function antigravity_contact_whatsapp_href(): string {
	return (string) antigravity_business_value(['contact', 'whatsAppHref']);
}

function antigravity_contact_whatsapp_label(): string {
	return (string) antigravity_business_value(['contact', 'whatsAppLabel'], 'WhatsApp');
}

function antigravity_full_address(): string {
	return (string) antigravity_business_value(['location', 'fullAddress']);
}

function antigravity_business_districts(): array {
	return (array) antigravity_business_value(['serviceArea', 'districts'], []);
}

function antigravity_service_media_sections(string $slug): array {
	$media = [
		'tente-tamiri' => [
			'title'   => 'Tente tamiri oncesi ariza noktasini gorsel olarak inceliyoruz.',
			'copy'    => 'Kumas, motor, kol ve mafsal arizalarinda foto veya video ile ilk kontrolu hizlandirir; sahada hangi parcalarin incelenecegini netlestiririz.',
			'poster'  => 'https://images.unsplash.com/photo-1494526585095-c41746248156?auto=format&fit=crop&w=1200&q=82',
			'gallery' => [
				[
					'src'     => 'https://images.unsplash.com/photo-1494526585095-c41746248156?auto=format&fit=crop&w=900&q=82',
					'alt'     => 'Mafsalli tente tamiri ve mekanizma kontrolu',
					'caption' => 'Mafsalli sistem kontrolu',
				],
				[
					'src'     => 'https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?auto=format&fit=crop&w=900&q=82',
					'alt'     => 'Tente kumasi yenileme ve gergi kontrolu',
					'caption' => 'Kumas ve gergi kontrolu',
				],
				[
					'src'     => 'https://images.unsplash.com/photo-1512918728675-ed5a9ecdebfd?auto=format&fit=crop&w=900&q=82',
					'alt'     => 'Motorlu tente servisi ve saha incelemesi',
					'caption' => 'Motorlu sistem incelemesi',
				],
			],
		],
		'pergola-tamiri' => [
			'title'   => 'Pergola sisteminde ray, motor ve kumas hareketini birlikte kontrol ediyoruz.',
			'copy'    => 'Motorlu pergola arizalarinda tavan hareketi, ray yuruyusu, egim ve su tahliye noktalarini ayni servis akisi icinde inceleriz.',
			'poster'  => 'https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?auto=format&fit=crop&w=1200&q=82',
			'gallery' => [
				[
					'src'     => 'https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?auto=format&fit=crop&w=900&q=82',
					'alt'     => 'Pergola tamiri ve tavan sistemi kontrolu',
					'caption' => 'Pergola tavan kontrolu',
				],
				[
					'src'     => 'https://images.unsplash.com/photo-1494526585095-c41746248156?auto=format&fit=crop&w=900&q=82',
					'alt'     => 'Pergola ray ve mekanizma bakimi',
					'caption' => 'Ray ve mekanizma bakimi',
				],
				[
					'src'     => 'https://images.unsplash.com/photo-1512918728675-ed5a9ecdebfd?auto=format&fit=crop&w=900&q=82',
					'alt'     => 'Pergola kumasi ve motorlu sistem servisi',
					'caption' => 'Kumas ve motor servisi',
				],
			],
		],
		'zip-perde-tamiri' => [
			'title'   => 'Zip perde arizasinda ray, kumas gerilimi ve motor tepkisini birlikte degerlendiriyoruz.',
			'copy'    => 'Takilma, dengesiz inme-kalkma ve kumas gerilimi problemlerinde sistemin iki yan rayini ve motor limit ayarini kontrol ederiz.',
			'poster'  => 'https://images.unsplash.com/photo-1512918728675-ed5a9ecdebfd?auto=format&fit=crop&w=1200&q=82',
			'gallery' => [
				[
					'src'     => 'https://images.unsplash.com/photo-1512918728675-ed5a9ecdebfd?auto=format&fit=crop&w=900&q=82',
					'alt'     => 'Zip perde ray ve kumas gerilimi kontrolu',
					'caption' => 'Ray ve kumas kontrolu',
				],
				[
					'src'     => 'https://images.unsplash.com/photo-1484154218962-a197022b5858?auto=format&fit=crop&w=900&q=82',
					'alt'     => 'Zip perde motor ve kumanda arizasi servisi',
					'caption' => 'Motor ve kumanda kontrolu',
				],
				[
					'src'     => 'https://images.unsplash.com/photo-1494526585095-c41746248156?auto=format&fit=crop&w=900&q=82',
					'alt'     => 'Zip perde saha servis incelemesi',
					'caption' => 'Saha servis incelemesi',
				],
			],
		],
	];

	$fallback = [
		'title'   => 'Servis oncesi sistemi gorsel olarak inceleyip dogru ekipmanla sahaya geliriz.',
		'copy'    => 'Ariza fotosu veya kisa video, motor, kumas ve mekanizma problemlerinde servis planlamasini hizlandirir.',
		'poster'  => 'https://images.unsplash.com/photo-1484154218962-a197022b5858?auto=format&fit=crop&w=1200&q=82',
		'gallery' => [
			[
				'src'     => 'https://images.unsplash.com/photo-1484154218962-a197022b5858?auto=format&fit=crop&w=900&q=82',
				'alt'     => 'Motorlu tente sistemi servis kontrolu',
				'caption' => 'Motorlu sistem kontrolu',
			],
			[
				'src'     => 'https://images.unsplash.com/photo-1494526585095-c41746248156?auto=format&fit=crop&w=900&q=82',
				'alt'     => 'Tente mekanizma ve mafsal servis incelemesi',
				'caption' => 'Mekanizma incelemesi',
			],
			[
				'src'     => 'https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?auto=format&fit=crop&w=900&q=82',
				'alt'     => 'Tente kumasi degisimi ve saha kontrolu',
				'caption' => 'Kumas kontrolu',
			],
		],
	];

	$item = $media[ $slug ] ?? $fallback;

	return [
		[
			'type'        => 'service_video',
			'eyebrow'     => 'Hizmet Videosu',
			'video_label' => 'Servis sureci',
			'duration'    => 'Kisa anlatim',
			'title'       => $item['title'],
			'copy'        => $item['copy'],
			'poster'      => $item['poster'],
			'items'       => [
				'Ariza gorseli ile daha hizli on degerlendirme',
				'Yerinde tespit sonrasi net servis plani',
				'Telefon ve WhatsApp ile kolay iletisim',
			],
		],
		[
			'type'   => 'service_gallery',
			'eyebrow' => 'Gorsel Galeri',
			'title'  => 'Hizmete ait saha ve sistem gorselleri',
			'copy'   => 'Gercek saha fotograflari eklendikce bu alan, hizmet surecini daha net gormenize ve servis kararini daha rahat vermenize yardimci olacak.',
			'images' => $item['gallery'],
		],
	];
}

function antigravity_service_page_content(string $slug): ?array {
	$pages = [
		'hakkimizda' => [
			'eyebrow'     => 'Hakkimizda',
			'description' => 'Sultanbeyli merkezli ekibimiz, Istanbul genelinde tente ve pergola sistemlerinin ariza tespiti, bakimi ve onarimi icin yerinde servis verir.',
			'sections'    => [
				[
					'type'  => 'intro',
					'title' => 'Istanbul genelinde hizli tespit, temiz iscilik ve net teklif mantigiyla calisiyoruz.',
					'copy'  => 'Pergola tente, mafsalli tente, kasetli tente, zip perde ve motorlu sistemlerde sahaya inmeden fiyat vermek yerine once arizayi yerinde tespit ediyoruz. Bu sayede ihtiyaca uygun, gereksiz parca degisimine gitmeyen bir servis sureci kuruyoruz.',
				],
				[
					'type'  => 'list',
					'title' => 'Neyi farkli yapiyoruz?',
					'items' => [
						'Istanbul geneli servis planlamasi',
						'7/24 cagri ve WhatsApp ulasimi',
						'Motor, kumanda, kumas, mekanizma ve mafsal odakli onarim',
						'Ucretsiz kesif ve teklif yaklasimi',
					],
				],
			],
		],
		'hizmetler'  => [
			'eyebrow'        => 'Hizmetler',
			'description'    => 'Istanbul genelinde tente, pergola, zip perde, motor, kumas ve mekanizma arizalari icin yerinde servis hizmetleri.',
			'no_sidebar'     => true,
			'hide_page_hero' => true,
			'sections'       => [
				[
					'type'    => 'service_visual_intro',
					'eyebrow' => 'Servis Vitrini',
					'title'   => 'Tente ve pergola sistemlerinde arizayi yerinde anlayip dogru servis planini kuruyoruz.',
					'copy'    => 'Hizmetlerimiz sayfasi, musterinin yasadigi sorunu hizli ayirt edebilmesi icin gorsel ve ikonik bir servis katalogu olarak tasarlandi. Motor calismiyor, kumas yiprandi, mekanizma zorlanıyor veya pergola ray sistemi takiliyorsa ilgili hizmet sayfasindan detaylara ulasabilirsiniz.',
					'image'   => 'https://images.unsplash.com/photo-1518005020951-eccb494ad742?auto=format&fit=crop&w=1400&q=82',
					'badge'   => 'Istanbul geneli yerinde servis',
					'items'   => [
						'Tente, pergola ve zip perde arizalarinda yerinde tespit',
						'Motor, kumanda, kumas, mafsal ve mekanizma odakli cozum',
						'Telefon ve WhatsApp ile hizli servis planlama',
					],
				],
				[
					'type'    => 'service_catalog',
					'eyebrow' => 'Hizmet Katalogu',
					'title'   => 'Sorununuza en yakin hizmeti secin, servis talebini hizlandirin.',
					'copy'    => 'Her hizmet karti ilgili detay sayfasina gider. Bu sayfalarda ariza belirtileri, servis akisi, gorseller, videolar ve SSS alanlari ayrica gelistirilebilir.',
					'cards'   => [
						[
							'icon'        => 'wrench',
							'image'       => 'https://images.unsplash.com/photo-1494526585095-c41746248156?auto=format&fit=crop&w=1000&q=82',
							'title'       => 'Pergola Tamiri',
							'description' => 'Motor, ray, profil, tavan kumasi ve su tahliye sorunlarinda yerinde kontrol.',
							'url'         => home_url('/pergola-tamiri/'),
							'badge'       => 'Pergola servisi',
							'tags'        => [
								'Motor',
								'Ray',
								'Bakim',
							],
						],
						[
							'icon'        => 'shield',
							'image'       => 'https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?auto=format&fit=crop&w=1000&q=82',
							'title'       => 'Tente Tamiri',
							'description' => 'Mafsalli, kasetli ve koruklu tente sistemlerinde mekanizma ve kumas odakli servis.',
							'url'         => home_url('/tente-tamiri/'),
							'badge'       => 'En cok talep',
							'tags'        => [
								'Mafsal',
								'Kumas',
								'Ayar',
							],
						],
						[
							'icon'        => 'fabric',
							'image'       => 'https://images.unsplash.com/photo-1512918728675-ed5a9ecdebfd?auto=format&fit=crop&w=1000&q=82',
							'title'       => 'Zip Perde Tamiri',
							'description' => 'Kumas gerilimi, motor, ray ve kenar kilitlenme sorunlarinda teknik destek.',
							'url'         => home_url('/zip-perde-tamiri/'),
							'badge'       => 'Zip perde',
							'tags'        => [
								'Ray',
								'Kilit',
								'Gergi',
							],
						],
						[
							'icon'        => 'bolt',
							'image'       => 'https://images.unsplash.com/photo-1484154218962-a197022b5858?auto=format&fit=crop&w=1000&q=82',
							'title'       => 'Tente Motoru Tamiri',
							'description' => 'Motor tepki vermiyor, kumanda algilamiyor veya sistem yarida kaliyorsa kontrol saglanir.',
							'url'         => home_url('/tente-motoru-tamiri/'),
							'badge'       => 'Motor arizasi',
							'tags'        => [
								'Kumanda',
								'Limit',
								'Alici',
							],
						],
						[
							'icon'        => 'fabric',
							'image'       => 'https://images.unsplash.com/photo-1533090161767-e6ffed986c88?auto=format&fit=crop&w=1000&q=82',
							'title'       => 'Tente Kumasi Degisimi',
							'description' => 'Yirtik, solmus, sarkmis veya su geciren kumaslarda sisteme uygun yenileme.',
							'url'         => home_url('/tente-kumasi-degisimi/'),
							'badge'       => 'Kumas yenileme',
							'tags'        => [
								'Olcu',
								'Gergi',
								'Renk',
							],
						],
						[
							'icon'        => 'clock',
							'image'       => 'https://images.unsplash.com/photo-1503387762-592deb58ef4e?auto=format&fit=crop&w=1000&q=82',
							'title'       => 'Mekanizma ve Mafsal Onarimi',
							'description' => 'Kol, mafsal, baglanti ve kaset kapanis problemlerinde hedefli teknik mudahale.',
							'url'         => home_url('/mekanizma-ve-mafsal-onarimi/'),
							'badge'       => 'Mekanik servis',
							'tags'        => [
								'Kol',
								'Mafsal',
								'Kaset',
							],
						],
					],
				],
				[
					'type'    => 'service_metrics',
					'eyebrow' => 'Neden Bizi Aramalisiniz?',
					'title'   => 'Servis dilini sade, hizli ve musteri odakli tutuyoruz.',
					'copy'    => 'Hizmet sayfalari sadece anahtar kelime icin degil; musteri arizayi anlasin, ne yapacagini bilsin ve dogru kanaldan ulassin diye kurgulanir.',
					'items'   => [
						[
							'icon'        => 'phone',
							'value'       => '7/24',
							'title'       => 'Telefon ve WhatsApp',
							'description' => 'Ariza bilgisini hizli alir, gerekirse gorsel isteyerek servis planini netlestiririz.',
						],
						[
							'icon'        => 'pin',
							'value'       => '39',
							'title'       => 'Istanbul ilcesi',
							'description' => 'Istanbul genelinde ilce bazli servis ve lokal SEO yapisini destekleyen sayfa kurgusu.',
						],
						[
							'icon'        => 'shield',
							'value'       => 'Net',
							'title'       => 'Ariza odakli cozum',
							'description' => 'Gereksiz degisim yerine once tespit, sonra tamir, bakim veya parca degisimi onerilir.',
						],
					],
				],
				[
					'type'    => 'problem_cards',
					'eyebrow' => 'Ariza Belirtileri',
					'title'   => 'Hangi hizmete ihtiyaciniz oldugunu anlamak icin bu belirtilere bakabilirsiniz.',
					'copy'    => 'Musteri aradiginda genellikle hizmet adini degil, yasadigi problemi soyler. Bu yuzden sayfada ariza belirtisi odakli yonlendirme kullanildi.',
					'cards'   => [
						[
							'icon'        => 'bolt',
							'title'       => 'Motor ses yapiyor veya calismiyor',
							'description' => 'Tente motoru tamiri ya da pergola motor servisi sayfasindan destek alabilirsiniz.',
						],
						[
							'icon'        => 'fabric',
							'title'       => 'Kumas sarkti, yirtildi veya soldu',
							'description' => 'Tente kumasi degisimi ve gergi ayari hizmeti uygun olabilir.',
						],
						[
							'icon'        => 'wrench',
							'title'       => 'Sistem zor acilip kapaniyor',
							'description' => 'Mekanizma, mafsal, kol veya ray kontrolu gerekebilir.',
						],
					],
				],
				[
					'type'            => 'service_cta',
					'eyebrow'         => 'Servis Talebi',
					'title'           => 'Hangi hizmet gerektiginden emin degilseniz arizayi anlatin, sizi dogru cozum sayfasina yonlendirelim.',
					'copy'            => 'Telefonla arayabilir veya WhatsApp uzerinden tente/pergola sisteminizin fotografini gonderebilirsiniz. Ilce ve ariza bilgisini paylasmaniz servis planlamasini hizlandirir.',
					'primary_label'   => 'Hizmet Icin Hemen Ara',
					'secondary_label' => 'WhatsApp ile Gorsel Gonder',
				],
			],
		],
		'iletisim'   => [
			'eyebrow'     => 'Iletisim',
			'description' => 'Sultanbeyli merkezli ekip, Istanbul genelinde ariza bildirimi ve kesif talepleri icin telefon ve WhatsApp uzerinden hizli donus saglar.',
			'sections'    => [
				[
					'type'  => 'contact',
					'title' => 'Bize ulasin',
					'copy'  => 'Telefonla arayabilir, WhatsApp uzerinden ariza fotosu gonderebilir ve kesif talep edebilirsiniz.',
				],
			],
		],
		'referanslar' => [
			'eyebrow'     => 'Referanslarimiz',
			'description' => 'Istanbul genelinde tente, pergola ve zip perde sistemlerinde servis verdigimiz uygulama alanlarindan ornekler.',
			'sections'    => [
				[
					'type'  => 'intro',
					'title' => 'Is yeri, kafe, restoran, balkon ve teras sistemlerinde sahada cozum uretiyoruz.',
					'copy'  => 'Bu sayfa gercek referans gorselleri eklendikce genisleyecek sekilde hazirlandi. Simdilik hizmet verdigimiz alanlari ve servis yaklasimimizi netlestiriyoruz; yeni uygulama fotograflari geldikce galeriye donusturulebilir.',
				],
				[
					'type'  => 'cards',
					'title' => 'Referanslarda one cikacak uygulama alanlari',
					'cards' => [
						[
							'title'       => 'Kafe ve restoran pergolalari',
							'description' => 'Musteri alanini etkileyen pergola, tente ve motorlu sistemlerde hizli ariza tespiti ve bakim.',
						],
						[
							'title'       => 'Dukkan giris tenteleri',
							'description' => 'Tabela onu, vitrin ve giris tentelerinde kumas, mafsal, kol ve mekanizma destegi.',
						],
						[
							'title'       => 'Balkon ve teras sistemleri',
							'description' => 'Konut kullanimi icin kumas yenileme, gergi ayari ve acma-kapama kontrolu.',
						],
					],
				],
			],
		],
		'video-galeri' => [
			'eyebrow'     => 'Video Galeri',
			'description' => 'Tente ve pergola servis surecini anlatan kisa ariza tespiti, bakim ve saha uygulama videolari.',
			'sections'    => [
				[
					'type'        => 'service_video',
					'eyebrow'     => 'Servis Videolari',
					'title'       => 'Ariza tespiti, mekanizma kontrolu ve servis akisinin videolu anlatimlari burada toplanacak.',
					'copy'        => 'Musterinin ne bekleyecegini daha kolay anlamasi icin kisa videolar kullanacagiz. Motor sesi, kumas sarkmasi, mafsal zorlanmasi ve pergola ray problemleri gibi konular video formatinda aciklanabilir.',
					'poster'      => 'https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?auto=format&fit=crop&w=1200&q=82',
					'video_label' => 'Yakinda video eklenecek',
					'duration'    => 'Servis sureci anlatimi',
					'items'       => [
						'WhatsApp ile gorsel gonderme ornegi',
						'Tente motoru ariza belirtisi anlatimi',
						'Kumas ve mekanizma kontrol adimlari',
					],
				],
				[
					'type'  => 'cards',
					'title' => 'Hazirlanacak video basliklari',
					'cards' => [
						[
							'title'       => 'Tente neden zor acilir?',
							'description' => 'Kol, mafsal, kumas gergisi ve motor zorlanmasi basit dille anlatilir.',
						],
						[
							'title'       => 'Pergola motor arizasi nasil anlasilir?',
							'description' => 'Ses, dur-kalk davranisi, ray surtmesi ve kumanda tepkisi uzerinden kontrol edilir.',
						],
						[
							'title'       => 'Kumas degisimi ne zaman gerekir?',
							'description' => 'Yirtik, solma, su gecirme ve sarkma belirtileri musteriye gorsel olarak aciklanir.',
						],
					],
				],
			],
		],
		'sss'        => [
			'eyebrow'     => 'SSS',
			'description' => 'Istanbul tente tamiri, pergola tamiri, zip perde tamiri, tente motoru, kumas degisimi ve mekanizma onarimi hakkinda en cok sorulan sorular.',
			'sections'    => [
				[
					'type' => 'faq',
					'faq'  => [
						[
							'q' => 'Istanbul tente tamiri icin hangi arizalara bakiyorsunuz?',
							'a' => 'Mafsalli tente, kasetli tente, koruklu tente ve motorlu tente sistemlerinde kumas yirtigi, sarkma, motor arizasi, kumanda problemi, kol, mafsal ve mekanizma zorlanmasi gibi sorunlara yerinde servis destegi veriyoruz.',
						],
						[
							'q' => 'Pergola tamiri ve pergola servisi hangi durumlarda gerekir?',
							'a' => 'Pergola tavan acilip kapanmiyorsa, rayda surtme varsa, motor zor calisiyorsa, kumas formunu kaybettiyse veya su tahliye problemi olusuyorsa pergola servisi gerekir. Once ariza nedeni kontrol edilir, sonra tamir, bakim veya parca degisimi netlestirilir.',
						],
						[
							'q' => 'Zip perde tamiri icin motor ve ray arizalarina bakiyor musunuz?',
							'a' => 'Evet. Zip perde sistemlerinde motorun tepki vermemesi, kumanda algilamamasi, ray icinde takilma, kumas geriliminin bozulmasi ve dengesiz inme-kalkma gibi arizalarda kontrol ve servis planlamasi yapiyoruz.',
						],
						[
							'q' => 'Tente motoru tamiri mi yoksa motor degisimi mi gerekir?',
							'a' => 'Bu karar motorun durumuna gore verilir. Limit ayari, kumanda, alici kart veya baglanti problemi varsa tamir ve ayar yeterli olabilir. Motor yanmis, guc kaybetmis veya sistemi tasiyamiyorsa degisim daha dogru cozum olabilir.',
						],
						[
							'q' => 'Tente kumasi degisimi ne zaman yapilir?',
							'a' => 'Kumas yirtildiysa, asiri solduysa, sarkma olustuysa, su geciriyorsa veya mekanizma saglam oldugu halde kullanim konforu dustuyse tente kumasi degisimi dusunulur. Olcu ve sistem yapisi kontrol edilerek uygun kumas yenileme planlanir.',
						],
						[
							'q' => 'Mekanizma ve mafsal onarimi hangi belirtilerde gerekir?',
							'a' => 'Tente acilirken zorlanma, yamuk kapanma, kol boslugu, surtme sesi, kaset kapanis problemi veya mafsal gevsemesi varsa mekanizma ve mafsal noktalarinin kontrol edilmesi gerekir. Sistemi zorlamadan servis talebi olusturmak daha buyuk hasari onler.',
						],
						[
							'q' => 'Ayni gun tente servisi alabilir miyim?',
							'a' => 'Ilce, ekip yogunlugu ve ariza durumuna gore ayni gun servis planlamasi yapilabilir. En hizli donus icin telefonla arayabilir veya WhatsApp uzerinden sistemin fotografini ve bulundugunuz ilceyi gonderebilirsiniz.',
						],
						[
							'q' => 'Istanbulun tum ilcelerine servis geliyor musunuz?',
							'a' => 'Evet. Sultanbeyli merkezli olarak Istanbul genelinde ilce bazli servis planlamasi yapiyoruz. Anadolu Yakasi ve Avrupa Yakasi taleplerinde ilce, ariza tipi ve musait zaman bilgisine gore ekip yonlendirmesi yapilir.',
						],
						[
							'q' => 'WhatsApp ile ariza gorseli gondermek yeterli olur mu?',
							'a' => 'Cogu durumda ilk degerlendirme icin fotograf veya kisa video cok yardimci olur. Yine de kesin karar yerinde kontrol ile verilir. Gorsel paylasmaniz ekibin dogru takim ve parca ihtimalini daha iyi planlamasini saglar.',
						],
						[
							'q' => 'Ucretsiz kesif ve teklif nasil ilerliyor?',
							'a' => 'Once telefon veya WhatsApp ile ariza bilgisi alinir. Gerekirse gorsel incelenir, ardindan adres ve ilceye gore servis planlanir. Yerinde tespit sonrasi tamir, bakim veya degisim secenekleri net sekilde aktarilir.',
						],
						[
							'q' => 'Tente tamircisi ararken hangi bilgileri vermeliyim?',
							'a' => 'Ilceniz, sistem tipi, arizanin belirtisi, sistemin motorlu olup olmadigi ve mumkunse bir fotograf yeterlidir. Ornegin "tente kapanmiyor", "motor ses yapiyor" veya "kumas yirtildi" gibi net ifadeler servis surecini hizlandirir.',
						],
						[
							'q' => 'Tamir mi yeni sistem kurulumu mu daha mantikli?',
							'a' => 'Mekanizma, motor veya kumas ekonomik sekilde onarilabiliyorsa tamir daha mantikli olabilir. Sistem cok eski, parca uyumsuz veya guvenli kullanim riski varsa yeni sistem ya da kapsamli yenileme daha dogru olabilir. Karar yerinde tespit sonrasi verilir.',
						],
					],
				],
			],
		],
		'tente-tamiri' => [
			'eyebrow'     => 'Tente Tamiri',
			'description' => 'Istanbul genelinde tente tamiri, tente servisi, motor arizasi, kumas degisimi ve mekanizma onarimi icin yerinde servis hizmeti.',
			'sections'    => [
				[
					'type'  => 'service_visual_intro',
					'eyebrow' => 'Yerinde Tente Servisi',
					'title' => 'Tenteniz acilmiyor, kapanmiyor veya zor calisiyorsa yerinde kontrol edip cozum yolunu netlestiriyoruz.',
					'copy'  => 'Istanbul Tente Tamircisi olarak mafsalli, kasetli, motorlu ve koruklu tente sistemlerinde ariza tespiti, tamir, bakim ve parca degisimi hizmeti veriyoruz. Sorunu telefonda dinler, gerekirse WhatsApp uzerinden gorsel ister, ardindan uygun ekip planlamasini yapariz. Amacimiz gereksiz masraf cikarmadan mevcut sistemi guvenli ve kullanilir hale getirmektir.',
					'image' => 'https://images.unsplash.com/photo-1494526585095-c41746248156?auto=format&fit=crop&w=1200&q=82',
					'badge' => 'Tente tamiri icin hizli servis planlama',
					'items' => [
						'Tente acilmiyor, kapanmiyor veya zor hareket ediyorsa ariza kontrolu',
						'Kumas yirtigi, sarkma, solma ve gergi kaybi icin kumas yenileme',
						'Motor, kumanda, alici kart, kol, mafsal ve mekanizma onarimi',
						'Istanbulun tum ilcelerine telefon ve WhatsApp ile servis planlamasi',
					],
				],
				[
					'type' => 'service_image_cards',
					'eyebrow' => 'Sik Karsilasilan Sorunlar',
					'title' => 'Tente arizalari genelde motor, kumas veya mekanizma kaynakli olur.',
					'copy' => 'Sorunun hangi parcadan kaynaklandigini anlamak icin sistemi yerinde kontrol ederiz. Asagidaki arizalardan biri varsa arayarak ya da WhatsApp uzerinden gorsel gondererek servis talebi olusturabilirsiniz.',
					'cards' => [
						[
							'icon' => 'fabric',
							'image' => 'https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?auto=format&fit=crop&w=900&q=82',
							'title' => 'Tente kumasi yirtildi veya sarkti',
							'description' => 'Gunes, yagmur ve uzun kullanim nedeniyle yipranan tente kumaslari icin olcuye uygun kumas degisimi ve gergi ayari yapilir.',
						],
						[
							'icon' => 'bolt',
							'image' => 'https://images.unsplash.com/photo-1484154218962-a197022b5858?auto=format&fit=crop&w=900&q=82',
							'title' => 'Motor calismiyor veya kumanda algilamiyor',
							'description' => 'Motor zorlanmasi, kumandanin tepki vermemesi, limit ayari ve alici kart sorunlari icin elektrik ve mekanik kontrol yapilir.',
						],
						[
							'icon' => 'wrench',
							'image' => 'https://images.unsplash.com/photo-1512918728675-ed5a9ecdebfd?auto=format&fit=crop&w=900&q=82',
							'title' => 'Kol, mafsal veya mekanizma zorlanıyor',
							'description' => 'Tentenin yamuk kapanmasi, surtme yapmasi veya kol bosalmasi durumunda mafsal, baglanti ve mekanizma noktalari kontrol edilir.',
						],
					],
				],
				[
					'type' => 'service_process',
					'eyebrow' => 'Servis Sureci',
					'title' => 'Ariza bildiriminden onarima kadar sureci sizin icin kolaylastiriyoruz.',
					'steps' => [
						[
							'icon' => 'phone',
							'title' => 'Bizi arayin',
							'description' => 'Tentenin tipi, bulundugunuz ilce ve yasadiginiz ariza hakkinda kisa bilgi aliriz.',
						],
						[
							'icon' => 'message',
							'title' => 'Gorsel paylasin',
							'description' => 'Mumkunse WhatsApp uzerinden fotograf veya kisa video gondererek ilk degerlendirmeyi hizlandirirsiniz.',
						],
						[
							'icon' => 'pin',
							'title' => 'Yerinde kontrol edelim',
							'description' => 'Ekip uygunluguna gore adrese gelerek motor, kumas, kol, mafsal ve mekanizmayi kontrol ederiz.',
						],
						[
							'icon' => 'shield',
							'title' => 'Onarimi tamamlayalim',
							'description' => 'Tamir, ayar veya parca degisimi gerekiyorsa net bilgi verip onayinizla islemi uygulariz.',
						],
					],
				],
				[
					'type' => 'cards',
					'title' => 'Tente tamiri kapsaminda hangi islemleri yapiyoruz?',
					'cards' => [
						[
							'title' => 'Mafsalli Tente Tamiri',
							'description' => 'Kol, mafsal, yay ve baglanti noktalarinda acma-kapama dengesini bozan sorunlara mudahale ederiz.',
						],
						[
							'title' => 'Kasetli Tente Tamiri',
							'description' => 'Kaset kapanisi, eksen ayari, kumas gerilimi ve motorlu sistem calismasini kontrol ederiz.',
						],
						[
							'title' => 'Koruklu Tente Tamiri',
							'description' => 'Koruklu tente kumasi, iskeleti ve hareket noktalarinda bakim-onarim destegi saglariz.',
						],
						[
							'title' => 'Tente Kumas Degisimi',
							'description' => 'Yirtik, solmus, sarkmis veya su geciren kumaslarda olcuye uygun yenileme yapariz.',
						],
						[
							'title' => 'Tente Motoru Tamiri',
							'description' => 'Motor, kumanda, alici kart, limit ayari ve elektrik baglanti kontrollerini degerlendiririz.',
						],
						[
							'title' => 'Bakim ve Ayar',
							'description' => 'Zorlanan, ses yapan veya dengesiz calisan sistemlerde genel bakim ve ayar islemi uygulariz.',
						],
					],
				],
				[
					'type' => 'service_districts',
					'eyebrow' => 'Servis Bolgeleri',
					'title' => 'Istanbul genelinde tente tamiri icin servis talebi aliyoruz.',
					'copy' => 'Sultanbeyli merkezli calisan ekibimizle Anadolu Yakasi ve Avrupa Yakasi icin servis taleplerini bolgeye gore planliyoruz. En hizli donus icin ilcenizi ve ariza bilgisini bizimle paylasabilirsiniz.',
					'districts' => [
						'Sultanbeyli',
						'Pendik',
						'Kartal',
						'Umraniye',
						'Kadikoy',
						'Atasehir',
						'Sancaktepe',
						'Uskudar',
					],
				],
				[
					'type' => 'faq',
					'faq' => [
						[
							'q' => 'Tente tamiri mi yoksa degisimi mi gerekir?',
							'a' => 'Once arizanin kaynagini kontrol etmek gerekir. Kumas, motor veya mekanizma tamir edilebiliyorsa degisim yerine onarim tercih edilir; parca yipranmissa degisim onerilir.',
						],
						[
							'q' => 'Kasetli ve mafsalli tente tamiri yapiyor musunuz?',
							'a' => 'Evet. Kasetli, mafsalli, koruklu ve motorlu tente sistemlerinde mekanizma ayari, motor kontrolu, kumas degisimi ve bakim hizmeti veriyoruz.',
						],
						[
							'q' => 'WhatsApp ile ariza gorseli gondermek gerekli mi?',
							'a' => 'Zorunlu degil, ancak sureci hizlandirir. Tentenin genel gorunumu, motor bolumu veya arizali noktanin videosu servis planlamasini kolaylastirir.',
						],
					],
				],
				[
					'type' => 'service_cta',
					'eyebrow' => 'Hizli Donus',
					'title' => 'Tente arizanizi ertelemeyin; sistemi daha fazla zorlamadan servis talebi olusturun.',
					'copy' => 'Tenteniz zor calisiyor, ses yapiyor, kapanmiyor veya kumasi yiprandiysa bizi arayin. Dilerseniz WhatsApp uzerinden gorsel gondererek servis planlamasini hizlandirabilirsiniz.',
					'primary_label' => 'Tente Tamiri Icin Ara',
					'secondary_label' => 'WhatsApp ile Gorsel Gonder',
				],
			],
		],
		'pergola-tamiri' => [
			'eyebrow'     => 'Pergola Tamiri',
			'description' => 'Pergola tamiri hizmetimiz; motorlu pergola sistemlerinde ray, kumaş, profil ve otomasyon sorunlarina odaklanir.',
			'sections'    => [
				[
					'type'  => 'intro',
					'title' => 'Motorlu pergola sistemlerinde teknik servis ve bakim.',
					'copy'  => 'Acilmayan tavan, su tahliye problemi, kumas takilmasi, rayda surtme veya motorun sesli calismasi gibi sorunlarda sistemin omrunu uzatan teknik mudahale sagliyoruz.',
				],
				[
					'type'  => 'list',
					'title' => 'Sik pergola problemleri',
					'items' => [
						'Pergola motor arizasi',
						'Ray ve yurutme mekanizmasi sorunu',
						'Pergola kumasi degisimi',
						'Su alma ve egim kontrolu',
					],
				],
			],
		],
		'zip-perde-tamiri' => [
			'eyebrow'     => 'Zip Perde Tamiri',
			'description' => 'Zip perde tamiri hizmeti; motor, ray, kumas gerilimi ve kilitlenme sorunlarinda hizli servis destegi sunar.',
			'sections'    => [
				[
					'type'  => 'intro',
					'title' => 'Zip perde sistemlerinde sessiz ve akici calisma icin teknik ayar.',
					'copy'  => 'Perdenin takilmasi, motorun dengesiz calismasi, kumas geriliminin bozulmasi veya kenar kilitlerinin zorlanmasi gibi arizalara yerinde cozum sunuyoruz.',
				],
				[
					'type'  => 'list',
					'title' => 'Hizmet kapsami',
					'items' => [
						'Zip perde motor ve kumanda tamiri',
						'Ray temizligi ve ayar',
						'Kumas degisimi ve gergi ayari',
						'Durma-nokta ayari',
					],
				],
			],
		],
		'tente-motoru-tamiri' => [
			'eyebrow'     => 'Tente Motoru Tamiri',
			'description' => 'Tente motoru tamiri; motor zorlanmasi, dur-kalk sorunu, uzaktan kumanda ve alici kart problemlerinde odak servis sunar.',
			'sections'    => [
				[
					'type'  => 'intro',
					'title' => 'Motorlu tente sistemlerinde ariza tespiti ve degisim destegi.',
					'copy'  => 'Motorun sesli calismasi, acma-kapamada takilma, uzaktan kumandanin cevap vermemesi veya limit ayarlarinin bozulmasi durumunda sistemi kontrol ediyoruz.',
				],
			],
		],
		'tente-kumasi-degisimi' => [
			'eyebrow'     => 'Tente Kumasi Degisimi',
			'description' => 'Tente kumasi degisimi hizmetiyle yirtilan, solan veya su geciren tente kumaslarini yeni kullanim kosullarina uygun sekilde yeniliyoruz.',
			'sections'    => [
				[
					'type'  => 'intro',
					'title' => 'Yipranmis veya sarkmis tente kumaslari icin yenileme cozumleri.',
					'copy'  => 'Tente kumasinda renk solmasi, yirtik, su gecirme veya gergi kaybi varsa mevcut mekanizmaya uygun kumas secenegiyle degisim yapilabilir.',
				],
			],
		],
		'mekanizma-ve-mafsal-onarimi' => [
			'eyebrow'     => 'Mekanizma ve Mafsal Onarimi',
			'description' => 'Tente mekanizma ve mafsal onarimi; zorlanan kollarda, kirilan parcalarda ve dengesiz acilma kapanma sorunlarinda hedefli servis verir.',
			'sections'    => [
				[
					'type'  => 'intro',
					'title' => 'Kollar, mafsallar ve acma-kapama sistemi icin hedefli teknik mudahale.',
					'copy'  => 'Zamanla gevseyen, paslanan veya darbeyle zarar goren mafsal ve baglanti noktalarinda sistemin guvenli calismasi icin ayar ve onarim yapilir.',
				],
			],
		],
	];

	if (! isset($pages[ $slug ])) {
		return null;
	}

	$content = $pages[ $slug ];

	if (! empty($content['sections']) && preg_match('/-(tamiri|degisimi|onarimi|servisi)$/', $slug)) {
		$media_sections = antigravity_service_media_sections($slug);
		$insert_at      = min(2, count($content['sections']));

		array_splice($content['sections'], $insert_at, 0, $media_sections);
	}

	return $content;
}

function antigravity_priority_district_pages(): array {
	return [
		[
			'title'       => 'Sultanbeyli Tente Tamiri',
			'slug'        => 'sultanbeyli-tente-tamiri',
			'description' => 'Sultanbeyli ve yakin cevresinde tente tamiri, tente servisi, motor arizasi, kumas degisimi ve mekanizma onarimi icin yerinde servis.',
		],
		[
			'title'       => 'Pendik Tente Tamiri',
			'slug'        => 'pendik-tente-tamiri',
			'description' => 'Pendikte mafsalli tente, pergola ve motor arizalari icin yerinde tespit ve teklif.',
		],
		[
			'title'       => 'Kartal Tente Tamiri',
			'slug'        => 'kartal-tente-tamiri',
			'description' => 'Kartal bolgesinde tente servisi, kumas degisimi ve mekanizma onarimi hizmeti.',
		],
		[
			'title'       => 'Umraniye Pergola Tamiri',
			'slug'        => 'umraniye-pergola-tamiri',
			'description' => 'Umraniyede motorlu pergola sistemleri icin teknik servis ve bakim destegi.',
		],
		[
			'title'       => 'Kadikoy Zip Perde Tamiri',
			'slug'        => 'kadikoy-zip-perde-tamiri',
			'description' => 'Kadikoyde zip perde motor, ray ve kumas sorunlari icin hizli servis.',
		],
		[
			'title'       => 'Atasehir Tente Servisi',
			'slug'        => 'atasehir-tente-servisi',
			'description' => 'Atasehirde tente servisi, mekanizma ayari ve kumas yenileme talepleri icin destek.',
		],
	];
}

function antigravity_district_page_content(string $slug): ?array {
	$pages = [
		'sultanbeyli-tente-tamiri' => [
			'eyebrow'     => 'Sultanbeyli Tente Servisi',
			'description' => 'Sultanbeyli ve yakin cevresinde tente tamiri, tente servisi, motor arizasi, kumas degisimi ve mekanizma onarimi icin yerinde servis.',
			'sections'    => [
				[
					'type'       => 'district_local_intro',
					'eyebrow'    => 'Sultanbeyli Yerel Servis',
					'district'   => 'Sultanbeyli',
					'route_note' => 'Abdurrahmangazi merkezli yakin servis plani',
					'title'      => 'Sultanbeylide tente arizasi icin merkeze yakin, kontrollu servis akisi.',
					'copy'       => 'Sultanbeylide ev, is yeri, kafe, restoran, balkon ve teras tentelerinde ariza yasandiginda once sorunu netlestiriyor, ardindan uygun ekip ve parca ihtimaline gore servis planliyoruz. Amacimiz musteriye gereksiz is cikarmadan; motor, kumas, kol, mafsal ve mekanizma sorununu yerinde anlasilir sekilde cozmektir.',
					'facts'      => [
						[
							'value' => 'Merkez',
							'label' => 'Abdurrahmangazi / Belediye Cd.',
						],
						[
							'value' => 'Hizli',
							'label' => 'Telefon ve WhatsApp ile talep',
						],
						[
							'value' => 'Yerinde',
							'label' => 'Motor, kumas ve mekanizma kontrolu',
						],
					],
				],
				[
					'type'    => 'district_problem_rows',
					'eyebrow' => 'Sultanbeylide Sik Arizalar',
					'title'   => 'Bolgeden gelen talepleri ariza nedenine gore ayirip dogru mudahaleyi planliyoruz.',
					'copy'    => 'Ilce sayfalarinda sadece hizmet listesi degil, musteriye gercekten yardim eden yerel ariza senaryolari anlatilir. Bu sayfa Sultanbeylide en cok karsilasilan tente servis ihtiyaclarina gore kurgulandi.',
					'rows'    => [
						[
							'icon'        => 'bolt',
							'title'       => 'Motorlu tente tepki vermiyor',
							'description' => 'Kumanda algilamama, motor sesi gelmemesi, tentenin yarida kalmasi veya limit ayarinin bozulmasi durumunda motor ve alici sistemi kontrol edilir.',
						],
						[
							'icon'        => 'fabric',
							'title'       => 'Kumas sarkti, yirtildi veya soldu',
							'description' => 'Gunes, yagmur ve ruzgar etkisiyle formu bozulan kumaslarda mevcut sisteme uygun olcu, gergi ve kumas yenileme secenekleri degerlendirilir.',
						],
						[
							'icon'        => 'wrench',
							'title'       => 'Kol, mafsal veya kaset zorlanıyor',
							'description' => 'Acilma-kapanma dengesini bozan kol, mafsal, baglanti ve kaset kapanis problemlerinde sistemin zorlanma noktasi yerinde tespit edilir.',
						],
						[
							'icon'        => 'phone',
							'title'       => 'Is yeri ve kafe tentelerinde acil servis ihtiyaci',
							'description' => 'Tabela onundeki tente, restoran pergolasi veya dukkan giris sistemi is akisini etkiliyorsa ariza bilgisi hizli alinir ve servis onceligi buna gore planlanir.',
						],
					],
				],
				[
					'type'    => 'district_access_flow',
					'eyebrow' => 'Bolgeye Ozel Akis',
					'title'   => 'Sultanbeyli servis talebi icin once bilgiyi netlestirir, sonra sahaya dogru hazirlikla cikariz.',
					'copy'    => 'Bu yapi hem musteriye zaman kazandirir hem de ekibin dogru takim ve parca ihtimaliyle gelmesini kolaylastirir.',
					'steps'   => [
						[
							'title'       => 'Konum ve ariza notu',
							'description' => 'Mahalle, sistem tipi ve yasadiginiz belirti kisa sekilde alinir.',
						],
						[
							'title'       => 'Gorsel on inceleme',
							'description' => 'Mumkunse WhatsApp uzerinden fotograf veya kisa video istenir.',
						],
						[
							'title'       => 'Yerinde kontrol',
							'description' => 'Motor, kumas, mafsal, kol ve baglanti noktasi incelenir.',
						],
						[
							'title'       => 'Net cozum plani',
							'description' => 'Tamir, ayar, bakim veya degisim secenegi onayinizla uygulanir.',
						],
					],
				],
				[
					'type'    => 'district_service_scope',
					'eyebrow' => 'Sultanbeyli Kapsami',
					'title'   => 'Tek bir hizmet listesi yerine, bolgedeki kullanim alanlarina gore servis kapsamimizi anlatiyoruz.',
					'copy'    => 'Sultanbeylide farkli yapilardaki tente ve pergola sistemleri icin ayni dili kullanmiyoruz; is yeri, konut ve sosyal alan ihtiyacini ayri ele aliyoruz.',
					'cards'   => [
						[
							'icon'        => 'route',
							'title'       => 'Kafe, restoran ve dukkan onleri',
							'description' => 'Musteri girisini etkileyen tente ve pergola arizalarinda kullanim yogunlugu dikkate alinarak servis planlanir.',
						],
						[
							'icon'        => 'shield',
							'title'       => 'Balkon, teras ve site alanlari',
							'description' => 'Konut tipi tentelerde kumas, gergi, mafsal ve acma-kapama dengesine odaklanilir.',
						],
						[
							'icon'        => 'clock',
							'title'       => 'Periyodik bakim ve ayar',
							'description' => 'Uzun sure kullanilan sistemlerde hareketli noktalar, kumas gerilimi ve motor limit ayarlari kontrol edilir.',
						],
					],
				],
				[
					'type' => 'faq',
					'faq'  => [
						[
							'q' => 'Sultanbeyli tente tamiri icin ayni gun servis alabilir miyim?',
							'a' => 'Ekip uygunlugu ve ariza konumuna gore ayni gun servis planlamasi yapilabilir. En hizli donus icin telefonla arayabilir veya WhatsApp uzerinden gorsel gonderebilirsiniz.',
						],
						[
							'q' => 'Sultanbeylide hangi tente arizalarina bakiyorsunuz?',
							'a' => 'Tente motoru arizasi, kumanda sorunu, kumas yirtigi, mafsal ve kol problemi, kasetli tente ayari ve genel bakim islemlerine destek veriyoruz.',
						],
						[
							'q' => 'Tente tamiri icin once fotograf gondermem gerekiyor mu?',
							'a' => 'Zorunlu degil; ancak fotograf veya kisa video servis planlamasini hizlandirir ve ekibin ariza ihtimalini daha iyi anlamasini saglar.',
						],
					],
				],
				[
					'type'            => 'district_cta',
					'eyebrow'         => 'Sultanbeyli Servis Talebi',
					'title'           => 'Sultanbeylide tente arizasi varsa once sorunu anlatalim, sonra dogru servis planini olusturalim.',
					'copy'            => 'Tenteniz acilmiyor, kapanmiyor, kumasi yiprandi veya motor tepki vermiyorsa telefonla ulasabilir ya da WhatsApp uzerinden gorsel gonderebilirsiniz.',
					'primary_label'   => 'Sultanbeyli Tente Servisi Icin Ara',
					'secondary_label' => 'WhatsApp ile Gorsel Gonder',
				],
			],
		],
	];

	if (isset($pages[ $slug ])) {
		return $pages[ $slug ];
	}

	foreach (antigravity_priority_district_pages() as $page) {
		$pages[ $page['slug'] ] = [
			'eyebrow'     => 'Ilce Servisi',
			'description' => $page['description'],
			'sections'    => [
				[
					'type'       => 'district_local_intro',
					'eyebrow'    => 'Bolgeye Servis',
					'district'   => preg_replace('/\s+(Tente|Pergola|Servisi|Tamiri).*/', '', $page['title']),
					'route_note' => 'Istanbul geneli saha servis planlamasi',
					'title'      => $page['title'] . ' icin yerinde tespit ve servis planlamasi',
					'copy'       => 'Bu bolgede tente, pergola ve zip perde sistemlerinde ariza kaydini alip uygun servis planlamasi yapiyoruz. Telefon veya WhatsApp uzerinden gorsel paylasmaniz, ariza ihtimalini daha iyi anlamamizi ve ekibin hazirlikli gelmesini saglar.',
					'facts'      => [
						[
							'value' => 'Istanbul',
							'label' => 'Ilce bazli servis akisi',
						],
						[
							'value' => 'WhatsApp',
							'label' => 'Gorsel ile on degerlendirme',
						],
						[
							'value' => 'Yerinde',
							'label' => 'Tamir, bakim ve ayar',
						],
					],
				],
				[
					'type'    => 'district_problem_rows',
					'eyebrow' => 'Bolgedeki Talepler',
					'title'   => 'Ilcede en cok karsilasilan servis ihtiyaclarini ariza belirtisine gore ele aliyoruz.',
					'copy'    => 'Her ilce sayfasinda ayni hizmet listesini tekrarlamak yerine, kullanicinin yasadigi belirtiyi anlamasina yardim eden kisa ve net aciklamalar kullanilir.',
					'rows'    => [
						[
							'icon'        => 'bolt',
							'title'       => 'Motor ve kumanda arizasi',
							'description' => 'Motor tepki vermiyor, kumanda algilamiyor veya sistem yarida kaliyorsa elektrik ve limit ayari kontrol edilir.',
						],
						[
							'icon'        => 'fabric',
							'title'       => 'Kumas, gergi ve yipranma',
							'description' => 'Sarkan, yirtilan veya solan kumasta mevcut sisteme uygun yenileme ve gergi ayari degerlendirilir.',
						],
						[
							'icon'        => 'wrench',
							'title'       => 'Mekanizma ve mafsal sorunu',
							'description' => 'Acilma-kapanma zorlasiyorsa kol, mafsal ve baglanti noktalarinda yerinde tespit yapilir.',
						],
					],
				],
			],
		];
	}

	return $pages[ $slug ] ?? null;
}
