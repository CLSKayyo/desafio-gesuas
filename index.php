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
            <input type="text" name="cad_nome" placeholder="Nome">
            <button type="submit">Cadastrar</button>
        </form>
        <?php if($create){ ?>
            <p class="success"><b>Usuário criado com sucesso!!</b> <br>
            Dados <br>
            -Nome: <?=$nome?> <br>
            -NIS: <?=$nis?>
            </p>
        <?php } ?>
    </div>

    <div class="card w-90 mt-40">
        <h2>Listagem de usuários</h2>

        <form method="post" class="search-form">
            <div></div>
            <input type="text" name="search_nis" placeholder="NIS" <?=($search)? "value='$nis'" : '' ?>>
            <button type="submit">Buscar/Resetar</button>
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
                        <td><?= $user->id ?></td>
                        <td><?= $user->nome ?></td>
                        <td><?= $user->nis ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <?php if ($search && count($users) == 0) { ?>
            <h3>Nenhum usuário encontrado com a pesquisa de NIS "<?= $nis ?>".</h3>
        <?php } ?>
    </div>
</body>

</html>