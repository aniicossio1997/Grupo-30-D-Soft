<?php
date_default_timezone_set('America/Argentina/Buenos_Aires');
include('conexion.php');
$link=conectar();
session_start();
include('clases.php');
$verificar = new validar($link);//se crea  una clase
$id=$verificar->id();
$id_user=$id;
include('funciones_viaje.php');
//----------------------------------------------------------------------

 if (isset($_POST['tipo']) && !empty($_POST['tipo']) && $_POST['tipo']==0  && isset($_POST['origen']) && !empty($_POST['origen']) && isset($_POST['destino']) && !empty($_POST['destino']) && isset($_POST['costo']) && !empty($_POST['costo']) && isset($_POST['vehiculo']) && !empty($_POST['vehiculo']) && isset($_POST['horario']) && !empty($_POST['horario']) )
 {
 	

	


 	if (empty($_POST['duracion'])  && (empty($_POST['minutos']) || $_POST['minutos']==90)) {
 		//si estan vacios
 	$_SESSION['mensaje_error']= "Debe elejir una duracion o minutos,  o una segun corresponda";

 	header("Location:agregar_viaje.php");
 	die("error duracion y minutos");
 	}

 	if (!empty($_POST['duracion']) && (empty($_POST['minutos']) || $_POST['minutos']==90)) {
 		//die("la duracion no esta vacia pero los minutos si");
 		$_POST['minutos']=00;
 		//echo $_POST['minutos'];
 	}else{


 	if (empty($_POST['duracion']) && (!empty($_POST['minutos']) && $_POST['minutos']!=90)) {

 		$_POST['duracion']=00;
 		//echo $_POST['duracion'];
 		//die("la duracion esta vacia");

 	}}
 	


	$horario=$_POST['horario'].":00";//para el formato de el horario
	$can_asien="SELECT asientos FROM vehiculo WHERE id=$_POST[vehiculo]";
	$resul=mysqli_query($link,$can_asien);
	$mostrar = mysqli_fetch_array($resul);
	//------VErificar que no exeda la cantidad de acompañantes elegidos

	//-----------------------
	$copilotos=$mostrar['asientos'];
	$sql="INSERT INTO viajes (id, vehiculo_id, tipo, costo, copilotos, horario, activo,origen,destino,duracion,minutos,  descripcion, fecha)VALUES (NULL, $_POST[vehiculo],'$_POST[tipo]',$_POST[costo],$copilotos,'$horario',1,'$_POST[origen]','$_POST[destino]',$_POST[duracion],'$_POST[minutos]' ";


	if (!empty($_POST['descripcion'])) {
				$sql.=",'$_POST[descripcion]' ";

	}else{ $sql.=", NULL ";}
	

	if ($_POST['tipo']=='ocasional') {
		tipo_ocasional($link,$sql,$horario,$_POST['vehiculo'],$_POST['fecha'], $_POST['duracion'], $_POST['minutos']);
				
	}

	if ($_POST['tipo']=='diario') {
		tipo_diario($link,$sql,$horario,$_POST['duracion'],$_POST['minutos'],$_POST['vehiculo']);
	}

	if ($_POST['tipo']=='semanal') {

		if (empty($_POST['semanal'])) {
			$_SESSION['mensaje_error']="debe elegir un dia de la semana";
			header("Location:agregar_viaje.php");
			die("ERROR: semanal");
		}
		tipo_semanal($link,$sql,$_POST['semanal'],$horario,$_POST['duracion'],$_POST['minutos'],$_POST['vehiculo']);
	
	}

	//-------------------------------------------------------

	} 

	$_SESSION['mensaje_error']= "Campos incompletos";
 	header("Location:agregar_viaje.php");




mysqli_close($link);

?>