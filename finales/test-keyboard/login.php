<?php
	require_once ('src/classes/UsuarioControl.class.php');
	require_once ('src/classes/usuario.php');

	session_start();	
	if ($_POST){				
		$user=($_POST['usuario']);
		$pass=($_POST['password']);						
		if ($user!=null && $pass!=null){			
			$respuesta = usuarioControl::comparaLogin($user,md5($pass));			
			if(isset($respuesta) && $respuesta != null){
				$_SESSION["usuario_totem"] = $respuesta;
				echo $_SESSION["usuario_totem"]->getNodo(); die;
				header("Location: index.html");
				
			}else 
				header("Location: login.php?err=1");
		}else
			header("Location: login.php?err=1");		
	}
	
	if(isset($_GET["do"]) && $_GET["do"]=="logout"){
		unset($_SESSION["usuario_sbr"]);
		session_destroy();
		header("Location: login.php");
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Area Restringida</title>
	<link rel="stylesheet" href="src/css/login.css" type="text/css" media="screen" />
</head>
<body>
<?php if(isset($_GET["err"])) echo '<div id="error">Usuario o contrase&ntilde;a incorrectos</div>'; ?>
	<div id="componentelogin">
		<div id="bien">Bienvenido</div>
		<div id="fis">Favor Inicie Sesi&oacute;n</div>
		<form action="login.php" method="post">
		<table>		
			<tr>
				<td>Nombre de Usuario</td>
				<td>:</td>
				<td>
					<input type="text" name="usuario"/>
				</td>
			</tr>
			<tr>
				<td>Contraseña</td>
				<td>:</td>
				<td>
					<input type="password" name="password" />
				</td>
			</tr>
			<tr>
				<td colspan="3" align="right"><input type="submit" value="Ingresar"/></td>
			</tr>
		</table>
	</form>
	</div>
</body>
</html>
