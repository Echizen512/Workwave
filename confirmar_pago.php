<?php
session_start();
include './config/conexion.php';

if (!isset($_GET['proyecto_id']) || !isset($_GET['paymentID'])) {
    die("Faltan datos para procesar la confirmación del pago.");
}

$proyecto_id = $_GET['proyecto_id'];
$payment_id = $_GET['paymentID']; // Este es el ID de la transacción de PayPal

// Actualizar el estado del pago en la tabla de proyectos
$sql_update = "UPDATE proyectos SET pago = 'Pagado' WHERE id = ?";
$stmt_update = $conn->prepare($sql_update);
$stmt_update->bind_param("i", $proyecto_id);

if ($stmt_update->execute()) {
    // Pago confirmado y actualizado correctamente
    $mensaje = "¡Pago Realizado con Éxito!";
    $color = "#28a745";  // Verde para éxito
} else {
    // En caso de error en el UPDATE
    $mensaje = "Error al actualizar el estado del pago.";
    $color = "#dc3545";  // Rojo para error
}

$stmt_update->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pago Confirmado</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('./2312616.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #fff;
        }
        .confirmation-card {
            background-color: rgba(0, 123, 255, 0.8);
            border-radius: 15px;
            padding: 30px;
            text-align: center;
            max-width: 500px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        }
        .confirmation-card i {
            font-size: 4rem;
            color: <?php echo $color; ?>;
            margin-bottom: 15px;
        }
        .confirmation-card h3 {
            color: #fff;
        }
        .confirmation-card p {
            color: #f8f9fa;
        }
    </style>
</head>
<body>
    <div class="confirmation-card">
        <i class="fas fa-check-circle"></i>
        <h3><?php echo $mensaje; ?></h3>
        <p>Gracias por tu pago. El proyecto se ha actualizado correctamente.</p>
        <a href="inicio.php" class="btn btn-light mt-4">Volver al Inicio</a>
    </div>
</body>
</html>
