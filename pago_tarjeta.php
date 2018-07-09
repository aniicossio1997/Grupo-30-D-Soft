<?php
include('header.php');
//solo hay que validar si la tarjeta es valida.. que complete DNI.. NOMBRE APELLIDO... CLAVE DE LA TARJETA, number DE LA TARJETA
?>
<form class="f1_pago" id="validar_tarjeta" method="POST" action="alta_postulacion.php">
	<article class="caja_p linea_2" >
		<div class="titulos">
	         <b class="color-a title-fv in_p" style="margin-top: 5%;">Datos de la tarjeta</b>
	    </div>
		<div class="centrar_div">
			<label class="text">Nro de tarjeta: </label>
			<span id="error_nro_tarjeta" class="error"></span>
			<input class="input s1 top focus_azul" id="nro_tarjeta" type="text" pattern="[0-9]{16}" title="complete con un numero de 16 digitos numericos" >	
		</div>
		<div class="centrar_div" style="margin-top: -4%">
			<label class="text">Clave de seguridad: </label>
			<span id="error_clave" class="error"></span>
			<input class="input s1 top focus_azul" type="password" name="clave" id="clave" min="0">
		</div>
		<div>
			<label class="text" for="">Fecha de vencimiento:</label>
			<span id="msj_fecha" class="error" ></span>
			<input id="fecha" class="input s1 top focus_azul" type="date">
		</div>
	</article> 
	<article class="caja_p linea_2" style="margin-top: 1%">
		<div class="titulos">
	         <b class="color-a title-fv in_p" style="margin-top: 5%;">Datos del titular</b>
	    </div>
		<div class="centrar_div">
			<label class="text">Nombre: </label>
			<span id="error_nombre" class="error"></span>
			<input class="input s1 top focus_azul" id="nombre" type="text" >	
		</div>
		<div class="centrar_div">
			<label class="text">Apellido: </label>
			<span id="error_apellido" class="error"></span>
			<input class="input s1 top focus_azul" id="apellido" type="text">	
		</div>
		<div class="centrar_div" style="margin-top: -4%">
			<label class="text">DNI: </label>
			<span id="error_dni" class="error"></span>
			<input class="input s1 top focus_azul" type="text" pattern="[0-9]{8}" title="complete con un numero de 8 digitos numericos" name="clave" id="dni">
			<input type="hidden" name="id_viaje" value=" <?php echo $_GET['id_viaje']; ?>">

			<input type="hidden" name="id" value="<?php echo $_GET['id'] ?>">
		</div>

		  
	</article> 
	<br>
	<div style="width: 85%; margin: 0 auto;">
		<button  style="margin-bottom: 2%; display: block;" class=" btn btn-primary "  type="submit">Enviar</button>
	
  <a class=" btn btn-danger " style="background-color:#CB030E;"  href="inicio.php">Cancelar</a></div>

</form>

<br>
<br>

<?php
include('footer.php');

mysqli_close($link);
?>
<script type="text/javascript" src="js/validar_tarjeta.js"></script>
</body>
</html>