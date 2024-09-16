<?php
// Incluir o arquivo de conexão
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $dosagem = $_POST['dosagem'];
    $familia = $_POST['familia'];
    $bula = $_POST['bula_pdf'];
    $tipo_med = $_POST['tipo_med'];
    $via_administracao = $_POST['via_administracao'];

    // Atualizar o medicamento no banco de dados
    $sql = "UPDATE medicamentos SET
            nome='$nome',
            dosagem='$dosagem',
            familia='$familia',
            bula_pdf='$bula_pdf',
            tipo='$tipo_med',
            via_administracao='$via_administracao'
            WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        header("Location: medicamentos.php?success=update");
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
