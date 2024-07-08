
# 🌐 Exemplo de CRUD com PHP com MVC

Este projeto é uma aplicação simples em PHP seguindo o padrão MVC (Model-View-Controller). Ele gerencia produtos e clientes em um sistema básico de vendas.

## 🔄 CRUD (Create, Read, Update, Delete)

🛠️ O projeto utiliza o conceito de CRUD para realizar operações básicas de gerenciamento de dados:

- **Create (Criar)**: Adição de novos registros como produtos no sistema.
- **Read (Ler)**: Visualização detalhada e listagem de produtos.
- **Update (Atualizar)**: Edição de informações de produtos existentes.
- **Delete (Excluir)**: Remoção de produtos do sistema.

## 🔍 Uso de Query String

As funcionalidades da aplicação são acessadas através de parâmetros na URL, conhecidos como query string:

Por exemplo, `?pagina=produtos&metodo=novo` direciona para a página de criação de novo produto.


## 🚀 Funcionalidades 

- **Produtos**
  - Listagem de produtos
  - Visualização detalhada de produtos
  - Adição, edição e exclusão de produtos

- **Clientes**
  - Gerenciamento básico de clientes (não detalhado neste exemplo)

## 🗃️ Banco de Dados

A aplicação utiliza um banco de dados MySQL para armazenar os produtos e clientes.



###  Estrutura do Banco de Dados

```sql
-- Criar banco de dados
CREATE DATABASE vendas;
USE vendas;

-- Tabela de Clientes
CREATE TABLE Clientes (
    id_cliente INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    telefone VARCHAR(20),
    endereco VARCHAR(150),
    cidade VARCHAR(50),
    uf VARCHAR(2)
);

-- Tabela de Produtos
CREATE TABLE Produtos (
    id_produto INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    descricao TEXT,
    preco DECIMAL(10, 2) NOT NULL
);
```

## ⚙️ Execução

Para executar a aplicação localmente, certifique-se de ter um servidor web configurado com suporte a PHP e um servidor MySQL para o banco de dados.

1. Clone este repositório.
2. Configure seu servidor web para apontar para o diretório raiz do projeto.
3. Importe a estrutura do banco de dados e ajuste as configurações de conexão em `app/Core/Connection.php`.
4. Acesse a aplicação pelo navegador.

## 🛠️ Dependências

Esta aplicação não possui dependências externas além do PHP e MySQL.



## 👨‍💻 Autor

 Este projeto foi desenvolvido por Francis Campos. Você pode encontrar mais sobre mim e meu trabalho nos seguintes perfis:

- [GitHub](https://github.com/franciscampos91)
- [LinkedIn](https://www.linkedin.com/in/franciscampos91/)

Fique à vontade para seguir e conectar!
