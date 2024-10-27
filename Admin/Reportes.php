<?php include './Dashboard.php'; ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generar Reportes</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('../Assets/images/2312616.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .content-wrapper {
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
            width: 400px;
        }

        h1 {
            color: #007bff; /* Cambia el color según lo necesites */
            text-align: center;
            margin-bottom: 20px;
        }

        .btn-custom {
            background-color: #007bff;
            color: white;
        }

        .btn-custom:hover {
            background-color: #0056b3;
            color: white;
        }
    </style>
</head>
<body>

<div class="content-wrapper">
    <h1>Generar Reportes</h1>
    <form action="generar_reporte.php" method="post">
        <div class="mb-3">
            <label for="tipo_reporte" class="form-label">Seleccione el tipo de reporte:</label>
            <select name="tipo_reporte" id="tipo_reporte" class="form-select" required>
                <option value="contratistas">Contratistas</option>
                <option value="empresas">Empresas</option>
                <option value="freelancers">Freelancers</option>
                <option value="proyectos">Proyectos</option>
            </select>
        </div>
        <button type="submit" class="btn btn-custom w-100">Generar PDF</button>
    </form>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
