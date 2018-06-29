<?php
date_default_timezone_set('America/Argentina/Buenos_Aires');
include('conexion.php');
$link=conectar();
session_start();
include('clases.php');
$verificar = new validar($link);//se crea  una clase

$id= $verificar->id();

//consulta para obtener la fecha y horario del viaje al que se quiere postular
$consulta_f= "SELECT fecha, horario FROM viajes where id = $_GET[id_viaje]";
$resultado_f = mysqli_query($link,$consulta_f);
$fila_f = mysqli_fetch_array($resultado_f);
//si el viaje expiro
if($fila_f['fecha'] < date("Y-m-d") OR ($fila_f['fecha'] == date("Y-m-d") && $fila_f['horario'] <= date("H:i:s"))){
	$_SESSION['mensaje'] = "Lo siento, el viaje ya expiro";
    header("Location: inicio.php");
    die();
}

	$fecha_actual = date('Y-m-d');
	
	//resto 30 días de la fecha actual
	$fecha_actual=date("Y-m-d",strtotime($fecha_actual."- 30 days"));
	$chequeo_viajes="SELECT p.postulante_id, p.viaje_id, vi.id, vi.fecha, p.estado, p.rechazado FROM postulantes p INNER JOIN viajes vi ON (p.viaje_id=vi.id) INNER JOIN vehiculo ve ON (vi.vehiculo_id=ve.id) WHERE ve.usuario_id=$id AND  vi.fecha <= '$fecha_actual' AND p.estado=1 AND p.rechazado=2";	


	//realizo la consulta
	$resul=mysqli_query($link,$chequeo_viajes);
	//echo mysqli_num_rows($resul);
	if (mysqli_num_rows($resul)>0) {
		$_SESSION['mensaje']="Usted adeuda calificaciones, de hace mas de de 30 dias";
		header("Location: inicio.php");
		die();
	}
// se verifica si el usuario adeuda calificacines. 
$consulta_fecha = "SELECT viaje_id FROM postulantes where (postulante_id = $id) AND (rechazado = 2)";
$resultado_fecha = mysqli_query($link,$consulta_fecha);
while ($fila_fecha = mysqli_fetch_array($resultado_fecha)) {
	$consulta_viaje = "SELECT fecha FROM viajes where  (id = $fila_fecha[viaje_id]) and (fecha < CURDATE())";
	$resultado_viaje = mysqli_query($link,$consulta_viaje);
	$fila_viaje = mysqli_fetch_array($resultado_viaje);
	$fecha1 = new dateTime($fila_viaje['fecha']);
	$fecha2 = new dateTime(date("Y-m-d"));
	$diferencia = $fecha1->diff($fecha2);
	if ( $diferencia->days > 30){
			$_SESSION['mensaje'] = "Usted adeuda calificaciones, de hace mas de 30 dias";
			header("Location: inicio.php");
			die();
	}
}
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
