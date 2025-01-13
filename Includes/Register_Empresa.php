<?php
include '../config/conexion.php';

$alertScript = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_empresa = $_POST['empresa_nombre'];
    $email = $_POST['empresa_email'];
    $telefono = $_POST['empresa_telefono'];
    $rif = $_POST['empresa_rif'];
    $direccion = $_POST['empresa_direccion'];
    $descripcion_empresa = $_POST['empresa_descripcion'];
    $sitio_web = $_POST['empresa_sitio_web'];
    $contrasena = password_hash($_POST['empresa_password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO empresas (nombre_empresa, email, telefono, rif, direccion, descripcion_empresa, sitio_web, contrasena) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        $alertScript = '
            <script>
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: "Error en la preparación de la consulta: ' . $conn->error . '"
                });
            </script>';
    } else {
        $stmt->bind_param("ssssssss", $nombre_empresa, $email, $telefono, $rif, $direccion, $descripcion_empresa, $sitio_web, $contrasena);

        if ($stmt->execute()) {
            $alertScript = '
                <script>
                    Swal.fire({
                        icon: "success",
                        title: "Registro exitoso",
                        text: "Serás redirigido al login.",
                        confirmButtonText: "Aceptar"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "login.html";
                        }
                    });
                </script>';
        } else {
            $alertScript = '
                <script>
                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: "' . $stmt->error . '"
                    });
                </script>';
        }

        $stmt->close();
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro Empresa</title>
    <link rel="stylesheet" href="../Assets/css/bootstrap.min.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        body {
            font-family: 'Arial', sans-serif;
            background-image: url('../Assets/images/2312616.jpg');
            display: flex;
            justify-content: center;
            align-items: center;
            height: 80%;
            margin: 20px;
        }

        .form-container {
            background: #fff;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
            width: 100%;
            max-width: 700px;
            box-sizing: border-box;
            animation: fadeIn 0.5s ease-out;
        }

        h2 {
            margin-top: 0;
            color: #333;
            font-size: 24px;
            text-align: center;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: flex;
            align-items: center;
            margin-bottom: 8px;
            font-weight: bold;
            color: #444;
            font-size: 14px;
        }

        label i {
            margin-right: 8px;
            color: #007BFF;
            font-size: 16px;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-sizing: border-box;
        }

        textarea {
            resize: vertical;
            min-height: 120px;
        }


        button:hover {
            background-color: #0056b3;
        }

        /* Media Query para pantallas pequeñas */
        @media (max-width: 768px) {
            .form-container {
                padding: 15px;
            }

            h2 {
                font-size: 20px;
            }

            label {
                font-size: 12px;
            }

            input[type="text"],
            input[type="email"],
            input[type="password"],
            textarea {
                padding: 10px;
            }

            button {
                font-size: 14px;
            }
        }
    </style>
</head>

<body>
    <form id="registrationForm" class="form-container" action="register_empresa.php" method="post">
        <h2>Registro Empresa</h2>
        <!-- Step 1 -->
        <div class="step active">
            <div class="form-group">
                <label for="empresa_nombre">
                    <i class="fas fa-building"></i> Nombre de la Empresa:
                </label>
                <input id="empresa_nombre" type="text" name="empresa_nombre" required />
            </div>

            <div class="form-group">
                <label for="empresa_email">
                    <i class="fas fa-envelope"></i> Correo Electrónico:
                </label>
                <input id="empresa_email" type="email" name="empresa_email" required />
            </div>

            <div class="form-group">
                <label for="empresa_telefono">
                    <i class="fas fa-phone"></i> Teléfono:
                </label>
                <input id="empresa_telefono" type="text" name="empresa_telefono" required />
            </div>

            <div class="form-group">
                <label for="empresa_rif">
                    <i class="fas fa-id-card"></i> RIF:
                </label>
                <input id="empresa_rif" type="text" name="empresa_rif" required />
            </div>
        </div>
        <!-- Step 2 -->
        <div class="step">
            <div class="form-group">
                <label for="empresa_direccion">
                    <i class="fas fa-map-marker-alt"></i> Dirección:
                </label>
                <input id="empresa_direccion" type="text" name="empresa_direccion" required />
            </div>

            <div class="form-group">
                <label for="empresa_descripcion">
                    <i class="fas fa-briefcase"></i> Descripción de la Empresa:
                </label>
                <textarea id="empresa_descripcion" name="empresa_descripcion" required></textarea>
            </div>
        </div>
        <!-- Step 3 -->
        <div class="step">
            <div class="form-group">
                <label for="empresa_sitio_web">
                    <i class="fas fa-link"></i> Sitio Web:
                </label>
                <input id="empresa_sitio_web" type="text" name="empresa_sitio_web" required />
            </div>

            <div class="form-group">
                <label for="empresa_password">
                    <i class="fas fa-lock"></i> Contraseña:
                </label>
                <input id="empresa_password" type="password" name="empresa_password" required />
            </div>

            <div class="btn-container d-flex justify-content-center">
                <button type="submit" class="btn btn-primary" style="width: 120px;">Registrar</button>
            </div>
        </div>
    </form>
    <?php echo $alertScript; ?>

    <script>
        const steps = document.querySelectorAll('.step');
        let currentStep = 0;

        function showStep(stepIndex) {
            steps.forEach((step, index) => {
                step.classList.toggle('active', index === stepIndex);
            });
        }

        function nextStep() {
            if (currentStep < steps.length - 1) {
                currentStep++;
                showStep(currentStep);
            }
        }

        function prevStep() {
            if (currentStep > 0) {
                currentStep--;
                showStep(currentStep);
            }
        }
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>