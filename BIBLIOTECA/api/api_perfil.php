<?php
session_start();
header("Content-Type: application/json");
include('../php/conexao.php');

// Verificar se o usuário está logado
if (!isset($_SESSION['id_usuario'])) {
    echo json_encode(["error" => "Usuário não logado"]);
    exit;
}

$id_usuario = $_SESSION['id_usuario'];

// Query para buscar os dados do perfil
$query = "SELECT nome, email, endereco, telefone FROM usuario WHERE id_usuario = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id_usuario);
$stmt->execute();
$result = $stmt->get_result();
$dados_usuario = $result->fetch_assoc();

if ($dados_usuario) {
    echo json_encode($dados_usuario);
} else {
    echo json_encode(["error" => "Dados do usuário não encontrados"]);
}
