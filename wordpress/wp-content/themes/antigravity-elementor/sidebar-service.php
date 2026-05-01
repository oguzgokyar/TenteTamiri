<?php
/**
 * Project-specific service sidebar.
 *
 * @package AntigravityElementor
 */

$service_links = [
	[
		'label' => __('Tente Tamiri', 'antigravity-elementor'),
		'url'   => home_url('/tente-tamiri/'),
		'icon'  => 'wrench',
	],
	[
		'label' => __('Pergola Tamiri', 'antigravity-elementor'),
		'url'   => home_url('/pergola-tamiri/'),
		'icon'  => 'route',
	],
	[
		'label' => __('Zip Perde Tamiri', 'antigravity-elementor'),
		'url'   => home_url('/zip-perde-tamiri/'),
		'icon'  => 'fabric',
	],
	[
		'label' => __('Tente Motoru Tamiri', 'antigravity-elementor'),
		'url'   => home_url('/tente-motoru-tamiri/'),
		'icon'  => 'bolt',
	],
	[
		'label' => __('Tente Kumasi Degisimi', 'antigravity-elementor'),
		'url'   => home_url('/tente-kumasi-degisimi/'),
		'icon'  => 'shield',
	],
	[
		'label' => __('Mekanizma ve Mafsal Onarimi', 'antigravity-elementor'),
		'url'   => home_url('/mekanizma-ve-mafsal-onarimi/'),
		'icon'  => 'clock',
	],
];

?>
<aside class="service-sidebar" aria-label="<?php esc_attr_e('Hizmet sayfasi yan alani', 'antigravity-elementor'); ?>">
	<div class="service-sidebar__inner">
		<section class="service-sidebar-card" data-reveal="lift">
			<h2><?php esc_html_e('Hizmetler', 'antigravity-elementor'); ?></h2>
			<nav class="service-sidebar-menu" aria-label="<?php esc_attr_e('Hizmet sayfalari', 'antigravity-elementor'); ?>">
				<?php foreach ($service_links as $link) : ?>
					<a href="<?php echo esc_url($link['url']); ?>">
						<?php echo antigravity_icon($link['icon'], 'icon-mark icon-mark--ghost'); ?>
						<span><?php echo esc_html($link['label']); ?></span>
					</a>
				<?php endforeach; ?>
			</nav>
		</section>

		<a class="service-sidebar-feature service-sidebar-feature--references" href="<?php echo esc_url(home_url('/referanslar/')); ?>" data-reveal="lift">
			<span class="service-sidebar-feature__icon"><?php echo antigravity_icon('shield', 'icon-mark icon-mark--light'); ?></span>
			<span class="eyebrow"><?php esc_html_e('Referanslarimiz', 'antigravity-elementor'); ?></span>
			<strong><?php esc_html_e('Tamamlanan isleri ve uygulama alanlarini inceleyin.', 'antigravity-elementor'); ?></strong>
			<small><?php esc_html_e('Kafe, restoran, balkon ve is yeri tente/pergola servislerinden ornekler.', 'antigravity-elementor'); ?></small>
			<span class="service-sidebar-feature__arrow" aria-hidden="true">+</span>
		</a>

		<a class="service-sidebar-feature service-sidebar-feature--video" href="<?php echo esc_url(home_url('/video-galeri/')); ?>" data-reveal="lift">
			<span class="service-sidebar-feature__icon"><?php echo antigravity_icon('play', 'icon-mark icon-mark--light'); ?></span>
			<span class="eyebrow"><?php esc_html_e('Video Galeri', 'antigravity-elementor'); ?></span>
			<strong><?php esc_html_e('Servis surecini videolarla gorun.', 'antigravity-elementor'); ?></strong>
			<small><?php esc_html_e('Ariza tespiti, mekanizma kontrolu ve saha servis akisindan kisa anlatimlar.', 'antigravity-elementor'); ?></small>
			<span class="service-sidebar-feature__arrow" aria-hidden="true">+</span>
		</a>
	</div>
</aside>
