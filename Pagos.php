<?php
session_start();
include './config/conexion.php';

// Verifica si hay una sesión activa
if (!isset($_SESSION['user_id']) || !isset($_SESSION['role'])) {
    header("Location: login.html");
    exit();
}

$user_id = $_SESSION['user_id'];
$tipo_usuario = $_SESSION['role'];

// Define el nombre de la columna basado en el tipo de usuario
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

// Prepara la consulta y verifica si es válida
$sql = "SELECT * FROM proyectos WHERE $user_column = ?";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die("Error en la preparación de la consulta: " . $conn->error);
}

// Asigna los parámetros y ejecuta
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
</head>
<body>
    <?php include './Includes/Header.php'; ?>

    <div class="container mt-5">
        <h2>Proyectos Publicados</h2>
        <?php if ($result->num_rows > 0): ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Título</th>
                        <th>Descripción</th>
                        <th>Precio</th>
                        <th>Repositorio</th>
                        <th>Terminado</th>
                        <th>Pago</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['titulo']); ?></td>
                            <td><?php echo htmlspecialchars($row['descripcion']); ?></td>
                            <td><?php echo htmlspecialchars($row['precio'].'$'); ?></td>
                            <td><?php echo htmlspecialchars($row['repositorio']); ?></td>
                            <td><?php echo htmlspecialchars($row['terminado']); ?></td>
                            <td><?php echo htmlspecialchars($row['pago']); ?></td>
                            <td>
                                <?php if ($row['pago'] == 'Pendiente'): ?>
                                    <form action="procesar_pago.php" method="POST">
                                        <input type="hidden" name="proyecto_id" value="<?php echo $row['id']; ?>">
                                        <input type="hidden" name="monto" value="<?php echo $row['precio']; ?>">
                                        <button type="submit" class="btn btn-primary">Pagar</button>
                                    </form>
                                <?php else: ?>
                                    <button class="btn btn-success" disabled>Pagado</button>
                                <?php endif; ?>
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
