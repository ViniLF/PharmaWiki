<?php
require_once 'db.php'; // Inclua o arquivo de conexão com o banco de dados

header('Content-Type: application/json');

if ($conn) {
    $query = "SELECT id, nome, dosagem, familia, tipo_med, via_administracao FROM medicamentos";
    $result = $conn->query($query);

    if ($result) {
        $medicamentos = $result->fetch_all(MYSQLI_ASSOC);
        echo json_encode($medicamentos);
    } else {
        echo json_encode(['error' => 'Erro na consulta ao banco de dados.']);
    }

    $conn->close();
} else {
    echo json_encode(['error' => 'Erro na conexão com o banco de dados.']);
}
?>
