

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de Recomendações</title>
    <link rel="stylesheet" href="../css/catalago.css">
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
    
    <!-- <div ontouchstart="">
  <div class="button">
    <a href="../php/novolivro.php">Adicionar novo livro</a>
  </div>
</div> -->

    <div class="title">RECOMENDADOS :</div>

    <div class="books-grid">
        <?php
        $json = file_get_contents('http://localhost/BIBLIOTECA/api/api_update_livro.php');
        if ($json === false) {
            echo "<p>Erro ao acessar a API.</p>";
        } else {
            $livros = json_decode($json, true);
            if ($livros && is_array($livros) && count($livros) > 0) {
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
                            <button class='button-schedule'>AGENDAR</button>
                            <button class='button-edit'><a href='editar_livro.php?id={$livro['id_livro']}' style='color: white; text-decoration: none;'>EDITAR</a></button>
                            <button class='button-delete' onclick='deletarLivro({$livro['id_livro']})'>EXCLUIR</button>
                        </div>
                    </div>";
                }
            } else {
                echo "<p>Nenhum livro encontrado ou erro ao obter dados.</p>";
            }
        }
        ?>

    </div>
    <script>
        function deletarLivro(id_livro) {
            if (confirm("Você tem certeza que deseja excluir este livro?")) {
                fetch('http://localhost/BIBLIOTECA/api/api_update_livro.php?id=' + id_livro, {
                    method: 'DELETE'
                })
                .then(response => response.json())
                .then(data => {
                    if (data.message) {
                        alert(data.message);
                        location.reload(); // Recarregar a página após a exclusão
                    } else {
                        alert('Erro ao excluir livro.');
                    }
                });
            }
        }
    </script>

</body>

</html>
