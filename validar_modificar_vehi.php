<?php
	include('conexion.php');
	$link=conectar();
	session_start();
	include('clases.php');
	$verificar = new validar($link);
	$id_user = $verificar->id();

function modificar_vehiculo($link,$consulta,$id_vehi)
	{

		$resul=mysqli_query($link,$consulta);//se guardan las modificaciones
			if ($resul) {
				$_SESSION['msj']=true;
				header("Location:mis_vehiculos.php");
				die("salir");

			}else{
			$_SESSION['msj']="ERROR EN LA MODIFICACIÓN: Recuerde que las comillas simples pueden interferir en el guardado de los datos ";
			header("Location:modificar_vehiculo.php?id_vehiculo=$id_vehi; ");
				die("salir");
			}
	}



	if (isset($_POST['marca']) && !empty($_POST['marca']) && isset($_POST['patente']) && !empty($_POST['patente']) && isset($_POST['modelo']) && !empty($_POST['modelo']) && isset($_POST['asientos']) && !empty($_POST['asientos']) && isset($_POST['id_vehiculo']) && !empty($_POST['id_vehiculo'])){

		$consulta="SELECT activo FROM viajes WHERE vehiculo_id=$_POST[id_vehiculo]";
		$r1=mysqli_query($link,$consulta);

		//el vehiculo tiene viaje

		$fila2=mysqli_num_rows($r1);//el vihiculo tiene viajes asociaos activos
		$consulta="UPDATE vehiculo SET marca = '$_POST[marca]', patente = '$_POST[patente]', modelo = '$_POST[modelo]',asientos = $_POST[asientos] WHERE id =$_POST[id_vehiculo] and usuario_id=$id_user";
		if ($fila2==0) {
			modificar_vehiculo($link,$consulta,$_POST['id_vehiculo']);
		
		}else{
				$ok=0;
				while ($fila = mysqli_fetch_array($r1)){
					if ($fila['activo']==1) {
						$ok=1;
						break;
					}
				}
				if ($ok == 0) {
					modificar_vehiculo($link,$consulta,$_POST['id_vehiculo']);
		
				}else{
					 $_SESSION['msj']= "no se puede modificar un vehiculo que tengan viajes  que no esten cerrados";
					header("Location:modificar_vehiculo.php?id_vehiculo=$_POST[id_vehiculo]; ");
					die("salir"); }

			}


		
	}else{
		$_SESSION['msj']= "campos incompletos, no puede existir campos vacios";
		header("Location:modificar_vehiculo.php?id_vehiculo=$_POST[id_vehiculo]; ");
		die("salir");
	}

mysqli_close($link);

?>