<?php 
include('header.php');
include('img.php');
include ('funcion_puntuacion.php');
$id=$verificar->id();


$consulta="SELECT c.viaje_id, COUNT(c.viaje_id) as numero, v.origen, v.destino,v.fecha, v.horario, c.es_sancion,c.es_piloto FROM calificacion c INNER JOIN viajes v ON (c.viaje_id=v.id) WHERE c.cumple=0 and c.calificador_id=$id and c.es_sancion=0 GROUP BY c.viaje_id ";
#echo $consulta;

$resul=mysqli_query($link,$consulta);

?>


<?php if (mysqli_num_rows($resul)==0) { ?>
	<article class="mis_vehiculos">
	<p class=" text_center" style="color: #504c4c;">~~No hay resultados o usted no posee calificaciones pendientes~~</p>

	</article>

<?php }

/**/
?>



<section>
<?php
while ($mostrar=mysqli_fetch_array($resul)) { ?>

<article class="mis_vehiculos">
<div>
	<?php if ($mostrar['es_piloto']==1) { ?>
	<p style="font-size: 1.2em"><b>Usted adeuda la calificación al piloto:</b></p>
<?php }else { ?>
<p style="font-size: 1.2em"><b >Usted adeuda la/s calificaciones a : <?php echo " ".$mostrar['numero']; ?> copiloto/s
    	</b></p>
<?php } ?>
</div>

	<div style="overflow: auto;<?php if ($mostrar['es_piloto']==1 || $mostrar['numero'] <2){echo "height: 83px";}else{  echo "height:130px";} ?>  ">
		<table class="table">
			<tbody style="padding-top: 2px; padding-bottom: 1px">
		<?php if ($mostrar['es_piloto']==1) { ?>
    	<?php $consulta2="SELECT u.nombre,u.apellido,u.id,c.id as id_cal  FROM usuarios u INNER JOIN calificacion c on(c.usuario_id=u.id) WHERE c.viaje_id=$mostrar[viaje_id] and c.calificador_id=$id and es_piloto=1 and cumple=0";
		#echo $consulta2;
		$resul2=mysqli_query($link,$consulta2);
		$mostrar2=mysqli_fetch_array($resul2);
		 ?>
    	<tr style="border-bottom: 1px solid #ccc;">
    		<td><?php echo $mostrar2['nombre'].",".$mostrar2['apellido']; ?>
    		<form action="mi_perfil2.php" method="GET" style="padding-top: 3px">
			<input type="hidden" name="id_pos" value="<?php echo $mostrar2['id']; ?>">
			<input type="hidden" name="pagina" value="<?php echo "calificaciones"; ?>">
			<button type="submit" class="btn btn-link">Más información..</button>
				 </form>
    		</td>
    		<td><?php echo puntuacion_piloto($link,$mostrar2['id']) ; ?></td> 
    		<td><a class="btn btn-primary" href="calificar_piloto.php?user_a_cal=<?php echo $mostrar2['id'];?>&id_cal=<?php echo $mostrar2['id_cal']; ?>">Calificar al piloto</a></td>
    	</tr>
    	<?php }else{  ?>
    		   <!-- - - - - - - -   - - - - - - - - - - - - - - - - - - -  -->


  		<?php $consulta2="SELECT u.nombre,u.apellido,u.id, c.id as id_cal FROM usuarios u INNER JOIN calificacion c on(c.usuario_id=u.id) WHERE c.viaje_id=$mostrar[viaje_id] and c.calificador_id=$id and es_piloto=0 and cumple=0";
		#echo $consulta2;
		$resul2=mysqli_query($link,$consulta2);
		while ($mostrar3=mysqli_fetch_array($resul2)) { ?>
			
			<tr style="border-bottom: 1px solid #ccc;">
				<td>
				<?php echo $mostrar3['nombre'].",".$mostrar3['apellido']; ?>
				
				<form action="mi_perfil2.php" method="GET" style="padding-top: 3px">
			<input type="hidden" name="id_pos" value="<?php echo $mostrar3['id']; ?>">
			<input type="hidden" name="pagina" value="<?php echo "calificaciones"; ?>">
			<button type="submit" class="btn btn-link">Más información..</button>
				 </form>
					
				</td>
				<td>
				 <?php echo puntuacion_copiloto($link,$mostrar3['id']) ; ?>
				</td>
				<td>
					<a class="btn btn-primary" href="calificar_copiloto.php?user_a_cal=<?php echo $mostrar3['id'];?>&id_cal=<?php echo $mostrar3['id_cal']; ?> "> Calificar al copiloto</a>
				</td>
			</tr>
			
		<?php }
		 ?>

<?php } ?>

			</tbody>
		</table>
	</div>
	<table class="table">
			<tbody>
				<tr style="padding-top: 0"><td style="padding-top: 0"><b>Datos del viaje:</b></td><td style="padding-top: 0"></td><tdstyle="padding-top: 0"></td></tr>
    <tr>
	 <td>Fecha: <?php echo fecha_string ($mostrar['fecha']);?></td>
<td>Hora:<?php echo substr("$mostrar[horario]", 0, -3)."hs";?></td>
	</tr>
    <tr>
    	<td>Origen:<?php echo $mostrar['origen']; ?></td>
    	<td>Destino:<?php echo $mostrar['destino']; ?></td>
    </tr>
			</tbody>
	</table>
		
	</div>

</article>
	<?php } ?>
</section>

<?php

include('footer.php');
mysqli_close($link);
 ?>
 </body>
 </html>