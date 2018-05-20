<?php 
	session_start();
	include('conexion.php');
	$link=conectar();
	//verifica si no hay usuarios o correos electronicos repetidos
	function existe ($email,$link){
		$existeEmail="SELECT * FROM usuarios  WHERE email='$email'";
		$resultado1= mysqli_query($link,$existeEmail);
		
		$rows1=mysqli_num_rows($resultado1);


		if ($rows1==0){
			return 0;
		}else{
			return 1;
		}
	}
	if (isset($_POST['nombre']) && !empty($_POST['nombre']) && isset($_POST['apellido']) && !empty($_POST['apellido']) && isset($_POST['email']) && 
		!empty($_POST['email']) && isset($_POST['fecha_nac']) && !empty($_POST['fecha_nac'])  && isset($_POST['pass1']) && !empty($_POST['pass1']) && isset($_POST['pass2']) && !empty($_POST['pass2'])  )  {

		$exp_String="/^[a-zA-ZÑñÁáÉéÍíÓóÚúÜü\s]+$/";
		$exp_email="/\w+@\w+\.+[a-z]/";
		$exp_Blancos="/\s/";

		$nombre=$_POST['nombre'];
		$apellido=$_POST['apellido'];
		$email=$_POST['email'];
		$pass1=$_POST['pass1'];
		$pass2=$_POST['pass2'];


		if (!preg_match($exp_String,$apellido)){
			$_SESSION['mensaje']="el apellido solo debe incluir letras";
			header("Location:registrarse.php");
			die("salir");
		
		}
		
		if (!preg_match($exp_String,$nombre)) { 
			$_SESSION['mensaje']="NOMBRE solo debe incluir letras";
			header("Location:registrarse.php");
			die("salir");
			
		}
		if (!preg_match($exp_email, $email)) {
			$_SESSION['mensaje']="El email no es valido, debe incluir un '@' y un '.' en la dirrecion de correo ejemplo: pepito@ejeplo.com";
			header("Location:registrarse.php");
			die("salir");
			
		}
		if (strlen($pass1) < "6") {
			$_SESSION['mensaje']="El nombre del usuario debe debe superar la longitud 6 de caracteres ";
			header("Location:registrarse.php");
			die("salir");
		}
		if (preg_match($exp_Blancos, $pass1)) {
			$_SESSION["mensaje"]="la contraseña no puede tener espacios en blanco";
			header("Location:registrarse.php");
			die("salir");
		}
		if ($pass1 != $pass2) {
			$_SESSION["mensaje"]="Las contraseñas no coiciden";
			header("Location:registrarse.php");
			die("salir");
		}

		$ok=existe($email,$link);
		if ($ok==0) {

		$sql="INSERT INTO usuarios(id,contenidoimagen, tipoimagen, email, password, nombre, apellido, fecha_nac) VALUES (NULL,NULL, NULL,'$_POST[email]','$_POST[pass1]','$_POST[nombre]','$_POST[apellido]','$_POST[fecha_nac]')";

			$resul=mysqli_query($link,$sql);//INSERTO LA CONSULTA A LA BASE DE DATOS

			if($resul){
				header("Location:ver_viajes.php");
			}else {$_SESSION['mensaje']="Error al cargar los datos"; header("Location:registrarse.php"); }


			
		}else{ $_SESSION['mensaje']="El email ya se encuentran registrado";
			 header("Location:registrarse.php");}
	}	else{
		$_SESSION["mensaje"]="Campos incompletos..!!";
		header("Location:registrarse.php");}





	mysqli_close($link);

?>