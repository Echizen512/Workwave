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

<body>
    <div class="page-header container-fluid bg-secondary pt-2 pt-lg-5 pb-2 mb-5">
        <div class="container py-5">
            <div class="row align-items-center py-4">
                <div class="col-md-6 text-center text-md-left">
                    <h1 class="mb-4 mb-md-0 text-white">Listado de Proyectos</h1>
                </div>
                <div class="col-md-6 text-center text-md-right">
                    <div class="d-inline-flex align-items-center">
                        <a class="btn text-white" href="">Inicio</a>
                        <i class="fas fa-angle-right text-white"></i>
                        <a class="btn text-white disabled" href="">Proyectos</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
    <div class="row">
        <div class="col-lg-8">
            <div class="mb-5">
                <form action="" method="GET">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control form-control-lg" placeholder="Buscar" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                        <div class="input-group-append">
                            <span class="input-group-text bg-transparent text-primary"><i class="fa fa-search"></i></span>
                        </div>
                    </div>
                </form>
            </div>

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

                <div class="row">
                <?php
if ($result_proyectos->num_rows > 0) {
    while ($row = $result_proyectos->fetch_assoc()) {
        $id = $row['id'];
        $imagen = $row['image_url'];
        $nombre_usuario = $row['nombre_usuario'];
        $titulo = $row['titulo'];
        $descripcion = strlen($row['descripcion']) > 100 ? substr($row['descripcion'], 0, strrpos(substr($row['descripcion'], 0, 100), ' ')) . '...' : $row['descripcion'];
        $categoria = $row['nombre_categoria'];
        $precio = $row['precio'];
        $intereses = $row['intereses'];
        $etiqueta = isset($row['Etiqueta']) ? $row['Etiqueta'] : '';

        echo "
        <div class='col-md-6 mb-4'>
            <div class='card' style='height: 650px;'>
                <img class='card-img-top' src='$imagen' alt='$titulo'>
                <div class='card-body'>
                    <h5 class='card-title'>$titulo</h5>
                    <p class='card-text'>$descripcion</p>
                    <p class='card-text'><strong>Intereses:</strong> $intereses</p>
                    <p class='card-text'><strong>Precio:</strong> $precio</p>
                    <div class='text-center'>
                    <a href='Articulos.php?id=$id' class='btn btn-primary'>Visualizar</a>
                    </div>
                </div>
                <div class='card-footer'>
                    <small class='text-muted'><i class='fa fa-user'></i> $nombre_usuario</small>
                    <small class='text-muted'><i class='fa fa-folder'></i> $categoria</small>
                    <small class='text-muted'><i class='fa fa-file'></i> $etiqueta</small>

                </div>
            </div>
        </div>";
    }
}

                    ?>
                </div>

                <div class="row">
                    <div class="col-12">
                        <nav aria-label="Navegación de páginas">
                            <ul class="pagination justify-content-center mb-0">
                                <li class="page-item <?php if ($pagina <= 1) echo 'disabled'; ?>">
                                    <a class="page-link" href="?pagina=<?php echo ($pagina - 1 < 1) ? 1 : $pagina - 1; ?>" aria-label="Anterior">
                                        <span aria-hidden="true">&laquo;</span>
                                        <span class="sr-only">Anterior</span>
                                    </a>
                                </li>
                                <?php for ($i = 1; $i <= $total_paginas; $i++): ?>
                                    <li class="page-item <?php if ($pagina == $i) echo 'active'; ?>">
                                        <a class="page-link" href="?pagina=<?php echo $i; ?>"><?php echo $i; ?></a>
                                    </li>
                                <?php endfor; ?>
                                <li class="page-item <?php if ($pagina >= $total_paginas) echo 'disabled'; ?>">
                                    <a class="page-link" href="?pagina=<?php echo ($pagina + 1 > $total_paginas) ? $total_paginas : $pagina + 1; ?>" aria-label="Siguiente">
                                        <span aria-hidden="true">&raquo;</span>
                                        <span class="sr-only">Siguiente</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>


            <div class="col-lg-4 mt-5 mt-lg-0">
                <div class="mb-5">
                <h3 class="font-weight-bold mb-4 icon-header"><i class="fas fa-th"></i> Categorías</h3>
                    <ul class="list-group">
                        <?php
                        if ($result_categorias->num_rows > 0) {
                            while ($row = $result_categorias->fetch_assoc()) {
                                $cat_id = $row['id'];
                                $cat_nombre = $row['nombre'];
                                $sql_count = "SELECT COUNT(*) AS count FROM proyectos WHERE categoria_id = $cat_id AND estado = 1";
                                $result_count = $conn->query($sql_count);
                                $count = $result_count->fetch_assoc()['count'];
                                echo "
                                <li class='list-group-item d-flex justify-content-between align-items-center'>
                                    <a href='?categoria_id=$cat_id'>$cat_nombre</a>
                                    <span class='badge badge-primary badge-pill'>$count</span>
                                </li>";
                            }
                        } else {
                            echo "<li class='list-group-item'>No hay categorías</li>";
                        }
                        ?>
                    </ul>
                </div>

                    <?php
                    include './Config/conexion.php'; 
                            $sql_recent_posts = "SELECT p.*, c.nombre AS nombre_categoria, 
                                                        CASE 
                                                            WHEN p.tipo_usuario = '	contratistas' THEN co.nombre
                                                            WHEN p.tipo_usuario = 'freelancers' THEN f.nombre
                                                            WHEN p.tipo_usuario = 'empresas' THEN e.nombre_empresa
                                                        END AS nombre_usuario
                                                FROM proyectos p
                                                LEFT JOIN categorias c ON p.categoria_id = c.id
                                                LEFT JOIN contratistas co ON p.tipo_usuario = 'contratistas' AND p.contratista_id = co.id
                                                LEFT JOIN freelancers f ON p.tipo_usuario = 'freelancers' AND p.freelancer_id = f.id
                                                LEFT JOIN empresas e ON p.tipo_usuario = 'empresas' AND p.empresa_id = e.id
                                                WHERE p.estado = 1
                                                ORDER BY p.fecha_registro DESC
                                                LIMIT 4";

                            $result_recent_posts = $conn->query($sql_recent_posts);

                            if ($result_recent_posts === false) {
                                die('Error en la consulta SQL: ' . $conn->error);
                            }
                        ?>


                    <div class="mb-5">
                    <h3 class="font-weight-bold mb-4 icon-header"><i class="fas fa-project-diagram"></i> Proyectos Recientes</h3>
                        <?php
                        if ($result_recent_posts->num_rows > 0) {
                            while ($row = $result_recent_posts->fetch_assoc()) {
                                $imagen = $row['image_url'];
                                $nombre_usuario = $row['nombre_usuario'];
                                $titulo = $row['titulo'];
                                $categoria = $row['nombre_categoria'];
                                $comentarios = 0; 

                                echo "
                                <div class='d-flex align-items-center border-bottom mb-3 pb-3'>
                                    <img class='img-fluid' src='$imagen' alt='' style='width: 80px; height: 80px;' alt=''>
                                    <div class='d-flex flex-column pl-3'>
                                        <a class='text-dark mb-2' href=''>".htmlspecialchars($titulo)."</a>
                                        <div class='d-flex'>
                                            <small class='mr-3'><i class='fa fa-user text-primary'></i> $nombre_usuario</small>
                                            <small class='mr-3'><i class='fa fa-folder text-primary'></i> $categoria</small>
                                            <small class='mr-3'><i class='fa fa-comments text-primary'></i> $comentarios</small>
                                        </div>
                                    </div>
                                </div>";
                            }
                        } else {
                            echo "<p>No recent posts found</p>";
                        }
                        ?>
                    </div>

            <div class="mb-5">
                <img src="./Assets/images/about.png" alt="WorkWave Offerings" class="img-fluid">
            </div>
                <div>
                    <h3 class="font-weight-bold mb-4 text-justify">Publica o Encuentra Ofertas de Trabajo</h3>
                    <p class="text-justify">
                        En WorkWave, conectamos clientes y profesionales. Publica tus proyectos o busca oportunidades para colaborar con expertos. Con nuestras herramientas, gestionar ofertas y proyectos es más fácil y eficiente.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <?php include './Includes/Footer.php'; ?>

</body>
</html>
