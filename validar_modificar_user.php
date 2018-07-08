<?php
	include('conexion.php');
	$link=conectar();
	session_start();
	include('clases.php');
	$verificar = new validar($link);
	$id= $verificar->id();


try {
	$verificar->logueado();

	if (isset($_POST['nombre']) && !empty($_POST['nombre']) && isset($_POST['apellido']) && !empty($_POST['apellido']) && isset($_POST['fecha_nac']) && !empty($_POST['fecha_nac'])  && isset($_POST['pass1']) && !empty($_POST['pass1']) && isset($_POST['pass2']) && !empty($_POST['pass2']) )  {

		/*$exp_String="/^[a-zA-ZÑñÁáÉéÍíÓóÚúÜü\s]+$/";
		$exp_email="/\w+@\w+\.+[a-z]/";
		$exp_Blancos="/\s/";$nombre=$_POST['nombre'];
		$apellido=$_POST['apellido'];*/

		
		$pass1=$_POST['pass1'];
		$pass2=$_POST['pass2'];


		/*if (!preg_match($exp_String,$apellido)){
			$_SESSION['mensaje']="el apellido solo debe incluir letras";
			header("Location:modificar_usuario.php");
			die("salir");
		
		}
		
		if (!preg_match($exp_String,$nombre)) { 
			$_SESSION['mensaje']="El nombre solo debe incluir letras";
			header("Location:modificar_usuario.php");
			die("salir");
			
		}*/

		if (strlen($pass1) < "6") {
			$_SESSION['mensaje']="La contraseña deber superar la longitud 6 de caracteres ";
			header("Location:modificar_usuario.php");
			die("salir");
		}
		/*if (preg_match($exp_Blancos, $pass1)) {
			$_SESSION["mensaje"]="la contraseña no puede tener espacios en blanco";
			header("Location:modificar_usuario.php");
			die("salir");
		}*/
		if ($pass1 != $pass2) {
			$_SESSION["mensaje"]="Las contraseñas no coiciden";
			header("Location:modificar_usuario.php");
			die("salir");
		}

		$consulta="UPDATE usuarios SET password = '$_POST[pass1]', nombre= '$_POST[nombre]', apellido = '$_POST[apellido]', fecha_nac= '$_POST[fecha_nac]' WHERE id = $id";

		$resultado=mysqli_query($link,$consulta);
		if($resultado) {
				header("Location:mi_perfil.php");//si se realizo la consulta me dirigo al index
				die("exito");
			}else{ 	
				$_SESSION['mensaje']="Error, recuerde que las comillas simples ('  ') interfieren con la consulta.";
				header("Location:modificar_usuario.php");
				die("fin"); 
			}

	}else{
			$_SESSION['mensaje']="Error, campos  incompletos";
			header("Location:modificar_usuario.php");
				die("fin"); 
	}




} catch (Exception $e) {
	$_SESSION["mensaje"]="Debe de iniciar sesion..!!";
		header("Location:index.php");
	}
	mysqli_close($link);
 ?>