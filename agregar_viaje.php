<?php
include('header.php');
$id= $verificar->id();

$consulta="SELECT id,marca,modelo,asientos FROM vehiculo WHERE usuario_id=$id AND activo=1 ORDER by marca ASC";
$resul=mysqli_query($link,$consulta);
$hay_autos=mysqli_num_rows($resul);


?>
<div class="conteiner-form">
	<h1 class="h1-form">Crear Viaje </h1>
		
		<form id="form_viaje" method="POST" action="validar_viaje.php">
	<div class="conteiner-f1">

		<?php if (isset($_SESSION['mensaje']) ){ ?>
				<div class="error_sql">
				<p class="p_msj_error"><span class="icon-checkmark"></span> <?php echo $_SESSION['mensaje'];?> </p>
			</div>
		<?php unset($_SESSION['mensaje']); }?>
		
	<div class="caja-viaje">
		<?php if ($hay_autos >0 ) { ?>
		<label for="vehiculo" class="">Seleccione un vehiculo su lista: </label><span class="msj-viaje" id="msj_vehi" ></span>
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
			Usted no posee vehiculos, cargue un nuevo vehiculo:
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
				<p class=" msj_f1_email ocultar " id="diario"> se crearan viajes para dias Lunes, Martes, Miercoles, Jueves y viernes</p></div>				
					
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
					
					<p class="msj_f1_email">Los viajes se crearan apartir de la semana se viene para 4 semanas</p>
						
					</div>
						
				<div class="caja-viaje ocultar " id="caja_oc">
					<label class="">Fecha</label><br>
					<input class="s1 top focus_azul" id="fecha" type="date" name="fecha"><span class="msj-viaje" id="msj_fecha"></span>		
				</div>
			
				<div class="caja-viaje">
					<label class="habilitar ">Horario de encuentro</label>
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
					<label>Duracion</label><span class="msj-viaje" id="msj_duracion"></span>	
					<input  class="input-f1 focus_azul" id="duracion" type="text" name="duracion"  min="0">
				</div>

				<div class="caja-viaje">
					<label>Descripción:</label>
					<textarea class="top focus_azul" name="descripcion"></textarea>
				</div>
				<button type="submit" class="input-f1 text-white fondo-blue btn-form"  name= "crear_viaje">Guardar Viaje</button>
			
			</div>
		</form>
	
</div>
<?php include('footer.php'); 
//
?>
<script type="text/javascript" src="js/validar_viajes.js"></script>


</body>
</html>
