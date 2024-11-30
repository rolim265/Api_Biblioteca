<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include '../php/conexao.php'; 

$query = isset($_GET['query']) ? $_GET['query'] : '';
$tipoLivro = isset($_GET['tipo']) ? $_GET['tipo'] : ''; 
if (!empty($query)) {
    $sql = "SELECT * FROM livros WHERE (titulo LIKE ? OR autor LIKE ?)";

    if ($tipoLivro != '') {
        $sql .= " AND tipo_livro = ?";
    }
    $stmt = $conn->prepare($sql);
    $searchTerm = "%" . htmlspecialchars($query) . "%"; 

    if ($tipoLivro != '') {
        $stmt->bind_param("sss", $searchTerm, $searchTerm, $tipoLivro);
    } else {
        $stmt->bind_param("ss", $searchTerm, $searchTerm);
    }
    $stmt->execute();
    $result = $stmt->get_result();
}
?>