<?php
// Inicia a sessão
session_start();

// Destroi todas as variáveis da sessão
$_SESSION = array();

// Destroi a sessão
session_destroy();

// Redireciona para a página de login
header("Location: tela-de-login.html");
exit;
?>
