<?php
date_default_timezone_set('America/Argentina/Buenos_Aires');
include('conexion.php');
$link=conectar();
session_start();
include('clases.php');
$verificar = new validar($link);//se crea  una clase
$id=$verificar->id();
$id_user=$id;
//----------------------------------------------------------------------
$consulta="SELECT id, viaje_id, postulante_id, estado, rechazado, visto FROM postulantes WHERE viaje_id=$_POST[id_viaje] AND estado=1 AND (rechazado=0 OR rechazado=2)";
$resul= mysqli_query($link,$consulta);	
$filas=mysqli_num_rows($resul);
if ($filas>0) {
	$_SESSION['mensaje_error']= "ERROR: No es posible hacer modificaciones cuando la publicación tiene al menos un postulante";
	header("Location:".$_SERVER["HTTP_REFERER"]);
			die();
}

 if (isset($_POST['origen']) && !empty($_POST['origen']) && isset($_POST['destino']) && !empty($_POST['destino']) && isset($_POST['costo']) && !empty($_POST['costo']) && isset($_POST['vehiculo']) && !empty($_POST['vehiculo']) && isset($_POST['horario']) && !empty($_POST['horario']) )
 {
 	



 	if (empty($_POST['duracion'])  && (empty($_POST['minutos']) || $_POST['minutos']==90)) {
 		//si estan vacios
 	$_SESSION['mensaje_error']= "Debe elejir una duracion o minutos,  o una segun corresponda";

 	header("Location:".$_SERVER["HTTP_REFERER"]);
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


	$consulta="UPDATE viajes SET vehiculo_id=$_POST[vehiculo],costo=$_POST[costo],copilotos=$copilotos,fecha='$_POST[fecha]',horario='$horario',descripcion='$_POST[descripcion]',origen='$_POST[origen]',destino='$_POST[destino]',duracion=$_POST[duracion],minutos='$_POST[minutos]' WHERE id =$_POST[id_viaje]";
	$resul=mysqli_query($link,$consulta);
	if ($resul) {
		
		$_SESSION['mensaje']="Se ha modificado el viaje con exito";
		if ($_POST['id_pag']=='mis_viajes') {
			header("Location:mostrar_viaje_piloto.php");
			die();
		}else{
			header("Location:inicio.php");
			die();
		}

	}else{
		header("Location:".$_SERVER["HTTP_REFERER"]);
			die();
	}
			


}else{
		$_SESSION['mensaje_error']="Campos incompletos";
	header("Location:".$_SERVER["HTTP_REFERER"]);
			die();

	}
	
mysqli_close($link);

?>