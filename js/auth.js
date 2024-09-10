document.addEventListener('DOMContentLoaded', function () {
    const guestLoginButton = document.getElementById('guest-login');
    const loginSection = document.getElementById('login-section');
    const registerSection = document.getElementById('register-section');
    const goToRegisterLink = document.getElementById('go-to-register');
    const goToLoginLink = document.getElementById('go-to-login');
    const themeToggle = document.querySelector('#theme-icon');
    const body = document.body;
    const themeImage = document.querySelector('.saude1');

    guestLoginButton.addEventListener('click', function () {
        window.location.href = 'index.php';
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
});

const urlParams = new URLSearchParams(window.location.search);
const error = urlParams.get('error');

if (error === '1') {
    alert('E-mail ou senha incorretos! Tente novamente.');
}
