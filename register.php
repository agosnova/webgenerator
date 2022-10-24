<?php 
	session_start();
	$estado = false;
	if (isset($_SESSION['id'])) {
		$estado = true;
		header("Location: panel.php");
	} else {
		if (isset($_SESSION['id'])) {
			$usuario = $_SESSION['id'];
		}
		if (isset($_SESSION['email'])) {
			$email = $_SESSION['email'];
		}
		if (isset($_SESSION['password'])) {
			$password = $_SESSION['password'];
		}
	}

	$mensaje = "";
	if (isset($_POST["btn"])) {
		if ($_POST["txtEmail"]=="" && $_POST["txtPassword"]==""){
			$mensaje = "Datos Incompletos";
		}else if ($_POST["txtEmail"]=="" && $_POST["txtPassword"]!=""){
			$mensaje = "Datos incompletos";
		}else if ($_POST["txtPassword"]=="" && $_POST["txtEmail"]!=""){
			$mensaje = "Datos Incompletos";
		}else if ($_POST["txtEmail"] != ""  && $_POST["txtPassword"] != ""){
			if ($_POST["txtPassword"] == $_POST["txtpassword2"]) {
				$email = $_POST['txtEmail'];
				$Password = $_POST['txtPassword'];
				$Connection = mysqli_connect("localhost", "adm_webgenerator", "webgenerator2020", "webgenerator");
				$Sql = mysqli_query($Connection, "SELECT * FROM usuarios WHERE email = '$email' ");
				$data = mysqli_fetch_row($Sql);
				if ($data[0] > 0) {
					$mensaje = "Este correo ya esta en uso";
				} else {
					$fechaRegistro = shell_exec('date +%y\ %m\ %d');
					$fechaRegistro = strtr($fechaCreacion," ", "-");
					$consulta = "INSERT INTO usuarios(`idUsuario`, `email`, `password`, `fechaRegistro`) VALUES (NULL,'$email','$Password','$fechaCreacion')";
					$Sql = mysqli_query($Connection, $consulta);
					header("Location: login.php");
				}
			}else{
				$mensaje = "Las contraseñas no coinciden";
			}
		}
	}
?>


<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Registro</title>
</head>
<body>
	<h1>Registrarte es Simple</h1>
	<form action="#" method="POST">
		<input type="text" name="txtEmail" placeholder="Email">
		<br><br>
		<input type="password" name="txtPassword" placeholder="Contraseña">
		<br><br>
		<input type="password" name="txtpassword2" placeholder="Repetir contraseña">
		<br><br>
		<input type="submit" name="btn" value="Registrarse">
		<br><br>
	</form>
		<a href="login.php">
			Ya tengo cuenta
		</a>
	<div> <?php echo $mensaje; ?></div>
				
</body>
</html>