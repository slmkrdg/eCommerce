FROM php:8.2-fpm

# Çalışma dizini
WORKDIR /var/www

# Gerekli bağımlılıkları yükle
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    curl \
    unzip \
    git \
    libsodium-dev

# Çalışma dizini tanımla
WORKDIR /var/www/html

# Laravel dosyalarını kopyala
COPY . /var/www/html

# Composer'ı yükle
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# PHP eklentilerini yükle
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd sodium

# Laravel için gerekli dizinleri oluştur
RUN mkdir -p /var/www/storage /var/www/bootstrap/cache

# Dizinlerin sahipliğini www-data kullanıcısına atama

RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 777 /var/www/html/storage /var/www/html/bootstrap/cache

# Proje dosyalarını kopyala ve sahiplik değiştir
COPY --chown=www-data:www-data . .

# Composer bağımlılıklarını yükle
RUN composer install --no-dev --optimize-autoloader

# Laravel yapılandırmasını önbelleğe al
RUN php artisan config:cache


# PHP-FPM çalıştır
EXPOSE 9000
CMD ["php-fpm"]
