<?php
session_start();
if (!isset($_SESSION['user_id']) || !isset($_SESSION['role'])) {
    header("Location: login.html");
    exit();
}

$user_id = $_SESSION['user_id'];
$role = $_SESSION['role'];

include './config/conexion.php';

?>

<body>
<?php include './Includes/Header.php'; ?>

<link href="./Assets/css/style.css" rel="stylesheet">
<link href="./lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

<div class="container-fluid p-0">
    <div id="header-carousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="w-100" src="./Assets/images/carousel-1.png" alt="Imagen">
                <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                    <div class="p-3" style="max-width: 900px;">
                        <h4 class="text-white text-uppercase mb-md-3">Espacios de Trabajo Colaborativo</h4>
                        <h1 class="display-3 text-white mb-md-4">El Mejor Lugar para Trabajar y Crecer</h1>
                        <a href="" class="btn btn-primary py-md-3 px-md-5 mt-2">Más Información</a>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <img class="w-100" src="./Assets/images/carousel-2.png" alt="Imagen">
                <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                    <div class="p-3" style="max-width: 900px;">
                        <h4 class="text-white text-uppercase mb-md-3">Equipos y Tecnología</h4>
                        <h1 class="display-3 text-white mb-md-4">Personal Altamente Profesional</h1>
                        <a href="" class="btn btn-primary py-md-3 px-md-5 mt-2">Más Información</a>
                    </div>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#header-carousel" data-slide="prev">
            <div class="btn btn-secondary" style="width: 45px; height: 45px;">
                <span class="carousel-control-prev-icon mb-n2"></span>
            </div>
        </a>
        <a class="carousel-control-next" href="#header-carousel" data-slide="next">
            <div class="btn btn-secondary" style="width: 45px; height: 45px;">
                <span class="carousel-control-next-icon mb-n2"></span>
            </div>
        </a>
    </div>
</div>

    <div class="container-fluid contact-info mt-5 mb-4">
        <div class="container" style="padding: 0 30px;">
            <div class="row">
                <div class="col-md-4 d-flex align-items-center justify-content-center bg-secondary mb-4 mb-lg-0" style="height: 100px;">
                    <div class="d-inline-flex">
                        <i class="fa fa-2x fa-map-marker-alt text-white m-0 mr-3"></i>
                        <div class="d-flex flex-column">
                            <h5 class="text-white font-weight-medium">Ubicación</h5>
                            <p class="m-0 text-white">La Victoria, Estado Aragua. Venezuela</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 d-flex align-items-center justify-content-center bg-primary mb-4 mb-lg-0" style="height: 100px;">
                    <div class="d-inline-flex text-left">
                        <i class="fa fa-2x fa-envelope text-white m-0 mr-3"></i>
                        <div class="d-flex flex-column">
                            <h5 class="text-white font-weight-medium">Email</h5>
                            <p class="m-0 text-white">info@workwake.com</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 d-flex align-items-center justify-content-center bg-secondary mb-4 mb-lg-0" style="height: 100px;">
                    <div class="d-inline-flex text-left">
                        <i class="fa fa-2x fa-phone-alt text-white m-0 mr-3"></i>
                        <div class="d-flex flex-column">
                            <h5 class="text-white font-weight-medium">Teléfono</h5>
                            <p class="m-0 text-white">+58 412 8978 291</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<div class="container-fluid py-5">
    <div class="container pt-0 pt-lg-4">
        <div class="row align-items-center">
            <div class="col-lg-5">
                <img class="img-fluid" src="./Assets/images/about_us.jpg" alt="Sobre Nosotros">
            </div>
            <div class="col-lg-7 mt-5 mt-lg-0 pl-lg-5">
                <h6 class="text-secondary text-uppercase font-weight-medium mb-3">Conoce Sobre Nosotros</h6>
                <h1 class="mb-4">Somos tu Plataforma de Conexión Profesional</h1>
                <h5 class="font-weight-medium font-italic mb-4">Con WorkWake, puedes conectar con las mejores empresas y profesionales de la industria tecnológica.</h5>
                <p class="mb-2">Ofrecemos una plataforma segura y eficiente para que tanto profesionales como empresas puedan interactuar, negociar y concretar proyectos. En WorkWake, creemos en la creación de oportunidades y el crecimiento mutuo.</p>
                <div class="row">
                    <div class="col-sm-6 pt-3">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-users text-primary mr-2"></i>
                            <p class="text-secondary font-weight-medium m-0">Conecta con Profesionales</p>
                        </div>
                    </div>
                    <div class="col-sm-6 pt-3">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-briefcase text-primary mr-2"></i>
                            <p class="text-secondary font-weight-medium m-0">Oportunidades de Trabajo</p>
                        </div>
                    </div>
                    <div class="col-sm-6 pt-3">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-laptop-code text-primary mr-2"></i>
                            <p class="text-secondary font-weight-medium m-0">Fácil de Usar</p>
                        </div>
                    </div>
                    <div class="col-sm-6 pt-3">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-shield-alt text-primary mr-2"></i>
                            <p class="text-secondary font-weight-medium m-0">Seguridad y Privacidad</p>
                        </div>
                    </div>
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
                        <i class="fas fa-code text-secondary fa-3x"></i>
                    </div>
                    <h4 class="font-weight-bold m-0">Programadores</h4>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 pb-1">
                <div class="d-flex flex-column align-items-center justify-content-center text-center bg-light mb-4 px-4" style="height: 300px;">
                    <div class="d-inline-flex align-items-center justify-content-center bg-white shadow rounded-circle mb-4" style="width: 100px; height: 100px;">
                        <i class="fas fa-pencil-ruler text-secondary fa-3x"></i>
                    </div>
                    <h4 class="font-weight-bold m-0">Diseñadores Web</h4>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 pb-1">
                <div class="d-flex flex-column align-items-center justify-content-center text-center bg-light mb-4 px-4" style="height: 300px;">
                    <div class="d-inline-flex align-items-center justify-content-center bg-white shadow rounded-circle mb-4" style="width: 100px; height: 100px;">
                        <i class="fas fa-vial text-secondary fa-3x"></i>
                    </div>
                    <h4 class="font-weight-bold m-0">Testers</h4>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 pb-1">
                <div class="d-flex flex-column align-items-center justify-content-center text-center bg-light mb-4 px-4" style="height: 300px;">
                    <div class="d-inline-flex align-items-center justify-content-center bg-white shadow rounded-circle mb-4" style="width: 100px; height: 100px;">
                        <i class="fas fa-chart-line text-secondary fa-3x"></i>
                    </div>
                    <h4 class="font-weight-bold m-0">Analistas de Sistemas</h4>
                </div>
            </div>
        </div>
    </div>
</div>

    <div class="container-fluid py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 m-0 my-lg-5 pt-0 pt-lg-5 pr-lg-5">
                <h6 class="text-secondary text-uppercase font-weight-medium mb-3">Nuestras Características</h6>
                <h1 class="mb-4">¿Por qué Elegirnos?</h1>
                <p>En WorkWake, conectamos a profesionales talentosos con empresas que buscan sus habilidades. Nuestra plataforma es intuitiva y fácil de usar, brindando un proceso eficiente para encontrar el trabajo o el talento ideal.</p>
                <div class="row">
                    <div class="col-sm-6 mb-4">
                        <h1 class="text-secondary" data-toggle="counter-up">500+</h1>
                        <h5 class="font-weight-bold">Proyectos Completados</h5>
                    </div>
                    <div class="col-sm-6 mb-4">
                        <h1 class="text-secondary" data-toggle="counter-up">300+</h1>
                        <h5 class="font-weight-bold">Profesionales Registrados</h5>
                    </div>
                    <div class="col-sm-6 mb-4">
                        <h1 class="text-secondary" data-toggle="counter-up">1000+</h1>
                        <h5 class="font-weight-bold">Empresas Satisfechas</h5>
                    </div>
                    <div class="col-sm-6 mb-4">
                        <h1 class="text-secondary" data-toggle="counter-up">150+</h1>
                        <h5 class="font-weight-bold">Ofertas de Trabajo Activas</h5>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="d-flex flex-column align-items-center justify-content-center bg-secondary h-100 py-5 px-3">
                    <i class="fa fa-5x fa-briefcase text-white mb-5"></i>
                    <h1 class="display-1 text-white mb-3">500+</h1>
                    <h1 class="text-white m-0">Proyectos Completados</h1>
                </div>
            </div>
        </div>
    </div>
</div>

    <div class="container-fluid pt-5">
    <div class="container">
        <h6 class="text-secondary text-uppercase text-center font-weight-medium mb-3">Proceso de Trabajo</h6>
        <h1 class="display-4 text-center mb-5">Cómo Funcionamos</h1>
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="d-flex flex-column align-items-center justify-content-center text-center mb-5">
                    <div class="d-inline-flex align-items-center justify-content-center bg-white border border-light shadow rounded-circle mb-4" style="width: 150px; height: 150px; border-width: 15px !important;">
                        <h2 class="display-2 text-secondary m-0">1</h2>
                    </div>
                    <h3 class="font-weight-bold m-0 mt-2">Registrarse</h3>
                    <p>Crear un perfil y empezar a navegar por las oportunidades.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="d-flex flex-column align-items-center justify-content-center text-center mb-5">
                    <div class="d-inline-flex align-items-center justify-content-center bg-white border border-light shadow rounded-circle mb-4" style="width: 150px; height: 150px; border-width: 15px !important;">
                        <h2 class="display-2 text-secondary m-0">2</h2>
                    </div>
                    <h3 class="font-weight-bold m-0 mt-2">Buscar Trabajo o Talento</h3>
                    <p>Explora proyectos o candidatos que se ajusten a tus necesidades.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="d-flex flex-column align-items-center justify-content-center text-center mb-5">
                    <div class="d-inline-flex align-items-center justify-content-center bg-white border border-light shadow rounded-circle mb-4" style="width: 150px; height: 150px; border-width: 15px !important;">
                        <h2 class="display-2 text-secondary m-0">3</h2>
                    </div>
                    <h3 class="font-weight-bold m-0 mt-2">Conectar</h3>
                    <p>Contacta a profesionales o empresas para discutir detalles.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="d-flex flex-column align-items-center justify-content-center text-center mb-5">
                    <div class="d-inline-flex align-items-center justify-content-center bg-white border border-light shadow rounded-circle mb-4" style="width: 150px; height: 150px; border-width: 15px !important;">
                        <h2 class="display-2 text-secondary m-0">4</h2>
                    </div>
                    <h3 class="font-weight-bold m-0 mt-2">Concretar</h3>
                    <p>Finaliza acuerdos y comienza el proyecto.</p>
                </div>
            </div>
        </div>
    </div>
</div>

    <?php include './Includes/Footer.php'; ?>
    <a href="#" class="btn btn-lg btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>

</body>
</html>