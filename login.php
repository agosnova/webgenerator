<?php
	session_start();
	$estado = false;
	if (isset($_SESSION['id'])) {
		$estado = true;
		header("Location: panel.php");
	}
?>

<?php 
	$mensaje = "";
	if (isset($_POST["btn"])) {
		if ($_POST["Email"]=="" && $_POST["Password"]==""){
			$mensaje = "Datos incompletos";
		} else if ($_POST["Email"]=="" && $_POST["Password"]!=""){
			$mensaje = "Datos incompletos";
		} else if ($_POST["Password"]=="" && $_POST["Email"]!=""){
			$mensaje = "Datos incompletos";
		} else if ($_POST["Email"] != ""  && $_POST["Password"] != ""){
			$mensaje = "Datos incorrectos";
		}
	}
?>

<?php
	
	if (isset($_POST["btn"])) {
		$Email = "";
		$Password = "";
		$Email = $_POST["Email"];
		$Password = $_POST["Password"];
		$Connection = mysqli_connect("localhost", "adm_webgenerator", "webgenerator2020", "webgenerator");
		$Sql = mysqli_query($Connection, "SELECT idUsuario, email, password FROM usuarios WHERE email='$Email' AND password='$Password'");

		$idUsuario = mysqli_fetch_row($Sql);
		if ($idUsuario[0] > 0) {
			session_start();
			$_SESSION['id'] = $idUsuario[0];
			$_SESSION['email'] = $idUsuario[1];
			$_SESSION['password'] = $idUsuario[2];
			header("Location: panel.php");
		}
	}
?>

<!DOCTYPE html>
 <html lang="es">
 <head>
 	<meta charset="UTF-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1.0">
 	<title>Login</title>
 </head>
 <body>
 	<h1>webgenerator Agostina Novales</h1>
 	<form action="#" method="POST">
 		<input type="text" name="Email" placeholder="Email">
 		<br><br>
 		<input type="password" name="Password" placeholder="Contraseña">
 		<br><br>
 		<a href="register.php">No tienes cuenta?</a>
 		<br><br>
 		<input type="submit" name="btn" value="Ingresar">
 	</form>
 	<div>
 		<?php echo $mensaje; ?>
 	</div>
 </body>
 </html>