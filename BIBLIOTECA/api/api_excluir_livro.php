<?php
include '../php/conexao.php';

if (isset($_GET['id'])) {
    $id_livro = $_GET['id'];
    $sql = "DELETE FROM livro WHERE id_livro = $id_livro";

    if ($conn->query($sql) === TRUE) {
        echo "Livro excluído com sucesso!";
        header("Location: ../php/indm.php");
        exit;
    } else {
        echo "Erro ao excluir o livro: " . $conn->error;
    }
} else {
    echo "ID do livro não fornecido!";
    exit;
}
?>
