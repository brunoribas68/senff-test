# Sistema de Gestão de Solicitações Internas

Este projeto é uma aplicação web para gerenciar solicitações internas de uma empresa, como pedidos de suprimentos e solicitações de TI. O sistema permite a criação, acompanhamento e gerenciamento das solicitações de maneira simples e organizada.

## Funcionalidades

1. **Criar Solicitações**:
    - Formulário para registrar uma nova solicitação com título, descrição, categoria e solicitante.
    - O status inicial da solicitação é "Aberto".

2. **Listar Solicitações**:
    - Tabela com todas as solicitações, incluindo filtros por status e categoria.

3. **Atualizar Status**:
    - Permite alterar o status de uma solicitação (ex.: de "Aberto" para "Em Progresso").

4. **Visualizar Detalhes**:
    - Exibe as informações completas de uma solicitação específica.

5. **Gerenciamento de Categorias e Status**:
    - Categorias e status são armazenados em tabelas separadas para facilitar a manutenção e escalabilidade.

## Tecnologias Utilizadas

- **Backend**: PHP 8.4 com o framework Laravel.
- **Frontend**: Bootstrap 5 para o design responsivo e moderno.
- **Banco de Dados**: MySQL, utilizando migrations para gerenciamento do esquema.
- **Docker**: Configuração com Docker Compose para ambiente de desenvolvimento isolado.
- **Testes**: PHPUnit para validação das principais funcionalidades.

## Pré-requisitos

- Docker e Docker Compose instalados.
- Composer instalado globalmente.
- Git configurado com autenticação SSH.

## Instalação e Configuração

1. **Clone o Repositório**:
   ```bash
   git clone git@github.com:brunoribas68/senff-test.git
   cd senff-test
   ```

2. **Configure o Ambiente**:
    - Copie o arquivo `.env.example` para `.env`:
      ```bash
      cp .env.example .env
      ```
    - Configure as variáveis de ambiente, incluindo banco de dados e autenticação.

3. **Suba os Contêineres com Docker**:
   ```bash
   docker-compose up --build
   ```

4. **Instale as Dependências**:
   ```bash
   docker exec -it laravel_app composer install
   docker exec -it laravel_app php artisan migrate --seed
   ```

5. **Acesse o Sistema**:
    - Abra o navegador e vá para `http://localhost:8000`.

## Testes

Para executar os testes, utilize o comando:

```bash
docker exec -it laravel_app ./vendor/bin/phpunit
```

## Estrutura do Banco de Dados

1. **Tabelas Principais**:
    - `requests`: Armazena as solicitações.
    - `categories`: Gerencia as categorias das solicitações.
    - `statuses`: Gerencia os status das solicitações.

2. **Relacionamentos**:
    - Uma solicitação pertence a uma categoria e a um status.
    - Categorias e status podem ter várias solicitações relacionadas.

## Contribuição

1. Faça um fork do projeto.
2. Crie uma branch para sua feature/bugfix:
   ```bash
   git checkout -b minha-feature
   ```
3. Commit suas alterações:
   ```bash
   git commit -m "Descrição das alterações"
   ```
4. Faça o push para sua branch:
   ```bash
   git push origin minha-feature
   ```
5. Abra um Pull Request no repositório original.

## Licença

Este projeto está licenciado sob a [MIT License](LICENSE).
