<?php
include('header.php');
//solo hay que validar si la tarjeta es valida.. que complete DNI.. NOMBRE APELLIDO... CLAVE DE LA TARJETA, NUMERO DE LA TARJETA
?>
<h1 class="h1-form">Datos de la tarjeta de credito</h1> 
<form id="validar_tarjeta">
	<article class="article">
		<div class="titulos">
	         <b class="color-a title-fv" style="margin-top: 5%;">Datos de la tarjeta</b>
	    </div>
		<div class="centrar_div">
			<label class="text">Nro de tarjeta</label>
			<span id="error_nro_tarjeta" class="error"></span>
			<input class="input s1 top focus_azul" id="nro_tarjeta" type="NUMERO"><span class="	msj-viaje" id="msj_fecha"></span>	
		</div>
		<div class="centrar_div" style="margin-top: -4%">
			<label class="text">Clave de seguridad</label>
			<span id="error_clave" class="error"></span>
			<input class="input s1 top focus_azul" type="password" name="clave" id="clave">
		</div>
	</article> 
	<article class="article" style="margin-top: 1%">
		<div class="titulos">
	         <b class="color-a title-fv" style="margin-top: 5%;">Datos del titular</b>
	    </div>
		<div class="centrar_div">
			<label class="text">Nombre</label><br>
			<span id="error_nombre" class="error"></span>
			<input class="input s1 top focus_azul" id="nombre" type="NUMERO"><span class="	msj-viaje" id="msj_fecha"></span>	
		</div>
		<div class="centrar_div">
			<label class="text">Apellido</label><br>
			<span id="error_apellido" class="error"></span>
			<input class="input s1 top focus_azul" id="apellido" type="NUMERO"><span class="	msj-viaje" id="msj_fecha"></span>	
		</div>
		<div class="centrar_div" style="margin-top: -4%">
			<label class="text">DNI</label>
			<span id="error_dni" class="error"></span>
			<input class="input s1 top focus_azul" type="NUMERO" name="clave" id="dni">
		</div>
	</article> 
    <button  class="bttn text-white fondo-blue btn-form"  type="submit">Enviar</button>
</form>



<?php
include('footer.php');

mysqli_close($link);
?>
<script type="text/javascript" src="js/validar_tarjeta.js"></script>
</body>
</html>