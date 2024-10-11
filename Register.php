<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Selección de Roles</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@100;200;300;400;500;600;700;800;900&amp;display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            background-image: url('./Assets/images/2312616.jpg'); 
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh;
            font-family: 'Plus Jakarta Sans', sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
        }

        .card {
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            max-width: 900px;
            width: 100%;
            text-align: center;
        }

        .role-container {
            display: flex;
            justify-content: space-around;
            margin-top: 20px;
        }

        .role {
            cursor: pointer;
            transition: transform 0.3s ease;
            text-align: center;
        }

        .role:hover {
            transform: scale(1.1);
        }

        .role i {
            font-size: 2rem;
            color: #007bff;
        }

        .role span {
            display: block;
            margin-top: 10px;
            font-weight: 600;
        }

        .login-container {
            margin-top: 30px;
        }

        .btn-primary {
            width: 100%;
            padding: 10px 0;
        }
    </style>
</head>

<body>
    <div class="container d-flex justify-content-center align-items-center">
        <div class="card">
            <h1>Selecciona tu rol</h1>
            <div class="role-container">
                <div class="role" onclick="navigateTo('./Includes/register_empresa.php')">
                    <i class="fas fa-building"></i>
                    <span>Empresa</span>
                </div>
                <div class="role" onclick="navigateTo('./Includes/register_freelancer.php')">
                    <i class="fas fa-laptop-code"></i>
                    <span>Freelancer/Trabajador</span>
                </div>
                <div class="role" onclick="navigateTo('./Includes/register_contratista.php')">
                    <i class="fas fa-hard-hat"></i>
                    <span>Contratista</span>
                </div>
            </div>
            <div class="login-container text-center">
                <a class="btn btn-primary btn-lg px-2 py-3 fs-6 fw-bolder" style="width: 150px;" href="login.html">Iniciar Sesion</a>
            </div>
        </div>
    </div>

    <script>
        function navigateTo(page) {
            window.location.href = page;
        }
    </script>
</body>

</html>
