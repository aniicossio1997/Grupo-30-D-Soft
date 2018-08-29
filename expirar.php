<?php 
	include('conexion.php');
	$link=conectar();
	session_start();
	include('clases.php');
	$verificar = new validar($link);
	$id= $verificar->id();



	$consulta="SELECT p.postulante_id, p.viaje_id,p.estado,p.rechazado FROM viajes v INNER JOIN postulantes p ON (v.id= p.viaje_id)  WHERE p.viaje_id=$_GET[id_viaje] AND p.estado=1 AND p.rechazado=2";
	
	$resul=mysqli_query($link,$consulta);
	$cant=0;
	while ($fila=mysqli_fetch_array($resul)) {
		
			//Crea las calificaciones para los copilotos ";
			$consulta_2="INSERT INTO calificacion(id, viaje_id, usuario_id, es_piloto, calificador_id,cumple) VALUES (NULL,$_GET[id_viaje],$fila[postulante_id],0,$id,0)";
			/*echo "<br>".$consulta_2;
			echo "<br><br>";
			
			//Crean las calificaciones para los pilotos;
			*/
			$resul_2=mysqli_query($link,$consulta_2);
			$consulta_3="INSERT INTO calificacion(id, viaje_id, usuario_id, es_piloto, calificador_id) VALUES (NULL,$_GET[id_viaje],$id,1,$fila[postulante_id])";
			/*echo "<br>".$consulta_3;
			echo "-----------"."<br>";
			*/
			$resul_3=mysqli_query($link,$consulta_3);

			if ($resul_3!=true || $resul_2!=true) {
				$cant=$cant+1;
			}
	}

	$consulta_4="UPDATE viajes SET activo = '3' WHERE viajes.id = $_GET[id_viaje]";

	$resul_4=mysqli_query($link,$consulta_4);

	if ($cant==0) {
	
	header("Location:".$_SERVER["HTTP_REFERER"]);
	mysqli_close($link);
			die();
	}else{
		$_SESSION['mensaje']= "algo ocurrio";
	header("Location:".$_SERVER["HTTP_REFERER"]);
	mysqli_close($link);
			die();
	}
	


 ?>