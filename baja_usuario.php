<?php
include('header.php');
$user_actual=$verificar -> id();
  if (!isset($_GET['respuesta'])) {
  	$_SESSION['confirmacion'] = "Esta usted esta seguro de darse de baja";
  	header("Location: mi_perfil.php");
  	die();
  }else{ 
  	//eliminacion de la tabla de usuarios
  	$consulta1="DELETE FROM usuarios WHERE id = $_GET[id_usuario]";
  	$resultado1= mysqli_query($link,$consulta1);
  	//eliminacion de los vehiculos asociados.
  	$consulta2 = "DELETE FROM vehiculo WHERE usuario_id = $_GET[id_usuario]";
  	$resultado2=mysqli_query($link,$consulta2);
  	//eliminacion de las preguntas realizadas por el usuario en diferentes ppublicaciones.
  	$consulta3 = "DELETE FROM preguntas WHERE preguntador_id = $_GET[id_usuario]";
  	$resultado3 = mysqli_query($link,$consulta3);

    $consulta4="DELETE FROM calificacion WHERE usuario_id=$user_actual";

    $resultado4=mysqli_query($link,$consulta4);

    $consulta5="DELETE FROM calificacion WHERE calificador_id=$user_actual";

    $resultado5=mysqli_query($link,$consulta5);


  	unset($_GET['respuesta']);
  	unset($_SESSION['id']);
  	header("Location:index.php");
  	die();
  }
?>