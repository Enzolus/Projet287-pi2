# Utiliser l'image officielle PHP avec Apache, version 7.4 par exemple
FROM php:7.4-apache

# Installer pdo_mysql pour PHP
RUN docker-php-ext-install pdo_mysql

# Copier les fichiers du site dans le conteneur, dans le répertoire de travail d'Apache
COPY site/* /var/www/html/

# Créer un utilisateur 'appuser' et utiliser ce compte pour exécuter Apache
# (Changez 'appuser' si vous souhaitez un autre nom d'utilisateur)
RUN useradd -r -u 1001 -g www-data appuser
USER appuser

# Ajouter une instruction HEALTHCHECK pour vérifier que Apache répond
# Ajustez '/index.php' si votre application utilise une autre page d'accueil
HEALTHCHECK --interval=30s --timeout=30s --start-period=5s --retries=3 \
  CMD curl --fail http://localhost/index.php || exit 1

# Le conteneur démarrera avec Apache en arrière-plan
CMD ["apache2-foreground"]
