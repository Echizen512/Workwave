<?php
session_start();

if (!isset($_SESSION['user_id']) || !isset($_SESSION['role'])) {
    header("Location: login.html");
    exit();
}
include './config/conexion.php';

$comentario = $_POST['comentario'];
$valoracion = $_POST['valoracion'];
$usuario_id = $_SESSION['user_id']; 
$comentario_usuario_id = $_POST['comentario_usuario_id']; 
$comentario_usuario_role = $_POST['comentario_usuario_role']; 

if (empty($comentario) || empty($valoracion) || $valoracion < 1 || $valoracion > 5) {
    echo "Datos inválidos.";
    exit();
}

$sql = "INSERT INTO comentarios_valoraciones (usuario_id, comentario_usuario_id, comentario_usuario_role, comentario, valoracion) 
        VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iissi", $usuario_id, $comentario_usuario_id, $comentario_usuario_role, $comentario, $valoracion);

if ($stmt->execute()) {
    echo "Comentario y valoración guardados correctamente.";
    header("Location: Inicio.php"); 
    exit();
} else {
    echo "Error al guardar el comentario y la valoración: " . $stmt->error;
}
$stmt->close();
$conn->close();
?>
