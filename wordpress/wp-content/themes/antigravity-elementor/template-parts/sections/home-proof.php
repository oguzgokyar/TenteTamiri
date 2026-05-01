<?php
/**
 * Home proof section.
 *
 * @package AntigravityElementor
 */

?>
<section class="section-shell">
	<div class="container story-grid">
		<div class="story-card">
			<p class="eyebrow"><?php esc_html_e('Guven ve Iletisim', 'antigravity-elementor'); ?></p>
			<h2><?php esc_html_e('Adres, telefon ve hizli ulasim modeliyle guven veren servis akisi sunuyoruz.', 'antigravity-elementor'); ?></h2>
			<p><?php esc_html_e('Ariza durumunda telefonla hemen ulasabilir, WhatsApp uzerinden fotograf gondererek servis planlamasini hizlandirabilirsiniz.', 'antigravity-elementor'); ?></p>
			<ul class="check-list">
				<li><?php echo esc_html(antigravity_full_address()); ?></li>
				<li><?php echo esc_html(antigravity_contact_phone_display()); ?></li>
				<li><?php esc_html_e('WhatsApp ile ariza fotografi gonderebilirsiniz', 'antigravity-elementor'); ?></li>
			</ul>
			<div class="proof-badges">
				<span><?php esc_html_e('Kurumsal Servis Akisi', 'antigravity-elementor'); ?></span>
				<span><?php esc_html_e('Yerinde Tespit', 'antigravity-elementor'); ?></span>
				<span><?php esc_html_e('Istanbul Geneli Ulasim', 'antigravity-elementor'); ?></span>
			</div>
		</div>

		<div class="stats-card stats-card--visual">
			<div class="stats-card__row">
				<strong><?php esc_html_e('7/24', 'antigravity-elementor'); ?></strong>
				<span><?php esc_html_e('Servis talepleri icin aktif cagri akisi', 'antigravity-elementor'); ?></span>
			</div>
			<div class="stats-card__row">
				<strong><?php esc_html_e('Ucretsiz', 'antigravity-elementor'); ?></strong>
				<span><?php esc_html_e('Kesif ve teklif mantigiyla karar sureci', 'antigravity-elementor'); ?></span>
			</div>
			<div class="stats-card__row">
				<strong><?php esc_html_e('Istanbul', 'antigravity-elementor'); ?></strong>
				<span><?php esc_html_e('Tum ilcelere servis planlamasi', 'antigravity-elementor'); ?></span>
			</div>
			<div class="proof-map">
				<?php echo antigravity_icon('route', 'icon-mark icon-mark--ghost'); ?>
				<p><?php esc_html_e('Sultanbeyli merkezli ekip, Anadolu ve Avrupa yakasinda talepleri bolgesel planlama ile yonetir.', 'antigravity-elementor'); ?></p>
			</div>
		</div>
	</div>
</section>
