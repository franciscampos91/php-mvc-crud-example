<?php

    class HomeController
    {
        public function index()
        {
            try {

                $total_produtos = Produtos::totalProdutos();

                $total_clientes = Clientes::totalClientes();

                echo "<h5>Total de produtos:</h5>  $total_produtos";

                echo "<h5>Total de clientes:</h5> $total_clientes";


            } catch (Exception $ex) {
                echo $ex->getMessage();
            }
        }
    }