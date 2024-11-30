<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../imgs/favicon.png" type="image/x-icon">
    <title>Tela de Recomendações</title>
    <link rel="stylesheet" href="../css/catalago.css">
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
    <br>
    <br>
    <!-- Título da seção -->
    <div class="title">RECOMENDADOS :</div>

    <!-- Grid de livros -->
    <div class="books-grid">
        <?php
        // Exemplo de como ficaria o código PHP com a URL da capa do livro
        $json = file_get_contents('http://localhost/BIBLIOTECA/api/api_catalago.php');
        if ($json === false) {
            echo "<p>Erro ao acessar a API.</p>";
        } else {
            $livros = json_decode($json, true);
            if ($livros === null) {
                echo "<p>Erro ao decodificar JSON: " . json_last_error_msg() . "</p>";
            } elseif (!empty($livros) && is_array($livros)) {
                foreach ($livros as $livro) {
                    echo "<div class='book-card'>
                <img src='{$livro['capa_livro']}' alt='Capa do Livro' class='book-cover'>
                <div class='description'><strong>{$livro['titulo']}</strong><br>
                Autor: {$livro['autor']}<br>
                Quantidade: {$livro['quantidade_fisico']}<br>
                Tipo: {$livro['tipo_livro']}<br>
                Editora: {$livro['editora']}<br>
                Ano: {$livro['ano_publicacao']}</div>
                <div class='buttons'>
                   <button class='button-view'><a href='{$livro['url_ebook']}' target='_blank' style='color: white; text-decoration: none;'>LER AGORA</a></button>
                   
                </div>
            </div>";
                }
            } else {
                echo "<p>Nenhum livro encontrado ou erro ao obter dados.</p>";
            }
        }
        ?>

    </div>
    <!-- <script>
        //<button class='button-schedule' onclick='agendarLivro({$livro['id_livro']})'>AGENDAR</button>
        function agendarLivro(idLivro) {
            var userId = 1; // Substitua pelo ID real do usuário logado      

            fetch('../api/api_reservar_livro.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: `id_livro=${idLivro}&id_usuario=${userId}`
                })
                .then(response => response.text())
                .then(data => alert(data))
                .catch(error => alert("Erro ao agendar o livro."));
        }
    </script> -->


    <?php
    include('../php/footer.php');
    ?>
</body>

</html>