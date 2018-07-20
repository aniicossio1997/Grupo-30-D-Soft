<?php 

include('header.php');

$id= $verificar->id();

include ('funcion_puntuacion.php');
include('img.php');


$sql="SELECT id, tipoimagen, contenidoimagen, email, password, nombre, apellido, fecha_nac, activo FROM usuarios where id =$_GET[id_pos] ";
#echo $sql;
$resul= mysqli_query($link,$sql);
$fila = mysqli_fetch_array($resul);

if ( $fila['activo'] != 0) {

 ?>
 	<?php	

		//--------------------------------------
	
			if (isset($_SESSION['mensaje'])) {
				echo $_SESSION['mensaje'];
				unset($_SESSION['mensaje']);//mensaje flash
			}
	?>
<section>

	<article class="mis_vehiculos"> 
		<div class="container caja_mayor ">

						<img  class="img-circle alinear_cal img_cal " width="200px" height="200px" src="<?php if (hay_imagen($fila['id'],$link)){?>mostrar_imagen.php?id=<?php echo $fila['id'];?><?php }else{
								echo "fondos/user2.png";
							}
							?>" >
					
			<div class=" alinear_cal  caja_calificar" style="width: 60%;">
						<p>Nombre: <?php echo $fila['nombre'];	?>
							
						</p>
						<p>Apellido: <?php echo $fila['apellido']; ?></p>
						<p class="pf_txt">Fecha de nacimiento: 
					<?php setlocale(LC_ALL,"es_ES@euro","es_ES","esp");
				$fecha = strftime("%d de %B de %Y", strtotime("$fila[fecha_nac]"));
				echo $fecha;
				?></p>
						<p>Edad: <?php echo edad($fila['fecha_nac']); ?> años</p>
						<a href=""></a>
				<p><?php 
				echo puntuacion_piloto($link,$_GET['id_pos']);
				 ?></p>
				 <form action="calificaciones.php" method="POST" style="margin-top: -2%;">
				 		<input type="hidden" name="user_id" value="<?php echo $_GET['id_pos'] ?>">
				 	<input type="hidden" name="tipo" value="0">
				 	<button type="submit" class="btn btn-link" name="mostrar_cal">Más detalles..</button>
				 </form>

				<p><?php 
				echo puntuacion_copiloto($link,$_GET['id_pos']);
				 ?></p>
				 <form action="calificaciones.php" method="POST" style="margin-top: -2%;">
				 		<input type="hidden" name="user_id" value="<?php echo $_GET['id_pos'] ?>">
				 	<input type="hidden" name="tipo" value="0">
				 	<button type="submit" class="btn btn-link" name="mostrar_cal">Más detalles..</button>
				 </form>
					</div>
					
					
		</div>

	</article>
<?php /*<div class="container" >
		<a class="btn btn-info" style=" float: right;margin-top: 2%; margin-right:7%;" href="<?=$_SERVER["HTTP_REFERER"]?>">
	<span class="icon-backward2"></span>	Volver</a>
	</div> */ ?>
	

<?php if (isset($_GET['pagina'])&& $_GET['pagina']=='postulante') {

 ?>
	<form action="Postulantes.php" method="GET">
 	<input type="hidden" name="id_pos" value="<?php echo $_GET['id_pos']; ?>">
 	<input type="hidden" name="id_viaje" value="<?php echo $_GET['id_viaje']; ?>">
 	<input type="hidden" name="origen" value=" echo $_GET['origen'];">
 	<input type="hidden" name="destino" value="<?php echo $_GET['destino']; 
				 	?>">
	<input type="hidden" name="pagina" value="<?php echo "postulante"; ?>">
 	<button type="submit" class="btn btn-info" style=" float: right;margin-top: 2%; margin-right:9%;" name="mostrar_cal"><span class="icon-backward2"></span>Volver</button>
 		 </form>

 		<?php } ?>

 <?php if (isset($_GET['pagina']) && $_GET['pagina']=="calificaciones") { ?>
 	<a href="calificaciones_pendientes.php"  class=" btn btn-info"  style=" float: right;margin-top: 2%; margin-right:9%;">
 	<span class="icon-backward2"></span>Volver</a>
 	<?php
 } ?>
 <?php 
 if (isset($_GET['pagina']) && $_GET['pagina']=="mis_viajes_postulados") {
#echo $_GET['parametro'];

 	/* <a href="mis_viajes_postulados.php?<?php echo $_GET['parametro']?>"  class=" btn btn-info"  style=" float: right;margin-top: 2%; margin-right:9%;"> */
 	if (isset($_GET['pag']) && $_GET['pag']!='' && $_GET['pag']!=0) { ?>
 		<a href="mis_viajes_postulados.php?<?php echo $_GET['parametro']."pag=".$_GET['pag']; ?>"  class=" btn btn-info"  style=" float: right;margin-top: 2%; margin-right:9%;">
 	<span class="icon-backward2"></span>Volver</a>
 <?php	}else{ 

 	?>

<a href="mis_viajes_postulados.php?<?php echo $_GET['parametro'] ?>"  class=" btn btn-info"  style=" float: right;margin-top: 2%; margin-right:9%;"> 
	<span class="icon-backward2"></span>Volver</a>
 
 <?php } } ?>

</section>
<?php }else{ ?>
	<article class="article_interior">
		<div style="margin-left: 42%">
			<div>
				<img src="fondos/carita-triste.png">
			</div>
			<div>
				<div style="margin-left: -8%">
					<b style="font-style: italic;">Lo sentimos, el usuario elimino su cuenta.</b>
				</div>
			</div>
		</div>
	</article>
	<div style="margin-left: 47%; margin-top: 1%">
		<a class="a-link2 fondo-blue" href="<?=$_SERVER["HTTP_REFERER"]?>">Volver</a>
	</div>
<?php } ?>

<?php
include('footer.php');
mysqli_close($link);
//
 ?>

</body>

</html>		