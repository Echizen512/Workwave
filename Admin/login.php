<?php
session_start();
include '../config/conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = $_POST['usuario'];
    $contraseña = $_POST['contraseña'];

    // Verificar el usuario y la contraseña
    $stmt = $conn->prepare("SELECT ID, Contraseña FROM Administradores WHERE Usuario = ?");
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $hashedPassword);
        $stmt->fetch();

        // Verificar la contraseña
        if (password_verify($contraseña, $hashedPassword)) {
            $_SESSION['admin_id'] = $id;
            header("Location: Empresas.php");
            exit();
        } else {
            echo "<div class='alert alert-danger text-center'>Contraseña incorrecta.</div>";
        }
    } else {
        echo "<div class='alert alert-danger text-center'>Usuario no encontrado.</div>";
    }

    $stmt->close();
}
$conn->close();
?>
