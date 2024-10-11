<?php
include './config/conexion.php';

if (isset($_GET['proyecto_id']) && isset($_GET['usuario_id'])) {
    $proyecto_id = $_GET['proyecto_id'];
    $usuario_id = $_GET['usuario_id'];

    // Eliminar la solicitud del interesado
    $sql = "DELETE FROM interesados_proyecto WHERE id_proyecto = ? AND usuario_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $proyecto_id, $usuario_id);

    if ($stmt->execute()) {
        header("Location: Solicitudes.php?deleted=1");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>
