
<?php
include("header.php");
$link=conectar();


//consulta para obtener la fecha y horario del viaje al que se quiere postular
$consulta_f= "SELECT fecha, horario FROM viajes where id = $_GET[id_viaje]";
$resultado_f = mysqli_query($link,$consulta_f);
$fila_f = mysqli_fetch_array($resultado_f);
//si el viaje expiro
if($fila_f['fecha'] < date("Y-m-d") OR ($fila_f['fecha'] == date("Y-m-d") && $fila_f['horario'] <= date("H:i:s"))){
	$_SESSION['mensaje'] = "Lo siento, el viaje ya expiro";
    header("Location: inicio.php");
    die();
}

if (isset($_GET['id_viaje'])) {
	$id_viaje = $_GET['id_viaje'];
	$origen = $_GET['origen'];
	$destino = $_GET['destino'];	
}elseif (isset($_SESSION['id_viaje'])) {
		$id_viaje = $_SESSION['id_viaje'];
		unset($_SESSION['id_viaje']);
}
$consulta = "SELECT * FROM viajes WHERE id = $id_viaje";
$resultado = mysqli_query($link,$consulta);
$fila = mysqli_fetch_array($resultado);
$consulta1 = "SELECT postulante_id,rechazado FROM postulantes WHERE (viaje_id = $id_viaje) AND (estado = 1) AND (rechazado = 0 OR rechazado = 2)";
$resultado1 = mysqli_query($link,$consulta1);


?>

  <?php
//carteles ---------------------------------------------------------------------------- 
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


<?php
//cartel (5)-----------------------------------------------------------------
//Rechazar un postulante
if (isset($_SESSION['confirmacion3'])) {$a = 1?>

	<div class="cartel div-externo"  id="cartel">
		<div class="div-interno " style="margin-top: 10%;">
	  		<p style="text-align: center; color: white; font-style: italic;"> <?php echo $_SESSION['confirmacion3']; unset($_SESSION['confirmacion3']); ?></p>
	    </div>
	    <div class="div-bttn-ok" style=" margin-top: 10%;">
	    	<a class=" a-link2  fondo-blue" style="margin-top: 100%;" href="rechazar_postulante.php?id_viaje=<?php echo $_GET['id_viaje'] ?>&respuesta=<?php echo $a ?>&id=<?php echo $_GET['id'] ?>"> Ok</a>
	    	<a class=" a-link2  fondo-blue" id="cerrar" href="">Cancelar</a>
	    </div>
	</div>
 <?php } ?>


<?php




//la siguiente consulta se realiza para saber la cantidad de postulantes aceptados por el publidor
$consulta3 ="SELECT * FROM postulantes WHERE (viaje_id = $id_viaje) AND (estado = 1) AND (rechazado = 2)";
$resultado3 = mysqli_query($link,$consulta3);
$fila3 = mysqli_num_rows($resultado3);

//la siguiente conulta se usa para obtener los id de postulante y poner el campo visto en 1
$consulta4 ="SELECT postulante_id FROM postulantes WHERE (viaje_id = $id_viaje) AND (estado = 1)";
$resultado4 = mysqli_query($link,$consulta4);
while ($fila4 =  mysqli_fetch_array($resultado4)) {
	$consulta5 = "UPDATE postulantes SET visto = 1 WHERE (viaje_id = $id_viaje) AND (postulante_id = $fila4[postulante_id])";
	$resultado5 = mysqli_query($link,$consulta5);
}
?>

<div class="fondo_gris">
		<p class="title_fv color-a  ">Listado de postulantes</p class="title_fv">
</div>
 
<div class=" div_incio">
	<h3 class="origen_destino">Origen: <?php echo $fila['origen']?>
	</h3>
	<h3 class="origen_destino">Destino: <?php echo $fila['destino'] ?> 
    </h3>
    <h3 class="origen_destino">Fecha de viaje: 
    	<?php 
    		echo fecha_string ($fila['fecha']);
         ?> 
    </h3>
    <h3 class="origen_destino"> Postulantes aceptados: <?php echo (0 + $fila3) ?> de <?php echo $fila['copilotos'] ?></h3>
 






  <?php  if ( $cantidad = mysqli_num_rows($resultado1) == 0){ ?>

  	<div  class="centrar" style="width: 40%;">
  		<article class="article_interior">
  		<h4 class="origen_destino centrar" style="width: 70%">Sin postulantes por el momento</h4>
  		</article>
  	</div>

  <?php }else { ?>

  <?php while ($fila1 = mysqli_fetch_array($resultado1)) { 

  	if ($fila1['rechazado'] == 0 OR $fila1['rechazado'] == 2  ) {
  ?>  
   <article class="article_exterior">
	<article class="article_interior" style="width: 100%;">
		<table class="tabla">
			<tr>
				<td>
					<?php
					  $consulta2 = "SELECT nombre FROM usuarios WHERE id = $fila1[postulante_id]";
					  $resultado2 = mysqli_query($link,$consulta2);
					  $fila2 = mysqli_fetch_array($resultado2);
					?>
					<p>Postulante: <?php echo $fila2['nombre'] ?> </p>
				</td>
				<td>
					<p>Calificcion: 0</p>
				</td>
			</tr>
			<tr>
				<td>
					<p></p>
				</td>
			</tr>
		</table>
	</article>
		<table>
			<tr class="Td-a" >
				<td></td>
				<td></td>
				<td class="Td-a">

					<?php if ($fila1['rechazado'] == 0) { ?>
					<a class="a-link2 a-rig fondo-blue" onmouseover="this.style.color='green'" onmouseout ="this.style.color='white'" href="aceptar_postulante.php?id_pos=<?php echo $fila1['postulante_id']?>&id_viaje=<?php echo $id_viaje;  ?>">Aceptar</a>
				<?php }else { ?>
					<a class="a-link2 a-rig fondo-blue" href="mi_perfil2.php?id_pos=<?php echo $fila1['postulante_id']?>&id_viaje=<?php echo $_GET['id_viaje']?>&origen=<?php echo $_GET['origen']?>&destino=<?php echo $_GET['destino']?>">Informacion del copiloto</a>
				<?php  }?>
				</td>				
				<td class="Td-a">
					<a class="a-link2 a-rig fondo-blue" onmouseover="this.style.color='red'" onmouseout ="this.style.color='white'" href="rechazar_postulante.php?id=<?php echo $fila1['postulante_id']?>&id_viaje=<?php echo $id_viaje ?>&origen=<?php echo $_GET['origen'] ?>&destino=<?php echo $_GET['destino']?>">Rechazar</a>
				</td>
			</tr>
		</table>
	</article>	
	</table>
	</article>
	<?php }  } } ?>

  </div>
  <div class="div_volver">
  		<a class="btton_volver a-link2  fondo-blue" href="inicio.php"> Volver </a>
  		
  </div>
<br>
<br>
<?php
   include("footer.php")
  ?>
    <script type="text/javascript" src="js/cartel.js"></script>
</body>
</html>
 