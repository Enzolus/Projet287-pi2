#!/bin/bash
set -e

SQL_FILES_DIR="/bdd"
MYSQL_USER="root"
MYSQL_PASSWORD="$MYSQL_ROOT_PASSWORD"
DATABASES_TO_GRANT=("BOUTON_SOS" "hearandknow")
SUBINA_USERNAME="subina"
SUBINA_PASSWORD="Boutonsos287*"

for sql_file in ${SQL_FILES_DIR}/*.sql; do
    DB_NAME=$(basename "$sql_file" .sql)  # Extrait le nom de la base de données du nom du fichier
    echo "Creating database $DB_NAME if not exists..."
    mysql -u $MYSQL_USER -p"$MYSQL_PASSWORD" -e "CREATE DATABASE IF NOT EXISTS \`$DB_NAME\`;"

    echo "Importing ${sql_file} into database $DB_NAME..."
    mysql -u $MYSQL_USER -p"$MYSQL_PASSWORD" "$DB_NAME" < "$sql_file"

    # Vérifier si la base de données actuelle doit être accessible par subina
    if printf '%s\n' "${DATABASES_TO_GRANT[@]}" | grep -q -P "^$DB_NAME$"; then
        echo "Granting user $SUBINA_USERNAME access to database $DB_NAME..."
        mysql -u $MYSQL_USER -p"$MYSQL_PASSWORD" -e "GRANT ALL PRIVILEGES ON \`${DB_NAME}\`.* TO '$SUBINA_USERNAME'@'%' IDENTIFIED BY '$SUBINA_PASSWORD'; FLUSH PRIVILEGES;"
    fi
done
