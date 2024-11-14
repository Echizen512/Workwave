<?php
session_start();

// Verifica si hay una sesión activa
if (!isset($_SESSION['user_id']) || !isset($_SESSION['role'])) {
    header("Location: login.html");
    exit();
}

include './config/conexion.php';

// Obtener el ID del usuario y la cuenta PayPal desde el formulario
$userId = $_SESSION['user_id'];  
$paypalAccount = $_POST['paypal_account'] ?? '';

// Verificar si la cuenta PayPal ya existe para el usuario
$checkSql = "SELECT * FROM usuarios_paypal WHERE usuario_id = ?";
$checkStmt = $conn->prepare($checkSql);
$checkStmt->bind_param("i", $userId);
$checkStmt->execute();
$checkResult = $checkStmt->get_result();

if ($checkResult->num_rows > 0) {
    // Si ya existe, hacer un UPDATE
    $updateSql = "UPDATE usuarios_paypal SET cuenta_paypal = ? WHERE usuario_id = ?";
    $updateStmt = $conn->prepare($updateSql);
    $updateStmt->bind_param("si", $paypalAccount, $userId);
    if ($updateStmt->execute()) {
        echo "Cuenta PayPal actualizada exitosamente.";
    } else {
        echo "Error al actualizar la cuenta PayPal.";
    }
    $updateStmt->close();
} else {
    // Si no existe, hacer un INSERT
    $insertSql = "INSERT INTO usuarios_paypal (usuario_id, cuenta_paypal) VALUES (?, ?)";
    $insertStmt = $conn->prepare($insertSql);
    $insertStmt->bind_param("is", $userId, $paypalAccount);
    if ($insertStmt->execute()) {
        echo "Cuenta PayPal registrada exitosamente.";
    } else {
        echo "Error al registrar la cuenta PayPal.";
    }
    $insertStmt->close();
}

$checkStmt->close();
$conn->close();

// Redirigir al perfil del usuario después de la actualización
header("Location: perfil.php");
exit();
?>
