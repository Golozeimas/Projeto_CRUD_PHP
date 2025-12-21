# 📋 Sistema CRUD de Clientes

Sistema completo de gerenciamento de clientes desenvolvido em PHP com MySQL, implementando as operações básicas de Create, Read, Update e Delete (CRUD).

## 🚀 Funcionalidades

- ✅ **Cadastro de Clientes**: Formulário completo para inserção de novos clientes
- 📖 **Listagem de Clientes**: Visualização de todos os clientes cadastrados em tabela
- ✏️ **Edição de Clientes**: Atualização de informações de clientes existentes
- 🗑️ **Exclusão de Clientes**: Remoção de clientes do banco de dados
- 🔄 **Validação de Dados**: Validação de email, telefone e data de nascimento
- 🎨 **Interface Responsiva**: Design responsivo utilizando Bootstrap 5

## 📁 Estrutura do Projeto

```
projeto/
│
├── cadastrar_clientes.php    # Formulário de cadastro de novos clientes
├── lista_de_clientes.php     # Listagem de todos os clientes
├── editar_cliente.php         # Formulário de edição de clientes
├── deletar_clientes.php       # Script para exclusão de clientes
├── conexao.php                # Configuração de conexão com banco de dados
└── crud_clientes.sql          # Script SQL para criar o banco de dados
```

## 🛠️ Tecnologias Utilizadas

- **PHP 8.0+**: Linguagem de programação backend
- **MySQL/MariaDB**: Sistema de gerenciamento de banco de dados
- **Bootstrap 5.0.2**: Framework CSS para interface responsiva
- **HTML5**: Estruturação das páginas
- **JavaScript**: Funcionalidades adicionais no frontend

## ⚙️ Requisitos do Sistema

- PHP 8.0 ou superior
- MySQL 5.7+ ou MariaDB 10.4+
- Servidor web (Apache, Nginx, etc.)
- Extensão MySQLi habilitada no PHP

## 📦 Instalação

### 1. Clone ou baixe o projeto

```bash
git clone [seu-repositorio]
cd [nome-do-projeto]
```

### 2. Configure o banco de dados

Importe o arquivo SQL para criar a estrutura do banco:

```bash
mysql -u root -p < crud_clientes.sql
```

Ou via phpMyAdmin:
1. Acesse o phpMyAdmin
2. Crie um novo banco chamado `crud_clientes`
3. Importe o arquivo `crud_clientes.sql`

### 3. Configure a conexão

Edite o arquivo `conexao.php` com suas credenciais:

```php
$user = "seu_usuario";
$password = "sua_senha";
$host = "127.0.0.1";
$db = "crud_clientes";
```

### 4. Inicie o servidor

```bash
php -S localhost:8000
```

Acesse: `http://localhost:8000/cadastrar_clientes.php`

## 🗄️ Estrutura do Banco de Dados

### Tabela: `clientes`

| Campo           | Tipo         | Descrição                          |
|----------------|--------------|-------------------------------------|
| id             | INT(11)      | Chave primária (auto increment)     |
| nome           | VARCHAR(50)  | Nome do cliente                     |
| email          | VARCHAR(50)  | E-mail único do cliente             |
| telefone       | VARCHAR(11)  | Telefone único (apenas números)     |
| data_nascimento| DATE         | Data de nascimento                  |
| data_cadastro  | DATETIME     | Data e hora do cadastro (automático)|

**Constraints:**
- `email`: UNIQUE (não permite duplicatas)
- `telefone`: UNIQUE (não permite duplicatas)

## 📝 Funcionalidades Detalhadas

### Cadastro de Clientes (`cadastrar_clientes.php`)

**Campos obrigatórios:**
- Nome
- E-mail
- Data de nascimento

**Campo opcional:**
- Telefone

**Validações implementadas:**
- ✅ Verificação de campos vazios
- ✅ Validação de formato de e-mail
- ✅ Validação de data de nascimento (formato DD/MM/AAAA)
- ✅ Validação de telefone (formato (XX) XXXXX-XXXX, 11 dígitos)
- ✅ Conversão automática de data para formato americano (YYYY-MM-DD)
- ✅ Limpeza de caracteres especiais do telefone

### Listagem de Clientes (`lista_de_clientes.php`)

**Recursos:**
- Exibição de todos os clientes em tabela
- Formatação automática de telefone: (XX) XXXXX-XXXX
- Formatação automática de data: DD/MM/AAAA
- Links para editar e deletar cada cliente
- Mensagem quando não há clientes cadastrados
- Botão para voltar ao cadastro

### Edição de Clientes (`editar_cliente.php`)

**Recursos:**
- Carregamento automático dos dados do cliente selecionado
- Mesmas validações do cadastro
- Campos pré-preenchidos
- Atualização em tempo real
- Redirecionamento automático após sucesso

### Exclusão de Clientes (`deletar_clientes.php`)

**Recursos:**
- Exclusão por ID via GET parameter
- Redirecionamento automático para lista após exclusão
- Delay de 3 segundos antes do redirecionamento

## 🔧 Funções Auxiliares

### `conexao.php`

**`formatar_data($data_nascimento)`**
- Converte data de formato americano (YYYY-MM-DD) para brasileiro (DD/MM/AAAA)

**`formatar_telefone($telefone)`**
- Formata telefone de 11 dígitos para (XX) XXXXX-XXXX

### Funções nos arquivos principais

**`limparTelefone($str)`**
- Remove todos os caracteres não numéricos do telefone

## 🎨 Interface do Usuário

### Design
- Interface centralizada e responsiva
- Utilização de Bootstrap 5 para estilização
- Alertas de sucesso (verde) e erro (vermelho)
- Tabela striped para melhor visualização
- Botões com cores semânticas

### Experiência do Usuário
- Feedback visual imediato (alertas)
- Campos mantidos após erro de validação
- Redirecionamento automático após operações bem-sucedidas
- Placeholders informativos nos campos

## ⚠️ Mensagens de Erro

O sistema fornece mensagens claras para:
- Campos obrigatórios vazios
- E-mail inválido
- Formato de data incorreto
- Formato de telefone incorreto
- Falhas na conexão com banco de dados
- Erros ao inserir/atualizar dados

## 🔒 Segurança

**⚠️ IMPORTANTE - Vulnerabilidades Conhecidas:**

Este projeto é educacional e contém vulnerabilidades de segurança que **NÃO devem ser usadas em produção**:

1. **SQL Injection**: As queries não utilizam prepared statements
2. **XSS**: Dados não são sanitizados antes da exibição
3. **Credenciais expostas**: Senhas em texto plano no código
4. **Sem autenticação**: Sistema aberto sem controle de acesso

**Recomendações para produção:**
- Utilizar PDO ou MySQLi com prepared statements
- Implementar htmlspecialchars() para output
- Usar variáveis de ambiente para credenciais
- Implementar sistema de login e sessões
- Adicionar CSRF tokens nos formulários
- Validar e sanitizar todos os inputs no servidor

## 🚦 Fluxo de Operações

### Cadastro
1. Usuário preenche o formulário
2. Sistema valida os dados
3. Se válido: insere no banco e redireciona para lista
4. Se inválido: exibe erro e mantém dados preenchidos

### Edição
1. Usuário clica em "Editar" na lista
2. Sistema carrega dados do cliente via ID (GET)
3. Formulário é preenchido automaticamente
4. Usuário modifica e envia
5. Sistema valida e atualiza no banco
6. Redireciona para lista após sucesso

### Exclusão
1. Usuário clica em "Deletar" na lista
2. Sistema executa DELETE via ID (GET)
3. Redireciona automaticamente para lista

## 📊 Exemplos de Uso

### Formato de Dados

**Data de Nascimento:**
```
✅ Correto: 21/10/2005
❌ Errado: 2005-10-21, 21-10-2005
```

**Telefone:**
```
✅ Aceito: (85) 98765-4321 ou 85987654321
❌ Resultado: 85987654321 (armazenado apenas números)
```

**E-mail:**
```
✅ Válido: usuario@exemplo.com
❌ Inválido: usuario@exemplo, usuario.exemplo.com
```

## 🐛 Solução de Problemas

### Erro de conexão com banco de dados
- Verifique as credenciais em `conexao.php`
- Confirme que o MySQL está rodando
- Verifique se o banco `crud_clientes` existe

### Tabela não encontrada
- Importe o arquivo `crud_clientes.sql`
- Verifique o nome do banco de dados

### Erro ao cadastrar/editar
- Verifique se todos os campos obrigatórios estão preenchidos
- Confira o formato dos dados
- Verifique se email/telefone já não estão cadastrados (UNIQUE constraint)


## 👨‍💻 Autor

Desenvolvido como projeto educacional de CRUD em PHP.

## 📄 Licença

Este projeto é de código aberto e está disponível para fins educacionais.

---

**Nota:** Este é um projeto educacional. Para uso em produção, implemente as medidas de segurança recomendadas.
