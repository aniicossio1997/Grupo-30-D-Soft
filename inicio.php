<?php
 include('header.php'); 
 //obtengo la id del usuario que inicio la sesion
 $id = $verificar->id();  
 //hago consulta (1) para obtener los vehiculos pertenecientes al usuario en secion
 $consul = ("SELECT id FROM vehiculo WHERE usuario_id = $id"); 

//hago una consulta (2) para obteber todos los viajes
 $consulta= ("SELECT * FROM viajes");
 //ejecuto la consulta (2) y lo guardo en la variable resultado
 $resultado = mysqli_query($link, $consulta);
?>

  	<h1 class="h1-form"> Publicaciones </h1> 
 <?php
 //(while) voy obteniendo los datos de cada fila correspondiente a los viajes
 while ($fila = mysqli_fetch_array($resultado)){ ?> 
 	<article class="mis_vehiculos"><p class="text_center">
	  <article class="mis_vehiculos">	
		<table class="tabla" >
			<tr>
				<td class="td-p">
					<p class="p-perfil p-left">Origen: <?php echo ($fila['origen']); ?>
					</p>
				</td>
		   	 	<td >
		    	 	<p  class="p-perfil p-left ">Destino: <?php echo ($fila['destino']); ?>
		    	 		
		    	 	</p>
		    	</td>
	   
		    </tr>
		    <tr>		    
		    	<td class="td-p"> 
		    		<p class="p-perfil p-left ">Precio: $<?php echo ($fila['costo']); ?>		
		    		</p>
		    	</td>		    	
		    </tr>		 
			<tr>
		   		 <td >
		    		<a class="a-link2 a-rig fondo-blue"  href="">Detalles 
		    		</a>
		    	</td>

					<?php 
						 $pertenece = false;
						 //ejecuto la consulta (1)
					     $resul = mysqli_query($link, $consul);
					     //(while) verifico sin el id del vehiculo de la publicacion actual coincide con un vehiculo del usuario en sesion.
						while ( $user = mysqli_fetch_array($resul) ){
						  //(if) si conciden agrego la opcion modificar a la publicacion				
 			              if ($fila['vehiculo_id'] == $user['id']) {
 			              	$pertenece = true;
					?>
							<td>
						       <a class="a-link2 a-rig fondo-blue " href="">Modificar
						       </a>
						    </td>
						    <td>
						    	<a class="a-link2 a-rig fondo-blue " href="">Postulantes
						    	</a>
						    </td>
		      </tr>	      				
				    <?php }} if ($pertenece == false) {
				     ?>
  				    	<td > 
		    				<a name="postularse" class="a-link2 a-rig fondo-blue" href="">Postularse 
		    				</a>
		    			</td>	
				 <?php }?>

		</table>
	</article>
	</p>

	</article>
<?php }
include('footer.php');
 ?>