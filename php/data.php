<?php
session_start();
include_once "../Config/conexion.php";

$outgoing_id = $_SESSION['user_id'];
$outgoing_role = $_SESSION['role'];
$output = "";

// Consultar todos los usuarios con los que se ha tenido conversación
$sql = "SELECT * FROM messages 
        WHERE (outgoing_msg_id = {$outgoing_id} AND outgoing_role = '{$outgoing_role}')
        OR (incoming_msg_id = {$outgoing_id} AND incoming_role = '{$outgoing_role}')
        GROUP BY CASE 
                    WHEN outgoing_msg_id = {$outgoing_id} THEN incoming_msg_id 
                    ELSE outgoing_msg_id 
                 END, 
                 CASE 
                    WHEN outgoing_role = '{$outgoing_role}' THEN incoming_role 
                    ELSE outgoing_role 
                 END
        ORDER BY timestamp DESC";

$query = mysqli_query($conn, $sql);

if (mysqli_num_rows($query) > 0) {
    while ($row = mysqli_fetch_assoc($query)) {
        $incoming_id = ($row['outgoing_msg_id'] === $outgoing_id) ? $row['incoming_msg_id'] : $row['outgoing_msg_id'];
        $incoming_role = ($row['outgoing_role'] === $outgoing_role) ? $row['incoming_role'] : $row['outgoing_role'];
        
        // Obtener detalles del usuario con el que se tiene conversación
        if ($incoming_role === 'contratista') {
            $user_sql = "SELECT * FROM contratistas WHERE id = {$incoming_id}";
        } elseif ($incoming_role === 'empresa') {
            $user_sql = "SELECT * FROM empresas WHERE id = {$incoming_id}";
        } else {
            $user_sql = "SELECT * FROM freelancers WHERE id = {$incoming_id}";
        }
        $user_query = mysqli_query($conn, $user_sql);
        $user_row = mysqli_fetch_assoc($user_query);

        // Obtener el último mensaje
        $last_msg_sql = "SELECT msg FROM messages 
                         WHERE (outgoing_msg_id = {$outgoing_id} AND incoming_msg_id = {$incoming_id} AND outgoing_role = '{$outgoing_role}' AND incoming_role = '{$incoming_role}')
                         OR (outgoing_msg_id = {$incoming_id} AND incoming_msg_id = {$outgoing_id} AND outgoing_role = '{$incoming_role}' AND incoming_role = '{$outgoing_role}')
                         ORDER BY timestamp DESC LIMIT 1";
        $last_msg_query = mysqli_query($conn, $last_msg_sql);
        $last_msg_row = mysqli_fetch_assoc($last_msg_query);
        $last_msg = $last_msg_row ? $last_msg_row['msg'] : "No hay mensajes disponibles";

        $msg_preview = (strlen($last_msg) > 28) ? substr($last_msg, 0, 28) . '...' : $last_msg;

        // Preparar la estructura HTML
        $output .= '<a href="chat.php?user_id=' . $user_row['id'] . '&role=' . $incoming_role . '">  
                        <div class="content">
                            <img src="' . $user_row['image_url'] . '" alt="Profile Image">
                            <div class="details">
                                <span>' . ($user_row['nombre'] ?? $user_row['nombre_empresa']) . '</span> 
                                <p>' . $msg_preview . '</p>
                            </div>
                        </div>
                        <div class="status-dot"><i class="fas fa-circle"></i></div>
                    </a>';
    }
} else {
    $output .= '<div class="text">No tienes conversaciones recientes.</div>';
}

echo $output;
?>
