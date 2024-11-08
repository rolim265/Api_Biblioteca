<?php
include '../php/conexao.php';
header('Content-Type: application/json');
$sql = "SELECT id_livro, capa_livro, titulo, autor, quantidade_fisico, url_ebook, tipo_livro, editora, ano_publicacao FROM livros";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $livros = [];

    while ($row = $result->fetch_assoc()) {
        $livros[] = $row;
    }

    echo json_encode($livros);
} else {
    echo json_encode([]);
}
$conn->close();
?>