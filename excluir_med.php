<?php
// Incluir o arquivo de conexão
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];

    $sql = "DELETE FROM medicamentos WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        header("Location: medicamentos.php?success=delete");
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
