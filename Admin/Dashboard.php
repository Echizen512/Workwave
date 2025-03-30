<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    
    <style>
        body {
            background-color: #f8f9fa;
            margin-top: 60px; 
        }
        .sidebar {
            position: fixed;
            top: 50px; 
            left: 0;
            height: calc(100% - 60px); 
            width: 14%; 
            transition: width 0.3s;
            overflow-x: hidden;
            padding-top: 20px;
        }
        .sidebar a {
            padding: 10px 10px 10px 20px;
            text-decoration: none;
            font-size: 18px;
            color: white;
            display: flex;
            align-items: center; /* Alinear contenido verticalmente */
            transition: 0.3s;
        }
        .sidebar a:hover {
            color: #ffffff;
            background-color: rgba(255, 255, 255, 0.2);
        }
        .main-content {
            margin-left: 14%; 
            padding: 20px;
        }
        .icon {
            padding-right: 10px;
        }
        .header {
            color: white;
            padding: 17px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
        }
        .logout-btn {
            background-color: transparent;
            border: none;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }
        .logout-btn:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>


<div class="header bg-primary">
        <div>
            <h2 style="font-size: 30px; margin-left: 15px;">WorkWave</h2>
        </div>
        <a href="./logout.php">
            <button class="logout-btn">
                <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
            </button>
        </a>
    </div>

    <div class="sidebar bg-primary">
        <a href="./Empresas.php" style="color: white;">
            <i class="fas fa-building icon" style="color: white;"></i> Empresas
        </a>
        <a href="./Contratistas.php" style="color: white;">
            <i class="fas fa-user-tie icon" style="color: white;"></i> Contratistas
        </a>
        <a href="./Freelancers.php" style="color: white;">
            <i class="fas fa-laptop-code icon" style="color: white;"></i> Freelancers
        </a>
        <a href="./Categorias.php" style="color: white;">
            <i class="fas fa-tags icon" style="color: white;"></i> Categorias
        </a>
        <a href="./Proyectos.php" style="color: white;">
            <i class="fas fa-project-diagram icon" style="color: white;"></i> Proyectos
        </a>
        <a href="./Reportes.php" style="color: white;">
            <i class="fas fa-file-alt icon" style="color: white;"></i> Reportes
        </a>
        <a href="./Graficas.php" style="color: white;">
            <i class="fas fa-chart-pie icon" style="color: white;"></i> Gráficas
        </a>
        <a href="./Auditoria.php" style="color: white;">
            <i class="fas fa-search icon" style="color: white;"></i> Auditoría
        </a>
        <a href="./admin-backup.php" style="color: white;"><i class="fas fa-database icon" style="color: white;"></i> Respaldo</a>
    </div>

    <script src="../Assets/js/jquery-3.6.0.min.js"></script>
    <script src="../Assets/js/bootstrap.bundle.min.js"></script>
    <script src="../Assets/js/jquery.dataTables.min.js"></script>
    <script src="../Assets/js/dataTables.bootstrap5.min.js"></script>

</body>
</html>
