<?php
  
 include('header.php');
 $link=conectar();
$verificar = new validar($link);
$id=$verificar->id();

 //me quedo con el id del vehículo asociado al viaje
 if (isset($_GET['id_viaje']))
  {
 	$consulta0 = "SELECT vehiculo_id FROM viajes WHERE id = $_GET[id_viaje]";
 	$resultado0 =mysqli_query($link,$consulta0);
 	$fila0 = mysqli_fetch_array($resultado0);
 	//con el id del vehículo asociado al viaje obtengo el id del publicador
	 $consulta1 ="SELECT usuario_id FROM vehiculo where id = $fila0[vehiculo_id] ";
	 $resultado1 = mysqli_query($link,$consulta1);
	 $fila1 = mysqli_fetch_array($resultado1);
  }
$fecha = DATE("Y-m-d");
$hora = DATE("H:i:s");

 /*if (isset($_POST['resp'])) {
 	echo "existe/ ";
 	echo(" resp: ".$_POST['resp']);
 	if (isset($_GET['id_pregunta']) ){
 		echo " /existe id";
 	}else{
 		echo "no existe id";
 	}
 }else{
 	echo "no exite resp";
 }*/
 if (isset($_GET['id_pregunta']))
 {
 echo "id pregunta: " .$_GET['id_pregunta'];
}else{
	echo "no existe id pregunta/ ";
}
if (isset($_GET['eliminar_pregunta'])) {
	echo "existe eliminar pregunta";
}else{
	echo "no existe eliminar_pregunta/ ";
}
/*if (isset($_POST['resp'])) {
	echo "respuesta: ".$_POST['resp'];
	$_SESSION['id_viaje'] = $_GET['id_viaje'];
	header("Location: detalle_viaje.php");
}else{
	echo "no existe respuesta/ ";
}*/

 if (isset($_POST['resp']) && !empty($_POST['resp'])) {

 	if (isset($_GET['id_pregunta'])) {
 		$consulta3 = "UPDATE preguntas SET respuesta = '$_POST[resp]', fecha_respuesta = '$fecha', hora_respuesta = '$hora' WHERE id = $_GET[id_pregunta]";
 		$resultado3 = mysqli_query($link,$consulta3);
 		$_SESSION['id_viaje'] = $_GET['id_viaje'];
 		unset($_POST['resp']);
 		unset($_GET['id_pregunta']);
 		header("Location: detalle_viaje.php");
 		die();
 	}
 }
 if (isset($_POST['preg']) && !empty($_POST['preg'])) {
 	echo "entre despues de pase1";
 	if (isset($_GET['id_usuario'])) 
 	{

 	   $consulta2 = "INSERT INTO preguntas (id,preguntador_id,usuario_id,pregunta,viaje_id,fecha_pregunta,respuesta,fecha_respuesta,hora_pregunta,hora_respuesta) VALUES (null,'$_GET[id_usuario]','$fila1[usuario_id]','$_POST[preg]','$_GET[id_viaje]','$fecha',null,null,'$hora',null)";
 	   $resultado2 = mysqli_query($link,$consulta2);
 	   $_SESSION['id_viaje'] = $_GET['id_viaje'];
 	   header("Location: detalle_viaje.php");
 	   die();
 	}
 }
 if (isset($_GET['id_pregunta']) && isset($_GET['eliminar_pregunta'])) {
 	$consulta5 = "DELETE FROM preguntas WHERE id = $_GET[id_pregunta]";
 	$resultado5 = mysqli_query($link,$consulta5);
 	$_SESSION['id_viaje'] = $_GET['id_viaje'];
 	header("Location: detalle_viaje.php");
    die();
 }
 if (isset($_GET['id_pregunta'])) {
    $consulta4 = "UPDATE preguntas SET respuesta = null, fecha_respuesta = null, hora_respuesta = null WHERE id = $_GET[id_pregunta]";
 	$resultado4 = mysqli_query($link,$consulta4);
 	$_SESSION['id_viaje'] = $_GET['id_viaje'];
 	header("Location: detalle_viaje.php");
    die();
 }


