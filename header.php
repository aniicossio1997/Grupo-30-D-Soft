<?php 
include('conexion.php');
$link=conectar();
session_start();
include('clases.php');
 ?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="css/header.css">
	<link rel="stylesheet" href="css/footer.css">
	<link rel="stylesheet" href="css/busqueda.css">
	<link rel="stylesheet" href="css/mi_perfil.css">
	<link rel="stylesheet" href="css/index.css">
	
	<title>Un Aventon</title>
</head>
<body>

	<header>
		<div id="logo"></div>
			<nav>
				<ul>

				<?php 
				$verificar = new validar($link);//se crea  una clase
				
				if ($verificar->esta_logueado()){ ?>
				<li><a href="agregar_vehiculo.php">Agregar vehículo</a></li>
				<li><a href="mi_perfil.php">Perfil</a></li>
				<li><a href="ver_viajes.php">Inicio</a></li>
				<li><a href="salir.php">Salir</a></li>

				<?php } else { ?>

				<li><a class="" href="index.php"><span class="icon-users"></span>Login</a></li> 
				<li><a class="" href="registrarse.php"> <span class="icon-file-text"></span>Registrarse </a>

				<?php } ?>	
				</ul>
			</nav>
	</header>
	
