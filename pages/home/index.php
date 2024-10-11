<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Servicios varios</title>
     <link rel="shortcut icon" href="./../../assets/favicon.ico" type="image/x-icon">
     <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
     <link rel="stylesheet" href="./../../css/index.css">
     <script type="module" src="./../../js/input.js"></script>
     <script type="module">
          document.querySelector('.user-logout').addEventListener('click', () => {
               window.location.href = "../../connection/logout.php";
          });
     </script>
</head>

<body>
     <header class="header">
          <nav class="header_nav">
               <ul class="header_nav_list">
                    <?php session_start();
                    if (!isset($_SESSION['username'])) { ?>
                         <a class="header_main_options" href="./../register/register.php">
                              <span class="material-symbols-outlined">person_add</span>
                              <span>Registrarse</span>
                         </a>
                         <a class="header_main_options" href="./../login/login.php">
                              <span class="material-symbols-outlined">login</span>
                              <span>Iniciar sesion</span>
                         </a>
                    <?php } else { ?>
                         <div class="user-visual-options">
                              <div class="user-visual">
                                   <h4 class="username"><?php echo $_SESSION['username'] ?></h4>
                                   <img class="img-username" src="./../../assets/DNV.png" alt="perfil de ejemplo">
                              </div>
                              <button class="material-symbols-outlined user-logout">logout</button>
                         </div>
                    <?php } ?>
               </ul>
               <span class="material-symbols-outlined menu">menu</span>
          </nav>
     </header>
     <aside class="main-section">
          <nav>
               <ul>
                    <li class="main-search">
                         <input type="text" placeholder="Buscar servicio" class="main-input">
                         <span class="material-symbols-outlined find">search</span>
                    </li>
                    <?php if (isset($_SESSION['username'])) { ?>
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
     <main></main>
     <footer></footer>
</body>

</html>