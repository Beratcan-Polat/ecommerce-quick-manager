# E-Ticaret Hızlı Ürün & Stok Yönetim Paneli

Laravel ile geliştirilmiş, ürün ekleme, listeleme ve silme işlemlerini tek ekrandan yönetmeye yarayan hafif bir stok yönetim modülüdür.

## Gereksinimler

- PHP >= 8.2
- Composer
- MySQL

## Kurulum

Projeyi klonlayın:

```bash
git clone https://github.com/Beratcan-Polat/ecommerce-quick-manager.git
cd ecommerce-quick-manager
```

Bağımlılıkları yükleyin:

```bash
composer install
```

`.env` dosyasını oluşturun ve uygulama anahtarını üretin:

```bash
cp .env.example .env
php artisan key:generate
```

`.env` dosyasını açarak veritabanı bilgilerinizi girin:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ecommerce_manager
DB_USERNAME=root
DB_PASSWORD=
```

MySQL üzerinde `ecommerce_manager` adında bir veritabanı oluşturun, ardından migration'ları çalıştırın:

```bash
php artisan migrate
```

Uygulamayı başlatın:

```bash
php artisan serve
```

Tarayıcıdan `http://127.0.0.1:8000` adresine giderek panele erişebilirsiniz.

## Kullanım

- Sol taraftaki form üzerinden yeni ürün ekleyebilirsiniz.
- Sağ taraftaki tabloda tüm ürünler listelenir.
- Stok durumu sıfır olan ürünler "Tükendi", stokta olanlar "Stokta (x adet)" olarak gösterilir.
- Her ürünün yanındaki silme butonu ile kayıt silinebilir.

## Teknolojiler

- Laravel 13
- Bootstrap 5
- MySQL
- Blade şablon motoru
