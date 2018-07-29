<?php 
include('header.php');

$id= $verificar->id();
include ('funcion_puntuacion.php');
include('img.php');
 ?>

	 
<?php 
	$consulta="SELECT c.comentario,c.puntaje,c.hora,c.fecha,c.es_sancion, u.nombre, u.apellido FROM calificacion c left join usuarios u on(c.calificador_id=u.id) WHERE c.usuario_id=$_POST[user_id]  AND c.cumple=1 AND c.es_piloto=$_POST[tipo] ORDER BY c.fecha, c.hora DESC "; 

$resul2=mysqli_query($link,$consulta);
if (mysqli_num_rows($resul2)<1) { 
	if ($_POST['tipo']==0) {
		$_SESSION['error']="No posee calificaciones como Copiloto";
	}else{
		$_SESSION['error']="No posee calificaciones como Piloto";
	}
	
	header("Location:".$_SERVER["HTTP_REFERER"]);
}
?>

 <a class="btn btn-info" style="float: right; position: fixed; margin-top: 30%; border-radius: 35px" href="<?=$_SERVER["HTTP_REFERER"]?>"> Volver </a>
<?php 

if ($_POST['tipo']==1 && mysqli_num_rows($resul2) > 0) { ?>
		<p class="title_fv color-a ">Calificaciones como Piloto</p>
 <?php	}else { ?> <p class="title_fv color-a ">Calificaciones como copiloto</p>   <?php }


	
?>

<section>
<?php
	while ($mostrar=mysqli_fetch_array($resul2)) { 
?>
	<article class="mis_vehiculos">
					<div class="container caja_mayor ">
		<p><b>Puntaje:</b> <?php if ($mostrar['puntaje']==1) {
			echo "Bueno ";
		}elseif ($mostrar['puntaje']==0) {
			echo "Neutro";
		}else echo "Malo"; ?></p>

		<p><b>Comentario:</b> <?php 
			if ($mostrar['es_sancion']==1) {
				echo "-----";
			}else{echo $mostrar['comentario'];}
		 ?></p>


		<p style="font-size: 0.9em; color: #777;float: right;">
			<?php
			$autor=""; 
			if ($mostrar['es_sancion']==1) {
				$autor="Es una sanción";
			}else{
				$autor=$mostrar['nombre'].",".$mostrar['apellido'];
			}

			echo $autor." - "."Fecha: ".fecha_string($mostrar['fecha'])." - Hora: ".(substr("$mostrar[hora]", 0, -3)); ?>
				
			</p>

	</div>
</article>
<?php } ?>
	

</section>
	<?php
include('footer.php');

//
 ?>
</body>
</html>

