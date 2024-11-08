<?php
include_once('../php/conexao.php'); 

if (isset($_POST['nome'], $_POST['email'], $_POST['senha'], $_POST['endereco'], $_POST['telefone'], $_POST['tipo_usuario'])) {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $endereco = $_POST['endereco'];
    $telefone = $_POST['telefone'];
    $tipo_usuario = $_POST['tipo_usuario']; 

    $nome = $conn->real_escape_string($nome);
    $email = $conn->real_escape_string($email);
    $senha = $conn->real_escape_string($senha);
    $endereco = $conn->real_escape_string($endereco);
    $telefone = $conn->real_escape_string($telefone);
    $tipo_usuario = $conn->real_escape_string($tipo_usuario);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Email inválido. Por favor, insira um email válido.";
        exit;
    }
    $senhaCriptografada = password_hash($senha, PASSWORD_DEFAULT);

    $query = "SELECT * FROM usuario WHERE email = '$email'";
    $result = $conn->query($query);
    
    if ($result->num_rows > 0) {
        echo "Email já está cadastrado.";
    } else {
        $query = "INSERT INTO usuario (nome, email, senha, endereco, telefone, tipo_usuario) 
                  VALUES ('$nome', '$email', '$senhaCriptografada', '$endereco', '$telefone', '$tipo_usuario')";

        if ($conn->query($query)) {
            echo "Cadastro realizado com sucesso!";
            // Redirecionar para outra página, se necessário
            // header('Location: login.php');
            // exit();
        } else {
            echo "Erro ao cadastrar usuário: " . $conn->error;
        }
    }
}

?>
