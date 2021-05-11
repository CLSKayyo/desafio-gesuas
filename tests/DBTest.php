<?php

/*
-
- Classe de testes para a classe DBController
- Para que os testes de exceção possam ser executados,
- é preciso remover o tratamento de exceção na classe DBController
-
- O objetivo dos testes é ter certeza que
- possíveis resultados indesejados resultem em uma
- exceção e não uma inclusão incorreta no banco.
- 
*/

require __DIR__ . '/../classes/database.php';

class DBTest extends PHPUnit\Framework\TestCase {

    // Testes para garantir que um insert incorreto gera uma exceção
    // e não insere no banco de forma incorreta

    // Testa Exceção se incluido apenas o nome
    public function testExcecaoBancoInsertNome() {

        $db = new DBController();
        $this->expectException(PDOException::class);

        $db->query(
            "INSERT INTO usuarios (nome) VALUES (:nome)",
            array(
                ':nome' => 'João'
            )
        );
    }

    // Testa exceção se incluído apenas o NIS
    public function testExcecaoBancoInsertNIS() {

        $db = new DBController();
        $this->expectException(PDOException::class);

        $db->query(
            "INSERT INTO usuarios (nis) VALUES (:nis)",
            array(
                ':nis' => '12345678568'
            )
        );
    }

    // Testa exceção se incluido duplicata de NIS
    public function testExcecaoBancoInsertDuplicataNIS() {

        $db = new DBController();
        $this->expectException(PDOException::class);

        // A query é executada duas vezes para ter certeza que
        // haja um NIS igual ao que será incluído
        
        $db->query(
            "INSERT INTO usuarios (nome, nis) VALUES (:nome, :nis)",
            array(
                ':nome' => 'JOAO',
                ':nis' => '12345678900'
            )
        );

        $db->query(
            "INSERT INTO usuarios (nome, nis) VALUES (:nome, :nis)",
            array(
                ':nome' => 'JOAO',
                ':nis' => '12345678900'
            )
        );
    }
}
