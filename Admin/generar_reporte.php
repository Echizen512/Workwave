<?php 
require('fpdf186/fpdf.php');

// Conexión a la base de datos
$conexion = new mysqli('localhost', 'root', '', 'WorkWave');
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Tipo de reporte recibido por POST
$tipo_reporte = $_POST['tipo_reporte'] ?? '';

// Validar tipo de reporte
if (empty($tipo_reporte)) {
    die("No se recibió el tipo de reporte. Verifica tu formulario.");
}

class PDF extends FPDF {
    private $tipo_reporte;

    // Constructor para recibir el tipo de reporte
    public function __construct($tipo_reporte) {
        parent::__construct();
        $this->tipo_reporte = !empty($tipo_reporte) ? ucfirst($tipo_reporte) : "Desconocido";
    }

    // Encabezado del PDF
    function Header() {
        $this->SetFillColor(0, 102, 204); 
        $this->SetTextColor(255, 255, 255); 
        $this->SetFont('Arial', 'B', 20);

        $titulo = 'WorkWave - Reporte de ' . $this->tipo_reporte;


        $this->Cell(0, 12, utf8_decode($titulo), 0, 1, 'C', true);
        $this->Ln(5);
    }

    // Pie de página del PDF
    function Footer() {
        $this->SetY(-25); 
        $this->SetFont('Arial', 'I', 10);
        $this->SetTextColor(0, 102, 204); 
        $this->Cell(0, 10, 'Página ' . $this->PageNo(), 0, 0, 'C');
        $this->Ln();
        $this->SetFont('Arial', '', 8);
        $this->Cell(0, 10, 'Generado por WorkWave - ' . date('d/m/Y H:i:s'), 0, 0, 'C');
    }
}

// Configuración del reporte según el tipo
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
        $widths = [25, 75, 30, 30, 30]; 
        break;

    default:
        die("Tipo de reporte no válido.");
}

// Obtener los datos
$resultado = $conexion->query($query);

if ($resultado->num_rows > 0) {
    $pdf = new PDF($tipo_reporte);
    $pdf->AddPage();
    $pdf->SetFont('Arial', '', 10);

    // Encabezados de tabla
    $pdf->SetFillColor(200, 220, 255); 
    $pdf->SetTextColor(0, 0, 0);
    foreach ($columnas as $index => $columna) {
        $pdf->Cell($widths[$index], 10, utf8_decode($columna), 1, 0, 'C', true);
    }
    $pdf->Ln();

    // Filas de datos
    while ($fila = $resultado->fetch_assoc()) {
        foreach ($columnas as $index => $columna) {
            // Diferenciamos el mapeo de cada reporte
            $campo = match ($columna) {
                'Tipo Usuario' => 'tipo_usuario',
                'Título' => 'titulo',
                'Precio' => 'precio',
                'Inicio' => 'fecha_inicio',
                'Fin' => 'fecha_fin',
                'Nombre Empresa' => 'nombre_empresa',
                'Teléfono' => 'telefono',
                'Dirección' => 'direccion',
                default => strtolower(str_replace(' ', '_', $columna))
            };

            // Limitar los caracteres de $campo a 30
            if (strlen($fila[$campo] ?? '') > 40) {
                $fila[$campo] = substr($fila[$campo] ?? '', 0, 40) . '...';
            }

            // Formatear las fechas
            if (in_array($columna, ['Inicio', 'Fin']) && isset($fila[$campo])) {
                $fecha = DateTime::createFromFormat('Y-m-d', $fila[$campo]);
                if ($fecha) {
                    $fila[$campo] = $fecha->format('d/m/Y');
                }
            }

            $pdf->Cell($widths[$index], 10, utf8_decode($fila[$campo] ?? ''), 1);
        }
        $pdf->Ln();
    }

    // Resumen
    $pdf->Ln(10);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0, 10, 'Resumen del Reporte', 0, 1, 'C');
    $pdf->SetFont('Arial', '', 10);
    $totalRegistros = $resultado->num_rows;
    $pdf->Cell(0, 10, "Total de Registros: $totalRegistros", 0, 1, 'C');

    $pdf->Output();
} else {
    echo "No se encontraron registros para este reporte.";
}

$conexion->close();
?>
