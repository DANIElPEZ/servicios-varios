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
</body>
</html>