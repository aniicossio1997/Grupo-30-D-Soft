<?php include('header.php');
$id=$verificar->id();

$viajes="SELECT p.postulante_id, p.estado, p.rechazado, p.viaje_id, v.id, v.origen,v.destino,v.fecha,v.horario,v.duracion,v.minutos,v.costo From postulantes p INNER JOIN viajes v ON (p.viaje_id=v.id) WHERE p.postulante_id=$id AND p.estado=1  ";



//-------------BUSCAR---------------------------------//
$parametro="";//Guarda los parametros recibidos para la siguiente pagina
$sql2="";//para concatenar el de busqueda 
$cal="";

if (isset($_GET['filtro'])) {
	if (isset($_GET['tipos']) && $_GET['tipos']|='' && $_GET['tipos']!="0") {
		if ($_GET['tipos']==1) {
			//aceptado
			$sql2.=" AND p.rechazado = 2 ";
			$parametro.= "tipos=".$_GET['tipos']."&";
		}
		if ($_GET['tipos']==2) {
			//en espera
			$sql2.=" AND p.rechazado = 0 ";
			$parametro.= "tipos=".$_GET['tipos']."&";
		}
		if ($_GET['tipos']==3) {
			//rechazado
			$sql2.=" AND p.rechazado = 1 ";
			$parametro.= "tipos=".$_GET['tipos']."&";
		}
		
			
	}



	$parametro.="&buscar=&";




}




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
$resul=mysqli_query($link,$viajes.$sql2);
?>
<form action="mis_viajes.php" class="form_copi" method="GET">
	<div class="container_form">
		<p class="title_fv color-a ">Mis viajes como copiloto</p class="title_fv">
		
ver solo los:
<select name="tipos" class="fv_tipos">
	<option value="0" selected="selected">--</option>
	<?php
	$aceptado="";
	$rechazado="";
	$espera="";
	if (isset($_GET['tipos']) && $_GET['tipos']!="0") {
		switch ($_GET['tipos']) {
			case '1':
				$aceptado="selected";
				break;
			case '2':
				$espera="selected";
				break;
			case '3':
					$rechazado="selected";
				break;
			
		}
	}
	?>
	<option <?php echo $aceptado; ?> value="1">Aceptados</option>
	<option <?php echo $espera; ?> value="2">En espera</option>
	<option <?php echo $rechazado; ?> value="3">Rechazados</option>
</select>

<button name="filtro" class="btn_filtro" type="submit" >Aplicar</button>
</div>
</form>


	<?php 
	if (mysqli_num_rows($resul) >0) { 
		
	while ($mostrar=mysqli_fetch_array($resul)) { ?>
		
			<article class="mis_vehiculos mod_art_viajes">
				<a class="a-link2 a-rig fondo-blue a-rig" href="baja_postulacion.php?id_viaje=<?php echo $mostrar['id'] ?>"> Eliminar Postulacion</a>
		<p>
			Origen:<?php echo $mostrar['origen'];?>
		</p>
		<p>
			Destino:<?php echo $mostrar['destino'];?>
		</p>
		<p>
			Fecha:<?php echo $mostrar['fecha'];?>
		</p>

		<p>

			Horario:<?php
			$elimina_segundos=substr("$mostrar[horario]", 0, -3);
			//se elimina los segundos
			 echo $elimina_segundos;
			 ?>
		</p>
		<a class="a-link2  fondo-blue a-rig corec"  href="detalle_viaje.php?id_viaje=<?php echo $mostrar['id'] ?>">Detalles...</a>

		<p>
			Duración:<?php echo $mostrar['duracion']."hs - ".$mostrar['minutos']." minutos"; ?>
		</p>	
			
		</div>


	</article>

	<?php }  }else{ ?>
	<article class="mis_vehiculos"><p class="text_center">
		Mis viajes...
	</p>
	<p class=" text_center msj_f1_email">Sin resultado...</p>

	</article>
	<?php } ?>



		<?php 

	$sql_pag= "SELECT COUNT(v.id) as numero From postulantes p INNER JOIN viajes v ON (p.viaje_id=v.id) WHERE p.postulante_id=$id AND p.estado=1 ".$otra;

			$resul= mysqli_query($link,$sql_pag);
			$pagina=mysqli_fetch_array($resul);
			$total_pag= ceil( $pagina["numero"] / 4);


			//echo $pagina["numero"]."<br>";
			

			if ($total_pag > 1) {

			 $nextpage= $pag_actual +1;
			 $prevpage= $pag_actual -1;	?>
			 <ul class="pagination">
			 <?php 

			 if($pag_actual > 1) {?>
			 
					  <li>
						<a href="mis_viajes.php?<?php echo $parametro."pag=".$prevpage;?>">«Anterior </a>
					</li>
					<?php } ?>
			<li><a class="active" href="#"><?php echo $pag_actual;?></a></li>
		 	<?php
		 	 if ($pag_actual != $total_pag && $pag_actual < $total_pag) { ?>
			 	<li>
			 		<a href="mis_viajes.php?<?php echo $parametro."pag=".$nextpage;?>">Siguiente»</a></li>
			 </ul>
			<?php }
			 ?>
			 
			 <?php  }?>







<?php include('footer.php'); ?>
</body>
</html>