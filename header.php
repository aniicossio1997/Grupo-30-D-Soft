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
	<link rel="stylesheet" href="css/iconos/style.css">
	<link rel="stylesheet" href="css/fuentes.css">
	<link rel="stylesheet" href="css/header.css">
	<link rel="stylesheet" href="css/footer.css">
	<link rel="stylesheet" href="css/busqueda.css">
	<link rel="stylesheet" href="css/mi_perfil.css">
	<link rel="stylesheet" href="css/index.css">
	<link rel="stylesheet" href="css/crear_viaje.css">
	<link rel="stylesheet" href="css/mis_vehiculos.css">
	
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
				<li><a class="a-link color-a" href="agregar_vehiculo.php">
					Cear vehículo <span class="icon-upload3"></span> </a> </li>

				<li><a class="a-link color-a" href="mi_perfil.php">Perfil <span class="icon-user"></span></a></li>
				<li><a class="a-link color-a" href="ver_viajes.php">Inicio <span class="icon-home"></span></a></li>
				<li><a class="a-link color-a" href="salir.php">Salir <span class="icon-switch"></span> </a></li>

				<?php } else { ?>

				<li><a class="a-link color-a" class="" href="index.php"><span class="icon-users"></span>Login</a></li> 
				<li><a class="a-link color-a" class="" href="registrarse.php"> <span class="icon-file-text"></span>Registrarse </a>

				<?php } ?>	
				</ul>
			</nav>
	</header>
	
