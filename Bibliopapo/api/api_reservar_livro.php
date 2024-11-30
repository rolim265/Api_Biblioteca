<?php
// Conectar ao banco de dados
$conn = new mysqli('localhost', 'usuario', 'senha', 'BIBLIOTECA');

if ($conn->connect_error) {
    die(json_encode(["status" => "erro", "mensagem" => "Erro de conexão com o banco de dados."]));
}

$id_livro = $_POST['id_livro'];
$id_usuario = $_POST['id_usuario'];

// Verifica a quantidade física do livro
$query = "SELECT quantidade_fisico FROM livros WHERE id_livro = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id_livro);
$stmt->execute();
$result = $stmt->get_result();
$livro = $result->fetch_assoc();

if ($livro['quantidade_fisico'] > 0) {
    // Reduz a quantidade física de livros
    $query = "UPDATE livros SET quantidade_fisico = quantidade_fisico - 1 WHERE id_livro = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id_livro);
    if ($stmt->execute()) {
        // Insere a reserva na tabela `reservas`
        $data_reserva = date("Y-m-d H:i:s");
        $status = "reservado";
        $query = "INSERT INTO reservas (id_usuario, id_livro, data_reserva, status) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("iiss", $id_usuario, $id_livro, $data_reserva, $status);

        if ($stmt->execute()) {
            echo json_encode(["status" => "sucesso", "mensagem" => "Reserva realizada com sucesso!"]);
        } else {
            echo json_encode(["status" => "erro", "mensagem" => "Erro ao registrar a reserva."]);
        }
    } else {
        echo json_encode(["status" => "erro", "mensagem" => "Erro ao atualizar a quantidade de livros."]);
    }
} else {
    echo json_encode(["status" => "erro", "mensagem" => "Livro indisponível para reserva."]);
}

$stmt->close();
$conn->close();
?>
