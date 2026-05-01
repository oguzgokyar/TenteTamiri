<?php
/**
 * Customer reviews section.
 *
 * @package AntigravityElementor
 */

$review_link = 'https://www.google.com/search?q=' . rawurlencode('Istanbul Tente Tamircisi Sultanbeyli');

$reviews = [
	[
		'name' => __('Murat K.', 'antigravity-elementor'),
		'area' => __('Pendik', 'antigravity-elementor'),
		'text' => __('Tente motoru calismiyordu. WhatsApp uzerinden video gonderdikten sonra ayni gun servis planlandi ve sorun yerinde cozuldu.', 'antigravity-elementor'),
	],
	[
		'name' => __('Selin A.', 'antigravity-elementor'),
		'area' => __('Sultanbeyli', 'antigravity-elementor'),
		'text' => __('Kumas sarkmasi ve mekanizma zorlanmasi icin destek aldik. Oncesinde ne yapilacagini net anlattiklari icin guven verdi.', 'antigravity-elementor'),
	],
	[
		'name' => __('Emre T.', 'antigravity-elementor'),
		'area' => __('Kartal', 'antigravity-elementor'),
		'text' => __('Pergola sistemi kapanirken takiliyordu. Ekip ray ve motor ayarini kontrol edip temiz bir servis sureciyle teslim etti.', 'antigravity-elementor'),
	],
];
?>
<section class="customer-reviews-section" aria-labelledby="customer-reviews-title">
	<div class="container-wide">
		<div class="customer-reviews-band">
			<div class="customer-reviews-band__heading" data-reveal="hero-rise">
				<p class="eyebrow"><?php esc_html_e('Musteri Yorumlari', 'antigravity-elementor'); ?></p>
				<h2 id="customer-reviews-title"><?php esc_html_e('Servis sonrasi memnuniyet bizim icin en guclu referans.', 'antigravity-elementor'); ?></h2>
				<p><?php esc_html_e('Tente, pergola ve zip perde servislerinde deneyiminizi Google uzerinden paylasarak yeni musterilerin dogru karar vermesine yardimci olabilirsiniz.', 'antigravity-elementor'); ?></p>
				<a class="button" href="<?php echo esc_url($review_link); ?>" target="_blank" rel="noopener noreferrer"><?php esc_html_e('Google Yorumu Birak', 'antigravity-elementor'); ?></a>
			</div>
			<div class="customer-review-grid">
				<?php foreach ($reviews as $review) : ?>
					<article class="customer-review-card" data-reveal="lift">
						<div class="customer-review-card__stars" aria-label="<?php esc_attr_e('5 yildizli yorum', 'antigravity-elementor'); ?>">5/5</div>
						<p><?php echo esc_html($review['text']); ?></p>
						<strong><?php echo esc_html($review['name']); ?></strong>
						<span><?php echo esc_html($review['area']); ?></span>
					</article>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</section>
