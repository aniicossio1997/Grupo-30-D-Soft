<?php 
include('conexion.php');
include('clases.php');
$link = conectar();
$verificar= new validar($link);
$id= $verificar->id();
$fecha = date("Y-m-d");
$hora=date("H:i:s");
$hora.=":00";
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
		//echo($_POST['comentario']);
		$sql="UPDATE calificacion SET puntaje = '$num', comentario='$_POST[comentario]', cumple=1, fecha='$fecha',hora='$hora'  WHERE usuario_id = $_POST[user_a_cal] AND id =$_POST[id_cal]";

		$resultado=mysqli_query($link,$sql);
		$_SESSION['mensaje']="calificacion exitosa";
		header("Location:calificaciones_pendientes.php");
	
	} else{
		if (!isset($_POST['comentario']) && empty($_POST['comentario']) ){
			$_SESSION['mensaje']="Falta completar el campo comentario, ingrese uno";
    		header("Location:calificaciones_pendientes.php");
    		die();
    		
		}
       
		
	}

}else{
   $_SESSION['mensaje']="Falta seleccionar un puntaje, seleccione uno";
   header("Location:calificaciones_pendientes.php");
   die();
}