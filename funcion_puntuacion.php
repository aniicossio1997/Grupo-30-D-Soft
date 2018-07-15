<?php 

function puntuacion_piloto($link,$id){

	$consulta1 ="SELECT * FROM calificacion WHERE usuario_id=$id AND es_piloto=1 AND cumple=1";
	$resultado1= mysqli_query($link,$consulta1);
	#echo $consulta1;

	$total=0;
	$cantidad=0;
	
	while ($fila = mysqli_fetch_array($resultado1)) {
		$total=$total+ $fila[ 'puntaje'];
		$cantidad++;

	}
	
	if ($cantidad<1 ){

		return "es 0-- La cantidad de calificaciones es 0";

	}else{

	$consulta2="SELECT COUNT(usuario_id) AS numero FROM calificacion WHERE usuario_id=$id AND es_piloto=1 AND cumple=1";
	//echo $consulta2;
	$resultado2=mysqli_query($link,$consulta2);

		$cantidad_usuers=mysqli_fetch_array($resultado2);
		if ($total<1) {
			

			return "es: 0"." --cantidad de calificaciones: ".$cantidad_usuers['numero'];

		}
		if ($total > 10) {
		
			return "es: 10"." --cantidad de calificaciones: ".$cantidad_usuers['numero'];
		}
	
		return ("es: ".$total." --cantidad de calificaciones: ".$cantidad_usuers['numero']);

	}



}

function puntuacion_copiloto($link,$id){

	$consulta1 ="SELECT * FROM calificacion WHERE usuario_id=$id AND es_piloto=0 AND cumple=1";
	$resultado1= mysqli_query($link,$consulta1);

	//

	$total=0;
	$cantidad=0;

	while ($fila = mysqli_fetch_array($resultado1)) {
		$total=$total+ $fila[ 'puntaje'];
		$cantidad=$cantidad +1;

	}
	//echo $cantidad;
	if ($cantidad==0 ){

		return "es 0 -- La cantidad de calificaciones es 0";

	}else{
	$consulta2="SELECT COUNT(usuario_id) AS numero FROM calificacion WHERE usuario_id=$id AND es_piloto=1 AND cumple=1 AND es_sancion=0";

	$resultado2=mysqli_query($link,$consulta2);
	
		$cantidad_usuers=mysqli_fetch_array($resultado2);

		if ($total<1) {
			
			return "es: 0 "." -- cantidad de calificaciones: ".$cantidad_usuers['numero'];
		}
		if ($total > 10) {
			
			return "es: 10 "."--cantidad de calificaciones: ".$cantidad_usuers['numero'];
		}
		
		return ("es: ".$total." --cantidad de calificaciones: ".$cantidad_usuers['numero']);

	}



}


?>