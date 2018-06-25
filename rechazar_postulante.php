<?php
include('header.php');
$link = conectar();
$consulta1 = "SELECT rechazado FROM postulantes where (viaje_id = $_GET[id_viaje]) AND (postulante_id = $_GET[id])";

$resultado1 = mysqli_query($link,$consulta1);
$fila1= mysqli_fetch_array($resultado1);


if (($fila1['rechazado'] == 2) && (!isset($_GET['respuesta']))) {
		$_SESSION['confirmacion3'] = "Usted va a ser sancionado con una calificación negativa ¿Esta seguro de proceder?";
        header("Location: Postulantes.php?id_viaje=$_GET[id_viaje]&origen=$_GET[origen]&destino=$_GET[destino]&id= $_GET[id]");
      die();
}elseif ( $fila1['rechazado'] == 2) 
{
		$consulta = "UPDATE postulantes SET rechazado = 1 WHERE (postulante_id = $_GET[id]) AND (viaje_id = $_GET[id_viaje])";
		$resultado=mysqli_query($link,$consulta);
        $_SESSION['mensaje']= "El postulante fue rechazado exitosamente.";
		$_SESSION['id_viaje'] = $_GET['id_viaje'];
		unset($_GET['respuesta']);
       header("Location: Postulantes.php?id_viaje=$_GET[id_viaje]&origen=$_GET[origen]&destino=$_GET[destino]?>");
		die();
	
}
if (!isset($_GET['respuesta'])) {
	$_SESSION['confirmacion3'] = "¿Esta seguro de rechazar al postulante? El mismo no se visualizara mas.";
      header("Location: Postulantes.php?id_viaje=$_GET[id_viaje]&origen=$_GET[origen]&destino=$_GET[destino]&id= $_GET[id]");
      die();
}else{
		$consulta = "UPDATE postulantes SET rechazado = 1 WHERE (postulante_id = $_GET[id]) AND (viaje_id = $_GET[id_viaje])";
		$resultado=mysqli_query($link,$consulta);
        $_SESSION['mensaje']= "El postulante fue rechazado exitosamente.";
		$_SESSION['id_viaje'] = $_GET['id_viaje'];
		unset($_GET['respuesta']);
        header("Location: Postulantes.php?id_viaje=$_GET[id_viaje]&origen=$_GET[origen]&destino=$_GET[destino]?>");
		die();
}
