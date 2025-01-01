# 使用官方的 PHP 映像
FROM php:8.1-apache

# 將專案文件複製到容器中
COPY . /var/www/html

# 安裝必要的 PHP 擴展
RUN docker-php-ext-install mysqli pdo pdo_mysql

# 設置 Apache 的根目錄
WORKDIR /var/www/html

# 暴露端口
EXPOSE 80
