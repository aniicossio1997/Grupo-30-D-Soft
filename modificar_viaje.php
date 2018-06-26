<?php
include('header.php');
$id= $verificar->id();

$sql="SELECT v.id,v.origen,v.destino, v.duracion,v.tipo, v.descripcion,v.minutos,v.costo, v.fecha,v.horario,ve.marca, ve.asientos,ve.modelo FROM viajes v INNER JOIN vehiculo ve ON(v.vehiculo_id=ve.id) WHERE v.id=$_GET[id_viaje]";
$datos_vie=mysqli_query($link,$sql);

$mostrar=mysqli_fetch_array($datos_vie);


$consulta="SELECT id,marca,modelo,asientos,activo FROM vehiculo WHERE usuario_id=$id AND activo=1 ORDER by marca ASC";
$resul=mysqli_query($link,$consulta);
$hay_autos=mysqli_num_rows($resul);





?>
<div class="conteiner-form">
	<h1 class="h1-form">Modificar Viaje </h1>
		
	<form id="form_viaje" method="POST" action="validar_modificar_viaje.php">
	<div class="conteiner-f1">



		<?php if (isset($_SESSION['mensaje_error'])) { ?>
		<div class="cartel_error " id="car_error">
			

			<span id="ok" class="icon-cancel-circle"></span>
			
			<p class="cartel_p">
				<span class="icon-warning "></span>
				<?php echo $_SESSION['mensaje_error']; ?>
			</p>

		</div>
		<?php unset($_SESSION['mensaje_error']); } ?>

		<?php if (isset($_SESSION['mensaje']) ){ ?>
			<div class="cartel_error cambiar_color " id="car_error">
			
			<span id="ok" class="icon-cancel-circle "></span>
				<p class="cartel_p"><span class="icon-checkmark "></span> <?php echo $_SESSION['mensaje']; ?></p>
			</div>

		<?php unset($_SESSION['mensaje']); }?>

	<div class="caja-viaje">
		<?php if ($hay_autos >0 ) { ?>
		<label for="vehiculo" class="">Seleccione un vehiculo de su lista: </label><span class="msj-viaje" id="msj_vehi" ></span>
		<br>
		<select name="vehiculo"class="s1 top focus_azul " id="vehiculo">
		<option value="0">---</option>
			<?php 
			$elegido=" ";


			while( $fila=mysqli_fetch_array($resul) ){
				if ($_GET['id_vehiculo']==$fila['id']) {
				$elegido="selected";
			}


				?> 
			<option <?php echo $elegido; ?> value="<?php echo $fila['id']; ?>">
				<?php echo $fila['marca'];?> -- Modelo:<?php echo $fila['modelo'];?>-- Capacidad:<?php echo $fila['asientos'];?>
			</option>
		 	<?php } ?>
		</select>
		
		<p class=" msj_f1_email " id="diario">
			Recuerde que si el vehiculo fue eliminado no se mostrara en la lista
		</p>
		<?php  }else{ ?> 
			<br>
			<div>
			Usted no posee vehiculos, cargue un  vehiculo:
			<a class="color-a" href="agregar_vehiculo_2.php"> Aqui</a>
			</div>
			 <?php } ?>

	</div>

						
		<div class="caja-viaje " id="caja_oc">
		<label class="">Fecha</label><br>
		<input class="s1 top focus_azul" id="fecha" type="date" name="fecha" value="<?php echo $mostrar['fecha'] ?>"><span class="msj-viaje" id="msj_fecha"></span>	
		<p class="msj_f1_email">*Recuerde los viajes se crean apartir de la fecha posterior a la actual </p>	
		</div>
			
				<div class="caja-viaje">
					<label class="habilitar ">Horario:</label>
					<input id="hora" class="s1 top focus_azul" type="time" class=" time" name="horario" title="El formato debe ser 12:00 pm o am respectivamente" value="<?php $elimina_segundos=substr("$mostrar[horario]", 0, -3);
			//se elimina los segundos
			 echo $elimina_segundos; ?>"><span class="msj-viaje" id="msj_hora"></span>
					
				</div>

				<div class="caja-viaje ">
					<label >Origen</label><span class="msj-viaje" id="msj_origen"></span>
					<input id="origen" class="input-f1 focus_azul" id="origen" type="text" name="origen" value="<?php  echo $mostrar['origen'];?>">	
				</div>

				<div class="caja-viaje">
					<label>Destino</label>
					<span class="msj-viaje" id="msj_destino"></span>
					<input  class="input-f1 focus_azul" id="destino" type="text" name="destino" value="<?php echo $mostrar['destino']; ?>">
					</div>
				<div class="caja-viaje">
					<label >Costo</label><span class="error" id="msj_costo"></span>
				<input  class="input-f1 focus_azul" step="0.01" id="costo" type="number" name="costo"  min="0" value="<?php echo $mostrar['costo']; ?>">
					
				</div>
				<div class="caja-viaje">
					
					<label>Duracion: </label>

					<input  class="input-f3 focus_azul" id="duracion" type="number" name="duracion"  min="0" value="<?php echo $mostrar['duracion']; ?>">
					<span>Hs--</span>
					
				<select name="minutos" id="minutos" class="min">
					<option value="90">--</option>
						<?php for ($i=0; $i <60 ; $i++) { ?>
							<?php  if ($i<10) { ?>
								<option <?php if ($mostrar['minutos']== $i) {
										echo "selected";
									} ?> value="<?php echo "0".$i;?>">
									<?php echo "0".$i; ?>
								</option>
							<?php }else {  ?>
								<option <?php if ($mostrar['minutos']== $i) {
										echo "selected";
									} ?> value="<?php echo $i; ?>"> 
									<?php echo $i; ?>
										
								</option>
					<?php }} ?>
				</select>
						<label for="minutos">Minutos</label>
						<p class="msj_f1_email">* No es necesario que complete ambos campos </p>
						<span class="msj-viaje" id="msj_duracion"></span>
				</div>
				<input type="hidden" name="id_viaje" value="<?php echo $mostrar['id']; ?>">
				<input type="hidden" name="id_vehiculo" value="<?php echo $mostrar['id']; ?>">

				<input type="hidden" name="id_pag" value="<?php echo $_GET['id_pag']; ?>">

				<div class="caja-viaje">
					<label >Descripción:</label>
					<p class="msj_f1_email">*opcional</p>
					<textarea class="top focus_azul" name="descripcion"><?php
						echo $mostrar['descripcion'];
					?></textarea>
				</div>
				<button type="submit" class="input-f1 text-white fondo-blue btn-form"  name= "crear_viaje">Guardar Viaje</button>
			
			</div>
		</form>
		
 <div style="margin-top: 2%;width: 100%;" >
    <a class="a-link2 fondo-blue" <?php if (isset($_GET['id_pag']) && $_GET['id_pag']=='mis_viajes') { ?> href="mostrar_viaje_piloto.php" <?php }else{ ?>  href="inicio.php"<?php }?> >Volver</a>
 </div>
	
</div>
<?php include('footer.php'); 
//

?>

<script type="text/javascript" src="js/validar_modificacion_viaje.js"></script>
</body>
</html>
