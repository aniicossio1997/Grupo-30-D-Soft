<?php 
include('conexion.php');
$link=conectar();
session_start();
include('clases.php');
if (isset($_POST['varios']) && !empty($_get['varios']) && $_POST['varios']==0 && isset($_POST['fecha']) && !empty($_POST['fecha']) && isset($_POST['origen']) && !empty($_POST['origen']) && isset($_POST['destino']) && !empty($_POST['destino']) && isset($_POST['costo']) && !empty($_POST['costo']) && isset($_POST['duracion']) && !empty($_POST['duracion']) && isset($_POST['copilotos']) && !empty($_POST['copilotos'])) {
	 $_SESSION['msj']= "Campo requerido, selecciones un vehiculo";
    header("Location:agregar_viaje.php");
    die("salir");
}else{
	echo " error";}


?>