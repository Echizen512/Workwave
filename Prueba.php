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

// Consulta para obtener los proyectos en los que el usuario ha sido aceptado
$sql = "
    SELECT 
        proyectos.titulo AS titulo_proyecto, 
        usuarios_aceptados.nombre_interesado, 
        usuarios_aceptados.email_interesado, 
        usuarios_aceptados.telefono_interesado, 
        usuarios_aceptados.fecha_aceptacion 
    FROM 
        usuarios_aceptados 
    INNER JOIN 
        proyectos 
    ON 
        usuarios_aceptados.proyecto_id = proyectos.id 
    WHERE 
        usuarios_aceptados.usuario_id = ? 
    AND 
        usuarios_aceptados.rol_solicitante = ?
";

$stmt = $conn->prepare($sql);
$stmt->bind_param("is", $userId, $role);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proyectos Aceptados</title>
    <link href="./Assets/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .card {
            margin-bottom: 1rem;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>

    <?php include './Includes/Header.php'; ?>

    <div class="container mt-5">
        <h2>Proyectos en los que participas</h2>
        <?php if ($result->num_rows > 0): ?>
            <div class="list-group">
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="card">
                        <div class="card-body">
                            <h5>Proyecto: <?php echo htmlspecialchars($row['titulo_proyecto']); ?></h5>
                            <p><strong>Interesado:</strong> <?php echo htmlspecialchars($row['nombre_interesado']); ?></p>
                            <p><strong>Email:</strong> <?php echo htmlspecialchars($row['email_interesado']); ?></p>
                            <p><strong>Teléfono:</strong> <?php echo htmlspecialchars($row['telefono_interesado']); ?></p>
                            <p><strong>Fecha de Aceptación:</strong> <?php echo date('d-m-Y', strtotime($row['fecha_aceptacion'])); ?></p>
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
