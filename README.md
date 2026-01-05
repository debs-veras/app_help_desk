# App Help Desk

**Descrição**

App Help Desk é uma aplicação simples em PHP para gerenciamento de chamados (help desk), construída para fins didáticos. Ela usa sessão para autenticação e um arquivo local (`private/arquivo.hd`) para armazenar os chamados.

---

## ✅ Recursos principais

- Login com perfis (Administrativo / Usuário)
- Abrir chamado (formulário) — com feedback visual de sucesso/erro após cadastro
- Registrar chamado em arquivo local
- Consultar chamados já registrados
- Remover chamado (apenas administrador ou autor do chamado)
- Redirecionamento de acesso baseado em autenticação

---

## ⚙️ Requisitos

- PHP 7.4+ (PHP 8.x recomendado)
- Navegador moderno

---

## 🚀 Instalação e execução

1. Clone o repositório ou copie os arquivos para sua máquina:

```bash
git clone <repo-url> app_help_desk
cd app_help_desk
```

2. Inicie o servidor embutido do PHP a partir da raiz do projeto:

```bash
php -S localhost:8000
```

3. Abra no navegador:

```
http://localhost:8000/index.php
```

> Observação: o projeto espera a estrutura de pastas atual (páginas públicas em `public/`, lógica de validação em `private/`).

---

## 🧾 Usuários de teste

| Email              | Senha | Perfil                         |
| ------------------ | ----: | ------------------------------ |
| adm@teste.com.br   |  1234 | Administrativo (perfil_id = 1) |
| user@teste.com.br  |  1234 | Administrativo (perfil_id = 1) |
| jose@teste.com.br  |  1234 | Usuário (perfil_id = 2)        |
| maria@teste.com.br |  1234 | Usuário (perfil_id = 2)        |

> Os usuários estão definidos em `private/valida_login.php`.

---

## 📂 Estrutura de arquivos

- `index.php` - Formulário de login
- `img/` - Imagens do projeto
- `private/` - Lógica privada
  - `arquivo.hd` - Armazenamento dos chamados (arquivo plano)
  - `valida_login.php` - Verifica credenciais e inicia sessão
  - `validador_acesso.php` - Proteção de páginas (verifica sessão)
- `public/` - Páginas acessíveis após login
  - `abrir_chamado.php` - Formulário para abrir chamado
  - `registra_chamado.php` - Processa e grava o chamado em `arquivo.hd`
  - `consultar_chamado.php` - Lista chamados para consulta
  - `remover_chamado.php` - Remove um chamado (POST, admin ou autor)
  - `home.php` - Página inicial após login
  - `logoff.php` - Encerra a sessão
  - `valida_login.php` - Proxy para login público

---

## 🧭 Fluxo de uso

1. Acesse `index.php` e informe email + senha.
2. `private/valida_login.php` valida as credenciais e inicia a sessão.
3. Usuário autenticado é redirecionado para `public/home.php`.
4. Para abrir um chamado: `public/abrir_chamado.php` → envia para `public/registra_chamado.php` (após o envio a página exibe um feedback visual informando sucesso ou erro).
5. Os chamados são gravados em `private/arquivo.hd` e podem ser consultados em `public/consultar_chamado.php`.
6. Para remover um chamado: acesse `public/consultar_chamado.php` e clique em "Remover" — apenas administradores ou o autor do chamado podem executar a ação.

---

## ⚠️ Limitações e pontos de atenção (segurança)

- Senhas em texto plano no código — **não** use em produção.
- Armazenamento em arquivo simples (não transacional, sem concorrência) — migrate para DB se necessário.
- Sem proteção CSRF, sem validação robusta de input e sem hashing de senha.
- As rotas e validações são básicas; recomenda-se melhorar verificação de permissões e hardening.

---

## 💡 Sugestões de melhorias

- Usar banco de dados (MySQL / SQLite) em vez de arquivo plano
- Substituir senhas por `password_hash` / `password_verify`
- Implementar proteção CSRF nos formulários
- Validar e sanitizar entradas do usuário
- Adicionar testes automatizados e CI
- Dockerizar a aplicação para ambiente reproduzível
- Usar um framework leve (ex.: Slim, Laravel) para maior escalabilidade

---

## 🤝 Como contribuir

1. Fork do repositório
2. Crie branch feature/x
3. Faça commits pequenos e descritivos
4. Abra PR descrevendo mudança
