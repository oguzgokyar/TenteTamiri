<?php
/**
 * Theme footer.
 *
 * @package AntigravityElementor
 */

?>
	<?php if (! function_exists('elementor_theme_do_location') || ! elementor_theme_do_location('footer')) : ?>
		<?php $antigravity_footer_visuals = antigravity_context_visuals(); ?>
		<footer class="site-footer site-footer--visual">
			<div class="site-footer__backdrop"></div>
			<div class="container-wide site-footer__inner">
				<div class="site-footer__lead">
					<div class="site-footer__brand" data-reveal="hero-rise">
						<?php if (has_custom_logo()) : ?>
							<div class="site-footer__logo"><?php the_custom_logo(); ?></div>
						<?php else : ?>
							<a class="site-footer__mark" href="<?php echo esc_url(home_url('/')); ?>" rel="home" title="<?php esc_attr_e('Istanbul Tente Tamircisi ana sayfa', 'antigravity-elementor'); ?>" aria-label="<?php esc_attr_e('Istanbul Tente Tamircisi ana sayfa', 'antigravity-elementor'); ?>"><?php bloginfo('name'); ?></a>
							<p class="site-footer__tag"><?php esc_html_e('Pergola, tente ve zip perde tamir servisi', 'antigravity-elementor'); ?></p>
						<?php endif; ?>
						<p class="site-footer__copy"><?php esc_html_e('Sultanbeyli merkezli servis ekibiyle Istanbul genelinde ariza tespiti, mekanizma onarimi, motor servisi ve kumas yenileme surecini kurumsal bir akista yonetiyoruz.', 'antigravity-elementor'); ?></p>
					</div>

					<div class="site-footer__support" data-reveal="soft-zoom">
						<p class="eyebrow"><?php esc_html_e('Servis ve Iletisim', 'antigravity-elementor'); ?></p>
						<h2><?php esc_html_e('Ariza kaydini hizlandiran modern destek hatti ve yerinde servis organizasyonu.', 'antigravity-elementor'); ?></h2>
						<p><?php esc_html_e('Telefon, WhatsApp ve ilce bazli planlama ile talebi hizli sekilde kayda alip uygun ekibi yonlendiriyoruz.', 'antigravity-elementor'); ?></p>
						<div class="button-row">
							<a class="button" href="<?php echo esc_url(antigravity_contact_phone_href()); ?>" title="<?php esc_attr_e('Istanbul Tente Tamircisi telefon hattini ara', 'antigravity-elementor'); ?>" aria-label="<?php esc_attr_e('Istanbul Tente Tamircisi telefon hattini ara', 'antigravity-elementor'); ?>"><?php echo esc_html(antigravity_contact_phone_display()); ?></a>
							<a class="button button--ghost button--ghost-light" href="<?php echo esc_url(antigravity_contact_whatsapp_href()); ?>" target="_blank" rel="nofollow noopener noreferrer" title="<?php esc_attr_e('WhatsApp ile servis talebi olustur', 'antigravity-elementor'); ?>" aria-label="<?php esc_attr_e('WhatsApp ile servis talebi olustur', 'antigravity-elementor'); ?>"><?php echo esc_html(antigravity_contact_whatsapp_label()); ?></a>
						</div>
						<div class="site-footer__gallery">
							<?php foreach ($antigravity_footer_visuals['gallery'] as $index => $visual) : ?>
								<div class="site-footer__gallery-card" data-reveal="lift" style="transition-delay: <?php echo esc_attr((string) (120 + ($index * 90))); ?>ms;">
									<div class="site-footer__gallery-media" style="background-image: linear-gradient(180deg, rgba(16, 26, 32, 0.14), rgba(16, 26, 32, 0.78)), url('<?php echo esc_url($visual['image']); ?>');"></div>
									<span><?php echo esc_html($visual['label']); ?></span>
								</div>
							<?php endforeach; ?>
						</div>
					</div>
				</div>

				<div class="site-footer__grid">
					<div class="footer-panel" data-reveal="lift">
						<?php echo antigravity_icon('phone', 'icon-mark icon-mark--light'); ?>
						<h3><?php esc_html_e('Iletisim Hatti', 'antigravity-elementor'); ?></h3>
						<ul class="footer-list">
							<li><?php echo esc_html(antigravity_contact_phone_display()); ?></li>
							<li><?php echo esc_html(antigravity_full_address()); ?></li>
							<li><?php esc_html_e('Istanbul geneli servis planlamasi', 'antigravity-elementor'); ?></li>
						</ul>
					</div>

					<div class="footer-panel" data-reveal="lift">
						<?php echo antigravity_icon('wrench', 'icon-mark icon-mark--light'); ?>
						<h3><?php esc_html_e('One Cikan Hizmetler', 'antigravity-elementor'); ?></h3>
						<ul class="footer-list">
							<li><a href="<?php echo esc_url(home_url('/tente-tamiri/')); ?>" title="<?php esc_attr_e('Tente tamiri hizmet sayfasina git', 'antigravity-elementor'); ?>" aria-label="<?php esc_attr_e('Tente tamiri hizmet sayfasina git', 'antigravity-elementor'); ?>"><?php esc_html_e('Tente Tamiri', 'antigravity-elementor'); ?></a></li>
							<li><a href="<?php echo esc_url(home_url('/pergola-tamiri/')); ?>" title="<?php esc_attr_e('Pergola tamiri hizmet sayfasina git', 'antigravity-elementor'); ?>" aria-label="<?php esc_attr_e('Pergola tamiri hizmet sayfasina git', 'antigravity-elementor'); ?>"><?php esc_html_e('Pergola Tamiri', 'antigravity-elementor'); ?></a></li>
							<li><a href="<?php echo esc_url(home_url('/zip-perde-tamiri/')); ?>" title="<?php esc_attr_e('Zip perde tamiri hizmet sayfasina git', 'antigravity-elementor'); ?>" aria-label="<?php esc_attr_e('Zip perde tamiri hizmet sayfasina git', 'antigravity-elementor'); ?>"><?php esc_html_e('Zip Perde Tamiri', 'antigravity-elementor'); ?></a></li>
						</ul>
					</div>

					<div class="footer-panel" data-reveal="lift">
						<?php echo antigravity_icon('shield', 'icon-mark icon-mark--light'); ?>
						<h3><?php esc_html_e('Servis Destegi', 'antigravity-elementor'); ?></h3>
						<ul class="footer-list">
							<li><?php esc_html_e('Ucretsiz kesif ve teklif', 'antigravity-elementor'); ?></li>
							<li><?php esc_html_e('WhatsApp ile gorsel destek', 'antigravity-elementor'); ?></li>
							<li><?php esc_html_e('7/24 cagri kabul sureci', 'antigravity-elementor'); ?></li>
						</ul>
					</div>

					<div class="footer-panel" data-reveal="lift">
						<h3><?php esc_html_e('Kurumsal Linkler', 'antigravity-elementor'); ?></h3>
						<?php
						wp_nav_menu(
							[
								'theme_location' => 'footer',
								'container'      => false,
								'menu_class'     => 'footer-menu',
								'fallback_cb'    => false,
							]
						);
						?>
						<?php if (is_active_sidebar('footer-widgets')) : ?>
							<div class="footer-panel__widgets">
								<?php dynamic_sidebar('footer-widgets'); ?>
							</div>
						<?php endif; ?>
					</div>
				</div>

				<div class="site-footer__bottom">
					<p>&copy; <?php echo esc_html(gmdate('Y')); ?> <?php bloginfo('name'); ?></p>
					<?php
					wp_nav_menu(
						[
							'theme_location' => 'legal',
							'container'      => false,
							'menu_class'     => 'legal-menu',
							'fallback_cb'    => false,
						]
					);
					?>
				</div>
			</div>
		</footer>
		<div class="mobile-sticky-cta">
			<a class="mobile-sticky-cta__button mobile-sticky-cta__button--phone" href="<?php echo esc_url(antigravity_contact_phone_href()); ?>" title="<?php esc_attr_e('Istanbul Tente Tamircisi telefon hattini ara', 'antigravity-elementor'); ?>" aria-label="<?php esc_attr_e('Istanbul Tente Tamircisi telefon hattini ara', 'antigravity-elementor'); ?>">
				<?php echo antigravity_icon('phone'); ?>
				<span><?php esc_html_e('Ara', 'antigravity-elementor'); ?></span>
			</a>
			<a class="mobile-sticky-cta__button mobile-sticky-cta__button--whatsapp" href="<?php echo esc_url(antigravity_contact_whatsapp_href()); ?>" target="_blank" rel="nofollow noopener noreferrer" title="<?php esc_attr_e('WhatsApp ile servis talebi olustur', 'antigravity-elementor'); ?>" aria-label="<?php esc_attr_e('WhatsApp ile servis talebi olustur', 'antigravity-elementor'); ?>">
				<?php echo antigravity_icon('message'); ?>
				<span><?php esc_html_e('WhatsApp', 'antigravity-elementor'); ?></span>
			</a>
		</div>
		<aside class="service-widget reveal-item is-visible" data-service-widget data-reveal="soft-zoom" aria-label="<?php esc_attr_e('Hizli servis yardim widgeti', 'antigravity-elementor'); ?>">
			<button class="service-widget__close" type="button" data-service-widget-close aria-label="<?php esc_attr_e('Servis yardim widgetini gizle', 'antigravity-elementor'); ?>">
				<span aria-hidden="true">&times;</span>
			</button>
			<div class="service-widget__bubble">
				<p><?php esc_html_e('Ara ara ugrasma, hemen gelip yapalim!', 'antigravity-elementor'); ?></p>
			</div>
			<div class="service-widget__body">
				<?php echo antigravity_service_mascot_svg(); ?>
			</div>
			<div class="service-widget__actions">
				<a class="button service-widget__button" href="<?php echo esc_url(antigravity_contact_phone_href()); ?>" title="<?php esc_attr_e('Istanbul Tente Tamircisi telefon hattini ara', 'antigravity-elementor'); ?>" aria-label="<?php esc_attr_e('Istanbul Tente Tamircisi telefon hattini ara', 'antigravity-elementor'); ?>">
					<?php esc_html_e('Hemen Ara', 'antigravity-elementor'); ?>
				</a>
				<a class="button button--ghost service-widget__button service-widget__button--ghost" href="<?php echo esc_url(antigravity_contact_whatsapp_href()); ?>" target="_blank" rel="nofollow noopener noreferrer" title="<?php esc_attr_e('WhatsApp ile servis talebi olustur', 'antigravity-elementor'); ?>" aria-label="<?php esc_attr_e('WhatsApp ile servis talebi olustur', 'antigravity-elementor'); ?>">
					<?php echo esc_html(antigravity_contact_whatsapp_label()); ?>
				</a>
			</div>
		</aside>
	<?php endif; ?>
</div>
<?php wp_footer(); ?>
</body>
</html>
