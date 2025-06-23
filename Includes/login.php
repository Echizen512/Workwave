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

            if ($user['Estado'] == 0) {
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

            if (password_verify($password, $user['contrasena'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['role'] = $table;


                $tabla = $table;
                $operacion = 'LOGIN';
                $id_registro = $user['id'];
                $usuario_id = $user['id'];
                $rol_usuario = $table; 
                $descripcion = "Inicio de sesión exitoso desde tabla $table";

                $log_stmt = $conn->prepare("INSERT INTO auditoria (tabla, operacion, id_registro, usuario_id, rol_usuario, fecha, descripcion) VALUES (?, ?, ?, ?, ?, NOW(), ?)");
                $log_stmt->bind_param("ssisss", $tabla, $operacion, $id_registro, $usuario_id, $rol_usuario, $descripcion);
                $log_stmt->execute();
                $log_stmt->close();

                header('Location: ../Proyectos.php');
                exit();
            }
        }
    }

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
