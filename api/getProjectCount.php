<?php 
session_start();

// Verifica si hay una sesión activa
if (!isset($_SESSION['user_id']) || !isset($_SESSION['role'])) {
    header("Location: login.html");
    exit();
}

// Incluir la conexión a la base de datos
include '../Config/conexion.php'; // Ajusta la ruta a tu archivo de conexión

$userId = $_SESSION['user_id'];
$role = $_SESSION['role'];

// Determinar la columna de usuario según el rol
$userColumn = "";

if ($role === 'contratistas') {
    $userColumn = 'contratista_id';
} elseif ($role === 'empresas') {
    $userColumn = 'empresa_id';
} elseif ($role === 'freelancers') {
    $userColumn = 'freelancer_id';
} else {
    die("Role not recognized");
}

// Usar la tabla "proyectos"
$table = "proyectos";

// Preparar la consulta para contar los proyectos del usuario
$sql = "SELECT COUNT(*) AS projectCount FROM $table WHERE $userColumn = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userId); // Vinculamos el parámetro de tipo entero (i)
$stmt->execute();
$result = $stmt->get_result();

// Verificamos si la consulta se ejecutó correctamente
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $projectCount = $row['projectCount'];
    // Devolver la respuesta como JSON
    echo json_encode(['projectCount' => $projectCount]);
} else {
    echo json_encode(['error' => 'No se encontraron proyectos']);
}

$stmt->close();
?>
