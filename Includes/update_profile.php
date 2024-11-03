<?php
session_start();
if (!isset($_SESSION['user_id']) || !isset($_SESSION['role'])) {
    header("Location: ../login.html");
    exit();
}

include '../config/conexion.php';
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


$nombre_campo = ($role === 'empresas') ? 'nombre_empresa' : 'nombre';
$nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : '';
$email = isset($_POST['email']) ? trim($_POST['email']) : '';
$telefono = isset($_POST['telefono']) ? trim($_POST['telefono']) : '';
$direccion = isset($_POST['direccion']) ? trim($_POST['direccion']) : '';
$image_url = isset($_POST['image_url']) ? trim($_POST['image_url']) : '';
$sitio_web = ($role === 'empresas') ? (isset($_POST['sitio_web']) ? trim($_POST['sitio_web']) : '') : null;
$portafolio = ($role === 'contratistas' || $role === 'freelancers') ? (isset($_POST['portafolio']) ? trim($_POST['portafolio']) : '') : null;
$curriculum_path = null;


if ($role === 'freelancers' && isset($_FILES['curriculum']) && $_FILES['curriculum']['error'] == UPLOAD_ERR_OK) {
    $curriculum_name = $_FILES['curriculum']['name'];
    $curriculum_tmp_name = $_FILES['curriculum']['tmp_name'];
    $curriculum_path = __DIR__ . '/../Assets/doc/' . basename($curriculum_name);

    if (move_uploaded_file($curriculum_tmp_name, $curriculum_path)) {

    } else {
        die("Error al mover el archivo a la carpeta Assets/doc.");
    }
} elseif (($role === 'empresas' || $role === 'contratistas') && isset($_FILES['doc_rif']) && $_FILES['doc_rif']['error'] == UPLOAD_ERR_OK) {

    $doc_rif_name = $_FILES['doc_rif']['name'];
    $doc_rif_tmp_name = $_FILES['doc_rif']['tmp_name'];
    $doc_rif_path = __DIR__ . '/../Assets/doc/' . basename($doc_rif_name);

    if (move_uploaded_file($doc_rif_tmp_name, $doc_rif_path)) {

    } else {
        die("Error al mover el archivo a la carpeta Assets/doc.");
    }
} else {

    if ($role === 'freelancers') {
        $curriculum_path = null;
        echo "Error al subir el archivo del currículum: " . $_FILES['curriculum']['error'];
    } elseif ($role === 'empresas' || $role === 'contratistas') {
        echo "Error al subir el archivo: " . $_FILES['doc_rif']['error'];
    }
}


if ($role === 'empresas') {
    $sql = "UPDATE $table SET $nombre_campo = ?, email = ?, telefono = ?, direccion = ?, image_url = ?, sitio_web = ?, doc_rif = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Error al preparar la consulta: " . $conn->error);
    }
    $stmt->bind_param("sssssssi", $nombre, $email, $telefono, $direccion, $image_url, $sitio_web, $doc_rif_path, $userId);
} elseif ($role === 'contratistas') {
    $sql = "UPDATE $table SET $nombre_campo = ?, email = ?, telefono = ?, direccion = ?, image_url = ?, portafolio = ?, doc_rif = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Error al preparar la consulta: " . $conn->error);
    }
    $stmt->bind_param("sssssssi", $nombre, $email, $telefono, $direccion, $image_url, $portafolio, $doc_rif_path, $userId);
} elseif ($role === 'freelancers') {
    $sql = "UPDATE $table SET $nombre_campo = ?, email = ?, telefono = ?, direccion = ?, image_url = ?, portafolio = ?, curriculum = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Error al preparar la consulta: " . $conn->error);
    }
    $stmt->bind_param("sssssssi", $nombre, $email, $telefono, $direccion, $image_url, $portafolio, $curriculum_path, $userId);
}


if ($stmt->execute()) {
    header("Location: ../Perfil.php?status=success");
} else {
    echo "Error al actualizar los datos: " . $stmt->error;
}


$stmt->close();
$conn->close();
?>