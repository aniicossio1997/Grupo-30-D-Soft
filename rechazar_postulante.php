<?php
include('header.php');
session_start();
$consulta = "UPDATE postulantes SET rechazado = 1 WHERE (postulante_id = $_GET[id]) AND (viaje_id = $_GET[id_viaje])";
$resultado=mysqli_query($link,$consulta);
$_SESSION['id_viaje'] = $_GET['id_viaje'];
header("Location:Postulantes.php");
die();
?>