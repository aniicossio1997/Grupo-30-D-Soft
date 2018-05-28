<?php
date_default_timezone_set('America/Argentina/Buenos_Aires');

include('header.php');
?>
<div class="conteiner-form">
	<h1 class="h1-form">Crear Viaje </h1>
		
		<form id="form_viaje" method="get" action="validar_agregar.php">
		
			<div class="conteiner-f1">
				<div> 
				<label>Tipo de Viaje</label>
						   
						   <div>
						   	 <select name="varios" id="varios">
						   		<option  id="" value="0">Seleccione un tipo de viaje</option>
						   		<option  id="" value="ocasional">ocasional</option>
						   		<option  id="" value="diario">diario</option>
						   		<option  id="" value="semanal">semanal</option>
						   	</select>
						   </div>
						    <div id="msj" class="ocultar ">
						    	<label  class="label-f1" class="" id="dias"></label>
						    	<input  class="input-f1" class="" type="number" name="cantidad" min="1" id="cantidad">
						    	
						    </div>
						   
						
				</div>
						
				<div><label>Fecha</label>		
					<input class="input-f1" type="date" name="fecha" min="<?php echo date('Y-m-d');?>"value="<?php echo date('Y-m-d');?>">
				</div>
				<div>
					<label>Origen</label>
					<input class="input-f1" id="origen" type="text" name="origen">
				</div>
				<div><label>Destino</label>
					<input  class="input-f1" id="destino"type="text" name="destino" >
					</div>
				<div><label>Costo</label>
					<input  class="input-f1" id="costo" type="number" name="costo"  min="0">
					</div>
				<div><label>Duracion</label>
					<input class="input-f1" id="duracion" type="number" name="duracion"  min="0">
					</div>
				<div><label>Pasajeros</label>
					<input class="input-f1" id="duracion" type="number" name="pasajeros"  min="0">
				</div>
				<button type="submit" class="btn-img fondo-blue btn-a btn-form "  name= "crear_viaje">Publicar</button>
			</div>
		</form>
	
</div>
<?php include('footer.php'); ?>
<script type="text/javascript" src="js/validar_viajes.js"></script>
</body>
</html>
