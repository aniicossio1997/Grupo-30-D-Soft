<?php
include ('header.php');
$link=conectar();
$verificar = new validar($link);
$id = $verificar-> id();
$consulta0 = "SELECT fecha,horario FROM viajes WHERE id = $_GET[id_viaje]";
$resultado0 = mysqli_query($link,$consulta0);
$fila0 = mysqli_fetch_array($resultado0);
if (($fila0['fecha'] > date("Y,m,d")) || ((($fila0['fecha'] == date("Y,m,d")) && ($fila0['horario'] > date("H:i:s"))))) {
			//la siguiente consulta es para saber si el viaje ya fue dado de baja
			$consulta1 = "SELECT baja FROM viajes WHERE id = $_GET[id_viaje]";
			$resultado1 = mysqli_query($link,$consulta1);
			$fila = mysqli_fetch_array($resultado1);

			//la siguiente consulta es para saber si la publicacion tiene postulantes
			$consulta2 = "SELECT * FROM postulantes WHERE (viaje_id = $_GET[id_viaje]) AND (estado = 1)";
			$resultado2 = mysqli_query($link, $consulta2 );
			$cantidad = mysqli_num_rows($resultado2);
			if (isset($_GET['respuesta'])) {
				echo "resouesta: " . $_GET['respuesta'];
			}else
			{
				echo "no existe respuesta";
			}

			if (($fila['baja'] == 0) && ($cantidad == 0))
			{
				$consulta3 = "UPDATE viajes SET baja = 1 WHERE id = $_GET[id_viaje]";
				$resultado3 = mysqli_query($link,$consulta3);
				$_SESSION['mensaje'] = "Viaje elimando exitosamente";
				header("Location:inicio.php");
			}elseif (($fila['baja'] == 0) && ((isset($_GET['respuesta'])) && ($_GET['respuesta']== 1)))
					{ 
					  $consulta4 = "UPDATE viajes SET baja = 1 WHERE id = $_GET[id_viaje]";
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
		}else{
				$_SESSION['expiro'] = "el viaje ya expiro";
				echo "expiro";
				//header("Location:inicio.php");
				//die();
			 }
?>