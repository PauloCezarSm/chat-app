# Chat App

Este projeto é uma aplicação de chat em tempo real que utiliza **PHP**, **MySQL** e **Node.js** com **Socket.IO** para comunicação em tempo real.

## Estrutura do Projeto

```
docker-compose.yml
README.md
node/
    package.json
    server.js
php/
    auth.php
    db.php
    index.php
```

### Descrição dos Diretórios

- **node/**: Contém o servidor Node.js que gerencia a comunicação em tempo real via WebSocket.
- **php/**: Contém os arquivos PHP responsáveis pela autenticação, conexão com o banco de dados e interface do usuário.
- **docker-compose.yml**: Arquivo de configuração para orquestração dos serviços usando Docker.

## Tecnologias Utilizadas

- **Backend**:
  - PHP 8.1 com Apache
  - Node.js com Socket.IO
  - MySQL 5.7
- **Frontend**:
  - HTML, CSS e JavaScript
- **Containerização**:
  - Docker e Docker Compose

## Como Executar o Projeto

1. **Clone o repositório**:
   ```bash
   git clone https://github.com/username/chat-app.git
   cd chat-app
   ```

2. **Suba os containers com Docker Compose**:
   ```bash
   docker-compose up --build
   ```

3. **Acesse a aplicação**:
   - Interface PHP: [http://localhost:8080](http://localhost:8080)
   - Servidor Node.js: [http://localhost:3000](http://localhost:3000)

## Funcionalidades

- **Autenticação de Usuários**:
  - Login com validação de credenciais.
- **Chat em Tempo Real**:
  - Envio e recebimento de mensagens instantâneas.
- **Persistência de Dados**:
  - Mensagens e usuários armazenados em banco de dados MySQL.

## Configuração do Banco de Dados

1. Crie o banco de dados `chat_app` e as tabelas necessárias:
   ```sql
   CREATE TABLE users (
       id INT AUTO_INCREMENT PRIMARY KEY,
       username VARCHAR(50) NOT NULL,
       password VARCHAR(255) NOT NULL
   );

   CREATE TABLE messages (
       id INT AUTO_INCREMENT PRIMARY KEY,
       user_id INT NOT NULL,
       message TEXT NOT NULL,
       created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
       FOREIGN KEY (user_id) REFERENCES users(id)
   );
   ```

2. Configure as credenciais do banco de dados no arquivo `php/db.php`:
   ```php
   $host = 'localhost';
   $db = 'chat_app';
   $user = 'root';
   $pass = 'root';
   ```

## Contribuição

Contribuições são bem-vindas! Sinta-se à vontade para abrir issues ou enviar pull requests.

## Licença

Este projeto está licenciado sob a [MIT License](LICENSE).
