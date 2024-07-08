<?php

    class ProdutosController
    {

        public function index()
        {
            try {
                $produtos = Produtos::listarProdutos();

                echo "<h1>Produtos</h1>
                        <br>
                        <a href='?pagina=produtos&metodo=novo' class='btn'>Novo produto</a>
                        <br><br>
                        <table>
                            <tr>
                                <th>ID#</th>
                                <th>Produto</th>
                                <th>Descricão</th>
                                <th>Preço</th>
                                <th></th>
                            </tr>";
                foreach($produtos as $item) {
                    echo "  <tr>
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

                $idProduto = $_GET['id'];

                $produto = Produtos::visualizarProduto($idProduto);

                echo "<form action='?pagina=produtos&metodo=editar' method='POST'>
                    <p>ID: <input name='id_produto' value='" . $produto['id_produto'] . "' readonly></p>
                    <p>Nome: <input name='nome' value='" . $produto['nome'] . "'></p>
                    <p>Descrição: <textarea name='descricao' rows='4' required>" . $produto['descricao'] . "</textarea></p>
                    <p>Preço: <input name='preco' value='" . $produto['preco'] . "'></p>

                    <br>

                    <a href='?pagina=produtos' ><button class='btn'>Voltar</button></a>
                    <button class='btn' type='submit'>Salvar</button>
                    <a href='?pagina=produtos&metodo=excluir&id=".$produto['id_produto']."'><button class='btn' type='button'>Excluir</button></a>

                    </form>
                ";

            } catch (Exception $ex) {
                echo $ex->getMessage();
            }
        }


        public function novo()
        {           

            echo file_get_contents('app/View/produtos/novo.html');

        }

        public function salvarNovo()
        {
            try {

                Produtos::salvarNovoProduto($_POST);

                // Redirecionar para a página de listagem de produtos após salvar
                header('Location: ?pagina=produtos');
                exit;

            } catch (Exception $ex) {
                echo $ex->getMessage();
            }
        }


        public function excluir()
        {
            
            try {
                $id = $_GET['id'];
    
                Produtos::excluirProduto($id);
    
                echo '<script>alert("Produto excluído com sucesso."); location.href="?pagina=produtos"</script>';

            } catch (Exception $ex) {
                echo $ex->getMessage();
            }
        }


        public function editar()
        {
            try {

                Produtos::editarProduto($_POST);

                echo '<script>alert("Produto editado com sucesso."); location.href="?pagina=produtos"</script>';


            } catch (Exception $ex) {
                echo $ex->getMessage();
            }
        }

    }