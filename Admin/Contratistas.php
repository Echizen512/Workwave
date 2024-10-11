<?php
include './conexion.php'; 
include './Dashboard.php';
if (isset($_GET['id']) && isset($_GET['status'])) {
    $id = $_GET['id'];
    $status = $_GET['status'] == 'true' ? 1 : 0;

    $sql = "UPDATE contratistas SET Estado = $status WHERE id = $id";

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
    <title>Lista de Contratistas</title>
    <link href="./Assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="./Assets/css/CRUD.css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    

</head>

<style>
    body{
        background-image: url('../Assets/images/2312616.jpg');
    }
</style>

<body>


<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Contratistas</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
</nav>

<div class="container mt-5 content-wrapper">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h2 class="card-title m-0" style="color: white;">Lista de Contratistas</h2>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="contractorsTable" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr class="text-center">
                            <th><i class="fas fa-user"></i> Nombre</th>
                            <th><i class="fas fa-envelope"></i> Email</th>
                            <th><i class="fas fa-phone"></i> Teléfono</th>
                            <th><i class="fas fa-map-marker-alt"></i> Dirección</th>
                            <th><i class="fas fa-file-alt"></i> Descripción</th>
                            <th><i class="fas fa-toggle-on"></i> Estado</th>
                            <th><i class="fas fa-cogs"></i> Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include './conexion.php';
                        $sql = "SELECT * FROM contratistas";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>
                                    <td>{$row['nombre']}</td>
                                    <td>{$row['email']}</td>
                                    <td>{$row['telefono']}</td>
                                    <td>{$row['direccion']}</td>
                                    <td>{$row['descripcion_necesidades']}</td>
                                    <td class='text-center'>".($row['Estado'] ? 'Activo' : 'Inactivo')."</td>
                                    <td class='text-center'>
                                        <button onclick='toggleStatus({$row['id']}, ".($row['Estado'] ? 'false' : 'true').")' class='btn ".($row['Estado'] ? 'btn-danger' : 'btn-success')." btn-sm' title='Cambiar Estado'>
                                            <i class='fas ".($row['Estado'] ? 'fa-lock' : 'fa-lock-open')."'></i>
                                        </button>
                                    </td>
                                </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='8' class='text-center'>No se encontraron contratistas</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer text-muted text-center">
            <p class="mb-0">© 2024 Contratistas</p>
        </div>
    </div>
</div>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Bootstrap Bundle JS -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script>
$(document).ready(function() {
    $('#contractorsTable').DataTable({
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
                title: 'Estado actualizado correctamente',
                showConfirmButton: false,
                timer: 1500
            });
        } else if (status === 'error') {
            Swal.fire({
                icon: 'error',
                title: 'Error al actualizar el estado',
                showConfirmButton: false,
                timer: 1500
            });
        }
    }
});

function toggleStatus(id, status) {
    Swal.fire({
        title: status ? '¿Activar contratista?' : '¿Desactivar contratista?',
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
</script>
</body>
</html>
