<?php 

include('header.php');

$id= $verificar->id();

include ('funcion_puntuacion.php');
include('img.php');


$sql="SELECT id, tipoimagen, contenidoimagen, email, password, nombre, apellido, fecha_nac FROM usuarios where id =$_GET[id_pos] ";

if ( $_GET['id_pos']!='') {
$resul= mysqli_query($link,$sql);
$existe = mysqli_num_rows($resul);
$fila = mysqli_fetch_array($resul);
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
				<p>Total calificacion como piloto: <?php 
				echo puntuacion_piloto($link,$id);
				 ?></p>

				<p>Total calificacion como Copiloto: <?php 
				echo puntuacion_copiloto($link,$id);
				 ?></p>
					</div>
					
					
		</div>

	</article>

	<div class="container" >
		<a class="btn btn-info" style=" float: right;margin-top: 2%; margin-right:7%;" href="<?=$_SERVER["HTTP_REFERER"]?>">
	<span class="icon-backward2"></span>	Volver</a>
	</div>
	<br>



<?php 
$consulta="SELECT u.nombre,u.apellido,c.comentario,c.puntaje,c.hora,c.fecha FROM calificacion c INNER JOIN usuarios u ON (c.calificador_id=u.id) WHERE c.usuario_id=$id";
//echo $consulta;

$resul=mysqli_query($link,$consulta);
//$fila=mysqli_fetch_array($link,$consulta);

 ?>

<section>

<div class="container"><div  class="btn btn-success" style="margin-left: 5%;">Calificaciones:	</div></div>
<?php

if (mysqli_num_rows($resul)<1) { ?>
		<article class="mis_vehiculos">
	<p class=" text_center" style="color: #504c4c;">El usuario aun no posee calificaciones..</p>

	</article>

<?php
}

while ($fila=mysqli_fetch_array($resul)) { 

?>
<article class="mis_vehiculos">

		
		<div class="container caja_mayor ">
		
		<p>Puntaje: <?php if ($fila['puntaje']==1) {
			echo "Bueno ";
		}elseif ($fila['puntaje']==0) {
			echo "Neutro";
		}else echo "Malo"; ?></p>
		<p>Comentario: <?php echo $fila['comentario']; ?></p>

		<p style="font-size: 0.9em; color: #777;float: right;">Usuario: <?php echo $fila['nombre'].",".$fila['apellido']."  "."; fecha: ".fecha_string($fila['fecha'])."-- Hora: ".(substr("$fila[hora]", 0, -3)); ?></p>
		
	</div>
		
	</article>
<?php	
}

 ?>
	
</section>






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