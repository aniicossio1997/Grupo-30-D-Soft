<?php 
include('conexion.php');
$link=conectar();
session_start();
include('clases.php');


$verificar = new validar($link);

try {
	$verificar->logueado();

	if (isset($_GET['marca']) && !empty($_GET['marca']) && isset($_GET['patente']) && !empty($_GET['patente']) && isset($_GET['modelo']) && !empty($_GET['modelo']) && isset($_GET['asientos']) && !empty($_GET['asientos'])) {

		$id=$verificar->id();
		
		$sql="INSERT INTO vehiculo(id, usuario_id, marca, patente, modelo,asientos, activo) VALUES (null,'$id','$_GET[marca]','$_GET[patente]','$_GET[modelo]','$_GET[asientos]',1)";

		$resultado=mysqli_query($link,$sql);
		if($resultado) {
			header("Location:mis_vehiculos.php");
			die("salir");
		}else{
			$_SESSION['add_vehiculo']="Error al guardar los datos, recuerde que las comillas simples provocan error en el sistema";
				header("Location:agregar_vehiculo.php");
				die("salir");
			}
		
	}else{
		$_SESSION['add_vehiculo']="Usted debe completar todos los campos";
		header("Location:agregar_vehiculo.php");
		die("salir");
		}


} catch (Exception $e) {
			$_SESSION['add_vehiculo']="Usted debe Iniciar sesion";
			header("Location:index.php");

	
}


mysqli_close($link);

?>