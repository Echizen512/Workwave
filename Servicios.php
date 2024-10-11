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

<link href="./Assets/css/style.css" rel="stylesheet">

<body>
<div class="page-header container-fluid bg-secondary pt-2 pt-lg-5 pb-2 mb-5">
    <div class="container py-5">
        <div class="row align-items-center py-4">
            <div class="col-md-6 text-center text-md-left">
                <h1 class="mb-4 mb-md-0 text-white">Servicios</h1>
            </div>
            <div class="col-md-6 text-center text-md-right">
                <div class="d-inline-flex align-items-center">
                    <a class="btn text-white" href="">Inicio</a>
                    <i class="fas fa-angle-right text-white"></i>
                    <a class="btn text-white disabled" href="">Servicios</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid pt-5 pb-3">
    <div class="container">
        <h6 class="text-secondary text-uppercase text-center font-weight-medium mb-3">Nuestros Servicios</h6>
        <h1 class="display-4 text-center mb-5">Lo Que Ofrecemos</h1>
        <div class="row">
            <div class="col-lg-3 col-md-6 pb-1">
                <div class="d-flex flex-column align-items-center justify-content-center text-center bg-light mb-4 px-4" style="height: 300px;">
                    <div class="d-inline-flex align-items-center justify-content-center bg-white shadow rounded-circle mb-4" style="width: 100px; height: 100px;">
                        <i class="fa fa-3x fa-laptop-code text-secondary"></i>
                    </div>
                    <h4 class="font-weight-bold m-0">Aplicaciones Web</h4>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 pb-1">
                <div class="d-flex flex-column align-items-center justify-content-center text-center bg-light mb-4 px-4" style="height: 300px;">
                    <div class="d-inline-flex align-items-center justify-content-center bg-white shadow rounded-circle mb-4" style="width: 100px; height: 100px;">
                        <i class="fa fa-3x fa-mobile-alt text-secondary"></i>
                    </div>
                    <h4 class="font-weight-bold m-0">Aplicaciones Móviles</h4>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 pb-1">
                <div class="d-flex flex-column align-items-center justify-content-center text-center bg-light mb-4 px-4" style="height: 300px;">
                    <div class="d-inline-flex align-items-center justify-content-center bg-white shadow rounded-circle mb-4" style="width: 100px; height: 100px;">
                        <i class="fa fa-3x fa-gamepad text-secondary"></i>
                    </div>
                    <h4 class="font-weight-bold m-0">Desarrollo de Juegos</h4>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 pb-1">
                <div class="d-flex flex-column align-items-center justify-content-center text-center bg-light mb-4 px-4" style="height: 300px;">
                    <div class="d-inline-flex align-items-center justify-content-center bg-white shadow rounded-circle mb-4" style="width: 100px; height: 100px;">
                        <i class="fa fa-3x fa-cogs text-secondary"></i>
                    </div>
                    <h4 class="font-weight-bold m-0">Software a Medida</h4>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 pb-1">
                <div class="d-flex flex-column align-items-center justify-content-center text-center bg-light mb-4 px-4" style="height: 300px;">
                    <div class="d-inline-flex align-items-center justify-content-center bg-white shadow rounded-circle mb-4" style="width: 100px; height: 100px;">
                        <i class="fa fa-3x fa-plug text-secondary"></i>
                    </div>
                    <h4 class="font-weight-bold m-0">Desarrollo de APIs</h4>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 pb-1">
                <div class="d-flex flex-column align-items-center justify-content-center text-center bg-light mb-4 px-4" style="height: 300px;">
                    <div class="d-inline-flex align-items-center justify-content-center bg-white shadow rounded-circle mb-4" style="width: 100px; height: 100px;">
                        <i class="fa fa-3x fa-link text-secondary"></i>
                    </div>
                    <h4 class="font-weight-bold m-0">Integración de Sistemas</h4>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 pb-1">
                <div class="d-flex flex-column align-items-center justify-content-center text-center bg-light mb-4 px-4" style="height: 300px;">
                    <div class="d-inline-flex align-items-center justify-content-center bg-white shadow rounded-circle mb-4" style="width: 100px; height: 100px;">
                        <i class="fa fa-3x fa-paint-brush text-secondary"></i>
                    </div>
                    <h4 class="font-weight-bold m-0">Diseño de UX/UI</h4>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 pb-1">
                <div class="d-flex flex-column align-items-center justify-content-center text-center bg-light mb-4 px-4" style="height: 300px;">
                    <div class="d-inline-flex align-items-center justify-content-center bg-white shadow rounded-circle mb-4" style="width: 100px; height: 100px;">
                        <i class="fa fa-3x fa-robot text-secondary"></i>
                    </div>
                    <h4 class="font-weight-bold m-0">Automatización de Procesos</h4>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include './Includes/Footer.php'; ?>

</body>

</html>