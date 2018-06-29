<?php
 include('header.php'); 
 //obtengo la id del usuario que inicio la sesion
 $id = $verificar->id();  
//llamo a la funcion de la fecha
 include('funcion_fecha.php');
 //hago consulta (1) para obtener los vehiculos pertenecientes al usuario en secion
 $consulta1 = ("SELECT * FROM vehiculo WHERE usuario_id = $id"); 

//hago una consulta (2) para obteber todos los viajes
 $fecha_act=date('Y-m-d');
 $hora_act=date('H:i:s');
 $consulta2= ("SELECT * FROM viajes WHERE ((fecha > CURDATE() AND activo = 1 ) or (fecha = CURDATE() AND horario >= CURTIME() AND activo = 1 )) ");
 //ejecuto la consulta (2) y lo guardo en la variable resultado
 //------------Busqueda----------

$parametro=" ";//Guarda los parametros recibidos para la siguiente pagina
$sql2=" ";//para concatenar el de busqueda 
$minimo=$maximo=$origen=$destino=$fecha_min=$fecha_max=$fecha_asc=$fecha_desc="";

if (isset($_GET['buscar'])) {
	$sql2.=" AND 1=1  ";

	if (isset($_GET['origen']) && $_GET['origen']!="") {
		$origen=$_GET["origen"];
			$sql2.= " AND origen LIKE '%$origen%'  ";
			$parametro.= "origen=".$_GET["origen"]."&";
	}

	if (isset($_GET['destino']) && $_GET['destino']!="") {
		$destino=$_GET["destino"];
			$sql2.= " AND destino LIKE '%$destino%'  ";
			$parametro.= "destino=".$_GET["destino"]."&";

	}

	if (isset($_GET['minimo']) && $_GET['minimo']!="" && empty($_GET['maximo'])) {
		$minimo=$_GET["minimo"];
			$sql2.= " AND (costo div (copilotos +1)) <= $minimo  ";

			$parametro.= "minimo=".$_GET["minimo"]."&";
	}
	if (isset($_GET['maximo']) && $_GET['maximo']!="" && empty($_GET['minimo'])) {
		$maximo=$_GET["maximo"];
			$sql2.= " AND (costo div (copilotos +1)) >= $maximo  ";

			$parametro.= "maximo=".$_GET["maximo"]."&";
	}
	if (isset($_GET['minimo']) && !empty($_GET['minimo']) && isset($_GET['maximo']) && !empty($_GET['maximo'])) {
			$maximo=$_GET["maximo"];
			$minimo=$_GET["minimo"];
			$sql2.= " AND (costo div (copilotos +1)) BETWEEN $minimo AND $maximo  "; 
			$parametro.="minimo".$_GET["minimo"]."&";
			$parametro.="maximo=".$_GET["maximo"]."&";
			
	}
	//--------busqueda por fecha

	if (isset($_GET['fecha_min']) && $_GET['fecha_min']!="" && empty($_GET['fecha_max'])) {
		$fecha_min=$_GET["fecha_min"];
			$sql2.= " AND fecha <= '$fecha_min'  ";

			$parametro.= "fecha_min=".$_GET["fecha_min"]."&";
	}
	if (isset($_GET['fecha_max']) && $_GET['fecha_max']!="" && empty($_GET['fecha_min'])) {
		$maximo=$_GET["fecha_max"];
			$sql2.= " AND fecha >= '$fecha_max'  ";

			$parametro.= "fecha_max=".$_GET["fecha_max"]."&";
	}
	if (isset($_GET['fecha_min']) && !empty($_GET['fecha_min']) && isset($_GET['fecha_max']) && !empty($_GET['fecha_max'])) {
			$fecha_max=$_GET["fecha_max"];
			$fecha_min=$_GET["fecha_min"];
			$sql2.= " AND fecha BETWEEN '$fecha_min' AND '$fecha_max'  "; 
			$parametro.="fecha_min".$_GET["fecha_min"]."&";
			$parametro.="fecha_max=".$_GET["fecha_max"]."&";
			
	}


	if(isset($_GET["ordenar"]) && $_GET["ordenar"]!='' && $_GET["ordenar"]!="0"){
		$parametro.="ordenar=".$_GET["ordenar"]. "&";

		switch ($_GET["ordenar"]) {
			case "fecha_asc":
					
				$sql2.=" ORDER BY fecha ASC ";
				$fecha_asc="selected";
					
				break;
				
			case "fecha_desc" :
				$sql2.=" ORDER BY fecha DESC ";
				$fecha_desc="selected";

				break;	
	
			}	
		}




	


	$parametro.="&buscar=&";
}




 
//Paginado---------------------------


if(isset($_GET["pag"])){
			$pag=$_GET["pag"];
			$pag_actual=$_GET["pag"];;
			$pag=(($pag -1) * 10);//cantidad de viajes a mostros
			$otra = $sql2;
			$sql2.=" LIMIT $pag,10 ";

		} else{
			$pag_actual=1;
			$otra = $sql2;//limitador de la cantidad de viajes a mostrar
			$sql2.=" LIMIT 0,10 ";
			}
			

$resultado2 = mysqli_query($link, $consulta2.$sql2);
//echo $consulta2.$sql2;
//Paginado-----------------------------------------------------------------------------------------

			//form de busqueda
?>
<div style="background-color:rgba(255, 255, 255, 0.5); padding: 1%;">
<p class="title_fv color-a " style="margin-left: 1.5%">Busqueda:</p class="title_fv">
<form action="inicio.php" method="GET" class=" form-busqueda ">

	<label for="origen">Por:</label>
	<input name="origen" value="<?php echo $origen; ?>"  class="input-busqueda" type="text" placeholder="origen" id="origen" name="origen">

	<label for="destino">a:</label>
	<input name="destino" value="<?php  echo $destino; ?>"  class="input-busqueda"type="text" placeholder="destino" id="destino" name="destino">

	<label for="precio">Precio</label>
	<input name="minimo" value="<?php  echo $minimo; ?>" class="input-bn"  type="number" min="0" name="precio1" placeholder="minimo">

	<label for="precio2">a:</label>
	<input name="maximo" value="<?php echo $maximo ?>" class="input-bn"  type="number" min="0" name="precio2" placeholder="maximo">


	<label for="fecha1">De</label>
	<input name="fecha_min" value="<?php  echo $fecha_min; ?>" class="input-busqueda" type="date" id="fecha1" name="fecha1">

	<label for="fecha2">a:</label>
	<input name="fecha_max" value="<?php echo $fecha_max; ?>" class="input-busqueda" type="date" name="fecha2" id="fecha2">
	<br>
	<br>

	<label>Ordenar por fecha:</label>
	<select name="ordenar" style="padding: 5px">
		<?php $selected=""; ?>
		<option value="0">sin orden</option>
		<option <?php echo $fecha_asc; ?> value="fecha_asc">ascendente</option>
		<option <?php echo $fecha_desc; ?> value="fecha_desc">descentente</option>

	</select>


	<button type="submit" name="buscar" class="btn_filtro ">Aplicar</button>

</form>

</div>


<div class="div_incio" >
 <?php
//carteles ----------------------------------------------------------------------------
 //(1)si ya esta postulado o se postula muestra un mje informando exito o error 
if (isset($_SESSION['mensaje'])) { ?>
	<div class="cartel div-externo"  id="cartel">
		<div class="div-interno " style="margin-top: 10%;">
	  		<p style="text-align: center; color: white; font-style: italic;"><?php echo $_SESSION['mensaje']; unset($_SESSION['mensaje']); ?></p>
	    </div>
	    <div class="div-bttn-ok"">
	    	<a class="a-link2  fondo-blue " style="margin-left: 1%; margin-top: 0%;" id="cerrar" href=""> Ok</a>
	    </div>
	</div>
<?php } ?>
<!--fin cartel (1)-->

<?php
//cartel (2)-----------------------------------------------------------------
//si se quiere borrar una publicacion que tiene postulantes.
if (isset($_SESSION['confirmacion'])) {$a = 1?>

	<div class="cartel div-externo"  id="cartel">
		<div class="div-interno " style="margin-top: 10%;">
	  		<p style="text-align: center; color: white; font-style: italic;"> <?php echo $_SESSION['confirmacion']; unset($_SESSION['confirmacion']); ?></p>
	    </div>
	    <div class="div-bttn-ok" style=" margin-top: 10%;">
	    	<a class=" a-link2  fondo-blue" style="margin-top: 100%;" href="baja_publicacion.php?id_viaje=<?php echo $_GET['viaje_id'] ?>&respuesta=<?php echo $a ?>"> Ok</a>
	    	<a class=" a-link2  fondo-blue" id="cerrar" href="">Cancelar</a>
	    </div>
	</div>

<?php } 
//--fin cartel (2)------------------------------------------------------------
?>
<?php 
//cartel (3)---------------------------------------------------------------------
//si el viaje se vencio (fecha y hora menores a la actual)
if (isset($_SESSION['expiro'])) { ?>

	<div class="cartel div_externo" id="cartel">
		<div class="div_interno ">
	  		<p style="text-align: center; color: white; font-style: italic;"> <?php echo $_SESSION['expiro']; unset($_SESSION['expiro']); ?></p>
	    </div>
	    <div class="boton">
	    	<a id="cerrar" href=""> Ok</a>
	    </div>
	</div>
<?php } 
//------------------cartel de aceptar un postulante
?>
<?php
//cartel (4)-----------------------------------------------------------------
//un postulante se da de baja
if (isset($_SESSION['confirmacion2'])) {$a = 1?>

	<div class="cartel div-externo"  id="cartel">
		<div class="div-interno " style="margin-top: 10%;">
	  		<p style="text-align: center; color: white; font-style: italic;"> <?php echo $_SESSION['confirmacion2']; unset($_SESSION['confirmacion2']); ?></p>
	    </div>
	    <div class="div-bttn-ok" style=" margin-top: 10%;">
	    	<a class=" a-link2  fondo-blue" style="margin-top: 100%;" href="baja_postulacion.php?id_viaje=<?php echo $_GET['viaje_id'] ?>&respuesta=<?php echo $a ?>"> Ok</a>
	    	<a class=" a-link2  fondo-blue" id="cerrar" href="">Cancelar</a>
	    </div>
	</div>
<?php

 }?>

<?php
//si no hay viajes, muestro un mensaje, caso contrario muestro los viajes disponibles.
if ((mysqli_num_rows($resultado2) == 0 )) { ?>
	  	<div  class="centrar" style="width: 40%;">
  			<article class="article_interior" >
  				<h4 class="origen_destino centrar" style="width: 80%">Sin publicaciones por el momento</h4>
  		</article>
  	</div>
<?php	}else{ 

//----------form de busqueda

	?>





 <?php 

 //(while) voy obteniendo los datos de cada fila correspondiente a los viajes
 while ($fila = mysqli_fetch_array($resultado2)) { 		?>
 	 	
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
		<?php } ?>

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
		    	 	<p  class="p-perfil p-left " style="font-style: italic;">Duracion: <?php echo $fila['duracion']."Hs - ".$fila['minutos']." minutos"; ?>	
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
		    		<p class="p-perfil p-left " style="font-style: italic;">Precio: $<?php echo floor($fila['costo'] / ($asientos['asientos'] + 1));  ?>
		    		</p>

		    	</td>	
		    	<td class="p-perfil p-left " style="font-style: italic;">Fecha de viaje: <?php
		    	
			echo fecha_string ($fila['fecha']);
		    	 ?>
		    	</td>
		    	<td>
		    		<p  class="p-perfil p-left" style="border:5 solid pink;" style="font-style: italic;">     Hora: 
             		 <?php 
                 		$elimina_segundos=substr("$fila[horario]", 0, -3);
                 		echo $elimina_segundos;
                 	 ?> Hs
		    	  </p>
		    	</td>	    	
		    </tr>
		</table>
	    </article>	
	    <table>	 
			<tr>

		   		 <td class="Td-a" >
		    		<a class="a-link2 a-rig fondo-blue"  href="detalle_viaje.php?id_viaje=<?php echo $fila['id'] ?>">Detalles 
		    		</a>
		    	</td>

					<?php 
						 $pertenece = false;	
						 //la siguiente consulta es para saber si hay postulantes para la publicacion
						 $consulta6 = "SELECT * FROM postulantes WHERE (viaje_id = $fila[id]) AND (estado = 1) AND (rechazado = 0 OR rechazado = 2)";
						 $resultado6 = mysqli_query($link, $consulta6 );
						 $cantidad = mysqli_num_rows($resultado6);
						 //ejecuto la consulta (1)
					     $resultado1 = mysqli_query($link, $consulta1);
					     //(while) verifico si el id del vehiculo de la publicacion actual coincide con un vehiculo del usuario en sesion.
						while ( $user = mysqli_fetch_array($resultado1)){
						  //(if) si conciden agrego la opcion modificar a la publicacion			
 			              if (($fila['vehiculo_id'] == $user['id'])) {
 			              	$pertenece = true;
 			              	if ($cantidad == 0) {			              	
					?>
							<td class="Td-a">
						       <a class="a-link2 a-rig fondo-blue " href="modificar_viaje.php?id_vehiculo=<?php  echo $fila['vehiculo_id'];?>&id_viaje=<?php echo $fila['id']; ?>&cantidad=<?php echo $cantidad ?> ">Modificar
						       </a>
						    </td>  
				    <?php  }else{ ?>
							<td class="Td-a">
						       <a class="a-link2 a-rig fondo-blue " href="modificar_viaje.php?id_vehiculo=<?php  echo $fila['vehiculo_id'];?>&id_viaje=<?php echo $fila['id']; ?>&cantidad=<?php echo $cantidad ?> ">Modificar
						       </a>
						    </td>
				    		<?php	}
						  }
						} 
					 if ($pertenece == true) { ?>
						<td class="Td-a">
						   	<a class="a-link2 a-rig fondo-blue " href="Postulantes.php?id_viaje=<?php echo $fila['id'] ?>&origen=<?php echo $fila['origen'] ?>&destino=<?php echo $fila['destino']?> ">Postulantes
						   	</a>
						</td>
						<td class="Td-a">
						   	<a class="a-link2 a-rig fondo-blue " href="baja_publicacion.php?id_viaje=<?php echo $fila['id'] ?>"> Eliminar </a>
						</td>
						<?php
						  $consulta7 = "SELECT * FROM postulantes WHERE (viaje_id = $fila[id] ) AND (estado = 1) AND (visto = 0)";
							$resultado7 = mysqli_query($link,$consulta7);
							$fila7 = mysqli_num_rows($resultado7);
							if ($fila7 > 0) { ?>
								<div style="float: right; margin-top: -16.5%;">
								<p class="parrafo" style="font-style: italic;"> (Nuevo postulante) </p>
								</div>
		
							<?php }?>
					<?php }?>
					<!--la sigueinte consulta es para saber si esta postulado y en tal caso no mostrar el boton postularse --> 
					<?php
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
				 <?php } ?>
		      </tr>	
		   </table>
      </p>
	</article>

<?php } ?> 

	<?php 
	//------------------------------------------------

	$sql_pag= ("SELECT COUNT(id) AS numero FROM viajes WHERE ((fecha > CURDATE() AND activo = 1 ) or (fecha = CURDATE() AND horario >= CURTIME() AND activo = 1 )) ");

			$resul= mysqli_query($link,$sql_pag.$otra);
			$pagina=mysqli_fetch_array($resul);
			$total_pag= ceil( $pagina["numero"] / 10);
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
						<a  href="inicio.php?<?php echo $parametro."pag=".$prevpage;?>">«Anterior </a>
					</li>
					<?php }
					if ($total_pag > 1) {
					 	
					 ?>

			<li><a class="active" href="#"><?php echo $pag_actual;?></a></li>


		 	<?php
		 	 }
		 	 if ($pag_actual < $total_pag) { ?>
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