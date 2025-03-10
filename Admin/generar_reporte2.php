<?php
session_start();
require('fpdf186/fpdf.php');
include './conexion.php';

// Consulta SQL para obtener los registros de auditoría
$sql = "SELECT * FROM Auditoria";
$result = $conn->query($sql);

if ($result === false) {
    die("Error en la consulta de auditoría: " . $conn->error);
}

// Clase PDF para generar el reporte de auditoría
class PDF extends FPDF
{
    function Header()
    {
        $this->SetFillColor(0, 102, 204);
        $this->SetTextColor(255, 255, 255);
        $this->SetFont('Arial', 'B', 20);

        $titulo = 'Auditoría de Operaciones - Reporte de Auditoría';
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
        $this->Cell(0, 10, 'Generado por Auditoría de Operaciones - ' . date('d/m/Y H:i:s'), 0, 0, 'C');
    }

    function AuditTable($header, $data)
    {
        // Colores, ancho y fuente para el encabezado
        $this->SetFillColor(0, 102, 204);
        $this->SetTextColor(255, 255, 255);
        $this->SetDrawColor(0, 0, 0);
        $this->SetLineWidth(.3);
        $this->SetFont('Arial', 'B', 12);

        // Anchuras de las columnas (Tabla tiene 40 en lugar de 30)
        $w = array(40, 30, 30, 30, 30, 30, 60);

        // Encabezados
        for ($i = 0; $i < count($header); $i++) {
            $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C', true);
        }
        $this->Ln();

        // Restauración de colores y fuentes
        $this->SetFillColor(224, 235, 255);
        $this->SetTextColor(0);
        $this->SetFont('Arial', '', 10);

        // Datos
        $fill = false;
        foreach ($data as $row) {
            $this->Cell($w[0], 6, utf8_decode($row['tabla']), 'LR', 0, 'L', $fill);
            $this->Cell($w[1], 6, utf8_decode($row['operacion']), 'LR', 0, 'L', $fill);
            $this->Cell($w[2], 6, utf8_decode($row['id_registro']), 'LR', 0, 'L', $fill);
            $this->Cell($w[3], 6, utf8_decode($row['usuario_id']), 'LR', 0, 'L', $fill);
            $this->Cell($w[4], 6, utf8_decode($row['rol_usuario']), 'LR', 0, 'L', $fill);
            $this->Cell($w[5], 6, utf8_decode(date('d/m/Y', strtotime($row['fecha']))), 'LR', 0, 'L', $fill);
            
            $this->Ln();
            $fill = !$fill;
        }
        // Línea de cierre
        $this->Cell(array_sum($w), 0, '', 'T');
    }
}

$pdf = new PDF();
$pdf->AddPage();

// Encabezados de la tabla
$header = array('Tabla', 'Operacion', 'ID Registro', 'Usuario', 'Rol de Usuario', 'Fecha');

$data = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

$pdf->AuditTable($header, $data);
$pdf->Output();

$conn->close();
?>
