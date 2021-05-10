<?php
require 'header.php';
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Desafio</title>

    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1 class="text-center">Cadastro e listagem de usuários</h1>

    <div class="card w-60">
        <h2 class="text-center">Cadastrar novo usuário</h2>
        <form method="post" class="cad-form">
            <input type="text" name="cad_nome">
            <button type="submit">Cadastrar</button>
        </form>
    </div>

    <div class="card w-90 mt-40">
        <h2>Listagem de usuários</h2>

        <form method="post" class="search-form">
            <div></div>
            <input type="text" name="search_nis" placeholder="NIS">
            <button type="submit">Buscar</button>
        </form>

        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nome</th>
                    <th>NIS</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user) { ?>
                    <tr>
                        <td><?=$user->id?></td>
                        <td><?=$user->nome?></td>
                        <td><?=$user->nis?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>

</html>