<?php
$api_url = "http://localhost/apiPhp/api.php/users";


$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $api_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Executa a requisição e captura a resposta
$response = curl_exec($ch);
curl_close($ch);

// Decodifica o JSON recebido
$users = json_decode($response, true);
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuários</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <h2>Lista de Usuários</h2>
    <a href="adicionar.php" class="btn btn-primary mb-3">Adicionar Novo Usuário</a>
    
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Telefone</th>
                <th>Email</th>
                <th>Data Criação</th>
            </tr>
        </thead>
        <tbody>
    <?php if (!empty($users)) : ?>
        <?php foreach ($users as $user) : ?>
            <tr>
                <td><?= $user['id'] ?></td>
                <td><?= $user['nome'] ?></td>
                <td><?= $user['telefone'] ?></td>
                <td><?= $user['email'] ?></td>
                <td><?= $user['criado_em'] ?></td>
                <td>
                    <a href="editar.php?id=<?= $user['id'] ?>" class="btn btn-warning btn-sm">Editar</a>
                    <a href="deletar.php?id=<?= $user['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</a>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else : ?>
        <tr>
            <td colspan="7">Nenhum usuário encontrado.</td>
        </tr>
    <?php endif; ?>
</tbody>

    </table>
</body>
</html>
