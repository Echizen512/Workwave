<?php
ob_start(); // Iniciar el buffer de salida
session_start();

// Verifica si hay una sesión activa
if (!isset($_SESSION['user_id']) || !isset($_SESSION['role'])) {
    header("Location: login.html");
    exit();
}

include './config/conexion.php';

// Solo incluir Header.php si no hay redirección inmediata
include "./Includes/Header.php";

$userId = $_SESSION['user_id'];  
$role = $_SESSION['role'];
$table = "";

// Determinar la tabla según el rol
switch ($role) {
    case 'contratistas':
        $table = "contratistas";
        break;
    case 'empresas':
        $table = "empresas";
        break;
    case 'freelancers':
        $table = "freelancers";
        break;
    default:
        die("Error: Rol no reconocido.");
}

// Preparar y ejecutar la consulta para obtener datos del usuario
$sql = "SELECT * FROM $table WHERE id = ?";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Error al preparar la consulta de usuario: " . $conn->error);
}

$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $userData = $result->fetch_assoc();
} else {
    die("Error: Usuario no encontrado.");
}

// Validar parámetros de membresía
if (empty($_GET['membership_type']) || empty($_GET['amount'])) {
    die("Error: Falta información sobre la membresía (tipo o cantidad).");
}

$membershipType = htmlspecialchars($_GET['membership_type']); // Escapar para evitar inyecciones XSS
$amount = floatval($_GET['amount']); // Asegurarse de que sea un número válido

if ($amount <= 0) {
    die("Error: Cantidad inválida para la membresía.");
}

// Fechas
$purchaseDate = date('Y-m-d');
$expirationDate = date('Y-m-d', strtotime('+1 month', strtotime($purchaseDate)));

// Insertar compra de membresía
$sql = "INSERT INTO membership_purchases (user_id, membership_type, purchase_date, expiration_date, amount, payment_status, role)
        VALUES (?, ?, ?, ?, ?, 'completed', ?)";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Error al preparar consulta para insertar membresía: " . $conn->error);
}

$stmt->bind_param("isssds", $userId, $membershipType, $purchaseDate, $expirationDate, $amount, $role);

if ($stmt->execute()) {
    // Actualizar tabla de usuarios
    $updateSql = "UPDATE $table SET membership_type = ?, membership_start_date = ?, membership_end_date = ? WHERE id = ?";
    $updateStmt = $conn->prepare($updateSql);

    if (!$updateStmt) {
        die("Error al preparar consulta para actualizar la tabla $table: " . $conn->error);
    }

    $updateStmt->bind_param("sssi", $membershipType, $purchaseDate, $expirationDate, $userId);

    if ($updateStmt->execute()) {
        $_SESSION['message'] = "Membresía adquirida con éxito!";
        $_SESSION['message_type'] = "success";
    } else {
        die("Error al actualizar la tabla $table: " . $updateStmt->error);
    }

    $updateStmt->close();
} else {
    die("Error al registrar la membresía: " . $stmt->error);
}

// Cerrar conexiones
$stmt->close();
$conn->close();

header('Location: Membresias.php');
exit();

?>
