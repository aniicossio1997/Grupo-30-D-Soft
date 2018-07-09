<?php 

function puntuacion_piloto($link,$id){

	$consulta1 ="SELECT * FROM calificacion WHERE usuario_id=$id AND soy_piloto=1";
	$resultado1= mysqli_query($link,$consulta1);

	
	$consulta2="SELECT COUNT(id) AS numero calificacion WHERE usuario_id=$id AND soy_piloto=1";
	$resultado2=mysqli_query($link,$consulta2);
	//$cantidad_usuers=mysqli_fetch_array($resultado2);

	$total=0;
	$cantidad=0;
	
	

	while ($fila = mysqli_fetch_array($resultado1)) {
		$total=$total+ $fila[ 'puntaje'];
		$cantidad++;

	}
	$consulta3="SELECT * FROM calificacion WHERE usuario_id=$id";
	$resultado3=mysqli_query($link,$consulta3);
	if (mysqli_num_rows($resultado3)<1 ){

		return "es 0; la cantiad de calificaciones es 0";

	}else{

		if ($total<1) {
			return "es: 0"."cantidad de calificaciones: ".$cantidad_usuers['numero'];
		}
		if ($total > 10) {
			return "es: 10"."--cantidad de calificaciones: ".$cantidad_usuers['numero'];
		}
		return ("es: ".$total." --cantidad de calificaciones: ".$cantidad_usuers['numero']);

	}



}

function puntuacion_copiloto($link,$id){

	$consulta1 ="SELECT * FROM calificacion WHERE usuario_id=$id AND soy_piloto=0";
	$resultado1= mysqli_query($link,$consulta1);

	
	$consulta2="SELECT COUNT(id) AS numero calificacion WHERE usuario_id=$id AND soy_piloto=0";
	$resultado2=mysqli_query($link,$consulta2);
	//$cantidad_usuers=mysqli_fetch_array($resultado2);

	$total=0;
	$cantidad=0;
	
	

	while ($fila = mysqli_fetch_array($resultado1)) {
		$total=$total+ $fila[ 'puntaje'];
		$cantidad++;

	}
	$consulta3="SELECT * FROM calificacion WHERE usuario_id=$id";
	$resultado3=mysqli_query($link,$consulta3);
	if (mysqli_num_rows($resultado3)<1 ){

		return "es 0; la cantiad de calificaciones es 0";

	}else{

		if ($total<1) {
			return "es: 0"."cantidad de calificaciones: ".$cantidad_usuers['numero'];
		}
		if ($total > 10) {
			return "es: 10"."--cantidad de calificaciones: ".$cantidad_usuers['numero'];
		}
		return ("es: ".$total." --cantidad de calificaciones: ".$cantidad_usuers['numero']);

	}



}


?>