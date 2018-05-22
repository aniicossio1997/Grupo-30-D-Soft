<?php 
include('conexion.php');
$link=conectar();
session_start();
include('clases.php');
$verificar = new validar($link);

$id_user = $verificar->id();



	if (isset($_GET['vehiculo']) && !empty($_GET['vehiculo'])) {
		$vehiculo=$_GET['vehiculo'];
		
		$sql1="SELECT COUNT(id) AS numero FROM viajes WHERE vehiculo_id=$vehiculo"; //si el vehiculo no esta asociado a un viaje
		

		$consulta="SELECT activo FROM viajes WHERE vehiculo_id=$vehiculo"; //si el vehiculo esta asociado a un viaje vigente 

		$r1 =mysqli_query($link,$sql1);
		$r2 =mysqli_query($link,$consulta);
		$fila = mysqli_fetch_array($r1);
		$fila2 =  mysqli_fetch_array($r2);
		$eliminar = "UPDATE vehiculo SET activo = '0' WHERE id = $vehiculo and usuario_id = $id_user";
		if ($fila['numero'] == 0 ) {
			//si el vehiculo no tiene asociado ningun viaje
			$r3 = mysqli_query($link, $eliminar);
			if ($r3 ) {
				
				$_SESSION['msj_baja_v'] ="Se ha eliminado el vehiculo exitosamente";
				header("Location:mis_vehiculos.php");
				die("salir");
			}else{
				
				$_SESSION['msj_baja_v'] ="Ha ocurrido un error en la eliminacion del vehiculo";
				header("Location:mis_vehiculos.php");
				die("salir");

			}
			//echo "Eliminar";echo "<br>";die("salir");
		}
		if ($r2) {
			if ($fila2['activo']==0) { //si el viaje esta Cerrado 
				$r3 = mysqli_query($link, $eliminar);
				if ($r3 ) {
					
					$_SESSION['msj_baja_v'] ="Se ha eliminado exitosamente el vehiculo ";
					header("Location:mis_vehiculos.php");
					die("salir");
				}else{
					
					$_SESSION['msj_baja_v'] ="Ha ocurrido un error en la eliminacion del vehiculo";
					header("Location:mis_vehiculos.php");
					die("salir");
				}
			}else{
				echo "funciona5 <br>";
				$_SESSION['msj_baja_v']="ERROR:usted no puede eliminar un vehiculo que tenga un viaje que no este cerrado";
				header("Location:mis_vehiculos.php");
				die("salir");
			}
			

		}
	

	}


mysqli_close($link);
?>