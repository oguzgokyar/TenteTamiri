import { useState } from "react";
import tokens from "../../shared/design-tokens.json";
import { businessProfile } from "./data/generated-business-profile";
import PostCard from "./components/PostCard";
import SectionHeading from "./components/SectionHeading";
import ServiceCard from "./components/ServiceCard";
import SidebarPreview from "./components/SidebarPreview";
import {
  metrics,
  navigation,
  pageDefinitions,
  posts,
  services,
  sidebarItems
} from "./data/siteContent";

const pageOrder = ["home", "about", "services", "contact", "blog"];

function PreviewHeader({ activePage, setActivePage }) {
  return (
    <header className="preview-header">
      <div className="preview-header__brand">
        <span className="eyebrow">SEO + UI Workspace</span>
        <h1>{businessProfile.brand.name}</h1>
        <p>{businessProfile.brand.tagline}</p>
      </div>
      <nav className="preview-nav" aria-label="Preview pages">
        {pageOrder.map((page) => (
          <button
            key={page}
            type="button"
            className={activePage === page ? "chip chip--active" : "chip"}
            onClick={() => setActivePage(page)}
          >
            {pageDefinitions[page].label}
          </button>
        ))}
      </nav>
    </header>
  );
}

function ThemeChrome() {
  return (
    <div className="site-header preview-card">
      <div className="site-header__row">
        <div>
          <strong className="brand-mark">{businessProfile.brand.shortName}</strong>
          <p>{businessProfile.serviceArea.coverageLabel}</p>
        </div>
        <div className="site-header__nav">
          {navigation.map((item) => (
            <span key={item}>{item}</span>
          ))}
        </div>
        <button className="button button--ghost" type="button">
          Ucretsiz Kesif
        </button>
      </div>
    </div>
  );
}

function HomePage() {
  return (
    <>
      <section className="hero preview-card">
        <div className="hero__copy">
          <p className="eyebrow">{businessProfile.serviceArea.coverageLabel}</p>
          <h2>Pergola, tente ve zip perde sistemlerinde hizli tamir ve bakim servisi.</h2>
          <p>
            Hero alani; Istanbul genelinde hizmet, ayni gun servis hissi, ücretsiz kesif ve
            cift CTA modelini birlikte tasiyacak sekilde kurgulandi.
          </p>
          <div className="button-row">
            <button className="button" type="button">
              Hemen Ara
            </button>
            <button className="button button--ghost" type="button">
              WhatsApp Destek
            </button>
          </div>
          <ul className="check-list">
            <li>7/24 servis</li>
            <li>Istanbul geneli ilce kapsami</li>
            <li>Motor, kumas ve mekanizma odakli servis</li>
          </ul>
        </div>
        <div className="hero__panel hero__panel--dark">
          {metrics.map((metric) => (
            <div className="mini-metric" key={metric.label}>
              <span>{metric.label}</span>
              <strong>{metric.value}</strong>
            </div>
          ))}
        </div>
      </section>

      <section className="section-shell">
        <SectionHeading
          eyebrow="Ana Hizmetler"
          title="Arama niyetine en yakin ticari bolumleri tek ekranda topluyoruz."
          copy="Kart yapisi; SEO landing page mantigi ile hizli hizmet taramasi arasinda denge kuruyor."
        />
        <div className="card-grid">
          {services.map((service) => (
            <ServiceCard key={service.title} {...service} />
          ))}
        </div>
      </section>

      <section className="section-shell">
        <div className="story-grid">
          <div className="story-card">
            <p className="eyebrow">Ariza Dili</p>
            <h3>
              Rakiplerdeki gibi sadece genis liste yerine, gercek kullanici sorunlarina gore sayfa
              dili kuruyoruz.
            </h3>
            <p>
              “Tente acilmiyor”, “pergola su aliyor”, “zip perde takiliyor”, “motor ses yapiyor”
              gibi sorgular tasarim ve icerik mimarisini yonlendiriyor.
            </p>
          </div>
          <div className="stats-card">
            <div className="stats-card__row">
              <strong>Telefon</strong>
              <span>{businessProfile.contact.phoneDisplay}</span>
            </div>
            <div className="stats-card__row">
              <strong>Adres</strong>
              <span>{businessProfile.location.fullAddress}</span>
            </div>
            <div className="stats-card__row">
              <strong>Model</strong>
              <span>{businessProfile.business.priceModel}</span>
            </div>
          </div>
        </div>
      </section>
    </>
  );
}

function AboutPage() {
  return (
    <section className="section-shell">
      <SectionHeading
        eyebrow="Hakkimizda"
        title="Lokal guven sinyalleri ile daha temiz ve kurumsal bir servis profili kur."
        copy="Adres, ekip dili, servis sureci ve neden bu modeli benimsedigimiz burada netlesir."
      />
      <div className="story-grid">
        <div className="story-card">
          <p className="eyebrow">Merkez</p>
          <h3>{businessProfile.location.fullAddress}</h3>
          <p>
            Sultanbeyli merkezli ekip; Istanbul genelinde tente, pergola ve zip perde sistemleri
            icin ariza kaydi, kesif ve teknik servis sureci yonetir.
          </p>
        </div>
        <div className="card-grid card-grid--single">
          <ServiceCard tag="Fark" title="Ucretsiz Kesif" description="Sahaya inmeden net fiyat vermek yerine arizayi yerinde degerlendiririz." />
          <ServiceCard tag="Fark" title="7/24 Ulasim" description="Telefon ve WhatsApp uzerinden hizli geri donus modeli kurariz." />
        </div>
      </div>
    </section>
  );
}

function ServicesPage() {
  return (
    <section className="section-shell">
      <SectionHeading
        eyebrow="Hizmetler"
        title="Servis kartlari yalnizca gostermelik degil; hizmet detay sayfalarina acilan landing bloklari gibi dusunulmeli."
        copy="Her kart ayni zamanda ilgili servis sayfasinin title, H1 ve CTA stratejisini de belirler."
      />
      <div className="card-grid">
        {services.map((service) => (
          <ServiceCard key={service.title} {...service} />
        ))}
      </div>
    </section>
  );
}

function ContactPage() {
  return (
    <section className="section-shell">
      <SectionHeading
        eyebrow="Iletisim"
        title="Iletisim sayfasi soguk bir form alani degil, direkt aksiyona geciren bir servis merkezi gibi hissettirmeli."
        copy="Telefon, WhatsApp, adres ve kesif akisini tek ekranda netlestiriyoruz."
      />
      <div className="story-grid">
        <div className="story-card">
          <p className="eyebrow">Iletisim Bilgileri</p>
          <h3>{businessProfile.contact.phoneDisplay}</h3>
          <ul className="check-list">
            <li>{businessProfile.location.fullAddress}</li>
            <li>{businessProfile.business.hoursLabel}</li>
            <li>{businessProfile.business.priceModel}</li>
          </ul>
        </div>
        <form className="contact-card">
          <label>
            <span>Ad Soyad</span>
            <input type="text" placeholder="Mehmet Yilmaz" />
          </label>
          <label>
            <span>Telefon</span>
            <input type="text" placeholder="0554 000 00 00" />
          </label>
          <label>
            <span>Ariza Notu</span>
            <textarea placeholder="Pergola tavan hareket etmiyor, motor ses yapiyor." />
          </label>
          <button className="button" type="button">
            Kesif Talep Et
          </button>
        </form>
      </div>
    </section>
  );
}

function BlogPage() {
  return (
    <section className="section-shell">
      <SectionHeading
        eyebrow="Blog + SEO"
        title="Uzmanlik icerikleri; sadece trafik icin degil, hizmet sayfalarini destekleyen guven katmani icin de var."
        copy="Blog kartlari; lokal ve ticari sayfalara anlamsiz rakip kopyasi degil, sahaya dayali orijinal icerik desteklemeli."
      />
      <div className="content-with-sidebar">
        <div className="post-grid post-grid--stacked">
          {posts.map((post) => (
            <PostCard key={post.title} {...post} />
          ))}
        </div>
        <SidebarPreview items={sidebarItems} />
      </div>
    </section>
  );
}

function TokenPanel() {
  const palette = [
    tokens.colors.brand.primary,
    tokens.colors.brand.secondary,
    tokens.colors.brand.accent,
    tokens.colors.surface.canvas,
    tokens.colors.surface.strong
  ];

  return (
    <section className="token-panel preview-card">
      <div>
        <p className="eyebrow">Shared Tokens</p>
        <h3>Preview ve WordPress ayni tasarim contract'ini kullaniyor.</h3>
      </div>
      <div className="token-swatches">
        {palette.map((color) => (
          <div key={color} className="token-swatch">
            <span style={{ backgroundColor: color }} />
            <code>{color}</code>
          </div>
        ))}
      </div>
      <div className="token-meta">
        <p>
          <strong>Display:</strong> {tokens.typography.fontFamily.display}
        </p>
        <p>
          <strong>Service area:</strong> {businessProfile.serviceArea.city}
        </p>
        <p>
          <strong>CTA:</strong> Telefon + WhatsApp
        </p>
      </div>
    </section>
  );
}

export default function App() {
  const [activePage, setActivePage] = useState("home");

  const pageContent = {
    home: <HomePage />,
    about: <AboutPage />,
    services: <ServicesPage />,
    contact: <ContactPage />,
    blog: <BlogPage />
  };

  return (
    <div className="preview-shell">
      <PreviewHeader activePage={activePage} setActivePage={setActivePage} />

      <div className="preview-stage">
        <aside className="preview-sidebar">
          <p className="eyebrow">Current Page</p>
          <h2>{pageDefinitions[activePage].label}</h2>
          <p>{pageDefinitions[activePage].intro}</p>
          <div className="sidebar-note">
            <strong>Transfer mantigi</strong>
            <p>
              Burada netlesen hero, hizmet ve CTA mantigi WordPress temasina section section
              aktarilacak; Elementor ise son duzenleme araci olarak kalacak.
            </p>
          </div>
        </aside>

        <main className="preview-canvas">
          <ThemeChrome />
          <div className="preview-page">{pageContent[activePage]}</div>
          <TokenPanel />
          <footer className="preview-footer preview-card">
            <div>
              <p className="eyebrow">Footer Region</p>
              <h3>Lokal guven + telefon + ilce kapsami footer dilinin cekirdegi olacak.</h3>
            </div>
            <div className="footer-links">
              <span>{businessProfile.contact.phoneDisplay}</span>
              <span>{businessProfile.location.district}</span>
              <span>{businessProfile.business.hoursLabel}</span>
            </div>
          </footer>
        </main>
      </div>
    </div>
  );
}
