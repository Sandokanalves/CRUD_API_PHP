<?php
// Conectar ao banco e pegar o ID
$pdo = new PDO("mysql:host=localhost;dbname=api_db", "root", "");
$id = $_GET['id'] ?? null;

// Buscar os dados do usuário
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Se o formulário foi enviado, atualizar os dados
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sql = "UPDATE users SET nome=?, telefone=?, email=?, criado_em=? WHERE id=?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $_POST["nome"], 
        $_POST["telefone"], 
        $_POST["email"], 
        $_POST["criado_em"], 
        $id
    ]);

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Editar Usuário</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <h2>Editar Usuário</h2>
    <form method="POST">
        <div class="mb-3">
            <label>Nome</label>
            <input type="text" name="nome" class="form-control" value="<?= $user['nome'] ?>" required>
        </div>
        <div class="mb-3">
            <label>Telefone</label>
            <input type="text" name="telefone" class="form-control" value="<?= $user['telefone'] ?>" required>
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="<?= $user['email'] ?>" required>
        </div>
        <button type="submit" class="btn btn-success">Atualizar</button>
        <a href="index.php" class="btn btn-secondary">Voltar</a>
    </form>
</body>
</html>
