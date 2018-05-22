<?php 
include('conexion.php');
$link=conectar();
session_start();
include('clases.php');
if (isset($_get['varios']) && !empty($_get['varios']) && isset($_get['fecha']) && !empty($_get['fecha']) && isset($_get['origen']) && !empty($_get['origen']) && isset($_get['destino']) && !empty($_get['destino']) && isset($_get['costo']) && !empty($_get['costo']) && isset($_get['duracion']) && !empty($_get['duracion']) && isset($_get['pasajeros']) && !empty($_get['pasajeros'])) {
	echo "string";
}else{
	echo " error";}


?>