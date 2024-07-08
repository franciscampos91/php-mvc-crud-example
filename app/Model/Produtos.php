<?php

// Definindo a classe Produtos
class Produtos
{

    // Método estático para listar produtos
    public static function listarProdutos()
    {
        try {
            // Obtém a conexão com o banco de dados utilizando o método estático getConn() da classe Connection
            $con = Connection::getConn();

            // Declara a consulta SQL para selecionar todos os produtos
            $sql = "SELECT * FROM produtos";

            // Prepara a consulta SQL
            $stmt = $con->prepare($sql);

            // Executa a consulta preparada
            $stmt->execute();

            // Inicializa um array para armazenar os resultados
            $resultado = array();

            // Itera sobre os resultados da consulta, convertendo cada linha em um objeto Produtos
            while ($row = $stmt->fetchObject('Produtos')) {
                // Adiciona cada objeto Produtos ao array de resultados
                $resultado[] = $row;
            }

            // Verifica se o array de resultados está vazio
            if (!$resultado) {
                // Lança uma exceção caso nenhum registro seja encontrado
                throw new Exception("Não foi encontrado nenhum registro");
            }

            // Retorna o array de resultados
            return $resultado;

        } catch (PDOException $e) {
            // Em caso de erro de banco de dados, lança uma exceção com a mensagem de erro
            throw new Exception('Erro ao listar produtos: ' . $e->getMessage());
        }
    }

    // Método estático para obter o total de produtos
    public static function totalProdutos()
    {
        try {
            // Obtém uma conexão com o banco de dados utilizando o método estático getConn() da classe Connection
            $con = Connection::getConn();

            // Query SQL para contar o número total de produtos
            $sql = "SELECT count(*) FROM produtos";

            // Prepara a consulta SQL
            $stmt = $con->prepare($sql);

            // Executa a consulta preparada
            $stmt->execute();

            // Obtém o total de produtos utilizando fetchColumn(), que retorna a primeira coluna do resultado da consulta
            $total = $stmt->fetchColumn();

            // Retorna o total de produtos
            return $total;

        } catch (PDOException $e) {
            // Em caso de erro de banco de dados, lança uma exceção com a mensagem de erro
            throw new Exception('Erro ao contar total de produtos: ' . $e->getMessage());
        }
    }

    // Método estático para visualizar um produto pelo ID
    public static function visualizarProduto($idProduto)
    {
        try {
            $con = Connection::getConn(); // Obtém a conexão com o banco de dados

            // Query SQL para selecionar o produto pelo ID
            $sql = "SELECT * FROM produtos WHERE id_produto = :id";

            // Prepara a consulta SQL
            $stmt = $con->prepare($sql);

            // Substitui o parâmetro :id pelo valor de $idProduto, garantindo que seja um inteiro
            $stmt->bindParam(':id', $idProduto, PDO::PARAM_INT);

            // Executa a consulta preparada
            $stmt->execute();

            // Obtém os dados do produto como um array associativo
            $produto = $stmt->fetch(PDO::FETCH_ASSOC);

            // Retorna os dados do produto
            return $produto;

        } catch (PDOException $e) {
            // Em caso de erro de banco de dados, lança uma exceção com a mensagem de erro
            throw new Exception('Erro ao visualizar produto: ' . $e->getMessage());
        }
    }

    // Método estático para salvar um novo produto
    public static function salvarNovoProduto($post)
    {
        try {
            $con = Connection::getConn(); // Obtém a conexão com o banco de dados

            // Dados do formulário recebidos via POST
            $nome = $post['nome'];
            $descricao = $post['descricao'];
            $preco = $post['preco'];

            // Consulta SQL para inserir um novo produto
            $sql = "INSERT INTO produtos (nome, descricao, preco) VALUES (:nome, :descricao, :preco)";
            $stmt = $con->prepare($sql);

            // Bind dos parâmetros
            $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
            $stmt->bindParam(':descricao', $descricao, PDO::PARAM_STR);
            $stmt->bindParam(':preco', $preco, PDO::PARAM_STR);

            // Executa a consulta
            $stmt->execute();

            // Verifica se a inserção foi bem-sucedida
            if ($stmt->rowCount() > 0) {
                return true; // Retorna verdadeiro se inseriu com sucesso
            } else {
                throw new Exception('Erro ao inserir novo produto');
            }

        } catch (PDOException $e) {
            // Em caso de erro de banco de dados, lança uma exceção com a mensagem de erro
            throw new Exception('Erro ao salvar novo produto: ' . $e->getMessage());
        }
    }

    // Método estático para excluir um produto pelo ID
    public static function excluirProduto($id)
    {
        try {
            $con = Connection::getConn(); // Obtém a conexão com o banco de dados

            // Consulta SQL para excluir o produto
            $sql = "DELETE FROM produtos WHERE id_produto = :id";
            $stmt = $con->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            // Verifica se a exclusão foi bem-sucedida
            if ($stmt->rowCount() > 0) {
                return true; // Retorna verdadeiro se excluiu com sucesso
            } else {
                throw new Exception('Produto não encontrado para exclusão');
            }

        } catch (PDOException $e) {
            // Em caso de erro de banco de dados, lança uma exceção com a mensagem de erro
            throw new Exception('Erro ao excluir produto: ' . $e->getMessage());
        }
    }

    // Método estático para editar um produto
    public static function editarProduto($post)
    {
        try {
            $con = Connection::getConn(); // Obtém a conexão com o banco de dados

            // Dados do formulário recebidos via POST
            $id = $post['id_produto'];
            $nome = $post['nome'];
            $descricao = $post['descricao'];
            $preco = $post['preco'];

            // Consulta SQL para obter os dados atuais do produto
            $sql = "SELECT nome, descricao, preco FROM produtos WHERE id_produto = :id";
            $stmt = $con->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $produtoAtual = $stmt->fetch(PDO::FETCH_ASSOC);

            // Verifica se o produto existe
            if (!$produtoAtual) {
                throw new Exception('Produto não encontrado para edição');
            }

            // Verifica se houve alteração nos dados
            if ($nome == $produtoAtual['nome'] && $descricao == $produtoAtual['descricao'] && $preco == $produtoAtual['preco']) {
                throw new Exception('Nenhuma alteração foi feita');
            }

            // Consulta SQL para atualizar o produto
            $sql = "UPDATE produtos SET nome = :nome, descricao = :descricao, preco = :preco WHERE id_produto = :id";
            $stmt = $con->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
            $stmt->bindParam(':descricao', $descricao, PDO::PARAM_STR);
            $stmt->bindParam(':preco', $preco, PDO::PARAM_STR);
            $stmt->execute();

            // Verifica se a atualização foi bem-sucedida
            if ($stmt->rowCount() > 0) {
                return true; // Retorna verdadeiro se atualizou com sucesso
            } else {
                throw new Exception('Erro ao editar produto');
            }

        } catch (PDOException $e) {
            // Em caso de erro de banco de dados, lança uma exceção com a mensagem de erro
            throw new Exception('Erro ao editar produto: ' . $e->getMessage());
        }
    }

}

?>
