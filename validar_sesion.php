<?php

include('conexion.php');
$link=conectar();
session_start();
include('clases.php');


if (isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['password']) && !empty($_POST['password'])) {
	$usuario=$_POST['email'];
	$clave=$_POST['password'];

	$verificar = new validar($link);
	try{
		   $verificar->autenticar($usuario,$clave);
		    header("Location:ver_viajes.php");
	} catch(Exception $e) {
		    	//echo "error";
		    $_SESSION['mensaje']="Datos incorectos";
			header("Location:index.php");
	}

}else{
			$_SESSION['mensaje']="COMPLETE LOS CAMPOS";
			header("Location:index.php");
		}

 mysqli_close($link);
?>