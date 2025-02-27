<?php
header("Content-Type: application/json");
include "conexao.php";

$method = $_SERVER["REQUEST_METHOD"];

// Obtendo o endpoint da URL
$request = explode("/", trim($_SERVER["PATH_INFO"], "/"));

// Verificando a rota (exemplo: /users ou /users/1)
$resource = $request[0] ?? null;
$id = $request[1] ?? null;

if ($resource === "users") {
    switch ($method) {
        case "GET":
            getUsers($pdo, $id);
            break;
        case "POST":
            createUser($pdo);
            break;
        case "PUT":
            updateUser($pdo, $id);
            break;
        case "DELETE":
            deleteUser($pdo, $id);
            break;
        default:
            http_response_code(405);
            echo json_encode(["erro" => "Método não permitido"]);
    }
} else {
    http_response_code(404);
    echo json_encode(["erro" => "Endpoint não encontrado"]);
}


function getUsers ($pdo, $id = null)
{

    if($id){
        $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        $user = $stmt->fetch(PDO:: FETCH_ASSOC);
        echo json_encode($user ?: ["erro" => "Usuário não encontrado"]);
    }else{
        $stmt = $pdo->query("SELECT * FROM users");
        echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));

    }
}
function createUser($pdo) {
    $data = json_decode(file_get_contents("php://input"), true);
    
    if (!isset($data["nome"]) || !isset($data["email"])) {
        http_response_code(400);
        echo json_encode(["erro" => "Nome e email são obrigatórios"]);
        return;
    }

    try {
        $stmt = $pdo->prepare("INSERT INTO users (nome, email, telefone) VALUES (?, ?, ?)");
        $stmt->execute([$data["nome"], $data["email"], $data["telefone"] ?? null]);
        echo json_encode(["mensagem" => "Usuário criado com sucesso"]);
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(["erro" => $e->getMessage()]);
    }
}
function updateUser($pdo, $id) {
    $data = json_decode(file_get_contents("php://input"), true);
    
    if (!$id || !isset($data["nome"]) || !isset($data["email"])) {
        http_response_code(400);
        echo json_encode(["erro" => "ID, nome e email são obrigatórios"]);
        return;
    }

    try {
        $stmt = $pdo->prepare("UPDATE users SET nome = ?, email = ?, telefone = ? WHERE id = ?");
        $stmt->execute([$data["nome"], $data["email"], $data["telefone"] ?? null, $id]);
        echo json_encode(["mensagem" => "Usuário atualizado"]);
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(["erro" => $e->getMessage()]);
    }
}
function deleteUser($pdo, $id) {
    if (!$id) {
        http_response_code(400);
        echo json_encode(["erro" => "ID é obrigatório"]);
        return;
    }

    try {
        $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
        $stmt->execute([$id]);
        echo json_encode(["mensagem" => "Usuário excluído"]);
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(["erro" => $e->getMessage()]);
    }
}

?>
