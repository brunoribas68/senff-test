#!/bin/bash
set -e

# Inicia o MySQL temporário para configuração
docker-entrypoint.sh mysqld --skip-grant-tables --skip-networking &
pid="$!"

# Espera inicialização
for i in {30..0}; do
    if echo 'SELECT 1' | mysql -uroot &> /dev/null; then
        break
    fi
    sleep 1
done

# Executa comandos SQL
mysql -uroot <<-EOSQL
    CREATE DATABASE IF NOT EXISTS testing;
    CREATE USER IF NOT EXISTS '${MYSQL_USER}'@'%' IDENTIFIED BY '${MYSQL_PASSWORD}';
    GRANT ALL ON testing.* TO '${MYSQL_USER}'@'%';
    FLUSH PRIVILEGES;
EOSQL

# Reinicia o MySQL normalmente
kill -s TERM "$pid"
wait "$pid"
exec docker-entrypoint.sh mysqld
