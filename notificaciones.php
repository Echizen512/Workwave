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

// Función para obtener el nombre y rol del remitente
function obtenerNombreYRol($conn, $userId, $role) {
    switch ($role) {
        case 'contratistas':
            $sql = "SELECT nombre AS nombre_usuario FROM contratistas WHERE id = ?";
            break;
        case 'empresas':
            $sql = "SELECT nombre_empresa AS nombre_usuario FROM empresas WHERE id = ?";
            break;
        case 'freelancers':
            $sql = "SELECT nombre AS nombre_usuario FROM freelancers WHERE id = ?";
            break;
        default:
            return ['nombre' => 'Usuario desconocido', 'rol' => $role];
    }

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result && $row = $result->fetch_assoc()) {
        return ['nombre' => $row['nombre_usuario'], 'rol' => $role];
    } else {
        return ['nombre' => 'Usuario no encontrado', 'rol' => $role];
    }
}

// Preparar y ejecutar la consulta para obtener mensajes recibidos
$sql = "SELECT outgoing_msg_id, outgoing_role, msg, timestamp FROM messages WHERE incoming_msg_id = ? ORDER BY timestamp DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notificaciones</title>
    <link href="./Assets/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Inserta aquí tu estilo CSS, incluyendo las animaciones */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .card {
            margin-bottom: 1rem;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            border-radius: 40px;
            animation: fadeInUp 0.5s ease-out;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        .button-primary {
            width: 10%;
            padding: 12px;
            background-color: #007BFF;
            color: #fff;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s, transform 0.3s;
        }

        .button-primary:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }
    </style>
</head>
<body>

    <?php include './Includes/Header.php'; ?>

    <div class="container mt-5">
        <h2>Notificaciones</h2>
        <?php if ($result->num_rows > 0): ?>
            <div class="list-group">
                <?php while ($row = $result->fetch_assoc()): ?>
                    <?php
                    // Obtener el nombre y rol del remitente
                    $remitente = obtenerNombreYRol($conn, $row['outgoing_msg_id'], $row['outgoing_role']);
                    ?>
                    <div class="card">
                        <div class="card-body">
                            <h5>Mensaje de: <?php echo htmlspecialchars($remitente['nombre']); ?> (<?php echo ucfirst($remitente['rol']); ?>)</h5>
                            <p>Contenido: <?php echo htmlspecialchars($row['msg']); ?></p>
                            <p>Fecha: <small><?php echo date('d-m-Y H:i:s', strtotime($row['timestamp'])); ?></small></p>
                            <!-- Se utiliza outgoing_msg_id y outgoing_role para abrir el chat -->
                            <div class="text-center">
                                <a href="Chat.php?user_id=<?php echo htmlspecialchars($row['outgoing_msg_id']); ?>&role=<?php echo htmlspecialchars($row['outgoing_role']); ?>" class="btn btn-primary button-primary" style="border-radius: 40px;">Ir al Chat</a>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <div class="alert alert-info">No tienes nuevas notificaciones.</div>
        <?php endif; ?>
    </div>
</body>
</html>


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
