<?php
include '../config/conexion.php';

$alertScript = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['contratista_nombre'];
    $email = $_POST['contratista_email'];
    $telefono = $_POST['contratista_telefono'];
    $direccion = $_POST['contratista_direccion'];
    $descripcion_necesidades = isset($_POST['contratista_descripcion']) ? $_POST['contratista_descripcion'] : '';
    $contrasena = password_hash($_POST['contratista_password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO contratistas (nombre, email, telefono, direccion, descripcion_necesidades, contrasena) 
            VALUES (?, ?, ?, ?, ?, ?)";

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
        $stmt->bind_param("ssssss", $nombre, $email, $telefono, $direccion, $descripcion_necesidades, $contrasena);

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
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro Contratista</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="../Assets/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<style>
    body {
    background-image: url('../Assets/images/2312616.jpg');
    font-family: 'Arial', sans-serif;
    background-color: #abdcdf;
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

button {
    width: 100%;
    padding: 12px; 
    background-color: #007BFF;
    color: #fff;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    font-size: 16px; 
    transition: background-color 0.3s;
}

button:hover {
    background-color: #0056b3;
}

/* Media Query para pantallas pequeñas */
@media (max-width: 768px) {
    .form-container {
        padding: 15px; /* Ajustar padding en pantallas pequeñas */
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
<body>
    <div class="form-container">
        <h2>Registro Contratista</h2>
        <form action="register_contratista.php" method="post">
            <div class="form-group">
                <label for="contratista_nombre"><i class="fas fa-user"></i> Nombre:</label>
                <input type="text" id="contratista_nombre" name="contratista_nombre" required>
            </div>
            <div class="form-group">
                <label for="contratista_email"><i class="fas fa-envelope"></i> Email:</label>
                <input type="email" id="contratista_email" name="contratista_email" required>
            </div>
            <div class="form-group">
                <label for="contratista_telefono"><i class="fas fa-phone"></i> Teléfono:</label>
                <input type="text" id="contratista_telefono" name="contratista_telefono" required>
            </div>
            <div class="form-group">
                <label for="contratista_direccion"><i class="fas fa-home"></i> Dirección:</label>
                <input type="text" id="contratista_direccion" name="contratista_direccion" required>
            </div>
            <div class="form-group">
                <label for="contratista_descripcion"><i class="fas fa-align-left"></i> Descripción de necesidades:</label>
                <textarea id="contratista_descripcion" name="contratista_descripcion" required></textarea>
            </div>
            <div class="form-group">
                <label for="contratista_password"><i class="fas fa-lock"></i> Contraseña:</label>
                <input type="password" id="contratista_password" name="contratista_password" required>
            </div>
            <div class="btn-container d-flex justify-content-center">
                <button type="submit" style="width: 120px;">Registrar</button>
            </div>
        </form>               
    </div>
    <?php echo $alertScript; ?>
</body>
</html>
