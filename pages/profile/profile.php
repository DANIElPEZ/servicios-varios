<?php
include('../../connection/connection.php');
$sql = "SELECT * FROM ubicaciones";
$result = $conn->query($sql);
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Perfil</title>
	<link rel="shortcut icon" href="./../../assets/favicon.ico" type="image/x-icon">
	<link rel="stylesheet" href="./../../css/profile.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
	<link rel="stylesheet" href="./../../css/scroll_bar.css">
	<style>
		p {
			display: flex;
			align-items: center;
			justify-content: center;
			height: 90dvh;
		}
	</style>
</head>

<body>
	<header class="nav-options">
		<nav>
			<ul>
				<a href="./../home/index.php" class="home">
					<span class="material-symbols-outlined">home</span>
				</a>
				<?php 
				session_start();
				if (isset($_SESSION['id_tipo']) && $_SESSION['id_tipo']==1) { 
				?>
				<a href="./../contratos/contratos.php" class="contratos">
					<span class="material-symbols-outlined">format_list_bulleted</span>
				</a>
				<?php
				}else if(isset($_SESSION['id_tipo'])){ ?>
					<a href="./../servicios/servicios.php" class="servicios">
						<span class="material-symbols-outlined">work</span>
					</a>
				<?php } ?>
			</ul>
		</nav>
	</header>
	<?php
	if (isset($_SESSION['username'])) { ?>
		<main class="profile">
			<h2>Editar perfil</h2>

			<?php
			if (isset($_GET['error']) && $_GET['error'] == 1) {
				echo '<div class="error-message" style="color: red; text-align: center; margin-bottom: 10px;">Debes llenar los campos</div>';
			}
			?>

			<form action="./save_profile.php" class="form" method="post">
				<div class="form-name">
					<label for="name" class="form-label">Nombres:</label>
					<input class="form-name-input" id="name" value="<?php echo $_SESSION['nombre'] ?>" name="name" required>
				</div>

				<div class="form-lastname">
					<label for="lsuser" class="form-label">Apellidos:</label>
					<input class="form-lastname-input" id="lsuser" value="<?php echo $_SESSION['apellido'] ?>" name="lastname" required>
				</div>

				<div class="form-email">
					<label for="email" class="form-label">Correo:</label>
					<input class="form-email-input" id="email" type="email" value="<?php echo $_SESSION['correo'] ?>" name="email" required>
				</div>

				<div class="form-phone">
					<label for="phone" class="form-label">Telefono:</label>
					<input class="form-phone-input" id="phone" type="number" value="<?php echo $_SESSION['telefono'] ?>" name="number">
				</div>

				<div class="form-direction">
					<label for="direction" class="form-label">direccion:</label>
					<input class="form-direction-input" id="direction" value="<?php echo $_SESSION['direccion'] ?>" name="direction">
				</div>

				<div class="form-username">
					<label for="username" class="form-label">Usuario:</label>
					<input class="form-username-input" id="username" value="<?php echo $_SESSION['username'] ?>" name="username" required>
				</div>

				<div class="form-password">
					<label for="pwd" class="form-label">Clave:</label>
					<input class="form-password-input" id="pwd" type="password" value="<?php echo $_SESSION['password'] ?>" name="password" required>
				</div>

				<div class="form-type-user">
					<label for="type-user" class="form-label">Tipo:</label>
					<select class="form-type-user-input" id="type-user" name="type">
						<option value="1" <?php if ($_SESSION['id_tipo'] == 1) echo 'selected'; ?>>Usuario</option>
						<option value="2" <?php if ($_SESSION['id_tipo'] == 2) echo 'selected'; ?>>Trabajador</option>
					</select>
				</div>

				<div class="form-ubication">
					<label for="ubication" class="form-label">Ubicacion:</label>
					<select class="form-ubication-input" id="ubication" name="ubication">

						<?php
						while ($row = $result->fetch_assoc()) { ?>
							<option value="<?php echo htmlspecialchars($row["id_ubicacion"]); ?>" <?php if ($_SESSION['id_ubicacion'] == $row["id_ubicacion"]) echo 'selected'; ?>><?php echo htmlspecialchars($row["pais"] . " " . $row["region"] . " " . $row["ciudad"]); ?></option>
						<?php
						}
						?>
					</select>
				</div>

				<div class="form-actions">
					<button class="form-button">Actualizar Usuario</button>
				</div>
			</form>
		</main>
	<?php } else { ?>
		<p>Inicia sesion o Registrate</p>
	<?php } ?>
</body>

</html>