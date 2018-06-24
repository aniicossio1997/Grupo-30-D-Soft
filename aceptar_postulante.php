<?php
	date_default_timezone_set('America/Argentina/Buenos_Aires');
	include('conexion.php');
	$link=conectar();
	session_start();
	include('clases.php');
	$verificar = new validar($link);//se crea  una clase
	$id_user=$verificar->id();


	$consulta="SELECT COUNT(id) as numero FROM postulantes WHERE viaje_id='$_GET[id_viaje]'";

	$consulta_2="SELECT copilotos, id,origen,destino FROM viajes WHERE id='$_GET[id_viaje]'";
	$resul_2=mysqli_query($link,$consulta_2);
	$resul=mysqli_query($link,$consulta);
	$pos=mysqli_fetch_array($resul);
	$viaje=mysqli_fetch_array($resul_2);

	if ($pos['numero'] >= $viaje['copilotos']) {
//si no se puede elgir copilotos
		$_SESSION['mensaje']="No stiene asientos disponibles, ya ha exedido el limite";

		header("Location:Postulantes.php?id_viaje=$viaje[id]&origen=$viaje[origen]&destino=$viaje[destino]");
		die();
	}


	$consulta_3="UPDATE postulantes SET rechazado = 2 WHERE postulante_id='$_GET[id_pos]' AND viaje_id='$_GET[id_viaje]'";
	$resul_3=mysqli_query($link,$consulta_3);

	if ($resul_3) {
		//si la consulta se realizo con exito
		$_SESSION['mensaje']= "Aceptacion exitosa";
		header("Location:Postulantes.php?id_viaje=$viaje[id]&origen=$viaje[origen]&destino=$viaje[destino]");


		die();
	}
	$_SESSION['mensaje']= "Ha ocurrido un error";
	header("Location:Postulantes.php?id_viaje=$viaje[id]&origen=$viaje[origen]&destino=$viaje[destino]");
	

	die();
	mysqli_close($link);



?>