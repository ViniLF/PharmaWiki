<?php
session_start(); // Inicie a sessão

require_once 'db.php'; // Inclua o arquivo de conexão com o banco de dados

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = isset($_POST['nome']) ? $_POST['nome'] : '';
    $dosagem = isset($_POST['dosagem']) ? $_POST['dosagem'] : '';
    $familia = isset($_POST['familia']) ? $_POST['familia'] : '';
    $via_administracao = isset($_POST['via_administracao']) ? $_POST['via_administracao'] : '';
    $tipo_med = isset($_POST['tipo_med']) ? $_POST['tipo_med'] : '';

    // Inicializa a variável para o PDF binário
    $bula_pdf = null;

    if ($_FILES['bula_pdf']['error'] === UPLOAD_ERR_OK) {
        $fileName = uniqid() . '-' . $_FILES['bula_pdf']['name'];
        $filePath = 'uploads/' . $fileName;
    
        if (move_uploaded_file($_FILES['bula_pdf']['tmp_name'], $filePath)) {
            $bula_pdf = $fileName; // Salva o nome do arquivo no banco de dados
        } else {
            $_SESSION['error_message'] = "Erro ao salvar o arquivo PDF.";
            header('Location: painel.html');
            exit();
        }
    } else {
        $bula_pdf = null;
    }

    // Insere os dados no banco de dados
    if ($conn) {
        $stmt = $conn->prepare("INSERT INTO medicamentos (nome, dosagem, familia, bula_pdf, via_administracao, tipo_med) VALUES (?, ?, ?, ?, ?, ?)");

        // Verifica se a preparação da instrução foi bem-sucedida
        if ($stmt === false) {
            $_SESSION['error_message'] = "Erro na preparação da instrução SQL: " . $conn->error;
            $conn->close();
            header('Location: painel.html');
            exit();
        }

        // Envia os dados com ou sem PDF
        $stmt->bind_param("ssssss", $nome, $dosagem, $familia, $bula_pdf, $via_administracao, $tipo_med);

        // Executa a instrução e verifica o resultado
        if ($stmt->execute()) {
            $_SESSION['success_message'] = "Sua medicação foi adicionada com sucesso.";
        } else {
            $_SESSION['error_message'] = "Erro na execução da instrução SQL: " . $stmt->error;
        }

        $stmt->close(); // Fecha a declaração
        $conn->close(); // Fecha a conexão
    } else {
        $_SESSION['error_message'] = "Erro na conexão com o banco de dados.";
    }

    // Redireciona para a página principal
    header('Location: painel.html');
    exit();
}
?>
