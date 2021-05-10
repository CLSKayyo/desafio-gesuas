<?php

class DBController {

    private $con;

    function __construct() {
        $config = parse_ini_file('config.ini', true);
        $host = $config['database']['host'];
        $db = $config['database']['db'];
        $user = $config['database']['user'];
        $pass = $config['database']['pass'];
        $this->con = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
        $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $this->con->prepare(
            "CREATE TABLE IF NOT EXISTS `usuarios` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `nome` varchar(128) NOT NULL,
            `nis` varchar(11) NOT NULL,
            PRIMARY KEY (`id`)
          ) ENGINE=MyISAM DEFAULT CHARSET=latin1;"
        );

        $stmt->execute();
    }

    function select($table, $where = '', $columns = '*') {
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
    }

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
            echo 'Error: ' . $e->getMessage();
        }
    }
}
