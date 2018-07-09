<?php 

include('header.php');
include('img.php');

$user_actual=$verificar->id();

$consulta="SELECT u.nombre,u.apellido, u.tipoimagen, u.contenidoimagen,u.fecha_nac,u.id , c.soy_piloto, c.id as id_cal FROM calificacion c INNER JOIN usuarios u ON (c.usuario_id=u.id)  WHERE c.calificador_id=$user_actual AND c.cumple=0 ";
$resul=mysqli_query($link,$consulta);
//echo $consulta;
?>
<div class="fondo_gris" style="background-color:rgba(255, 255, 255, 0.5);">
		<p class="title_fv color-a  ">Mis calificaciones pendientes</p class="title_fv">
</div>

<?php if (mysqli_num_rows($resul)<1) { ?>
	<article class="mis_vehiculos">
	<p class=" text_center" style="color: #504c4c;">Usted no adeuda calificaciones</p>

	</article>

<?php }

/**/
?>

<section>
	<?php while ($fila=mysqli_fetch_array($resul)) { ?>
		<article class="mis_vehiculos">

		
		<div class="container caja_mayor ">

			<div class="alinear_cal caja_mov">
			<?php if ($fila['soy_piloto']==1) { ?>

			<a class="btn btn-primary" href="calificar_copiloto.php?user_a_cal=<?php echo $fila['id'];?>&id_cal=<?php echo $fila['id_cal']; ?> "> Calificar</a>

			<?php }else{ ?>
				<a class="btn btn-primary" href="calificar_piloto.php?user_a_cal=<?php echo $fila['id'];?>&id_cal=<?php echo $fila['id_cal']; ?>">Calificar</a>
			<?php } ?>
			
					</div>

						<img  class="img-circle alinear_cal img_cal " width="120px" height="120px" src="<?php if (hay_imagen($fila['id'],$link)){?>mostrar_imagen.php?id=<?php echo $fila['id'];?><?php }else{
								echo "fondos/user2.png";
							}
							?>" >
					
					<div class=" alinear_cal  caja_calificar">
						<p>Nombre: <?php echo $fila['nombre'];	?>
							
						</p>
						<p>Apellido: <?php echo $fila['apellido']; ?></p>
						<p>Edad: <?php echo edad($fila['fecha_nac']); ?> años</p>
						<a href=""> Mas información..</a>
					</div>
					
					
		</div>

	</article>
<?php	} ?>
	
</section>
<br>
<br>

<?php

include('footer.php');
mysqli_close($link);
 ?>
 </body>
 </html>