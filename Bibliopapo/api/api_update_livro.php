<?php
include '../php/conexao.php';
header('Content-Type: application/json');

// Verificando o método HTTP para decidir qual ação tomar
$request_method = $_SERVER['REQUEST_METHOD'];

switch ($request_method) {
    case 'GET':
        // Retorna todos os livros
        getLivros();
        break;
    case 'DELETE':
        // Exclui um livro
        deleteLivro();
        break;
    case 'PUT':
        updateLivro();
        break;
    default:
        header("HTTP/1.0 405 Method Not Allowed");
        echo json_encode(['error' => 'Método não permitido']);
        break;
}
function getLivros()
{
    global $conn;

    $sql = "SELECT id_livro, capa_livro, titulo, autor, quantidade_fisico, url_ebook, tipo_livro, editora, ano_publicacao FROM livros";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $livros = [];
        while ($row = $result->fetch_assoc()) {
            $livros[] = $row;
        }
        echo json_encode($livros);
    } else {
        echo json_encode([]);
    }
}

function deleteLivro()
{
    global $conn;

    if (isset($_GET['id'])) {
        $id_livro = $_GET['id'];

        $sql = "DELETE FROM livros WHERE id_livro = $id_livro";

        if ($conn->query($sql) === TRUE) {
            echo json_encode(['message' => 'Livro excluído com sucesso']);
        } else {
            echo json_encode(['error' => 'Erro ao excluir o livro: ' . $conn->error]);
        }
    } else {
        echo json_encode(['error' => 'ID do livro não fornecido']);
    }
}

function updateLivro()
{
    global $conn;

    if (isset($_GET['id'])) {
        $id_livro = $_GET['id'];
        
        $input_data = json_decode(file_get_contents('php://input'), true);

        if (isset($input_data['titulo']) && isset($input_data['autor']) && isset($input_data['quantidade_fisico']) && isset($input_data['tipo_livro']) && isset($input_data['editora']) && isset($input_data['ano_publicacao']) && isset($input_data['capa_livro'])) {
            
            $titulo = $input_data['titulo'];
            $autor = $input_data['autor'];
            $quantidade_fisico = $input_data['quantidade_fisico'];
            $tipo_livro = $input_data['tipo_livro'];
            $editora = $input_data['editora'];
            $ano_publicacao = $input_data['ano_publicacao'];
            $capa_livro = $input_data['capa_livro'];

            $sql = "UPDATE livros SET 
                        titulo = '$titulo',
                        autor = '$autor',
                        quantidade_fisico = '$quantidade_fisico',
                        tipo_livro = '$tipo_livro',
                        editora = '$editora',
                        ano_publicacao = '$ano_publicacao',
                        capa_livro = '$capa_livro'
                    WHERE id_livro = $id_livro";

            if ($conn->query($sql) === TRUE) {
                echo json_encode(['message' => 'Livro atualizado com sucesso']);
            } else {
                echo json_encode(['error' => 'Erro ao atualizar o livro: ' . $conn->error]);
            }
        } else {
            echo json_encode(['error' => 'Dados incompletos para atualização']);
        }
    } else {
        echo json_encode(['error' => 'ID do livro não fornecido']);
    }
}

$conn->close();
?>
