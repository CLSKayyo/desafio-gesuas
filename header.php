<?php

require './classes/database.php';

$db = new DBController();

if(isset($_POST['cad_nome'])){
    $nome = mb_strtoupper($_POST['cad_nome']);
    $nis = str_pad(rand(0, pow(10, 11)-1), 11, '0', STR_PAD_LEFT);

    $db->query(
        "INSERT INTO usuarios (nome, nis) VALUES (:nome, :nis)", 
        array(
            ':nome' => $nome,
            ':nis' => $nis
        )
    );
}

$where = '';

if(isset($_POST['search_nis'])){
    $nis = $_POST['search_nis'];

    $where = "`nis` LIKE '%$nis%'";
    
}

$users = $db->select('usuarios', $where);
