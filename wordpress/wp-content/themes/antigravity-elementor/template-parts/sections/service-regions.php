<?php
/**
 * Service region links section.
 *
 * @package AntigravityElementor
 */

$local_service_links = [
	[
		'label' => __('Sultanbeyli Tente Tamiri', 'antigravity-elementor'),
		'url'   => home_url('/sultanbeyli-tente-tamiri/'),
		'note'  => __('Sultanbeyli ve cevresine yerinde tente servisi', 'antigravity-elementor'),
	],
	[
		'label' => __('Pendik Tente Tamiri', 'antigravity-elementor'),
		'url'   => home_url('/pendik-tente-tamiri/'),
		'note'  => __('Pendik bolgesinde ariza tespiti ve onarim', 'antigravity-elementor'),
	],
	[
		'label' => __('Kartal Tente Tamiri', 'antigravity-elementor'),
		'url'   => home_url('/kartal-tente-tamiri/'),
		'note'  => __('Kartal icin tente bakim ve tamir destegi', 'antigravity-elementor'),
	],
	[
		'label' => __('Umraniye Pergola Tamiri', 'antigravity-elementor'),
		'url'   => home_url('/umraniye-pergola-tamiri/'),
		'note'  => __('Pergola motor, ray ve kumas arizalarina servis', 'antigravity-elementor'),
	],
	[
		'label' => __('Atasehir Tente Servisi', 'antigravity-elementor'),
		'url'   => home_url('/atasehir-tente-servisi/'),
		'note'  => __('Atasehir icin hizli servis planlamasi', 'antigravity-elementor'),
	],
	[
		'label' => __('Maltepe Pergola Tamiri', 'antigravity-elementor'),
		'url'   => home_url('/maltepe-pergola-tamiri/'),
		'note'  => __('Maltepe ve yakin bolgelere pergola destegi', 'antigravity-elementor'),
	],
	[
		'label' => __('Uskudar Tente Tamiri', 'antigravity-elementor'),
		'url'   => home_url('/uskudar-tente-tamiri/'),
		'note'  => __('Uskudar icin tente ariza ve bakim talepleri', 'antigravity-elementor'),
	],
	[
		'label' => __('Sancaktepe Zip Perde Tamiri', 'antigravity-elementor'),
		'url'   => home_url('/sancaktepe-zip-perde-tamiri/'),
		'note'  => __('Zip perde motor, ray ve kumas sorunlarina kontrol', 'antigravity-elementor'),
	],
];
?>
<section class="service-regions-section" aria-labelledby="service-regions-title">
	<div class="container-wide">
		<div class="service-regions-band" data-reveal="hero-rise">
			<div class="service-regions-band__heading">
				<p class="eyebrow"><?php esc_html_e('Istanbul Geneli Servis', 'antigravity-elementor'); ?></p>
				<h2 id="service-regions-title"><?php esc_html_e('Bulundugunuz Bolgeye Servis Planlayalim', 'antigravity-elementor'); ?></h2>
				<p><?php esc_html_e('Tente, pergola ve zip perde arizalarinda Istanbulun farkli ilcelerine yerinde servis planlamasi yapilir.', 'antigravity-elementor'); ?></p>
			</div>
			<nav class="service-regions-grid" aria-label="<?php esc_attr_e('Bolgeye gore hizmet sayfalari', 'antigravity-elementor'); ?>">
				<?php foreach ($local_service_links as $link) : ?>
						<a href="<?php echo esc_url($link['url']); ?>" title="<?php echo esc_attr(sprintf(__('%s bolge sayfasina git', 'antigravity-elementor'), $link['label'])); ?>" aria-label="<?php echo esc_attr(sprintf(__('%s bolge sayfasina git', 'antigravity-elementor'), $link['label'])); ?>">
						<span><?php echo esc_html($link['label']); ?></span>
						<small><?php echo esc_html($link['note']); ?></small>
					</a>
				<?php endforeach; ?>
			</nav>
		</div>
	</div>
</section>
