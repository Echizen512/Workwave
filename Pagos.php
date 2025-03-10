<?php
session_start();
include './config/conexion.php';

if (!isset($_SESSION['user_id']) || !isset($_SESSION['role'])) {
    header("Location: login.html");
    exit();
}

$user_id = $_SESSION['user_id'];
$tipo_usuario = $_SESSION['role'];

switch ($tipo_usuario) {
    case 'contratistas':
        $user_column = 'contratista_id';
        break;
    case 'freelancers':
        $user_column = 'freelancer_id';
        break;
    case 'empresas':
        $user_column = 'empresa_id';
        break;
    default:
        die("Tipo de usuario no reconocido.");
}

$sql = "SELECT * FROM proyectos WHERE $user_column = ?";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die("Error en la preparación de la consulta: " . $conn->error);
}

$stmt->bind_param("i", $user_id);

if (!$stmt->execute()) {
    die("Error en la ejecución de la consulta: " . $stmt->error);
}

$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Proyectos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
    .modal-header {
        background-color: #007bff;
        color: #fff;
    }

    .task-completed {
        color: green;
    }

    .task-pending {
        color: red;
    }

    .thead-blue th {
        background-color: #007bff;
        color: #fff;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }

    @keyframes slideIn {
        from {
            transform: translateY(-20px);
        }

        to {
            transform: translateY(0);
        }
    }

    @keyframes bounceIn {
        from {
            transform: scale(0.9);
            opacity: 0.5;
        }

        to {
            transform: scale(1);
            opacity: 1;
        }
    }

    .container {
        animation: fadeIn 1s ease-in-out;
    }

    .card {
        animation: slideIn 1s ease-in-out;
    }

    .card-header {
        animation: bounceIn 1s ease-in-out;
    }

    .table {
        animation: fadeIn 1s ease-in-out;
    }

    .table tbody tr {
        animation: slideIn 0.5s ease-in-out;
    }

    .modal-content {
        animation: bounceIn 0.5s ease-in-out;
    }

    .btn {
        transition: background-color 0.3s ease, transform 0.3s ease;
    }

    .btn:hover {
        transform: scale(1.05);
    }
    </style>
</head>

<body>
    <?php include './Includes/Header.php'; ?>

    <div class="container mt-5">
        <h2>Proyectos Publicados</h2>
        <?php if ($result->num_rows > 0): ?>
        <table class="table table-bordered">
            <thead class="thead-blue">
                <tr>
                    <th class="text-center">Título</th>
                    <th class="text-center">Descripción</th>
                    <th class="text-center">Precio</th>
                    <th class="text-center">Repositorio</th>
                    <th class="text-center">Terminado</th>
                    <th class="text-center">Pago</th>
                    <th class="text-center">Documento</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td class="text-center"><?php echo htmlspecialchars($row['titulo']); ?></td>
                    <td class="text-center"><?php echo htmlspecialchars($row['descripcion']); ?></td>
                    <td class="text-center"><?php echo htmlspecialchars($row['precio'] . '$'); ?></td>
                    <td class="text-center"><?php echo htmlspecialchars($row['repositorio']); ?></td>
                    <td class="text-center"><?php echo htmlspecialchars($row['terminado']); ?></td>
                    <td class="text-center"><?php echo htmlspecialchars($row['pago']); ?></td>
                    <td class="text-center">
                        <form action="generar_reporte.php" method="POST">
                            <input type="hidden" name="proyecto_id" value="<?php echo $row['id']; ?>">
                            <button type="submit" class="btn btn-danger btn-sm"
                                style="margin: 10px; border-radius: 20px;">
                                <i class="fas fa-file-alt"></i> Generar Reporte
                            </button>
                        </form>
                    </td>
                    <td class="text-center">
                        <?php if ($row['terminado'] != 'Sí'): ?>
                        <!-- Formulario para Marcar Proyecto como Terminado -->
                        <form action="marcar_terminado.php" method="POST">
                            <input type="hidden" name="proyecto_id" value="<?php echo $row['id']; ?>">
                            <button type="submit" class="btn btn-success btn-sm"
                                style="margin: 10px; border-radius: 20px;">
                                <i class="fas fa-check-circle"></i> Marcar como Terminado
                            </button>
                        </form>
                        <?php else: ?>
                        <button class="btn btn-success" style="border-radius: 20px;" disabled>Terminado</button>
                        <?php endif; ?>

                        <?php if ($row['pago'] == 'Pendiente'): ?>
                        <form action="procesar_pago.php" method="POST" style="margin-top: 10px;">
                            <input type="hidden" name="proyecto_id" value="<?php echo $row['id']; ?>">
                            <input type="hidden" name="monto" value="<?php echo $row['precio']; ?>">
                            <button type="submit" class="btn btn-primary" style="border-radius: 20px;">Pagar</button>
                        </form>
                        <?php else: ?>
                        <button class="btn btn-success" style="margin: 10px;" disabled>Pagado</button>
                        <?php endif; ?>

                        <!-- Botón para abrir el modal de tareas -->
                        <button type="button" class="btn btn-info" style="margin: 10px; border-radius: 20px;"
                            data-toggle="modal" data-target="#tareasModal<?php echo $row['id']; ?>">
                            Ver Tareas
                        </button>

                        <!-- Modal de tareas -->
                        <div class="modal fade" id="tareasModal<?php echo $row['id']; ?>" tabindex="-1" role="dialog"
                            aria-labelledby="tareasModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-white" id="tareasModalLabel">Tareas del Proyecto
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Descripción</th>
                                                    <th>Estado</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                        $sqlTareas = "SELECT `id`, `proyecto_id`, `descripcion`, `fecha_registro`, `completado` FROM `tareas` WHERE `proyecto_id` = ?";
                                                        $stmtTareas = $conn->prepare($sqlTareas);
                                                        $stmtTareas->bind_param("i", $row['id']);
                                                        $stmtTareas->execute();
                                                        $resultTareas = $stmtTareas->get_result();

                                                        while ($tarea = $resultTareas->fetch_assoc()): ?>
                                                <tr>
                                                    <td><?php echo htmlspecialchars($tarea['descripcion']); ?></td>
                                                    <td
                                                        class="<?php echo $tarea['completado'] ? 'task-completed' : 'task-pending'; ?>">
                                                        <?php echo $tarea['completado'] ? 'Terminada' : 'Por Terminar'; ?>
                                                    </td>

                                                </tr>
                                                <?php endwhile; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <?php else: ?>
        <div class="alert alert-info">No tienes proyectos publicados.</div>
        <?php endif; ?>
    </div>

    <?php include './Includes/Footer.php'; ?>

    <?php
    $stmt->close();
    $conn->close();
    ?>

</body>

</html>