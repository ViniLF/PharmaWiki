<?php
// Inclui a conexão com o banco de dados
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtém o e-mail e a senha do formulário
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Verifica se o e-mail está cadastrado no banco de dados
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verifica se o usuário existe e se a senha está correta
    if ($user && $password === $user['password']) {
        // Se a autenticação for bem-sucedida, inicie uma sessão
        session_start();
        $_SESSION['username'] = $user['username'];
        $_SESSION['email'] = $user['email']; // Opcional: Armazena o e-mail na sessão

        // Redireciona o usuário para a página principal com sucesso
        header("Location: index.html?login=success");
        exit;
    } else {
        // Redireciona de volta para a página de login com o erro
        header("Location: tela-de-login.html?error=1");
        exit;
    }
}
?>
