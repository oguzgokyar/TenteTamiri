<?php
/**
 * 404 template.
 *
 * @package AntigravityElementor
 */

get_header();
?>
<main id="content" class="site-main">
	<section class="section-shell">
		<div class="container hero hero--compact">
			<div class="hero__copy">
				<p class="eyebrow"><?php esc_html_e('404', 'antigravity-elementor'); ?></p>
				<h1><?php esc_html_e('Aradigin sayfa tasarim sisteminden cikmis olabilir.', 'antigravity-elementor'); ?></h1>
				<p><?php esc_html_e('Ana sayfaya don, son projeleri incele veya bu alani Elementor ile kendi yonlendirme sayfana cevir.', 'antigravity-elementor'); ?></p>
				<div class="button-row">
			<a class="button" href="<?php echo esc_url(home_url('/')); ?>" title="<?php esc_attr_e('Ana sayfaya don', 'antigravity-elementor'); ?>" aria-label="<?php esc_attr_e('Ana sayfaya don', 'antigravity-elementor'); ?>"><?php esc_html_e('Ana Sayfa', 'antigravity-elementor'); ?></a>
			<a class="button button--ghost" href="<?php echo esc_url(home_url('/iletisim')); ?>" title="<?php esc_attr_e('Iletisim sayfasina git', 'antigravity-elementor'); ?>" aria-label="<?php esc_attr_e('Iletisim sayfasina git', 'antigravity-elementor'); ?>"><?php esc_html_e('Iletisime Gec', 'antigravity-elementor'); ?></a>
				</div>
			</div>
			<div class="hero__panel stats-card">
				<h2><?php esc_html_e('Hizli alternatifler', 'antigravity-elementor'); ?></h2>
				<ul class="check-list">
					<li><?php esc_html_e('Arama kutusu ile icerik bul', 'antigravity-elementor'); ?></li>
					<li><?php esc_html_e('Hizmet sayfalarini kesfet', 'antigravity-elementor'); ?></li>
					<li><?php esc_html_e('Elementor ile ozel 404 deneyimi tasarla', 'antigravity-elementor'); ?></li>
				</ul>
				<?php get_search_form(); ?>
			</div>
		</div>
	</section>
</main>
<?php
get_footer();
