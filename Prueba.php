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

$sql = "
    SELECT 
        proyectos.id AS proyecto_id, 
        proyectos.titulo AS titulo_proyecto, 
        proyectos.repositorio AS repositorio, 
        proyectos.terminado, 
        proyectos.tipo_usuario, 
        proyectos.contratista_id, 
        proyectos.freelancer_id, 
        proyectos.empresa_id,
        CASE
            WHEN proyectos.tipo_usuario = 'contratistas' THEN proyectos.contratista_id
            WHEN proyectos.tipo_usuario = 'freelancers' THEN proyectos.freelancer_id
            WHEN proyectos.tipo_usuario = 'empresas' THEN proyectos.empresa_id
        END AS propietario_id,
        CASE
            WHEN proyectos.tipo_usuario = 'contratistas' THEN 'contratistas'
            WHEN proyectos.tipo_usuario = 'freelancers' THEN 'freelancers'
            WHEN proyectos.tipo_usuario = 'empresas' THEN 'empresas'
        END AS rol_propietario
    FROM 
        proyectos
    WHERE 
        proyectos.id IN (SELECT proyecto_id FROM usuarios_aceptados WHERE usuario_id = ? AND rol_solicitante = ?)
";

$stmt = $conn->prepare($sql);
$stmt->bind_param("is", $userId, $role);
$stmt->execute();
$result = $stmt->get_result();

$sqlTareas = "
    SELECT 
        id, proyecto_id, descripcion, fecha_registro, completado 
    FROM 
        tareas 
    WHERE 
        proyecto_id = ?
";

$stmtTareas = $conn->prepare($sqlTareas);

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proyectos Aceptados</title>
    <link href="./Assets/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>

    </style>

</head>

<body>
    <?php include './Includes/Header.php'; ?>
    <div class="container mt-5">
        <h2>Proyectos en los que Participas</h2>
        <?php if ($result->num_rows > 0): ?>
            <div class="list-group">
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="card">
                        <div class="card-body">
                            <h5>Proyecto: <?php echo htmlspecialchars($row['titulo_proyecto']); ?></h5>
                            <p><strong>Repositorio:</strong> <?php echo htmlspecialchars($row['repositorio']); ?></p>
                            <p><strong>Estado:</strong> <?php echo ($row['terminado'] == 'Sí') ? 'Terminado' : 'En Proceso'; ?>
                            </p>
                            <a href="ver_perfil.php?usuario_id=<?php echo htmlspecialchars($row['propietario_id']); ?>&rol_solicitante=<?php echo urlencode($row['rol_propietario']); ?>"
                                class="btn btn-info" style="margin: 10px; border-radius: 20px; margin-left: 230px;">
                                <i class="fas fa-user"></i> Ver Perfil
                            </a>
                            <a href="Chat.php?user_id=<?php echo htmlspecialchars($row['propietario_id']); ?>&role=<?php echo htmlspecialchars($row['rol_propietario']); ?>"
                                class="btn btn-primary" style="margin: 10px; border-radius: 20px;">
                                <i class="fas fa-comments"></i> Ir al Chat
                            </a>
                            <button type="button" class="btn btn-warning text-white" style="border-radius: 20px;"
                                data-toggle="modal" data-target="#repositorioModal<?php echo $row['proyecto_id']; ?>"
                                style="margin: 10px;">
                                <i class="fas fa-link"></i> Ingresar Repositorio
                            </button>
                            <div class="modal fade" id="repositorioModal<?php echo $row['proyecto_id']; ?>" tabindex="-1"
                                role="dialog" aria-labelledby="repositorioModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="repositorioModalLabel">Agregar URL del Repositorio</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="actualizar_repositorio.php" method="post">
                                                <input type="hidden" name="proyecto_id"
                                                    value="<?php echo $row['proyecto_id']; ?>">
                                                <div class="form-group">
                                                    <label for="repositorio">URL del Repositorio:</label>
                                                    <input type="url" name="repositorio" class="form-control" required>
                                                </div>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="fas fa-save"></i> Guardar
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-success text-white" style="border-radius: 20px; margin: 10px;"
                                data-toggle="modal" data-target="#tareasModal<?php echo $row['proyecto_id']; ?>">
                                <i class="fas fa-tasks"></i> Ver Tareas
                            </button>
                            <div class="modal fade" id="tareasModal<?php echo $row['proyecto_id']; ?>" tabindex="-1"
                                role="dialog" aria-labelledby="tareasModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="tareasModalLabel">Tareas del Proyecto</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <?php
                                            $stmtTareas->bind_param("i", $row['proyecto_id']);
                                            $stmtTareas->execute();
                                            $resultTareas = $stmtTareas->get_result();
                                            if ($resultTareas->num_rows > 0): ?>
                                                <form action="actualizar_tareas.php" method="post">
                                                    <input type="hidden" name="proyecto_id"
                                                        value="<?php echo $row['proyecto_id']; ?>">
                                                    <ul class="list-group">
                                                        <?php while ($tarea = $resultTareas->fetch_assoc()): ?>
                                                            <li class="list-group-item">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox" name="tareas[]"
                                                                        value="<?php echo $tarea['id']; ?>" <?php echo $tarea['completado'] ? 'checked' : ''; ?>>
                                                                    <label class="form-check-label">
                                                                        <?php echo htmlspecialchars($tarea['descripcion']); ?>
                                                                    </label>
                                                                </div>
                                                            </li>
                                                        <?php endwhile; ?>
                                                    </ul>
                                                    <div class="text-center">
                                                        <button type="submit" class="btn btn-primary mt-3" style="border-radius: 20px;">
                                                            <i class="fas fa-save"></i> Guardar Cambios
                                                        </button>
                                                    </div>
                                                </form>
                                            <?php else: ?>
                                                <p>No hay tareas registradas en este proyecto.</p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <div class="alert alert-info">No tienes proyectos aceptados.</div>
        <?php endif; ?>
    </div>

    <?php
    $stmt->close();
    $stmtTareas->close();
    $conn->close();
    ?>


    <?php include './Includes/Footer.php'; ?>
    <script src="./lib/easing/easing.min.js"></script>
    <script src="./lib/waypoints/waypoints.min.js"></script>
    <script src="./lib/counterup/counterup.min.js"></script>
    <script src="./lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="./mail/jqBootstrapValidation.min.js"></script>
    <script src="./mail/contact.js"></script>
    <script src="./Assets/js/main.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>