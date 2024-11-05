<?php
session_start();
include "./Config/conexion.php";

// Verifica si las variables de sesión están definidas
if (!isset($_SESSION['user_id']) || !isset($_SESSION['role'])) {
    header("location: ./login.html");
    exit();
}

// Obtiene el user_id y role de la sesión
$user_id = $_SESSION['user_id'];
$role = $_SESSION['role'];

// Obtiene los parámetros de la URL
$incoming_id = isset($_GET['user_id']) ? mysqli_real_escape_string($conn, $_GET['user_id']) : null;
$incoming_role = isset($_GET['role']) ? mysqli_real_escape_string($conn, $_GET['role']) : null;

// Validar que los IDs no estén vacíos
if (empty($incoming_id) || empty($incoming_role)) {
    die("ID o rol entrante está vacío.");
}

// Consultar el perfil del usuario con el que se está chateando
if ($incoming_role === 'contratista') {
    $query = "SELECT * FROM contratistas WHERE id = {$incoming_id}";
} elseif ($incoming_role === 'empresas') {
    $query = "SELECT * FROM empresas WHERE id = {$incoming_id}";
} else {
    $query = "SELECT * FROM freelancers WHERE id = {$incoming_id}";
}

$sql = mysqli_query($conn, $query);
if (!$sql) {
    die("Error en la consulta: " . mysqli_error($conn));
}

$row = mysqli_fetch_assoc($sql);


?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./Assets/css/responsive.css" rel="stylesheet">
    <link rel="stylesheet" href="./Chat.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    
    <div class="wrapper">
        <section class="chat-area">
            <header>
                <a href="notificaciones.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
                <img src="<?php echo htmlspecialchars($row['image_url']); ?>" alt="Profile Image">
                <div class="details">
                    <span><?php echo htmlspecialchars($row['nombre'] ?? $row['nombre_empresa']); ?></span>
                    <p><?php echo ucfirst($incoming_role); ?></p>
                </div>
            </header>
            <div class="chat-box">
                <!-- Los mensajes se cargarán aquí -->
            </div>
            <form id="message-form" class="typing-area" action="php/insert-chat.php" method="POST">
                <input type="hidden" name="incoming_id" value="<?php echo htmlspecialchars($incoming_id); ?>">
                <input type="hidden" name="incoming_role" value="<?php echo htmlspecialchars($incoming_role); ?>">
                <input type="text" name="msg" class="input-field" placeholder="Escribe tu mensaje aquí..." autocomplete="off" required>
                <button type="submit"><i class="fab fa-telegram-plane"></i></button>
            </form>
        </section>
    </div>
    <script src="./Assets/chat.js"></script>
    <script>
$(document).ready(function() {
    // Carga los mensajes al inicio
    loadChat();

    $('#message-form').on('submit', function(event) {
        event.preventDefault(); // Previene la recarga de página
        console.log('Formulario enviado'); // Para verificar que el evento se dispara

        $.ajax({
            type: 'POST',
            url: 'php/insert-chat.php',
            data: $(this).serialize(), // Serializa los datos del formulario
            success: function(response) {
                console.log(response); // Muestra la respuesta en la consola
                $('input[name="msg"]').val(''); // Limpia el campo del mensaje
                loadChat(); // Cargar los mensajes nuevamente
            },
            error: function(xhr, status, error) {
                console.error('Error en el envío del mensaje:', error);
            }
        });
    });

    function loadChat() {
        $.ajax({
            type: 'POST',
            url: 'php/get-chat.php',
            data: {
                incoming_id: $('input[name="incoming_id"]').val(),
                incoming_role: $('input[name="incoming_role"]').val()
            },
            success: function(data) {
                $('.chat-box').html(data);
                scrollToBottom();
            }
        });
    }

    function scrollToBottom() {
        $('.chat-box').scrollTop($('.chat-box')[0].scrollHeight);
    }
});
    </script>
</body>
</html>
