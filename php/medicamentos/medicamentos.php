<?php
header('Content-Type: application/json');

require_once '../db.php'; // Ajuste o caminho conforme necessário

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Sanitiza a entrada

    try {
        $sql = "SELECT * FROM medicamentos WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $medicamento = $result->fetch_assoc();
            $medicamento['bula_pdf'] = 'uploads/' . $medicamento['bula_pdf'];
            echo json_encode($medicamento);
        } else {
            echo json_encode(['error' => 'Medicamento não encontrado.']);
        }
    } catch (Exception $e) {
        echo json_encode(['error' => 'Erro na consulta ao banco de dados: ' . $e->getMessage()]);
    }

    $conn->close();
} else {
    echo json_encode(['error' => 'ID não fornecido.']);
}
?>
