<?php
session_start();
if (!isset($_SESSION['user_id']) || !isset($_SESSION['role'])) {
    header("Location: login.html");
    exit();
}

$user_id = $_SESSION['user_id'];
$role = $_SESSION['role'];

include './config/conexion.php';
include './Includes/Header.php';

$success = false;
$error_message = '';

$tipo_usuario = $role;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $contratista_id = $_POST['contratista_id'] ?? null;
    $freelancer_id = $_POST['freelancer_id'] ?? null;
    $empresa_id = $_POST['empresa_id'] ?? null;
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $image_url = $_POST['image_url'] ?? null;
    $categoria_id = $_POST['categoria_id'];
    $precio = $_POST['precio'];
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_fin = $_POST['fecha_fin'] ?? null;
    $intereses = $_POST['intereses'] ?? null;
    $etiqueta = $_POST['etiqueta']; // Captura de la etiqueta seleccionada

    // Modificación de la consulta INSERT para incluir la columna Etiqueta
    $sql = "INSERT INTO proyectos (tipo_usuario, contratista_id, freelancer_id, empresa_id, titulo, descripcion, image_url, categoria_id, precio, estado, fecha_inicio, fecha_fin, fecha_registro, intereses, Etiqueta)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, '1', ?, ?, NOW(), ?, ?)";

    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        $error_message = "Error en la preparación de la consulta: " . $conn->error;
    } else {
        $stmt->bind_param(
            "siiissssissss",
            $tipo_usuario,
            $contratista_id,
            $freelancer_id,
            $empresa_id,
            $titulo,
            $descripcion,
            $image_url,
            $categoria_id,
            $precio,
            $fecha_inicio,
            $fecha_fin,
            $intereses,
            $etiqueta // Incluyendo el parámetro Etiqueta
        );

        if ($stmt->execute()) {
            $success = true;
        } else {
            $error_message = "Error al agregar el proyecto: " . $stmt->error;
        }
    }
}

$sql = "SELECT id, nombre FROM categorias WHERE estado = '1'";
$result = $conn->query($sql);

if ($result === false) {
    die("Error al obtener las categorías: " . $conn->error);
}

$categorias = [];
while ($row = $result->fetch_assoc()) {
    $categorias[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Proyecto</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.7.0/sweetalert2.min.css">
    <style>
        body {
            background-image: url('./Assets/images/2312616.jpg');
            background-size: cover;
            background-attachment: fixed;
            background-repeat: no-repeat;
        }
        .card {
            background-color: rgba(255, 255, 255, 0.9); 
            border-radius: 10px;
        }
        .card-header {
            background-color: #007bff;
            color: white;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header text-center">
                <h2 style="color: white;">Agregar Proyecto</h2>
            </div>
            <div class="card-body">
                <form action="" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="tipo_usuario" value="<?php echo htmlspecialchars($_SESSION['role']); ?>">
                    <?php if ($_SESSION['role'] === 'contratistas'): ?>
                        <input type="hidden" name="contratista_id" value="<?php echo htmlspecialchars($_SESSION['user_id']); ?>">
                    <?php elseif ($_SESSION['role'] === 'freelancers'): ?>
                        <input type="hidden" name="freelancer_id" value="<?php echo htmlspecialchars($_SESSION['user_id']); ?>">
                    <?php elseif ($_SESSION['role'] === 'empresas'): ?>
                        <input type="hidden" name="empresa_id" value="<?php echo htmlspecialchars($_SESSION['user_id']); ?>">
                    <?php endif; ?>

                    <div class="form-group">
                        <label for="titulo">Título:</label>
                        <input type="text" class="form-control" id="titulo" name="titulo" required>
                    </div>
                    <div class="form-group">
                        <label for="descripcion">Descripción:</label>
                        <textarea class="form-control" id="descripcion" name="descripcion" rows="4" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="image_url">Imagen URL:</label>
                        <input type="text" class="form-control" id="image_url" name="image_url">
                    </div>
                    <div class="form-group">
                        <label for="categoria_id">Categoría:</label>
                        <select class="form-control" id="categoria_id" name="categoria_id" required>
                            <option value="">Selecciona una categoría</option>
                            <?php foreach ($categorias as $categoria): ?>
                                <option value="<?php echo htmlspecialchars($categoria['id']); ?>"><?php echo htmlspecialchars($categoria['nombre']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="precio">Precio:</label>
                        <input type="number" class="form-control" id="precio" name="precio" step="0.01" required>
                    </div>
                    <div class="form-group">
                        <label for="fecha_inicio">Fecha de Inicio:</label>
                        <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" required min="<?php echo date('Y-m-d'); ?>">
                    </div>
                    <div class="form-group">
                        <label for="fecha_fin">Fecha de Fin:</label>
                        <input type="date" class="form-control" id="fecha_fin" name="fecha_fin" min="<?php echo date('Y-m-d'); ?>">
                    </div>
                    <div class="form-group">
                        <label for="intereses">Intereses:</label>
                        <input type="text" class="form-control" id="intereses" name="intereses">
                    </div>
                    <div class="form-group">
                        <label for="etiqueta">Etiqueta:</label>
                        <select class="form-control" id="etiqueta" name="etiqueta" required>
                            <option value="">Selecciona una etiqueta</option>
                            <option value="Oferta">Oferta</option>
                            <option value="Servicio">Servicio</option>
                        </select>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Agregar Proyecto</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.7.0/sweetalert2.all.min.js"></script>
    <script>
        <?php if ($success): ?>
            Swal.fire({
                title: 'Éxito!',
                text: 'El proyecto ha sido agregado exitosamente.',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'Inicio.php';
                }
            });
        <?php elseif ($error_message): ?>
            Swal.fire({
                title: 'Error!',
                text: '<?php echo addslashes($error_message); ?>',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        <?php endif; ?>
    </script>

<?php include './Includes/Footer.php'; ?>

</body>
</html>
