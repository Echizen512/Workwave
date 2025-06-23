<?php
include './conexion.php'; 
include './Dashboard.php'; 
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Auditoría</title>
    <link href="./Assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="./Assets/css/CRUD.css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<style>
    body {
        background-image: url('../Assets/images/2312616.jpg');
    }
</style>

<body>

<!-- Barra de navegación -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Auditoría de Operaciones</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
</nav>

<div class="container mt-5 content-wrapper">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h2 class="card-title m-0" style="color: white;">Lista de Auditoría</h2>
            <a href="generar_reporte2.php" class="btn btn-danger float-end">Generar Reporte</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="auditoriaTable" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr class="text-center">
                            <th><i class="fas fa-table"></i> Tabla</th>
                            <th><i class="fas fa-exchange-alt"></i> Operación</th>
                            <th><i class="fas fa-id-badge"></i> ID Registro</th>
                            <th><i class="fas fa-user"></i> Usuario</th>
                            <th><i class="fas fa-user-tag"></i> Rol de Usuario</th>
                            <th><i class="fas fa-calendar-alt"></i> Fecha</th>
                            <th><i class="fas fa-info-circle"></i> Descripción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include './conexion.php';
                        $sql = "SELECT * FROM Auditoria ORDER BY fecha DESC";

                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>
                                    <td>{$row['tabla']}</td>
                                    <td>{$row['operacion']}</td>
                                    <td>{$row['id_registro']}</td>
                                    <td>{$row['usuario_id']}</td>
                                    <td>{$row['rol_usuario']}</td>
                                    <td>" . date('d/m/Y H:i', strtotime($row['fecha'])) . "</td>


                                    <td>{$row['descripcion']}</td>
                                </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='7' class='text-center'>No se encontraron registros de auditoría</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer text-muted text-center">
            <p class="mb-0">© 2025 Auditoría de Operaciones</p>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script>
$(document).ready(function() {
    $('#auditoriaTable').DataTable({
        "paging": true,
        "searching": true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/Spanish.json",
            "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
            },
            "search": "Buscar:",
            "lengthMenu": "Mostrar _MENU_ registros por página",
            "zeroRecords": "No se encontraron registros",
            "info": "Mostrando página _PAGE_ de _PAGES_",
            "infoEmpty": "No hay registros disponibles",
            "infoFiltered": "(filtrado de _MAX_ registros en total)"
        }
    });
});
</script>

</body>
</html>
