<?php
/**
 * Theme header.
 *
 * @package AntigravityElementor
 */

?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="skip-link screen-reader-text" href="#content" title="<?php esc_attr_e('Ana icerige gec', 'antigravity-elementor'); ?>" aria-label="<?php esc_attr_e('Ana icerige gec', 'antigravity-elementor'); ?>"><?php esc_html_e('Skip to content', 'antigravity-elementor'); ?></a>
<div id="page" class="site-shell">
	<?php if (! function_exists('elementor_theme_do_location') || ! elementor_theme_do_location('header')) : ?>
		<header class="site-header" data-site-header>
			<div class="site-topbar">
				<div class="container-wide site-topbar__inner">
					<p class="site-topbar__slogan">
						<?php esc_html_e('Istanbul genelinde tente ve pergola tamiri icin hizli servis destegi.', 'antigravity-elementor'); ?>
					</p>
					<div class="site-topbar__social">
						<a href="<?php echo esc_url(antigravity_contact_whatsapp_href()); ?>" target="_blank" rel="nofollow noopener noreferrer" title="<?php esc_attr_e('WhatsApp ile servis talebi olustur', 'antigravity-elementor'); ?>" aria-label="<?php esc_attr_e('WhatsApp ile servis talebi olustur', 'antigravity-elementor'); ?>">
							<?php esc_html_e('WhatsApp', 'antigravity-elementor'); ?>
						</a>
						<a href="<?php echo esc_url(antigravity_contact_phone_href()); ?>" title="<?php esc_attr_e('Istanbul Tente Tamircisi telefon hattini ara', 'antigravity-elementor'); ?>" aria-label="<?php esc_attr_e('Istanbul Tente Tamircisi telefon hattini ara', 'antigravity-elementor'); ?>">
							<?php esc_html_e('Hemen Ara', 'antigravity-elementor'); ?>
						</a>
					</div>
				</div>
			</div>
			<div class="site-header__contact-row">
				<div class="site-header__contact-inner container-wide">
					<div class="site-brand">
						<?php echo antigravity_site_logo(); ?>
					</div>

					<div class="site-header__contact-list" aria-label="<?php esc_attr_e('Iletisim bilgileri', 'antigravity-elementor'); ?>">
						<a class="site-header__contact-item" href="<?php echo esc_url(antigravity_contact_phone_href()); ?>" title="<?php esc_attr_e('Istanbul Tente Tamircisi telefon hattini ara', 'antigravity-elementor'); ?>" aria-label="<?php esc_attr_e('Istanbul Tente Tamircisi telefon hattini ara', 'antigravity-elementor'); ?>">
							<?php echo antigravity_icon('phone', 'icon-mark icon-mark--header'); ?>
							<span>
								<strong><?php esc_html_e('Telefon', 'antigravity-elementor'); ?></strong>
								<small><?php echo esc_html(antigravity_contact_phone_display()); ?></small>
							</span>
						</a>
						<a class="site-header__contact-item" href="<?php echo esc_url(antigravity_contact_whatsapp_href()); ?>" target="_blank" rel="nofollow noopener noreferrer" title="<?php esc_attr_e('WhatsApp ile servis talebi olustur', 'antigravity-elementor'); ?>" aria-label="<?php esc_attr_e('WhatsApp ile servis talebi olustur', 'antigravity-elementor'); ?>">
							<?php echo antigravity_icon('message', 'icon-mark icon-mark--header'); ?>
							<span>
								<strong><?php esc_html_e('WhatsApp Destek', 'antigravity-elementor'); ?></strong>
								<small><?php echo esc_html(antigravity_contact_whatsapp_label()); ?></small>
							</span>
						</a>
						<span class="site-header__contact-item">
							<?php echo antigravity_icon('pin', 'icon-mark icon-mark--header'); ?>
							<span>
								<strong><?php esc_html_e('Adres', 'antigravity-elementor'); ?></strong>
								<small><?php echo esc_html(antigravity_full_address()); ?></small>
							</span>
						</span>
					</div>
				</div>
			</div>

			<div class="site-menu-bar">
				<div class="site-menu-bar__inner container-wide">
					<button class="menu-toggle" type="button" aria-expanded="false" aria-controls="mobile-drawer" aria-label="<?php esc_attr_e('Mobil menuyu ac', 'antigravity-elementor'); ?>">
						<span></span>
						<span></span>
					</button>

					<div class="site-menu-bar__mobile-brand">
						<?php echo antigravity_site_logo('site-logo site-logo--mobile-header'); ?>
					</div>

					<nav class="site-nav" aria-label="<?php esc_attr_e('Primary menu', 'antigravity-elementor'); ?>">
						<?php
						wp_nav_menu(
							[
								'theme_location' => 'primary',
								'menu_id'        => 'primary-menu',
								'container'      => false,
								'menu_class'     => 'site-nav__menu',
								'fallback_cb'    => 'wp_page_menu',
							]
						);
						?>
					</nav>

					<div class="site-menu-bar__actions">
						<a class="site-menu-search" href="<?php echo esc_url(home_url('/?s=')); ?>" title="<?php esc_attr_e('Site ici arama yap', 'antigravity-elementor'); ?>" aria-label="<?php esc_attr_e('Site ici arama yap', 'antigravity-elementor'); ?>">
							<span class="site-menu-search__icon"></span>
						</a>
						<a class="button site-header__cta" href="<?php echo esc_url(home_url('/iletisim/')); ?>" title="<?php esc_attr_e('Tente ve pergola servisi icin teklif al', 'antigravity-elementor'); ?>" aria-label="<?php esc_attr_e('Tente ve pergola servisi icin teklif al', 'antigravity-elementor'); ?>">
							<?php esc_html_e('Teklif Al', 'antigravity-elementor'); ?>
						</a>
					</div>
				</div>
			</div>

			<div class="site-mobile-drawer" id="mobile-drawer" aria-hidden="true" data-mobile-drawer>
				<button class="site-mobile-drawer__overlay" type="button" aria-label="<?php esc_attr_e('Mobil menuyu kapat', 'antigravity-elementor'); ?>" data-mobile-drawer-close></button>
				<aside class="site-mobile-drawer__panel" role="dialog" aria-modal="true" aria-label="<?php esc_attr_e('Mobil menu', 'antigravity-elementor'); ?>">
					<div class="site-mobile-drawer__top">
						<p><?php esc_html_e('Istanbul geneli hizli servis', 'antigravity-elementor'); ?></p>
						<button class="site-mobile-drawer__close" type="button" aria-label="<?php esc_attr_e('Mobil menuyu kapat', 'antigravity-elementor'); ?>" data-mobile-drawer-close>
							<span></span>
							<span></span>
						</button>
					</div>

					<div class="site-mobile-drawer__brand">
						<div class="site-brand">
							<?php echo antigravity_site_logo('site-logo site-logo--drawer'); ?>
						</div>
						<p><?php esc_html_e('Tente, pergola ve zip perde arizalarinda yerinde tespit ve onarim destegi.', 'antigravity-elementor'); ?></p>
					</div>

					<nav class="site-mobile-nav" aria-label="<?php esc_attr_e('Mobil ana menu', 'antigravity-elementor'); ?>">
						<?php
						wp_nav_menu(
							[
								'theme_location' => 'primary',
								'menu_id'        => 'mobile-menu',
								'container'      => false,
								'menu_class'     => 'site-mobile-nav__menu',
								'fallback_cb'    => 'wp_page_menu',
							]
						);
						?>
					</nav>

					<div class="site-mobile-drawer__contacts">
						<a href="<?php echo esc_url(antigravity_contact_phone_href()); ?>" title="<?php esc_attr_e('Istanbul Tente Tamircisi telefon hattini ara', 'antigravity-elementor'); ?>" aria-label="<?php esc_attr_e('Istanbul Tente Tamircisi telefon hattini ara', 'antigravity-elementor'); ?>">
							<?php echo antigravity_icon('phone', 'icon-mark icon-mark--header'); ?>
							<span>
								<strong><?php esc_html_e('Hemen Ara', 'antigravity-elementor'); ?></strong>
								<small><?php echo esc_html(antigravity_contact_phone_display()); ?></small>
							</span>
						</a>
						<a href="<?php echo esc_url(antigravity_contact_whatsapp_href()); ?>" target="_blank" rel="nofollow noopener noreferrer" title="<?php esc_attr_e('WhatsApp ile servis talebi olustur', 'antigravity-elementor'); ?>" aria-label="<?php esc_attr_e('WhatsApp ile servis talebi olustur', 'antigravity-elementor'); ?>">
							<?php echo antigravity_icon('message', 'icon-mark icon-mark--header'); ?>
							<span>
								<strong><?php esc_html_e('WhatsApp Destek', 'antigravity-elementor'); ?></strong>
								<small><?php echo esc_html(antigravity_contact_whatsapp_label()); ?></small>
							</span>
						</a>
						<div>
							<?php echo antigravity_icon('pin', 'icon-mark icon-mark--header'); ?>
							<span>
								<strong><?php esc_html_e('Servis Merkezi', 'antigravity-elementor'); ?></strong>
								<small><?php echo esc_html(antigravity_full_address()); ?></small>
							</span>
						</div>
					</div>
				</aside>
			</div>
		</header>
	<?php endif; ?>
