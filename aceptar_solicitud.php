<?php
include './config/conexion.php';

if (isset($_GET['proyecto_id']) && isset($_GET['usuario_id'])) {
    $proyecto_id = $_GET['proyecto_id'];
    $usuario_id = $_GET['usuario_id'];

    // Obtener la información del interesado
    $sql_interesado = "SELECT nombre_interesado, email_interesado, telefono_interesado, rol_solicitante FROM interesados_proyecto WHERE usuario_id = ? AND id_proyecto = ?";
    $stmt_interesado = $conn->prepare($sql_interesado);
    $stmt_interesado->bind_param("ii", $usuario_id, $proyecto_id);
    $stmt_interesado->execute();
    $result = $stmt_interesado->get_result();

    if ($result->num_rows > 0) {
        $interesado = $result->fetch_assoc();

        // Actualizar el estado del proyecto a 0 (aceptado)
        $sql = "UPDATE proyectos SET estado = 0 WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $proyecto_id);

        if ($stmt->execute()) {
            // Guardar el usuario aceptado en la tabla de usuarios aceptados
            $sql_insert = "INSERT INTO usuarios_aceptados (proyecto_id, nombre_interesado, email_interesado, telefono_interesado, rol_solicitante, usuario_id) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt_insert = $conn->prepare($sql_insert);
            $stmt_insert->bind_param("issssi", $proyecto_id, $interesado['nombre_interesado'], $interesado['email_interesado'], $interesado['telefono_interesado'], $interesado['rol_solicitante'], $usuario_id);
            $stmt_insert->execute();

            header("Location: Solicitudes.php?success=1");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }
    } else {
        echo "No se encontró el interesado.";
    }
}
?>