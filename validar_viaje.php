<?php
date_default_timezone_set('America/Argentina/Buenos_Aires');
include('conexion.php');
$link=conectar();
session_start();
include('clases.php');
$verificar = new validar($link);//se crea  una clase
$id=$verificar->id();
include('funciones_viaje.php');
//----------------------------------------------------------------------

 if (isset($_POST['tipo']) && !empty($_POST['tipo']) && $_POST['tipo']==0  && isset($_POST['origen']) && !empty($_POST['origen']) && isset($_POST['destino']) && !empty($_POST['destino']) && isset($_POST['costo']) && !empty($_POST['costo']) && isset($_POST['duracion']) && !empty($_POST['duracion']) && isset($_POST['vehiculo']) && !empty($_POST['vehiculo']) && isset($_POST['horario']) && !empty($_POST['horario']) )
 {



	$horario=$_POST['horario'].":00";//para el formato de el horario
	$can_asien="SELECT asientos FROM vehiculo WHERE id=$_POST[vehiculo]";
	$resul=mysqli_query($link,$can_asien);
	$mostrar = mysqli_fetch_array($resul);
	//------VErificar que no exeda la cantidad de acompañantes elegidos

	//-----------------------
	$copilotos=$mostrar['asientos'];
	$sql="INSERT INTO viajes (id, vehiculo_id, tipo, costo, copilotos, horario, activo,  descripcion,  origen, destino, duracion, baja, fecha)VALUES (NULL, $_POST[vehiculo],'$_POST[tipo]',$_POST[costo],$copilotos,'$horario',1 ";

	if (!empty($_POST['descripcion'])) {
				$sql.=",'$_POST[descripcion]'";

	}else{ $sql.=", NULL";}
	
	$sql.=", '$_POST[origen]'";
	$sql.=", '$_POST[destino]'";
	$sql.=", '$_POST[duracion]'";
	$sql.=", '0'";


	if ($_POST['tipo']=='ocasional') {
		tipo_ocasional($link,$sql,$horario,$_POST['vehiculo'],$_POST['fecha']);
				
	}

	if ($_POST['tipo']=='diario') {
		tipo_diario($link,$sql,$horario,$_POST['vehiculo']);
	}

	if ($_POST['tipo']=='semanal') {

		if (empty($_POST['semanal'])) {
			$_SESSION['mensaje']="debe elegir un dia de la semana";
			header("Location:agregar_viaje.php");
			die("ERROR: semanal");
		}
		tipo_semanal($link,$sql,$_POST['semanal'],$horario,$_POST['vehiculo']);
	
	}

	//-------------------------------------------------------

	} 

	$_SESSION['mensaje']= "Campos incompletos";
 	header("Location:agregar_viaje.php");




mysqli_close($link);

?>