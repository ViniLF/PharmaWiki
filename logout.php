<?php
session_start();
session_unset();
session_destroy();
header("Location: tela-de-login.php"); // Redireciona para a página de login
exit();
?>
