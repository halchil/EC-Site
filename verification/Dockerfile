# ベースイメージ
FROM php:8.2-apache

# 必要なモジュールをインストール
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Apacheの設定を有効化
RUN a2enmod rewrite

# 作業ディレクトリを設定
WORKDIR /var/www/html

# コンテンツのコピー
COPY ./src /var/www/html

# ポートの公開
EXPOSE 80
