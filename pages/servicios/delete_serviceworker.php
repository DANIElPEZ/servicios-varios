<?php
session_start();
header('Content-Type: application/json');
include('../../connection/connection.php');

ini_set('display_errors', 0);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['id_usuario'])) {
    $id_usuario = $_SESSION['id_usuario'];
    $id_contrato = $_POST['id_solicitud_servicio'];

    $sql = 'DELETE FROM solicitud_servicios WHERE id_solicitud = ? AND id_usuario = ?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $id_contrato, $id_usuario);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al ejecutar la eliminación']);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Acceso denegado o método incorrecto']);
}
