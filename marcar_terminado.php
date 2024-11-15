<?php
session_start();

// Verifica si hay una sesión activa
if (!isset($_SESSION['user_id']) || !isset($_SESSION['role'])) {
    header("Location: login.html");
    exit();
}

include './config/conexion.php';

$userId = $_SESSION['user_id'];
$role = $_SESSION['role'];

// Verifica si el ID del proyecto está presente en la solicitud
if (isset($_POST['proyecto_id'])) {
    $proyectoId = $_POST['proyecto_id'];

    // Actualiza el estado del proyecto a 'Sí' (Terminado)
    $sql = "UPDATE proyectos SET terminado = 'Sí' WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $proyectoId);

    if ($stmt->execute()) {
        // Redirige a la página de proyectos si la actualización fue exitosa
        header("Location: Prueba.php");
        exit();
    } else {
        echo "Error al marcar el proyecto como terminado.";
    }

    $stmt->close();
}

$conn->close();
?>
