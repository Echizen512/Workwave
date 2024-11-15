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

// Verifica si el ID del proyecto y la URL del repositorio están presentes en la solicitud
if (isset($_POST['proyecto_id']) && isset($_POST['repositorio'])) {
    $proyectoId = $_POST['proyecto_id'];
    $repositorio = $_POST['repositorio'];

    // Actualiza la URL del repositorio del proyecto
    $sql = "UPDATE proyectos SET repositorio = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $repositorio, $proyectoId);

    if ($stmt->execute()) {
        // Redirige a la página de proyectos si la actualización fue exitosa
        header("Location: Prueba.php");
        exit();
    } else {
        echo "Error al actualizar el repositorio.";
    }

    $stmt->close();
}

$conn->close();
?>
