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
  if (!isset($_GET['respuesta'])) 
    {
      $_SESSION['confirmacion2'] = "¿Esta usted seguro de darse de baja?";
      header("Location: inicio.php?viaje_id=$_GET[id_viaje]");
      die();
    }else{
          $consulta1 = " UPDATE postulantes SET estado = 0 where viaje_id = $_GET[id_viaje]";
          $resultado1 = mysqli_query($link,$consulta1);
          $_SESSION['mensaje']= " baja exitosa.";
          header("Location:inicio.php");
          die();
 }
?>