<?php
 include('header.php'); 
 //obtengo la id del usuario que inicio la sesion
 $id = $verificar->id();  
 //hago consulta (1) para obtener los vehiculos pertenecientes al usuario en secion
 $consulta1 = ("SELECT * FROM vehiculo WHERE usuario_id = $id"); 

//hago una consulta (2) para obteber todos los viajes
 $consulta2= ("SELECT * FROM viajes order by id desc");
 //ejecuto la consulta (2) y lo guardo en la variable resultado
 
//Paginado---------------------------
$sql2="";
$parametro="";
if(isset($_GET["pag"])){
			$pag=$_GET["pag"];
			$pag_actual=$_GET["pag"];;
			$pag=(($pag -1) * 4);//cantidad de viajes a mostros
			$otra = $sql2;
			$sql2.=" LIMIT $pag,4 ";

		} else{
			$pag_actual=1;
			$otra = $sql2;//limitador de la cantidad de viajes a mostrar
			$sql2.=" LIMIT 0,4 ";
			}
			
			$resultado2 = mysqli_query($link, $consulta2.$sql2);
//Paginda-----------------------------------------------------------------------------------------
?>


  	<h1 class="h1-form"> Publicaciones </h1> 
  	<br>
<div class="div_incio" >
 <?php

 //(1)si ya esta postulado o se postula muestra un mje informando exito o error 
if (isset($_SESSION['mensaje'])) { ?>

	<div class="cartel div_externo" id="cartel">
		<span class="icon-checkmark2"></span>
		<div class="div_interno ">
	  		<p> <?php echo $_SESSION['mensaje']; unset($_SESSION['mensaje']); ?></p>
	    </div>
	    <div class="boton">
	    	<a id="cerrar" href=""> Ok</a>
	    </div>
	</div>

<?php } ?>
<!--fin (1)-->

<?php
//si se quiere borrar una publicacion que tiene postulantes.
if (isset($_SESSION['confirmacion'])) { ?>

	<div class="cartel div_externo" id="cartel">
		<span class="icon-checkmark2"></span>
		<div class="div_interno ">
	  		<p> <?php echo $_SESSION['cinfirmacion']; unset($_SESSION['confirmacion']); ?></p>
	    </div>
	    <div class="boton">
	    	<a id="cerrar" onclick="<?php $_SESSION['respuesta'] = 1;?> " href="baja_postulacion.php?id_viaje=<?php echo $fila['id'] ?>"> Ok</a>
	    	<a id="cerrar" href="">Cancelar</a>
	    </div>
	</div>

<?php } ?>



<?php
//si no hay viajes, muestro un mensaje, caso contrario muestro los viajes disponibles.
if ((mysqli_num_rows($resultado2) == 0 )) { ?>
	  	<div  class="centrar" style="width: 40%;">
  			<article class="article_interior" style="background-color: #D98880">
  				<h4 class="origen_destino centrar" style="width: 80%">Sin publicaciones por el momento</h4>
  		</article>
  	</div>
<?php	}else{ ?>

 <?php 

 //(while) voy obteniendo los datos de cada fila correspondiente a los viajes
 while ($fila = mysqli_fetch_array($resultado2)) { 
 	//si el viaje NO esta dado de baja procedo a mostrarlo.
 	if ($fila['baja'] == 0) { ?>
 	 
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
		   	 	<td >
		    	 	<p  class="p-perfil p-left " style="font-style: italic;">Duracion:<?php echo ($fila['duracion']); ?> Hs	
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
					     //(while) verifico si el id del vehiculo de la publicacion actual coincide con un vehiculo del usuario en sesion.
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
						    <td class="Td-a">
						    	<a class="a-link2 a-rig fondo-blue " href="baja_publicacion.php?id_viaje=<?php echo $fila['id'] ?>"> Eliminar </a>
						    </td>
				     <!--la sigueinte consulta es para saber si esta postulado y en tal caso no mostrar el boton postularse -->   
				    <?php }}
				     $consulta5 = "SELECT estado FROM postulantes WHERE (postulante_id = $id) AND (viaje_id = $fila[id])";
				     $resultado5 = mysqli_query($link,$consulta5);
				     $fila5=mysqli_fetch_array($resultado5);
					 if (($pertenece == false) && ($fila5['estado'] == 0)) {
				     ?>
  				    	<td class="Td-a" > 
		    				<a name="postularse" class="a-link2 a-rig fondo-blue"  href="alta_postulacion.php?id=<?php echo $id ?>&id_viaje=<?php echo $fila['id'] ?> ">Postularse 
		    				</a>
		    			</td>	
				 <?php }elseif (($pertenece == false) && ($fila5['estado'] == 1) ) {
				 	?>
				 	<td class="Td-a" >
				 			<a class="a-link2 a-rig fondo-blue" href="baja_postulacion.php?id_viaje=<?php echo $fila['id'] ?>"> Eliminar Postulacion</a>
				 	</td>
				 <?php } } ?>
		      </tr>	
		   </table>
      </p>
	</article>

<?php } ?> 

	<?php 
	//------------------------------------------------

	$sql_pag= "SELECT COUNT(id) AS numero FROM viajes p ".$otra ;
			$resul= mysqli_query($link,$sql_pag);
			$pagina=mysqli_fetch_array($resul);
			$total_pag= ceil( $pagina["numero"] / 4);
			//echo $pagina["numero"]."<br>";
			//echo $total_pag;

			if ($total_pag > 1) { ?>
				<div class="centrar">
			<?php 
			 $nextpage= $pag_actual +1;
			 $prevpage= $pag_actual -1;	 }?>
			 <ul class="pagination">
			 <?php 

			 if($pag_actual > 1) {?>
			 
					  <li>
						<a href="inicio.php?<?php echo $parametro."pag=".$prevpage;?>">«Anterior </a>
					</li>
					<?php } ?>
			<li><a class="active" href="#"><?php echo $pag_actual;?></a></li>
		 	<?php
		 	 if ($pag_actual != $total_pag) { ?>
			 	<li>
			 		<a href="inicio.php?<?php echo $parametro."pag=".$nextpage;?>">Siguiente»</a></li>
			 </ul>
			<?php }
			 ?>
			 </div> 
	<?php   }?> 
</div>
<?php 
include('footer.php');
 ?>
 <script type="text/javascript" src="js/cartel.js"></script>
</body>
</html>