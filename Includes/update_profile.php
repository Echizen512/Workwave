<?php
session_start();

if (!isset($_SESSION['user_id']) || !isset($_SESSION['role'])) {
    header("Location: ../login.html");
    exit();
}

include '../config/conexion.php';

$userId = $_SESSION['user_id'];  
$role = $_SESSION['role'];
$table = "";

if ($role === 'contratistas') {
    $table = "contratistas";
} elseif ($role === 'empresas') {
    $table = "empresas";
} elseif ($role === 'freelancers') {
    $table = "freelancers"; 
} else {
    die("Role not recognized");
}

$nombre_campo = ($role === 'empresas') ? 'nombre_empresa' : 'nombre';

$nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : '';
$email = isset($_POST['email']) ? trim($_POST['email']) : '';
$telefono = isset($_POST['telefono']) ? trim($_POST['telefono']) : '';
$direccion = isset($_POST['direccion']) ? trim($_POST['direccion']) : '';
$image_url = isset($_POST['image_url']) ? trim($_POST['image_url']) : '';

$sql = "UPDATE $table SET $nombre_campo = ?, email = ?, telefono = ?, direccion = ?, image_url = ? WHERE id = ?";

$stmt = $conn->prepare($sql);

$stmt->bind_param("sssssi", $nombre, $email, $telefono, $direccion, $image_url, $userId);

if ($stmt->execute()) {
    header("Location: ../Perfil.php?status=success");
} else {
    echo "Error al actualizar los datos: " . $conn->error;
}

$stmt->close();
$conn->close();
?>
