<?php

include('conexion.php');
$link=conectar();
session_start();
include('clases.php');



include('funcion_fecha.php');
include('funcion_edad.php');

//para que el programa ande se debe de crear la clase
$verificar = new validar($link);
 ?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	
	
	<title>Aventon</title>
	<link rel="stylesheet" href="boot/css/bootstrap.min.css">
	


	<link rel="stylesheet" href="css/text_fuentes.css">
	<link rel="stylesheet" href="css/iconos/style.css">
	
	<link rel="stylesheet" href="css/header.css">
	<link rel="stylesheet" href="css/footer.css">
	<link rel="stylesheet" href="css/busqueda.css">
	<link rel="stylesheet" href="css/mi_perfil.css">
	<link rel="stylesheet" href="css/index.css">
	<link rel="stylesheet" href="css/crear_viaje.css">
	<link rel="stylesheet" href="css/mis_vehiculos.css">
	<link rel="stylesheet" type="text/css" href="css/modificar_vehiculo.css">
	<link rel="icon"  href="fondos/favicon.ico">
	<link rel="stylesheet" type="text/css" href="css/Postulantes.css">
	<link rel="stylesheet" type="text/css" href="css/cartel.css">
	<link rel="stylesheet" type="text/css" href="css/paginacion.css">
	<link rel="stylesheet" type="text/css" href="css/centrado.css">
	<link rel="stylesheet" type="text/css" href="css/inicio.css">
	<link rel="stylesheet" type="text/css" href="css/detalle.css">

	<link rel="stylesheet" href="css/cartel_2.css">
	<link rel="stylesheet" type="text/css" href="css/mis_viajes_cop.css">
	<link rel="stylesheet" href="css/pago_tarjeta.css">
	
	<link rel="stylesheet" type="text/css" href="css/calificaciones_pendientes.css">
	<link rel="stylesheet" href="css/ver_puntuacion.css">



<script type="text/javascript" src="boot/js/js_min.js"></script>
	<script type="text/javascript" src="boot/js/bootstrap.min.js"></script>
		<script >
 	function activar_modal() {
 		
 		
 		$(document).ready(function()
      {
         $("#myModal").modal("show");
      });
 	}
 </script>

</head>
<body>
	

	<div >
		
		<header style="background-color: #fff;">
			<div id="logo" class="navbar-left"></div>
			<nav class="navbar navbar-default todo_blanco " >

				<div class="collapse navbar-collapse todo_blanco" style="background-color: #fff;">
					<ul class="nav navbar-nav  navbar-right">
						<?php if ($verificar->esta_logueado()){  ?>
						<li><a href="inicio.php">Publicaciones</a></li>

						<li class="dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown" href=""><?php echo ($verificar->nombre()); ?> <span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="mi_perfil.php">Ver mi perfil  </a></li>
								
								<li><a href="agregar_viaje.php">Crear viaje</a></li>
								<li><a href="agregar_vehiculo.php">Agregar vehículo</a></li>
								<li><a href="mis_vehiculos.php">Ver mis vehículos</a></li>
								<li><a href="mostrar_viaje_piloto.php">Ver mis viajes creados</a></li>
								<li><a href="mis_viajes_postulados.php">Ver mis viajes postulados</a></li>
								
								
								<li><a href="calificaciones_pendientes.php">Ver mis calificaciones pendientes</a></li>


							</ul>
						</li>
						<li><a href="salir.php">Salir</a></li>
						<?php } else { ?>
						


						<li><a class="color-a" href="index.php"><span class="icon-users"></span>Login</a></li>
						<li><a class="color-a" href="registrarse.php"><span class="icon-file-text"></span>Registrarse </a></li>
						<?php } ?>	
					</ul>
					
				</div>
			</nav>
		</header>
	</div>





	

