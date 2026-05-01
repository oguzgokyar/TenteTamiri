<?php
/**
 * Home hero section with slider and service carousel.
 *
 * @package AntigravityElementor
 */

$slides = [
	[
		'label'       => __('Pergola Tamiri', 'antigravity-elementor'),
		'title'       => __('Istanbul geneli pergola ve tente tamiri.', 'antigravity-elementor'),
		'description' => __('Motor, kumas ve mekanizma arizalarinda yerinde tespit, hizli teklif.', 'antigravity-elementor'),
		'image'       => 'https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?auto=format&fit=crop&w=1600&q=80',
	],
	[
		'label'       => __('Tente Servisi', 'antigravity-elementor'),
		'title'       => __('Tente arizalarina yerinde servis.', 'antigravity-elementor'),
		'description' => __('Mafsalli, kasetli ve motorlu tentelerde bakim, ayar ve onarim.', 'antigravity-elementor'),
		'image'       => 'https://images.unsplash.com/photo-1494526585095-c41746248156?auto=format&fit=crop&w=1600&q=80',
	],
	[
		'label'       => __('Zip Perde Tamiri', 'antigravity-elementor'),
		'title'       => __('Zip perde motor ve ray tamiri.', 'antigravity-elementor'),
		'description' => __('Ariza fotosunu WhatsApp ile gonderin, servis planini hizlandiralim.', 'antigravity-elementor'),
		'image'       => 'https://images.unsplash.com/photo-1512918728675-ed5a9ecdebfd?auto=format&fit=crop&w=1600&q=80',
	],
];

$service_cards = [
	[
		'icon'        => 'route',
		'image'       => 'https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?auto=format&fit=crop&w=900&q=80',
		'title'       => __('Pergola Tamiri', 'antigravity-elementor'),
		'description' => __('Motorlu pergola tavan, ray, kumas ve su alma sorunlari icin teknik mudahale.', 'antigravity-elementor'),
		'url'         => home_url('/pergola-tamiri/'),
	],
	[
		'icon'        => 'wrench',
		'image'       => 'https://images.unsplash.com/photo-1494526585095-c41746248156?auto=format&fit=crop&w=900&q=80',
		'title'       => __('Tente Tamiri', 'antigravity-elementor'),
		'description' => __('Mafsalli, kasetli ve koruklu tente sistemlerinde tamir ve ayar hizmeti.', 'antigravity-elementor'),
		'url'         => home_url('/tente-tamiri/'),
	],
	[
		'icon'        => 'shield',
		'image'       => 'https://images.unsplash.com/photo-1512918728675-ed5a9ecdebfd?auto=format&fit=crop&w=900&q=80',
		'title'       => __('Zip Perde Tamiri', 'antigravity-elementor'),
		'description' => __('Zip perde motoru, ray, durma-nokta ve kumas gerilimi sorunlarina servis.', 'antigravity-elementor'),
		'url'         => home_url('/zip-perde-tamiri/'),
	],
	[
		'icon'        => 'bolt',
		'image'       => 'https://images.unsplash.com/photo-1484154218962-a197022b5858?auto=format&fit=crop&w=900&q=80',
		'title'       => __('Tente Motoru Tamiri', 'antigravity-elementor'),
		'description' => __('Motor, kumanda ve alici kart arizalari icin hedefli teknik servis.', 'antigravity-elementor'),
		'url'         => home_url('/tente-motoru-tamiri/'),
	],
	[
		'icon'        => 'fabric',
		'image'       => 'https://images.unsplash.com/photo-1448630360428-65456885c650?auto=format&fit=crop&w=900&q=80',
		'title'       => __('Tente Kumasi Degisimi', 'antigravity-elementor'),
		'description' => __('Yirtilmis, solmus veya su geciren kumaslar icin yenileme cozumleri.', 'antigravity-elementor'),
		'url'         => home_url('/tente-kumasi-degisimi/'),
	],
	[
		'icon'        => 'wrench',
		'image'       => 'https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?auto=format&fit=crop&w=900&q=80',
		'title'       => __('Mekanizma ve Mafsal Onarimi', 'antigravity-elementor'),
		'description' => __('Kol, mafsal ve acma-kapama sisteminde zorlanma yasayan tente mekanizmalari icin servis.', 'antigravity-elementor'),
		'url'         => home_url('/mekanizma-ve-mafsal-onarimi/'),
	],
];

$info_cards = [
	[
		'icon'  => 'clock',
		'title' => __('7/24 Servis Talebi', 'antigravity-elementor'),
		'copy'  => __('Telefon veya WhatsApp ile hizli ariza kaydi.', 'antigravity-elementor'),
	],
	[
		'icon'  => 'shield',
		'title' => __('Ucretsiz Kesif ve Teklif', 'antigravity-elementor'),
		'copy'  => __('Yerinde tespit sonrasi net servis teklifi.', 'antigravity-elementor'),
	],
	[
		'icon'  => 'pin',
		'title' => __('Istanbul Geneli Servis', 'antigravity-elementor'),
		'copy'  => __('Sultanbeyli merkezli ekip, tum Istanbulda.', 'antigravity-elementor'),
	],
];
?>
<section class="section-shell section-shell--hero home-hero-shell">
	<div class="slider-shell" data-slider>
		<div class="slider-track">
			<?php foreach ($slides as $index => $slide) : ?>
				<article class="hero-slide <?php echo 0 === $index ? 'is-active' : ''; ?>" data-slide style="background-image: linear-gradient(180deg, rgba(8, 14, 12, 0.28), rgba(8, 14, 12, 0.72)), url('<?php echo esc_url($slide['image']); ?>');">
					<div class="hero-slide__content container-wide">
						<div class="hero-slide__copy">
							<p class="eyebrow"><?php echo esc_html($slide['label']); ?></p>
							<h1><?php echo esc_html($slide['title']); ?></h1>
							<p><?php echo esc_html($slide['description']); ?></p>
							<div class="button-row">
					<a class="button" href="<?php echo esc_url(antigravity_contact_phone_href()); ?>" title="<?php esc_attr_e('Istanbul Tente Tamircisi telefon hattini ara', 'antigravity-elementor'); ?>" aria-label="<?php esc_attr_e('Istanbul Tente Tamircisi telefon hattini ara', 'antigravity-elementor'); ?>"><?php esc_html_e('Hemen Ara', 'antigravity-elementor'); ?></a>
					<a class="button button--ghost button--ghost-light" href="<?php echo esc_url(antigravity_contact_whatsapp_href()); ?>" target="_blank" rel="nofollow noopener noreferrer" title="<?php esc_attr_e('WhatsApp ile servis talebi olustur', 'antigravity-elementor'); ?>" aria-label="<?php esc_attr_e('WhatsApp ile servis talebi olustur', 'antigravity-elementor'); ?>"><?php echo esc_html(antigravity_contact_whatsapp_label()); ?></a>
							</div>
						</div>
					</div>
				</article>
			<?php endforeach; ?>
		</div>

		<div class="slider-controls container-wide">
			<div class="slider-dots" data-slider-dots>
				<?php foreach ($slides as $index => $slide) : ?>
					<button class="slider-dot <?php echo 0 === $index ? 'is-active' : ''; ?>" type="button" aria-label="<?php echo esc_attr($slide['label']); ?>" data-slide-dot="<?php echo esc_attr((string) $index); ?>"></button>
				<?php endforeach; ?>
			</div>
			<div class="slider-arrows">
				<button class="slider-arrow" type="button" data-slide-prev aria-label="<?php esc_attr_e('Onceki slide', 'antigravity-elementor'); ?>">&#8249;</button>
				<button class="slider-arrow" type="button" data-slide-next aria-label="<?php esc_attr_e('Sonraki slide', 'antigravity-elementor'); ?>">&#8250;</button>
			</div>
		</div>

		<div class="slider-info-cards container-wide">
			<?php foreach ($info_cards as $card) : ?>
				<article class="slider-info-card">
					<div class="slider-info-card__icon">
						<?php echo antigravity_icon($card['icon'], 'icon-mark icon-mark--light'); ?>
					</div>
					<h2><?php echo esc_html($card['title']); ?></h2>
					<p><?php echo esc_html($card['copy']); ?></p>
				</article>
			<?php endforeach; ?>
		</div>
	</div>

	<div class="service-carousel container-wide" data-card-carousel>
		<div class="service-carousel__header">
			<div>
				<p class="eyebrow"><?php esc_html_e('Hizmet Sayfalari', 'antigravity-elementor'); ?></p>
				<h2><?php esc_html_e('Servis detaylarina tek kaydirma ile ulasin.', 'antigravity-elementor'); ?></h2>
			</div>
			<div class="slider-arrows">
				<button class="slider-arrow slider-arrow--light" type="button" data-card-prev aria-label="<?php esc_attr_e('Onceki kartlar', 'antigravity-elementor'); ?>">&#8249;</button>
				<button class="slider-arrow slider-arrow--light" type="button" data-card-next aria-label="<?php esc_attr_e('Sonraki kartlar', 'antigravity-elementor'); ?>">&#8250;</button>
			</div>
		</div>
		<div class="service-carousel__track" data-card-track>
			<?php foreach ($service_cards as $card) : ?>
					<a class="service-carousel__card" href="<?php echo esc_url($card['url']); ?>" title="<?php echo esc_attr(sprintf(__('%s hizmet sayfasini incele', 'antigravity-elementor'), $card['title'])); ?>" aria-label="<?php echo esc_attr(sprintf(__('%s hizmet sayfasini incele', 'antigravity-elementor'), $card['title'])); ?>" style="background-image: linear-gradient(180deg, rgba(12, 20, 26, 0.12), rgba(12, 20, 26, 0.95)), url('<?php echo esc_url($card['image']); ?>');">
					<div class="service-carousel__visual">
						<?php echo antigravity_icon($card['icon'], 'icon-mark icon-mark--light'); ?>
						<span class="service-carousel__badge"><?php esc_html_e('Hizmete Git', 'antigravity-elementor'); ?></span>
					</div>
					<h3><?php echo esc_html($card['title']); ?></h3>
					<p><?php echo esc_html($card['description']); ?></p>
				</a>
			<?php endforeach; ?>
		</div>
	</div>
</section>
