-- Garante que o usuário existe
SET @user = '${MYSQL_USER}';
SET @pass = '${MYSQL_PASSWORD}';
SET @db1 = '${MYSQL_DATABASE}';
SET @db2 = 'testing';

CREATE USER IF NOT EXISTS @user@'%' IDENTIFIED BY @pass;

-- Cria os bancos de dados
CREATE DATABASE IF NOT EXISTS @db1;
CREATE DATABASE IF NOT EXISTS @db2;

-- Concede todos os privilégios
GRANT ALL PRIVILEGES ON @db1.* TO @user@'%';
GRANT ALL PRIVILEGES ON @db2.* TO @user@'%';

-- Atualiza privilégios
FLUSH PRIVILEGES;
