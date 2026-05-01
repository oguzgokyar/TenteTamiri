# Antigravity Elementor Theme Lab

Bu repo, iki katmanli bir WordPress tema gelistirme akisi kurar:

- `preview/`: Tasarimi WordPress'e tasimadan once hizli sekilde gorebildigin React/Vite preview alani
- `wordpress/`: Docker ile calisan WordPress ve Elementor uyumlu klasik tema

## Hazir durum

Bu ilk surumde su altyapi hazir:

- Docker tabanli WordPress + MySQL + phpMyAdmin
- Elementor Pro uyumlu klasik tema iskeleti
- `header`, `footer`, `sidebar`, `front-page`, `page`, `single`, `archive`, `search`, `404`
- `Elementor Full Width` ve `Elementor Canvas` sayfa sablonlari
- Ortak design token sistemi
- Responsive preview app

## Klasor yapisi

```text
shared/                  Ortak design tokens
scripts/                 Token build script
preview/                 Tasarim onizleme uygulamasi
wordpress/wp-content/
  themes/
    antigravity-elementor/  Elementor uyumlu tema
  plugins/                  Manuel plugin/zip yerlestirme alani
```

## Kullanilan URL'ler

- WordPress: [http://localhost:8080](http://localhost:8080)
- phpMyAdmin: [http://localhost:8081](http://localhost:8081)
- Preview app: varsayilan olarak `http://localhost:5173`

## Komutlar

Kok dizinde:

```bash
npm run tokens:build
npm run preview:setup
npm run preview:dev
npm run preview:build
npm run wp:up
npm run wp:down
npm run wp:logs
```

## Gelistirme akisi

1. Preview tarafinda section, sayfa ve layout kararlarini olustur.
2. `shared/design-tokens.json` icinde renk, tipografi ve spacing sistemini guncelle.
3. `npm run tokens:build` ile ortak tokenlari preview ve WordPress temasina senkronize et.
4. Onaylanan section mantigini WordPress tema parcasi veya Elementor editable bolgesi olarak uygula.
5. WordPress panelinde ilgili sayfayi Elementor ile acip widget seviyesinde duzenle.

## WordPress tema notlari

- Tema adi: `Antigravity Elementor`
- Tema, Elementor Theme Builder lokasyonlarini kaydeder.
- Elementor yoksa tema kendi varsayilan `header` ve `footer` ciktisini verir.
- Elementor aktif ve Theme Builder override varsa tema o lokasyonlari devreder.
- Sidebar widget mantigi WordPress tarafinda kalir; icerik bolgesi Elementor ile duzenlenebilir.

## Elementor kurulumu

`Elementor` ve `Elementor Pro` lisansli dagitim nedeniyle repoya dahil edilmedi.

Kurulum secenekleri:

- WordPress admin panelinden `Elementor` eklentisini kur
- `Elementor Pro` zip paketini WordPress admin panelinden yukle
- Istersen zip icerigini `wordpress/wp-content/plugins/` altina da manuel koyabilirsin

Kurulumdan sonra:

- Temayi etkinlestir
- `Anasayfa`, `Iletisim`, `Hizmetler` gibi sayfalar olustur
- Gerekirse sayfa sablonu olarak `Elementor Full Width` veya `Elementor Canvas` sec
- Header ve footer'i Elementor Theme Builder ile override et

## Tasarim sistemi

Ortak tasarim contract'i:

- `colors`
- `typography`
- `spacing`
- `layout`
- `effects`
- `breakpoints`

Kaynak dosya:

- [shared/design-tokens.json](C:\Users\user\Documents\GitHub\Antigravity\WPTema\shared\design-tokens.json)

Uretilen CSS hedefleri:

- [preview/src/styles/tokens.css](C:\Users\user\Documents\GitHub\Antigravity\WPTema\preview\src\styles\tokens.css)
- [wordpress/wp-content/themes/antigravity-elementor/assets/css/tokens.css](C:\Users\user\Documents\GitHub\Antigravity\WPTema\wordpress\wp-content\themes\antigravity-elementor\assets\css\tokens.css)

Tasarim referans dokumani:

- [docs/design-criteria.md](C:\Users\user\Documents\GitHub\Antigravity\WPTema\docs\design-criteria.md)

## Ilk duzenleme noktalarimiz

Bu repoda bundan sonra birlikte en hizli ilerleyecegimiz alanlar:

- Preview icinde yeni sayfa varyasyonlari eklemek
- WordPress tema parcasi olarak yeni section'lar cikarmak
- Elementor widget stillerini daha da ozellestirmek
- Kurumsal tema yerine ajans, portfolyo veya WooCommerce hazirlikli varyantlar olusturmak
