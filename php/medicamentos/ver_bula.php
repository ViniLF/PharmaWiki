// ver_bula.php
<?php
require_once '../db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $conn->prepare("SELECT bula_pdf FROM medicamentos WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($bula_pdf);
    $stmt->fetch();
    $stmt->close();

    if ($bula_pdf) {
        header('Content-Type: application/pdf');
        header('Content-Disposition: inline; filename="bula.pdf"');
        echo $bula_pdf;
    } else {
        echo "Bula não encontrada.";
    }
}
?>
