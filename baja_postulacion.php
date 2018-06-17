<?php
  include('conexion.php');
  include('clases.php');
  $link= conectar();
  $verificar= new validar($link);
  $id = $verificar->id();

  session_start();

   // el id del usuario debe ser igual al id de postulante
  $consulta ="SELECT estado FROM postulantes WHERE viaje_id = $_GET[id_viaje] ";
  $resultado= mysqli_query($link,$consulta);
  $vector= mysqli_fetch_array($resultado);
  if($vector['estado'] == 0){
    $_SESSION['mensaje']= "Ya se encuentra dado de baja como postulante.";
    header("Location:inicio.php");
  }else{
    $consulta1 = " UPDATE postulantes SET estado = 0 where viaje_id = $_GET[id_viaje]";
    $resultado1 = mysqli_query($link,$consulta1);
    $_SESSION['mensaje']= " baja exitosa.";
    header("Location:inicio.php");
    die();
 }
  
   


  
?>