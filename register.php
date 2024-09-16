<?php
require_once 'db.php'; // Inclua o arquivo de configuração da conexão

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    try {
        // Prepare a instrução SQL
        $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        // Execute a instrução
        $stmt->execute([$username, $email, $password]);

        // Redireciona para a tela de login
        header("Location: tela-de-login.php");
        exit(); // Garante que o script não continue após o redirecionamento
    } catch (PDOException $e) {
        echo 'Erro: ' . $e->getMessage();
    }
}
?>
