<?php 
function elementos($fecha,$horario,$duracion,$minutos,$link,$id)
{
	$consulta="SELECT * FROM viajes WHERE vehiculo_id=$id"; 
	$resul=mysqli_query($link,$consulta);
	$elemen=mysqli_num_rows($resul);

	if ($elemen==0) {
			return 0;
			
	}else{

	$actual=$fecha." ".$horario;
	$fecha_nue_act_inicio=strtotime($actual);
	$fecha_nue_act_fin = strtotime ( "+$duracion hour" , strtotime ( $actual ) ) ;
	$fecha_nue_act_fin = strtotime ( "+$minutos minute" , $fecha_nue_act_fin );
	$count=0;
		while ($mostrar=mysqli_fetch_array($resul)) {

		$sql_fecha_inicio=strtotime($mostrar['fecha']." ".$mostrar['horario']);

		$sql_fecha_fin=strtotime("+$mostrar[duracion] hour",$sql_fecha_inicio  ) ;
				
		$sql_fecha_fin = strtotime ("+$mostrar[minutos] minute" , $sql_fecha_fin );

		 if (($fecha_nue_act_inicio >= $sql_fecha_inicio && $fecha_nue_act_inicio <= $sql_fecha_fin) || ($fecha_nue_act_fin >= $sql_fecha_inicio && $fecha_nue_act_fin <= $sql_fecha_fin)) {
		 		
		 		$count=$count+ 1;
		}

		}
		if ($count >0) {
			return 1;
			die();
		}
		return 0;
		die();
	}
	

}
//-------------------------------------------------------------

function tipo_ocasional($link,$sql,$horario,$id,$fecha,$duracion,$minutos)
{



	if (elementos($fecha,$horario,$duracion,$minutos,$link,$id)==1) {
	    $_SESSION['mensaje_error']="ERROR: El vehiculo en ese periodo de tiempo ya se encuentra  asociado a un viaje, por favor elija otro vehiculo";
	    header("Location:agregar_viaje.php");
	    die("Error 1:vehiculo repetido");

	}

	if ($fecha<=date('Y-m-d')) {
		$_SESSION['mensaje_error']="ERROR: la fecha elegida debe ser mayor a la fecha actual";
		header("Location:agregar_viaje.php"); 
		die("ERROR 2: la fecha debe ser mayor a la fecha actual");
	}

	$sql.=" ,'$fecha')";

	$resul=mysqli_query($link,$sql);
	
	if($resul){
		$_SESSION['mensaje']="El viaje tipo ocacional se ha guardado exitosamente";
		header("Location:agregar_viaje.php"); 
		mysqli_close($link);
		die("fin");
	}else{
			$_SESSION['mensaje_error']="Algo salio mal: error en tipo de viaje ocacional";
			header("Location:agregar_viaje.php");
			//var_dump($resul);
			die("error"); 
			}

}

//-------------------------------------------------------------------
function tipo_diario($link,$sql,$horario,$duracion,$minutos,$id)
{

	
	
	$cant=0;

	$fecha_actual=date('Y-m-d');
	$date = new DateTime($fecha_actual);

	$date->modify("next Monday");//avanzo al siguiente dia

	$fecha=$date->format('Y-m-d');

	$fechaInicio=strtotime($fecha);

	for ($i=0; $i < 5; $i++) { 

		$date->modify("next Monday");
	}
	$fechaFin=strtotime(($date->format('Y-m-d')));
	//echo $fechaFin;
	//die();

	for($i=$fechaInicio; $i<$fechaFin; $i+=86400){
	    //Sacar el dia de la semana con el modificador N de la funcion date
	    $dia = date('N', $i);
	    $sql_1=$sql_2=$sql_3=$sql_4=$sql_5=$sql;

	    $fecha=date('Y-m-d', $i);

	    if($dia==1){
	    	
	    	if (elementos($fecha,$horario,$duracion,$minutos,$link,$id)==1) {
	    		$cant=$cant +1;
	    		$_SESSION['mensaje_error']="ERROR un vehiculo no puede estar asociado aun viaje con la mism  fecha y hora";
	    		header("Location:agregar_viaje.php");
	    		die("Error 1:vehiculo repetido");
	    		

	    	}
	    	
	    	$sql_1.=" ,'$fecha')";
	        $resul=mysqli_query($link,$sql_1);
			if ($resul!=true){
				$_SESSION['mensaje_error']="Algo salio mal,cuando al crear el viaje para el dia lunes";
				header("Location:agregar_viaje.php");
				die("ERROR al guarar el viaje");
				
			}

	    }
	    if($dia==2){

	    	if (elementos($fecha,$horario,$duracion,$minutos,$link,$id)==1) {
	    		$cant=$cant +1;
	    		$_SESSION['mensaje_error']="ERROR: un vehiculo no puede estar asociado aun viaje con la mism  fecha y hora";
	    		header("Location:agregar_viaje.php");
	    		die("Error 1:vehiculo repetido");
	    		
	    	}
	    	$sql_2.=" ,'$fecha')";
	    	$resul=mysqli_query($link,$sql_2);

			if ($resul!=true){ 
				$_SESSION['mensaje_error']="Error al guardar viaje para el martes";
				header("Location:agregar_viaje.php");
				die("Error al guardar viaje de tipo diario");
				}

		}
	    if($dia==3){

	    	if (elementos($fecha,$horario,$duracion,$minutos,$link,$id)==1) {
	    		$cant=$cant +1;
	    		$_SESSION['mensaje_error']="ERROR: un vehiculo no puede estar asociado aun viaje con la mism  fecha y hora dia 3";
	    		header("Location:agregar_viaje.php");
	    		die("Error 1:vehiculo repetido");
	    		
	    	}
	    	$sql_3.=" ,'$fecha')";
	    	
	        $resul=mysqli_query($link,$sql_3);
			if ($resul!=true){

				$_SESSION['mensaje_error']="ERROR al guardar el viaje diario para el dia miercoles";
				header("Location:agregar_viaje.php");
				die("ERROR");
				}
	       

	    }
	    if($dia==4){

	    	if (elementos($fecha,$horario,$duracion,$minutos,$link,$id)==1) {
	    		$cant=$cant +1;
	    		$_SESSION['mensaje_error']="ERROR: un vehiculo no puede estar asociado aun viaje con la mism  fecha y hora";
	    		header("Location:agregar_viaje.php");
	    		die("Error 1:vehiculo repetido");
	    		
	    	}
	   	 	$sql_4.=" ,'$fecha')";
	    	
	        $resul=mysqli_query($link,$sql_4);
			if ($resul!=true){
				$_SESSION['mensaje_error']= "ERROR al guardar el viaje tipo diario, en el dia jueves";
				header("Location:agregar_viaje.php");
				die("error");
				
			}
	    }

	    if($dia==5){

	    	if (elementos($fecha,$horario,$duracion,$minutos,$link,$id)==1) {
	    		$cant=$cant +1;
	    		$_SESSION['mensaje_error']="ERROR: un vehiculo no puede estar asociado aun viaje con la mism  fecha y hora";
	    		header("Location:agregar_viaje.php");
	    		die("Error 1:vehiculo repetido");
	    		
	    	}
	    	$sql_5.=" ,'$fecha')";
	    	
	        $resul=mysqli_query($link,$sql_5);
			if ($resul!=true){
				$_SESSION['mensaje_error']= "ERROR al guardar el viaje tipo diario, en el dia viernes";
				header("Location:agregar_viaje.php");
				die("error");
				
				}
	    }
	    
	}

	$_SESSION['mensaje']="Los viajes de tipo diario se crearon exitosamente";
	header("Location:agregar_viaje.php"); 
	mysqli_close($link);
	die("exito");
}

function tipo_semanal($link,$sql,$elejido,$horario,$duracion,$minutos,$id)
{	
	$sql_1=$sql_2=$sql_3=$sql_4=$sql;

	$fecha_actual=date('Y-m-d');
	$date = new DateTime($fecha_actual);

	$date->modify("next Monday");//avanzo al siguiente dia


	$fecha=$date->format('Y-m-d');
	echo $fecha;
	$indice=1;

	$fechaInicio=strtotime($fecha);

	for ($i=0; $i < 4; $i++) { 

		$date->modify("next Monday");
	}
	$fechaFin=strtotime(($date->format('Y-m-d')));


//----------------


	//-----------------
	for($i=$fechaInicio; $i<=$fechaFin; $i+=86400){
	    //Sacar el dia de la semana con el modificador N de la funcion date
	    $dia = date('N', $i);
	    if($dia==$elejido){

	    	$fecha=date('Y-m-d', $i);
	    	if ($indice==1) {
	    		if (elementos($fecha,$horario,$duracion,$minutos,$link,$id)==1) {
		    		$_SESSION['mensaje_error']= "ERROR: el vehiculo seleccionado ya se encuentra asociado a otro viaje en ese viaje";
		    		die("Error 1:vehiculo repetido");
		    		
		    	}
	    		$sql_1.=" ,'$fecha')";
	    		$resul=mysqli_query($link,$sql_1);
	    		if ($resul!=true){
				$_SESSION['mensaje_error']= "ERROR: al guardar el viaje tipo semanar, en el 1er dia";
				header("Location:agregar_viaje.php");
				die("error");
				
				}
	
	    	}
	    	if ($indice==2) {
	    		if (elementos($fecha,$horario,$duracion,$minutos,$link,$id)==1) {
		    		$_SESSION['mensaje_error']= "ERROR: el vehiculo seleccionado ya se encuentra asociado a otro viaje en ese viaje";
		    		die("Error 1:vehiculo repetido");
		    		
		    	}
	    		$sql_2.=" ,'$fecha')";
	    		$resul=mysqli_query($link,$sql_2);
	    		if ($resul!=true){
				$_SESSION['mensaje_error']= "ERROR al guardar el viaje tipo semanar, en el 2do dia";
				header("Location:agregar_viaje.php");
				die("error");
				
				}
	    		
	    	}
	    	if ($indice==3) {
	    		if (elementos($fecha,$horario,$duracion,$minutos,$link,$id)==1) {
		    		$_SESSION['mensaje_error']= "ERROR: el vehiculo seleccionado ya se encuentra asociado a otro viaje en ese viaje";
		    		die("Error 1:vehiculo repetido");
		    		
		    	}
	    		$sql_3.=" ,'$fecha')";
	    		$resul=mysqli_query($link,$sql_3);
	    		if ($resul!=true){
				$_SESSION['mensaje_error']= "ERROR al guardar el viaje tipo semanar, en el 3er dia";
				header("Location:agregar_viaje.php");
				die("error");
				
				}
	    		
	    	}
	    	if ($indice==4) {
	    		if (elementos($fecha,$horario,$duracion,$minutos,$link,$id)==1) {
		    		$_SESSION['mensaje_error']= "ERROR un vehiculo no puede estar asociado aun viaje con la mism  fecha y hora";
		    		die("Error 1:vehiculo repetido");
		    		
		    	}
	    		$sql_4.=" ,'$fecha')";
	    		$resul=mysqli_query($link,$sql_4);
	    		if ($resul!=true){
				$_SESSION['mensaje_error']= "ERROR al guardar el viaje tipo semanar, en el 1er dia";
				header("Location:agregar_viaje.php");
				die("error");
				
				}
	    		
	    	}
	    	$indice=$indice+1;
	    	

	    }
	}

	$_SESSION['mensaje']="Sean creado exitosamente los viajes de tipo semanal";
	header("Location:agregar_viaje.php"); 
	mysqli_close($link);
	die("fin");
	
}



?>