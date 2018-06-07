<?php
	include('header.php');
	$consulta1 = "SELECT * FROM postulantes WHERE postulante_id=$_GET[id]";
	$resultado1 = mysqli_query($link,$consulta1);
	$existe = false;
	while ($fila = mysqli_fetch_array($resultado1)) {
		if ($fila['postulante_id'] == $_GET['id'] && $fila['viaje_id'] == $_GET['id_viaje']) {
			$existe = true;
		}
	}
	if ($existe == false){
		$consulta ="INSERT INTO postulantes(id, viaje_id, postulante_id) VALUES (null, $_GET[id_viaje], $_GET[id]) ";
		$resultado = mysqli_query($link,$consulta);
		echo ("registro exitoso");
    }else{
    	echo ("ya esta registrado");
    }

?>
