<?php
include '../config/conexion.php';

$alertScript = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['freelancer_nombre'];
    $email = $_POST['freelancer_email'];
    $telefono = $_POST['freelancer_telefono'];
    $direccion = $_POST['freelancer_direccion'];
    $descripcion_habilidades = $_POST['freelancer_descripcion'];
    $portafolio = $_POST['freelancer_portafolio'];
    $contrasena = password_hash($_POST['freelancer_password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO freelancers (nombre, email, telefono, direccion, descripcion_habilidades, portafolio, contrasena) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";

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
        $stmt->bind_param("sssssss", $nombre, $email, $telefono, $direccion, $descripcion_habilidades, $portafolio, $contrasena);

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
    <title>Registro Freelancer</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../Assets/css/bootstrap.min.css">
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
            /* Background image from Unsplash */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 80%;
            margin: 20px;
        }

        .form-container {
            background: #fff;
            padding: 20px;
            /* Reducido el padding para pantallas pequeñas */
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
            /* Reducido el tamaño de fuente para pantallas pequeñas */
            text-align: center;
        }

        .form-group {
            margin-bottom: 15px;
            /* Reducido el margen inferior */
        }

        label {
            display: flex;
            align-items: center;
            margin-bottom: 8px;
            /* Reducido el margen inferior */
            font-weight: bold;
            color: #444;
            font-size: 14px;
            /* Reducido el tamaño de fuente para pantallas pequeñas */
        }

        label i {
            margin-right: 8px;
            /* Reducido el margen derecho */
            color: #007BFF;
            font-size: 16px;
            /* Reducido el tamaño de icono para pantallas pequeñas */
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        textarea {
            width: 100%;
            padding: 12px;
            /* Reducido el padding para pantallas pequeñas */
            border: 1px solid #ddd;
            border-radius: 8px;
            box-sizing: border-box;
        }

        textarea {
            resize: vertical;
            min-height: 120px;
            /* Reducido la altura mínima para pantallas pequeñas */
        }

        button {
            width: 100%;
            padding: 12px;
            /* Reducido el padding para pantallas pequeñas */
            background-color: #007BFF;
            color: #fff;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            /* Reducido el tamaño de fuente para pantallas pequeñas */
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #0056b3;
        }

        /* Media Query para pantallas pequeñas */
        @media (max-width: 768px) {
            .form-container {
                padding: 15px;
                /* Ajustar padding en pantallas pequeñas */
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

    <div class="form-container">
        <h2>Registro Freelancer</h2>
        <form action="register_freelancer.php" method="post">
            <div class="form-group">
                <label for="freelancer_nombre">
                    <i class="fas fa-user"></i> Nombre:
                </label>
                <input type="text" id="freelancer_nombre" name="freelancer_nombre" required>
            </div>

            <div class="form-group">
                <label for="freelancer_email">
                    <i class="fas fa-envelope"></i> Email:
                </label>
                <input type="email" id="freelancer_email" name="freelancer_email" required>
            </div>

            <div class="form-group">
                <label for="freelancer_telefono">
                    <i class="fas fa-phone"></i> Teléfono:
                </label>
                <input type="text" id="freelancer_telefono" name="freelancer_telefono" required>
            </div>

            <div class="form-group">
                <label for="freelancer_direccion">
                    <i class="fas fa-home"></i> Dirección:
                </label>
                <input type="text" id="freelancer_direccion" name="freelancer_direccion" required>
            </div>

            <div class="form-group">
                <label for="freelancer_descripcion">
                    <i class="fas fa-pen"></i> Descripción de habilidades:
                </label>
                <textarea id="freelancer_descripcion" name="freelancer_descripcion" required></textarea>
            </div>

            <div class="form-group">
                <label for="freelancer_portafolio">
                    <i class="fas fa-link"></i> Portafolio o sitio web (opcional):
                </label>
                <input type="text" id="freelancer_portafolio" name="freelancer_portafolio"
                    placeholder="https://www.example.com">
            </div>

            <div class="form-group">
                <label for="freelancer_password">
                    <i class="fas fa-lock"></i> Contraseña:
                </label>
                <input type="password" id="freelancer_password" name="freelancer_password" required>
            </div>
            <div class="btn-container d-flex justify-content-center">
                <button type="submit" style="width: 120px;">Registrar</button>
            </div>
        </form>
    </div>
    <?php echo $alertScript; ?>
</body>

</html>