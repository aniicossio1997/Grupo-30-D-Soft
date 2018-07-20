<?php

include('header.php');
if ($verificar->esta_logueado())
{ 

$id=$verificar->id();
?>

<?php if (isset($_SESSION['add_vehiculo']) ){ ?>
		
		<p class="p_msj_error"><?php echo $_SESSION['add_vehiculo'];?></p>

<?php unset($_SESSION['add_vehiculo']); }?>

<div class="conteiner-form " >
	<h1 class="h1-form" style="position: relative;">Agregar vehículo</h1>

<div class="conteiner-f1">
	<form action="validar_vehiculo.php" method="GET" id="form1">
	 

<div class="caja_auto">
	<div>
		<label> Marca:</label> <span class="error" id="error_marca"></span>
		<input type="text" name="marca" class="input-f1 focus_azul" id="marca" >
	</div>
	
	<div>
		<br>
		<label> Patente:</label><span class="error" id="error_patente"></span>
		<input type="text" name="patente" class="input-f1 focus_azul " id="patente" >
	</div>
	
	<div>
		<br>
		<label> Modelo:</label><span class="error" id="error_modelo"></span> 
		<input type="text" name="modelo" class="input-f1 focus_azul " id="modelo" >
	</div>
	
	<div>
		<br>
		<label> Asientos:</label><span class="error" id="error_asientos"></span>
		<input type="number" min="1" name="asientos" class="input-f1  focus_azul" id="asientos" >
	</div>
	<br>
		
	<button class="input-f1 text-white fondo-blue btn-form" type="submit"> Guardar </button>
</div>

	</form>
</div>
</div>


	<script type="text/javascript" src="js/validar_modificacion_vehiculo.js"></script>

<?php 
include('footer.php');
 ?>
<?php
mysqli_close($link);
 }
else{

header("Location:Login.php");}
?>


</body>
</html>