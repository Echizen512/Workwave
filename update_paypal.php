<?php
session_start();

if (!isset($_SESSION['user_id']) || !isset($_SESSION['role'])) {
    header("Location: login.html");
    exit();
}

include './config/conexion.php';

$userId = $_SESSION['user_id'];  
$paypalAccount = $_POST['paypal_account'] ?? '';
$checkSql = "SELECT * FROM usuarios_paypal WHERE usuario_id = ?";
$checkStmt = $conn->prepare($checkSql);
$checkStmt->bind_param("i", $userId);
$checkStmt->execute();
$checkResult = $checkStmt->get_result();

if ($checkResult->num_rows > 0) {
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

header("Location: perfil.php");
exit();
?>
