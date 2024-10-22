<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Servicios varios</title>
     <link rel="shortcut icon" href="./../../assets/favicon.ico" type="image/x-icon">
     <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
     <link rel="stylesheet" href="./../../css/index.css">
     <script type="module" src="./../../js/menu.js"></script>
     <script type="module" src="./../../js/modal.js"></script>
</head>

<body>
     <header class="header">
          <nav class="header_nav">
               <ul class="header_nav_list">
                    <div class="header-main-options">
                         <?php session_start();
                         if (isset($_SESSION['username'])) { ?>
                              <button class="material-symbols-outlined menu">menu</button>
                         <?php } ?>
                         <li class="main-search">
                              <input type="text" placeholder="Buscar servicio" class="main-input">
                              <span class="material-symbols-outlined find">search</span>
                         </li>
                    </div>
                    <?php
                    if (!isset($_SESSION['username'])) { ?>
                         <div class="main-user-buttons">
                              <a class="header_main_options" href="./../register/register.php">
                                   <span class="material-symbols-outlined">person_add</span>
                                   <span>Registrarse</span>
                              </a>
                              <a class="header_main_options" href="./../login/login.php">
                                   <span class="material-symbols-outlined">login</span>
                                   <span>Iniciar sesion</span>
                              </a>
                         </div>
                    <?php } else { ?>
                         <div class="user-visual-options">
                              <div class="user-visual">
                                   <h4 class="username"><?php echo $_SESSION['username'] ?></h4>
                                   <img class="img-username" src="./../../assets/DNV.png" alt="perfil de ejemplo">
                              </div>
                              <form action="./../../connection/logout.php">
                                   <button class="material-symbols-outlined user-logout">logout</button>
                              </form>
                         </div>
                    <?php } ?>
               </ul>
          </nav>
     </header>
     <aside class="main-section">
          <nav>
               <ul class="user-aside-options">
                    <?php if (isset($_SESSION['username'])) { ?>
                         <button class="material-symbols-outlined close">close</button>
                         <li>
                              <a href="./../profile/profile.php" class="main_options">
                                   <span class="material-symbols-outlined">account_circle</span>
                                   <span class="profile">Perfil</span>
                              </a>
                         </li>
                         <li>
                              <a href="./../contratos/contratos.php" class="main_options">
                                   <span class="material-symbols-outlined">format_list_bulleted</span>
                                   <span class="task">Contratos</span>
                              </a>
                         </li>
                    <?php } ?>
               </ul>
          </nav>
     </aside>
     <main class="servicios-grid">
          <?php for ($i = 0; $i < 5; $i++) { ?>
               <div class="servicios-grid-item">
                    <h4>Reparacion de motor</h4>
                    <p>Se repara motor, de carro, moto, bicicleta, electrico, avion, barco, submarino, rancio, humano, elefante, pajaro, pez, rana, computador, reactor, nuclear</p>
                    <div class="grid-item-buttons">
                         <button id="button" class="material-symbols-outlined">account_box</button>
                         <button id="buy-work" class="material-symbols-outlined">shopping_cart</button>
                    </div>

                    <dialog class="dialog" id="infoDialog">
                         <form method="dialog">
                              <button type="submit" class="material-symbols-outlined close-dialog">close</button>
                         </form>
                         <p>contenido trabajador</p>
                    </dialog>
               </div>
          <?php } ?>
     </main>
</body>

</html>