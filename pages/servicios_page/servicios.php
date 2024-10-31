<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Servicios</title>
     <link rel="stylesheet" href="./../../css/servicios.css">
     <link rel="stylesheet" href="./../../css/scroll_bar.css">
     <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
     <link rel="shortcut icon" href="./../../assets/favicon.ico" type="image/x-icon">
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
               <?php } ?>
          </nav>
     </header>
     <main class="grid-my-services">
          <?php
          if ($_SESSION['id_tipo']==2) {
               include('../../connection/connection.php');
               $sql = 'SELECT * FROM solicitud_servicios WHERE id_usuario=?';
               $stmt = $conn->prepare($sql);
               $stmt->bind_param('s', $_SESSION['id_usuario']);
               $stmt->execute();
               $result = $stmt->get_result();

               while ($row = $result->fetch_assoc()) {
                    $service = $conn->query('SELECT nombre_servicio FROM servicios WHERE id_servicio=' . $row["id_servicio"])->fetch_assoc(); ?>
                    <div class="grid-item">
                         <div class="head-modal">
                              <h4 class="title-service"><?php echo $service['nombre_servicio'] ?></h4>
                              <button class="material-symbols-outlined delete-service" data-id="<?php echo $row['id_solicitud'] ?>">delete</button>
                         </div>
                         <p class="description-modal"><?php echo $row['descripcion'] ?></p>
                         <div class="main-info">
                              <p class="ubication"><?php
                                                       $ubication = $conn->query('SELECT pais, region, ciudad FROM ubicaciones WHERE id_ubicacion=' . $row['id_ubicacion'])->fetch_assoc();
                                                       echo $ubication['pais'] . ' ' . $ubication['region'] . ' ' . $ubication['ciudad'] . ' ';
                                                       ?></p>
                              <p class="price"><?php echo $row['precio_ofertado'] ?></p>
                              <p class="open-date"><?php echo $row['fecha_apertura'] ?></p>
                              <div class="close-date-section">
                                   <span class="material-symbols-outlined close-date-icon">event_busy</span>
                                   <button class="close-date" data-id="<?php echo $row['id_solicitud'] ?>">Cerrar servicio</button>
                              </div>
                         </div>
                    </div>
          <?php }
               $conn->close();
          } ?>
     </main>
     <script>
          document.querySelectorAll('.delete-service').forEach(button => {
               button.addEventListener('click', function() {
                    const serviceId = this.getAttribute('data-id');

                    fetch('../servicios/delete_serviceworker.php', {
                              method: 'POST',
                              headers: {
                                   'Content-Type': 'application/x-www-form-urlencoded'
                              },
                              body: 'id_solicitud_servicio=' + serviceId
                         })
                         .then(response => response.json())
                         .then(data => {
                              if (data.success) {
                                   this.closest('.grid-item').remove();
                              } else {
                                   alert('Error al eliminar el servicio.');
                              }
                         })
                         .catch(error => console.error('Error:', error));
               });
          });

          document.querySelectorAll('.close-date').forEach(button => {
               button.addEventListener('click', function() {
                    const serviceId = this.getAttribute('data-id');

                    fetch('../servicios/update_service_worker.php', {
                              method: 'POST',
                              headers: {
                                   'Content-Type': 'application/x-www-form-urlencoded'
                              },
                              body: 'id_solicitud_servicio=' + serviceId
                         })
                         .then(response => response.json())
                         .then(data => {
                              if (data.success) {
                                   this.closest('.grid-item').remove();
                              } else {
                                   alert(data.message || 'Error al eliminar el servicio.');
                              }
                         })
                         .catch(error => console.error('Error:', error));
               });
          });
     </script>
</body>

</html>