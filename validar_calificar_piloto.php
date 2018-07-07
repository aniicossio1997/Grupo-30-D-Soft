<?php 
include('conexion.php');
include('clases.php');
$link = conectar();
$verificar= new validar($link);
$id= $verificar->id();
$fecha = date("Y-m-d");

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
		$sql="INSERT INTO calificacion (id,usuario_id,calificador_id,puntaje, comentario, fecha) VALUES (null,'$id','9','$num','$_POST[comentario]','$fecha')";
		$resultado=mysqli_query($link,$sql);
				echo($_POST['comentario']);
		echo($resultado);
	
	} else{
			echo "no existe comentario";
			$_SESSION['mensaje']="Falta completar el campo comentario, ingrese uno";
    		header("Location:calificaciones_pendientes.php");
    		die();
	}

}else{
   $_SESSION['mensaje']="Falta seleccionar un puntaje, seleccione uno";
   header("Location:calificaciones_pendientes.php");
   die();
}