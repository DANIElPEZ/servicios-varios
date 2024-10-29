<?php
include('../../connection/connection.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
     $id_usuario=$_SESSION['id_usuario'];
     $id_contrato = $_POST['id_contrato'];

     $sql = 'DELETE FROM contratos WHERE id_contrato = ? AND id_usuario=?';
     $stmt = $conn->prepare($sql);
     $stmt->bind_param("ii", $id_contrato, $id_usuario);

     if ($stmt->execute()) {
          echo json_encode(['success' => true]);
     } else {
          echo json_encode(['success' => false]);
     }

     $stmt->close();
     $conn->close();
}else{
     echo json_encode(['success' => false]);
}