<?php
session_start();
if (isset($_SESSION['user_id']) && isset($_SESSION['role'])) {
    include_once "../Config/conexion.php";

    $outgoing_id = $_SESSION['user_id'];
    $outgoing_role = $_SESSION['role'];
    $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
    $incoming_role = mysqli_real_escape_string($conn, $_POST['incoming_role']);
    
    $output = "";
    $sql = "SELECT * FROM messages 
            WHERE (outgoing_msg_id = {$outgoing_id} AND incoming_msg_id = {$incoming_id} AND outgoing_role = '{$outgoing_role}' AND incoming_role = '{$incoming_role}')
            OR (outgoing_msg_id = {$incoming_id} AND incoming_msg_id = {$outgoing_id} AND outgoing_role = '{$incoming_role}' AND incoming_role = '{$outgoing_role}')
            ORDER BY timestamp";

    $query = mysqli_query($conn, $sql);
    if (mysqli_num_rows($query) > 0) {
        while ($row = mysqli_fetch_assoc($query)) {
            // Asegúrate de que las comparaciones de IDs se realicen correctamente
            if ($row['outgoing_msg_id'] == $outgoing_id) {
                $output .= '<div class="chat outgoing"><div class="details"><p>' . htmlspecialchars($row['msg']) . '</p></div></div>';
            } else {
                $output .= '<div class="chat incoming"><div class="details"><p>' . htmlspecialchars($row['msg']) . '</p></div></div>';
            }
        }
    } else {
        $output .= '<div class="text">No hay mensajes disponibles. Una vez que envíe el mensaje, aparecerán aquí.</div>';
    }
    echo $output;
} else {
    header("location: ../login.php");
}
?>
