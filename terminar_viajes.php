<?php 
function termiar_viajes($link)
{
	$consulta= ("SELECT id  FROM viajes WHERE ((fecha < CURDATE() AND activo = 1 ) or (fecha = CURDATE() AND horario < CURTIME() AND activo = 1 )) ");
	$resul=mysqli_query($link,$consulta);
	$cant=0;

	while ($mostrar=mysqli_fetch_array($resul)) {
		//echo $mostrar['id']."<br>";
		$consulta_sub="SELECT p.postulante_id,p.estado,p.rechazado,ve.usuario_id as calificador FROM  postulantes p INNER JOIN viajes v on (p.viaje_id=v.id) INNER JOIN vehiculo ve on (ve.id=v.vehiculo_id) WHERE p.viaje_id=$mostrar[id] AND p.estado=1 AND p.rechazado=2";
		//me quedo con los postulantes de ese viaje en particular
		$resul_sub=mysqli_query($link,$consulta_sub);
		while ($mostrar_sub=mysqli_fetch_array($resul_sub)) {
			//Crea las calificaciones para los copilotos ";
			$consulta_2="INSERT INTO calificacion(id, viaje_id, usuario_id, es_piloto, calificador_id,cumple) VALUES (NULL,$mostrar[id],$mostrar_sub[postulante_id],0,$mostrar_sub[calificador],0)";
			/*echo "<br>".$consulta_2;
			echo "<br><br>";
			
			//Crean las calificaciones para los pilotos;
			*/
			$resul_2=mysqli_query($link,$consulta_2);
			//---------------------------------
			$consulta_3="INSERT INTO calificacion(id, viaje_id, usuario_id, es_piloto, calificador_id,cumple) VALUES (NULL,$mostrar[id],$mostrar_sub[calificador],1,$mostrar_sub[postulante_id],0)";
			/*echo "<br>".$consulta_3;
			echo "-----------"."<br>";
			*/
			$resul_3=mysqli_query($link,$consulta_3);

			if ($resul_3!=true || $resul_2!=true) {
				$cant=$cant+1;
			}
		}
		if (mysqli_num_rows($resul_sub)>0) {
		$consulta_4="UPDATE viajes SET activo = '3' WHERE viajes.id = $mostrar[id]";
		$resul_4=mysqli_query($link,$consulta_4);
		}
		
	}
	if ($cant>0) {
	echo "<br> algo salio mal para crear las calificaciones";
	}
}


 ?>