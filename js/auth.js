document.addEventListener('DOMContentLoaded', function () {
    const guestLoginButton = document.getElementById('guest-login');
    const loginSection = document.getElementById('login-section');
    const registerSection = document.getElementById('register-section');
    const goToRegisterLink = document.getElementById('go-to-register');
    const goToLoginLink = document.getElementById('go-to-login');
    const loginForm = document.getElementById('login-form');
    const registerForm = document.getElementById('register-form');
    const themeToggle = document.querySelector('#theme-icon');
    const body = document.body;
    const themeImage = document.querySelector('.saude1');

    guestLoginButton.addEventListener('click', function () {
        window.location.href = 'index.html';
    });

    goToRegisterLink.addEventListener('click', function (e) {
        e.preventDefault();
        loginSection.style.display = 'none';
        registerSection.style.display = 'block';
    });

    goToLoginLink.addEventListener('click', function (e) {
        e.preventDefault();
        registerSection.style.display = 'none';
        loginSection.style.display = 'block';
    });

    loginForm.addEventListener('submit', function (e) {
        e.preventDefault();
        const email = document.getElementById('login-email').value;
        const password = document.getElementById('login-password').value;

        // Adicione a lógica para autenticar o usuário
        // Se autenticado:
        window.location.href = 'index.html';
    });

    registerForm.addEventListener('submit', function (e) {
        e.preventDefault();
        const username = document.getElementById('register-username').value;
        const email = document.getElementById('register-email').value;
        const password = document.getElementById('register-password').value;

        // Adicione a lógica para criar um novo usuário
        // Se registrado:
        window.location.href = 'index.html';
    });

    themeToggle.addEventListener('click', () => {
        body.classList.toggle('dark-theme');
        if (body.classList.contains('dark-theme')) {
            themeToggle.textContent = 'light_mode';
            themeImage.src = 'images/inicio2.png'; // Muda a imagem para o modo escuro
        } else {
            themeToggle.textContent = 'dark_mode';
            themeImage.src = 'images/inicio.png'; // Muda a imagem para o modo claro
        }
    });

    // Toggle between login and register sections
    document.getElementById('go-to-register').addEventListener('click', function() {
        document.getElementById('login-section').style.display = 'none';
        document.getElementById('register-section').style.display = 'block';
    });

    document.getElementById('go-to-login').addEventListener('click', function() {
        document.getElementById('register-section').style.display = 'none';
        document.getElementById('login-section').style.display = 'block';
    });
});
