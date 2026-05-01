<?php
/**
 * Home districts section.
 *
 * @package AntigravityElementor
 */

$districts = antigravity_business_districts();
?>
<section class="section-shell">
	<div class="container">
		<div class="section-heading">
			<p class="eyebrow"><?php esc_html_e('Ilce Kapsami', 'antigravity-elementor'); ?></p>
			<h2><?php esc_html_e('Sultanbeyli merkezli servis agi ile Istanbulun farkli noktalarina ulasiyoruz.', 'antigravity-elementor'); ?></h2>
			<p><?php esc_html_e('Ilce bazli servis sayfalarimizda ulasim hizi, hizmet senaryosu ve ariza turlerine gore daha odakli bilgi sunacagiz.', 'antigravity-elementor'); ?></p>
		</div>
		<div class="district-grid">
			<?php foreach ($districts as $district) : ?>
				<span class="district-pill"><?php echo esc_html($district); ?></span>
			<?php endforeach; ?>
		</div>
	</div>
</section>

