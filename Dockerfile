# 使用官方的 PHP 7.4 映像
FROM php:7.4-apache

# 安裝系統依賴
RUN apt-get update && apt-get install -y \
    libwebp-dev \
    libjpeg-dev \
    libpng-dev \
    libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd mysqli pdo_mysql

# 將專案文件複製到容器中
COPY . /var/www/html

# 設置 PHP 配置
RUN echo "output_buffering = On" >> /usr/local/etc/php/conf.d/custom.ini

# 設置 Apache 的根目錄
WORKDIR /var/www/html

# 暴露端口
EXPOSE 80