<?php 

function ver_puntuacion($id,$link){


	$consulta ="SELECT * FROM calificacion WHERE usuario_id=$id";

	$total=0;
	$cantidad=0;
	$resultado=mysqli_query($link,$consulta);

	while ($fila = mysqli_fetch_array($resultado)) {
		$total=$total+ $fila[ 'puntaje'];
		$cantidad++;

	}
	if ($cantidad ==0) {
		return ("Sin calificacion");
	}else{
		if ($total< 1) {
			return 1;
		}else{ return $total;}
	}


}


?>