<?php
// db.php

$host = 'localhost'; // Alterar conforme necessário
$db = 'pharmawiki'; // Alterar conforme necessário
$user = 'root'; // Alterar conforme necessário
$pass = ''; // Alterar conforme necessário

$conn = new mysqli($host, $user, $pass, $db);

// Verifica se há erros na conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Define o charset como utf8
$conn->set_charset("utf8");
?>
