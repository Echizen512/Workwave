<?php
session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: index.php");
    exit();
}

include './Dashboard.php';
?>

<?php
include '../config/conexion.php';
define("BD", "WorkWave"); 
define("BACKUP_PATH", __DIR__ . "/backups/"); 

if (!is_dir(BACKUP_PATH)) {
    mkdir(BACKUP_PATH, 0777, true);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Copia de Seguridad</title>
    <link href="../Assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="./Assets/CSS/CRUD.css">
</head>
<body>
<div class="container mt-5">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 mb-4">
                    <div class="card text-center shadow-sm">
                        <div class="card-body">
                            <h3 class="card-title">Realizar Copia de Seguridad</h3>
                            <a href="./Backup.php" class="btn btn-primary mt-3"><i class="fas fa-download"></i> Respaldar</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="card text-center shadow-sm">
                        <div class="card-body">
                            <h3 class="card-title">Restaurar Copia de Seguridad</h3>
                            <form action="./Restore.php" method="post">
                                <div class="form-group">
                                    <label for="restorePoint">Seleccionar Copia</label>
                                    <select id="restorePoint" name="restorePoint" class="form-control mt-3">
                                        <option value="" disabled selected>Seleccionar</option>
                                        <?php
                                        $ruta = BACKUP_PATH;
                                        if (is_dir($ruta)) {
                                            if ($aux = opendir($ruta)) {
                                                while (($archivo = readdir($aux)) !== false) {
                                                    if ($archivo != "." && $archivo != "..") {
                                                        $nombrearchivo = str_replace(".sql", "", $archivo);
                                                        $nombrearchivo = str_replace("-", ":", $nombrearchivo);
                                                        $ruta_completa = $ruta . $archivo;
                                                        if (!is_dir($ruta_completa)) {
                                                            echo '<option value="'.$ruta_completa.'">'.$nombrearchivo.'</option>';
                                                        }
                                                    }
                                                }
                                                closedir($aux);
                                            }
                                        } else {
                                            echo '<option disabled>No es ruta válida</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary mt-3"><i class="fas fa-upload"></i> Restaurar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
