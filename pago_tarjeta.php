<?php
include('conexion.php');
$link=conectar();
session_start();
include('clases.php');
$verificar = new validar($link);//se crea  una clase

$id= $verificar->id();
//solo hay que validar si la tarjeta es valida.. que complete DNI.. NOMBRE APELLIDO... CLAVE DE LA TARJETA, number DE LA TARJETA


//-----------------------------------------------
//consulta para que un coplito nose vuelva a postular a un viaje donde fue aceptado pero se dio de baja 
$consulta="SELECT * FROM calificacion WHERE usuario_id=$id AND es_sancion=1 and viaje_id=$_GET[id_viaje] and cumple=1";
$resul=mysqli_query($link,$consulta);

if (mysqli_num_rows($resul)>0) {
  $_SESSION['mensaje'] = "ERROR: Lo siento, no se puede volver a postular...Usted ya se postulo anteriormente, fue aceptado y se dio de baja";
    header("Location: inicio.php");
    die();
}


$fecha_actual=date('Y-m-d');
	$date = new DateTime($fecha_actual);

	$date->modify("next Monday");//avanzo al siguiente dia

	$fecha=$date->format('Y-m-d');
?>
<h1>Realizar Pago: </h1>
<form class="f1_pago" id="validar_tarjeta" method="POST" action="alta_postulacion.php">
	<article class="caja_p linea_2" >
		<div class="titulos">
	         <b class="color-a title-fv in_p" style="margin-top: 5%;">Datos de la tarjeta</b>
	    </div>
		<div class="centrar_div">
			<label class="text">Nro de tarjeta: </label>
			<span id="error_nro_tarjeta" class="error"></span>
			<input class="input s1 top focus_azul" id="nro_tarjeta" type="text" pattern="[0-9]{16}" title="complete con un numero de 16 digitos numericos" value="1234567812345678" >	
		</div>
		<div class="centrar_div" style="margin-top: -4%">
			<label class="text">Clave de seguridad: </label>
			<span id="error_clave" class="error"></span>
			<input class="input s1 top focus_azul" type="password" name="clave" id="clave" min="0" value="1234">
		</div>
		<div>
			<label class="text" for="">Fecha de vencimiento:</label>
			<span id="msj_fecha" class="error" ></span>
			<input id="fecha" class="input s1 top focus_azul" type="date" value="<?php echo $fecha ?>">
		</div>
	</article> 
	<article class="caja_p linea_2" style="margin-top: 1%">
		<div class="titulos">
	         <b class="color-a title-fv in_p" style="margin-top: 5%;">Datos del titular</b>
	    </div>
		<div class="centrar_div">
			<label class="text">Nombre: </label>
			<span id="error_nombre" class="error"></span>
			<input class="input s1 top focus_azul" id="nombre" type="text" value="Ines">	
		</div>
		<div class="centrar_div">
			<label class="text">Apellido: </label>
			<span id="error_apellido" class="error"></span>
			<input class="input s1 top focus_azul" id="apellido" type="text" value="Mendez">	
		</div>
		<div class="centrar_div" style="margin-top: -4%">
			<label class="text">DNI: </label>
			<span id="error_dni" class="error"></span>
			<input class="input s1 top focus_azul" type="text" pattern="[0-9]{8}" title="complete con un numero de 8 digitos numericos" name="clave" id="dni" value="42952824">
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