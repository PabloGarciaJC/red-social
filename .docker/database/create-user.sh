#!/bin/bash
set -e

# Comandos SQL para crear la base de datos y usuario, y conceder privilegios
mysql -u root -p"$MYSQL_ROOT_PASSWORD" <<-EOSQL
    CREATE DATABASE IF NOT EXISTS \`$MYSQL_DATABASE\`;
    CREATE USER IF NOT EXISTS '$MYSQL_USER'@'%' IDENTIFIED BY '$MYSQL_PASSWORD';
    GRANT ALL PRIVILEGES ON \`$MYSQL_DATABASE\`.* TO '$MYSQL_USER'@'%';
    FLUSH PRIVILEGES;
EOSQL
