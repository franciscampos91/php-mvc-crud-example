<?php

    // Definindo uma classe abstrata chamada Connection
    abstract class Connection
    {
        // Propriedade estática privada para armazenar a conexão com o banco de dados
        private static $conn;

        // Método estático público para obter a conexão com o banco de dados
        public static function getConn()
        {
            // Verifica se a conexão ainda não foi estabelecida
            if (self::$conn == null) {
                // Cria uma nova conexão PDO com o banco de dados MySQL
                self::$conn = new PDO('mysql: host=localhost; dbname=vendas;', 'root', '');

                // Configurar para UTF-8
                self::$conn->exec("SET NAMES 'utf8mb4'");
                self::$conn->exec("SET character_set_connection=utf8mb4");
                self::$conn->exec("SET character_set_client=utf8mb4");
                self::$conn->exec("SET character_set_results=utf8mb4");
            }

            // Retorna a conexão com o banco de dados
            return self::$conn;
        }
    }
?>
