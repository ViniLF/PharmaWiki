<?php
require_once 'php/db.php'; // Subindo um nível para acessar 'db.php'

header('Content-Type: application/json');

if ($conn) {
    // Adiciona o campo bula_pdf na consulta
    $sql = "SELECT id, nome, dosagem, familia, bula_pdf, tipo_med, via_administracao FROM medicamentos";
    $result = $conn->query($sql);

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
