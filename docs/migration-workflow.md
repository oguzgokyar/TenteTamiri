# Antigravity Migration Workflow

Bu projede canli site veritabani komple ezilmez. Tema dosyalari GitHub ile guncellenir; sayfa, SEO meta ve temel WordPress ayarlari ise kontrollu migration sistemiyle uygulanir.

## Temel Kural

Her push oncesi su istenir:

```text
Migration hazirla, preflight kontrol yap, push'a hazirla.
```

Bu adimda:

- Yeni sayfa veya slug var mi kontrol edilir.
- `antigravity-site-manager/migrations` altina migration eklenir.
- `manifest.php` zorunlu sayfa listesi guncellenir.
- PHP syntax kontrolu yapilir.
- Local WordPress'te migration dry-run kontrol edilir.

## Dosya Yapisi

```text
wordpress/wp-content/plugins/antigravity-site-manager/
  antigravity-site-manager.php
  includes/
    class-admin-page.php
    class-content-migrator.php
    class-github-updater.php
  migrations/
    manifest.php
    2026_05_01_001_core_pages.php
```

## Migration Modlari

`create_only`
Sayfa yoksa olusturur, varsa dokunmaz.

`safe`
Varsayilan moddur. Sayfa yoksa olusturur; varsa baslik, excerpt, status, template ve meta alanlarini gunceller. Mevcut sayfa icerigini ezmez.

`overwrite`
Sayfa icerigini de migration dosyasindaki icerikle degistirir. Sadece bilincli kullanilir.

`meta_only`
Sadece meta/SEO alanlari icin kullanilir.

## Canli Sitede Uygulama

1. Localde degisiklikler tamamlanir.
2. Migration hazirlanir.
3. GitHub'a push edilir.
4. Canli WordPress admin panelinde `Antigravity` sayfasina girilir.
5. `GitHub Dosya Guncelleme` alaninda repo ve branch kontrol edilir.
6. `GitHubdan Dosyalari Guncelle` butonuna basilir.
7. Eklenti once mevcut tema/eklenti klasorlerini `uploads/antigravity-site-manager/backups` altina yedekler.
8. Sadece izinli hedefler guncellenir: tema ve `antigravity-site-manager` eklentisi.
9. `Migration Onizleme` kontrol edilir.
10. Uygunsa `Bekleyen Migrationlari Uygula` butonuna basilir.

## GitHub Updater Notlari

- Varsayilan repo: `oguzgokyar/TenteTamiri`
- Varsayilan branch: `main`
- Public repo icin token gerekmez.
- Private repo icin sadece okuma yetkili GitHub token girilir.
- Token bos birakilirsa mevcut token korunur; `Kayitli tokeni temizle` secenegiyle silinir.
- Guncelleme sistemi tum WordPress'i veya veritabanini ezmez.
- Dosya silme senaryolari guvenlik icin otomatik yapilmaz; GitHub'da silinen eski dosyalar canli sunucuda kalabilir. Gerekirse manuel temizlik migration/maintenance notuyla planlanir.
- Migrationlar dosya guncellemesinden sonra da manuel uygulanir; boylece canli veritabaninda kontrolsuz degisiklik olmaz.

## Takip

Eklenti su verileri WordPress options tablosunda tutar:

- `agsm_applied_migrations`: uygulanmis migration ID listesi.
- `agsm_migration_logs`: son migration islem loglari.
- `agsm_migration_backups`: guncelleme oncesi basit sayfa yedekleri.
- `agsm_github_settings`: GitHub repo, branch ve token ayarlari.
- `agsm_github_update_logs`: GitHub dosya guncelleme loglari.

## Guvenlik Notu

Migration sistemi kullanici, yorum, form kaydi, WooCommerce verisi veya tum veritabani dump'i guncellemez. Sadece migration dosyalarinda tanimlanan sayfa, meta, menu ve ayar alanlarini isler.
