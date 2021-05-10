<?php

// Classe que controla o banco de dados

class DBController {

    private $con;

    // Construct 
    // Busca os dados do banco do arquivo config.ini
    function __construct() {
        $config = parse_ini_file('config.ini', true);
        $host = $config['database']['host'];
        $db = $config['database']['db'];
        $user = $config['database']['user'];
        $pass = $config['database']['pass'];

        // Cria a conexão
        $this->con = new PDO("mysql:host=$host;dbname=$db", $user, $pass);

        // Define atributos para tratamento de exceções
        $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Configuração da tabela usuarios
        $stmt = $this->con->prepare(
            "CREATE TABLE IF NOT EXISTS `usuarios` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `nome` varchar(128) NOT NULL,
            `nis` varchar(11) NOT NULL,
            PRIMARY KEY (`id`),
            UNIQUE KEY `nis` (`nis`)
          ) ENGINE=MyISAM DEFAULT CHARSET=latin1;"
        );

        $stmt->execute();
    }

    // Funcao Select
    function select($table, $where = '', $columns = '*') {
        try{
            $sql = "SELECT $columns FROM $table";
    
            if ($where != '') {
                $sql .= " WHERE $where";
            }
    
            $rs = $this->con->query($sql);
    
            $result = array();
            while ($row = $rs->fetch(PDO::FETCH_OBJ)) {
                $result[] = $row;
            }
    
            return $result;
        } catch (PDOException $e) {
            echo 'Erro com o Banco: ' . $e->getMessage();
        }
    }

    // Função genérica de Query para SQL sem retorno de dados
    function query($query, $bind = null) {
        try {
            $stmt = $this->con->prepare($query);
            if ($bind) {
                $stmt->execute($bind);
            } else {
                $stmt->execute();
            }

            return $stmt->rowCount();
        } catch (PDOException $e) {
            echo 'Erro com o Banco: ' . $e->getMessage();
        }
    }
}
