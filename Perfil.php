<?php
session_start();

// Verifica si hay una sesión activa
if (!isset($_SESSION['user_id']) || !isset($_SESSION['role'])) {
    header("Location: login.html");
    exit();
}

include './config/conexion.php';
include "./Includes/Header.php";

$userId = $_SESSION['user_id'];
$role = $_SESSION['role'];
$table = "";

if ($role === 'contratistas') {
    $table = "contratistas";
} elseif ($role === 'empresas') {
    $table = "empresas";
} elseif ($role === 'freelancers') {
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

$paypalSql = "SELECT cuenta_paypal FROM usuarios_paypal WHERE usuario_id = ?";
$paypalStmt = $conn->prepare($paypalSql);
$paypalStmt->bind_param("i", $userId);
$paypalStmt->execute();
$paypalResult = $paypalStmt->get_result();
$paypalData = $paypalResult->fetch_assoc();

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Perfil</title>
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

        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal-content {
            background-color: #fff;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
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
                                <img src="<?php echo htmlspecialchars($imageURL); ?>" alt="Admin"
                                    class="rounded-circle p-1 bg-primary" width="110">
                                <div class="mt-3">
                                    <h4><?php echo htmlspecialchars($role === 'empresas' ? $userData['nombre_empresa'] : $userData['nombre']); ?>
                                    </h4>
                                    <p class="text-secondary mb-1">
                                        <?php echo $role === 'empresas' ? 'Empresa' : 'Usuario'; ?></p>
                                    <p class="text-muted font-size-sm">
                                        <?php echo htmlspecialchars($userData['direccion']); ?></p>
                                    <?php $membershipType = htmlspecialchars($userData['membership_type']);

                                    $displayText = "";
                                    $colorClass = "";

                                    if ($membershipType === "gold") {
                                        $displayText = "Gold";
                                        $colorClass = "text-warning"; 
                                    } elseif ($membershipType === "silver") {
                                        $displayText = "Silver";
                                        $colorClass = "text-secondary"; 
                                    } elseif ($membershipType === "basic") {
                                        $displayText = "Basic";
                                        $colorClass = "text-primary"; 
                                    }
                                    ?>

                                    <p class="font-size-sm <?php echo $colorClass; ?>">
                                        <?php echo $displayText; ?>
                                    </p>


                                    <button class="btn btn-outline-primary"
                                        onclick="location.href='Notificaciones.php'">Revisar Chat</button>
                                    <button class="btn btn-outline-primary" onclick="openPaypalModal()">Cuenta
                                        PayPal</button>


                                </div>
                            </div>
                            <hr class="my-4">
                            <ul class="list-group list-group-flush">
                                <?php if ($role === 'contratistas' || $role === 'freelancers'): ?>
                                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                        <h6 class="mb-0">Portafolio</h6>
                                        <span
                                            class="text-secondary"><?php echo htmlspecialchars($userData['portafolio'] ?? 'N/A'); ?></span>
                                    </li>
                                <?php elseif ($role === 'empresas'): ?>
                                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                        <h6 class="mb-0">Página Web</h6>
                                        <span
                                            class="text-secondary"><?php echo htmlspecialchars($userData['sitio_web'] ?? 'N/A'); ?></span>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <form method="post" action="./Includes/update_profile.php" enctype="multipart/form-data">
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Nombre</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" class="form-control" name="nombre"
                                            value="<?php echo htmlspecialchars($role === 'empresas' ? $userData['nombre_empresa'] : $userData['nombre']); ?>">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Email</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="email" class="form-control" name="email"
                                            value="<?php echo htmlspecialchars($userData['email']); ?>">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Teléfono</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="number" class="form-control" name="telefono"
                                            value="<?php echo htmlspecialchars($userData['telefono']); ?>">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Dirección</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" class="form-control" name="direccion"
                                            value="<?php echo htmlspecialchars($userData['direccion']); ?>">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">URL de la Imagen</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" class="form-control" name="image_url"
                                            value="<?php echo htmlspecialchars($userData['image_url']); ?>">
                                    </div>
                                </div>

                                <!-- Campo para subir sitio web -->
                                <?php if ($role === 'empresas'): ?>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Sitio Web</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="url" class="form-control" name="sitio_web"
                                                value="<?php echo htmlspecialchars($userData['sitio_web'] ?? ''); ?>">
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <!-- Campo para subir portafolio -->
                                <?php if ($role === 'contratistas' || $role === 'freelancers'): ?>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Portafolio (URL)</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="url" class="form-control" name="portafolio"
                                                value="<?php echo htmlspecialchars($userData['portafolio'] ?? ''); ?>">
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <!-- Campo para subir documento RIF -->
                                <?php if ($role === 'empresas' || $role === 'contratistas'): ?>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Documento RIF</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="file" class="form-control" name="doc_rif"
                                                accept=".pdf,.png,.jpg,.jpeg">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3"></div>
                                        <div class="col-sm-9 text-secondary">
                                            <?php if (!empty($userData['doc_rif'])): ?>
                                                <a href="/Anderson/Assets/doc/<?php echo basename($userData['doc_rif']); ?>"
                                                    class="btn btn-success me-2" download>Descargar RIF</a>


                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <!-- Campo para subir curriculum -->
                                <?php if ($role === 'contratistas' || $role === 'freelancers'): ?>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Currículum</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="file" class="form-control" name="curriculum"
                                                accept=".pdf,.doc,.docx">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3"></div>
                                        <div class="col-sm-9 text-secondary">
                                            <?php if (!empty($userData['curriculum'])): ?>
                                                <a href="/Anderson/Assets/doc/<?php echo basename($userData['curriculum']); ?>"
                                                    class="btn btn-success me-2" download>Descargar Currículum</a>

                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <div class="row mb-3">
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-9 text-secondary text-center">
                                        <button type="submit" class="btn btn-primary" style="border-radius: 20px;">Guardar Cambios</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include './Includes/Footer.php'; ?>

    <!-- Modal de PayPal -->
    <div id="paypalModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closePaypalModal()">&times;</span>
            <h5>Cuenta PayPal</h5>
            <form method="post" action="update_paypal.php">
                <div class="form-group">
                    <label for="paypal_account">Cuenta PayPal:</label>
                    <input type="email" class="form-control" id="paypal_account" name="paypal_account"
                        value="<?php echo htmlspecialchars($paypalData['cuenta_paypal'] ?? ''); ?>" required>
                </div>
                <div>
                    <input type="hidden" name="user_id" value="<?php echo $userId; ?>">
                    <button type="submit" class="btn btn-primary mt-2">Guardar</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Abrir el modal
        function openPaypalModal() {
            document.getElementById("paypalModal").style.display = "block";
        }

        // Cerrar el modal
        function closePaypalModal() {
            document.getElementById("paypalModal").style.display = "none";
        }

        // Cerrar el modal si el usuario hace clic fuera de él
        window.onclick = function (event) {
            if (event.target == document.getElementById("paypalModal")) {
                closePaypalModal();
            }
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Validar nombre y dirección (solo letras y espacios)
        function validarTexto(texto) {
            return /^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/.test(texto);
        }

        // Validar teléfono (exactamente 11 dígitos)
        function validarTelefono(telefono) {
            return /^[0-9]{11}$/.test(telefono);
        }

        // Validar URL
        function validarURL(url) {
            try {
                new URL(url);
                return true;
            } catch (_) {
                return false;
            }
        }

        document.querySelector("form").addEventListener("submit", function (e) {
            const nombre = document.querySelector("input[name='nombre']").value;
            const direccion = document.querySelector("input[name='direccion']").value;
            const telefono = document.querySelector("input[name='telefono']").value;
            const imageUrl = document.querySelector("input[name='image_url']").value;
            const sitioWeb = document.querySelector("input[name='sitio_web']")?.value;
            const portafolio = document.querySelector("input[name='portafolio']")?.value;

            if (!validarTexto(nombre)) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error en el Nombre',
                    text: 'El nombre solo puede contener letras y espacios.'
                });
                e.preventDefault();
                return;
            }

            if (!validarTexto(direccion)) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error en la Dirección',
                    text: 'La dirección solo puede contener letras y espacios.'
                });
                e.preventDefault();
                return;
            }

            if (!validarTelefono(telefono)) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error en el Teléfono',
                    text: 'El teléfono debe contener exactamente 11 dígitos.'
                });
                e.preventDefault();
                return;
            }

            if (imageUrl && !validarURL(imageUrl)) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error en la URL de la Imagen',
                    text: 'La URL de la imagen no es válida.'
                });
                e.preventDefault();
                return;
            }

            if (sitioWeb && !validarURL(sitioWeb)) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error en la URL del Sitio Web',
                    text: 'La URL del sitio web no es válida.'
                });
                e.preventDefault();
                return;
            }

            if (portafolio && !validarURL(portafolio)) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error en la URL del Portafolio',
                    text: 'La URL del portafolio no es válida.'
                });
                e.preventDefault();
                return;
            }
        });
    </script>




</body>

</html>