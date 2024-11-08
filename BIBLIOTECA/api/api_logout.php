<?php
session_start(); 
if (isset($_SESSION['id_usuario'])) {
    session_unset();

    session_destroy();

    echo json_encode(["message" => "Logout realizado com sucesso"]);
    header('Location: ../php/login.php');
} else {
    echo json_encode(["message" => "Nenhum usuário logado"]);
}
?>
