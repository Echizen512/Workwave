<?php
session_start();

// Verifica si hay una sesión activa
if (!isset($_SESSION['user_id']) || !isset($_SESSION['role'])) {
    header("Location: login.html");
    exit();
}

include './config/conexion.php';

// Recibe los datos del formulario
$comentario = $_POST['comentario'];
$valoracion = $_POST['valoracion'];
$usuario_id = $_SESSION['user_id']; // ID del usuario que deja el comentario
$comentario_usuario_id = $_POST['comentario_usuario_id']; // ID del usuario sobre el que se comenta
$comentario_usuario_role = $_POST['comentario_usuario_role']; // Rol del usuario sobre el que se comenta

// Validación básica de los datos
if (empty($comentario) || empty($valoracion) || $valoracion < 1 || $valoracion > 5) {
    echo "Datos inválidos.";
    exit();
}

// Preparar la consulta SQL para insertar el comentario y valoración
$sql = "INSERT INTO comentarios_valoraciones (usuario_id, comentario_usuario_id, comentario_usuario_role, comentario, valoracion) 
        VALUES (?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("iissi", $usuario_id, $comentario_usuario_id, $comentario_usuario_role, $comentario, $valoracion);

// Ejecutar la consulta
if ($stmt->execute()) {
    echo "Comentario y valoración guardados correctamente.";
    header("Location: perfil.php?usuario_id=$comentario_usuario_id&rol_solicitante=$comentario_usuario_role"); // Redirige al perfil
    exit();
} else {
    echo "Error al guardar el comentario y la valoración: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
