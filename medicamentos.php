<?php
header('Content-Type: application/json');

require_once 'db.php'; // Inclua o arquivo de conexão com o banco de dados

try {
    // Executa a consulta SQL usando mysqli
    $sql = "SELECT * FROM medicamentos";
    $result = $conn->query($sql);

    // Verifica se a consulta retornou resultados
    if ($result->num_rows > 0) {
        // Fetch todos os resultados como um array associativo
        $medicamentos = [];

        while ($row = $result->fetch_assoc()) {
            $row['bula_pdf'] = 'uploads/' . $row['bula_pdf']; // Adiciona o caminho completo do PDF
            $medicamentos[] = $row;
        }

        // Retorna os dados como JSON
        echo json_encode($medicamentos);
    } else {
        echo json_encode([]); // Retorna um array vazio se não houver resultados
    }
} catch (Exception $e) {
    // Se ocorrer um erro, retorna uma mensagem de erro em JSON
    echo json_encode(['error' => 'Erro na consulta ao banco de dados: ' . $e->getMessage()]);
}

$conn->close(); // Fecha a conexão com o banco de dados
?>
