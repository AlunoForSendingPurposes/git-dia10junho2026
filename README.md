# 🚀 Slim 4 API REST - To-Do List com SQLite & HTML Puro

Uma API RESTful compacta e extremamente organizada para gerenciamento de tarefas, construída com **PHP 8.3** e **Slim Framework 4**. O projeto adota uma arquitetura limpa utilizando os padrões **Model**, **DAO (Data Access Object)** e **Controller**, além de contar com uma interface web funcional em HTML puro totalmente desacoplada.

## 🎯 Objetivos do Projeto
* Demonstrar a implementação de um CRUD completo com os métodos HTTP: GET, POST, PUT e DELETE.
* Apresentar uma separação clara de responsabilidades (Camada de Banco, Regras de Negócio e Controladores).
* Utilizar o banco de dados SQLite pela sua praticidade (sem necessidade de configurar servidores de banco locais).

---

## 🛠️ Tecnologias e Recursos

* **PHP 8.3** (Tipagem forte e recursos modernos)
* **Slim Framework 4** (Micro-framework rápido e flexível)
* **SQLite** (Banco de dados em arquivo, leve e auto-contido)
* **Fetch API (JavaScript)** (Para consumo assíncrono da API no Frontend)
* **Autoloading PSR-4** (Gerenciado via Composer)

---

## 📁 Estrutura do Projeto

A arquitetura foi desenhada para manter o código escalável e fácil de manter:

* src/
  * Models/
    * Tarefa.php (Entidade/Modelo da regra de negócio)
  * DAO/
    * TarefaDAO.php (Isolamento de queries SQL via PDO)
  * Controllers/
    * TarefaController.php (Validação e resposta das rotas em JSON)
* public/
  * index.html (Interface do usuário em HTML Puro)
  * index.php (Ponto de entrada do Slim Framework)
* .gitignore (Proteção de dependências e banco local)
* composer.json (Gerenciador de pacotes e Autoload)

---

## 🏁 Rotas da API (Endpoints)

* **GET /api/tarefas** -> Lista todas as tarefas cadastradas
* **POST /api/tarefas** -> Cria uma nova tarefa
* **PUT /api/tarefas/{id}** -> Atualiza o status de conclusão da tarefa
* **DELETE /api/tarefas/{id}** -> Remove uma tarefa permanentemente
* **GET /** -> Entrega a interface web estática (index.html)

---

## ⚙️ Como Executar o Projeto Localmente

Se você clonar este repositório no futuro, siga estes passos simples:

1. Instale as dependências do PHP:
   composer install

2. Inicie o servidor embutido do PHP apontando para a pasta pública:
   php -S localhost:8000 -t public

3. Acesse no seu navegador:
   Abra http://localhost:8000 e o banco de dados SQLite será criado automaticamente na primeira requisição!

---

## 📝 Licença
Este projeto está sob a licença MIT. Sinta-se livre para usar, modificar e distribuir.