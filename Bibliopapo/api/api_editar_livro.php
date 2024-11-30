<?php 
include ('../php/conexao.php');
if (isset($_GET['id'])) {
    $id_livro = $_GET['id'];
    $sql = "SELECT * FROM livros WHERE id_livro = $id_livro";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $livro = $result->fetch_assoc();
    } else {
        echo "Livro não encontrado!";
        exit;
    }
} else {
    echo "ID do livro não fornecido!";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titulo = $_POST['titulo'];
    $autor = $_POST['autor'];
    $quantidade_fisico = $_POST['quantidade_fisico'];
    $tipo_livro = $_POST['tipo_livro'];
    $editora = $_POST['editora'];
    $ano_publicacao = $_POST['ano_publicacao'];
    $capa_livro = $_POST['capa_livro']; 

    $update_sql = "UPDATE livros SET titulo='$titulo', autor='$autor', quantidade_fisico='$quantidade_fisico', tipo_livro='$tipo_livro', editora='$editora', ano_publicacao='$ano_publicacao', capa_livro='$capa_livro' WHERE id_livro=$id_livro";

    if ($conn->query($update_sql) === TRUE) {
        echo "Livro atualizado com sucesso!";
    } else {
        echo "Erro ao atualizar o livro: " . $conn->error;
    }
}