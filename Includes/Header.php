

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>WorkWave</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;800&display=swap" rel="stylesheet"> 
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="./Assets/css/style.css" rel="stylesheet">
</head>
<body>
    <div class="container-fluid bg-primary py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center text-lg-left mb-2 mb-lg-0">
                    <div class="d-inline-flex align-items-center">
                    </div>
                </div>
                <div class="col-md-6 text-center text-lg-right">
                    <div class="d-inline-flex align-items-center">
                        <a class="text-white px-3" href="">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a class="text-white px-3" href="">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a class="text-white px-3" href="">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a class="text-white px-3" href="">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a class="text-white pl-3" href="">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid position-relative nav-bar p-0">
        <div class="container-lg position-relative p-0 px-lg-3" style="z-index: 9;">
            <nav class="navbar navbar-expand-lg bg-white navbar-light py-3 py-lg-0 pl-3 pl-lg-5">
                <a href="" class="navbar-brand">
                    <h1 class="m-0 text-secondary"><span class="text-primary">Work</span>Wave</h1>
                </a>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between px-3" id="navbarCollapse">
                    <div class="navbar-nav ml-auto py-0">
                        <a href="Inicio.php" class="nav-item nav-link active"><i class="fas fa-home mr-2"></i>Inicio</a>
                        <a href="Informacion.php" class="nav-item nav-link"><i class="fas fa-info-circle mr-2"></i>Información</a>
                        <a href="Servicios.php" class="nav-item nav-link"><i class="fas fa-concierge-bell mr-2"></i>Servicios</a>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown"><i class="fas fa-project-diagram mr-2"></i>Proyectos</a>
                            <div class="dropdown-menu border-0 rounded-0 m-0">
                                <a href="Proyectos.php" class="dropdown-item"><i class="fas fa-list-ul mr-2"></i>Listado de Proyectos</a>
                                <a href="Inscribir_Proyecto.php" class="dropdown-item"><i class="fas fa-pen-square mr-2"></i>Inscripción</a>
                            </div>
                            </div>
                        <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                            <i class="fas fa-user-circle mr-2"></i>Usuario
                        </a>
                            <div class="dropdown-menu border-0 rounded-0 m-0">
                            <a href="./Perfil.php" class="dropdown-item">
                            <i class="fas fa-user"></i> Perfil
                        </a>
                        <a href="./Solicitudes.php" class="dropdown-item">
                            <i class="fas fa-file-alt"></i> Solicitudes
                        </a>
                        <a href="./Gestion.php" class="dropdown-item">
                        <i class="fas fa-list-ul mr-2"></i>Proyectos</a>
                        <a href="logout.php" class="dropdown-item"><i class="fas fa-sign-out-alt mr-2"></i>Salir</a>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</body>
</html>

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>