<?php
include './config/conexion.php';
session_start();

// Verificar que el usuario está autenticado
if (!isset($_SESSION['user_id']) || !isset($_SESSION['role'])) {
    header("Location: login.html");
    exit();
}

$user_id = $_SESSION['user_id'];
$role = $_SESSION['role'];

$proyecto_id = intval($_GET['id']);
$nombre_proyecto = "";
$creador_id = 0;
$tipo_usuario_creador = '';

$stmt = $conn->prepare("SELECT titulo, tipo_usuario, contratista_id, freelancer_id, empresa_id FROM proyectos WHERE id = ?");
$stmt->bind_param('i', $proyecto_id);
$stmt->execute();
$result = $stmt->get_result();
if ($row = $result->fetch_assoc()) {
    $nombre_proyecto = $row['titulo'];
    $tipo_usuario_creador = $row['tipo_usuario'];
    $creador_id = match($tipo_usuario_creador) {
        'contratistas' => $row['contratista_id'],
        'freelancers' => $row['freelancer_id'],
        'empresas' => $row['empresa_id'],
        default => 0,
    };
}
$stmt->close();

// Identificar la tabla de origen según el rol
$table = match ($role) {
    'contratistas' => 'contratistas',
    'empresas' => 'empresas',
    'freelancers' => 'freelancers',
    default => throw new Exception('Role not recognized'),
};

// Obtener la información del usuario logueado
$sql = "SELECT * FROM $table WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$userData = $stmt->get_result()->fetch_assoc();
$stmt->close();

// Validar el envío del formulario
$message = '';
$message_type = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['proyecto_id'])) {
    $proyecto_id = intval($_POST['proyecto_id']);
    
    // Verificar si ya está registrado como interesado
    $sql_check = "SELECT id FROM interesados_proyecto WHERE id_proyecto = ? AND usuario_id = ?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param("ii", $proyecto_id, $user_id);
    $stmt_check->execute();
    $isRegistered = $stmt_check->get_result()->num_rows > 0;
    $stmt_check->close();

    if ($isRegistered) {
        $message = 'Ya has mostrado interés en este proyecto.';
        $message_type = 'warning';
    } else {
        // Validación: Verificar si el usuario que intenta registrarse es el creador del proyecto
        if ($user_id === $creador_id) {
            $message = 'No puedes inscribirte en tu propio proyecto.';
            $message_type = 'error';
        } else {
            // Preparar los datos para el INSERT
            $nombre_interesado = $role === 'empresas' ? $userData['nombre_empresa'] : $userData['nombre'];
            $email_interesado = $userData['email'];
            $telefono_interesado = $userData['telefono'];

            $sql_insert = "INSERT INTO interesados_proyecto (nombre_interesado, email_interesado, telefono_interesado, id_proyecto, nombre_proyecto, creador_id, tipo_usuario_creador, usuario_id, rol_solicitante)
                           VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt_insert = $conn->prepare($sql_insert);
            $stmt_insert->bind_param("sssisssss", $nombre_interesado, $email_interesado, $telefono_interesado, $proyecto_id, $nombre_proyecto, $creador_id, $tipo_usuario_creador, $user_id, $role);

            if ($stmt_insert->execute()) {
                $message = 'Te has registrado como interesado en este proyecto.';
                $message_type = 'success';
            } else {
                $message = 'No se pudo registrar tu interés. Inténtalo nuevamente.';
                $message_type = 'error';
            }
            $stmt_insert->close();
        }
    }
}

?>




<?php include './Includes/Header.php'; ?>

<div class="page-header container-fluid bg-secondary pt-2 pt-lg-5 pb-2 mb-5">
    <div class="container py-5">
        <div class="row align-items-center py-4">
            <div class="col-md-6 text-center text-md-left">
                <h1 class="mb-4 mb-md-0 text-white">Detalles del Proyecto</h1>
            </div>
            <div class="col-md-6 text-center text-md-right">
                <div class="d-inline-flex align-items-center">
                    <a class="btn text-white" href="index.php"><i class="fas fa-home me-2"></i>Inicio</a>
                    <i class="fas fa-angle-right text-white"></i>
                    <a class="btn text-white disabled" href="#"><i class="fas fa-info-circle me-2"></i>Detalles</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php



$proyecto_id = intval($_GET['id']);

$sql = "SELECT * FROM Proyectos WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $proyecto_id);
$stmt->execute();
$result = $stmt->get_result();
$proyecto = $result->fetch_assoc();
$stmt->close();

$sql = "SELECT * FROM tareas WHERE proyecto_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $proyecto_id);
$stmt->execute();
$result = $stmt->get_result();
$tareas = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();

$sql_categoria = "SELECT nombre FROM Categorias WHERE id = ?";
$stmt_categoria = $conn->prepare($sql_categoria);
$stmt_categoria->bind_param("i", $proyecto['categoria_id']);
$stmt_categoria->execute();
$result_categoria = $stmt_categoria->get_result();
$categoria = $result_categoria->fetch_assoc()['nombre'];
$stmt_categoria->close();



?>

<body>
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-8">
                <div class="d-flex flex-column text-left mb-4">
                    <h6 class="text-primary font-weight-normal text-uppercase mb-3"><i class="fas fa-project-diagram"></i> Detalles del Proyecto</h6>
                    <h1 class="mb-4 section-title"><?php echo htmlspecialchars($proyecto['titulo']); ?></h1>
                </div>
                <div class="mb-5">
                    <img class="img-fluid w-100 mb-4" src="<?php echo htmlspecialchars($proyecto['image_url']); ?>" alt="Imagen del Proyecto">
                    <p><?php echo htmlspecialchars($proyecto['descripcion']); ?></p>
                    <h2 class="mb-4"><i class="fas fa-heart"></i> Intereses</h2>
                    <p><?php echo htmlspecialchars($proyecto['intereses']); ?></p>
                    
                    <h2 class="mb-4"><i class="fas fa-info-circle"></i> Detalles Adicionales</h2>
                    <p><i class="fas fa-folder"></i> Categoría: <?php echo htmlspecialchars($categoria); ?></p>
                    <p><i class="fas fa-calendar-alt"></i> Inicio: <?php echo date("d/m/Y", strtotime($proyecto['fecha_inicio'])); ?></p>
                    <p><i class="fas fa-calendar-alt"></i> Fin: <?php echo date("d/m/Y", strtotime($proyecto['fecha_fin'])); ?></p>
                    <p><i class="fas fa-dollar-sign"></i> Precio: <?php echo htmlspecialchars($proyecto['precio']); ?></p>
                </div>

                <h2 class="mb-4"><i class="fas fa-list"></i> Tareas</h2>
                <div>
                    <?php foreach ($tareas as $tarea): ?>
                        <div class="mb-3">
                            <ul>
                                <li><?php echo htmlspecialchars($tarea['descripcion']); ?></li>
                            </ul>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="mb-5 text-center">
                <form method="POST" action="">
    <input type="hidden" name="proyecto_id" value="<?php echo htmlspecialchars($proyecto_id); ?>">
    <button type="submit" class="btn btn-primary" style="border-radius: 20px;">Agregar Interesado</button>
</form>


</div>


            </div>

            <div class="col-lg-4">
                <div class="mb-5">
                    <?php
include './Config/conexion.php'; 

$sql_recent_posts = "SELECT p.*, c.nombre AS nombre_categoria, 
                            CASE 
                                WHEN p.tipo_usuario = 'contratistas' THEN co.nombre
                                WHEN p.tipo_usuario = 'freelancers' THEN f.nombre
                                WHEN p.tipo_usuario = 'empresas' THEN e.nombre_empresa
                            END AS nombre_usuario
                        FROM proyectos p
                        LEFT JOIN categorias c ON p.categoria_id = c.id
                        LEFT JOIN contratistas co ON p.tipo_usuario = 'contratistas' AND p.contratista_id = co.id
                        LEFT JOIN freelancers f ON p.tipo_usuario = 'freelancers' AND p.freelancer_id = f.id
                        LEFT JOIN empresas e ON p.tipo_usuario = 'empresas' AND p.empresa_id = e.id
                        WHERE p.estado = 1
                        ORDER BY p.fecha_registro DESC
                        LIMIT 4";


$result_recent_posts = $conn->query($sql_recent_posts);


if ($result_recent_posts === false) {
    die('Error en la consulta SQL: ' . $conn->error);
}
?>

    <div class="mb-5">
    <h3 class="font-weight-bold mb-4 icon-header"><i class="fas fa-project-diagram"></i> Proyectos Recientes</h3>
                <?php
                if ($result_recent_posts->num_rows > 0) {
                    while ($row = $result_recent_posts->fetch_assoc()) {
                        $imagen = $row['image_url'];
                        $nombre_usuario = $row['nombre_usuario'];
                        $titulo = $row['titulo'];
                        $categoria = $row['nombre_categoria'];
                        $comentarios = 0; 

                        echo "
                        <div class='d-flex align-items-center border-bottom mb-3 pb-3'>
                            <img class='img-fluid' src='$imagen' alt='' style='width: 80px; height: 80px;' alt=''>
                            <div class='d-flex flex-column pl-3'>
                                <a class='text-dark mb-2' href=''>".htmlspecialchars($titulo)."</a>
                                <div class='d-flex'>
                                    <small class='mr-3'><i class='fa fa-user text-primary'></i> $nombre_usuario</small>
                                    <small class='mr-3'><i class='fa fa-folder text-primary'></i> $categoria</small>
                                    <small class='mr-3'><i class='fa fa-comments text-primary'></i> $comentarios</small>
                                </div>
                            </div>
                        </div>";
                    }
                } else {
                    echo "<p>No recent posts found</p>";
                }
            ?>
    </div>

                        <div class="mb-5">
                            <img src="./Assets/images/about.png" alt="WorkWave Offerings" class="img-fluid">
                        </div>
                            <div>
                                <h3 class="font-weight-bold mb-4 text-justify">Publica o Encuentra Ofertas de Trabajo</h3>
                                <p class="text-justify">
                                    En WorkWave, conectamos clientes y profesionales. Publica tus proyectos o busca oportunidades para colaborar con expertos. Con nuestras herramientas, gestionar ofertas y proyectos es más fácil y eficiente.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <script>
        $('.related-carousel').owlCarousel({
            loop: true,
            margin: 10,
            nav: true,
            items: 1
        });
    </script>

<?php include './includes/Footer.php'; ?>

</body>
<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php if (!empty($message)): ?>
    <script>
    Swal.fire({
        icon: '<?php echo $message_type; ?>',
        title: '<?php echo $message_type === "success" ? "Registro exitoso" : ($message_type === "warning" ? "Ya registrado" : "Error"); ?>',
        text: '<?php echo $message; ?>',
        confirmButtonText: 'OK'
    });
</script>
<?php endif; ?>

</html>
