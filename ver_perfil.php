<?php
session_start();

// Verifica si hay una sesión activa
if (!isset($_SESSION['user_id']) || !isset($_SESSION['role'])) {
    header("Location: login.html");
    exit();
}

include './config/conexion.php';
include "./Includes/Header.php";

$userId = isset($_GET['usuario_id']) ? intval($_GET['usuario_id']) : 0;
$userRole = isset($_GET['rol_solicitante']) ? $_GET['rol_solicitante'] : '';

if (!$userId || !$userRole) {
    die("Invalid user ID or role.");
}

$table = "";

if ($userRole === 'contratistas') {
    $table = "contratistas";
} elseif ($userRole === 'empresas') {
    $table = "empresas";
} elseif ($userRole === 'freelancers') {
    $table = "freelancers";
} else {
    die("Role not recognized");
}

// Preparar y ejecutar la consulta
$sql = "SELECT * FROM $table WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $userData = $result->fetch_assoc();
} else {
    echo "No user found.";
    exit();
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Profile View</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style type="text/css">
        .card {
            position: relative;
            display: flex;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 0 solid transparent;
            border-radius: .25rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 2px 6px 0 rgb(218 218 253 / 65%), 0 2px 6px 0 rgb(206 206 238 / 54%);
        }
        .me-2 {
            margin-right: .5rem !important;
        }
    </style>
</head>
<body>
<br><br>
<div class="container">
    <div class="main-body">
        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-column align-items-center text-center">
                            <?php 
                            $imageURL = $userData['image_url'] ?? "https://bootdey.com/img/Content/avatar/avatar6.png";
                            ?>
                            <img src="<?php echo htmlspecialchars($imageURL); ?>" alt="Profile Image" class="rounded-circle p-1 bg-primary" width="110">
                            <div class="mt-3">
                                <h4><?php echo htmlspecialchars($userRole === 'empresas' ? $userData['nombre_empresa'] : $userData['nombre']); ?></h4>
                                <p class="text-secondary mb-1"><?php echo $userRole === 'empresas' ? htmlspecialchars($userData['nombre_empresa']) : 'Usuario'; ?></p>
                                <p class="text-muted font-size-sm"><?php echo htmlspecialchars($userData['direccion']); ?></p>
                                <button class="btn btn-outline-primary">Mensaje</button>
                            </div>
                        </div>
                        <hr class="my-4">
                        <ul class="list-group list-group-flush">
                            <?php if ($userRole === 'contratistas' || $userRole === 'freelancers') : ?>
                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <h6 class="mb-0">Portafolio</h6>
                                    <span class="text-secondary"><?php echo htmlspecialchars($userData['portafolio'] ?? 'N/A'); ?></span>
                                </li>
                            <?php elseif ($userRole === 'empresas') : ?>
                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <h6 class="mb-0">Página Web</h6>
                                    <span class="text-secondary"><?php echo htmlspecialchars($userData['sitio_web'] ?? 'N/A'); ?></span>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Nombre</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <p><?php echo htmlspecialchars($userRole === 'empresas' ? $userData['nombre_empresa'] : $userData['nombre']); ?></p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Email</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <p><?php echo htmlspecialchars($userData['email']); ?></p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Teléfono</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <p><?php echo htmlspecialchars($userData['telefono']); ?></p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Dirección</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <p><?php echo htmlspecialchars($userData['direccion']); ?></p>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "./Includes/Footer.php"; ?>

</body>
</html>
