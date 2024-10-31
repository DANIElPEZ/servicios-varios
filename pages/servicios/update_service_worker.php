<?
session_start();
include('./../../connection/connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['id_usuario'])) {
     $id_usuario = $_SESSION['id_usuario'];
     $id_solicitud = $_POST['id_solicitud_servicio'];
     $fecha_cierre = date('Y-m-d H:i:s');

     $sql = 'UPDATE solicitud_servicios SET fecha_cierre=? WHERE id_solicitud = ? AND id_usuario = ?';
     $stmt = $conn->prepare($sql);
     $stmt->bind_param("sii", $fecha_cierre, $id_solicitud, $id_usuario);

     if ($stmt->execute()) {
          echo json_encode(['success' => true]);
     } else {
          echo json_encode(['success' => false]);
     }

     $stmt->close();
     $conn->close();
} else {
     echo json_encode(['success' => false]);
}
