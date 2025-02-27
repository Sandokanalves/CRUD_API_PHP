<?php
$pdo = new PDO("mysql:host=localhost;dbname=api_db", "root", "");

// Pegando o ID da URL
$id = $_GET['id'] ?? null;

if ($id) {
    $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
    $stmt->execute([$id]);
}

// Redireciona para a lista
header("Location: index.php");
exit;
