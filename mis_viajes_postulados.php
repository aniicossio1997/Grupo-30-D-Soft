<?php include('header.php');
$id=$verificar->id();

$viajes="SELECT p.postulante_id, p.estado, p.rechazado, p.viaje_id, v.id, v.origen,v.destino,v.fecha,v.horario,v.duracion,v.minutos,v.costo,v.copilotos,v.activo From postulantes p INNER JOIN viajes v ON (p.viaje_id=v.id) WHERE p.postulante_id=$id AND p.estado=1  ";



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
			$fecha_act=date('Y-m-d');
			$sql2.=" AND (p.rechazado = 0 AND v.fecha >= '$fecha_act' AND v.activo= 1)";
			$parametro.= "tipos=".$_GET['tipos']."&";

		}
		if ($_GET['tipos']==3) {
			//rechazado
			$fecha_act=date('Y-m-d');
			$sql2.=" AND (p.rechazado = 1 OR v.fecha < '$fecha_act' OR v.activo= 0 OR v.activo=2 ) AND p.rechazado <> 2";
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
<form action="mis_viajes_postulados.php" class="form_copi" method="GET">
	<div class="container_form">
		<p class="title_fv color-a ">Mis Postulaciones</p class="title_fv">
		
ver:
<select name="tipos" class="fv_tipos">
	<option value="0" selected="selected">Todos</option>
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
				
					<?php  
					$consulta1 = "SELECT  rechazado FROM postulantes WHERE (viaje_id = $mostrar[id]) AND (postulante_id = $id)";
					$resultado1 = mysqli_query($link,$consulta1);
					$fila1 = mysqli_fetch_array($resultado1);

					$consulta2 = "SELECT DISTINCT (ve.usuario_id) FROM vehiculo ve INNER JOIN viajes vi on(ve.id = vi.vehiculo_id) INNER JOIN postulantes p on(p.viaje_id = vi.id) WHERE p.postulante_id = $id";
					$resultado2 = mysqli_query($link,$consulta2);
					$fila2 = mysqli_fetch_array($resultado2);

					if ($fila1['rechazado'] == 2) { ?>
						<a class="a-link2  fondo-blue a-rig corec" href="mi_perfil2.php?id_pos=<?php echo $fila2['usuario_id'] ?>">Informacion del piloto</a>
					<?php }
					 ?>
		<p>

			Estado:<?php
			$fecha_act=date('Y-m-d');

			 if (($mostrar['rechazado']==1 || $mostrar['activo']==2 || $mostrar['fecha'] < $fecha_act) && $mostrar['rechazado']!=2 ) {
				echo "Rechazado";
			}if ($mostrar['rechazado']==0 && $mostrar['estado']==1 && $mostrar['fecha']> $fecha_act ) {
				echo "En espera";
			}else{

				if ($mostrar['rechazado']==2 AND $mostrar['estado']==1) {
					echo "Aceptado";
				}
			} ?></p>
		<p>
			Origen:<?php echo $mostrar['origen'];?>
		</p>

		<p>
			Destino:<?php echo $mostrar['destino'];?>
		</p>
		
		<p>

			Fecha: 
			<?php 
				setlocale(LC_ALL,"es_ES@euro","es_ES","esp");
				$fecha = strftime("%d de %B de %Y", strtotime("$mostrar[fecha]"));
				echo $fecha;
			?>
		</p>

		<p>

			Horario:<?php
			$elimina_segundos=substr("$mostrar[horario]", 0, -3);
			//se elimina los segundos
			 echo $elimina_segundos;
			 ?>
		</p>

<a class="a-link2 a-rig fondo-blue a-rig" href="baja_postulacion.php?id_viaje=<?php echo $mostrar['id'] ?>"> Eliminar Postulacion</a>
		
		<p>
			Duración:<?php echo $mostrar['duracion']."hs - ".$mostrar['minutos']." minutos"; ?>
		</p>
		<p>Precio: <?php $precio=($mostrar['costo']/($mostrar['copilotos']+1));
		echo round($precio); ?></p>	
		<a class="color-a"  href="detalle_viaje.php?id_viaje=<?php echo $mostrar['id'] ?>">Ver más detalles...</a>
			
						



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
			 <div class="container_pag">
			 <ul class="pagination">
			 <?php 

			 if($pag_actual > 1) {?>
			 
					  <li>
						<a href="mis_viajes_postulados.php?<?php echo $parametro."pag=".$prevpage;?>">«Anterior </a>
					</li>
					<?php } ?>
			<li><a class="active" href="#"><?php echo $pag_actual;?></a></li>
		 	<?php
		 	 if ($pag_actual != $total_pag && $pag_actual < $total_pag) { ?>
			 	<li>
			 		<a href="mis_viajes_postulados.php?<?php echo $parametro."pag=".$nextpage;?>">Siguiente»</a>
			 	</li>			 
			<?php }
			 ?>
			 </ul>

			 </div>

			 <?php  }?>
			  <div style=" margin-top: 0.9%;width: 100%; box-sizing: border-box;" >
    <a style="margin-left:  45%;" class="a-link2 fondo-blue" href="<?=$_SERVER["HTTP_REFERER"]?>">Volver</a>
 </div>
<?php include('footer.php'); ?>
</body>
</html>