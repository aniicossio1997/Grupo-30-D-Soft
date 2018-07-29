<?php 
function sancionar_copiloto($link,$id,$viaje_id)
{
	$consulta2="SELECT * FROM postulantes  WHERE postulante_id=$id AND  rechazado = 2 and viaje_id=$viaje_id";
	$resultado= mysqli_query($link,$consulta2);
  //echo $consulta2;
  if (mysqli_num_rows($resultado) >0) {
$fecha_act=date('Y-m-d');
 $hora_act=date('H:i:s');
  		$consulta1="INSERT INTO calificacion(id, usuario_id, viaje_id,es_piloto,cumple,puntaje,es_sancion,fecha,hora) VALUES (NULL,$id,$viaje_id,0,1,-1,1,'$fecha_act','$hora_act')";

	$resultado1= mysqli_query($link,$consulta1);
  }



}
function sancionar_piloto($link,$id,$viaje_id)
{
	     $fecha_act=date('Y-m-d');
 $hora_act=date('H:i:s');
  		$consulta1="INSERT INTO calificacion(id, usuario_id, viaje_id,es_piloto,cumple,puntaje,es_sancion,fecha,hora) VALUES (NULL,$id,$viaje_id,1,1,-1,1,'$fecha_act','$hora_act')";
  		echo "entre";
  		$resultado1= mysqli_query($link,$consulta1);


}

 ?>