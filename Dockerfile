# ① PHP 8.2 の公式イメージをベースにする
FROM php:8.2-fpm

# ② 必要なライブラリ・拡張機能をインストール
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    git \
    unzip \
    nodejs \
    npm \
    && docker-php-ext-install pdo pdo_mysql

# ③ Composer（PHP の依存管理ツール）をインストール
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

# ④ 作業ディレクトリを設定
WORKDIR /var/www

# ⑤ プロジェクト全体をコンテナにコピー
COPY . .

# ⑥ 依存関係をインストール＆ビルド
RUN composer install --no-dev --optimize-autoloader
RUN php artisan key:generate
RUN npm install && npm run build

# ⑦ ポートを公開
EXPOSE 8000

# ⑧ アプリケーションを起動
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
