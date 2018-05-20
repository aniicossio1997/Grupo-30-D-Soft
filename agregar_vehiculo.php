<?php

include('header.php');
if ($verificar->esta_logueado())
{ 

$id=$verificar->id();
?>

<?php if (isset($_SESSION['mensaje']) ){ ?>
		
		<p class="p_msj_error"><?php echo $_SESSION['mensaje'];?></p>

<?php unset($_SESSION['mensaje']); }?>

<div class="conteiner-form " >
	<h1 class="h1-form">Agregar vehículo</h1>

<div class="conteiner-f1">
	<form action="validar_vehiculo.php" method="GET" class="container">
	 

	  <div>
	  	<label class="label-f1"> Marca:</label> 
	  	<input type="text" name="marca" class="input-f1" id="" >
	  </div>

	  <div>
	  	<label class="label-f1"> Patente:</label>  
	  	<input type="text" name="patente" class="input-f1" id="" >
	  </div>

	  <div>
	  	<label class="label-f1"> Modelo:</label> 
	  	<input type="text" name="modelo" class="input-f1" id="" >
	  </div>

	  <div>
	  	<label class="label-f1"> Asientos:</label> 
	  	<input type="number" name="asientos" class="input-f1" id="" >
	  </div>

	  <button type="submit"> Guardar </button>

	</form>
</div>
</div>


<?php }
else{
header("Location:Login.php");}
?>