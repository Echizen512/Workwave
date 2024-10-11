<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<?php
session_start();
require '../config/conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['contrasena'];

    $tables = ['empresas', 'freelancers', 'contratistas'];

    foreach ($tables as $table) {
        $sql = "SELECT * FROM $table WHERE email = ?";
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            die("Error en la preparación de la consulta: " . $conn->error);
        }
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $user = $result->fetch_assoc();

            // Verifica si el Estado del usuario es inactivo (0)
            if ($user['Estado'] == 0) {
                // Redirige a login.html con un mensaje de error
                echo "<script>
                    window.onload = function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Usuario inactivo',
                            text: 'Tu cuenta está inactiva. Por favor, contacta al administrador.'
                        }).then(function() {
                            window.location = '../login.html';
                        });
                    };
                </script>";
                exit();
            }

            // Verifica la contraseña utilizando password_verify
            if (password_verify($password, $user['contrasena'])) {
                // Almacena el ID del usuario y el rol en la sesión
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['role'] = $table;

                // Redirige al usuario según su rol
                header('Location: ../Inicio.php');
                exit();
            }
        }
    }

    // Si no se encontró un usuario o la contraseña es incorrecta
    echo "<script>
        window.onload = function() {
            Swal.fire({
                icon: 'error',
                title: 'Error de autenticación',
                text: 'Email o contraseña incorrectos.'
            }).then(function() {
                window.location = '../login.html';
            });
        };
    </script>";
}
?>
