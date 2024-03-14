# Définissez l'image de base MariaDB
FROM mariadb:10.6

# Utilisez ARG pour les valeurs qui ne doivent pas rester dans l'image finale
ARG MYSQL_USER
ARG MYSQL_PASSWORD
ARG MYSQL_ROOT_PASSWORD
ARG MYSQL_DATABASE

# Définir les variables d'environnement pour la configuration à partir des ARGs
ENV MYSQL_USER=$MYSQL_USER \
    MYSQL_PASSWORD=$MYSQL_PASSWORD \
    MYSQL_ROOT_PASSWORD=$MYSQL_ROOT_PASSWORD \
    MYSQL_DATABASE=$MYSQL_DATABASE

# Copier les fichiers SQL et les scripts d'importation dans l'image
COPY bdd/ /bdd/
COPY docker-entrypoint-initdb.d/ /docker-entrypoint-initdb.d/

# Assurer que le script est exécutable
RUN chmod +x /docker-entrypoint-initdb.d/*.sh

# Bonnes pratiques de sécurité
HEALTHCHECK --interval=30s --timeout=30s --start-period=5s --retries=3 \
  CMD mysqladmin ping -h localhost || exit 1

# Utiliser l'utilisateur non root fourni par l'image MariaDB
USER mysql
