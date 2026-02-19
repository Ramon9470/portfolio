# 🚀 Meu Portfólio Full Stack

![Angular](https://img.shields.io/badge/Angular-DD0031?style=for-the-badge&logo=angular&logoColor=white)
![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PostgreSQL](https://img.shields.io/badge/PostgreSQL-316192?style=for-the-badge&logo=postgresql&logoColor=white)
![TypeScript](https://img.shields.io/badge/TypeScript-007ACC?style=for-the-badge&logo=typescript&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)

Um portfólio web dinâmico e responsivo construído do zero, apresentando meus projetos, experiências e habilidades. O diferencial deste projeto é a integração de um **Painel Administrativo (CMS próprio)**, permitindo o gerenciamento total do conteúdo sem a necessidade de alterar o código-fonte.

## ✨ Principais Funcionalidades

* **🎨 Interface Moderna e Responsiva:** Layout elegante construído no frontend, com modo "Glassmorphism" (efeito de vidro) e modais dinâmicos.
* **🔐 Painel Administrativo Seguro:** Área restrita protegida por autenticação (Laravel Sanctum) para gerenciar dados pessoais, projetos, cursos e experiências.
* **📄 Gerador Dinâmico de Currículo (PDF):** Integração com DomPDF no backend para gerar um currículo profissional em PDF na hora, com os dados mais recentes do banco de dados.
* **🖼️ Upload de Imagens:** Sistema de upload integrado para fotos de perfil, capas de projetos e certificados, salvos diretamente no backend.
* **📱 Mobile First:** Navegação otimizada para qualquer tamanho de tela (celulares, tablets e desktops).

## 🛠️ Tecnologias Utilizadas

### Frontend
* **Angular** (TypeScript, HTML, CSS)
* Consumo de APIs RESTful utilizando `HttpClient`
* Gerenciamento de estado e formulários dinâmicos
* Componentização e Modais customizados

### Backend
* **Laravel** (PHP)
* Banco de Dados: **PostgreSQL**
* Autenticação via **Laravel Sanctum**
* **DomPDF** para geração de relatórios e currículos
* Armazenamento de Arquivos (`Storage`)

## ⚙️ Como executar o projeto localmente

### 1. Clonar o repositório
```bash
git clone [https://github.com/Ramon9470/portfolio.git](https://github.com/Ramon9470/portfolio.git)

### 2. Configurar o Backend Laravel
Bash

cd backend
composer install

# Configurar banco de dados PostgreSQL ou outro gerenciador de banco de dados de preferencia no arquivo .env

cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan storage:link
php artisan serve --port=8081

### 3. Configurar o Frontend Angular
Bash

cd frontend
npm install
ng serve

Acesse o frontend em http://localhost:4200

=============================================================================================================================

👨‍💻 Autor

Ramon Ferreira

Desenvolvedor Full Stack

LinkedIn (Chttps://www.linkedin.com/in/ramon-ferreira-4a70723aa)

GitHub

⭐️ Se este projeto te inspirou, não esqueça de deixar uma estrela no repositório!