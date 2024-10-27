<?php
require('fpdf186/fpdf.php');

// Configuración de conexión a la base de datos
$conexion = new mysqli('localhost', 'root', '', 'WorkWave');

// Verificar conexión
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Recuperar el tipo de reporte seleccionado
$tipo_reporte = $_POST['tipo_reporte'];

// Crear la clase PDF
class PDF extends FPDF {
    // Encabezado
    function Header() {
        $this->SetFillColor(0, 102, 204); // Azul oscuro
        $this->SetTextColor(255, 255, 255); // Blanco
        $this->SetFont('Arial', 'B', 20);
        $this->Cell(0, 12, 'WorkWave - Reporte de ' . ucfirst($GLOBALS['tipo_reporte']), 0, 1, 'C', true);
        $this->Ln(5);
    }

    // Pie de página
    function Footer() {
        $this->SetY(-25); // Elevar el footer
        $this->SetFont('Arial', 'I', 10);
        $this->SetTextColor(0, 102, 204); // Azul
        $this->Cell(0, 10, 'Página ' . $this->PageNo(), 0, 0, 'C');
        $this->Ln();
        $this->SetFont('Arial', '', 8);
        $this->Cell(0, 10, 'Generado por WorkWave - ' . date('d/m/Y H:i:s'), 0, 0, 'C');
    }
}

// Configuración de reportes y columnas
switch ($tipo_reporte) {
    case 'contratistas':
        $query = "SELECT nombre, email, telefono, direccion FROM contratistas";
        $columnas = ['Nombre', 'Email', 'Teléfono', 'Dirección'];
        $widths = [50, 60, 30, 50];
        break;

    case 'empresas':
        $query = "SELECT nombre_empresa, email, telefono, direccion FROM empresas";
        $columnas = ['Nombre Empresa', 'Email', 'Teléfono', 'Dirección'];
        $widths = [50, 60, 30, 50];
        break;

    case 'freelancers':
        $query = "SELECT nombre, email, telefono, direccion FROM freelancers";
        $columnas = ['Nombre', 'Email', 'Teléfono', 'Dirección'];
        $widths = [50, 60, 30, 50];
        break;

    case 'proyectos':
        $query = "SELECT tipo_usuario, titulo, precio, fecha_inicio, fecha_fin FROM proyectos";
        $columnas = ['Tipo Usuario', 'Título', 'Precio', 'Inicio', 'Fin'];
        $widths = [25, 75, 30, 30, 30]; // Ancho de las columnas
        break;

    default:
        die("Tipo de reporte no válido.");
}

// Ejecutar consulta
$resultado = $conexion->query($query);

// Verificar que existan registros
if ($resultado->num_rows > 0) {
    $pdf = new PDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', '', 10);

    // Encabezado de columnas
    $pdf->SetFillColor(200, 220, 255); // Azul claro
    $pdf->SetTextColor(0, 0, 0);
    foreach ($columnas as $index => $columna) {
        $pdf->Cell($widths[$index], 10, utf8_decode($columna), 1, 0, 'C', true);
    }
    $pdf->Ln();

    // Imprimir datos de cada fila
    while ($fila = $resultado->fetch_assoc()) {
        for ($i = 0; $i < count($columnas); $i++) {
            // Ajustar el mapeo dinámico del nombre de columna para los campos específicos
            $campo = match ($columnas[$i]) {
                'Nombre Empresa' => 'nombre_empresa',
                'Teléfono' => 'telefono',
                'Dirección' => 'direccion',
                default => strtolower(str_replace(' ', '_', $columnas[$i]))
            };
            $pdf->Cell($widths[$i], 10, utf8_decode($fila[$campo] ?? ''), 1);
        }
        $pdf->Ln();
    }

    // Resumen al final del reporte
    $pdf->Ln(10);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0, 10, 'Resumen del Reporte', 0, 1, 'C');
    $pdf->SetFont('Arial', '', 10);
    $totalRegistros = $resultado->num_rows;
    $pdf->Cell(0, 10, "Total de Registros: $totalRegistros", 0, 1, 'C');

    // Información adicional
    $pdf->Ln(10);
    $pdf->SetFont('Arial', 'I', 10);
    $pdf->MultiCell(0, 10, "Este reporte ha sido generado con el fin de proporcionar una vision general de los datos disponibles y facilitar la toma de decisiones.", 0, 'C');

    $pdf->Output();
} else {
    echo "No se encontraron registros para este reporte.";
}

// Cerrar conexión
$conexion->close();
?>
