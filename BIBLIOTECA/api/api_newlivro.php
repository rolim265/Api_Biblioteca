<?php
include '../php/conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titulo = $_POST['titulo'];
    $autor = $_POST['autor'];
    $quantidade_fisico = $_POST['quantidade_fisico'];
    $tipo_livro = $_POST['tipo_livro'];  
    $editora = $_POST['editora'];
    $ano_publicacao = $_POST['ano_publicacao'];
    $capa_livro = $_POST['capa_livro'];  
    $url_ebook = $_POST['url_ebook'];    

    $insert_sql = "INSERT INTO livros (titulo, autor, quantidade_fisico, tipo_livro, editora, ano_publicacao, capa_livro, url_ebook) 
                   VALUES ('$titulo', '$autor', '$quantidade_fisico', '$tipo_livro', '$editora', '$ano_publicacao', '$capa_livro', '$url_ebook')";

    if ($conn->query($insert_sql) === TRUE) {
        header('location: ../php/indm.php');
    } else {
        echo "Erro ao adicionar livro: " . $conn->error;
    }
}
