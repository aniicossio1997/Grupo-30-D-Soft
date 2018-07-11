<?php
include('header.php');
$user_actual=$verificar -> id();
  if (!isset($_GET['respuesta'])) {
  	$_SESSION['confirmacion'] = "Esta usted esta seguro de darse de baja";
  	header("Location: mi_perfil.php");
  	die();
  }else{ 
  	//doy de baja al usuario logicamente.
  	$consulta1="UPDATE usuarios SET activo = 0 WHERE id = $user_actual";
    $resultado = mysqli_query($link,$consulta1);
  	unset($_GET['respuesta']);
  	unset($_SESSION['id']);
  	header("Location:index.php");
  	die();
  }
?>