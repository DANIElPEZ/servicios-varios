<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Solicitudes</title>
     <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
     <link rel="shortcut icon" href="./../../assets/favicon.ico" type="image/x-icon">
     <link rel="stylesheet" href="./../../css/solicitudes.css">
     <link rel="stylesheet" href="./../../css/scroll_bar.css">
</head>
<body>
<header class="main-nav">
          <nav class="nav-items">
               <a href="./../home/index.php" class="home">
                    <span class="material-symbols-outlined">home</span>
               </a>
               <?php
               session_start();
               if (isset($_SESSION['id_tipo'])) { ?>
                    <a href="./../profile/profile.php" class="profile">
                         <span class="material-symbols-outlined">account_circle</span>
                    </a>
                    <a href="./../servicios_page/servicios.php" class="servicios">
                         <span class="material-symbols-outlined">work</span>
                    </a>
               <?php } ?>
          </nav>
     </header>
     <main class="grid-my-services">
          <?php
          if (isset($_SESSION['id_usuario'])) {
               include('../../connection/connection.php');
               $id_usuario = $_SESSION['id_usuario'];

               $sql = 'SELECT id_contrato, id_solicitud FROM contratos WHERE id_usuario=?';
               $stmt = $conn->prepare($sql);
               $stmt->bind_param("s", $id_usuario);
               $stmt->execute();
               $result = $stmt->get_result();
               $stmt->close();

               while ($row = $result->fetch_assoc()) {
                    $modal = $conn->query('SELECT id_servicio, descripcion FROM solicitud_servicios WHERE id_solicitud=' . $row['id_solicitud'])->fetch_assoc();
                    $title = $conn->query('SELECT nombre_servicio FROM servicios WHERE id_servicio=' . $modal['id_servicio'])->fetch_assoc();

          ?>
                    <div class="grid-item">
                         <div class="head-modal">
                              <h4 class="tilte-modal"><?php echo $title['nombre_servicio'] ?></h4>
                              <button class="material-symbols-outlined delete-service" data-id="<?php echo $row['id_contrato'] ?>">delete</button>
                         </div>
                         <p class="description-modal"><?php echo $modal['descripcion'] ?></p>
                    </div>
          <?php }
               $conn->close();
          }
          ?>
     </main>
</body>
</html>