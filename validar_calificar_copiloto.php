<?php 
include ('header.php');
$verificar= new validar($link);
$id= $verificar->id();
$fecha = date("Y-m-d");
$num= 0;

if (isset($_POST['puntaje']) && !empty($_POST['puntaje'])) {
	// puntaje recien ingresado:
	if( $_POST['puntaje'] == "neutro") //neutro
	  $num= 0;
	if( $_POST['puntaje'] == "malo") //malo
	  $num= -1;
	if( $_POST['puntaje'] == "bueno") //bueno
	  $num= 1;
	 
	if (isset($_POST['comentario']) && !empty($_POST['comentario']) )
	{
		$consulta="INSERT INTO calificacion (id,usuario_id,calificador_id,puntaje, comentario, fecha,modo_calificacion) VALUES (null,'3','$id','$num','$_POST[comentario]','$fecha','0')";
		$resultado=mysqli_query($link,$consulta);	
	} else{
		echo "else";
		if (!isset($_POST['comentario']) && empty($_POST['comentario']) ){
			$_SESSION['mensaje']="Falta completar el campo comentario, ingrese uno";
    		//header("Location:calificaciones_pendientes.php");
    		//die();    		
		}
	}

}else{
   $_SESSION['mensaje']="Falta seleccionar un puntaje, seleccione uno";
   //header("Location:calificaciones_pendientes.php");
   //die();
}