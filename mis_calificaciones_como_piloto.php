
<?php 

include('header.php');

$id= $verificar->id();

include ('funcion_puntuacion.php');

$consulta="SELECT comentario,puntaje,hora,fecha FROM calificacion  WHERE usuario_id=$id  AND cumple=1 AND es_sancion=0 AND es_piloto=1 ORDER BY fecha, hora DESC ";


$resul=mysqli_query($link,$consulta);
//$fila=mysqli_fetch_array($link,$consulta);

 ?>

<br>
<section>
<div class="container"><div  class="btn btn-success" style="margin-left: 5%;">Mis calificaciones:	</div></div>
<?php

if (mysqli_num_rows($resul)<1) { ?>
		<article class="mis_vehiculos">
	<p class=" text_center" style="color: #504c4c;">Usted no aun no posee calificaciones..</p>

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

		<p style="font-size: 0.9em; color: #777;float: right;"><?php echo "fecha: ".fecha_string($fila['fecha'])."-- Hora: ".(substr("$fila[hora]", 0, -3)); ?></p>
		
	</div>
		
	</article>
<?php	
}

 ?>
	
</section>

<?php
include('footer.php');

//
 ?>
</body>
</html>