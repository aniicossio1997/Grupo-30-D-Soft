<?php
 include('header.php'); 
 //obtengo la id del usuario que inicio la sesion
 $id = $verificar->id();  
 //hago consulta (1) para obtener los vehiculos pertenecientes al usuario en secion
 $consulta1 = ("SELECT * FROM vehiculo WHERE usuario_id = $id"); 


//hago una consulta (2) para obteber todos los viajes
 $consulta2= ("SELECT * FROM viajes");
 //ejecuto la consulta (2) y lo guardo en la variable resultado
 $resultado2 = mysqli_query($link, $consulta2);
?>

  	<h1 class="h1-form"> Publicaciones </h1> 
  	<br>
<div class="scrollable div_incio" >
 <?php
 //(while) voy obteniendo los datos de cada fila correspondiente a los viajes
 while ($fila = mysqli_fetch_array($resultado2)){ ?> 
 	<article class="article_exterior">
 		<p class="text_center">
		<?php
	  		$consulta3 = ("SELECT usuario_id FROM vehiculo where id = $fila[vehiculo_id]");
	  		$resultado3 = mysqli_query($link,$consulta3);
	  		$id_user= mysqli_fetch_array($resultado3);
	  		$consulta4 = ("SELECT nombre from usuarios where id = $id_user[usuario_id]");
	  		$resultado4 = mysqli_query($link, $consulta4);
	  		$nombre = mysqli_fetch_array($resultado4);
		?>
		<?php
	 		if ($id_user['usuario_id'] == $id) {
	 	?>
			<p style="font-style: italic; color: #FDFEFE;">Publicador: Tú </p> 
		<?php }else{ 
		?>
		<p style="font-style: italic; color: #FDFEFE">Publicador: <?php echo $nombre['nombre']; ?></p>
		<?php } 
		?>
	  	<article class="mis_vehiculos" style="width: 97%;">	
		<table class="tabla" >
			<tr>
				<td class="td-p">
					<p class="p-perfil p-left" style="font-style: italic;">Origen: <?php echo ($fila['origen']); ?>
					</p>
				</td>
		   	 	<td >
		    	 	<p  class="p-perfil p-left " style="font-style: italic;">Destino: <?php echo ($fila['destino']); ?>		
		    	 	</p>
		    	</td>
		    </tr>
		    <tr>		    
		    	<td class="td-p"> 
		    		<?php
		    		 $consultaV = ("SELECT asientos FROM vehiculo where id = $fila[vehiculo_id]");
		    		 $resultadoV = mysqli_query($link,$consultaV);
		    		 $asientos = mysqli_fetch_array($resultadoV);
		    		 ?>
		    		<p class="p-perfil p-left " style="font-style: italic;">Precio: $<?php echo round($fila['costo'] / ($asientos['asientos'] + 1));  ?>
		    		</p>
		    	</td>	
		    	<td class="p-perfil p-left " style="font-style: italic;">Fecha de viaje: <?php echo ($fila['fecha']); ?>
		    	</td>	    	
		    </tr>
		</table>
	    </article>	
	    <table>	 
			<tr>

		   		 <td class="Td-a" >
		    		<a class="a-link2 a-rig fondo-blue"  href="">Detalles 
		    		</a>
		    	</td>

					<?php 
						 $pertenece = false;
						 //ejecuto la consulta (1)
					     $resultado1 = mysqli_query($link, $consulta1);
					     //(while) verifico sin el id del vehiculo de la publicacion actual coincide con un vehiculo del usuario en sesion.
						while ( $user = mysqli_fetch_array($resultado1)){
						  //(if) si conciden agrego la opcion modificar a la publicacion				
 			              if ($fila['vehiculo_id'] == $user['id']) {
 			              	$pertenece = true;
					?>
							<td class="Td-a">
						       <a class="a-link2 a-rig fondo-blue " href="">Modificar
						       </a>
						    </td>
						    <td class="Td-a">
						    	<a class="a-link2 a-rig fondo-blue " href="Postulantes.php?id_viaje=<?php echo $fila['id'] ?>&origen=<?php echo $fila['origen'] ?>&destino=<?php echo $fila['destino'] ?> ">Postulantes
						    	</a>
						    	
						    </td>      				
				    <?php }} if ($pertenece == false) {
				     ?>
  				    	<td class="Td-a" > 
		    				<a name="postularse" class="a-link2 a-rig fondo-blue"  href="alta_postulacion.php?id=<?php echo $id ?>&id_viaje=<?php echo $fila['id'] ?> ">Postularse 
		    				</a>
		    			</td>	
				 <?php }?>
		      </tr>	
		   </table>
      </p>
	</article>
<?php } ?> 
</div>
<?php
include('footer.php');
 ?>