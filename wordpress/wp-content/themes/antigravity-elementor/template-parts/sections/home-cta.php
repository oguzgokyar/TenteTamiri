<?php
/**
 * Home CTA section.
 *
 * @package AntigravityElementor
 */

?>
<section class="section-shell section-shell--accent">
	<div class="container cta-banner">
		<div>
			<p class="eyebrow"><?php esc_html_e('Hemen Teklif Al', 'antigravity-elementor'); ?></p>
			<h2><?php esc_html_e('Tente veya pergola sisteminizde ariza varsa bize ulasin, kesif surecini hemen baslatalim.', 'antigravity-elementor'); ?></h2>
		</div>
		<div class="button-row">
			<a class="button" href="<?php echo esc_url(antigravity_contact_phone_href()); ?>"><?php esc_html_e('Hemen Ara', 'antigravity-elementor'); ?></a>
			<a class="button button--ghost" href="<?php echo esc_url(antigravity_contact_whatsapp_href()); ?>" target="_blank" rel="noopener noreferrer"><?php echo esc_html(antigravity_contact_whatsapp_label()); ?></a>
		</div>
	</div>
</section>

