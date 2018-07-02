<?php
include ('header.php');
$link=conectar();
$verificar = new validar($link);
$id = $verificar-> id();

//consulta para obtener la fecha del viaje al que se quiere postular
$consulta0 = "SELECT fecha,horario FROM viajes WHERE id = $_GET[id_viaje]";
$resultado0 = mysqli_query($link,$consulta0);
$fila0 = mysqli_fetch_array($resultado0);
if(($fila0['fecha'] < date("Y-m-d")) || (($fila0['fecha'] = date("Y-m-d")) && ($fila0['horario'] <= date("H:i:s")))) {
	$_SESSION['mensaje'] = "Lo siento, el viaje ya expiro";
    header("Location: inicio.php");
    die();
}
			//la siguiente consulta es para saber si el viaje ya fue dado de baja
			$consulta1 = "SELECT activo FROM viajes WHERE id = $_GET[id_viaje]";
			$resultado1 = mysqli_query($link,$consulta1);
			$fila = mysqli_fetch_array($resultado1);

			$consulta5 = "SELECT * FROM postulantes WHERE (viaje_id = $_GET[id_viaje]) AND (estado = 1) AND (rechazado = 2)";
			$resultado5 = mysqli_query($link,$consulta5);
			$cantidad5 = mysqli_num_rows($resultado5);
			if (($fila['activo'] == 1) && ($cantidad5 > 0)) {
				if (!isset($_GET['respuesta'])) {
					$_SESSION['confirmacion'] = "Usted sera sancionado ¿Esta seguro de proceder con la eliminacion?";
					header("Location: inicio.php?viaje_id=$_GET[id_viaje]");
					die();
				}else{
						$consulta3 = "UPDATE viajes SET activo = 2 WHERE id = $_GET[id_viaje]";
						$resultado3 = mysqli_query($link,$consulta3);
						$_SESSION['mensaje'] = "Viaje elimando exitosamente";
						header("Location:inicio.php");
					  }
			}

			//la siguiente consulta es para saber si la publicacion tiene postulantes
			$consulta2 = "SELECT * FROM postulantes WHERE (viaje_id = $_GET[id_viaje]) AND (estado = 1) AND (rechazado = 0 OR rechazado = 2)";
			$resultado2 = mysqli_query($link, $consulta2 );
			$cantidad = mysqli_num_rows($resultado2);
			if (($fila['activo'] == 1) && ($cantidad == 0))
			{
				if (!isset($_GET['respuesta'])) {
					$_SESSION['confirmacion'] = "¿Esta seguro que desea elimnar la publicación?";
					header("Location: inicio.php?viaje_id=$_GET[id_viaje]");
					die();
				}else{
						$consulta3 = "UPDATE viajes SET activo = 2 WHERE id = $_GET[id_viaje]";
						$resultado3 = mysqli_query($link,$consulta3);
						$_SESSION['mensaje'] = "Viaje elimando exitosamente";
						header("Location:inicio.php");
					  }
			}elseif (($fila['activo'] == 1) && ((isset($_GET['respuesta'])) && ($_GET['respuesta']== 1)))
					{ 
					  $consulta4 = "UPDATE viajes SET activo = 2 WHERE id = $_GET[id_viaje]";
					  $resultado4 = mysqli_query($link,$consulta4);
					  $_SESSION['mensaje'] = "Viaje elimando exitosamente";
				      header("Location:inicio.php");
				      die();

					}elseif (!isset($_GET['respuesta'])) 
					{
						$_SESSION['confirmacion'] = "El viaje posee postulantes ¿esta seguro de eliminarlo?";
						header("Location:inicio.php?viaje_id= $_GET[id_viaje]");
						die(); 

					}
?>