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

<div class="page-header container-fluid bg-secondary pt-2 pt-lg-5 pb-2 mb-5">
    <div class="container py-5">
        <div class="row align-items-center py-4">
            <div class="col-md-6 text-center text-md-left">
                <h1 class="mb-4 mb-md-0 text-white">Información</h1>
            </div>
            <div class="col-md-6 text-center text-md-right">
                <div class="d-inline-flex align-items-center">
                    <a class="btn text-white" href="">Inicio</a>
                    <i class="fas fa-angle-right text-white"></i>
                    <a class="btn text-white disabled" href="">Información</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-5">
                <img class="img-fluid" src="./Assets/images/about.png" alt="">
            </div>
            <div class="col-lg-7 mt-5 mt-lg-0 pl-lg-5">
                <h6 class="text-secondary text-uppercase font-weight-medium mb-3">Conoce Más de Nosotros</h6>
                <h1 class="mb-4">Somos Líderes en Soluciones Digitales Innovadoras</h1>
                <h5 class="font-weight-medium font-italic mb-4">En WorkWave, transformamos tus ideas en proyectos exitosos mediante tecnologías avanzadas y un equipo experto.</h5>
                <p class="mb-2">Nos especializamos en el desarrollo de software, gestión de proyectos y soluciones de tecnología para empresas de todos los tamaños, con el objetivo de optimizar sus procesos y mejorar su rendimiento.</p>
                <div class="row">
                    <div class="col-sm-6 pt-3">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-check-circle text-primary mr-2"></i>
                            <p class="text-secondary font-weight-medium m-0">Innovación Constante</p>
                        </div>
                    </div>
                    <div class="col-sm-6 pt-3">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-user-shield text-primary mr-2"></i>
                            <p class="text-secondary font-weight-medium m-0">Seguridad y Confianza</p>
                        </div>
                    </div>
                    <div class="col-sm-6 pt-3">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-users text-primary mr-2"></i>
                            <p class="text-secondary font-weight-medium m-0">Equipo Profesional</p>
                        </div>
                    </div>
                    <div class="col-sm-6 pt-3">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-handshake text-primary mr-2"></i>
                            <p class="text-secondary font-weight-medium m-0">Compromiso con el Cliente</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid pt-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 mb-4 d-flex">
                <div class="bg-secondary text-center p-4 w-100 d-flex flex-column justify-content-between">
                    <i class="fas fa-bullseye fa-3x text-white mb-3"></i>
                    <h4 class="text-white mb-3">Misión</h4>
                    <p class="text-white m-0">Nuestra misión es brindar soluciones tecnológicas innovadoras que faciliten el crecimiento y la transformación digital de nuestros clientes, ayudándoles a alcanzar sus objetivos empresariales.</p>
                </div>
            </div>
            <div class="col-lg-4 mb-4 d-flex">
                <div class="bg-secondary text-center p-4 w-100 d-flex flex-column justify-content-between">
                    <i class="fas fa-eye fa-3x text-white mb-3"></i>
                    <h4 class="text-white mb-3">Visión</h4>
                    <p class="text-white m-0">Ser reconocidos como líderes en la creación de soluciones digitales que impulsen la eficiencia y competitividad en un mundo en constante evolución tecnológica.</p>
                </div>
            </div>
            <div class="col-lg-4 mb-4 d-flex">
                <div class="bg-secondary text-center p-4 w-100 d-flex flex-column justify-content-between">
                    <i class="fas fa-tasks fa-3x text-white mb-3"></i>
                    <h4 class="text-white mb-3">Objetivos</h4>
                    <ul class="list-unstyled text-white m-0">
                        <li><i class="fas fa-check-circle text-primary mr-2"></i> Fomentar la innovación tecnológica</li>
                        <li><i class="fas fa-check-circle text-primary mr-2"></i> Mejorar la eficiencia operativa</li>
                        <li><i class="fas fa-check-circle text-primary mr-2"></i> Fortalecer la satisfacción del cliente</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="container-fluid py-5">
    <div class="container">
        <h6 class="text-secondary text-uppercase text-center font-weight-medium mb-3">Categorías de Proyectos</h6>
        <h1 class="display-4 text-center mb-5">Nuestros Servicios</h1>
        <div class="row">
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="d-flex flex-column align-items-center justify-content-center text-center h-100 bg-light p-4">
                    <i class="fas fa-laptop-code fa-4x text-primary mb-4"></i>
                    <h4 class="font-weight-bold m-0">Desarrollo de Software</h4>
                    <p class="m-0">Aplicaciones a medida que impulsan tu negocio.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="d-flex flex-column align-items-center justify-content-center text-center h-100 bg-light p-4">
                    <i class="fas fa-chart-line fa-4x text-primary mb-4"></i>
                    <h4 class="font-weight-bold m-0">Consultoría Tecnológica</h4>
                    <p class="m-0">Estrategias para optimizar tus recursos y procesos.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="d-flex flex-column align-items-center justify-content-center text-center h-100 bg-light p-4">
                    <i class="fas fa-network-wired fa-4x text-primary mb-4"></i>
                    <h4 class="font-weight-bold m-0">Infraestructura IT</h4>
                    <p class="m-0">Soluciones robustas para tu entorno tecnológico.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="d-flex flex-column align-items-center justify-content-center text-center h-100 bg-light p-4">
                    <i class="fas fa-lock fa-4x text-primary mb-4"></i>
                    <h4 class="font-weight-bold m-0">Ciberseguridad</h4>
                    <p class="m-0">Protección avanzada contra amenazas digitales.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include './Includes/Footer.php'; ?>

</body>
</html>