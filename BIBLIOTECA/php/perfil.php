<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/perfil.css">
    <title>Perfil</title>
</head>

<body>
    <div id="menu-container"></div>
    <script>
        // Função para fazer a requisição da API
        fetch('../api/api_qualuser.php') // Caminho para o arquivo API
            .then(response => response.json())
            .then(data => {
                // Exibe o conteúdo da resposta da API no console para depuração
                console.log("Resposta da API:", data);

                // Verifica se houve um erro de sessão (usuário não logado)
                if (data.erro) {
                    alert(data.erro); // Exibe o erro caso o usuário não esteja logado
                } else {
                    // Exibe o menu dependendo do tipo de usuário
                    loadMenu(data.menu);

                    // Exibe as informações do usuário (opcional para debug)
                    console.log('ID do usuário: ' + data.id_usuario);
                    console.log('Tipo de usuário: ' + data.tipo_usuario);
                }
            })
            .catch(error => {
                console.error("Erro ao carregar os dados da API:", error);
            });

        // Função para carregar o menu na página
        function loadMenu(menuPath) {
            console.log("Caminho do menu:", menuPath); // Verifique o caminho retornado pela API
            if (menuPath) {
                // Faz uma nova requisição para carregar o conteúdo do menu
                fetch(menuPath)
                    .then(response => response.text()) // Pega o conteúdo HTML do menu
                    .then(menuHTML => {
                        console.log("Menu HTML carregado:", menuHTML); // Verifique o conteúdo HTML do menu
                        // Coloca o conteúdo do menu no container
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
        <img src="sua-imagem.jpg" alt="Sua Nome" class="perfil-imagem">
        <h1>Sua Nome</h1>
        <p class="bio">Aqui vai uma breve descrição sobre você. Pode incluir interesses, profissão, etc.</p>
        <div class="redes-sociais">
            <a href="https://www.facebook.com" target="_blank">Facebook</a>
            <a href="https://www.twitter.com" target="_blank">Twitter</a>
            <a href="https://www.instagram.com" target="_blank">Instagram</a>
        </div>
    </div>
</body>

</html>