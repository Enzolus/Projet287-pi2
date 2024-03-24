FROM php:7.4-apache

# Installer pdo_mysql pour PHP
RUN docker-php-ext-install pdo_mysql

COPY site/* /var/www/html/

RUN useradd -r -u 1001 -g www-data appuser
USER appuser


HEALTHCHECK --interval=30s --timeout=30s --start-period=5s --retries=3 \
  CMD curl --fail http://localhost || exit 1


CMD ["apache2-foreground"]
