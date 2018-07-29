<?php 

function puntuacion_piloto($link,$id){

	$consulta1 ="SELECT * FROM calificacion WHERE usuario_id=$id AND es_piloto=1 AND cumple=1";
	$resultado1= mysqli_query($link,$consulta1);
	#echo $consulta1;
	#var_dump($resultado1);

	$total=0;
	$cantidad=0;
	
	while ($fila = mysqli_fetch_array($resultado1)) {
		$total=$total+ $fila[ 'puntaje'];
		$cantidad=$cantidad+1;

	}
	
	if ($cantidad<1 ){

		return "puntaje total como piloto: 0 - Cantidad de calificaciones:  0";

	}else{

	//$consulta2="SELECT COUNT(usuario_id) AS numero FROM calificacion WHERE usuario_id=$id AND es_piloto=1 AND cumple=1 ";
	//echo $consulta2;
	//$resultado2=mysqli_query($link,$consulta2);

		//$cantidad_usuers=mysqli_fetch_array($resultado2);
		if ($total<1) {
			

			return "puntaje total como piloto: 0 - Cantidad de calificaciones: ".mysqli_num_rows($resultado1);

		}
	
		return ("puntaje total como piloto: ".$total." - Cantidad de calificaciones: ".mysqli_num_rows($resultado1));

	}



}

function puntuacion_copiloto($link,$id){

	$consulta1 ="SELECT * FROM calificacion WHERE usuario_id=$id AND es_piloto=0 AND cumple=1";
	//echo $consulta1;
	$resultado1= mysqli_query($link,$consulta1);
	$total=0;
	$cantidad=0;

	while ($fila = mysqli_fetch_array($resultado1)) {
		$total=$total+ $fila[ 'puntaje'];
		$cantidad=$cantidad +1;

	}
	//echo $cantidad;
	if ($cantidad==0 ){

		return "puntaje total como copiloto: 0 - cantidad de calificaciones: 0";

	}else{
	$consulta2="SELECT COUNT(usuario_id) AS numero FROM calificacion WHERE usuario_id=$id AND es_piloto=0 AND cumple=1";

	$resultado2=mysqli_query($link,$consulta2);
	
		$cantidad_usuers=mysqli_fetch_array($resultado2);

		if ($total<1) {
			
			return "puntaje total como copiloto : 0  - cantidad de calificaciones: ".$cantidad_usuers['numero'];
		}
		
		return (" puntaje total como copiloto: ".$total." - cantidad de calificaciones: ".$cantidad_usuers['numero']);

	}



}


?>