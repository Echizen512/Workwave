<?php
session_start();


if (!isset($_SESSION['user_id']) || !isset($_SESSION['role'])) {
    header("Location: login.html");
    exit();
}

include './config/conexion.php';

$userId = $_SESSION['user_id'];
$role = $_SESSION['role'];


if (isset($_POST['proyecto_id'])) {
    $proyectoId = $_POST['proyecto_id'];

    
    $sql = "UPDATE proyectos SET terminado = 'Sí' WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $proyectoId);

    if ($stmt->execute()) {
        
        header("Location: Pagos.php");
        exit();
    } else {
        echo "Error al marcar el proyecto como terminado.";
    }

    $stmt->close();
}

$conn->close();
?>
