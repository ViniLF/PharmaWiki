<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PharmaWiki - Login</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="css/styles-register.css">
</head>
<body>
    <div class="theme-toggle">
        <span class="material-symbols-outlined" id="theme-icon">dark_mode</span>
    </div>
    <div class="main-container">
        <!-- Slogan e Imagem -->
        <div class="slogan-container">
            <h1>Bem-vindo à PharmaWiki</h1>
            <p>O seu guia confiável de medicamentos.</p>
            <img src="images/inicio.png" class="saude1" alt="Imagem relacionada à saúde">
        </div>

        <!-- Tela de Login -->
        <div class="auth-container">
            <div class="auth-box">
                <button id="guest-login" class="auth-button">Entrar como Visitante</button>
                <div id="login-section" class="auth-section">
                    <h2>Login</h2>
                    <form id="login-form" action="login.php" method="POST">
                        <input type="email" id="login-email" name="email" placeholder="E-mail" required>
                        <input type="password" id="login-password" name="password" placeholder="Senha" required>

                        <!-- Exibe a mensagem de erro caso as credenciais estejam incorretas -->
                        <?php if (isset($_GET['error']) && $_GET['error'] == 'invalid_credentials'): ?>
                            <p style="color: red;">Seu e-mail ou senha está incorreto.</p>
                        <?php endif; ?>

                        <button type="submit" class="auth-button">Entrar</button>
                    </form>
                    <p>Não tem uma conta? <a href="#" id="go-to-register">Registrar-se</a></p>
                </div>
                <div id="register-section" class="auth-section" style="display: none;">
                    <h2>Registro</h2>
                    <form id="register-form" action="register.php" method="POST">
                        <input type="text" id="register-username" name="username" placeholder="Nome de Usuário" required>
                        <input type="email" id="register-email" name="email" placeholder="E-mail" required>
                        <input type="password" id="register-password" name="password" placeholder="Senha" required>
                        <button type="submit" class="auth-button">Registrar</button>
                    </form>
                    <p>Já tem uma conta? <a href="#" id="go-to-login">Entrar</a></p>
                </div>
            </div>
        </div>
    </div>
    <script src="js/auth.js"></script>
</body>
</html>
