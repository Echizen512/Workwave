<?php
include '../config/conexion.php';

// Definir constantes necesarias
define("BD", "WorkWave"); // Nombre de la base de datos
define("BACKUP_PATH", __DIR__ . "/backups/"); // Ruta a la carpeta de backups

// Crear la carpeta de backups si no existe
if (!is_dir(BACKUP_PATH)) {
    mkdir(BACKUP_PATH, 0777, true);
}

// Generar el nombre del archivo de respaldo
$day = date("d");
$mont = date("m");
$year = date("Y");
$hora = date("H-i-s");
$fecha = $day . '_' . $mont . '_' . $year;
$DataBASE = $fecha . "_(" . $hora . "_hrs).sql";

$tables = array();
$error = 0;

// Obtener todas las tablas de la base de datos
$result = $conn->query('SHOW TABLES');
if ($result) {
    while ($row = $result->fetch_row()) {
        $tables[] = $row[0];
    }

    $sql = 'SET FOREIGN_KEY_CHECKS=0;' . "\n\n";
    $sql .= 'CREATE DATABASE IF NOT EXISTS ' . BD . ";\n\n";
    $sql .= 'USE ' . BD . ";\n\n";

    // Generar el script para cada tabla
    foreach ($tables as $table) {
        $result = $conn->query('SELECT * FROM ' . $table);
        if ($result) {
            $numFields = $result->field_count;
            $sql .= 'DROP TABLE IF EXISTS ' . $table . ';';
            $row2 = $conn->query('SHOW CREATE TABLE ' . $table)->fetch_row();
            $sql .= "\n\n" . $row2[1] . ";\n\n";

            while ($row = $result->fetch_row()) {
                $sql .= 'INSERT INTO ' . $table . ' VALUES(';
                for ($j = 0; $j < $numFields; $j++) {
                    $row[$j] = addslashes($row[$j]);
                    $row[$j] = str_replace("\n", "\\n", $row[$j]);
                    $sql .= isset($row[$j]) ? '"' . $row[$j] . '"' : '""';
                    if ($j < ($numFields - 1)) {
                        $sql .= ',';
                    }
                }
                $sql .= ");\n";
            }
            $sql .= "\n\n\n";
        } else {
            $error = 1;
            break;
        }
    }

    if ($error == 1) {
        echo '<script>
        alert("Ocurrió un error al realizar la copia de seguridad!");
        window.location = "./admin-backup.php";
      </script>';
    } else {
        chmod(BACKUP_PATH, 0777);
        $sql .= 'SET FOREIGN_KEY_CHECKS=1;';
        $handle = fopen(BACKUP_PATH . $DataBASE, 'w+');
        if (fwrite($handle, $sql)) {
            fclose($handle);
            echo '<script>
            alert("Copia de seguridad realizada con éxito!");
            window.location = "./admin-backup.php";
          </script>';
        } else {
            echo '<script>
            alert("Ocurrió un error al realizar la copia de seguridad!");
            window.location = "./admin-backup.php";
          </script>';
        }
    }
} else {
    echo '<script>
    alert("Ocurrió un error al realizar la copia de seguridad!");
    window.location = "./admin-backup.php";
  </script>';
}

$conn->close();
?>
