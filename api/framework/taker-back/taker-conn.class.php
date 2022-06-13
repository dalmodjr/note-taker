<?php
    class Conn {
        private $conn;

        function __construct() {
            // Cria a conexão
            // Parâmetros deverão ser colocados no 'config.php' na raiz do projeto
            $this->conn = new PDO('mysql:host='.DBHOST.';dbname='.DBNAME, DBUSER, DBPASS);

            // Define o PDO para mostrar erros
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        function __destruct() {
            // Certifica de finalizar a conexão
            $this->conn = null;
        }

        function Query($sql, $params = array()) {
            try {
                // Cria a query
                $query = $this->conn->prepare($sql);

                // Coloca os parâmetros
                foreach ($params as $paramName => $paramValue) {
                    // Define o parâmetro
                    $query->bindParam($paramName, $paramValue, PDO::PARAM_STR);
                }

                // Executa a pesquisa
                $query->execute();

                // Obtém o resultado
                return $query->fetchALL(PDO::FETCH_ASSOC);
            } catch(Exception $e) {
                var_dump($e->getMessage());
            }
        }

        function Executar($sql, $params = array()) {
            // Cria a query
            $query = $this->conn->prepare($sql);

            // Executa a pesquisa
            $query->execute($params);
        }
    }
?>