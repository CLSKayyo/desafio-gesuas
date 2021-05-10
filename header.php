<?php
require './classes/database.php';

// Declaração da classe
$db = new DBController();

// Variáveis de feedback do usuário
$create = false;
$search = false;
$nis = '';
$nome = '';

// Caso haja uma requisição de insert de usuário
if(isset($_POST['cad_nome'])){
    // Como normalmente os sistemas trabalham com nomes
    // em caixa alta, aqui transformamos o nome também pra
    // caixa alta
    $nome = mb_strtoupper($_POST['cad_nome']);

    // O NIS é gerado randomicamente e, caso nao tenha os 11 dígitos,
    // então são adicionados x 0 à esquerda do número
    $nis = str_pad(rand(0, pow(10, 11)-1), 11, '0', STR_PAD_LEFT);

    // Então é feita a query
    if($db->query(
        "INSERT INTO usuarios (nome, nis) VALUES (:nome, :nis)", 
        array(
            ':nome' => $nome,
            ':nis' => $nis
        )
    )){
        $create = true;
    }
}

$where = '';

// Caso haja uma requisição de pesquisa, então a variável where é preenchida
if(isset($_POST['search_nis'])){
    $nis = $_POST['search_nis'];
    $where = "`nis` LIKE '%$nis%'";

    $search = true;
}

// E o select é feito
$users = $db->select('usuarios', $where);
