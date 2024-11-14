<?php
session_start();

// Verifica si hay una sesión activa
if (!isset($_SESSION['user_id']) || !isset($_SESSION['role'])) {
    header("Location: login.html");
    exit();
}

include './config/conexion.php';
include "./Includes/Header.php";

$userId = isset($_GET['usuario_id']) ? intval($_GET['usuario_id']) : 0;
$userRole = isset($_GET['rol_solicitante']) ? $_GET['rol_solicitante'] : '';

if (!$userId || !$userRole) {
    die("Invalid user ID or role.");
}

$table = "";

if ($userRole === 'contratistas') {
    $table = "contratistas";
} elseif ($userRole === 'empresas') {
    $table = "empresas";
} elseif ($userRole === 'freelancers') {
    $table = "freelancers";
} else {
    die("Role not recognized");
}

// Preparar y ejecutar la consulta para obtener los datos del usuario
$sql = "SELECT * FROM $table WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $userData = $result->fetch_assoc();
} else {
    echo "No user found.";
    exit();
}

// Preparar y ejecutar la consulta para obtener los comentarios
$sqlComments = "SELECT * FROM comentarios_valoraciones WHERE comentario_usuario_id = ? AND comentario_usuario_role = ?";
$stmtComments = $conn->prepare($sqlComments);
$stmtComments->bind_param("is", $userId, $userRole);
$stmtComments->execute();
$resultComments = $stmtComments->get_result();

// Función para formatear la fecha
function formatDate($date)
{
    return date("d-m-Y", strtotime($date)); // Formato Día-Mes-Año
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Profile View</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">


    <style type="text/css">
        .card {
            position: relative;
            display: flex;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 0 solid transparent;
            border-radius: .25rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 2px 6px 0 rgb(218 218 253 / 65%), 0 2px 6px 0 rgb(206 206 238 / 54%);
        }

        .me-2 {
            margin-right: .5rem !important;
        }
    </style>
</head>

<body>
    <br><br>
    <div class="container">
        <div class="main-body">
            <div class="row">
                <!-- Recuadro de información del usuario (izquierda) -->
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-column align-items-center text-center">
                                <?php
                                $imageURL = $userData['image_url'] ?? "https://bootdey.com/img/Content/avatar/avatar6.png";
                                ?>
                                <img src="<?php echo htmlspecialchars($imageURL); ?>" alt="Profile Image"
                                    class="rounded-circle p-1 bg-primary" width="110">
                                <div class="mt-3">
                                    <h4><?php echo htmlspecialchars($userRole === 'empresas' ? $userData['nombre_empresa'] : $userData['nombre']); ?>
                                    </h4>
                                    <p class="text-secondary mb-1">
                                        <?php echo $userRole === 'empresas' ? htmlspecialchars($userData['nombre_empresa']) : 'Usuario'; ?>
                                    </p>
                                    <p class="text-muted font-size-sm">
                                        <?php echo htmlspecialchars($userData['direccion']); ?>
                                    </p>
                                    <button class="btn btn-outline-primary"
                                        onclick="location.href='Chat.php?user_id=<?php echo $userId; ?>&role=<?php echo $userRole; ?>'">Mensaje</button>
                                    <!-- Botón para abrir el Modal -->
                                    <button class="btn btn-outline-info" data-toggle="modal"
                                        data-target="#comentarioModal">Dejar Comentario</button>
                                </div>
                            </div>
                            <hr class="my-4">
                            <!-- Botones de descarga de documentos -->
                            <div class="d-flex justify-content-around">
                                <?php if (!empty($userData['curriculum']) && file_exists($_SERVER['DOCUMENT_ROOT'] . "/Anderson/Assets/doc/" . basename($userData['curriculum']))): ?>
                                    <a href="/Anderson/Assets/doc/<?php echo basename($userData['curriculum']); ?>"
                                        class="btn btn-success me-2" download>Descargar Currículum</a>
                                <?php endif; ?>
                                <?php if (!empty($userData['doc_rif']) && file_exists($_SERVER['DOCUMENT_ROOT'] . "/Anderson/Assets/doc/" . basename($userData['doc_rif']))): ?>
                                    <a href="/Anderson/Assets/doc/<?php echo basename($userData['doc_rif']); ?>"
                                        class="btn btn-success me-2" download>Descargar RIF</a>
                                <?php endif; ?>
                            </div>

                            <ul class="list-group list-group-flush mt-4">
                                <?php if ($userRole === 'contratistas' || $userRole === 'freelancers'): ?>
                                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                        <h6 class="mb-0">Portafolio</h6>
                                        <span
                                            class="text-secondary"><?php echo htmlspecialchars($userData['portafolio'] ?? 'N/A'); ?></span>
                                    </li>
                                <?php elseif ($userRole === 'empresas'): ?>
                                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                        <h6 class="mb-0">Página Web</h6>
                                        <span
                                            class="text-secondary"><?php echo htmlspecialchars($userData['sitio_web'] ?? 'N/A'); ?></span>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Recuadro de información de usuario (derecha) - Contiene los detalles de Nombre, Email, etc. -->
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Nombre</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <p><?php echo htmlspecialchars($userRole === 'empresas' ? $userData['nombre_empresa'] : $userData['nombre']); ?>
                                    </p>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Email</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <p><?php echo htmlspecialchars($userData['email']); ?></p>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Teléfono</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <p><?php echo htmlspecialchars($userData['telefono']); ?></p>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Dirección</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <p><?php echo htmlspecialchars($userData['direccion']); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recuadro de "Comentarios y Valoraciones" debajo del recuadro de información del usuario -->
                <div class="col-lg-12 mt-4">
                    <div class="card">
                        <div class="card-body">
                            <h5><i class="fas fa-comments me-2"></i>Comentarios y Valoraciones</h5>
                            <?php if ($resultComments->num_rows > 0): ?>
                                <?php while ($comment = $resultComments->fetch_assoc()): ?>
                                    <?php
                                    // Obtener el nombre del usuario que hizo el comentario
                                    $commenterName = '';
                                    if ($comment['comentario_usuario_role'] === 'contratistas') {
                                        // Obtener el nombre del contratista
                                        $sqlUser = "SELECT nombre FROM contratistas WHERE id = ?";
                                    } elseif ($comment['comentario_usuario_role'] === 'freelancers') {
                                        // Obtener el nombre del freelancer
                                        $sqlUser = "SELECT nombre FROM freelancers WHERE id = ?";
                                    } elseif ($comment['comentario_usuario_role'] === 'empresas') {
                                        // Obtener el nombre de la empresa
                                        $sqlUser = "SELECT nombre_empresa FROM empresas WHERE id = ?";
                                    } else {
                                        $commenterName = "Desconocido";
                                    }

                                    // Ejecutar la consulta
                                    $stmtUser = $conn->prepare($sqlUser);
                                    $stmtUser->bind_param("i", $comment['comentario_usuario_id']);
                                    $stmtUser->execute();
                                    $resultUser = $stmtUser->get_result();

                                    if ($resultUser->num_rows > 0) {
                                        $user = $resultUser->fetch_assoc();
                                        $commenterName = $user['nombre'] ?? $user['nombre_empresa'];
                                    }
                                    ?>
                                    <div class="card mt-3">
                                        <div class="card-body">
                                            <!-- Título con nombre del comentarista -->
                                            <h6 class="card-title">
                                                <i
                                                    class="fas fa-user-circle me-2"></i><?php echo htmlspecialchars($commenterName . " (" . $comment['comentario_usuario_role'] . ")"); ?>
                                            </h6>
                                            <p class="card-text"><?php echo nl2br(htmlspecialchars($comment['comentario'])); ?>
                                            </p>
                                            <p class="card-text"><strong>Valoración:</strong>
                                                <?php echo $comment['valoracion']; ?>/5</p>
                                            <p class="card-text"><small class="text-muted">Fecha:
                                                    <?php echo formatDate($comment['fecha']); ?></small></p>
                                        </div>
                                    </div>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <p>No hay comentarios o valoraciones para este usuario.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- Modal para Comentario y Valoración -->
    <div class="modal fade" id="comentarioModal" tabindex="-1" role="dialog" aria-labelledby="comentarioModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="comentarioModalLabel">Dejar Comentario y Valoración</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="guardar_comentario.php" method="POST">
                        <div class="form-group">
                            <label for="comentario">Comentario:</label>
                            <textarea class="form-control" id="comentario" name="comentario" rows="3"
                                required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="valoracion">Valoración (1 a 5):</label>
                            <select class="form-control" id="valoracion" name="valoracion" required>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </div>
                        <input type="hidden" name="usuario_id" value="<?php echo $_SESSION['user_id']; ?>">
                        <input type="hidden" name="comentario_usuario_id" value="<?php echo $userId; ?>">
                        <!-- ID del usuario sobre el que se comenta -->
                        <input type="hidden" name="comentario_usuario_role" value="<?php echo $userRole; ?>">
                        <!-- Rol del usuario sobre el que se comenta -->
                        <button type="submit" class="btn btn-primary">Enviar Comentario</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <?php include "./Includes/Footer.php"; ?>

    <!-- Bootstrap JS for Modal -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    
</body>

</html>