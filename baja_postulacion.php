<?php

include('conexion.php');
$link=conectar();
session_start();
include('clases.php');
include('funcion_sancionar.php');

  $verificar= new validar($link);
  $id = $verificar->id();




//-------------
  //consulta para obtener la fecha del viaje al que se quiere postular
$consulta0 = "SELECT fecha,horario,activo FROM viajes WHERE id = $_GET[id_viaje]";
$resultado0 = mysqli_query($link,$consulta0);
$fila0 = mysqli_fetch_array($resultado0);
if($fila0['fecha'] < date("Y-m-d") OR ($fila0['fecha'] == date("Y-m-d") && $fila0['horario'] <= date("H:i:s"))){
  $_SESSION['mensaje'] = "Lo siento, el viaje ya expiro";
    header("Location: inicio.php");
    die();
}

   // el id del usuario debe ser igual al id de postulante
  $consulta ="SELECT estado FROM postulantes WHERE viaje_id = $_GET[id_viaje] ";
  $resultado= mysqli_query($link,$consulta);
  $vector= mysqli_fetch_array($resultado);

  //echo $_GET['vip_pos'];



  if (!isset($_GET['respuesta'])) 
    {
      $_SESSION['confirmacion2'] = " Si fue aceptado se le restara un punto de su calificación... <br>¿Esta usted seguro de darse de baja?
";
      if ($_GET['vip_pos']=='vip_pos') {
        header("Location: mis_viajes_postulados.php?viaje_id=$_GET[id_viaje]&vip_pos=$_GET[vip_pos]");
        die();
      }
      header("Location: inicio.php?viaje_id=$_GET[id_viaje]");
      die();
    }else{
          $consulta1 = " UPDATE postulantes SET estado = 0 where viaje_id = $_GET[id_viaje]";
          $resultado1 = mysqli_query($link,$consulta1);
          //llama a una funcion para restar los puntos si ya lo habian aceptados
          sancionar_copiloto($link,$id,$_GET['id_viaje']);
        if ($_GET['vip_pos']=='vip_pos') {
        header("Location: mis_viajes_postulados.php?viaje_id=$_GET[id_viaje]&vip_pos=$_GET[vip_pos]");
        die();
      }


          $_SESSION['mensaje']= " baja exitosa.";
          header("Location:inicio.php");
          die();
 }
?>