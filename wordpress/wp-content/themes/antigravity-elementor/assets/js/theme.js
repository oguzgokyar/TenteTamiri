document.addEventListener("DOMContentLoaded", () => {
  const initRevealMotion = (root = document) => {
    const revealGroups = [
      {
        selector:
          ".page-hero__content, .site-footer__brand, .section-heading, .hero__copy, .service-visual-intro__copy, .service-video-block__copy, .district-local-intro__copy, .district-access-flow__heading, .customer-reviews-band__heading, .elementor-widget-heading, .elementor-widget-text-editor",
        effect: "hero-rise",
      },
      {
        selector:
          ".page-hero__panel, .site-footer__support, .slider-info-card, .story-card--dark, .service-visual-intro__media, .service-video-block__media, .district-local-intro__map, .elementor-widget-image, .elementor-widget-video, .elementor-widget-google_maps",
        effect: "soft-zoom",
      },
      {
        selector:
          ".feature-card, .trust-card, .process-card, .faq-card, .story-card, .stats-card, .entry-card, .post-card, .footer-panel, .service-carousel__card, .service-image-card, .services-showcase-card, .service-gallery-item, .customer-review-card, .service-sidebar-card, .service-sidebar-feature, .district-problem-row, .district-access-steps li, .district-scope-card, .page-intro, .widget-card, .site-footer__gallery-card, .elementor-widget-icon-box, .elementor-widget-accordion, .elementor-widget-toggle, .elementor-widget-tabs, .elementor-widget-counter, .elementor-widget-testimonial, .elementor-widget-call-to-action, .elementor-widget-posts, .elementor-widget-form, .elementor-widget-button, .elementor-widget-icon-list",
        effect: "lift",
      },
      {
        selector:
          ".feature-card__media, .page-hero__visual, .post-card__media, .service-image-card__media, .elementor-widget-image img, .elementor-widget-video iframe",
        effect: "zoom",
      },
    ];

    const elements = [];

    revealGroups.forEach(({ selector, effect }) => {
      root.querySelectorAll(selector).forEach((element, index) => {
        if (element.dataset.revealInitialized === "true") {
          return;
        }

        element.dataset.revealInitialized = "true";
        element.dataset.reveal = element.dataset.reveal || effect;
        element.classList.add("reveal-item");

        if (!element.style.transitionDelay) {
          element.style.transitionDelay = `${Math.min(index * 70, 320)}ms`;
        }

        elements.push(element);
      });
    });

    if (!elements.length) {
      return;
    }

    const prefersReducedMotion = window.matchMedia(
      "(prefers-reduced-motion: reduce)"
    ).matches;

    if (prefersReducedMotion || !("IntersectionObserver" in window)) {
      elements.forEach((element) => element.classList.add("is-visible"));
      return;
    }

    const observer = new IntersectionObserver(
      (entries) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            entry.target.classList.add("is-visible");
            observer.unobserve(entry.target);
          }
        });
      },
      {
        threshold: 0.18,
        rootMargin: "0px 0px -8% 0px",
      }
    );

    elements.forEach((element) => observer.observe(element));
  };

  const toggle = document.querySelector(".menu-toggle");
  const nav = document.querySelector(".site-nav");
  const siteHeader = document.querySelector("[data-site-header]");
  const mobileDrawer = document.querySelector("[data-mobile-drawer]");
  const mobileDrawerCloseButtons = document.querySelectorAll(
    "[data-mobile-drawer-close]"
  );
  const mobileDrawerLinks = document.querySelectorAll(
    ".site-mobile-nav a, .site-mobile-drawer__actions a, .site-mobile-drawer__contacts a"
  );

  const closeMobileDrawer = () => {
    if (!mobileDrawer || !toggle) {
      return;
    }

    toggle.setAttribute("aria-expanded", "false");
    mobileDrawer.classList.remove("is-open");
    mobileDrawer.setAttribute("aria-hidden", "true");
    document.body.classList.remove("is-mobile-menu-open");
  };

  if (toggle) {
    toggle.addEventListener("click", () => {
      const isExpanded = toggle.getAttribute("aria-expanded") === "true";

      if (mobileDrawer) {
        toggle.setAttribute("aria-expanded", String(!isExpanded));
        mobileDrawer.classList.toggle("is-open", !isExpanded);
        mobileDrawer.setAttribute("aria-hidden", String(isExpanded));
        document.body.classList.toggle("is-mobile-menu-open", !isExpanded);
        return;
      }

      if (nav) {
        toggle.setAttribute("aria-expanded", String(!isExpanded));
        nav.classList.toggle("is-open", !isExpanded);
      }
    });
  }

  mobileDrawerCloseButtons.forEach((button) => {
    button.addEventListener("click", closeMobileDrawer);
  });

  mobileDrawerLinks.forEach((link) => {
    link.addEventListener("click", closeMobileDrawer);
  });

  document.addEventListener("keydown", (event) => {
    if (event.key === "Escape") {
      closeMobileDrawer();
    }
  });

  if (siteHeader) {
    let isCompactHeader = false;

    const updateHeaderState = () => {
      const currentScrollY = window.scrollY;

      if (!isCompactHeader && currentScrollY > 160) {
        isCompactHeader = true;
        siteHeader.classList.add("is-scrolled");
      }

      if (isCompactHeader && currentScrollY < 32) {
        isCompactHeader = false;
        siteHeader.classList.remove("is-scrolled");
      }
    };

    updateHeaderState();
    window.addEventListener("scroll", updateHeaderState, { passive: true });
  }

  const sliderRoot = document.querySelector("[data-slider]");
  if (sliderRoot) {
    const slides = Array.from(sliderRoot.querySelectorAll("[data-slide]"));
    const dots = Array.from(sliderRoot.querySelectorAll("[data-slide-dot]"));
    const prev = sliderRoot.querySelector("[data-slide-prev]");
    const next = sliderRoot.querySelector("[data-slide-next]");
    let index = 0;
    let timerId = null;

    const render = (nextIndex) => {
      index = (nextIndex + slides.length) % slides.length;
      slides.forEach((slide, slideIndex) => {
        slide.classList.toggle("is-active", slideIndex === index);
      });
      dots.forEach((dot, dotIndex) => {
        dot.classList.toggle("is-active", dotIndex === index);
      });
    };

    const start = () => {
      if (slides.length < 2) {
        return;
      }
      timerId = window.setInterval(() => render(index + 1), 5200);
    };

    const restart = () => {
      if (timerId) {
        window.clearInterval(timerId);
      }
      start();
    };

    prev?.addEventListener("click", () => {
      render(index - 1);
      restart();
    });

    next?.addEventListener("click", () => {
      render(index + 1);
      restart();
    });

    dots.forEach((dot, dotIndex) => {
      dot.addEventListener("click", () => {
        render(dotIndex);
        restart();
      });
    });

    render(0);
    start();
  }

  const cardCarousel = document.querySelector("[data-card-carousel]");
  if (cardCarousel) {
    const track = cardCarousel.querySelector("[data-card-track]");
    const prev = cardCarousel.querySelector("[data-card-prev]");
    const next = cardCarousel.querySelector("[data-card-next]");

    if (track) {
      const scrollByAmount = () => Math.max(track.clientWidth * 0.78, 280);

      prev?.addEventListener("click", () => {
        track.scrollBy({ left: -scrollByAmount(), behavior: "smooth" });
      });

      next?.addEventListener("click", () => {
        track.scrollBy({ left: scrollByAmount(), behavior: "smooth" });
      });
    }
  }

  const serviceWidget = document.querySelector("[data-service-widget]");
  const serviceWidgetClose = document.querySelector("[data-service-widget-close]");
  const serviceWidgetStorageKey = "antigravityServiceWidgetHidden";

  if (serviceWidget) {
    let isServiceWidgetHidden = false;

    try {
      isServiceWidgetHidden =
        window.sessionStorage.getItem(serviceWidgetStorageKey) === "true";
    } catch (error) {
      isServiceWidgetHidden = false;
    }

    if (isServiceWidgetHidden) {
      serviceWidget.classList.add("is-hidden");
      serviceWidget.setAttribute("aria-hidden", "true");
    }

    serviceWidgetClose?.addEventListener("click", () => {
      serviceWidget.classList.add("is-hidden");
      serviceWidget.setAttribute("aria-hidden", "true");

      try {
        window.sessionStorage.setItem(serviceWidgetStorageKey, "true");
      } catch (error) {
        // Session storage can be disabled; the visual hide should still work.
      }
    });
  }

  const serviceSidebar = document.querySelector(".service-sidebar");
  if (serviceSidebar) {
    const desktopQuery = window.matchMedia("(min-width: 1121px)");
    const topOffset = 102;
    const bottomOffset = 16;
    let lastScrollY = window.scrollY;
    let ticking = false;

    const setSidebarStickyPoint = () => {
      if (!desktopQuery.matches) {
        serviceSidebar.style.removeProperty("--ag-sidebar-sticky-top");
        ticking = false;
        return;
      }

      const currentScrollY = Math.max(window.scrollY, 0);
      const isScrollingDown = currentScrollY > lastScrollY;
      const sidebarHeight = serviceSidebar.offsetHeight;
      const bottomAlignedTop = window.innerHeight - sidebarHeight - bottomOffset;
      const stickyTop = isScrollingDown
        ? Math.min(topOffset, bottomAlignedTop)
        : topOffset;

      serviceSidebar.style.setProperty(
        "--ag-sidebar-sticky-top",
        `${stickyTop}px`
      );

      lastScrollY = currentScrollY;
      ticking = false;
    };

    const requestSidebarUpdate = () => {
      if (!ticking) {
        window.requestAnimationFrame(setSidebarStickyPoint);
        ticking = true;
      }
    };

    setSidebarStickyPoint();
    window.addEventListener("scroll", requestSidebarUpdate, { passive: true });
    window.addEventListener("resize", requestSidebarUpdate);
    desktopQuery.addEventListener?.("change", requestSidebarUpdate);
  }

  initRevealMotion(document);

  if (window.elementorFrontend?.hooks) {
    window.elementorFrontend.hooks.addAction(
      "frontend/element_ready/global",
      ($scope) => {
        if ($scope?.[0]) {
          initRevealMotion($scope[0]);
        }
      }
    );
  }
});
