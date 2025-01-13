<?php
session_start();
if (!isset($_SESSION['user_id']) || !isset($_SESSION['role'])) {
    header("Location: login.html");
    exit();
}

$user_id = $_SESSION['user_id'];
$role = $_SESSION['role'];

include './config/conexion.php';
include './Includes/Header.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title>Membresías</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://www.paypal.com/sdk/js?client-id=AYDT0nwwfZO2cRUOjsktfxfczeMJftcEicBkI0LQk5DquHgx-Ydk7HbtbWUufT9iQVI65RaGvXmlg2PS"></script>
</head>

<body>

    <style>
        /* Animación de entrada */
@keyframes entrada {
    from {
        opacity: 0;
        transform: translateY(-50px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Animación de agrandar y encoger */
@keyframes pulse {
    0%, 100% {
        transform: scale(1);
    }
    50% {
        transform: scale(1.05);
    }
}

/* Animación de rotación */
@keyframes girar {
    from {
        transform: rotate(0deg);
    }
    to {
        transform: rotate(360deg);
    }
}

.card-header {
    border-top-left-radius: 20px;
    border-top-right-radius: 20px;
    animation: entrada 1s ease-out;
}

.card {
    border-radius: 20px;
    animation: pulse 2s infinite;
}

.fas.fa-star, .fas.fa-crown {
    animation: girar 5s infinite linear;
}

/* Añadir animación a las columnas al pasar el cursor */
.col:hover {
    animation: pulse 0.5s;
}

        footer {
            width: 100vw;
            position: relative;
            left: 0;
            margin-left: calc(-50vw + 50%);
            text-align: center;
        }


    </style>

    <div class="container py-3">
        <div class="card shadow-lg border-primary">
            <div class="card-header bg-primary text-white text-center">
                <h1 class="display-4 fw-normal text-white">Membresías</h1>
            </div>
            <div class="card-body">
                <div class="row row-cols-1 row-cols-md-3 mb-3 text-center">
                    <div class="col">
                        <div class="card mb-4 rounded-3 shadow-sm plan-card">
                            <div class="card-header py-3 bg-primary">
                                <h4 class="my-0 fw-normal" style="font-size: 40px; color: white">
                                    <i class="fas fa-star text-warning"></i> Básico
                                </h4>
                            </div>
                            <div class="card-body">
                                <h1 class="card-title pricing-card-title" style="font-size: 24px;">$15<small
                                        class="text-muted fw-light">/mes</small></h1>
                                <ul class="list-unstyled mt-3 mb-4">
                                    <li><i class="fas fa-home"></i> 2 Proyectos Mensuales</li>
                                    <li><i class="fas fa-credit-card"></i> Pagos a través de PayPal</li>
                                    <li><i class="fas fa-headset"></i> </i>Soporte Técnico de WorkWave</li>
                                </ul>
                                <div id="paypal-button-container-basic"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Plan Plata -->
                    <div class="col">
                        <div class="card mb-4 rounded-3 shadow-sm plan-card">
                            <div class="card-header py-3 bg-primary">
                                <h4 class="my-0 fw-normal" style="font-size: 40px; color: white;">
                                    <i class="fas fa-star text-warning"> </i> Plata
                                </h4>
                            </div>
                            <div class="card-body">
                                <h1 class="card-title pricing-card-title" style="font-size: 24px;">$30<small
                                        class="text-muted fw-light">/mes</small></h1>
                                <ul class="list-unstyled mt-3 mb-4">
                                    <li><i class="fas fa-home"></i> 4 Proyectos Mensuales</li>
                                    <li><i class="fas fa-credit-card"></i> Pagos a través de PayPal</li>
                                    <li><i class="fas fa-headset"></i> </i>Soporte Técnico de WorkWave</li>
                                </ul>
                                <!-- Botón PayPal Plata -->
                                <div id="paypal-button-container-silver"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Plan Oro -->
                    <div class="col">
                        <div class="card mb-4 rounded-3 shadow-sm plan-card">
                            <div class="card-header py-3 bg-primary text-white">
                                <h4 class="my-0 fw-normal" style="font-size: 40px; color: white;">
                                    <i class="fas fa-crown text-warning"></i> Oro
                                </h4>
                            </div>
                            <div class="card-body">
                                <h1 class="card-title pricing-card-title" style="font-size: 24px;">$50<small
                                        class="text-muted fw-light">/mes</small></h1>
                                <ul class="list-unstyled mt-3 mb-4">
                                    <li><i class="fas fa-home"></i> Sin límite de Proyectos Mensuales</li>
                                    <li><i class="fas fa-credit-card"></i> Pagos a través de PayPal</li>
                                    <li><i class="fas fa-headset"></i> </i>Soporte Técnico de WorkWave</li>
                                </ul>
                                <div id="paypal-button-container-gold"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>

    <?php include './Includes/footer.php'; ?>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            paypal.Buttons({
                style: {
                    layout: 'vertical',
                    color: 'blue',
                    shape: 'rect',
                    label: 'paypal'
                },
                createOrder: function (data, actions) {
                    return actions.order.create({
                        purchase_units: [{
                            amount: {
                                value: '15.00'
                            }
                        }]
                    });
                },
                onApprove: function (data, actions) {
                    return actions.order.capture().then(function (details) {
                        const membershipType = 'basic'; 
                        const amount = '15.00'; 
                        window.location.href = `process_paypal.php?membership_type=${membershipType}&amount=${amount}&payment_status=completed&order_id=` + data.orderID;
                    });
                },
                onError: function (err) {
                    window.location.href = 'process_paypal.php?membership_type=basic&payment_status=failed';
                }
            }).render('#paypal-button-container-basic');

            paypal.Buttons({
                style: {
                    layout: 'vertical',
                    color: 'blue',
                    shape: 'rect',
                    label: 'paypal'
                },
                createOrder: function (data, actions) {
                    return actions.order.create({
                        purchase_units: [{
                            amount: {
                                value: '30.00' 
                            }
                        }]
                    });
                },
                onApprove: function (data, actions) {
                    return actions.order.capture().then(function (details) {
                        const membershipType = 'silver'; 
                        const amount = '30.00'; 
                        window.location.href = `process_paypal.php?membership_type=${membershipType}&amount=${amount}&payment_status=completed&order_id=` + data.orderID;
                    });
                },
                onError: function (err) {
                    window.location.href = 'process_paypal.php?membership=silver&payment_status=failed';
                }
            }).render('#paypal-button-container-silver');

            paypal.Buttons({
                style: {
                    layout: 'vertical',
                    color: 'blue', 
                    shape: 'rect', 
                    label: 'paypal' 
                },
                createOrder: function (data, actions) {
                    return actions.order.create({
                        purchase_units: [{
                            amount: {
                                value: '50.00'
                            }
                        }]
                    });
                },
                onApprove: function (data, actions) {
                    return actions.order.capture().then(function (details) {
                        const membershipType = 'gold'; 
                        const amount = '50.00'; 
                        window.location.href = `process_paypal.php?membership_type=${membershipType}&amount=${amount}&payment_status=completed&order_id=` + data.orderID;
                    });
                },
                onError: function (err) {
                    window.location.href = 'process_paypal.php?membership=gold&payment_status=failed';
                }
            }).render('#paypal-button-container-gold');
        });
    </script>

</body>

</html>