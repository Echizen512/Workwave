<?php
include './config/conexion.php';

session_start();

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

if (isset($_GET['id']) && isset($_GET['estado'])) {
    $id = intval($_GET['id']);
    $estado = $_GET['estado'] == 'true' ? 1 : 0;

    $stmt = $conn->prepare("UPDATE proyectos SET estado = ? WHERE id = ? AND $user_column = ?");
    if ($stmt === false) {
        die("Error en la preparación de la consulta: " . $conn->error);
    }
    $stmt->bind_param('iii', $estado, $id, $user_id);

    if ($stmt->execute()) {
        header("Location: ?status=success");
    } else {
        header("Location: ?status=error");
    }
    $stmt->close();
}

if (isset($_POST['submit']) && isset($_POST['id'])) {
    $id = intval($_POST['id']);
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $image_url = $_POST['image_url'];
    $categoria_id = intval($_POST['categoria_id']);
    $precio = floatval($_POST['precio']);
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_fin = $_POST['fecha_fin'];
    $intereses = $_POST['intereses'];

    $stmt = $conn->prepare("UPDATE proyectos SET titulo = ?, descripcion = ?, image_url = ?, categoria_id = ?, precio = ?, fecha_inicio = ?, fecha_fin = ?, intereses = ? WHERE id = ? AND $user_column = ?");
    if ($stmt === false) {
        die("Error en la preparación de la consulta: " . $conn->error);
    }
    $stmt->bind_param('sssidssii', $titulo, $descripcion, $image_url, $categoria_id, $precio, $fecha_inicio, $fecha_fin, $intereses, $id, $user_id);

    if ($stmt->execute()) {
        header("Location: ?status=success");
    } else {
        header("Location: ?status=error");
    }
    $stmt->close();
}

?>

<?php include './Includes/Header.php'; ?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proyectos</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
</head>

<style>
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

<body>

    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h2 class="card-title m-0 text-center" style="color: white;">Lista de Proyectos</h2>
            </div>
            <div class="card-body">
                <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editModalLabel">Editar Proyecto</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="" method="POST">
                                    <input type="hidden" id="id" name="id">
                                    <div class="mb-3">
                                        <label for="titulo" class="form-label">Título del Proyecto</label>
                                        <input type="text" class="form-control" id="titulo" name="titulo" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="descripcion" class="form-label">Descripción</label>
                                        <textarea class="form-control" id="descripcion" name="descripcion"
                                            required></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="image_url" class="form-label">URL de la Imagen</label>
                                        <input type="text" class="form-control" id="image_url" name="image_url">
                                    </div>
                                    <div class="mb-3">
                                        <label for="categoria_id" class="form-label">ID Categoría</label>
                                        <input type="text" class="form-control" id="categoria_id" name="categoria_id"
                                            required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="precio" class="form-label">Precio</label>
                                        <input type="number" step="0.01" class="form-control" id="precio" name="precio"
                                            required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="fecha_inicio" class="form-label">Fecha de Inicio</label>
                                        <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio"
                                            required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="fecha_fin" class="form-label">Fecha de Fin</label>
                                        <input type="date" class="form-control" id="fecha_fin" name="fecha_fin">
                                    </div>
                                    <div class="mb-3">
                                        <label for="intereses" class="form-label">Intereses</label>
                                        <input type="text" class="form-control" id="intereses" name="intereses">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Cancelar</button>
                                        <button type="submit" name="submit" class="btn btn-primary">Actualizar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table id="projectsTable" class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr class="text-center">
                                <th>Nombre</th>
                                <th style="width:400px;">Descripción</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!$conn) {
                                die("Conexión fallida: " . mysqli_connect_error());
                            }

                            $sql = "SELECT * FROM proyectos WHERE $user_column = ?";
                            $stmt = $conn->prepare($sql);

                            if ($stmt === false) {
                                die("Error en la preparación de la consulta: " . $conn->error);
                            }

                            $stmt->bind_param('i', $user_id);

                            if (!$stmt->execute()) {
                                die("Error en la ejecución de la consulta: " . $stmt->error);
                            }

                            $result = $stmt->get_result();

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $estado = $row['estado'] ? 'Activo' : 'Inactivo';
                                    $estadoClass = $row['estado'] ? 'success' : 'danger';
                                    $estadoIcon = $row['estado'] ? 'ban' : 'check';
                                    $estadoText = $row['estado'] ? 'Desactivar' : 'Activar';
                                    echo '<tr>';
                                    echo '<td class="text-center">' . htmlspecialchars($row['titulo']) . '</td>';
                                    echo '<td class="text-center">' . htmlspecialchars($row['descripcion']) . '</td>';
                                    echo '<td class="text-center text-white"><span style="border-radius: 10px;" class="badge bg-' . $estadoClass . '">' . $estado . ' </span></td>';
                                    echo '<td class="text-center">
                                <a href="?id=' . $row['id'] . '&estado=' . ($row['estado'] ? 'false' : 'true') . '" style="border-radius: 10px;" class="btn btn-info btn-sm">' . $estadoText . '</a>
                            </td>';

                                    echo '</tr>';
                                }
                            } else {
                                echo '<tr><td colspan="4" class="text-center">No hay proyectos</td></tr>';
                            }

                            $stmt->close();
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>



    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

    <script src="./Assets/js/sweetalert2.all.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#projectsTable').DataTable();

            // Editar proyecto
            $('.editBtn').on('click', function () {
                var id = $(this).data('id');
                $.ajax({
                    url: 'Gestion.php',
                    type: 'POST',
                    data: { id: id },
                    success: function (response) {
                        var data = JSON.parse(response);
                        $('#id').val(data.id);
                        $('#titulo').val(data.titulo);
                        $('#descripcion').val(data.descripcion);
                        $('#image_url').val(data.image_url);
                        $('#categoria_id').val(data.categoria_id);
                        $('#precio').val(data.precio);
                        $('#fecha_inicio').val(data.fecha_inicio);
                        $('#fecha_fin').val(data.fecha_fin);
                        $('#intereses').val(data.intereses);
                        $('#editModal').modal('show');
                    }
                });
            });
        });
    </script>

    <?php include './Includes/Footer.php'; ?>

</body>

</html>