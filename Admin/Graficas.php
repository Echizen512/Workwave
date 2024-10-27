<?php include './Dashboard.php'; ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gráficas de Reportes</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            background-image: url('../Assets/images/2312616.jpg');
        }
        .container {
            margin-top: 20px;
            margin-left: 100px; /* Margen más pequeño a la izquierda */
        }
        .chart-container {
            position: relative;
            width: 40%; /* Ancho reducido para las gráficas */
            margin: 15px auto; /* Margen entre las gráficas y centrado en la columna */
        }
    </style>
</head>
<body>

<div class="container">
    <h1 class="text-center">Gráficas de Reportes</h1>

    <div class="row">
        <div class="col-md-6"> <!-- Columna para la primera gráfica -->
            <div class="chart-container">
                <canvas id="contratistasChart"></canvas>
            </div>
        </div>
        <div class="col-md-6"> <!-- Columna para la segunda gráfica -->
            <div class="chart-container">
                <canvas id="empresasChart"></canvas>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-6"> <!-- Columna para la tercera gráfica -->
            <div class="chart-container">
                <canvas id="freelancersChart"></canvas>
            </div>
        </div>
        <div class="col-md-6"> <!-- Columna para la cuarta gráfica -->
            <div class="chart-container">
                <canvas id="proyectosChart"></canvas>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-6"> <!-- Columna para la quinta gráfica -->
            <div class="chart-container">
                <canvas id="usuariosAceptadosChart"></canvas>
            </div>
        </div>
    </div>
</div>

<script>
    // Gráfica de Contratistas
    const ctxContratistas = document.getElementById('contratistasChart').getContext('2d');
    const contratistasChart = new Chart(ctxContratistas, {
        type: 'pie',
        data: {
            labels: ['Activos', 'Inactivos'],
            datasets: [{
                label: 'Estado de Contratistas',
                data: [12, 5], // Reemplaza con datos de la base de datos
                backgroundColor: ['#28a745', '#dc3545'],
                borderColor: ['#fff', '#fff'],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Estado de Contratistas'
                }
            }
        }
    });

    // Gráfica de Empresas
    const ctxEmpresas = document.getElementById('empresasChart').getContext('2d');
    const empresasChart = new Chart(ctxEmpresas, {
        type: 'pie',
        data: {
            labels: ['Activas', 'Inactivas'],
            datasets: [{
                label: 'Estado de Empresas',
                data: [15, 3], // Reemplaza con datos de la base de datos
                backgroundColor: ['#17a2b8', '#ffc107'],
                borderColor: ['#fff', '#fff'],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Estado de Empresas'
                }
            }
        }
    });

    // Gráfica de Freelancers
    const ctxFreelancers = document.getElementById('freelancersChart').getContext('2d');
    const freelancersChart = new Chart(ctxFreelancers, {
        type: 'pie',
        data: {
            labels: ['Activos', 'Inactivos'],
            datasets: [{
                label: 'Estado de Freelancers',
                data: [10, 8], // Reemplaza con datos de la base de datos
                backgroundColor: ['#007bff', '#6c757d'],
                borderColor: ['#fff', '#fff'],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Estado de Freelancers'
                }
            }
        }
    });

    // Gráfica de Proyectos
    const ctxProyectos = document.getElementById('proyectosChart').getContext('2d');
    const proyectosChart = new Chart(ctxProyectos, {
        type: 'pie',
        data: {
            labels: ['Activos', 'Inactivos', 'Finalizados'],
            datasets: [{
                label: 'Estado de Proyectos',
                data: [8, 5, 4], // Reemplaza con datos de la base de datos
                backgroundColor: ['#007bff', '#28a745', '#dc3545'],
                borderColor: ['#fff', '#fff'],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Estado de Proyectos'
                }
            }
        }
    });

    // Gráfica de Usuarios Aceptados
    const ctxUsuariosAceptados = document.getElementById('usuariosAceptadosChart').getContext('2d');
    const usuariosAceptadosChart = new Chart(ctxUsuariosAceptados, {
        type: 'pie',
        data: {
            labels: ['Solicitante', 'Aceptado'],
            datasets: [{
                label: 'Distribución de Usuarios Aceptados por Rol',
                data: [20, 5], // Reemplaza con datos de la base de datos
                backgroundColor: ['#ffc107', '#17a2b8'],
                borderColor: ['#fff', '#fff'],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Distribución de Usuarios Aceptados por Rol'
                }
            }
        }
    });
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
