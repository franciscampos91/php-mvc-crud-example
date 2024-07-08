<?php

class ProdutosController
{
    public function index()
    {
        try {
            // Obtém a lista de produtos utilizando o método estático listarProdutos da classe Produtos
            $produtos = Produtos::listarProdutos();

            // Exibe uma tabela com os produtos listados
            echo "<h1>Produtos</h1>
                <br>
                <a href='?pagina=produtos&metodo=novo' class='btn'>Novo produto</a>
                <br><br>
                <table>
                    <tr>
                        <th>ID#</th>
                        <th>Produto</th>
                        <th>Descrição</th>
                        <th>Preço</th>
                        <th></th>
                    </tr>";
            
            // Itera sobre cada produto e exibe-o na tabela
            foreach($produtos as $item) {
                echo "<tr>
                        <td>$item->id_produto</td>
                        <td>$item->nome</td>
                        <td>$item->descricao</td>
                        <td style='text-align: right;'>R$ ". str_replace(".", ",", $item->preco)  . "</td>
                        <td>
                            <a href='?pagina=produtos&metodo=visualizarProduto&id=$item->id_produto' class='btn'>Visualizar</a>
                        </td>
                    </tr>";
            }
            echo "</table>";

        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public function visualizarProduto()
    {
        try {
            // Obtém o ID do produto a ser visualizado a partir dos parâmetros GET
            $idProduto = $_GET['id'];

            // Obtém os detalhes do produto utilizando o método estático visualizarProduto da classe Produtos
            $produto = Produtos::visualizarProduto($idProduto);

            // Exibe um formulário para visualização e edição do produto
            echo "<form action='?pagina=produtos&metodo=editar' method='POST'>
                    <p>ID: <input name='id_produto' value='" . $produto['id_produto'] . "' readonly></p>
                    <p>Nome: <input name='nome' value='" . $produto['nome'] . "'></p>
                    <p>Descrição: <textarea name='descricao' rows='4' required>" . $produto['descricao'] . "</textarea></p>
                    <p>Preço: <input name='preco' value='" . $produto['preco'] . "'></p>

                    <br>

                    <a href='?pagina=produtos' ><button class='btn'>Voltar</button></a>
                    <button class='btn' type='submit'>Salvar</button>
                    <a href='?pagina=produtos&metodo=excluir&id=".$produto['id_produto']."'><button class='btn' type='button'>Excluir</button></a>

                </form>";

        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public function novo()
    {
        // Exibe o formulário HTML para criar um novo produto
        echo file_get_contents('app/View/produtos/novo.html');
    }

    public function salvarNovo()
    {
        try {
            // Chama o método estático salvarNovoProduto da classe Produtos para salvar um novo produto com base nos dados recebidos via POST
            Produtos::salvarNovoProduto($_POST);

            // Redireciona para a página de listagem de produtos após salvar o novo produto
            header('Location: ?pagina=produtos');
            exit;

        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public function excluir()
    {
        try {
            // Obtém o ID do produto a ser excluído a partir dos parâmetros GET
            $id = $_GET['id'];

            // Chama o método estático excluirProduto da classe Produtos para excluir o produto
            Produtos::excluirProduto($id);

            // Exibe uma mensagem de alerta em JavaScript após excluir o produto e redireciona para a página de listagem de produtos
            echo '<script>alert("Produto excluído com sucesso."); location.href="?pagina=produtos"</script>';

        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public function editar()
    {
        try {
            // Chama o método estático editarProduto da classe Produtos para atualizar os dados do produto com base nos dados recebidos via POST
            Produtos::editarProduto($_POST);

            // Exibe uma mensagem de alerta em JavaScript após editar o produto e redireciona para a página de listagem de produtos
            echo '<script>alert("Produto editado com sucesso."); location.href="?pagina=produtos"</script>';

        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }
}

?>
