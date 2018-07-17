<?php 
function sancionar_copiloto($link,$id,$viaje_id)
{
	$consulta2="SELECT * FROM postulantes  WHERE postulante_id=$id AND  rechazado = 2";
	$resultado= mysqli_query($link,$consulta2);

  if (mysqli_num_rows($resultado) >0) {
  		$consulta1="INSERT INTO calificacion(id, usuario_id, viaje_id,es_piloto,cumple,puntaje,es_sancion) VALUES (NULL,$id,$viaje_id,0,1,-1,1)";

	$resultado1= mysqli_query($link,$consulta1);
  }



}

 ?>