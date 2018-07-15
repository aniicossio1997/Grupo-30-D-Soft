<?php 

include('header.php');
include('img.php');
$user_actual=$verificar->id();

$consulta="SELECT u.nombre,u.apellido, u.tipoimagen, u.contenidoimagen,u.fecha_nac,u.id , c.id as id_cal, c.es_piloto, v.fecha, v.horario FROM calificacion c INNER JOIN usuarios u ON (c.usuario_id=u.id) INNER JOIN viajes v on(v.id=c.viaje_id)  WHERE c.calificador_id=$user_actual AND c.cumple=0  ";


$parametro="";//Guarda los parametros recibidos para la siguiente pagina
$sql2=" ";//para concatenar el de busqueda 
$cal="";
$copiloto=$piloto="";
if (isset($_GET['filtro'])) {
	if (isset($_GET['tipos']) && $_GET['tipos']!='' && $_GET['tipos']!="0") {
		if ($_GET['tipos']==1) {
			//lo califica como piloto
			$piloto="selected";
			$sql2.=" AND c.es_piloto=1  ";
			$parametro.= " tipos=".$_GET['tipos']."&";
		}
		if ($_GET['tipos']==2) {
			//lo califica como copiloto
			#si el calificador no es el dueño del vehiculo
			$copiloto="selected";
			$sql2.=" AND c.es_piloto=0 ";
			$parametro.= " tipos=".$_GET['tipos']."&";
		}
	}


}
$sql2.=" ORDER BY v.fecha, v.horario DESC ";
$resul=mysqli_query($link,$consulta.$sql2);
#echo $consulta.$sql2;

?>
<div class="fondo_gris">
<div style="margin-left: 1%;padding: 1%">
	<p class="title_fv color-a  ">Mis calificaciones pendientes</p class="title_fv">
	
		<form action="calificaciones_pendintes.php" method="GET" style="width: 25%;" class="form-inline">
		<label for="" style="font-size: 1.2em;" class="lead">Ver: </label>
		<select name="tipos" class="fv_tipos" style="cursor: pointer;">
			<option value="">Todos</option>
			<option <?php echo $piloto; ?>  value="1">Solo a Pilotos</option>
			<option <?php echo $copiloto; ?> value="2">Solo a Copilotos</option>
		</select>
		<button name="filtro" class="btn_filtro" type="submit" >Aplicar</button>

		
	</form>

</div>
</div>


<?php if (mysqli_num_rows($resul)<1) { ?>
	<article class="mis_vehiculos">
	<p class=" text_center" style="color: #504c4c;">~~No hay resultados o usted no posee calificaciones pendientes~~</p>

	</article>

<?php }

/**/
?>

<section>
	<?php while ($fila=mysqli_fetch_array($resul)) { ?>
		<article class="mis_vehiculos">

		
		<div class="container caja_mayor ">

			<div class="alinear_cal caja_mov">
				<?php  /* ?>
			<?php if ($fila['es_piloto']==1) { ?>

			<a class="btn btn-primary" href="calificar_copiloto.php?user_a_cal=<?php echo $fila['id'];?>&id_cal=<?php echo $fila['id_cal']; ?> "> Calificar</a>

			<?php }else{ ?>
				<a class="btn btn-primary" href="calificar_piloto.php?user_a_cal=<?php echo $fila['id'];?>&id_cal=<?php echo $fila['id_cal']; ?>">Calificar</a>
			<?php } ?>
			<?php */ ?>
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
						<a href="mi_perfil2.php?id_pos=<?php echo $fila['id'] ?>"> Mas información..</a>
				
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