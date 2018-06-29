<?php

date_default_timezone_set('America/Argentina/Buenos_Aires');
include('conexion.php');
$link=conectar();
session_start();
include('clases.php');
$verificar = new validar($link);//se crea  una clase

$id= $verificar->id();

$consulta1 = "SELECT * FROM postulantes WHERE postulante_id=$id";
$resultado1 = mysqli_query($link,$consulta1);
$existe = false;
	while ($fila = mysqli_fetch_array($resultado1)) {
		if ($fila['postulante_id'] == $_GET['id'] && $fila['viaje_id'] == $_GET['id_viaje']) {

			$existe = true;
		}
	}
	if ($existe == false){
		$consulta ="INSERT INTO postulantes(id, viaje_id, postulante_id, estado,rechazado,visto) VALUES (null, $_GET[id_viaje], $_GET[id], 1, 0,0) ";
		$resultado = mysqli_query($link,$consulta);
		$_SESSION['mensaje']=" Postulacion exitosa!!";
		header("Location:index.php");
		die();
    }else{
    		$consulta1 = " UPDATE postulantes SET estado = 1 where viaje_id = $_GET[id_viaje]";
    		$resultado1 = mysqli_query($link,$consulta1);
            $_SESSION['mensaje']=" Postulacion exitosa";
    		header("Location:inicio.php");
    		die();
    }

?>
