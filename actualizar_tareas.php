<?php
include './config/conexion.php';

$proyecto_id = $_POST['proyecto_id'];
$tareas_completadas = isset($_POST['tareas']) ? $_POST['tareas'] : [];

if (!empty($tareas_completadas)) {
    $tareas_ids = implode(',', array_map('intval', $tareas_completadas));
    $sqlUpdate = "UPDATE tareas SET completado = IF(id IN ($tareas_ids), 1, 0) WHERE proyecto_id = ?";
    $stmtUpdate = $conn->prepare($sqlUpdate);
    $stmtUpdate->bind_param("i", $proyecto_id);

    if ($stmtUpdate->execute()) {
        // Redirigir a Prueba.php con un mensaje de éxito
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: '¡Éxito!',
                    text: 'Tareas actualizadas exitosamente.',
                    icon: 'success'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'Prueba.php';
                    }
                });
            });
        </script>";
    } else {
        // Redirigir a Prueba.php con un mensaje de error
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Error',
                    text: 'Error al actualizar las tareas.',
                    icon: 'error'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'Prueba.php';
                    }
                });
            });
        </script>";
    }

    $stmtUpdate->close();
} else {
    // No tasks to update
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
    echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: 'Información',
                text: 'No hay tareas seleccionadas para actualizar.',
                icon: 'info'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'Prueba.php';
                }
            });
        });
    </script>";
}

$conn->close();
?>
