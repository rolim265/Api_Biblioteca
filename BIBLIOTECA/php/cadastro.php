<?php
include('../api/api_cad.php');
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuário</title>
    <link rel="stylesheet" href="../css/cad.css">
</head>

<body>
    <div class="form-container">
        <h2>Cadastro de Usuário</h2>
        <form action="../api/api_cad.php" method="POST">
            <div class="input-group">
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" required>
            </div>
            <div class="input-group">
                <label for="email">E-mail:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="input-group">
                <label for="senha">Senha:</label>
                <input type="password" id="senha" name="senha" required>
            </div>
            <div class="input-group">
                <label for="endereco">Endereço:</label>
                <input type="text" id="endereco" name="endereco" required>
            </div>
            <div class="input-group">
                <label for="telefone">Telefone:</label>
                <input type="text" id="telefone" name="telefone" required>
            </div>
            <div class="input-group">
                <label for="tipo_usuario">Tipo de Usuário:</label>
                <select id="tipo_usuario" name="tipo_usuario" required>
                    <option value="usuario">Usuário Comum</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
            <div class="input-group">
                <button type="submit">Cadastrar</button>
            </div>
        </form>

        <?php
        if (isset($_GET['status'])) {
            $status = $_GET['status'];
            if ($status == 'sucesso') {
                echo '<p class="status-success">Cadastro realizado com sucesso!</p>';
            } elseif ($status == 'erro') {
                echo '<p class="status-error">Erro ao cadastrar o usuário.</p>';
            }
        }
        ?>
    </div>
</body>

</html>