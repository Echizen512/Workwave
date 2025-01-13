<!DOCTYPE html>
<html lang="en" class="no-js">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>WorkWave</title>
    <link href="https://fonts.googleapis.com/css?family=Heebo:400,700|IBM+Plex+Sans:600" rel="stylesheet">
    <link rel="stylesheet" href="dist/css/style.css">
    <script src="https://unpkg.com/scrollreveal@4.0.0/dist/scrollreveal.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>

<?php include './Config/conexion.php'; ?>

<style>
    .card {
        transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        border-radius: 30px;
        border: 1px solid rgba(0, 0, 0, 0.1);
        max-width: 400px;
        margin: 20px;
        display: inline-block;
        padding: 20px;
        height: 800px;
    }

    .card:hover {
        transform: translateY(-10px);
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.3);
    }

    .card-img-top {
        transition: transform 0.2s ease-in-out;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
        width: 100%;
        object-fit: cover;

    }

    .card-img-top:hover {
        transform: scale(1.15);
    }

    .card-body {
        transition: background-color 0.3s ease-in-out;
    }

    .btn-primary {
        transition: background-color 0.3s ease-in-out, transform 0.3s ease-in-out;
        border-radius: 20px;
        background-color: #007bff;
        text-decoration: none;
        color: white;
        padding: 5px;

    }

    .btn-primary:hover {
        background-color: #004085;
        transform: translateY(-3px);
    }

    .carousel-inner {
        display: flex;

    }

    .text-center {
        text-align: center;

    }

    .row {
        display: flex;
        justify-content: center;

    }

    .col-lg-3,
    .col-md-6 {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        margin: 25px;
    }
</style>

<body class="is-boxed has-animations">
    <div class="body-wrap boxed-container">
        <header class="site-header">
            <div class="container">
                <div class="site-header-inner">
                    <div class="brand header-brand">
                        <h1 class="m-0">
                            <a href="#">
                                <img class="header-logo-image asset-light" src="dist/images/logo-light.svg" alt="Logo">
                                <img class="header-logo-image asset-dark" src="dist/images/logo-dark.svg" alt="Logo">
                            </a>
                        </h1>
                    </div>
                </div>
            </div>
        </header>

        <main>
            <section class="hero">
                <div class="container">
                    <div class="hero-inner">
                        <div class="hero-copy">
                            <h1 class="hero-title mt-0">Impulsa la Eficiencia con WorkWave</h1>
                            <p class="hero-paragraph">Nuestro software de gestión de servicios está diseñado para
                                optimizar tus operaciones diarias, mejorar la productividad y aumentar la satisfacción
                                del cliente.</p>
                            <div class="hero-cta">
                                <a class="button button-primary" style="border-radius: 20px;" href="./login.html">Empieza Ahora</a>
                                <div class="lights-toggle">
                                    <input id="lights-toggle" type="checkbox" name="lights-toggle" class="switch"
                                        checked="checked">
                                    <label for="lights-toggle" class="text-xs"><span>Modo <span
                                                class="label-text">oscuro</span></span></label>
                                </div>
                            </div>
                        </div>
                        <div class="hero-media">
                            <div class="header-illustration">
                                <img class="header-illustration-image asset-light"
                                    src="dist/images/header-illustration-light.svg" alt="Ilustración de Cabecera">
                                <img class="header-illustration-image asset-dark"
                                    src="dist/images/header-illustration-dark.svg" alt="Ilustración de Cabecera">
                            </div>
                            <div class="hero-media-illustration">
                                <img class="hero-media-illustration-image asset-light"
                                    src="dist/images/hero-media-illustration-light.svg"
                                    alt="Ilustración de Medios de Hero">
                                <img class="hero-media-illustration-image asset-dark"
                                    src="dist/images/hero-media-illustration-dark.svg"
                                    alt="Ilustración de Medios de Hero">
                            </div>
                            <div class="hero-media-container">
                                <img class="hero-media-image asset-light" src="dist/images/hero-media-light.svg"
                                    alt="Medios de Hero">
                                <img class="hero-media-image asset-dark" src="dist/images/hero-media-dark.svg"
                                    alt="Medios de Hero">
                            </div>
                        </div>
                    </div>
                </div>
            </section>


            <?php
            $sql_categorias = "SELECT id, nombre FROM categorias";
            $result_categorias = $conn->query($sql_categorias);

            $search = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';
            $categoria_id = isset($_GET['categoria_id']) ? intval($_GET['categoria_id']) : 0;

            $sql_proyectos = "SELECT p.*, c.nombre AS nombre_categoria, 
            CASE 
                WHEN p.tipo_usuario = 'contratistas' THEN co.nombre
                WHEN p.tipo_usuario = 'freelancers' THEN f.nombre
                WHEN p.tipo_usuario = 'empresas' THEN e.nombre_empresa
            END AS nombre_usuario
            FROM proyectos p
            LEFT JOIN categorias c ON p.categoria_id = c.id
            LEFT JOIN contratistas co ON p.tipo_usuario = 'contratistas' AND p.contratista_id = co.id
            LEFT JOIN freelancers f ON p.tipo_usuario = 'freelancers' AND p.freelancer_id = f.id
            LEFT JOIN empresas e ON p.tipo_usuario = 'empresas' AND p.empresa_id = e.id
            WHERE p.estado = 1" . ($categoria_id > 0 ? " AND p.categoria_id = $categoria_id" : "");

            if ($search) {
                $sql_proyectos .= " AND (p.titulo LIKE '%$search%' OR p.descripcion LIKE '%$search%')";
            }

            $total_result = $conn->query($sql_proyectos);
            $total_proyectos = $total_result->num_rows;
            $proyectos_por_pagina = 8;
            $total_paginas = ceil($total_proyectos / $proyectos_por_pagina);

            $pagina = isset($_GET['pagina']) ? intval($_GET['pagina']) : 1;
            $offset = ($pagina - 1) * $proyectos_por_pagina;
            $sql_proyectos .= " LIMIT $offset, $proyectos_por_pagina";
            $result_proyectos = $conn->query($sql_proyectos);
            ?>
            
        <section>
            <h2 class="section-title text-center">¡Últimos Proyectos Publicados!</h2>
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">

                </ol>
                <div class="carousel-inner">
                    <?php if ($result_proyectos->num_rows > 0): ?>
                        <?php $active = true; ?>
                        <?php while ($row = $result_proyectos->fetch_assoc()): ?>
                            <?php if ($active): ?>
                                <div class="carousel-item active">
                                <?php else: ?>
                                    <div class="carousel-item">
                                    <?php endif; ?>
                                    <div class="d-inline-flex">
                                        <div class="card">
                                            <img class="card-img-top" src="<?php echo $row['image_url']; ?>"
                                                alt="<?php echo $row['titulo']; ?>">
                                            <div class="card-body">
                                                <h5 class="card-title"><?php echo $row['titulo']; ?></h5>
                                                <p class="card-text">
                                                    <?php echo strlen($row['descripcion']) > 100 ? substr($row['descripcion'], 0, strrpos(substr($row['descripcion'], 0, 100), ' ')) . '...' : $row['descripcion']; ?>
                                                </p>
                                                <p class="card-text"><strong>Intereses:</strong>
                                                    <?php echo $row['intereses']; ?></p>
                                                <p class="card-text"><strong>Precio:</strong> <?php echo $row['precio']; ?></p>
                                                <div class="text-center">
                                                    <a href="Articulos.php?id=<?php echo $row['id']; ?>"
                                                        class="btn btn-primary" style="padding: 10px; text-decoration: none;">Visualizar</a>
                                                </div>
                                                <br>
                                            </div>
                                            <div class="card-footer">
                                                <small class="text-muted"><i class="fa fa-user"></i>
                                                    <?php echo $row['nombre_usuario']; ?></small>
                                                <small class="text-muted"><i class="fa fa-folder"></i>
                                                    <?php echo $row['nombre_categoria']; ?></small>
                                                <small class="text-muted"><i class="fa fa-file"></i>
                                                    <?php echo isset($row['Etiqueta']) ? $row['Etiqueta'] : ''; ?></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php $active = false; ?>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </section>

                <div class="container-fluid pt-5">
                    <div class="container">
                        <h2 class="section-title text-center mb-5">¿Cómo Funcionamos?</h2>
                        <div class="row">
                            <!-- Paso 1: Registrarse -->
                            <div class="col-lg-3 col-md-6">
                                <div
                                    class="d-flex flex-column align-items-center justify-content-center text-center mb-5">
                                    <div class="bg-light text-center border rounded-circle d-flex align-items-center justify-content-center mb-4"
                                        style="width: 270px; height: 120px;">
                                        <i class="fas fa-user-plus text-secondary" style="font-size: 4rem;"></i>
                                    </div>
                                    <h3 class="font-weight-bold m-0 mt-2">Registrarse</h3>
                                    <p class="text-sm text-muted">Crear un perfil y empezar a navegar por las
                                        oportunidades.</p>
                                </div>
                            </div>

                            <!-- Paso 2: Buscar Trabajo o Talento -->
                            <div class="col-lg-3 col-md-6">
                                <div
                                    class="d-flex flex-column align-items-center justify-content-center text-center mb-5">
                                    <div class="bg-light border rounded-circle d-flex align-items-center justify-content-center mb-4"
                                        style="width: 270px; height: 120px;">
                                        <i class="fas fa-search text-secondary" style="font-size: 4rem;"></i>
                                    </div>
                                    <h3 class="font-weight-bold m-0 mt-2">Buscar Trabajo o Talento</h3>
                                    <p class="text-sm text-muted">Explora proyectos o candidatos que se ajusten a tus
                                        necesidades.</p>
                                </div>
                            </div>

                            <!-- Paso 3: Conectar -->
                            <div class="col-lg-3 col-md-6">
                                <div
                                    class="d-flex flex-column align-items-center justify-content-center text-center mb-5">
                                    <div class="bg-light border rounded-circle d-flex align-items-center justify-content-center mb-4"
                                        style="width: 260px; height: 120px;">
                                        <i class="fas fa-comments text-secondary" style="font-size: 4rem;"></i>
                                    </div>
                                    <h3 class="font-weight-bold m-0 mt-2">Conectar</h3>
                                    <p class="text-sm text-muted">Contacta a profesionales o empresas para discutir
                                        detalles.</p>
                                </div>
                            </div>

                            <!-- Paso 4: Concretar -->
                            <div class="col-lg-3 col-md-6">
                                <div
                                    class="d-flex flex-column align-items-center justify-content-center text-center mb-5">
                                    <div class="bg-light border rounded-circle d-flex align-items-center justify-content-center mb-4"
                                        style="width: 150px; height: 120px;">
                                        <i class="fas fa-handshake text-secondary" style="font-size: 4rem;"></i>
                                    </div>
                                    <h3 class="font-weight-bold m-0 mt-2">Concretar</h3>
                                    <p class="text-sm text-muted">Finaliza acuerdos y comienza el proyecto.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <section>
                    <div class="container-fluid pt-5 pb-3">
                        <div class="container">
                            <h2 class="display-4 text-center mb-5">Ofrecemos</h2>
                            <div class="row">
                                <div class="col-lg-3 col-md-6 pb-1">
                                    <div class="d-flex flex-column align-items-center justify-content-center text-center bg-light mb-4 px-4"
                                        style="height: 200px;">
                                        <div class="d-inline-flex align-items-center justify-content-center bg-white shadow rounded-circle mb-4"
                                            style="width: 150px; height: 100px;">
                                            <i class="fas fa-code text-secondary fa-3x"></i>
                                        </div>
                                        <h4 class="font-weight-bold m-0">Desarrolladores</h4>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 pb-1">
                                    <div class="d-flex flex-column align-items-center justify-content-center text-center bg-light mb-4 px-4"
                                        style="height: 200px;">
                                        <div class="d-inline-flex align-items-center justify-content-center bg-white shadow rounded-circle mb-4"
                                            style="width: 200px; height: 100px;">
                                            <i class="fas fa-pencil-alt text-secondary fa-3x"></i>
                                        </div>
                                        <h4 class="font-weight-bold m-0">Diseñadores Gráficos</h4>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 pb-1">
                                    <div class="d-flex flex-column align-items-center justify-content-center text-center bg-light mb-4 px-4"
                                        style="height: 200px;">
                                        <div class="d-inline-flex align-items-center justify-content-center bg-white shadow rounded-circle mb-4"
                                            style="width: 150px; height: 100px;">
                                            <i class="fas fa-clipboard-check text-secondary fa-3x"></i>
                                        </div>
                                        <h4 class="font-weight-bold m-0">Control de Calidad</h4>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 pb-1">
                                    <div class="d-flex flex-column align-items-center justify-content-center text-center bg-light mb-4 px-4"
                                        style="height: 200px;">
                                        <div class="d-inline-flex align-items-center justify-content-center bg-white shadow rounded-circle mb-4"
                                            style="width: 240px; height: 100px;">
                                            <i class="fas fa-chart-bar text-secondary fa-3x"></i>
                                        </div>
                                        <h4 class="font-weight-bold m-0">Consultores de Negocios</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="features section">
                    <div class="container">
                        <div class="features-inner section-inner has-bottom-divider">
                            <div class="features-header text-center">
                                <div class="container-sm">
                                    <h2 class="section-title mt-0">Características de WorkWave</h2>
                                    <p class="section-paragraph">WorkWave ofrece un conjunto de herramientas diseñadas
                                        para mejorar la eficiencia operativa, desde la programación hasta la
                                        facturación, todo en un solo lugar.</p>
                                    <div class="features-image">
                                        <img class="features-illustration asset-dark"
                                            src="dist/images/features-illustration-dark.svg"
                                            alt="Ilustración de Características">
                                        <img class="features-box asset-dark" src="dist/images/features-box-dark.svg"
                                            alt="Caja de Características">
                                        <img class="features-illustration asset-dark"
                                            src="dist/images/features-illustration-top-dark.svg"
                                            alt="Ilustración Superior de Características">
                                        <img class="features-illustration asset-light"
                                            src="dist/images/features-illustration-light.svg"
                                            alt="Ilustración de Características">
                                        <img class="features-box asset-light" src="dist/images/features-box-light.svg"
                                            alt="Caja de Características">
                                        <img class="features-illustration asset-light"
                                            src="dist/images/features-illustration-top-light.svg"
                                            alt="Ilustración Superior de Características">
                                    </div>
                                </div>
                            </div>
                            <div class="features-wrap">
                                <div class="feature is-revealing">
                                    <div class="feature-inner">
                                        <div class="feature-icon">
                                            <img class="asset-light" src="dist/images/feature-01-light.svg"
                                                alt="Optimización de Rutas">
                                            <img class="asset-dark" src="dist/images/feature-01-dark.svg"
                                                alt="Optimización de Rutas">
                                        </div>
                                        <div class="feature-content">
                                            <h3 class="feature-title mt-0">Optimización de Rutas</h3>
                                            <p class="text-sm mb-0">Maximiza la eficiencia y reduce los costos
                                                operativos con nuestras soluciones avanzadas de planificación de rutas.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="feature is-revealing">
                                    <div class="feature-inner">
                                        <div class="feature-icon">
                                            <img class="asset-light" src="dist/images/feature-02-light.svg"
                                                alt="Gestión de Servicios">
                                            <img class="asset-dark" src="dist/images/feature-02-dark.svg"
                                                alt="Gestión de Servicios">
                                        </div>
                                        <div class="feature-content">
                                            <h3 class="feature-title mt-0">Gestión de Servicios</h3>
                                            <p class="text-sm mb-0">Administra todas tus operaciones desde una única
                                                plataforma para mejorar la productividad y el servicio al cliente.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="feature is-revealing">
                                    <div class="feature-inner">
                                        <div class="feature-icon">
                                            <img class="asset-light" src="dist/images/feature-03-light.svg"
                                                alt="Facturación y Pagos">
                                            <img class="asset-dark" src="dist/images/feature-03-dark.svg"
                                                alt="Facturación y Pagos">
                                        </div>
                                        <div class="feature-content">
                                            <h3 class="feature-title mt-0">Facturación y Pagos</h3>
                                            <p class="text-sm mb-0">Simplifica el proceso de facturación y pagos para
                                                asegurar una administración financiera sin problemas.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="cta section">
                    <div class="container-sm">
                        <div class="cta-inner section-inner">
                            <div class="cta-header text-center">
                                <h2 class="section-title mt-0">Transforma tu negocio con WorkWave</h2>
                                <p class="section-paragraph">
                                    WorkWave te ofrece herramientas innovadoras que te permiten optimizar operaciones,
                                    mejorar la eficiencia y maximizar la rentabilidad de tu negocio. Descubre cómo
                                    nuestras soluciones pueden ayudarte a alcanzar nuevos niveles de éxito.
                                </p>
                            </div>
                        </div>
                    </div>
                </section>
        </main>



        <footer class="site-footer has-top-divider">
            <div class="container">
                <div class="site-footer-inner">
                    <div class="footer-copyright">
                        &copy; 2024 WorkWave
                    </div>
                </div>
            </div>
        </footer>


    </div>

    <script src="dist/js/main.min.js"></script>
</body>

</html>