FROM mysql:8.0

# Configurações básicas para evitar warnings
RUN echo "[mysqld]\nhost_cache_size=0\npid_file=/var/lib/mysql/mysqld.pid" > /etc/mysql/conf.d/custom.cnf

# Copia os scripts de inicialização
COPY ./docker/db/scripts /docker-entrypoint-initdb.d/
RUN chmod -R 755 /docker-entrypoint-initdb.d/

# Mantém o entrypoint padrão do MySQL
