# Gunakan image PHP dengan Apache
FROM php:8.3-apache

# Salin semua file aplikasi ke container
COPY . /var/www/html

# Tambahkan ServerName untuk mengatasi peringatan
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Instal ekstensi PHP jika diperlukan
RUN docker-php-ext-install mysqli

# Atur izin direktori untuk Apache
RUN chown -R www-data:www-data /var/www/html

# Expose port 80 untuk aplikasi
EXPOSE 80
