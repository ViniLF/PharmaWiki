<?php
// Inclui o arquivo de conexão com o banco de dados
require '../db.php'; // Ajuste o caminho conforme necessário

// Recebe os dados da solicitação POST
$id = $_POST['id'] ?? '';
$nome = $_POST['nome'] ?? '';
$dosagem = $_POST['dosagem'] ?? '';
$familia = $_POST['familia'] ?? '';
$tipo_med = $_POST['tipo_med'] ?? '';
$via_administracao = $_POST['via_administracao'] ?? '';

// Verifica se todos os campos obrigatórios estão preenchidos
if (empty($id) || empty($nome) || empty($dosagem) || empty($familia) || empty($tipo_med) || empty($via_administracao)) {
    echo json_encode(['error' => 'Todos os campos são obrigatórios.']);
    exit;
}

// Tratamento de arquivo (opcional)
$bula_pdf = '';
if (isset($_FILES['bula_pdf']) && $_FILES['bula_pdf']['error'] == UPLOAD_ERR_OK) {
    $upload_dir = '../uploads/bulas/'; // Diretório para uploads (ajustar o caminho conforme necessário)
    $tmp_name = $_FILES['bula_pdf']['tmp_name'];
    $file_name = basename($_FILES['bula_pdf']['name']);
    $upload_file = $upload_dir . $file_name;

    if (move_uploaded_file($tmp_name, $upload_file)) {
        $bula_pdf = $file_name;
    } else {
        echo json_encode(['error' => 'Erro ao fazer upload do arquivo.']);
        exit;
    }
}

// Prepara a consulta de atualização
$sql = "UPDATE medicamentos SET nome = ?, dosagem = ?, familia = ?, tipo_med = ?, via_administracao = ?, bula_pdf = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('ssssssi', $nome, $dosagem, $familia, $tipo_med, $via_administracao, $bula_pdf, $id);

if ($stmt->execute()) {
    echo json_encode(['success' => 'Medicamento atualizado com sucesso.']);
} else {
    echo json_encode(['error' => 'Erro ao atualizar medicamento.']);
}

// Fecha a conexão
$stmt->close();
$conn->close();
?>
