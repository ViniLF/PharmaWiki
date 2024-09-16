<?php
require_once 'php/db.php'; // Inclua a conexão com o banco de dados

$registros = [];

// Verifica se a conexão foi estabelecida corretamente
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Consultar os registros
$sql = "SELECT id, username, email, access_level, registration_date FROM users";
$result = $conn->query($sql);

if ($result) {
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $registros[] = $row;
        }
    } else {
        // Nenhum registro encontrado
        $registros = ['message' => 'Nenhum registro encontrado.'];
    }
} else {
    // Erro ao executar a consulta
    $registros = ['error' => 'Erro ao consultar o banco de dados: ' . $conn->error];
}

// Retornar registros como JSON
header('Content-Type: application/json');
echo json_encode($registros);

$conn->close();
?>
