<?php
session_start();
require('fpdf186/fpdf.php');
include './config/conexion.php';

if (!isset($_SESSION['user_id']) || !isset($_SESSION['role'])) {
    header("Location: login.html");
    exit();
}

$proyecto_id = $_POST['proyecto_id'];
$sql = "SELECT p.*, c.nombre AS contratista_nombre, e.nombre_empresa AS empresa_nombre, f.nombre AS freelancer_nombre
        FROM proyectos p
        LEFT JOIN contratistas c ON p.contratista_id = c.id
        LEFT JOIN empresas e ON p.empresa_id = e.id
        LEFT JOIN freelancers f ON p.freelancer_id = f.id
        WHERE p.id = ?";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die("Error en la preparación de la consulta: " . $conn->error);
}

$stmt->bind_param("i", $proyecto_id);

if (!$stmt->execute()) {
    die("Error en la ejecución de la consulta: " . $stmt->error);
}

$result = $stmt->get_result();
$row = $result->fetch_assoc();

// Para debugging, usar comentario en lugar de echo
// echo 'Valor de terminado: ' . $row['terminado'];

class PDF extends FPDF
{
    function Header()
    {
        $this->SetFillColor(0, 102, 204);
        $this->SetTextColor(255, 255, 255);
        $this->SetFont('Arial', 'B', 20);

        $titulo = 'WorkWave - Reporte del Proyecto';
        $this->Cell(0, 12, utf8_decode($titulo), 0, 1, 'C', true);
        $this->Ln(5);
    }

    function Footer()
    {
        $this->SetY(-25);
        $this->SetFont('Arial', 'I', 10);
        $this->SetTextColor(0, 102, 204);
        $this->Cell(0, 10, 'Pag ' . $this->PageNo(), 0, 0, 'C');
        $this->Ln();
        $this->SetFont('Arial', '', 8);
        $this->Cell(0, 10, 'Generado por WorkWave - ' . date('d/m/Y H:i:s'), 0, 0, 'C');
    }

    function ProjectReport($title, $description, $status, $price, $startDate, $endDate, $contractor, $freelancer, $company)
    {
        $this->SetFont('Arial', '', 12);
        $paragraph = utf8_decode("
El proyecto titulado '$title' tiene la siguiente descripción: $description.

Estado del Proyecto:
El estado actual del proyecto es: $status El precio del proyecto es $price.

Fechas Importantes:
El proyecto inició el $startDate y está programado para finalizar el $endDate.

Información de Contacto:
Contratista: $contractor
Freelancer: $freelancer
Empresa: $company
        ");
        $this->MultiCell(0, 10, $paragraph, 0, 1);
        $this->Ln(5);
    }
}

$pdf = new PDF();
$pdf->AddPage();

// Verificar valores y manejar casos inesperados
$status = ($row['terminado'] === 'Sí') ? 'Proyecto finalizado correctamente.' : (($row['terminado'] === 'No') ? 'Proyecto en proceso.' : 'Estado desconocido.');
$price = $row['precio'] . '$';
$startDate = $row['fecha_inicio'];
$endDate = $row['fecha_fin'];
$contractor = $row['contratista_nombre'] ? $row['contratista_nombre'] : 'N/A';
$freelancer = $row['freelancer_nombre'] ? $row['freelancer_nombre'] : 'N/A';
$company = $row['empresa_nombre'] ? $row['empresa_nombre'] : 'N/A';

$pdf->ProjectReport($row['titulo'], $row['descripcion'], $status, $price, $startDate, $endDate, $contractor, $freelancer, $company);

$pdf->Output();

$stmt->close();
$conn->close();
?>
