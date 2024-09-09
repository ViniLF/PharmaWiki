document.addEventListener('DOMContentLoaded', () => {
    const themeToggle = document.getElementById('theme-toggle');
    const logo = document.getElementById('logo');
    const lightIcon = document.getElementById('light-icon');
    const darkIcon = document.getElementById('dark-icon');

    // Verifica se o tema já está definido no localStorage
    const currentTheme = localStorage.getItem('theme');
    if (currentTheme) {
        const isDarkTheme = currentTheme === 'dark';
        document.body.classList.toggle('dark-theme', isDarkTheme);
        logo.src = isDarkTheme ? 'images/logo-dark.svg' : 'images/logo-light.svg';
        lightIcon.style.display = isDarkTheme ? 'none' : 'inline';
        darkIcon.style.display = isDarkTheme ? 'inline' : 'none';
    }

    // Adiciona um listener de evento para alternar o tema ao clicar no botão
    themeToggle.addEventListener('click', () => {
        const isDarkTheme = document.body.classList.toggle('dark-theme');
        
        // Altera o src da logo com base no tema
        logo.src = isDarkTheme ? 'images/logo-dark.svg' : 'images/logo-light.svg';
        
        // Alterna a visibilidade dos ícones
        lightIcon.style.display = isDarkTheme ? 'none' : 'inline';
        darkIcon.style.display = isDarkTheme ? 'inline' : 'none';

        // Armazena a preferência do tema no localStorage
        localStorage.setItem('theme', isDarkTheme ? 'dark' : 'light');
    });
});

var swiper = new Swiper(".mySwiper", {
  slidesPerView: 3,
  spaceBetween: 30,
  slidesPerGroup: 3,
  loop: true,
  grabCursor: true,
  loopFillGroupWithBlank: true,
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
});

// Function to open the modal with the appropriate data
function openModal(title, composition, func, effects, precautions) {
  document.getElementById('modal-title').innerText = title;
  document.getElementById('modal-composition').innerText = composition;
  document.getElementById('modal-function').innerText = func;
  document.getElementById('modal-effects').innerText = effects;
  document.getElementById('modal-precautions').innerText = precautions;
  document.getElementById('modal-container').style.display = 'block';
}

// Function to close the modal
function closeModal() {
  document.getElementById('modal-container').style.display = 'none';
}

// Event listener for the close button
document.querySelector('.close-btn').addEventListener('click', closeModal);

// Event listener for the modal container (to close when clicking outside of the modal content)
window.addEventListener('click', function(event) {
  if (event.target === document.getElementById('modal-container')) {
      closeModal();
  }
});

// Event listeners for each 'Sobre' button to open the modal with specific data
document.querySelectorAll('.aboutMe').forEach(button => {
  button.addEventListener('click', function() {
      const title = this.getAttribute('data-title');
      const composition = this.getAttribute('data-composition');
      const func = this.getAttribute('data-function');
      const effects = this.getAttribute('data-effects');
      const precautions = this.getAttribute('data-precautions');
      
      openModal(title, composition, func, effects, precautions);
  });
});

// Verifica se o parâmetro 'login' está na URL
const urlParams = new URLSearchParams(window.location.search);
const loginSuccess = urlParams.get('login');
const registerSuccess = urlParams.get('register');

if (loginSuccess === 'success') {
    alert('Login efetuado com sucesso!');
}

if (registerSuccess === 'success') {
    alert('Registro efetuado com sucesso! Agora, faça login.');
}

const error = urlParams.get('error');
if (error === '1') {
    alert('E-mail ou senha incorretos! Tente novamente.');
}
