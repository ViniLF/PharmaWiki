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

// Função para carregar registros
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
                        <td>${registro.username}</td>
                        <td>${registro.email}</td>
                        <td>${registro.access_level}</td>
                        <td>${registro.registration_date}</td>
                    </tr>
                `;
            });

            document.querySelector("#tabela-registros tbody").innerHTML = output;
        }
    };
    xhr.send();
}

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
                    <td><a href="uploads/bulas/${medicamento.bula_pdf}" target="_blank">Ver Bula</a></td>
                    <td>${medicamento.tipo_med}</td>
                    <td>${medicamento.via_administracao}</td>
                    <td>
                        <button class="edit-btn" data-id="${medicamento.id}" onclick="mostrarFormularioEdicao(${medicamento.id})">Editar</button>
                        <button class="delete-btn" data-id="${medicamento.id}" onclick="excluirMedicamento(${medicamento.id})">Excluir</button>
                    </td>
                `;
                tabelaMedicamentos.appendChild(row);
            });
        })
        .catch(error => console.error('Erro ao carregar medicamentos:', error));
}

document.addEventListener("DOMContentLoaded", function () {
    // Oculta o formulário de edição ao carregar a página
    document.getElementById('form-editar').style.display = 'none';
});

// Função para mostrar o formulário de edição e preencher com os dados do medicamento
function mostrarFormularioEdicao(id) {
    fetch(`php/medicamentos/get_medicamento.php?id=${id}`)
        .then(response => response.json())
        .then(data => {
            if (data) {
                document.getElementById("medicamento-id").value = data.id;
                document.getElementById("medicamento-nome").value = data.nome;
                document.getElementById("medicamento-dosagem").value = data.dosagem;
                document.getElementById("medicamento-familia").value = data.familia;
                document.getElementById("medicamento-bula").value = data.bula_pdf;
                document.getElementById("medicamento-tipo").value = data.tipo_med;
                document.getElementById("medicamento-via").value = data.via_administracao;

                document.getElementById('form-editar').style.display = 'block'; // Exibe o formulário
            }
        })
        .catch(error => console.error('Erro ao carregar dados do medicamento:', error));
}

// Função para salvar a edição do medicamento
function salvarEdicao() {
    const id = document.getElementById("medicamento-id").value;
    const nome = document.getElementById("medicamento-nome").value;
    const dosagem = document.getElementById("medicamento-dosagem").value;
    const familia = document.getElementById("medicamento-familia").value;
    const bula_pdf = document.getElementById("medicamento-bula").value;
    const tipo_med = document.getElementById("medicamento-tipo").value;
    const via_administracao = document.getElementById("medicamento-via").value;

    const xhr = new XMLHttpRequest();
    xhr.open("POST", "php/medicamentos/salvar_med.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onload = function () {
        if (this.status === 200) {
            const response = JSON.parse(this.responseText);
            if (response.success) {
                alert(response.success);
                carregarMedicamentos(); // Atualiza a lista de medicamentos após a edição
                document.getElementById('form-editar').style.display = 'none'; // Oculta o formulário
            } else {
                alert(response.error);
            }
        } else {
            alert(`Erro ao editar medicamento. Status: ${this.status}`);
        }
    };

    xhr.onerror = function () {
        alert("Erro de rede. Tente novamente.");
    };

    // Envia os dados do formulário
    xhr.send(`id=${id}&nome=${nome}&dosagem=${dosagem}&familia=${familia}&bula_pdf=${bula_pdf}&tipo_med=${tipo_med}&via_administracao=${via_administracao}`);
}

// Função para excluir um medicamento
function excluirMedicamento(id) {
    if (confirm("Tem certeza de que deseja excluir este medicamento?")) {
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "php/medicamentos/excluir_med.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onload = function () {
            if (this.status === 200) {
                try {
                    const response = JSON.parse(this.responseText);
                    if (response.success) {
                        alert(response.success);
                        carregarMedicamentos(); // Atualiza a lista de medicamentos após a exclusão
                    } else {
                        alert(response.error || "Erro ao excluir medicamento.");
                    }
                } catch (error) {
                    alert("Erro ao processar a resposta: " + error.message);
                }
            } else {
                alert(`Erro ao excluir medicamento. Status: ${this.status}`);
            }
        };
        xhr.onerror = function () {
            alert("Erro de rede. Tente novamente.");
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
