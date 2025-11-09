# Sefaz é Massa

Sistema web institucional da **Secretaria da Fazenda de Alagoas (SEFAZ)**, desenvolvido como desafio acadêmico/projeto de aprendizado. O sistema centraliza notícias e programas fiscais, com controle de acesso diferenciado entre usuários comuns e administradores.

---

## Tecnologias Utilizadas

-   Backend: **Laravel (PHP)**
-   Frontend: **Vue.js**
-   Estilização: **Tailwind CSS**
-   Banco de dados: **SQLite**

---

## Público-Alvo

Empreendedores e cidadãos que desejam acompanhar notícias e programas fiscais de Alagoas de forma prática e confiável.

---

## Funcionalidades do Sistema

### Sistema de Usuários

-   Usuários podem se cadastrar e fazer login para acessar conteúdos exclusivos.
-   O sistema diferencia **usuários comuns** de **administradores**.

### Administradores

-   Criar, editar e excluir **programas** e **notícias**.
-   Transformar outros usuários em administradores.
-   Funcionalidades administrativas aparecem apenas para administradores.
-   Usuários comuns não têm acesso a funções administrativas.

### Gestão de Programas

-   Administradores podem criar, editar e excluir programas.
-   Cada programa contém:
    -   Nome
    -   Descrição
    -   Categoria
    -   Link oficial

### Gestão de Notícias

-   Administradores podem criar, editar e excluir notícias.
-   Cada notícia contém:
    -   Título
    -   Conteúdo
    -   Categoria
    -   Data de publicação

### Visualização para Usuários Comuns

-   Podem visualizar notícias e programas, mas **não podem alterá-los**.
-   Interface centralizada e responsiva usando Tailwind CSS.
-   Administradores veem botões de ação para CRUD; usuários comuns não.

---

## Autenticação e Segurança

-   Login obrigatório para acessar notícias e programas.
-   Apenas administradores podem acessar rotas de CRUD.
-   O sistema bloqueia usuários comuns de acessar ações administrativas via URL.

---

## Acesso Inicial de Administrador

-   Email: **admin@sefazemassa.com.br**
-   Senha: **12341234**

---

## Como Rodar o Projeto

### Pré-requisitos

-   Docker e Docker Compose instalados
-   Git (para clonar o repositório)

### Instalação e Execução

1. **Clonar o repositório:**

```bash
git clone https://github.com/seu-usuario/sefaz-e-massa.git
cd sefaz-e-massa
```

2. **Construir e iniciar os containers:**

```bash
docker-compose up --build
```


1. **Acessar a aplicação:**

-   Frontend: http://localhost:8000
-   Vite Dev Server: http://localhost:5173

### Comandos Úteis

**Parar os containers:**

```bash
docker-compose down
```

### Estrutura do Projeto

-   **Backend (Laravel)**: Rodando na porta 8000
-   **Frontend (Vite/Vue)**: Rodando na porta 5173
-   **Banco de dados**: SQLite (`database/database.sqlite`)

