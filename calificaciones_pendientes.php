<?php 

include('header.php');
include('img.php');
$user_actual=$verificar->id();

$consulta="SELECT u.nombre,u.apellido, u.tipoimagen, u.contenidoimagen,u.fecha_nac,u.id , c.id as id_cal, c.es_piloto, v.fecha, v.horario,v.origen,v.destino FROM calificacion c INNER JOIN usuarios u ON (c.usuario_id=u.id) INNER JOIN viajes v on(v.id=c.viaje_id)  WHERE c.calificador_id=$user_actual AND c.cumple=0  ";


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

<table class="table" >

    <tbody>
      <tr>
        <td><img  class="img-circle alinear_cal img_cal " width="120px" height="120px" src="<?php if (hay_imagen($fila['id'],$link)){?>mostrar_imagen.php?id=<?php echo $fila['id'];?><?php }else{
								echo "fondos/user2.png";
							}
							?>" >
		</td>
        <td>
        	<p>Datos de la persona:</p>
			<p>Nombre: <?php echo $fila['nombre'];	?></p>
			<p>Apellido: <?php echo $fila['apellido']; ?></p>
			<p>Edad: <?php echo edad($fila['fecha_nac']); ?> años</p>

			<?php /*<a href="mi_perfil2.php?id_pos=<?php echo $fila['id'] ?>"> Mas información..</a></td>
 */ ?>
			
			<p><form action="mi_perfil2.php" method="GET">
			<input type="hidden" name="id_pos" value="<?php echo $fila['id']; ?>">
			<input type="hidden" name="pagina" value="<?php echo "calificaciones"; ?>">
			<button type="submit" class="btn btn-link">Más información..</button>
				 </form></p>

		<td>
			<p>Datos del viaje:</p>
			<p>Origen:<?php echo $fila['origen']; ?>
			</p>
			<p>Destino: <?php echo $fila['destino']; ?></p>
			<p>Fecha: <?php echo fecha_string($fila['fecha']); ?></p>
			<a href="">Más información..</a>

		</td>
        <td><?php if ($fila['es_piloto']==1) { ?>
		<a class="btn btn-primary" href="calificar_copiloto.php?user_a_cal=<?php echo $fila['id'];?>&id_cal=<?php echo $fila['id_cal']; ?> "> Calificar</a>
	<?php }else{ ?>
		<a class="btn btn-primary" href="calificar_piloto.php?user_a_cal=<?php echo $fila['id'];?>&id_cal=<?php echo $fila['id_cal']; ?>">Calificar</a>
			<?php } ?></td>
		</tr>
         
    </tbody>
  </table>


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