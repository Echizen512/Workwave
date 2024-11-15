<?php 
session_start();
include './config/conexion.php';

if (!isset($_POST['proyecto_id']) || !isset($_POST['monto'])) {
    die("Faltan datos para procesar el pago.");
}

$proyecto_id = $_POST['proyecto_id'];
$monto = $_POST['monto'];

// Obtener el título del proyecto y el tipo de usuario del propietario
$sql = "SELECT p.titulo, p.tipo_usuario, 
                CASE 
                    WHEN p.tipo_usuario = 'contratistas' THEN c.nombre
                    WHEN p.tipo_usuario = 'freelancers' THEN f.nombre
                    WHEN p.tipo_usuario = 'empresas' THEN e.nombre_empresa
                END AS propietario_nombre,
                CASE 
                    WHEN p.tipo_usuario = 'contratistas' THEN p.contratista_id
                    WHEN p.tipo_usuario = 'freelancers' THEN p.freelancer_id
                    WHEN p.tipo_usuario = 'empresas' THEN p.empresa_id
                END AS propietario_id
        FROM proyectos p
        LEFT JOIN contratistas c ON p.contratista_id = c.id
        LEFT JOIN freelancers f ON p.freelancer_id = f.id
        LEFT JOIN empresas e ON p.empresa_id = e.id
        WHERE p.id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $proyecto_id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

$titulo_proyecto = $row['titulo'];
$tipo_usuario = $row['tipo_usuario'];
$propietario_nombre = $row['propietario_nombre'];
$propietario_id = $row['propietario_id'];
$stmt->close();

// Obtener la cuenta PayPal del propietario
$sql_paypal = "SELECT cuenta_paypal 
                FROM usuarios_paypal 
                WHERE usuario_id = ? AND rol = ?";
$stmt_paypal = $conn->prepare($sql_paypal);
$stmt_paypal->bind_param("is", $propietario_id, $tipo_usuario);
$stmt_paypal->execute();
$result_paypal = $stmt_paypal->get_result();
$row_paypal = $result_paypal->fetch_assoc();
$business_account = $row_paypal['cuenta_paypal'];
$stmt_paypal->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pago por Proyecto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('./2312616.jpg'); /* Cambia la URL por la de tu imagen */
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }
        .payment-form {
            max-width: 600px;
            margin: auto;
            padding: 40px 30px; /* Aumentar padding para que la card sea más alta */
            background-color: rgba(255, 255, 255, 0.9); /* Fondo blanco semi-transparente */
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .payment-form h3 {
            color: #007bff;
        }
        .paypal-button-container {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }
        .payment-info p {
            font-size: 1rem;
            margin-bottom: 10px;
            color: #555;
        }
        .payment-info i {
            margin-right: 10px;
            color: #007bff;
        }
    </style>
</head>
<body>

    <div class="container mt-5">
        <div class="payment-form">
            <h3 class="text-center">¡Seleccione un Método de Pago!</h3>
            <p class="text-center">Monto a pagar: <strong>$<?php echo $monto; ?></strong></p>

            <div class="payment-info">
                <p><i class="fas fa-project-diagram"></i><strong>Título del Proyecto:</strong> <?php echo $titulo_proyecto; ?></p>
                <p><i class="fas fa-user-tag"></i><strong>Tipo de Usuario:</strong> <?php echo ucfirst($tipo_usuario); ?></p>
                <p><i class="fas fa-user"></i><strong>Nombre del Propietario:</strong> <?php echo $propietario_nombre; ?></p>
                <p><i class="fab fa-paypal"></i><strong>Cuenta PayPal del Propietario:</strong> <?php echo !empty($business_account) ? $business_account : 'No disponible'; ?></p>
            </div>

            <?php if (!empty($business_account)) : ?>
                <!-- Método de pago PayPal -->
                <div class="paypal-button-container" id="paypal-button-container"></div>

                <!-- Integración de PayPal SDK -->
                <script src="https://www.paypal.com/sdk/js?client-id=AYDT0nwwfZO2cRUOjsktfxfczeMJftcEicBkI0LQk5DquHgx-Ydk7HbtbWUufT9iQVI65RaGvXmlg2PS&currency=USD"></script>

                <script>
                    paypal.Buttons({
                        style: {
                            color: 'blue',
                            shape: 'pill',
                            label: 'pay',
                            height: 40
                        },
                        createOrder: function(data, actions) {
                            return actions.order.create({
                                purchase_units: [{
                                    amount: {
                                        value: "<?php echo $monto; ?>"
                                    },
                                    description: "Pago por Proyecto: <?php echo $titulo_proyecto; ?>"
                                }]
                            });
                        },
                        onApprove: function(data, actions) {
                            return actions.order.capture().then(function(details) {
                                window.location.href = "http://localhost/Anderson/confirmar_pago.php?proyecto_id=<?php echo $proyecto_id; ?>&paymentID=" + details.id;
                            });
                        },
                        onCancel: function(data) {
                            window.location.href = "http://localhost/Anderson/Inicio.php";
                        }
                    }).render('#paypal-button-container');
                </script>

            <?php else : ?>
                <p class="text-danger text-center">Error: No se encontró una cuenta PayPal para el propietario de este proyecto.</p>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
