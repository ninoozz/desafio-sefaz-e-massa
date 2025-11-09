# Sistema de Usuários

- O sistema deve permitir que usuários se cadastrem para acessar o conteúdo.
- Usuários devem fazer login para visualizar notícias e programas.
- O sistema deve diferenciar usuários comuns e administradores.

Eu preciso incentivar as pessoas a se registrarem, tem que ter um motivo.

# Administradores podem:

- Criar, editar e excluir programas.
- Criar, editar e excluir notícias.
- Transformar outros usuários em administradores.
- Usuários comuns não terão acesso às funções administrativas.
- O sistema deve exibir opções administrativas somente para usuários com perfil de admin.

# Gestão de Programas

- O sistema deve permitir que administradores criem novos programas.
- Administradores devem poder editar programas existentes.
- Administradores devem poder excluir programas.

# Cada programa deve conter os seguintes campos:
- Nome
- Descrição
- Categoria
- Link oficial

# Gestão de Notícias
- Administradores devem poder criar, editar e excluir notícias.

## Cada notícia deve ter:

- Título
- Conteúdo
- Categoria
- Data de publicação

# Usuários comuns podem visualizar notícias, mas não alterá-las.

- Interface e Navegação
- O sistema deve centralizar notícias e programas em uma tela principal.

## Usuários devem visualizar:
- Lista de programas/noticias
- Administradores terão botões de ação visíveis para criar, editar ou excluir registros.
- Interface responsiva usando Tailwind CSS (já que o front será em Vue).

# Autenticação e Segurança

- Sistema deve exigir login para acessar programas e notícias.

- Apenas administradores podem acessar rotas de CRUD.

- O sistema deve impedir que usuários comuns acessem ações de administrador via URL.

# Requisitos Não Funcionais

## Tecnologias:

- Backend: Laravel

- Frontend: Vue.js

- Estilização: Tailwind CSS

- Banco de dados: SQLite 


#### Publico alvo
- empreededores que querem estar por dentro das noticias fiscais