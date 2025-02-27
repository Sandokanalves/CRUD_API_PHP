# Documentação da API e do Front-end (Users CRUD)

## 1. Introdução
Esta documentação descreve a API RESTful desenvolvida em PHP para gerenciamento de usuários e sua integração com um front-end em PHP.

## 2. API (api.php)
A API permite realizar operações de CRUD (Adicionar, Ler, Atualizar e Deletar) em usuários.

### 2.1 Endpoints Disponíveis

#### 2.1.1 Adicionar Usuário (POST)
**URL:** `/api.php`

**Parâmetros:**
```json
{
  "nome": "João Silva",
  "endereco": "Rua Exemplo, 123",
  "telefone": "11987654321",
  "email": "joao@email.com",
  "data_nascimento": "1990-05-20"
}
```

**Resposta Sucesso (201):**
```json
{"message": "Usuário criado com sucesso"}
```

---

#### 2.1.2 Listar Usuários (GET)
**URL:** `/api.php`

**Resposta Sucesso (200):**
```json
[
  {
    "cod_pessoas": 1,
    "nome": "João Silva",
    "endereco": "Rua Exemplo, 123",
    "telefone": "11987654321",
    "email": "joao@email.com",
    "data_nascimento": "1990-05-20"
  }
]
```

---

#### 2.1.3 Atualizar Usuário (PUT)
**URL:** `/api.php?id=1`

**Parâmetros:**
```json
{
  "nome": "João Souza",
  "endereco": "Rua Nova, 456",
  "telefone": "11912345678",
  "email": "joaosouza@email.com",
  "data_nascimento": "1988-07-10"
}
```

**Resposta Sucesso (200):**
```json
{"message": "Usuário atualizado com sucesso"}
```

---

#### 2.1.4 Deletar Usuário (DELETE)
**URL:** `/api.php?id=1`

**Resposta Sucesso (200):**
```json
{"message": "Usuário deletado com sucesso"}
```

---

## 3. Front-end (api_frontend)
O front-end em PHP consome a API e exibe os dados de forma amigável.

### 3.1 Funcionalidades do Front-end
- **Listar Usuários:** Exibe todos os usuários cadastrados.
- **Adicionar Usuário:** Formulário para criar um novo usuário.
- **Editar Usuário:** Permite atualizar os dados de um usuário.
- **Excluir Usuário:** Deleta um usuário da base de dados.

### 3.2 Estrutura dos Arquivos
- `index.php` → Lista os usuários e possui os botões de editar/excluir.
- `adicionar.php` → Formulário para adicionar novo usuário.
- `editar.php` → Formulário para editar um usuário existente.
- `deletar.php` → Script para excluir um usuário via API.

### 3.3 Fluxo de Integração
1. O `index.php` faz uma requisição **GET** para `api.php` e exibe os dados.
2. O `adicionar.php` envia um **POST** para `api.php` ao adicionar um usuário.
3. O `editar.php` usa **PUT** para atualizar os dados.
4. O `deletar.php` chama o **DELETE** da API.

---

## 4. Conclusão
Este sistema fornece um CRUD completo usando PHP para API e front-end para demonstrar conhecimentos em desenvolvimento web e integração de APIs.

