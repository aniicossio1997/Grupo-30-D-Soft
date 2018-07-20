<?php 
include('header.php');
include('img.php');
include ('funcion_puntuacion.php');
$id=$verificar->id();


$consulta="SELECT c.viaje_id, COUNT(c.viaje_id) as numero, v.origen, v.destino,v.fecha, v.horario, c.es_sancion,c.es_piloto FROM calificacion c INNER JOIN viajes v ON (c.viaje_id=v.id) WHERE c.cumple=0 and c.calificador_id=$id and c.es_sancion=0 GROUP BY c.viaje_id";
#echo $consulta;

$resul=mysqli_query($link,$consulta);

?>
<section>
<?php
while ($mostrar=mysqli_fetch_array($resul)) { ?>

<article class="mis_vehiculos">

<table class="table" >
    <tbody>

    	<?php if ($mostrar['es_piloto']==1) { ?>
    	<?php $consulta2="SELECT u.nombre,u.apellido,u.id FROM usuarios u INNER JOIN calificacion c on(c.usuario_id=u.id) WHERE c.viaje_id=$mostrar[viaje_id] and c.calificador_id=$id and es_piloto=1 and cumple=0";
		#echo $consulta2;
		$resul2=mysqli_query($link,$consulta2);
		$mostrar2=mysqli_fetch_array($resul2);
		 ?>
    	<tr>
    		<td>
    			<p style="font-size: 1.2em"><b>Usted adeuda calificaión al piloto:</b></p></td>
    	</tr>
    	<tr style="border-bottom: 1px solid #ccc;">
    		<td><?php echo $mostrar2['nombre'].",".$mostrar2['apellido']; ?>
    			<p><form action="mi_perfil2.php" method="GET">
			<input type="hidden" name="id_pos" value="<?php echo $mostrar2['id']; ?>">
			<input type="hidden" name="pagina" value="<?php echo "calificaciones"; ?>">
			<button type="submit" class="btn btn-link">Más información..</button>
				 </form></p>
    		</td>
    		<td><?php echo puntuacion_piloto($link,$mostrar2['id']) ; ?></td> 
    		<td><a href="" class="btn btn-primary">calificar</a></td>
    	</tr>
    	<?php }else{  ?>
   <!-- - - - - - - -   - - - - - - - - - - - - - - - - - - -  -->
    	<tr>
    		<p style="font-size: 1.2em"><b >Usted adeuda calificaciones a : <?php echo " ".$mostrar['numero']; ?> copilotos
    	</b></p>
    	</tr>

  		<?php $consulta2="SELECT u.nombre,u.apellido,u.id FROM usuarios u INNER JOIN calificacion c on(c.usuario_id=u.id) WHERE c.viaje_id=$mostrar[viaje_id] and c.calificador_id=$id and es_piloto=0 and cumple=0";
		#echo $consulta2;
		$resul2=mysqli_query($link,$consulta2);
		while ($mostrar3=mysqli_fetch_array($resul2)) { ?>
			<div>
			<tr style="border-bottom: 1px solid #ccc;">
				<td>
				<?php echo $mostrar3['nombre'].",".$mostrar3['apellido']; ?>
				<p>
					<form action="mi_perfil2.php" method="GET">
			<input type="hidden" name="id_pos" value="<?php echo $mostrar3['id']; ?>">
			<input type="hidden" name="pagina" value="<?php echo "calificaciones"; ?>">
			<button type="submit" class="btn btn-link">Más información..</button>
				 </form>
				</p>	
				</td>
				<td>
				 <?php echo puntuacion_copiloto($link,$mostrar2['id']) ; ?>
				</td>
				<td>
					<a href="" class="btn btn-primary">Calificar</a>
				</td>
				
				
			</tr>

		<?php }
		 ?>


<?php } ?>
<tr><td><b>Datos del viaje:</b></td><td></td><td></td></tr>
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

</article>	

<?php }



?>
</section>
</body>
</html>