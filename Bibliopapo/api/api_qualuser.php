<?php
header("Content-Type: application/json; charset=UTF-8"); 
session_start(); 

include('../php/conexao.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (!isset($_SESSION['id_usuario'])) {
    echo json_encode(["erro" => "Você precisa estar logado para acessar esta página."]);
    exit;
}

function getMenu() {
    if (isset($_SESSION['tipo_usuario'])) {
        if ($_SESSION['tipo_usuario'] === 'usuario') {
            return "menu.php"; 
        } elseif ($_SESSION['tipo_usuario'] === 'admin') {
            return "menu2.php"; 
        }
    }
    return null;
}

$response = [
    "id_usuario" => $_SESSION['id_usuario'],
    "tipo_usuario" => $_SESSION['tipo_usuario'],
    "menu" => getMenu()
];

echo json_encode($response);
