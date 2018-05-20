<?php 
include('conexion.php');
$link=conectar();
session_start();
include('clases.php');
$verificar = new validar($link);

try {
	$verificar->logueado();

	if (isset($_GET['vehiculo']) && !empty($_GET['vehiculo'])) {
		$vehiculo=$_GET['vehiculo'];
		$consulta="SELECT activo FROM vehiculo WHERE id=$vehiculo'";
		$resultado=mysqli_query($link,$consulta);//se borran todos los comentarios//

	}
	header("Location:index.php");
	$_SESSION['mensaje']="exito";
	
} catch (Exception $e) {
	header("Login.php");
	
}
mysqli_close($link);
?>