<?php

    class ClientesController
    {
        public function index()
        {

            try {

                $clientes = Clientes::listarClientes();
                
                $html = '<h1>Clientes</h1>
                        <table>
                            <tr>
                                <th>ID#</th>
                                <th>Nome</th>
                                <th>E-mail</th>
                                <th>Telefone</th>
                                <th>Endereço</th>
                                <th>Cidade</th>
                                <th>UF</th>
                            </tr>';
    
                foreach($clientes as $cliente) {
                    $html.= "<tr>
                                <td>$cliente->id_cliente</td>
                                <td>$cliente->nome</td>
                                <td>$cliente->email</td>
                                <td>$cliente->telefone</td>
                                <td>$cliente->endereco</td>
                                <td>$cliente->cidade</td>
                                <td>$cliente->uf</td>
                            </tr>";
                };
        
                $html.= '</table>';

                echo $html;


            } catch (Exception $ex) {
                echo $ex->getMessage();
            }
           
        }
    }