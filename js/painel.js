// Alternar entre as seções do painel
document.getElementById("dashboard-link").addEventListener("click", function () {
    document.getElementById("dashboard").classList.add("ativo");
    document.getElementById("registros").classList.remove("ativo");
});

document.getElementById("registros-link").addEventListener("click", function () {
    document.getElementById("dashboard").classList.remove("ativo");
    document.getElementById("registros").classList.add("ativo");
    carregarRegistros(); // Carregar registros quando a aba for aberta
});

// Função para carregar os registros do banco de dados via AJAX
function carregarRegistros() {
    const xhr = new XMLHttpRequest();
    xhr.open("GET", "painel.php", true);
    xhr.onload = function () {
        if (this.status === 200) {
            const registros = JSON.parse(this.responseText);
            let output = '';

            registros.forEach(function (registro) {
                // Verificar o conteúdo do objeto de registro
                console.log(registro); // Para depuração

                output += `
                    <tr>
                        <td>${registro.id}</td>
                        <td>${registro.username}</td>
                        <td>${registro.email}</td>
                        <td>${registro.registration_date || 'N/A'}</td> <!-- Valor padrão se não estiver definido -->
                    </tr>
                `;
            });

            document.querySelector("#tabela-registros tbody").innerHTML = output;
        }
    };
    xhr.send();
}

// Seleção de elementos
const body = document.body;
const themeToggle = document.getElementById('theme-toggle');
const lightIcon = document.getElementById('light-icon');
const darkIcon = document.getElementById('dark-icon');

// Função para alternar o tema
function toggleTheme() {
    body.classList.toggle('dark-theme');
    
    // Verifica o estado atual e ajusta os ícones
    if (body.classList.contains('dark-theme')) {
        lightIcon.style.display = 'none';
        darkIcon.style.display = 'inline';
    } else {
        lightIcon.style.display = 'inline';
        darkIcon.style.display = 'none';
    }
}

// Define o modo inicial como claro e mostra o ícone apropriado
function setInitialTheme() {
    body.classList.remove('dark-theme');
    lightIcon.style.display = 'inline';
    darkIcon.style.display = 'none';
}

// Evento de clique para alternar o tema
themeToggle.addEventListener('click', toggleTheme);

// Inicializar com tema claro ao carregar a página
setInitialTheme();
