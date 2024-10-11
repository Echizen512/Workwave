<?php
include './config/conexion.php'; 
session_start();

if (!isset($_SESSION['user_id']) || !isset($_SESSION['role'])) {
    header("Location: login.html");
    exit();
}

$user_id = $_SESSION['user_id'];

// Consulta los interesados en el proyecto
$sql = "SELECT * FROM interesados_proyecto WHERE creador_id = ?";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die("Error en la preparación de la consulta: " . $conn->error);
}

$stmt->bind_param('i', $user_id);

if (!$stmt->execute()) {
    die("Error en la ejecución de la consulta: " . $stmt->error);
}

$result = $stmt->get_result();
?>

<?php include './Includes/Header.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Interesados en tus Proyectos</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
</head>
<body>
<br> 
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">Interesados en tus Proyectos</h4>
            </div>
            <div class="card-body">
                <table id="tabla_interesados" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Nombre del Interesado</th>
                            <th>Correo Electrónico</th>
                            <th>Teléfono</th>
                            <th>Nombre del Proyecto</th>
                            <th>Rol de Solicitante</th>
                            <th>Acciones</th> 
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $usuario_id = htmlspecialchars($row['usuario_id']);
                                $rol_solicitante = htmlspecialchars($row['rol_solicitante']);
                                $proyecto_id = htmlspecialchars($row['id_proyecto']);
                                
                                // Verificar si el usuario ya fue aceptado
                                $sql_aceptados = "SELECT * FROM usuarios_aceptados WHERE proyecto_id = ? AND usuario_id = ? AND rol_solicitante = ?";
                                $stmt_aceptados = $conn->prepare($sql_aceptados);
                                if ($stmt_aceptados === false) {
                                    die("Error en la preparación de la consulta: " . $conn->error);
                                }
                                $stmt_aceptados->bind_param('iis', $proyecto_id, $usuario_id, $rol_solicitante);
                                
                                if (!$stmt_aceptados->execute()) {
                                    die("Error en la ejecución de la consulta: " . $stmt_aceptados->error);
                                }
                                
                                $result_aceptados = $stmt_aceptados->get_result();

                                echo '<tr>';
                                echo '<td>' . htmlspecialchars($row['nombre_interesado']) . '</td>';
                                echo '<td>' . htmlspecialchars($row['email_interesado']) . '</td>';
                                echo '<td>' . htmlspecialchars($row['telefono_interesado']) . '</td>';
                                echo '<td>' . htmlspecialchars($row['nombre_proyecto']) . '</td>';
                                echo '<td>' . htmlspecialchars($row['rol_solicitante']) . '</td>';
                                echo '<td>';

                                if ($result_aceptados->num_rows > 0) {
                                    echo '<span style="color: green;">Aceptado</span>';
                                } else {
                                    echo '<a href="ver_perfil.php?usuario_id=' . $usuario_id . '&rol_solicitante=' . urlencode($rol_solicitante) . '" class="btn btn-info" style="margin: 5px;"><i class="fas fa-user" style="margin: 5px;"></i>Ver Perfil</a>'; 
                                    echo '<button class="btn btn-success" style="margin: 5px;" onclick="confirmarAceptar(' . $proyecto_id . ', ' . $usuario_id . ', \'' . $rol_solicitante . '\')"><i class="fas fa-check" style="margin: 5px;"></i>Aceptar</button> ';
                                    echo '<button class="btn btn-danger" style="margin: 5px;" onclick="rechazarSolicitud(' . $proyecto_id . ', ' . $usuario_id . ')"><i class="fas fa-times" style="margin: 5px;"></i>Rechazar</button>';
                                }

                                echo '</td>';
                                echo '</tr>';
                            }
                        } else {
                            echo '<tr><td colspan="6" class="text-center">No hay interesados</td></tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#tabla_interesados').DataTable(); // Inicializar DataTables
        });

        // Función para confirmar aceptación de una solicitud
        function confirmarAceptar(proyectoId, usuarioId, rolSolicitante) {
            Swal.fire({
                title: '¿Estás seguro de aceptar esta solicitud?',
                text: "Esta acción no se puede deshacer.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, aceptar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'aceptar_solicitud.php?proyecto_id=' + proyectoId + '&usuario_id=' + usuarioId + '&rol_solicitante=' + encodeURIComponent(rolSolicitante);
                }
            });
        }

        // Función para rechazar una solicitud usando SweetAlert2
        function rechazarSolicitud(proyectoId, usuarioId) {
            Swal.fire({
                title: '¿Estás seguro?',
                text: "¡No podrás revertir esta acción!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminarlo!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'rechazar_solicitud.php?proyecto_id=' + proyectoId + '&usuario_id=' + usuarioId;
                }
            });
        }
    </script>
</body>
</html>

<?php
include './Includes/Footer.php';
$stmt->close();
$stmt_aceptados->close();
?>
