<?php
include('header.php');
$id= $verificar->id();

	$fecha_actual = date('Y-m-d');
	
	//resto 30 días de la fecha actual
	$fecha_actual=date("Y-m-d",strtotime($fecha_actual."- 30 days"));
	$chequeo_viajes="SELECT p.postulante_id, p.viaje_id, vi.id, vi.fecha, p.estado, p.rechazado FROM postulantes p INNER JOIN viajes vi ON (p.viaje_id=vi.id) INNER JOIN vehiculo ve ON (vi.vehiculo_id=ve.id) WHERE ve.usuario_id=$id AND  vi.fecha <= '$fecha_actual' AND p.estado=1 AND p.rechazado=2";	


	//realizo la consulta
	$resul=mysqli_query($link,$chequeo_viajes);
	//echo mysqli_num_rows($resul);
	if (mysqli_num_rows($resul)>0) {
		$_SESSION['mensaje']="Usted adeuda calificaciones, de hace mas de de 30 dias";
		header("Location: inicio.php");
		die();
	}
// se verifica si el usuario adeuda calificacines. 
$consulta_fecha = "SELECT viaje_id FROM postulantes where (postulante_id = $id) AND (rechazado = 2)";
$resultado_fecha = mysqli_query($link,$consulta_fecha);
while ($fila_fecha = mysqli_fetch_array($resultado_fecha)) {
	$consulta_viaje = "SELECT fecha FROM viajes where  (id = $fila_fecha[viaje_id]) and (fecha < CURDATE())";
	$resultado_viaje = mysqli_query($link,$consulta_viaje);
	$fila_viaje = mysqli_fetch_array($resultado_viaje);
	$fecha1 = new dateTime($fila_viaje['fecha']);
	$fecha2 = new dateTime(date("Y-m-d"));
	$diferencia = $fecha1->diff($fecha2);
	if ( $diferencia->days > 30){
			$_SESSION['mensaje'] = "Usted adeuda calificaciones";
			header("Location: inicio.php");
			die();
	}
}

$consulta="SELECT id,marca,modelo,asientos FROM vehiculo WHERE usuario_id=$id AND activo=1 ORDER by marca ASC";
$resul=mysqli_query($link,$consulta);
$hay_autos=mysqli_num_rows($resul);


?>


<!--  - - - - - - - - - - - - - - - - - -  -->

<?php  if (isset($_SESSION['mensaje_error']) ){ ?>
	<script type="text/javascript">
		activar_modal();
	</script>

	<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content" style="background-color: #D50404;">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h3 class="modal-title" style="color: #fff; text-align: center;">Se ha producido un mensaje_error</h3>
      </div>
      <div class="modal-body" style="color: #fff; border: none;">
        <p style="text-align: center;"><?php echo $_SESSION['mensaje_error']; ?></p>
      </div>
      <div class="modal-footer" style="border:none;">
        <button type="button" class="btn btn-defaul" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<?php  unset($_SESSION['mensaje_error']); }  ?>
<!-- - - - - - - - -  - - - - - - - - - ---->
<!-- - - - - - - - -  - - - - - - - - - ---->
<?php  if (isset($_SESSION['mensaje']) ){ ?>
	<script type="text/javascript">
		activar_modal();
	</script>

	<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content" style="background-color: #199D05;">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h3 class="modal-title" style="color: #fff; text-align: center;">Operación exitosa</h3>
      </div>
      <div class="modal-body" style="color: #fff; border: none;">
        <p style="text-align: center;"><?php echo $_SESSION['mensaje']; ?></p>
      </div>
      <div class="modal-footer" style="border:none;">
        <button type="button" class="btn btn-defaul" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>



<?php  unset($_SESSION['mensaje']); }  ?>






<div class="conteiner-form">
	<h1 class="h1-form">Crear Viaje </h1>
		
		<form id="form_viaje" method="POST" action="validar_viaje.php">
	<div class="conteiner-f1">

	<div class="caja-viaje">
		<?php if ($hay_autos >0 ) { ?>
		<label for="vehiculo" class="">Seleccione un vehiculo de su lista: </label><span class="msj-viaje" id="msj_vehi" ></span>
		<br>
		<select name="vehiculo"class="s1 top focus_azul " id="vehiculo">
		<option value="0">---</option>
			<?php 
			while( $fila=mysqli_fetch_array($resul) ){?> 
			<option value="<?php echo $fila['id']; ?>">
				<?php echo $fila['marca'];?> -- Modelo:<?php echo $fila['modelo'];?>-- Capacidad:<?php echo $fila['asientos'];?>
			</option>
		 	<?php } ?>
		</select>
		<?php  }else{ ?> 
			<br>
			<div>
			Usted no posee vehiculos, cargue un  vehiculo:
			<a class="color-a" href="agregar_vehiculo_2.php"> Aqui</a>
			</div>
			 <?php } ?>

	</div>


				<div class="caja-viaje"> 
				<label class="habilitar">Seleccione un tipo de viaje</label>
				 <select class="s1 top focus_azul"name="tipo" id="tipo">
						<option  id="0" value="0">----</option>
						<option  id="1" value="ocasional">ocasional</option>
						<option  id="2" value="diario">diario</option>
						<option  id="3" value="semanal">semanal</option>
				   	</select><span  class="msj-viaje" id="msj_tipo"></span>
				   	<br>
				<p class=" msj_f1_email ocultar " id="diario">Se crearan viajes para un aproximado a un mes, 25 dias (para los días lunes, martes, miércoles, jueves, vienes)</p></div>				
					
					<div id="msj_semanal" class="ocultar  caja-viaje">
					<label  class="habilitar"for="semanal">Dias</label>
					<select class="s1 top focus_azul" id="semanal" name="semanal">
						<option value="0">Elija un dia</option>
						<option value="1">Lunes</option>
						<option value="2">Martes</option>
						<option value="3">Miercoles</option>
						<option value="4">Jueves</option>
						<option value="5">Viernes</option>
						<option value="6">Sabados</option>
						<option value="7">Domingos</option>
					</select><span class="msj-viaje" id="msj_error_sem"></span>
					
					<p class="msj_f1_email">Los viajes se crearan apartir de la semana que viene, para 4 semanas</p>
						
					</div>
						
				<div class="caja-viaje ocultar " id="caja_oc">
					<label class="">Fecha</label><br>
					<input class="s1 top focus_azul" id="fecha" type="date" name="fecha"><span class="msj-viaje" id="msj_fecha"></span>	
					<p class="msj_f1_email">*Recuerde los viajes se crean apartir de la fecha posterior a la actual </p>	
				</div>
			
				<div class="caja-viaje">
					<label class="habilitar ">Horario:</label>
					<input id="hora" class="s1 top focus_azul" type="time" class=" time" name="horario" title="El formato debe ser 12:00 pm o am respectivamente"><span class="msj-viaje" id="msj_hora"></span>
					
				</div>

				<div class="caja-viaje ">
					<label >Origen</label><span class="msj-viaje" id="msj_origen"></span>
					<input id="origen" class="input-f1 focus_azul" id="origen" type="text" name="origen">	
				</div>

				<div class="caja-viaje">
					<label>Destino</label>
					<span class="msj-viaje" id="msj_destino"></span>
					<input  class="input-f1 focus_azul" id="destino" type="text" name="destino" >
					</div>
				<div class="caja-viaje">
					<label >Costo</label><span class="error" id="msj_costo"></span>
				<input  class="input-f1 focus_azul" step="0.01" id="costo" type="number" name="costo"  min="0">
					
				</div>
				<div class="caja-viaje">
					
					<label>Duracion: </label>

					<input  class="input-f3 focus_azul" id="duracion" type="number" name="duracion"  min="0">
					<label>Hs--</label>
					
						<select name="minutos" id="minutos" class="min">
							<option value="90">--</option>
						<?php for ($i=0; $i <60 ; $i++) { ?>
							<?php  if ($i<10) { ?>
								<option value="<?php echo "0".$i;?>">
									<?php echo "0".$i; ?>
								</option>
							<?php }else {  ?>
								<option value="<?php echo $i; ?>"> 
									<?php echo $i; ?>	
								</option>
						<?php }} ?>
						</select>
						<label for="minutos">Minutos</label>
						<p class="msj_f1_email">* No es necesario que complete ambos campos </p>
						<span class="msj-viaje" id="msj_duracion"></span>
				</div>

				<div class="caja-viaje">
					<label >Descripción:</label>
					<p class="msj_f1_email">*opcional</p>
					<textarea class="top focus_azul" name="descripcion"></textarea>
				</div>
				<button type="submit" class="input-f1 text-white fondo-blue btn-form"  name= "crear_viaje">Guardar Viaje</button>
			
			</div>
		</form>
	
</div>

<br>
<br>

<?php include('footer.php'); 
//

?>
<script type="text/javascript" src="js/validar_viajes.js"></script>

</body>
</html>
