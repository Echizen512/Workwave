<?php
session_start();
include "../Config/conexion.php";

// Verifica si las variables de sesión están definidas
if (!isset($_SESSION['user_id']) || !isset($_SESSION['role'])) {
    header("location: ./login.html");
    exit();
}

// Obtiene el user_id y role de la sesión
$user_id = $_SESSION['user_id'];
$role = $_SESSION['role'];

// Obtiene los parámetros del formulario
$incoming_id = isset($_POST['incoming_id']) ? mysqli_real_escape_string($conn, $_POST['incoming_id']) : null;
$incoming_role = isset($_POST['incoming_role']) ? mysqli_real_escape_string($conn, $_POST['incoming_role']) : null;
$msg = isset($_POST['msg']) ? mysqli_real_escape_string($conn, $_POST['msg']) : null;

// Validar que los IDs y el mensaje no estén vacíos
if (empty($incoming_id) || empty($incoming_role) || empty($msg)) {
    die("ID, rol o mensaje entrante está vacío.");
}

// Inserción del mensaje en la base de datos
$query = "INSERT INTO messages (outgoing_msg_id, incoming_msg_id, outgoing_role, incoming_role, msg) VALUES ('$user_id', '$incoming_id', '$role', '$incoming_role', '$msg')";
$sql = mysqli_query($conn, $query);

if ($sql) {
    echo "Mensaje enviado.";
} else {
    die("Error al enviar el mensaje: " . mysqli_error($conn));
}
?>
