<?php
include '../config/conexion.php';


define("BD", "WorkWave"); 
define("SERVER", "localhost"); 
define("USER", "root"); 
define("PASS", ""); 


$restorePoint = $_POST['restorePoint']; 


$sql = explode(";", file_get_contents($restorePoint));
$totalErrors = 0;


set_time_limit(300);


$con = new mysqli(SERVER, USER, PASS, BD);
if ($con->connect_error) {
    die('<script>
            alert("Error al conectar con la base de datos: ' . $con->connect_error . '");
            window.location = "./admin-backup.php";
        </script>');
}


$con->query("SET FOREIGN_KEY_CHECKS=0");


foreach ($sql as $query) {
    $query = trim($query); 
    if (!empty($query)) {
        if (!$con->query($query)) {
            $totalErrors++; 
        }
    }
}


$con->query("SET FOREIGN_KEY_CHECKS=1");


$con->close();


if ($totalErrors <= 0) {
    echo '<script>
            alert("Restauración completada con éxito");
            window.location = "./admin-backup.php";
          </script>';
} else {
    echo '<script>
            alert("Ocurrió un error inesperado, no se pudo realizar la restauración completamente. Total errores: ' . $totalErrors . '");
            window.location = "./admin-backup.php";
          </script>';
}
?>
