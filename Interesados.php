<?php
include './config/conexion.php'; 
session_start();

if (!isset($_SESSION['user_id']) || !isset($_SESSION['role'])) {
    header("Location: login.html");
    exit();
}

$user_id = $_SESSION['user_id']; 
$tipo_usuario = $_SESSION['role']; 

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
    $creador_id = 0;
    $tipo_usuario_creador = $row['tipo_usuario'];

    if ($tipo_usuario_creador === 'contratistas') {
        $creador_id = $row['contratista_id'];
    } elseif ($tipo_usuario_creador === 'freelancers') {
        $creador_id = $row['freelancer_id'];
    } elseif ($tipo_usuario_creador === 'empresas') {
        $creador_id = $row['empresa_id'];
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre_interesado = $_POST['nombre_interesado'];
    $email_interesado = $_POST['email_interesado'];
    $telefono_interesado = $_POST['telefono_interesado'];

    // Validación 1: Verificar si el usuario ya está registrado en este proyecto
    $check_user_stmt = $conn->prepare("SELECT id FROM interesados_proyecto WHERE id_proyecto = ? AND usuario_id = ?");
    $check_user_stmt->bind_param('ii', $proyecto_id, $user_id);
    $check_user_stmt->execute();
    $check_user_stmt->store_result();

    if ($check_user_stmt->num_rows > 0) {
        echo json_encode(['status' => 'error', 'message' => 'Ya estás registrado en este proyecto.']);
        exit();
    }

    // Validación 2: Verificar si el usuario que intenta registrarse es el creador del proyecto
    if ($user_id == $creador_id) {
        echo json_encode(['status' => 'error', 'message' => 'No puedes inscribirte en tu propio proyecto.']);
        exit();
    }

    // Si pasa las validaciones, insertar en la base de datos
    $stmt = $conn->prepare("INSERT INTO interesados_proyecto (nombre_interesado, email_interesado, telefono_interesado, id_proyecto, nombre_proyecto, creador_id, tipo_usuario_creador, usuario_id, rol_solicitante) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param('sssisisis', $nombre_interesado, $email_interesado, $telefono_interesado, $proyecto_id, $nombre_proyecto, $creador_id, $tipo_usuario_creador, $user_id, $tipo_usuario);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => $stmt->error]);
    }
    
    $stmt->close();
    $conn->close();
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Agregar Interesado</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
</head>
<body>
    <?php include './Includes/Header.php'; ?>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-primary">
                <h4 class="mb-0 text-center text-white">Agregar Interesado al Proyecto</h4>
            </div>
            <div class="card-body">
                <h5 class="mb-4 text-black">Nombre del Proyecto: <?php echo htmlspecialchars($nombre_proyecto); ?></h5>
                <form id="interesadoForm" method="post" action="">
                    <div class="form-group">
                        <label for="nombre_interesado">Nombre del Interesado</label>
                        <input type="text" class="form-control" id="nombre_interesado" name="nombre_interesado" pattern="[A-Za-z\s]+" title="El nombre solo puede contener letras y espacios" required>
                    </div>
                    <div class="form-group">
                        <label for="email_interesado">Correo Electrónico</label>
                        <input type="email" class="form-control" id="email_interesado" name="email_interesado" required>
                    </div>
                    <div class="form-group">
                        <label for="telefono_interesado">Teléfono</label>
                        <input type="text" class="form-control" id="telefono_interesado" name="telefono_interesado" maxlength="11" pattern="\d{11}" title="El teléfono debe tener exactamente 11 dígitos numéricos" required>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Agregar Interesado</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php include './Includes/Footer.php'; ?>

    <script>
        document.getElementById('interesadoForm').addEventListener('submit', function(event) {
            event.preventDefault();

            var formData = new FormData(this);

            // Validar el nombre del interesado (solo letras y espacios)
            const nombreInteresado = document.getElementById('nombre_interesado').value;
            const nombreRegex = /^[A-Za-z\s]+$/;
            if (!nombreRegex.test(nombreInteresado)) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'El nombre solo puede contener letras y espacios.',
                });
                return;
            }

            // Validar el correo electrónico (formato de correo válido)
            const emailInteresado = document.getElementById('email_interesado').value;
            if (!emailInteresado.includes('@')) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'El correo electrónico debe ser válido.',
                });
                return;
            }

            // Validar el teléfono (exactamente 11 dígitos numéricos)
            const telefonoInteresado = document.getElementById('telefono_interesado').value;
            const telefonoRegex = /^\d{11}$/;
            if (!telefonoRegex.test(telefonoInteresado)) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'El teléfono debe tener exactamente 11 dígitos numéricos.',
                });
                return;
            }

            // Enviar los datos si pasa todas las validaciones
            fetch('', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Éxito',
                        text: 'Interesado agregado exitosamente.',
                    }).then(() => {
                        window.location.href = 'Proyectos.php';
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: data.message,
                    });
                }
            })
        });
    </script>
</body>
</html>
