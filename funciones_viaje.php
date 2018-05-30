<?php 
function elementos($fecha,$horario,$link,$id)
{
	$consulta="SELECT * FROM viajes WHERE vehiculo_id=$id AND fecha = '$fecha' AND horario ='$horario'"; 
	$resul=mysqli_query($link,$consulta);
	if ($resul) {
		$elemen=mysqli_num_rows($resul);
		if ($elemen==0) {
			return 0;
		}
		return 1;
	}else{
		$_SESSION['msj']= "Error al chequear si hay viajes con vehiculo repetido";
		header("Location:agregar_viaje.php");
		die("ERROR al chequear auto repetido");
	}
	

}
//-------------------------------------------------------------

function tipo_ocasional($link,$sql,$horario,$id,$fecha)
{
	if (elementos($fecha,$horario,$link,$id)==1) {
	    $_SESSION['mensaje']="ERROR un vehiculo no puede estar asociado a un viaje con la mism  fecha y hora";
	    header("Location:agregar_viaje.php");
	    die("Error 1:vehiculo repetido");

	}

	if ($fecha<=date('Y-m-d')) {
		$_SESSION['mensaje']="ERROR la fecha elegida debe ser mayor a la fecha actual";
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
			$_SESSION['mensaje']="Algo salio mal: error en tipo de viaje ocacional";
			header("Location:agregar_viaje.php");
			die("error"); 
			}

}

//-------------------------------------------------------------------
function tipo_diario($link,$sql,$horario,$id)
{

	$fechaInicio=strtotime("now");
	$fechaFin = $fechaInicio+((7*86400));
	$cant=0;
	for($i=$fechaInicio; $i<$fechaFin; $i+=86400){
	    //Sacar el dia de la semana con el modificador N de la funcion date
	    $dia = date('N', $i);
	    $sql_1=$sql_2=$sql_3=$sql_4=$sql_5=$sql;

	    $fecha=date('Y-m-d', $i);

	    if($dia==1){
	    	
	    	if (elementos($fecha,$horario,$link,$id)==1) {
	    		$cant=$cant +1;
	    		$_SESSION['mensaje']="ERROR un vehiculo no puede estar asociado aun viaje con la mism  fecha y hora";
	    		header("Location:agregar_viaje.php");
	    		die("Error 1:vehiculo repetido");
	    		

	    	}
	    	
	    	$sql_1.=" ,'$fecha')";
	        $resul=mysqli_query($link,$sql_1);
			if ($resul!=true){
				$_SESSION['mensaje']="Algo salio mal,cuando al crear el viaje para el dia lunes";
				header("Location:agregar_viaje.php");
				die("ERROR al guarar el viaje");
				
			}

	    }
	    if($dia==2){

	    	if (elementos($fecha,$horario,$link,$id)==1) {
	    		$cant=$cant +1;
	    		$_SESSION['mensaje']="ERROR un vehiculo no puede estar asociado aun viaje con la mism  fecha y hora";
	    		header("Location:agregar_viaje.php");
	    		die("Error 1:vehiculo repetido");
	    		
	    	}
	    	$sql_2.=" ,'$fecha')";
	    	$resul=mysqli_query($link,$sql_2);

			if ($resul!=true){ 
				$_SESSION['mensaje']="Error al guardar viaje para el martes";
				header("Location:agregar_viaje.php");
				die("Error al guardar viaje de tipo diario");
				}

		}
	    if($dia==3){

	    	if (elementos($fecha,$horario,$link,$id)==1) {
	    		$cant=$cant +1;
	    		$_SESSION['mensaje']="ERROR un vehiculo no puede estar asociado aun viaje con la mism  fecha y hora dia 3";
	    		header("Location:agregar_viaje.php");
	    		die("Error 1:vehiculo repetido");
	    		
	    	}
	    	$sql_3.=" ,'$fecha')";
	    	
	        $resul=mysqli_query($link,$sql_3);
			if ($resul!=true){

				$_SESSION['mensaje']="ERROR al guardar el viaje diario para el dia miercoles";
				header("Location:agregar_viaje.php");
				die("ERROR");
				}
	       

	    }
	    if($dia==4){

	    	if (elementos($fecha,$horario,$link,$id)==1) {
	    		$cant=$cant +1;
	    		$_SESSION['mensaje']="ERROR un vehiculo no puede estar asociado aun viaje con la mism  fecha y hora";
	    		header("Location:agregar_viaje.php");
	    		die("Error 1:vehiculo repetido");
	    		
	    	}
	   	 	$sql_4.=" ,'$fecha')";
	    	
	        $resul=mysqli_query($link,$sql_4);
			if ($resul!=true){
				$_SESSION['mensaje']= "ERROR al guardar el viaje tipo diario, en el dia jueves";
				header("Location:agregar_viaje.php");
				die("error");
				
			}
	    }

	    if($dia==5){

	    	if (elementos($fecha,$horario,$link,$id)==1) {
	    		$cant=$cant +1;
	    		$_SESSION['mensaje']="ERROR un vehiculo no puede estar asociado aun viaje con la mism  fecha y hora";
	    		die("Error 1:vehiculo repetido");
	    		
	    	}
	    	$sql_5.=" ,'$fecha')";
	    	
	        $resul=mysqli_query($link,$sql_5);
			if ($resul!=true){
				$_SESSION['mensaje']= "ERROR al guardar el viaje tipo diario, en el dia viernes";
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

function tipo_semanal($link,$sql,$elejido,$horario,$id)
{	
	$fechaInicio=strtotime("now");
	$fechaFin = $fechaInicio+((7*86400)*4);
	$indice=1;
	$sql_1=$sql_2=$sql_3=$sql_4=$sql;
	   
	for($i=$fechaInicio; $i<=$fechaFin; $i+=86400){
	    //Sacar el dia de la semana con el modificador N de la funcion date
	    $dia = date('N', $i);
	    if($dia==$elejido){

	    	$fecha=date('Y-m-d', $i);
	    	if ($indice==1) {
	    		if (elementos($fecha,$horario,$link,$id)==1) {
		    		$_SESSION['mensaje']= "ERROR un vehiculo no puede estar asociado aun viaje con la mism  fecha y hora";
		    		die("Error 1:vehiculo repetido");
		    		
		    	}
	    		$sql_1.=" ,'$fecha')";
	    		$resul=mysqli_query($link,$sql_1);
	    		if ($resul!=true){
				$_SESSION['mensaje']= "ERROR al guardar el viaje tipo semanar, en el 1er dia";
				header("Location:agregar_viaje.php");
				die("error");
				
				}
	
	    	}
	    	if ($indice==2) {
	    		if (elementos($fecha,$horario,$link,$id)==1) {
		    		$_SESSION['mensaje']= "ERROR un vehiculo no puede estar asociado aun viaje con la mism  fecha y hora";
		    		die("Error 1:vehiculo repetido");
		    		
		    	}
	    		$sql_2.=" ,'$fecha')";
	    		$resul=mysqli_query($link,$sql_2);
	    		if ($resul!=true){
				$_SESSION['mensaje']= "ERROR al guardar el viaje tipo semanar, en el 2do dia";
				header("Location:agregar_viaje.php");
				die("error");
				
				}
	    		
	    	}
	    	if ($indice==3) {
	    		if (elementos($fecha,$horario,$link,$id)==1) {
		    		$_SESSION['mensaje']= "ERROR un vehiculo no puede estar asociado aun viaje con la mism  fecha y hora";
		    		die("Error 1:vehiculo repetido");
		    		
		    	}
	    		$sql_3.=" ,'$fecha')";
	    		$resul=mysqli_query($link,$sql_3);
	    		if ($resul!=true){
				$_SESSION['mensaje']= "ERROR al guardar el viaje tipo semanar, en el 3er dia";
				header("Location:agregar_viaje.php");
				die("error");
				
				}
	    		
	    	}
	    	if ($indice==4) {
	    		if (elementos($fecha,$horario,$link,$id)==1) {
		    		$_SESSION['mensaje']= "ERROR un vehiculo no puede estar asociado aun viaje con la mism  fecha y hora";
		    		die("Error 1:vehiculo repetido");
		    		
		    	}
	    		$sql_4.=" ,'$fecha')";
	    		$resul=mysqli_query($link,$sql_4);
	    		if ($resul!=true){
				$_SESSION['mensaje']= "ERROR al guardar el viaje tipo semanar, en el 1er dia";
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