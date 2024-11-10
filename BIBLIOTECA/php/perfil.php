<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/perfil.css">
    <link rel="icon" href="../imgs/favicon.png" type="image/x-icon">
    <title>Perfil</title>
</head>

<body>
    <div id="menu-container"></div>
    <script>
        fetch('../api/api_qualuser.php')
            .then(response => response.json())
            .then(data => {

                console.log("Resposta da API:", data);

                if (data.erro) {
                    alert(data.erro);
                } else {

                    loadMenu(data.menu);

                    console.log('ID do usuário: ' + data.id_usuario);
                    console.log('Tipo de usuário: ' + data.tipo_usuario);
                }
            })
            .catch(error => {
                console.error("Erro ao carregar os dados da API:", error);
            });

        function loadMenu(menuPath) {
            console.log("Caminho do menu:", menuPath);
            if (menuPath) {
                fetch(menuPath)
                    .then(response => response.text())
                    .then(menuHTML => {
                        console.log("Menu HTML carregado:", menuHTML);
                        document.getElementById('menu-container').innerHTML = menuHTML;
                    })
                    .catch(error => {
                        console.error("Erro ao carregar o menu:", error);
                    });
            } else {
                console.error("Menu não encontrado.");
            }
        }
    </script>
    <div class="perfil-container">
        <h1 id="nome-usuario">Seu Nome</h1>
        <div class="redes-sociais">
            <p id="email-usuario">seu email:</p>
            <p id="endereco-usuario">seu endereço:</p>
            <p>sua senha: *******</p>
            <button id="editar-perfil-btn">Editar perfil</button>
        </div>

        <!-- Formulário de edição -->
        <div id="editar-perfil-form" style="display: none;">
            <input type="text" id="novo-nome" placeholder="Novo nome">
            <input type="email" id="novo-email" placeholder="Novo email">
            <input type="text" id="novo-endereco" placeholder="Novo endereço">
            <input type="tel" id="novo-telefone" placeholder="Novo telefone">
            <input type="password" id="nova-senha" placeholder="Nova senha">
            <button id="salvar-mudancas-btn">Salvar Mudanças</button>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Chama a API para obter os dados do perfil
            $.getJSON('../api/api_perfil.php', function(data) {
                if (data.error) {
                    alert(data.error);
                } else {
                    $('#nome-usuario').text(data.nome);
                    $('#email-usuario').text("seu email: " + data.email);
                    $('#endereco-usuario').text("seu endereço: " + data.endereco);
                }
            });
        });
        // Exibe o formulário de edição ao clicar no botão "Editar perfil"
        $("#editar-perfil-btn").click(function() {
            $("#editar-perfil-form").toggle();
        });

        // Envia os dados para a API ao clicar em "Salvar Mudanças"
        $("#salvar-mudancas-btn").click(function() {
        const dadosPerfil = {
            nome: $("#novo-nome").val(),
            email: $("#novo-email").val(),
            endereco: $("#novo-endereco").val(),
            telefone: $("#novo-telefone").val(),
            senha: $("#nova-senha").val() // Campo opcional
        };

        $.ajax({
            url: '../api/api_editar_perfil.php',
            type: 'POST',
            contentType: 'application/json',
            data: JSON.stringify(dadosPerfil),
            success: function(response) {
                if (response.success) {
                    alert(response.success);
                    // Atualiza os dados na página
                    $("#nome-usuario").text(dadosPerfil.nome);
                    $("#email-usuario").text("seu email: " + dadosPerfil.email);
                    $("#endereco-usuario").text("seu endereço: " + dadosPerfil.endereco);
                    $("#editar-perfil-form").hide();
                } else if (response.error) {
                    alert(response.error);
                }
            }
        });
        });
        
    </script>

<?php  
include('../php/footer.php');
?>
</body>

</html>