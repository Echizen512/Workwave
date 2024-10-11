<?php
include './conexion.php'; 
include './Dashboard.php';

// Cambiar estado de la categoría
if (isset($_GET['id']) && isset($_GET['status'])) {
    $id = $_GET['id'];
    $status = $_GET['status'] == 'true' ? 1 : 0;

    $sql = "UPDATE categorias SET estado = $status WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        header("Location: ?status=success");
        exit();
    } else {
        header("Location: ?status=error");
        exit();
    }
}

// Agregar o editar categoría
if (isset($_POST['submit'])) {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];

    if (isset($_POST['id']) && !empty($_POST['id'])) {
        // Editar categoría
        $id = $_POST['id'];
        $sql = "UPDATE categorias SET nombre = '$nombre', descripcion = '$descripcion' WHERE id = $id";
    } else {
        // Agregar nueva categoría
        $sql = "INSERT INTO categorias (nombre, descripcion, estado) VALUES ('$nombre', '$descripcion', 1)";
    }

    if ($conn->query($sql) === TRUE) {
        header("Location: ?status=success");
        exit();
    } else {
        header("Location: ?status=error");
        exit();
    }
}

$conn->close(); 
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Categorías</title>
    <link href="./Assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="./Assets/css/CRUD.css">
    <style>
        body {
            background-image: url('../Assets/images/2312616.jpg');
            background-size: cover;
            background-repeat: no-repeat;
        }
        .content-wrapper {
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            padding: 20px;
        }

        body, html {
            height: 100%;
            margin: 0;
            display: flex;
            flex-direction: column;
        }

        .content-wrapper {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .custom-card {
            border: 1px solid rgba(0, 0, 0, 0.125);
            border-radius: 8px;
            box-shadow: 0px 0px 8px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        .custom-btn {
            color: #fff;
            background-color: rgb(63, 161, 65 / 94%);
            border-color: rgb(63, 161, 65 / 94%);
        }

        .custom-btn:hover {
            background-color: #4caf50;
            border-color: #4caf50;
        }

        .container {
            padding-top: 20px;
            padding-left: 15%;
            padding-right: 15px;
        }

        @media (min-width: 768px) {
            .container {
                max-width: 100%;
                margin-left: auto;
                margin-right: auto;
            }
        }

        h2.card-title {
            font-size: 2.2rem;
            font-weight: bold;
            color: #3fa141;
            text-align: center;
            margin-bottom: 20px;
        }

        .table th, .table td {
            vertical-align: middle;
            text-align: center;
        }

        .table th {
            background-color: #f8f9fa;
            font-weight: bold;
        }

        @media (max-width: 768px) {
            .table-responsive {
                overflow-x: auto;
            }
            .table th, .table td {
                font-size: 0.875rem;
            }
        }

        .table th i {
            margin-right: 5px;
        }

        footer {
            padding: 10px 0;
            width: 100%;
            position: relative;
            bottom: 0;
            margin-top: auto; 
        }





    </style>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Categorías</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
</nav>

<div class="container mt-5 content-wrapper">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h2 class="card-title m-0" style="color: white;">Lista de Categorías</h2>
        </div>
        <div class="card-body">
            <form action="" method="POST" class="mb-4">
                <input type="hidden" id="id" name="id">
                <div class="row">
                    <div class="col-md-5">
                        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre de la Categoría" required>
                    </div>
                    <div class="col-md-5">
                        <input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="Descripción" required>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" name="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </div>
            </form>

            <div class="table-responsive">
                <table id="categoriesTable" class="table table-bordered table-striped table-hover">
                <thead>
                    <tr class="text-center">
                        <th><i class="fas fa-user"></i> Nombre</th>
                        <th><i class="fas fa-align-left"></i> Descripción</th>
                        <th><i class="fas fa-toggle-on"></i> Estado</th>
                        <th><i class="fas fa-cogs"></i> Acciones</th>
                    </tr>
                </thead>
                    <tbody>
                        <?php
                        include './conexion.php';
                        $sql = "SELECT * FROM categorias";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>
                                    <td>{$row['nombre']}</td>
                                    <td>{$row['descripcion']}</td>
                                    <td class='text-center'>".($row['estado'] ? 'Activo' : 'Inactivo')."</td>
                                    <td class='text-center'>
                                        <button onclick='editCategory({$row['id']}, \"{$row['nombre']}\", \"{$row['descripcion']}\")' class='btn btn-warning btn-sm' title='Editar'>
                                            <i class='fas fa-edit'></i>
                                        </button>
                                        <button onclick='toggleStatus({$row['id']}, ".($row['estado'] ? 'false' : 'true').")' class='btn ".($row['estado'] ? 'btn-danger' : 'btn-success')." btn-sm' title='Cambiar Estado'>
                                            <i class='fas ".($row['estado'] ? 'fa-lock' : 'fa-lock-open')."'></i>
                                        </button>
                                    </td>
                                </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='4' class='text-center'>No se encontraron categorías</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer text-muted text-center">
            <p class="mb-0">Gestión de Categorías</p>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script>
$(document).ready(function() {
    $('#categoriesTable').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/Spanish.json"
        }
    });

    // Mostrar mensaje basado en el estado de la URL
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('status')) {
        const status = urlParams.get('status');
        if (status === 'success') {
            Swal.fire({
                icon: 'success',
                title: 'Operación realizada correctamente',
                showConfirmButton: false,
                timer: 1500
            });
        } else if (status === 'error') {
            Swal.fire({
                icon: 'error',
                title: 'Error en la operación',
                showConfirmButton: false,
                timer: 1500
            });
        }
    }
});

// Función para cambiar el estado de la categoría
function toggleStatus(id, status) {
    Swal.fire({
        title: status ? '¿Activar categoría?' : '¿Desactivar categoría?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: status ? 'Sí, activar' : 'Sí, desactivar'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = `?id=${id}&status=${status}`;
        }
    });
}

// Función para editar una categoría
function editCategory(id, nombre, descripcion) {
    $('#id').val(id);
    $('#nombre').val(nombre);
    $('#descripcion').val(descripcion);
}
</script>
</body>
</html>
