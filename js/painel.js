// Alternar entre as seções do painel
document.getElementById("dashboard-link").addEventListener("click", function () {
    toggleSection("dashboard");
});

document.getElementById("registros-link").addEventListener("click", function () {
    toggleSection("registros");
    carregarRegistros(); // Carregar registros quando a aba for aberta
});

document.getElementById("medicamentos-link").addEventListener("click", function () {
    toggleSection("medicamentos");
    carregarMedicamentos(); // Carregar medicamentos quando a aba for aberta
});

document.getElementById("relatorios-link").addEventListener("click", function () {
    toggleSection("relatorios");
});

document.getElementById("configuracoes-link").addEventListener("click", function () {
    toggleSection("configuracoes");
});

// Função para alternar entre seções
function toggleSection(sectionId) {
    const sections = document.querySelectorAll(".conteudo");
    sections.forEach(function (section) {
        if (section.id === sectionId) {
            section.classList.add("ativo");
        } else {
            section.classList.remove("ativo");
        }
    });
}

// Função para carregar os registros via AJAX
function carregarRegistros() {
    const xhr = new XMLHttpRequest();
    xhr.open("GET", "registros.php", true);
    xhr.onload = function () {
        if (this.status === 200) {
            const registros = JSON.parse(this.responseText);
            let output = '';

            registros.forEach(function (registro) {
                output += `
                    <tr>
                        <td>${registro.id}</td>
                        <td>${registro.nome_usuario}</td>
                        <td>${registro.email}</td>
                        <td>${registro.data_registro}</td>
                    </tr>
                `;
            });

            document.querySelector("#tabela-registros tbody").innerHTML = output;
        }
    };
    xhr.send();
}

document.addEventListener('DOMContentLoaded', function() {
    // Função para carregar medicamentos
    function carregarMedicamentos() {
        fetch('listar_medicamentos.php')
            .then(response => response.json())
            .then(data => {
                const tabelaMedicamentos = document.querySelector('#tabela-medicamentos tbody');
                tabelaMedicamentos.innerHTML = ''; // Limpa a tabela antes de adicionar novos dados

                data.forEach(medicamento => {
                    const row = document.createElement('tr');
                    
                    row.innerHTML = `
                        <td>${medicamento.id}</td>
                        <td>${medicamento.nome}</td>
                        <td>${medicamento.dosagem}</td>
                        <td>${medicamento.familia}</td>
                        <td><a href="path/to/pdf/${medicamento.bula_pdf}" target="_blank">Ver Bula</a></td>
                        <td>${medicamento.tipo_med}</td>
                        <td>${medicamento.via_administracao}</td>
                        <td>
                            <button class="edit-btn" data-id="${medicamento.id}">Editar</button>
                            <button class="delete-btn" data-id="${medicamento.id}">Excluir</button>
                        </td>
                    `;

                    tabelaMedicamentos.appendChild(row);
                });
            })
            .catch(error => console.error('Erro ao carregar medicamentos:', error));
    }

    // Carregar medicamentos ao iniciar
    carregarMedicamentos();
});

// Função para editar um medicamento
function editarMedicamento(id) {
    const xhr = new XMLHttpRequest();
    xhr.open("GET", `medicamento.php?id=${id}`, true);
    xhr.onload = function () {
        if (this.status === 200) {
            const medicamento = JSON.parse(this.responseText);
            document.getElementById("medicamento-id").value = medicamento.id;
            document.getElementById("medicamento-nome").value = medicamento.nome;
            document.getElementById("medicamento-dosagem").value = medicamento.dosagem;
            document.getElementById("medicamento-familia").value = medicamento.familia;
            document.getElementById("bula-textarea").value = medicamento.bula;
            document.getElementById("medicamento-tipo").value = medicamento.tipo_med; // Corrigido para 'tipo_med'
            document.getElementById("medicamento-via").value = medicamento.via_administracao;
            document.getElementById("form-title").innerText = "Editar Medicamento";
            document.getElementById("submit-button").innerText = "Salvar Alterações";
        }
    };
    xhr.send();
}

// Função para excluir um medicamento
function excluirMedicamento(id) {
    if (confirm("Tem certeza de que deseja excluir este medicamento?")) {
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "excluir_med.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onload = function () {
            if (this.status === 200) {
                carregarMedicamentos(); // Atualiza a lista de medicamentos após a exclusão
            }
        };
        xhr.send(`id=${id}`);
    }
}

// Função para alternar o tema
document.getElementById("theme-toggle").addEventListener("click", function () {
    document.body.classList.toggle("dark-theme");
    const lightIcon = document.getElementById("light-icon");
    const darkIcon = document.getElementById("dark-icon");
    lightIcon.style.display = lightIcon.style.display === "none" ? "inline" : "none";
    darkIcon.style.display = darkIcon.style.display === "none" ? "inline" : "none";
});
