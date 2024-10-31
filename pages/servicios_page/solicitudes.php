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
               include('./../../connection/connection.php');
               $id_usuario = $_SESSION['id_usuario'];

               // Consulta SQL para obtener coincidencias entre solicitud_servicios y contratos
               $sql = "SELECT c.* FROM solicitud_servicios AS s INNER JOIN contratos AS c ON s.id_solicitud = c.id_solicitud WHERE s.id_usuario = ?";
               $stmt = $conn->prepare($sql);
               $stmt->bind_param("s", $id_usuario);
               $stmt->execute();
               $result = $stmt->get_result();

               while ($row = $result->fetch_assoc()) { 
                    //lenando modal
                    $id_solicitud=$row['id_solicitud'];
                    $modal=$conn->query('SELECT fecha_apertura, precio_ofertado, descripcion, id_servicio, id_ubicacion FROM solicitud_servicios WHERE id_solicitud='.$id_solicitud)->fetch_assoc();
                    $title=$conn->query('SELECT nombre_servicio FROM servicios WHERE id_servicio='.$modal['id_servicio'])->fetch_assoc();
                    $ubication=$conn->query('SELECT pais, region, ciudad FROM ubicaciones WHERE id_ubicacion='.$modal['id_ubicacion'])->fetch_assoc();
                    ?>
                    <div class="grid-item">
                         <div class="head-modal">
                              <h4 class="title-modal"><?php echo $title['nombre_servicio']?></h4>
                              <button class="material-symbols-outlined delete-service" data-id="<?php echo $row['id_contrato'] ?>">delete</button>
                         </div>
                         <p class="description-modal"><?php echo $modal['descripcion']?></p>
                         <div class="main-info">
                              <p class="ubication"><?php echo $ubication['pais'].' '.$ubication['region'].' '.$ubication['ciudad']?></p>
                              <p class="price"><?php echo $modal['precio_ofertado']?></p>
                              <p class="open-date"><?php echo $modal['fecha_apertura']?></p>
                         </div>
                    </div>
          <?php }
               $stmt->close();
               $conn->close();
          }
          ?>
     </main>
     <script>
          document.querySelectorAll('.delete-service').forEach(button => {
               button.addEventListener('click', function() {
                    const serviceId = this.getAttribute('data-id');

                    fetch('./../servicios/close_service.php', {
                              method: 'POST',
                              headers: {
                                   'Content-Type': 'application/x-www-form-urlencoded'
                              },
                              body: 'id_solicitud_servicio=' + serviceId
                         })
                         .then(response => {
                              if (!response.ok) {
                                   throw new Error('Network response was not ok');
                              }
                              return response.json();
                         })
                         .then(data => {
                              if (data.success) {
                                   this.closest('.grid-item').remove();
                              } else {
                                   alert(data.error || 'Error al eliminar el servicio.');
                              }
                         })
                         .catch(error => console.error('Error:', error));
               });
          });
     </script>
</body>

</html>