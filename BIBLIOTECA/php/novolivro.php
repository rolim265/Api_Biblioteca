<?php
include('../api/api_newlivro.php');
?>
<link rel="stylesheet" href="../css/novolivro.css">

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

    // Função para carregar o menu na página
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
<!-- Formulário para adicionar um novo livro -->
<form method="POST" action="">
    <label for="titulo">Título:</label>
    <input type="text" name="titulo" required><br>

    <label for="autor">Autor:</label>
    <input type="text" name="autor" required><br>

    <label for="quantidade_fisico">Quantidade Física:</label>
    <input type="number" name="quantidade_fisico" required><br>

    <label for="tipo_livro">Tipo:</label>
    <select name="tipo_livro" required>
        <option value="fisico">Físico</option>
        <option value="ebook">eBook</option>
    </select><br>

    <label for="editora">Editora:</label>
    <input type="text" name="editora" required><br>

    <label for="ano_publicacao">Ano de Publicação:</label>
    <input type="text" name="ano_publicacao" required><br>

    <label for="capa_livro">Capa (URL):</label>
    <input type="text" name="capa_livro" required><br>

    <label for="url_ebook">URL do eBook:</label>
    <input type="text" name="url_ebook" required><br>

    <button type="submit">Adicionar Livro</button>
</form>