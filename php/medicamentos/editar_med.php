<?php
header('Content-Type: application/json');

// Inclua o arquivo de conexão ajustando o caminho
require_once '../db.php'; // Subindo um nível para acessar 'db.php'

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifica se todos os parâmetros necessários estão presentes
    if (isset($_POST['id']) && isset($_POST['nome']) && isset($_POST['dosagem']) && isset($_POST['familia']) && isset($_POST['bula_pdf']) && isset($_POST['tipo_med']) && isset($_POST['via_administracao'])) {
        
        $id = intval($_POST['id']); // Sanitiza a entrada
        $nome = $conn->real_escape_string($_POST['nome']);
        $dosagem = $conn->real_escape_string($_POST['dosagem']);
        $familia = $conn->real_escape_string($_POST['familia']);
        $bula_pdf = $conn->real_escape_string($_POST['bula_pdf']);
        $tipo_med = $conn->real_escape_string($_POST['tipo_med']);
        $via_administracao = $conn->real_escape_string($_POST['via_administracao']);

        try {
            // Atualiza os dados do medicamento
            $sqlUpdate = "UPDATE medicamentos SET nome = ?, dosagem = ?, familia = ?, bula_pdf = ?, tipo_med = ?, via_administracao = ? WHERE id = ?";
            $stmtUpdate = $conn->prepare($sqlUpdate);
            $stmtUpdate->bind_param('ssssssi', $nome, $dosagem, $familia, $bula_pdf, $tipo_med, $via_administracao, $id);
            $stmtUpdate->execute();

            if ($stmtUpdate->affected_rows > 0) {
                echo json_encode(['success' => 'Medicamento atualizado com sucesso.']);
            } else {
                echo json_encode(['error' => 'Nenhuma alteração detectada ou erro na atualização.']);
            }
        } catch (Exception $e) {
            echo json_encode(['error' => 'Erro na operação: ' . $e->getMessage()]);
        }

        $conn->close();
    } else {
        echo json_encode(['error' => 'Dados incompletos.']);
    }
} else {
    echo json_encode(['error' => 'Método de requisição inválido.']);
}
?>
