<?php
include("header.php");
$consulta = "SELECT * FROM viajes WHERE id = $_GET[id_viaje]";
$resultado = mysqli_query($link,$consulta);
$fila = mysqli_fetch_array($resultado);
$consulta1 = "SELECT postulante_id FROM postulantes WHERE viaje_id = $_GET[id_viaje]";
$resultado1 = mysqli_query($link,$consulta1);
?>
<h1 class="h1-form"> Copilotos pendientes </h1> 
  <br>
<div class="scrollable div_incio">
	<h3 class="origen_destino">Origen: <?php echo $fila['origen']?></h3><h3 class="origen_destino">Destino: <?php echo $fila['destino'] ?> </h3>
  <?php while ($fila1 = mysqli_fetch_array($resultado1)) { 
  ?>  
   <article class="article_exterior">
	<article class="article_interior">
		<table class="tabla">
			<tr>
				<td>
					<?php
					  $consulta2 = "SELECT nombre FROM usuarios WHERE id = $fila1[postulante_id]";
					  $resultado2 = mysqli_query($link,$consulta2);
					  $fila2 = mysqli_fetch_array($resultado2);
					?>
					<p>Postulante: <?php echo $fila2['nombre'] ?> </p>
				</td>
				<td>
					<p>Calificcion: en desarrollo</p>
				</td>
			</tr>
			<tr>
				<td>
					<p></p>
				</td>
			</tr>
		</table>
	</article>
		<table>
			<tr class="Td-a" >
				<td></td>
				<td></td>
				<td class="Td-a">
					<a class="a-link2 a-rig fondo-blue"  href="">Aceptar</a>
				</td>				
				<td class="Td-a">
					<a class="a-link2 a-rig fondo-blue"  href="">Rechazar</a>
				</td>
			</tr>
		</table>
	</article>	
	</table>
	</article>
  </div>	
<?php }
include("footer.php")
?>