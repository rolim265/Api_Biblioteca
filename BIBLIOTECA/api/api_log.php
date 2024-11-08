<?php
session_start(); // Inicia a sessão

include_once('../php/conexao.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $email = $conn->real_escape_string($email);
    $senha = $conn->real_escape_string($senha);

    $query = "SELECT * FROM usuario WHERE email = '$email'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $usuario = $result->fetch_assoc();

        if (password_verify($senha, $usuario['senha'])) {
            $_SESSION['id_usuario'] = $usuario['id_usuario'];
            $_SESSION['tipo_usuario'] = $usuario['tipo_usuario'];

            if (isset($_SESSION['id_usuario']) && isset($_SESSION['tipo_usuario'])) {
                echo "Sessão iniciada. ID do usuário: {$_SESSION['id_usuario']}, Tipo: {$_SESSION['tipo_usuario']}";
                if ($usuario['tipo_usuario'] == 'admin') {
                    header('Location: ../php/indm.php');
                } else {
                    header('Location: ../php/index.php');
                }
                exit();
            } else {
                echo "Erro ao iniciar sessão.";
            }


          //  if ($usuario['tipo_usuario'] == 'admin') {
          //      header('Location: indm.php');
          //  } else {
          //      header('Location: index.php');
        //    }
            exit();
        } else {
            echo "Senha incorreta.";
        }
    } else {
        echo "Usuário não encontrado.";
    }
}
