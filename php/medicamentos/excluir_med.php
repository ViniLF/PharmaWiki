<?php
header('Content-Type: application/json');

require_once '../db.php'; // Ajuste o caminho conforme necessário

if (isset($_POST['id'])) {
    $id = intval($_POST['id']); // Sanitiza a entrada

    try {
        // Verifica se o medicamento existe
        $sqlSelect = "SELECT * FROM medicamentos WHERE id = ?";
        $stmtSelect = $conn->prepare($sqlSelect);
        $stmtSelect->bind_param('i', $id);
        $stmtSelect->execute();
        $resultSelect = $stmtSelect->get_result();

        if ($resultSelect->num_rows > 0) {
            // Exclui o medicamento
            $sqlDelete = "DELETE FROM medicamentos WHERE id = ?";
            $stmtDelete = $conn->prepare($sqlDelete);
            $stmtDelete->bind_param('i', $id);
            $stmtDelete->execute();

            if ($stmtDelete->affected_rows > 0) {
                echo json_encode(['success' => 'Medicamento excluído com sucesso.']);
            } else {
                echo json_encode(['error' => 'Erro ao excluir medicamento.']);
            }
        } else {
            echo json_encode(['error' => 'Medicamento não encontrado.']);
        }
    } catch (Exception $e) {
        echo json_encode(['error' => 'Erro na operação: ' . $e->getMessage()]);
    }

    $conn->close();
} else {
    echo json_encode(['error' => 'ID não fornecido.']);
}
?>
