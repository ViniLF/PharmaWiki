<?php
// Configurações de conexão com o banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pharmawiki";

// Criar a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Consultar os registros
$sql = "SELECT id, username, email, registration_date FROM users";
$result = $conn->query($sql);

$registros = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $registros[] = $row;
    }
}

// Retornar registros como JSON
header('Content-Type: application/json');
echo json_encode($registros);

$conn->close();
?>
