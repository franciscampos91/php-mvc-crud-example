<?php

    class Clientes
    {


        public static function listarClientes()
        {

            $con = Connection::getConn();

            $sql = "SELECT * FROM clientes";
            $sql = $con->prepare($sql);
            $sql->execute();


            $clientes = array();

            while($row = $sql->fetchObject('Clientes')){
                $clientes[] = $row;
            };

            if(!$clientes) {
                throw new Exception("Não foi encontrado nenhum registro");
            }


            return $clientes;
        }


        public static function totalClientes()
        {

            $con = Connection::getConn();
            $sql = "SELECT count(*) FROM clientes";
            $sql = $con->prepare($sql);
            $sql->execute();

            $total = $sql->fetchColumn();

            return $total;
        }

        
    }