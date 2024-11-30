<?php
session_start();
header("Content-Type: application/json");
include('../php/conexao.php');

if (!isset($_SESSION['id_usuario'])) {
    echo json_encode(["error" => "Usuário não logado"]);
    exit;
}

$id_usuario = $_SESSION['id_usuario'];
$data = json_decode(file_get_contents("php://input"), true);

$nome = $data['nome'] ?? null;
$email = $data['email'] ?? null;
$endereco = $data['endereco'] ?? null;
$telefone = $data['telefone'] ?? null;
$senha = $data['senha'] ?? null;

// Atualiza o perfil
$query = "UPDATE usuario SET nome = ?, email = ?, endereco = ?, telefone = ?" . ($senha ? ", senha = ?" : "") . " WHERE id_usuario = ?";
$stmt = $conn->prepare($query);

if ($senha) {
    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
    $stmt->bind_param("sssssi", $nome, $email, $endereco, $telefone, $senha_hash, $id_usuario);
} else {
    $stmt->bind_param("ssssi", $nome, $email, $endereco, $telefone, $id_usuario);
}

if ($stmt->execute()) {
    echo json_encode(["success" => "Perfil atualizado com sucesso"]);
} else {
    echo json_encode(["error" => "Erro ao atualizar o perfil"]);
}
?>
