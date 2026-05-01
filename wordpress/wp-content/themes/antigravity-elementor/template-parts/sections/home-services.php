<?php
/**
 * Home services section.
 *
 * @package AntigravityElementor
 */

$services = [
	[
		'icon'        => 'route',
		'image'       => 'https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?auto=format&fit=crop&w=900&q=80',
		'title'       => __('Pergola Tamiri', 'antigravity-elementor'),
		'description' => __('Motorlu pergola sistemlerinde ray, tavan hareketi, kumas ve su alma problemlerine teknik mudahale.', 'antigravity-elementor'),
	],
	[
		'icon'        => 'wrench',
		'image'       => 'https://images.unsplash.com/photo-1494526585095-c41746248156?auto=format&fit=crop&w=900&q=80',
		'title'       => __('Tente Tamiri', 'antigravity-elementor'),
		'description' => __('Mafsalli, kasetli ve koruklu tente sistemlerinde mekanizma, kol, mafsal ve motor arizalarina servis.', 'antigravity-elementor'),
	],
	[
		'icon'        => 'shield',
		'image'       => 'https://images.unsplash.com/photo-1512918728675-ed5a9ecdebfd?auto=format&fit=crop&w=900&q=80',
		'title'       => __('Zip Perde Tamiri', 'antigravity-elementor'),
		'description' => __('Zip perde motoru, ray ayari, kumas gerilimi ve dur-kalk problemleri icin yerinde tespit.', 'antigravity-elementor'),
	],
	[
		'icon'        => 'bolt',
		'image'       => 'https://images.unsplash.com/photo-1484154218962-a197022b5858?auto=format&fit=crop&w=900&q=80',
		'title'       => __('Tente Motoru Tamiri', 'antigravity-elementor'),
		'description' => __('Motor, alici kart, kumanda ve limit ayari sorunlari icin hedefli servis.', 'antigravity-elementor'),
	],
	[
		'icon'        => 'fabric',
		'image'       => 'https://images.unsplash.com/photo-1448630360428-65456885c650?auto=format&fit=crop&w=900&q=80',
		'title'       => __('Tente Kumasi Degisimi', 'antigravity-elementor'),
		'description' => __('Yirtilan, solan veya su geciren tente kumaslarini mevcut sisteme uygun sekilde yenileme.', 'antigravity-elementor'),
	],
	[
		'icon'        => 'wrench',
		'image'       => 'https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?auto=format&fit=crop&w=900&q=80',
		'title'       => __('Mekanizma ve Mafsal Onarimi', 'antigravity-elementor'),
		'description' => __('Gevseyen, zorlanan veya kirilan mekanik parcali sistemlerde ayar, onarim ve parca degisimi.', 'antigravity-elementor'),
	],
];
?>
<section class="section-shell">
	<div class="container">
		<div class="section-heading">
			<p class="eyebrow"><?php esc_html_e('Ana Hizmetler', 'antigravity-elementor'); ?></p>
			<h2><?php esc_html_e('Istanbul geneline yayilan servis yapisinda en cok talep edilen teknik cozumler.', 'antigravity-elementor'); ?></h2>
			<p><?php esc_html_e('Ariza turunu telefon veya WhatsApp ile ilettiginizde ekibimiz uygun servis yonlendirmesi ve kesif surecini hizlandirir.', 'antigravity-elementor'); ?></p>
		</div>

		<div class="card-grid">
			<?php foreach ($services as $service) : ?>
				<article class="feature-card">
					<div class="feature-card__media" style="background-image: linear-gradient(180deg, rgba(16, 26, 32, 0.18), rgba(16, 26, 32, 0.66)), url('<?php echo esc_url($service['image']); ?>');">
						<?php echo antigravity_icon($service['icon'], 'icon-mark icon-mark--light'); ?>
					</div>
					<p class="eyebrow"><?php esc_html_e('Servis', 'antigravity-elementor'); ?></p>
					<h3><?php echo esc_html($service['title']); ?></h3>
					<p><?php echo esc_html($service['description']); ?></p>
					<a class="text-link" href="<?php echo esc_url(home_url('/' . sanitize_title($service['title']) . '/')); ?>"><?php esc_html_e('Detaylari incele', 'antigravity-elementor'); ?></a>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>
